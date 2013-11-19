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

    $tags = ($_POST) ? $_POST['tags'] : implode(', ', $picture->getTags());
    $description = ($_POST) ? $_POST['description'] : $picture->getDescription();
    $private = ($_POST) ? $_POST['private'] : $picture->isPrivate();

    if ($_POST) {

        $success = $picture->edit($tags, $description, $private);
        if (!$success) {
            $error = $picture->error;
        }

    }

    ?>

        <h2>Edit information for a picture</h2>

        <?php include_once INC . '_error.php';
        if ($success) {
            echo '<span class="success">Picture up-to-date!</span>';
        } ?>

        <span class="preview">
            <a href="?img=<?= $img ?>" rel="milkbox"><img src="<?= $thumb ?>"/></a>
        </span>

        <form action="?action=edit&img=<?= $img; ?>" method="post">
            <label for="tags">Tags (optional) : </label>
            <input type="text" id="tags" name="tags" value="<?php echo $tags; ?>" />
            <label for="description">Description (optional) : </label>
            <textarea type="text" id="description" name="description"><?php echo $description; ?></textarea>
            <label for"private">Private picture?&nbsp;&nbsp;&nbsp;&#10511; </label>
            <input id="private" type="checkbox" name="private" value="1" <?php if ($private) { echo 'checked="1"'; } ?> />
            <input type="submit" value="Save" />
        </form>

<?php } 

