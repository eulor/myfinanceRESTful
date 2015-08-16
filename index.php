<?php

require_once __DIR__ . '/vendor' . '/autoload.php';
require_once __DIR__ . '/autoloader.php';
require_once __DIR__ . '/localconfig.php';

$app = new \Slim\Slim();
$user = new myfinance\model\User();

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/",
    "secure" => false,
    "realm" => "Protected",
    "users" => [
        HTTP_NAME_USER1 => HTTP_PWD_USER1,
        HTTP_NAME_USER2 => HTTP_PWD_USER2
    ],
    "environment" => "REDIRECT_HTTP_AUTHORIZATION",
    "callback" => function ($arguments) use ($user) {
        $user->name = $arguments['user'];
        $user->setIdByName();
    }
]));

$db = new \myfinance\db\MysqlDB(DB_HOST, DB_USER, DB_PW, DB_NAME);
$context = new myfinance\FinanceContext($db,$user);

$app->get('/accounts(/:id)', function ($id=null) use($context) {
    $repository = myfinance\repositories\factories\AccountRepositoryFactory::create($context);
    $controller = new \myfinance\controller\AccountController($repository);
    echo $controller->get($id);
});

$app->run();


