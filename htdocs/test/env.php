<?php

$servername = getenv('MYSQL_HOST');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$database = getenv('MYSQL_DATABASE');

echo "
MYSQL ENV vars ::
host:$servername
user:$username
pass:$password
name:$database
";
