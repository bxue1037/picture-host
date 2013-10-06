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

$cloud = Image::getTagCloud();

//echo '<h2>Nuage de tags</h2>';

if (is_array($cloud)) {
    foreach ($cloud as $tag => $data) {
        echo "<a href=\"?action=search&method=tag&tag=" . urlencode($tag) . "\">";
        echo "  <span style='color: " . $data['color']."; font-size: " . $data['size'] . "px;'>" . $tag . "</span>";
        echo "</a>";
    }
}
