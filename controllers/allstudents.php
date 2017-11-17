<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 17/11/2017
 * Time: 10:50
 */

$uri = "http://studenrestphp20171117070427.azurewebsites.net/Service1.svc/students";
$jsondata = file_get_contents($uri);

$convertToAssociativeArray = true;
$students = json_decode($jsondata,$convertToAssociativeArray);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array('auto_reload'=> true));

$template = $twig->loadTemplate('studentIntra.html.twig');

$parametersToTwig = array("students"=>$students);
echo $template->render($parametersToTwig);
