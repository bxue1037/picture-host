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
require_once CLASSES . 'User.php';
?>
<div class="clearfix"></div>
        </div>
	<div id="footer">
 	    <b>
	    <?php echo Image::getCount(); ?> Images - 
	    <?php echo User::getCount(); ?> Utilisateurs - 
	    <?php echo Image::getTotalHumanSize(); ?> -
	    </b>
	    <a href="http://pix.toile-libre.org/pix-1.1.tar.gz">Pix 1.1-release</a> - 
            <?php echo $config['footer']; ?>
        </div>
    </body>
</html>
