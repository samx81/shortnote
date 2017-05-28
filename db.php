
<?php
$serverName = "mssql5.gear.host"; //serverName\instanceName
$connectionInfo = array( "Database"=>"shorturls", "UID"=>"shorturls", "PWD"=>"Gf7UX!qRqzb!");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
