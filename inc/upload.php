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


require_once CLASSES . 'Picture.php';

$picture = new Picture();
if ($picture->upload($_FILES['img'], $_POST['tags'], $_POST['description'], $_POST['private'])) {
    ob_clean();
    header('Location: ' . $config['url'] . '?img=' . $picture->getName());
} else {
    $error = $picture->error;
    include_once INC . '_error.php';
}

