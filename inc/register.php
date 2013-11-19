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
    $success = $user->register($_POST['username'], $_POST['password'], $_POST['confirm']);
    if (!$success) {
        $error = $user->error;
    }

}

if ($success) {
    header('Location:' . $config['url']);
} else {

?>

    <h2>Enregistrer un compte</h2>
    <p>Veuillez entrer ci-dessous le username et le mot de passe d&eacute;sir&eacute;.</p>
    <p><em>Votre mot de passe est chiffr&eacute; via une methode a sens unique (hash).</em></p>

    <?php include_once INC . '_error.php'; ?>

    <form action="?action=register" method="post">
        <label for="username">Username : </label>
        <input type="text" id="username" name="username" placeholder="Your username"  />
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" />
        <label for="confirm">Confirm your password: </label>
        <input type="password" id="confirm" name="confirm" />
        <input type="submit" value="Sign up" />
    </form>

<?php 
}
