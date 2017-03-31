<?php
require __DIR__."/config.inc.php";
extract($config['database']);
// var_dump($config);

print $host."\n";
print $username."\n";
print $password."\n";
print $dbname."\n";
print $port."\n";