<?php
include 'config.php';
$conn = sqlsrv_connect( $db_host, $connectionInfo);
$secret = '#'; //replace # with your own secret code
$response = $_POST['g-recaptcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];
$url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
$result = json_decode($url, TRUE);
if($result['success'] == 1){
    if(empty($_POST["url"])) randomLink();
    else if (check($_POST["url"])) customLink($_POST["url"]);
}
else{echo "You Can't SPAM, dude";}

function check($url){
    if(!preg_match("/^[a-zA-Z0-9]{1,10}$/", $url)){
        echo "FALSE";
		return FALSE;
    }
    $sql = "SELECT linkkey FROM data WHERE linkkey='$url'";
    $stmt = sqlsrv_query( $GLOBALS["conn"], $sql);
	$row=sqlsrv_fetch_array($stmt);
    if (is_null($row)) {
		return TRUE;
	}
    else {
		echo "FALSE";
		return FALSE;
	}
}

function randomLink(){
	do{
		$randomStr = generateRandomString();}
	while (!check($randomStr));//如果stmt 有被選中代表資料庫已有值，需要重新再跑一次

    $sql = "INSERT INTO data (linkkey, datas) VALUES ('$randomStr', '{$_POST["note"]}')";
    $stmt = sqlsrv_query( $GLOBALS["conn"], $sql);
    echo $randomStr;
}
function customLink($url){   
	
    $sql = "INSERT INTO data (linkkey, datas) VALUES ('$url', '{$_POST["note"]}')";
    $stmt = sqlsrv_query( $GLOBALS["conn"], $sql);
    echo $url; 
}

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>