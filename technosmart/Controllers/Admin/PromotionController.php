<?php
namespace Technosmart\Controllers\Admin;

use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Promotion;
use Respect\Validation\Validator as v;

class PromotionController extends BaseController{

    public function list($request,$response){
        $data = [
            'title'=>'List All Promotions',
            'promotions'=>Promotion::where('status',0)->orderBy('created_at', 'desc')->get(),

        ];
        return $this->view->render($response,'admin/promotion/list.twig',$data);
    }

    public function delete($request, $response){
        $promotionId =  $request->getParam('id');
        if($promotionId != ""){
            $discounts = Promotion::find($promotionId) ->update(['status' => true]);   
            $this->flash->addMessage('success','Successfully deleted...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the session id');
        }
        return $response->withRedirect($this->router->pathFor('listallpromotion'));
    
    }
    public function edit($request, $response){
        $promotionId = $request->getParam('id');  
        $data = [
            'title'=>'Update Promotion',
            'promotionDetails'=>Promotion::find($promotionId),
        ];
        return $this->view->render($response,'admin/promotion/edit.twig',$data);
    }

    public function postEdit($request, $response){
        $promotionId =  $request->getParam('id');      
        $validation = $this->validator->validate($request,[
            'code'=>v::notEmpty()->setName('Promotion Code'),
            'amount'=>v::notEmpty()->numeric()->setName('Amount'),
          ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('editpromotion')."?id=".$promotionId);
        }
        if($promotionId != ""){
            $programs = Promotion::find($promotionId) ->update([
                'code' => $request->getParam('code'),
                'amount' => $request->getParam('amount'),
                'title' => $request->getParam('title'),
                'startDate'=>($request->getParam('startDate')!= "")?date("Y-m-d H:i:s",strtotime($request->getParam('startDate'))):NULL,
                'endDate'=>($request->getParam('startDate')!= "")?date("Y-m-d H:i:s",strtotime($request->getParam('endDate'))):NULL,
                'status'=>false,            
                ]);   
            $this->flash->addMessage('success','Successfully updated...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the discount id');
            
        }
        return $response->withRedirect($this->router->pathFor('listallpromotion'));
    }

    public function create($request, $response){
        $data = [
            'title'=>'Create Promotion',
        ];

        return $this->view->render($response,'admin/promotion/create.twig',$data);
    }

    public function postCreate($request, $response){
       
        $validation = $this->validator->validate($request,[
            'code'=>v::notEmpty()->setName('Promotion Code'),
            'amount'=>v::notEmpty()->numeric()->setName('Amount'),
          ]);
          if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('addpromotion'));
          }
          Promotion::create([
            'code' => $request->getParam('code'),
            'amount' => $request->getParam('amount'),
            'title' => $request->getParam('title'),
            'startDate'=> null,
            'endDate'=> null,
            'status'=>false,
          ]);
          unset($_SESSION['old']);
          $this->flash->addMessage('success','Successfully added the discount');
          return $response->withRedirect($this->router->pathFor('listallpromotion'));
    }

}
?>