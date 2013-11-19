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



session_start();
ob_start();

require_once 'config.php';
require_once CLASSES . 'SQL.php';

$sql = new SQL();

require_once CLASSES . 'User.php';
User::checkCookie();

$img = $_GET["img"];
$action = ($_GET['action']);

if (!$img && !$action) {
    $action = 'tagcloud';
}
$allowed_actions = array('upload', 'register', 'login', 'logout', 'account', 'search', 'help', 'stats', 'tagcloud', 'edit', 'delete', 'contact');

include_once INC . '_cron.php';
include_once INC . '_header.php';

if (isset($action)) {
    if (in_array($action, $allowed_actions)) {
        include_once INC . $action . '.php';
    } else {
        $error = "This page doesn't exist!";
        include_once INC . '_error.php';
    }

} else {
       if (isset($img)) {
        include_once INC . 'picture.php';
    }
}

include_once INC . '_footer.php';
