<?php


if (isset($_GET['machine_name']) and isset($_GET['machine_token'])) {

try {
$db = new PDO("mysql:host=mysql;dbname=helpchannel;useUnicode=true;characterEncoding=utf-8","root","admin");

$query=$db->prepare("Select connection_code from helpchannel_connection where machine_name=? and machine_token=? order by id desc");

$query->execute(array($_GET['machine_name'],$_GET['machine_token']));

$row=$query->fetch(PDO::FETCH_OBJ);

echo "<script type=text/javascript>location.href='https://gecos-hc.juntadeandalucia.es/tecnico?repeaterID=ID:",$row->connection_code,"';</script>Connecting...";

} catch(PDOException  $e ){
echo "Error: ".$e;
}

}
?>




