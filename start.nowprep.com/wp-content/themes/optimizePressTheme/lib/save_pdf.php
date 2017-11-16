<?php 
//var_dump($_POST);
$data = $_POST['data'];
//$data = substr($data,strpos($data,",")+1);
$data = base64_decode($data);
if($_POST["mode"] == "ecc" || $_POST["mode"] == "ecs")
$file = '/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'].'/ICE_Card.pdf';
else 
$file = '/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'].'/EmergencyCard.pdf';
if (!file_exists('/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'])) {
    mkdir('/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'], 0777, true);
}
if(file_exists($file)) unlink($file);
@file_put_contents($file, $data);
if($_POST["mode"] == "ecc" || $_POST["mode"] == "ecs")
echo 'https://start.nowprep.com/wp-content/files/'.$_POST['conID'].'/ICE_Card.pdf?'.time();
else
echo 'https://start.nowprep.com/wp-content/files/'.$_POST['conID'].'/EmergencyCard.pdf?'.time();

