<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:12
 */
$uri = "http://studenrestphp20171117070427.azurewebsites.net/Service1.svc/student/";
$id = $_POST['id'];
$jsondata = file_get_contents($uri . $id);
$student = json_decode($jsondata, true);
if(empty($student)){
    $studentArray = null;
}
else{
    $studentArray = array($student);
}require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('studentIntra.html.twig');
$parametersToTwig=array("students"=>$studentArray);
echo $template->render($parametersToTwig);
