<?php
namespace Technosmart\Controllers\Admin;

use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Discount;
use Technosmart\Models\Programs;
use Respect\Validation\Validator as v;

class DiscountController extends BaseController{

    public function list($request,$response){
        $data = [
            'title'=>'List All Discount',
            'discounts'=>Discount::where('status',0)->orderBy('created_at', 'desc')->get(),

        ];
        return $this->view->render($response,'admin/discount/list.twig',$data);
    }

    public function delete($request, $response){
        $discountId =  $request->getParam('id');
        if($discountId != ""){
            $discounts = Discount::find($discountId) ->update(['status' => true]);   
            $this->flash->addMessage('success','Successfully deleted...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the session id');
        }
        return $response->withRedirect($this->router->pathFor('listalldiscount'));
    
    }
    public function edit($request, $response){
        $discountId = $request->getParam('id');  
        $data = [
            'title'=>'Update Discount',
            'programs'=>Programs::where('status',0)->orderBy('programs','asc')->get(),
            'discountDetails'=>Discount::find($discountId),
        ];
        return $this->view->render($response,'admin/discount/edit.twig',$data);
    }

    public function postEdit($request, $response){
        $discountId =  $request->getParam('id');      
        $validation = $this->validator->validate($request,[
            'program'=>v::notEmpty()->setName('Program'),
            'amount'=>v::notEmpty()->numeric()->setName('Amount'),
            'startDate'=>v::notEmpty()->date()->setName('Start Date'),
            'endDate'=>v::notEmpty()->date()->setName('Start Date'),
            'title'=>v::notEmpty()->setName('Title'),
          ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('editdiscount')."?id=".$discountId);
        }
        if($discountId != ""){
            $programs = Discount::find($discountId) ->update([
                'programId' => $request->getParam('program'),
                'amount' => $request->getParam('amount'),
                'title' => $request->getParam('title'),
                'startDate'=>date("Y-m-d H:i:s",strtotime($request->getParam('startDate'))),
                'endDate'=>date("Y-m-d H:i:s",strtotime($request->getParam('endDate'))),
                'status'=>false,               
                ]);   
            $this->flash->addMessage('success','Successfully updated...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the discount id');
            
        }
        return $response->withRedirect($this->router->pathFor('listalldiscount'));
    }

    public function create($request, $response){
        $data = [
            'title'=>'Create Discount',
            'programs'=>Programs::where('status',0)->orderBy('programs','asc')->get(),
        ];

        return $this->view->render($response,'admin/discount/create.twig',$data);
    }

    public function postCreate($request, $response){
        $validation = $this->validator->validate($request,[
            'program'=>v::notEmpty()->setName('Program'),
            'amount'=>v::notEmpty()->numeric()->setName('Amount'),
            'startDate'=>v::notEmpty()->date()->setName('Start Date'),
            'endDate'=>v::notEmpty()->date()->setName('Start Date'),
            'title'=>v::notEmpty()->setName('Title'),
          ]);
          if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('adddiscount'));
          }
          Discount::create([
            'programId' => $request->getParam('program'),
            'amount' => $request->getParam('amount'),
            'title' => $request->getParam('title'),
            'startDate'=>date("Y-m-d H:i:s",strtotime($request->getParam('startDate'))),
            'endDate'=>date("Y-m-d H:i:s",strtotime($request->getParam('endDate'))),
            'status'=>false,
          ]);
          unset($_SESSION['old']);
          $this->flash->addMessage('success','Successfully added the discount');
          return $response->withRedirect($this->router->pathFor('listalldiscount'));
    }

}
?>