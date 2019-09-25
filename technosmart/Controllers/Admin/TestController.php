<?php
namespace Technosmart\Controllers\Admin;
use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Register;
use Technosmart\Models\Discount;
class TestController extends BaseController {
    public function viewAllRequest($request,$response){
        $allRequests = Register::where('isDelete',false)->orderBy('created_at', 'desc')->get();
        $data = [
            'title' => "List All Request",
            'allRequests'=>$allRequests,
        ];
        return $this->view->render($response,"admin/test/test.twig",$data);
    }

  }
