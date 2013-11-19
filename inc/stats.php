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
require_once CLASSES . 'Picture.php';

?>

<h2>Statistiques</h2>

<ul>
    <li><?php echo User::getCount(); ?> registered users</li>
    <li><?php echo Picture::getCount(); ?> pictures  &#10234;  <?php echo Picture::getHumanSize(Picture::getTotalSize()); ?></li>
    <li><?php echo Picture::getTagsCount(); ?> tags</li>
</ul>
