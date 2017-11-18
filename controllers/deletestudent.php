<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:32
 */

$uri = "http://studenrestphp20171117070427.azurewebsites.net/Service1.svc/students/";
$id = $_POST['id'];
$full_uri = $uri . $id;

$ch = curl_init($full_uri);

curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$jsondata = curl_exec($ch);
$theDeletedStu = json_decode($jsondata,true);

if($theDeletedStu == null){
    $studentArray = false;
}else{
    $studentArray = array($theDeletedStu);
}


require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('studentIntra.html.twig');

$parametersToTwig = array("students"=> $studentArray);
echo $template->render($parametersToTwig);