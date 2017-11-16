<?php 
$data = $_POST['data'];
$data = substr($data,strpos($data,",")+1);
$data = base64_decode($data);
if($_POST["mode"] == "bpc") 
$file = '/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'].'/Emergency_Phone_Background.jpg';
else
$file = '/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'].'/PhoneBackground.jpg';
if (!file_exists('/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'])) {
    mkdir('/home/bitnami/apps/wordpress/htdocs/wp-content/files/'.$_POST['conID'], 0777, true);
}
if(file_exists($file)) unlink($file);
@file_put_contents($file, $data);
if($_POST["mode"] == "bpc") 
echo 'https://start.nowprep.com/wp-content/files/'.$_POST['conID'].'/Emergency_Phone_Background.jpg?'.time();
else
echo 'https://start.nowprep.com/wp-content/files/'.$_POST['conID'].'/PhoneBackground.jpg?'.time();
