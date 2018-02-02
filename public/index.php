<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/Connect.php';

$app = new \Slim\App;
require_once '../src/api/books.php';
require_once '../src/api/users.php';
$app->run();
