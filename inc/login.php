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


require_once CLASSES . 'User.php';

if ($_POST) {

    $user = new User();
    $success = $user->login($_POST['username'], $_POST['password']);
    if (!$success) {
        $error = $user->error;
    }

}

if ($success) {
    header('Location: ' . $config['url']);
} else {

?>

    <h2>Ouvrir une session</h2>
    <p>Veuillez entrer ci-dessous votre pseudo et votre mot de passe :-)</p>
    <p>Si vous ne disposez pas encore d'un compte, vous pouvez en enregistrer un gratuitement sur <a href="?action=register">cette page</a>.</p>

    <?php include_once INC . '_error.php'; ?>

    <form action="?action=login" method="post">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Your username" />
        <label for="password">Mot de passe : </label>
        <input type="password" id="password" name="password" />
        <input type="submit" value="Log in" />
    </form>

<?php 
}

