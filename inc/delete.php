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


require_once CLASSES . 'Image.php';

if (isset($img) && file_exists(ORIGINAL . $img)) {
    $original = $config['dir_original'] . $img;
    $resized = $config['dir_resize'] . $img;
    $thumb = $config['dir_thumb'] . $img;

    $image = Image::getFromName($img);

    if ($_POST) {

        if ($_POST['cancel']) {
            header('Location: ' . $config['url'] . '?img=' . $img);

        } else {
            $success = $image->delete();
            if (!$success) {
                $error = $image->error;
            }
        }
    }

    ?>

        <h2>Supprimer une image</h2>

        <?php include_once INC . '_error.php';
        if ($success) {
            echo '<span class="success">Image supprim&eacute;e !</span>';
        } else { ?>

            <span class="preview">
                <a href="?img=<?= $img ?>" rel="milkbox"><img src="<?= $thumb ?>"/></a>
            </span> 

            <p>&Ecirc;tes vous sur de vouloir supprimer cette image ?</p>

            <form action="?action=delete&img=<?= $img; ?>" method="post">
                <input type="submit" name="delete" value="Oui" />
                <input type="submit" name="cancel" value="Non" />
            </form>

<?php   }
}


