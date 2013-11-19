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

$method = $_GET['method'];
switch ($method) {

    case 'tag':
        $searchFor = "Images tagg&eacute;es \"". $_GET['tag'] . "\"";
        $images = Image::getFromTag($_GET['tag']);
        break;

    case 'author':
        $searchFor = "Images envoy&eacute;es par " . $_GET['author'];
        $images = Image::getFromAuthor($_GET['author']);
        break;

    case 'random':
        $searchFor = "Image al&eacute;atoire...";
        $images = Image::getRandom();
        break;

    case 'browse':
        $searchFor = "Toutes les images";
        $images = Image::getAll();
        break;
}

echo '<h2>' . $searchFor . '</h2>';
if (count($images) == 0) {
    echo "Aucune image.";
} else if ($method == 'random') {
    $image = array_shift($images);
    ob_clean();
    header('Location: ' . $config['url'] . '?img=' . $image->getName());
} else {
    foreach ($images as $image) {
        echo '<p class="result">';
        echo '  <a href="?img=' . $image->getName() . '">';
        echo '      <img src="' . $config['dir_thumb'] .$image->getName() . '"/>';
        echo '  </a>';
        echo '</p>';
    } 
}?>

<div class="clear"></div>
