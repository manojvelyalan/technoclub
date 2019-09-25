<?php
use Technosmart\Middleware\AuthMiddleware;
use Technosmart\Middleware\GuestMiddleware;

$app->get("/",'HomeController:index')->setName('home');
$app->get("/technoclub",'HomeController:technoclub')->setName('technoclub');
$app->get("/pgmdetail",'HomeController:programDetails')->setName('programdetails');
$app->get("/contact",'HomeController:contact')->setName('contact');
$app->post("/contact",'HomeController:postContact');
$app->get("/register",'HomeController:register')->setName('studentregister');
$app->post("/register",'HomeController:postRegister');
$app->get("/payment","PaymentController:payment")->setName('payment');
$app->get("/test","TestController:viewAllRequest")->setName('test');




$app->get("/program/foundation",'HomeController:foundation')->setName('foundation');
$app->get("/program/codingpath",'HomeController:codingpath')->setName('codingpath');
$app->get("/program/robotics",'HomeController:robotics')->setName('robotics');
$app->get("/program/digitalart",'HomeController:digitalart')->setName('digitalart');
$app->get("/faq",'HomeController:faq')->setName('faq');


$app->get("/camps/fulldaysummercamp",'CampController:fulldaySummerCamp')->setName('fulldaysummercamp');
$app->get("/camps/halfdaysummercamp",'CampController:halfdaySummerCamp')->setName('halfdaysummercamp');
$app->get("/camps/gamingandanimationwithscratch",'CampController:gaming')->setName('gaming');
$app->get("/camps/introtoscratch",'CampController:introtoscratch')->setName('introtoscratch');
$app->get("/camps/scratchcoding",'CampController:scratchcoding')->setName('scratchcoding');
$app->get("/camps/scratchcoding2",'CampController:scratchcoding2')->setName('scratchcoding2');
$app->get("/camps/funwithscience",'CampController:fun')->setName('fun');
$app->get("/camps/coumpterfoundationwithart1",'CampController:art')->setName('art');
$app->get("/camps/coumpterfoundationwithart2",'CampController:art1')->setName('art1');
$app->get("/camps/pythoncoding",'CampController:python')->setName('python');
$app->get("/camps/pythoncoding1",'CampController:python1')->setName('python1');
$app->get("/camps/pythoncoding2",'CampController:python2')->setName('python2');
$app->get("/camps/javacoding",'CampController:java')->setName('java');
$app->get("/camps/javacoding2",'CampController:java2')->setName('java2');
$app->get("/camps/sewing",'CampController:sewing')->setName('sewing');
$app->get("/camps/engineeringadventuresbybricks4kidz",'CampController:adventures')->setName('adventures');
$app->get("/camps/photographyandimageediting",'CampController:imageediting')->setName('imageediting');
$app->get("/camps/adventures",'CampController:adventures')->setName('adventures');
$app->get("/camps/artblend",'CampController:artblend')->setName('artblend');
$app->get("/camps/cartoon",'CampController:cartoon')->setName('cartoon');
$app->get("/camps/fasion",'CampController:fasion')->setName('fasion');
$app->get("/camps/artsmart",'CampController:artsmart')->setName('artsmart');

$app->get("/camps/roboticswithev3",'CampController:ev')->setName('ev');
$app->get("/camps/youtubing",'CampController:youtubing')->setName('youtubing');
$app->get("/camps/drawingartbyyoungrembrandts",'CampController:drawing')->setName('drawing');
$app->get("/camps/campdescription",'CampController:campdescription')->setName('campdescription');
$app->get("/sendmail",'CampController:sendMail')->setName('sendMail');

$app->post("/payment/request",'PaymentController:request')->setName('paypalrequest');
$app->get("/payment/response",'PaymentController:response')->setName('paypalresponse');
$app->get("/payment/success",'PaymentController:success')->setName('paypalsuccess');
$app->get("/payment/failed",'PaymentController:failed')->setName('paypalfailed');
$app->get("/payment/cancelled",'PaymentController:cancelled')->setName('paypalcancelled');
//admin
$app->group("", function(){
    //admin authentication...

    $this->get("/admin/login",'AuthenticationController:getSignIn')->setName('adminsignin');
    $this->post("/admin/login",'AuthenticationController:postSignIn');




})->add(new GuestMiddleware($container));

$app->group('',function(){

    // admin creation...

    $this->get("/admin/signup",'AuthenticationController:getSignUp')->setName('adminsignup');
    $this->post("/admin/signup",'AuthenticationController:postSignUp');

    $this->get("/admin/signout",'AuthenticationController:getSignOut')->setName('signout');

    // dashboard...

    $this->get("/admin/dashboard",'RequestController:dashboard')->setName('dashboard');

     // request ...

    $this->get("/admin/request/view",'RequestController:viewAllRequest')->setName('viewallrequest');
    $this->get("/admin/request/details",'RequestController:details')->setName('requestdetails');
    $this->get("/admin/request/delete",'RequestController:delete')->setName('deleterequest');

    // programs..

    $this->get("/admin/program/list",'ProgramController:list')->setName('listallprograms');
    $this->get("/admin/program/edit",'ProgramController:edit')->setName('editprogram');
    $this->post("/admin/program/edit",'ProgramController:postEdit');
    $this->get("/admin/program/delete",'ProgramController:delete')->setName('deleteprogram');
    $this->get("/admin/program/create",'ProgramController:create')->setName('addprogram');
    $this->post("/admin/program/create",'ProgramController:postCreate');
    $this->get("/admin/program/details",'ProgramController:details')->setName('programdetail');

    // discount

    $this->get("/admin/discount/list",'DiscountController:list')->setName('listalldiscount');
    $this->get("/admin/discount/delete",'DiscountController:delete')->setName('deletediscount');
    $this->get("/admin/discount/edit",'DiscountController:edit')->setName('editdiscount');
    $this->post("/admin/discount/edit",'DiscountController:postEdit');
    $this->get("/admin/discount/create",'DiscountController:create')->setName('adddiscount');
    $this->post("/admin/discount/create",'DiscountController:postCreate');

    // promotion

    $this->get("/admin/promotion/list",'PromotionController:list')->setName('listallpromotion');
    $this->get("/admin/promotion/delete",'PromotionController:delete')->setName('deletepromotion');
    $this->get("/admin/promotion/edit",'PromotionController:edit')->setName('editpromotion');
    $this->post("/admin/promotion/edit",'PromotionController:postEdit');
    $this->get("/admin/promotion/create",'PromotionController:create')->setName('addpromotion');
    $this->post("/admin/promotion/create",'PromotionController:postCreate');


})->add( new AuthMiddleware($container));
