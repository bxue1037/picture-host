<?php 

/******************************************************************************/
/*                                                                            */
/* Pix : Hébergement d'images                                                 */
/*         v1.1 - 17082010                                                    */
/******************************************************************************/
/*                                                                            */
/* Auteur:                                                                    */
/*     - Arthur FERNANDEZ (arthur.fernandez@toile-libre.org)                  */
/*     - Mickael BLATIERE (mickael@saezlive.net)                              */
/*                                                                            */
/* Contributeurs :                                                            */
/*     - Nicolas VIVET (nizox@toile-libre.org)                                */
/*                                                                            */
/* Licence : aGPL                                                             */
/*                                                                            */
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
$allowed_actions = array('upload', 'register', 'login', 'logout', 'account', 'search', 'help', 'stats', 'tagcloud', 'edit', 'delete', 'account');

include_once INC . '_cron.php';
include_once INC . '_header.php';

if (isset($action)) {
    if (in_array($action, $allowed_actions)) {
        include_once INC . $action . '.php';
    } else {
        $error = "Cette page n'existe pas !";
        include_once INC . '_error.php';
    }

} else {
       if (isset($img)) {
        include_once INC . 'image.php';
    }
}

include_once INC . '_footer.php';
