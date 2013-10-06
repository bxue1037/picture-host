--
Manuel d'installation 
--

1. Créez une base MySQL

2. Lui balancer le schema.sql

3. Editez config.php :
    - Les infos de connexion à la base (host, user, database, password)
    - Les infos liées à l'upload des images (extensions autorisées, poids max des fichiers envoyés, taille des miniatures, etc)
    - Le titre, url, et message de footer
    - Style: le nom du fichier css (dans stylesheets/, sans le .css)
    - Favicon: le nom de la favicon (dans images/, sans le .ico)
    - Cookie: le nom du cookie rattaché à pix
    - Cron: le delais entre deux rebuild du nuage de tag
    - Tagcloud: les tailles/couleurs du nuage de tag

4. Accordez les droits d'écriture à votre serveur web pour uploads/ , cron.last et totalsize

5. Epluchez un oignon :)

Pour toute question, correctif, critique, insulte : arthur.fernandez@toile-libre.org
