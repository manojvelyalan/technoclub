<?php
namespace Technosmart\Controllers\Admin;
use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Register;
use Technosmart\Models\Discount;
class RequestController extends BaseController {
    public function viewAllRequest($request,$response){
        $allRequests = Register::where('isDelete',false)->orderBy('created_at', 'desc')->get();
        $data = [
            'title' => "List All Request",
            'allRequests'=>$allRequests,
        ];
        return $this->view->render($response,"admin/request/list.twig",$data);
    }

    public function dashboard($request, $response){
        return $this->view->render($response,"admin/dashboard.twig");
    }

    public function details($request, $response){
        $requestId =  $request->getParam('id');
        $request = Register::find($requestId);
        $programs = $request->programs;
        $payment = $request->payment;
        $discounts = false;
        if($request->discount_id != ""){
            $discountId = unserialize($request->discount_id);
            $discounts = Discount::whereIn('id', $discountId)->get();
        }
        $data = [
            'title'=>'Request Details',
            'request'=>$request,
            'programs'=>$programs,
            'discounts'=>$discounts,
            'payment'=>$payment
        ];
        return $this->view->render($response, "admin/request/details.twig",$data);
    }

    public function delete($request, $response){
       $requestId =  $request->getParam('id');
        if($requestId != ""){
            $request = Register::find($requestId) ->update(['isDelete' => true]);   
            $this->flash->addMessage('success','Successfully deleted...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the session id');
        }
        return $response->withRedirect($this->router->pathFor('viewallrequest'));
    
    }

}

?>