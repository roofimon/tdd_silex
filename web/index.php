<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once 'WineServicePDO.php';
require_once 'WineController.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['wine_service_pdo'] = $app->share(function() {
    return new WineServicePDO();
});

$app['wines.controller'] = $app->share(function() use ($app) {
    return new WineController($app);
});

$app->get('/wines', 'wines.controller:listWine');
$app->post('/wines', 'wines.controller:addWine');

$app->get('/', function () use ($app) {
    return '';
});

$app->get('/wines/{id}', function ($id) use ($app) {
    $wines = "<b>First wine with id </b>".$id;
    return $wines;
});

$app->run();

