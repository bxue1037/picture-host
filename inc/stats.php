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


require_once CLASSES . 'User.php';
require_once CLASSES . 'Image.php';

?>

<h2>Statistiques</h2>

<ul>
    <li><?php echo User::getCount(); ?> utilisateurs enregistr&eacute;s</li>
    <li><?php echo Image::getCount(); ?> images soit <?php echo Image::getHumanSize(Image::getTotalSize()); ?></li>
    <li><?php echo Image::getTagsCount(); ?> tags</li>
</ul>
