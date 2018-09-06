Docker WordPress
================

Docker environment optimized for WordPress.

...

Configuration
-------------

-	Rename example.env to .env and edit to your needs
-	Remove all Testfiles from ./htdocs
-	Download and copy WordPress to ./htdocs

Usage
-----

### Docker compose

https://docs.docker.com/compose/reference/

### Database backup

```
$ docker exec wordpress_db_1 sh -c 'exec mysqldump --all-databases -uroot -p"$MYSQL_ROOT_PASSWORD"' > /some/path/on/your/host/all-databases.sql
```

### Console login to php service

```
docker exec -ti wordpress_php_1 /bin/bash
```

### Console login to web service

```
docker exec -ti wordpress_web_1 /bin/bash
```
