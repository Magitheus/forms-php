<?php
$isCloud = getenv('MYSQLHOST') === 'true';
putenv("MYSQLHOST=" . ($isCloud ? '${{MySQL.MYSQLHOST}}' : 'localhost'));
putenv("MYSQLDATABASE=" . ($isCloud ? '${{MySQL.MYSQLDATABASE}}' : 'revista'));
putenv("MYSQLPASSWORD=" . ($isCloud ? '${{MySQL.MYSQLPASSWORD}}' : '1234'));
putenv("MYSQLPORT=" . ($isCloud ? '${{MySQL.MYSQLPORT}}' : 3306));
putenv("MYSQLUSER=" . ($isCloud ? '${{MySQL.MYSQLUSER}}' : 'root'));
?>