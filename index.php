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
$context = new myfinance\FinanceContext($db, $user);

$app->get('/accounts(/:id)', function ($id = null) use($context) {
    $repository = myfinance\repositories\factories\AccountRepositoryFactory::create($context);
    $controller = new \myfinance\controller\AccountController($repository);
    echo $controller->get($id);
});

$app->post('/accounts', function() use ($context, $app) {
    try {
        // get and decode JSON request body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);

        $repository = myfinance\repositories\factories\AccountRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountController($repository);
        $account = $controller->post($input);

        $app->response()->header('Content-Type', 'appliaction/json');
        echo json_encode($account);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->put('/accounts/:id', function($id) use ($context, $app) {
    try {
        // get and decode JSON request body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);

        $repository = myfinance\repositories\factories\AccountRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountController($repository);
        $account = $controller->put($input);

        $app->response()->header('Content-Type', 'appliaction/json');
        echo json_encode($account);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->delete('/accounts/:id', function($id) use ($context, $app) {
    try {
        $repository = myfinance\repositories\factories\AccountRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountController($repository);
        $account = $controller->delete($id);

        $app->response()->status(204);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->get('/accountingentries(/:id)', function ($id = null) use($context) {
    $repository = myfinance\repositories\factories\AccountingEntryRepositoryFactory::create($context);
    $controller = new \myfinance\controller\AccountingEntryController($repository);
    echo $controller->get($id);
});

$app->post('/accountingentries', function() use ($context, $app) {
    try {
        // get and decode JSON request body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);

        $repository = myfinance\repositories\factories\AccountingEntryRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountingEntryController($repository);
        $accountingEntry = $controller->post($input);

        $app->response()->header('Content-Type', 'appliaction/json');
        echo json_encode($accountingEntry);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->put('/accountingentries/:id', function($id) use ($context, $app) {
    try {
        // get and decode JSON request body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);

        $repository = myfinance\repositories\factories\AccountingEntryRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountingEntryController($repository);
        $accountingEntry = $controller->put($input);

        $app->response()->header('Content-Type', 'appliaction/json');
        echo json_encode($accountingEntry);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->delete('/accountingentries/:id', function($id) use ($context, $app) {
    try {
        $repository = myfinance\repositories\factories\AccountingEntryRepositoryFactory::create($context);
        $controller = new \myfinance\controller\AccountingEntryController($repository);
        $accountingEntry = $controller->delete($id);

        $app->response()->status(204);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', makePrettyException($e));
    }
});

$app->run();

/**
 * Hilfsfunktion um schöne Exception-Strings erstellen zu können. Anstatt $e->getMessage() im catch-Block aufzurufen
 * 
 * @param Exception $e
 * @return String
 */
function makePrettyException(Exception $e) {
    $trace = $e->getTrace();
    $result = 'Exception: "';
    $result .= $e->getMessage();
    $result .= '" @ ';
    if ($trace[0]['class'] != '') {
        $result .= $trace[0]['class'];
        $result .= '->';
    }
    $result .= $trace[0]['function'];
    $result .= '();<br />';
    return $result;
}
