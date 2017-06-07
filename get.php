<?php
include 'config.php';
$conn = sqlsrv_connect( $db_host, $connectionInfo);
$linkkey = $_GET['linkkey'];
$sql = "select * from data where linkkey ='test'";
$stmt = sqlsrv_query( $conn, $sql);
$row=sqlsrv_fetch_array($stmt);

echo $row;
?>