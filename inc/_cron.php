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

$last = file_exists($config['file_cron']) ? file_get_contents($config['file_cron']) : '0';

$now = time();

if ($last + $config['cron'] < $now) {
    /* on prefere remettre le cron a jour direct pour eviter qu'il
     soit lancé par deux utilisateurs. */    
    file_put_contents($config['file_cron'], $now);

    //rebuild du tagcloud.
    require_once CLASSES . 'Image.php';
    Image::rebuildTagCloud();

    //determination de l'espace disque total utilisé
    $totalsize = Image::getTotalSize();
    file_put_contents($config['file_totalsize'], $totalsize);
}
