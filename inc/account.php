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

$user = User::get();

if (!$user) {
    $error = "You must be logged in to access this page.";
    include_once INC . '_error.php';
} else {

    $pseudo = ($_POST['edit']) ? $_POST['pseudo'] : $user->getPseudo();

    if ($_POST) {

        if ($_POST['edit']) {
            $success = $user->edit($pseudo);
        } else if ($_POST['changePassword']) {
            $success = $user->changePassword($_POST['password'], $_POST['new'], $_POST['confirm']);
        } else if ($_POST['delete']) {
            $success = $user->delete($_POST['all']);
        }

        if (!$success) {
            $error = $user->error;
        }

    }

    ?>

        <h2>Mon compte</h2>

        <?php include_once INC . '_error.php';

        if ($_POST['delete'] && $success) {
            echo '<span class="success">Account deleted!</span>';
        } else {

            if ($success) {
                echo '<span class="success">Account up-to-date!</span>';
            } ?>

            <form class="edit" action="?action=account" method="post">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" />
                <input type="submit" name="edit" value="Change my username" />
            </form>

            <form class="changePassword" action="?action=account" method="post">
                <label for="password">Current Password: </label>
                <input type="password" id="password" name="password" />
                <label for="new">New password: </label>
                <input type="password" id="new" name="new" />
                <label for="confirm">Confirm your password: </label>
                <input type="password" id="confirm" name="confirm" />
                <input type="submit" name="changePassword" value="Change the password" />
            </form>

            <form action="?action=account" method="post">
                <input type="hidden" name="all" value="0" />
                <input type="submit" name="delete" value="Delete Account" />
            </form>

            <form action="?action=account" method="post">
                <input type="hidden" name="all" value="1" />
                <input type="submit" name="delete" value="Delete my account and all pictures associated" />
            </form>


    <?php }
}

