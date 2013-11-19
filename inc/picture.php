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
?>

    <div class="picture">
        <span class="thumbnail">
            <a href="<?= $original ?>" rel="milkbox"><img src="<?= $resized ?>"/></a>
        </span>
        <? if ($picture && $picture->getUser() && $picture->getUser() == $_SESSION['username']) { ?>
            <span class="actions">
                <a class="edit" href="?action=edit&img=<?= $img ?>"><img src="pictures/edit.png" /></a>
                <a class="delete" href="?action=delete&img=<?= $img ?>"><img src="pictures/delete.png" /></a>
            </span>
        <? } ?>
        <? if ($picture) { ?>
            <span class="author">Picture sent the <? echo $picture->getDate(); ?>
            <? if ($picture->getUser()) { ?>
                par <a href="?action=search&method=author&author=<?echo $picture->getUser(); ?>"><?echo $picture->getUser(); ?></a>
            <? } ?>
            </span>
            <span class="metadata"><? echo $picture->getWidth() . ' x ' . $picture->getHeight(); ?> - <? echo Picture::getHumanSize($picture->getSize()); ?></span>
            <span class="description"><?echo $picture->getDescription(); ?></span>
            <span class="tags">
            <? foreach ($picture->getTags() as $tag) { ?>
                <a href="?action=search&method=tag&tag=<?echo $tag; ?>"><?echo $tag; ?></a>
            <? } ?>
            </span>
        <? } ?>
    </div>

    <table class="info">
        <tr>
            <th></th>
            <th>Copy/paste the following text to &#8230;</th>
        </tr>
        <tr>
            <td>View this picture: </td>
            <td>
                <textarea><? echo $config['url']; ?>?img=<? echo $img; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Access to this picture: </td>
            <td>
                <textarea><? echo $config['url'] . $original; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Insert this thumbnail in a forum: </td>
            <td>
                <textarea>[url=<? echo $config['url']; ?>?img=<? echo $img; ?>][img]<? echo $config['url'] . $thumb; ?>[/img][/url]</textarea>
            </td>
        </tr>
        <tr>
            <td>Include this picture in a forum: </td>
            <td>
                <textarea>[url=<? echo $config['url']; ?>?img=<? echo $img; ?>][img]<? echo $config['url'] . $resized; ?>[/img][/url]</textarea>
            </td>
        </tr>
        <tr>
            <td>Insert this thumbnail into your website: </td>
            <td>
                <textarea><a href='<? echo $config['url']; ?>?img=<? echo $img; ?>'><img src='<? echo $config['url'] . $thumb; ?>' /></a></textarea>
            </td>
        </tr>
        <tr>
            <td>Insert this picture into your website: </td>
            <td>
                <textarea><a href='<? echo $config['url']; ?>?img=<? echo $img; ?>'><img src='<? echo $config['url'] . $resized; ?>' /></a></textarea>
            </td>
        </tr>
    </table>

    <div class="related">
        <?php if ($picture) $pictures = $picture->getRelated();
        if (!is_array($pictures) || count($pictures) == 0) {
            $pictures = Picture::getRandom(3);
            echo "<h4>Random pictures</h4>";
        } else {
            echo "<h4>Related pictures</h4>";
        }
        foreach ($pictures as $picture) {
            echo '<p>';
            echo '  <a href="?img=' . $picture->getName() . '">';
            echo '      <img src="' . $config['dir_thumb'] .$picture->getName() . '"/>';
            echo '  </a>';
            echo '<p>';
        } ?>
    </div>
<?php
} else {
    $error = "This picture doesn't exist!";
    include_once INC . '_error.php';
}

