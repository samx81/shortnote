<?php
$db_host = 'mssql5.gear.host';
$db_user = 'shorturls';
$db_pass = 'Gf7UX!qRqzb!';
$db_name = 'shorturls';
$connectionInfo = array( "Database"=>$db_name, "UID"=>$db_user, "PWD"=>$db_pass);
$conn = sqlsrv_connect( $db_host, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT key,data FROM data";
$stmt = sqlsrv_query( $conn, $sql)or die("sql error".sqlsrv_errors());

echo $stmt;
echo "test";

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
