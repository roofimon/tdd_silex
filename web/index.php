<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views'
));

$app['wine_service_pdo'] = $app->share(function() use ($app) {
  $connectionManager = $app['wine_sqlite_connection_manager'];
  return new WineServicePDO($connectionManager);
});

$app['wine_sqlite_connection_manager'] = $app->share(function() {
  return new WineSQLiteConnectionManager();
});

$app['wines.controller'] = $app->share(function() use ($app) {
  return new WineController($app);
});

$app->get('/', 'wines.controller:rootPage');

$app->get('/wines', 'wines.controller:listWine');

$app->post('/wines', 'wines.controller:addWine');

$app->get('/wines/{id}', 'wines.controller:getWine');

$app->run();

