<?php

use cobra_salsa\PdoClass;
use cobra_salsa\LoginClass;
use cobra_salsa\ActivarClass;
use Nyholm\Psr7\Factory\Psr17Factory;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

// Set up PSR-17 and PSR-7 factories
$psr17Factory = new Psr17Factory();
$serverRequestCreator = ServerRequestCreatorFactory::create();
$serverRequest = $serverRequestCreator->createServerRequestFromGlobals();

$app = AppFactory::create();

// Define a test route
$app->get('/test', function ($request, $response, $args) {
    $response->getBody()->write('Slim Framework is working!');
    return $response;
});

// Define a route to test dbConnectAdmin functionality
$app->get('/db-admin-test', function (Request $request, Response $response, $args) {
    $pdoClass = new PdoClass();
    try {
        $pdo = $pdoClass->dbConnectAdmin();
        $response->getBody()->write('Database connection successful.');
    } catch (Exception $e) {
        $response->getBody()->write('Database connection failed: ' . $e->getMessage());
    }
    return $response;
});

// Define a route to handle account activation logic
$app->post('/activate', function (Request $request, Response $response, $args) {
    $parsedBody = $request->getParsedBody();
    $dataRaw = $parsedBody['data'] ?? '';

    if (empty($dataRaw)) {
        $response->getBody()->write('No data provided.');
        return $response->withStatus(400);
    }

    $pdoClass = new PdoClass();
    $pdo = $pdoClass->dbConnectAdmin();
    $activarClass = new ActivarClass($pdo);

    $data = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
    $count = $activarClass->activateCuentas($data);

    $response->getBody()->write("<p>$count Cuentas están activadas</p>");
    return $response;
});

$local = $_SERVER['REMOTE_ADDR'];
$go = filter_input(INPUT_POST, 'go');
$capt = filter_input(INPUT_POST, 'capt');
$pw = filter_input(INPUT_POST, 'pwd');

if (!empty($go)) {
    require_once 'classes/PdoClass.php';
    require_once 'classes/LoginClass.php';
    $pd = new PdoClass();
    $pdo = $pd->dbConnectNobody();
    $lc = new LoginClass($pdo);
    $userData = $lc->getUserData($capt, $pw);
    $field = "ejecutivo_asignado_call_center";
    if (!empty($userData->TIPO)) {
        if ($userData->TIPO == 'visitador') {
            $field = "ejecutivo_asignado_domiciliario";
        }
        $cpw = $capt . sha1($pw) . date('U');
        if ($capt == "gmbs") {
            setcookie('auth', $cpw, time() + 60 * 60 * 24);
        } else {
            setcookie('auth', $cpw, time() + 60 * 60 * 11);
        }
        $enlace = $lc->runLogin($cpw, $capt, $userData, $local);
        $page = "Location: $enlace?find=$capt&field=$field&i=0&capt=$capt&go=ABINICIO";
        header($page);
    }
}
require_once 'views/indexView.php';

$app->run();