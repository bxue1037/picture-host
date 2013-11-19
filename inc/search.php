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

$method = $_GET['method'];
switch ($method) {

    case 'tag':
        $searchFor = "Tagged pictures \"". $_GET['tag'] . "\"";
        $pictures = Picture::getFromTag($_GET['tag']);
        break;

    case 'author':
        $searchFor = "Pictures sent by " . $_GET['author'];
        $pictures = Picture::getFromAuthor($_GET['author']);
        break;

    case 'random':
        $searchFor = "Random Picture &#8230;";
        $pictures = Picture::getRandom();
        break;

    case 'browse':
        $searchFor = "All pictures";
        $pictures = Picture::getAll();
        break;
}

echo '<h2>' . $searchFor . '</h2>';
if (count($pictures) == 0) {
    echo "No picture.";
} else if ($method == 'random') {
    $picture = array_shift($pictures);
    ob_clean();
    header('Location: ' . $config['url'] . '?img=' . $picture->getName());
} else {
    foreach ($pictures as $picture) {
        echo '<p class="result">';
        echo '  <a href="?img=' . $picture->getName() . '">';
        echo '      <img src="' . $config['dir_thumb'] .$picture->getName() . '"/>';
        echo '  </a>';
        echo '</p>';
    } 
}?>

<div class="clear"></div>
