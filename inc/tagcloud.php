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

$cloud = Picture::getTagCloud();

echo '<h2>TagCloud</h2>';

if (is_array($cloud)) {
    foreach ($cloud as $tag => $data) {
        echo "<a href=\"?action=search&method=tag&tag=" . urlencode($tag) . "\">";
        echo "  <span style='color: " . $data['color']."; font-size: " . $data['size'] . "px;'>" . $tag . "</span>";
        echo "</a>";
    }
}
