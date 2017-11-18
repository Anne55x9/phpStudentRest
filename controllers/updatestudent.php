<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:32
 */

$id = $_POST["id"];
$name = $_POST["name"];
$start = $_POST["start"];
$school = $_POST["school"];

$data = array("Name"=> $name, "Start"=> $start, "School"=>$school);
$json_string=json_encode($data);

$uri = "http://studenrestphp20171117070427.azurewebsites.net/Service1.svc/students/";

$full_uri = $uri . $id;
$ch = curl_init(    $full_uri);

curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,$json_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-type:application/json',
    'Content-Length: ' . strlen($json_string)
));

$jsondata = curl_exec($ch);
$theUpdatedStu = json_decode($jsondata, true);

$studentArray = array($theUpdatedStu);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload'=>true
));

$template = $twig->loadTemplate('studentIntra.html.twig');

$parametersToTwig = array("students"=> $studentArray);
echo $template->render($parametersToTwig);

