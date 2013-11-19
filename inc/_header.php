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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title><?php echo $config['title']; ?> | Picture Hosting</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="pictures/<?php echo $config['favicon']; ?>.ico" type="picture/x-icon" />
        <link rel="stylesheet" type="text/css" href="stylesheets/<?php echo $config['style']; ?>.css" media="all"  />
    </head>
    <body>

        <div id="prelude">

            <div class="actions">
                <?php if($_SESSION['username']) { 
                    echo("Hi, ".$_SESSION['username'] . " - <a href=\"?action=account\">My account</a>");
                    echo(" - <a href=\"?action=search&method=author&author=".$_SESSION['username']."\">My pictures</a> - <a href=\"?action=logout\">Log out</a>");
                } else { 
                    echo("<a href=\"?action=register\">Sign up (optional)</a>");
                    echo(" - <a href=\"?action=login\">Log in</a>");
                } 
				echo(" - <a href=\"?action=contact\">Contact us</a>");
				?>
            </div>

        </div>

        <div id="header">

            <a class="logo"href="<?echo $config['url'];?>">
                <h1><?php echo $config['title']; ?></h1>
                <h2>Picture Hosting</h2>
            </a>

            <form class="upload" enctype="multipart/form-data" action="?action=upload" method="post">
                <h3>Upload your picture!</h3>
                <a class="help" href="?action=help">Help?</a>
                <input name="MAX_FILE_SIZE" value="<?= $config['file_size_max'] * 1024 ?>" type="hidden" /> 
                <input name="img" size="30" type="file" />
                <input value="Send" type="submit" />
                <div class="options" id="upload-options">
                    <label for"tags">Tags (optional), separate them by commas:</label>
                    <input id="tags" name="tags" type="text"/>
                    <br />
		    <label for="description">Description (optional):</label>
                    <textarea name="description"></textarea>
                </div>
				<br />
                <label for"private">Private picture?&nbsp;&nbsp;&nbsp;&#10511; </label>
               	<input id="private" type="checkbox" name="private" checked="checked" value="1" />
            </form>
 
        </div>

        <div class="content" id="<?php echo $action; ?>">

