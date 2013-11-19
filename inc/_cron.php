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

$last = file_exists($config['file_cron']) ? file_get_contents($config['file_cron']) : '0';

$now = time();

if ($last + $config['cron'] < $now) {
    /* on prefere remettre le cron a jour direct pour eviter qu'il
     soit lancé par deux utilisateurs. */    
    file_put_contents($config['file_cron'], $now);

    //rebuild du tagcloud.
    require_once CLASSES . 'Picture.php';
    Picture::rebuildTagCloud();

    //determination de l'espace disque total utilisé
    $totalsize = Picture::getTotalSize();
    file_put_contents($config['file_totalsize'], $totalsize);
}
