<?php
include 'config.php';
$conn = sqlsrv_connect( $db_host, $connectionInfo);
$linkkey = $_GET["linkkey"];
if($linkkey==="dump"){
    dump();
}
$sql = "select * from data where linkkey = '" . $linkkey . "'";
$stmt = sqlsrv_query( $conn, $sql);
$row=sqlsrv_fetch_array($stmt);
echo $row[1];
function dump(){
    $sql = "select * from data";
    $stmt = sqlsrv_query( $GLOBALS["conn"], $sql);
    while ($row=sqlsrv_fetch_array($stmt)){
            echo $row[0]." ".$row[1];
            echo "<br>";
    }
    
}
?>