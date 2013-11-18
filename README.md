--
Installation Help
--

1. Create a MySQL Database

2. Execute into this database schema.sql

3. Edit config.php :
    - Informations about DB connexion (host, user, database, password)
    - Informations relating to picture upload (extensions allowed, max weight of files sent, thumbnail size, etc.)
    - The title, url, and footer message
    - Style: the name of the css file (in stylesheets/ without .css)
    - Favicon: the name of the favicon (in images/, without .ico)
    - Cookie: le name of the cookie attached to picture-host
    - Cron: the delays between two rebuild of the tagcloud
    - Tagcloud: the size / color of the tagcloud

4. Allow the writing rights to your web server for uploads/, cron.last and totalsize


Based on Pix of toile-libre: http://pix.toile-libre.org/pix-1.1.tar.gz whose original license is AGPL v.3; Pix authors are: Arthur FERNANDEZ (arthur.fernandez@toile-libre.org) ; Mickael BLATIERE (mickael@saezlive.net)
