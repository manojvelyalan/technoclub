<?php
session_start();

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Illuminate\Database\Capsule\Manager;
use Slim\Flash\Messages;
use Slim\Csrf\Guard;

use Anddye\Mailer\Mailer;
use Technosmart\Controllers\HomeController;
use Technosmart\Controllers\CampController;
use Technosmart\Controllers\PaymentController;
use Technosmart\Validation\Validator;
use Technosmart\Middleware\OldDataMiddleware;
use Technosmart\Middleware\ValidationErrorMiddleware;
use Technosmart\Middleware\CSRFViewMiddleware;

use Technosmart\Controllers\Admin\AuthenticationController;
use Technosmart\Controllers\Admin\RequestController;
use Technosmart\Models\Admin\Authentication;
use Technosmart\Controllers\Admin\ProgramController;
use Technosmart\Controllers\Admin\DiscountController;
use Technosmart\Controllers\Admin\PromotionController;

use Technosmart\Controllers\Admin\TestController;
use Respect\Validation\Validator as v;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require __DIR__.'/../vendor/autoload.php';

$app  = new \Slim\App([
'settings'=>[
  'displayErrorDetails'=>true,

  'db'=>[
      'driver'=>'mysql',
      'host'=>'localhost',
      'database'=>'Technosmart',
      'username'=>'manoj',
      'password'=>'Manoj@1983',
      'charset'=>'utf8',
      'collation'=>'utf8_unicode_ci',
      'prefix'=>''
  ],
  'paypalConfig'=>[
  
   'client_id' => '***********',
    'client_secret' => '*********',
    'return_url' => 'https://technosmartkids.com/payment/response',
    'cancel_url' => 'https://technosmartkids.com/payment/cancelled',
    'enableSandbox'=>false,
  ],

]
]);

// pull the container from the slim application..
 $container = $app->getContainer();

 //connecting db..
 $capsule = new Manager;
 $capsule->addConnection($container['settings']['db']);
 $capsule->setAsGlobal();
 $capsule->bootEloquent();

 // attach the db settings in the container...

 $container['db'] = function($container) use($capsule){
   return $capsule;
 };
 $container['auth'] = function($container){
  return new Authentication;
};
// attach the view in the slim container..
 $container['view'] = function($container){
   // mention the path for view files..
   $view = new Twig(__DIR__.'/../resources/view',[
     'cache'=>false,
   ]);
   // add the useful twig extension for views...

   $view->addExtension(new TwigExtension(
      $container->router,
      $container->request->getUri()
    ));
    $view->getEnvironment()->addGlobal('auth',[
      'check'=>$container->auth->check(),
      'user'=>$container->auth->userDetails()
  ]);
    $view->getEnvironment()->addGlobal('flash',$container->flash);
    return $view;
 };

 // bind the HomeController...

 $app->add(new ValidationErrorMiddleware($container));
 $app->add(new OldDataMiddleware($container));
 $app->add(new CSRFViewMiddleware($container));

$container['HomeController'] = function($container){
   return new HomeController($container);
};
$container['DiscountController'] = function($container){
  return new DiscountController($container);
};
$container['CampController'] = function($container){
   return new CampController($container);
};
$container['validator'] = function($container){
  return new Validator;
};
$container['flash'] = function ($container) {
    return new Messages;
};
$container['AdminLoginController'] = function($container){
  return new AdminLoginController($container);
};
$container['PromotionController'] = function($container){
  return new PromotionController($container);
};
$container['ProgramController'] = function($container){
  return new ProgramController($container);
};
$container['RequestController'] = function($container){
  return new RequestController($container);
};
$container['PaymentController'] = function($container){
  return new PaymentController($container);
};
$container['TestController'] = function($container){
  return new TestController($container);
};

$container['AuthenticationController'] = function($container){
  return new AuthenticationController($container);
};

v::with('Technosmart\\Validation\\Rules\\');

$container['csrf'] = function($container){
    return new Guard;
};
$app->add($container->csrf);
$container['mailer'] = function($container) {
    $mailer = new Mailer($container['view'], [
        'host'      => 'localhost',  // SMTP Host
        'port'      => '25',  // SMTP Port
        'username'  => '',  // SMTPUsername
        'password'  => '',  // SMTP Password
        'protocol'  => ''   // SSL or TLS
    ]);
     $mailer->setDefaultFrom('admin@technosmartkids.com', 'Technosmartkids');
     return $mailer;
};
$container['apiContext'] = function($container){
  $apiContext = new ApiContext(new OAuthTokenCredential($container['settings']['paypalConfig']['client_id'], $container['settings']['paypalConfig']['client_secret']));
  $apiContext->setConfig([
      'mode' => $container['settings']['paypalConfig']['enableSandbox'] ? 'sandbox' : 'live'
  ]);
  return $apiContext;
};

require __DIR__.'/../technosmart/routes.php';
