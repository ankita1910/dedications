<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
session_cache_limiter(false);
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require '../vendor/autoload.php';
$app = new \Slim\App;
header("Access-Control-Allow-Origin: http://localhost:81");
require_once("get_giftcard_details.php");
header("Access-Control-Allow-Origin: http://localhost:81");
require_once("registration_login.php");
$app->run();
?>