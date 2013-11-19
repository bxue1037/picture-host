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


require_once CLASSES . 'Picture.php';

if (isset($img) && file_exists(ORIGINAL . $img)) {
    $original = $config['dir_original'] . $img;
    $resized = $config['dir_resize'] . $img;
    $thumb = $config['dir_thumb'] . $img;

    $picture = Picture::getFromName($img);

    if ($_POST) {

        if ($_POST['cancel']) {
            header('Location: ' . $config['url'] . '?img=' . $img);

        } else {
            $success = $picture->delete();
            if (!$success) {
                $error = $picture->error;
            }
        }
    }

    ?>

        <h2>Delete a picture</h2>

        <?php include_once INC . '_error.php';
        if ($success) {
            echo '<span class="success">Picture deleted!</span>';
        } else { ?>

            <span class="preview">
                <a href="?img=<?= $img ?>" rel="milkbox"><img src="<?= $thumb ?>"/></a>
            </span> 

            <p>Are you sure you want to delete this picture?</p>

            <form action="?action=delete&img=<?= $img; ?>" method="post">
                <input type="submit" name="delete" value="Yes" />
                <input type="submit" name="cancel" value="No" />
            </form>

<?php   }
}


