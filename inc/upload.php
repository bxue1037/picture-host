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


require_once CLASSES . 'Image.php';

$image = new Image();
if ($image->upload($_FILES['img'], $_POST['tags'], $_POST['description'], $_POST['private'])) {
    ob_clean();
    header('Location: ' . $config['url'] . '?img=' . $image->getName());
} else {
    $error = $image->error;
    include_once INC . '_error.php';
}

