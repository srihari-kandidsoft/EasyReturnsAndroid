<?php
$conn = mysql_connect('mysql-rds-db-instance.cxgw3hhakezo.us-west-1.rds.amazonaws.com:3306','sriharip','srihariabc');

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

if (!mysql_select_db("easy_returns")) {
    echo "Unable to select easy_returns: " . mysql_error();
    exit;
}
?>
