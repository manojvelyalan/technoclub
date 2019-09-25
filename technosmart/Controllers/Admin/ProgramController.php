<?php
namespace Technosmart\Controllers\Admin;

use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Programs;
use Technosmart\Models\ProgramCategory;
use Respect\Validation\Validator as v;

class ProgramController extends BaseController {
    public function list($request, $response){
        $data = [
            'title'=>'List All Programs',
            'programs'=>Programs::where('status',0)->orderBy('position')->get(),
        ];
        return $this->view->render($response,'admin/programs/list.twig',$data);
    }
    public function edit($request, $response){

        $programsId =  $request->getParam('id');
        $data = [
            'title'=>'Update Programs',
            'days'=>['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
            'programDetails'=>Programs::find($programsId),
            'categories'=> ProgramCategory::where('status',true)->get(),
        ];
            return $this->view->render($response,'admin/programs/edit.twig',$data);
    }
    public function postEdit($request,$response){
        $programsId =  $request->getParam('id');
        $validation = $this->validator->validate($request,[
            'program'=>v::notEmpty()->setName('Program'),
            'fee'=>v::notEmpty()->numeric()->setName('Fee'),
            'seat'=>v::notEmpty()->digit()->setName('Seat'),
            'startDate'=>v::notEmpty()->date()->setName('Start Date'),
            'endDate'=>v::notEmpty()->date()->setName('End Date'),
            'programTime'=>v::notEmpty()->setName('Time'),
            'position'=>v::notEmpty()->setName('Position'),
            'category'=>v::notEmpty()->setName('Program Category'),
        ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('editprogram')."?id=".$programsId);
        }
        if($programsId != ""){
            $programs = Programs::find($programsId) ->update([
                'programs' => $request->getParam('program'),
                'day' => $request->getParam('days'),
                'start_date' => date("Y-m-d H:i:s",strtotime($request->getParam('startDate'))),
                'end_date' => date("Y-m-d H:i:s",strtotime($request->getParam('endDate'))),
                'grade' => $request->getParam('grade'),
                'time' => $request->getParam('programTime'),
                'seat' => $request->getParam('seat'),
                'fee' => $request->getParam('fee'),
                'description' => $request->getParam('description'),
                'position' => $request->getParam('position'),
                'program_category_id'=> $request->getParam('category'),
                'status' => false,

                ]);
            $this->flash->addMessage('success','Successfully updated...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the program id');

        }
        return $response->withRedirect($this->router->pathFor('listallprograms'));
    }
    public function delete($request, $response){
        $programsId =  $request->getParam('id');
        if($programsId != ""){
            $programs = Programs::find($programsId) ->update(['status' => true]);
            $this->flash->addMessage('success','Successfully deleted...');
        }else{
            $this->flash->addMessage('error','Sorry , you should provide the session id');
        }
        return $response->withRedirect($this->router->pathFor('listallprograms'));

    }

    public function create($request, $response){
        $data = [
            'title'=>'Add Programs',
            'days'=>['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
            'categories'=> ProgramCategory::where('status',true)->get(),
        ];
        return $this->view->render($response,'admin/programs/create.twig',$data);
    }
    public function postCreate($request,$response){
        $validation = $this->validator->validate($request,[
            'program'=>v::notEmpty()->setName('Program'),
            'fee'=>v::notEmpty()->numeric()->setName('Fee'),
            'seat'=>v::notEmpty()->digit()->setName('Seat'),
            'startDate'=>v::notEmpty()->date()->setName('Start Date'),
            'endDate'=>v::notEmpty()->date()->setName('End Date'),
            'programTime'=>v::notEmpty()->setName('Time'),
            'position'=>v::notEmpty()->setName('Position'),
            'category'=>v::notEmpty()->setName('Program Category'),
          ]);
          if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('addprogram'));
          }
          Programs::create([
            'programs' => $request->getParam('program'),
            'day' => $request->getParam('days'),
            'start_date' => date("Y-m-d H:i:s",strtotime($request->getParam('startDate'))),
            'end_date' => date("Y-m-d H:i:s",strtotime($request->getParam('endDate'))),
            'grade' => $request->getParam('grade'),
            'time' => $request->getParam('programTime'),
            'seat' => $request->getParam('seat'),
            'fee' => $request->getParam('fee'),
            'description' => $request->getParam('description'),
            'position' => $request->getParam('position'),
            'program_category_id'=> $request->getParam('category'),
            'status' => false,
          ]);
          unset($_SESSION['old']);
          $this->flash->addMessage('success','Successfully added the programs');
          return $response->withRedirect($this->router->pathFor('listallprograms'));
    }
    public function details($request, $response){
        $programId = $request->getParam('id');

        $data = [
            'title'=>'Prgram Details',
            'details'=>Programs::find($programId),
        ];

        return $this->view->render($response,'admin/programs/details.twig',$data);
    }
}
