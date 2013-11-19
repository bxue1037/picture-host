<?php 

/******************************************************************************/
/*                                                                            */
/* Picture Host			                                              */
/*         v1.1.1		                                              */
/******************************************************************************/
/*Picture Host is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Affero Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Picture Host is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Affero Public License for more details.

    You should have received a copy of the GNU General Affero Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.     */
/******************************************************************************/


class User {

    private $_username;
    private $_password;
    private $_sessionId;
    public $error;

    public function login($username, $password) {
        $this->_username = htmlspecialchars($username);
        $this->_password = $password;
        $this->_encryptPassword();

        if ($this->_checkLogin($password)) {
            return $this->_login();
        }

        $this->error = "Username or password don't exist or don't match together";
        return false;
    }

    private function _checkLogin() {
        global $sql;

        $query = "SELECT id FROM users WHERE username='" . $sql->escape($this->_username) . "' AND password='" . $this->_password. "'";
        $sql->execute($query);

        return $sql->count() == 1;
    }

    public function getUsername() {
        return $this->_username;
    }

    public static function get() {
        global $sql;

        if ($_SESSION['username']) {
            $query = "SELECT * FROM users WHERE username = '" . $sql->escape($_SESSION['username']) . "'";
            $sql->execute($query);
            if ($row = $sql->next()) {
                $user = new User();
                $user->_username = $row['username'];
                return $user;
            }
        }
        return null;
    }

    private function _login() {
        global $sql, $config;

        $sessionId =  md5(uniqid(rand(), true));

        $query = "UPDATE users SET session = '" . $sessionId . "' WHERE username = '" . $sql->escape($this->_username) . "'";
        if ($sql->execute($query)) {
            ob_clean();
            setcookie($config['cookie'], $sessionId, time()+60*60*24*30); // expire: one month
            return true;
        }
        return false;
    }

    public static function checkCookie() {
        global $sql, $config;

        $sessionId = $_COOKIE[$config['cookie']];

        if ($sessionId) {
            $query = "SELECT * FROM users WHERE session = '" . $sql->escape($sessionId) . "'";
            $sql->execute($query);
            if ($row = $sql->next()) {
                $_SESSION['username'] = $row['username'];
                return;
            } 
        }
        User::_logout();
    }

    public static function logout() {
        ob_clean();
        User::_logout();
    }

    private static function _logout() {
        global $config;

        setcookie($config['cookie'], '');
        $_SESSION['username'] = '';
        session_destroy();
    }

    public function register($username, $password, $confirm) {
        global $sql;

        $this->_username = htmlspecialchars($username);
        $this->_password = $password;

        // check username
        if (!$this->_checkUsername()) {
            $this->error = "Your username must be more than 3 characters.";
            return false;
        }

        if ($password != $confirm) {
            $this->error = "The two passwords are differents.";
            return false;
        }

        // check password
        if (!$this->_checkPassword()) {
            $this->error = "Your password must be more than 5 characters.";
            return false;
        }
        $this->_encryptPassword();

        if (!$this->_checkUsernameIsFree()) {
            $this->error = "This username is already picked.";
            return false;
        }

        $query = "INSERT INTO users (username, password, ip)  VALUES('" . $sql->escape($this->_username) . "', '" . $this->_password . "', '" . $_SERVER['REMOTE_ADDR'] . "')";
        if ($sql->execute($query)) {
            return $this->_login();
        }

        $this->error = 'An unexpected error has occurred, please contact us.';
        return false;

    } 

    public function edit($username) {
        global $sql;

        // already ok
        if ($username == $this->_username) return true;

        $backup = $this->_username;
        $this->_username = htmlspecialchars($username);

        // check username
        if (!$this->_checkUsername()) {
            $this->error = "Your username must be more than 3 characters.";
            return false;
        }

        if (!$this->_checkUsernameIsFree()) {
            $this->error = "This username is already taken.";
            return false;
        }

        $query = "UPDATE users SET username = '" . $sql->escape($this->_username) . "' WHERE username = '" . $backup . "'";
        if ($sql->execute($query)) {

             $query = "UPDATE uploads SET user = '" . $sql->escape($this->_username) . "' WHERE user = '" . $backup . "'";
             $sql->execute($query);

             $_SESSION['username'] = $this->_username;
             return true;
        }

        // restore
        $this->_username = $backup;
        $this->error = 'An unexpected error has occurred, please contact us.';
        return false;
    } 

    public function delete($withImage) {
        global $sql;

        if ($withImage) {
            requirep_once CLASSES . 'Picture.php';
            $pictures = Picture::getFromAuthor($this->_username);
            foreach ($pictures as $picture) {
                $picture->delete();
            }
        }

        $query = "DELETE FROM users WHERE username = '" . $this->_username . "'";
        return $sql->execute($query);
    }

    public function changePassword($current, $new, $confirm) {
        global $sql;

        $this->_password = $current;
        $this->_encryptPassword();

        if (!$this->_checkLogin()) {
            $this->error = "The password entered is wrong.";
            return false;
        }

        if ($new != $confirm) {
            $this->error = "The two passwords are differents.";
            return false;
        }

        $this->_password = $new;
        if (!$this->_checkPassword()) {
            $this->error = "Your new password must be more than 5 characters.";
            return false;
        }

        $this->_encryptPassword();

        $query = "UPDATE users SET password = '" . $sql->escape($this->_password) . "' WHERE username = '" . $this->_username . "'";
        if ($sql->execute($query)) {
            return true;
        }

        return false;
    }

    private function _encryptPassword() {
        $this->_password = crypt($this->_password, $this->_password);
    }

    private function _checkUsernameIsFree() {
        global $sql;

        $query = "SELECT COUNT(id) AS count FROM users WHERE username = '" . $sql->escape($this->_username) . "'";
        $sql->execute($query);
        $row = $sql->next();
        return $row['count'] == 0;
    }

    private function _checkUsername() {
        return strlen($this->_username) >= 3;
    }

    private function _checkPassword() {
        return strlen($this->_password) >= 5;
    }

    public static function getCount() {
        global $sql;

        $query = "SELECT COUNT(id) AS count FROM users";
        $sql->execute($query);
        $row = $sql->next();

        return $row['count'];
    }

}
