<?php
namespace Technosmart\Controllers;
use Technosmart\Models\Programs;
use Technosmart\Models\Session;
use Technosmart\Models\Pickup;
use Technosmart\Models\Register;
use Technosmart\Models\ProgramCategory;
use Technosmart\Models\Common;
use Respect\Validation\Validator as v;
use Technosmart\Controllers\Controller as BaseController;

class HomeController extends BaseController {


    public function index($request,$response){
      $data = ['title' => "Home | Coding, Robotics, STEM and Art Summer camps in Sammamish",
              'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
              'navStatus'=>false,
              'home'=>'id="current"',
          ];
      return $this->view->render($response,"home.twig",$data);
    }
    public function technoclub($request,$response){
      $categories = ProgramCategory::where('status',1)->get();
      //$programs = Programs::where('status',false)->get();
      $data = [
              'title' => "Home | Technosmart",
              'categories'=>$categories,
              'navStatus'=>true,
              'programOffered'=>'id="current"',
          ];

      return $this->view->render($response,"technoclub.twig",$data);
    }
    public function programDetails($request, $response){
      $programDetails = Programs::find($request->getParam('id'));
      $data = [
              'title' => "Home | Program Details",
              'programDetails'=>$programDetails,
              'navStatus'=>true,
              'programOffered'=>'id="current"',
      ];
      return $this->view->render($response,"programdetails.twig",$data);
    }


  public function contact($request,$response){

    $data = ['title' => "Home | Technosmart",
            'navStatus'=>false,
            'contact'=>'id="current"',
            'findusValues'=>['test','test1','test2','test3'],
        ];
     return $this->view->render($response,"contact.twig",$data);
  }
  public function postContact($request , $response){
      $validation = $this->validator->validate($request,[
      'name'=>v::notEmpty()->alpha(),
      'email'=>v::notEmpty()->email()->noWhitespace(),
      'message'=>v::notEmpty(),
    ]);
    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('contact'));
    }
    $contact['name'] = $request->getParam('name');
    $contact['email'] = $request->getParam('email');
    $contact['message'] = $request->getParam('message');
    $contact['subject'] = "Technosmartkids - Contact Us - Message";
    $contact["toName"] = 'Technosmartkids';
    $contact["toEmail"] = 'technosmartkids@outlook.com';
    //$contact["toEmail"] = 'manojvelyalan@gmail.com';

    $this->mailer->sendMessage('email/contact.twig', ['contact' => $contact], function($message) use($contact) {
         $message->setTo($contact["toEmail"], $contact["toName"]);
         $message->setSubject($contact['subject']);
     });



    $this->flash->addMessage('mailsuccess','Mail has been sent successfully.');
    return $response->withRedirect($this->router->pathFor('contact'));
  }
  public function register($request,$response){
      $programs = Programs::where('status',false)->orderBy('position')->get();

      $pickUps = Pickup::all();
      $data = [     'title' => "Home | Technosmart",
                  'programs'=>$programs,
                  'register'=>'id="current"',
                  'pickUps'=>$pickUps,
                    'navStatus'=>false,
                ];

   return $this->view->render($response,"register.twig",$data);
  }

  public function foundation($request,$response){
      $data = ['title' => "Home | Foundation ",
            'navStatus'=>true,
            'programDescription'=>'id="current"',
          ];
      return $this->view->render($response,"foundation.twig",$data);
  }
  public function codingpath($request,$response){
      $data = ['title' => "Home | Coding Path",
            'navStatus'=>true,
            'programDescription'=>'id="current"',
          ];
      return $this->view->render($response,"codingpath.twig",$data);
  }
  public function robotics($request,$response){
      $data = ['title' => "Home | Robotics",
            'navStatus'=>true,
            'programDescription'=>'id="current"',
          ];
      return $this->view->render($response,"robotics.twig",$data);
  }
  public function digitalart($request,$response){
      $data = ['title' => "Home | Digital Art ",
            'navStatus'=>true,
            'programDescription'=>'id="current"',
          ];
      return $this->view->render($response,"digitalart.twig",$data);
  }
  public function faq($request,$response){

      $data = ['title' => "Home | Faq ",
          'navStatus'=>true,
          'faq'=>'id="current"',
          ];
      return $this->view->render($response,"faq.twig",$data);
  }

  public function postRegister($request,$response){
    $validation = $this->validator->validate($request,[
      'firstName'=>v::notEmpty()->alpha()->setName('First Name'),
      'lastName'=>v::notEmpty()->alpha()->setName('Last Name'),
      'grade'=>v::notEmpty()->numeric()->setName('Grade'),
      'school'=>v::notEmpty()->setName('School Name'),
      'age'=>v::notEmpty()->numeric()->setName('Age'),
      'programs'=>v::notEmpty()->setName('Program / Session'),
      'email'=>v::notEmpty()->email()->noWhitespace()->setName('Email'),
      'parentName'=>v::notEmpty()->alpha()->setName('Parent Name'),
      'phone'=>v::notEmpty()->numeric()->setName('Phone'),
      'emergencyName'=>v::notEmpty()->alpha()->setName('Emergency Name'),
      'emergencyNumber'=>v::notEmpty()->numeric()->setName('Emergency Number'),
      'pickupOption'=>v::notEmpty()->setName('Pick Up Option'),
      'terms'=>v::notEmpty()->setName('Terms & Condition'),
    ]);
    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('studentregister'));
    }
    $programs = $request->getParam('programs');


    $program = [];
    $totalAmount = 0;
    $discount = 0;
    $discountIds = [];
    $allPrograms = Programs::whereIn('id', $programs)->get();

    foreach($allPrograms as $allprogram){
      $totalAmount = $totalAmount + $allprogram->fee;
      $discountDetails = Register::getDiscount($allprogram->id);
      if($discountDetails != false){
          $discount += $discountDetails->amount;
          array_push($discountIds,$discountDetails->id);
      }
    }
      $usbAmount = ($request->getParam('isUsb') == 'yes')? 6 : 0;
      $subTotal =  $totalAmount - $discount + $usbAmount;
      $register = Register::create([
      'first_name' => $request->getParam('firstName'),
      'last_name' => $request->getParam('lastName'),
      'grade' => $request->getParam('grade'),
      'school_name' => $request->getParam('school'),
      'age' => $request->getParam('age'),
      //'programs' => $request->getParam('programs'),
      'parent_name' => $request->getParam('parentName'),
      'email' => $request->getParam('email'),
      'phone' => $request->getParam('phone'),
      'emergency_name' => $request->getParam('emergencyName'),
      'emergency_number' => $request->getParam('emergencyNumber'),
      'pickup' => $request->getParam('pickupOption'),
      'is_usb'=>($request->getParam('isUsb') == 'yes')? 1 : 0,
      'status'=>'not paid',
      'isDelete'=>false,
      'total_amount'=> $totalAmount,
      'discount_amount'=> $discount,
      'grand_total'=>$subTotal,
      'discount_id' =>(count($discountIds) > 0) ? serialize($discountIds):null,
    ]);

    $register->programs()->attach($programs);

  /*  $contact['subject'] = "New Registration has been submitted";
    $contact["toName"] = 'Technosmartkids';
    //$contact["toEmail"] = 'technosmartkids@outlook.com';
    $contact['id'] = $register->id;
    $contact["toEmail"] = 'manojvelyalan@gmail.com';
    $this->mailer->sendMessage('email/register.twig', ['contact' => $contact], function($message) use($contact) {
         $message->setTo($contact["toEmail"], $contact["toName"]);
         $message->setSubject($contact['subject']);
     });*/

    unset($_SESSION['old']);

    $this->flash->addMessage('success','You have been registered successfully..');
    $encoded = Common::encryptOrDecrypt('encrypt',$register->id);
    return $response->withRedirect($this->router->pathFor('payment')."?id=$encoded");
  }
}
