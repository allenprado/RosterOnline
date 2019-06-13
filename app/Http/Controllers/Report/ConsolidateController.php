<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IConsolidateRepository;
use App;
use Validator;
use Illuminate\Validation\Rule;


class ConsolidateController extends Controller
{

    private $route = 'consolidates';
    private $paginate = 10;
    private $search = ['id','week','company_id'];
    private $model;

    function __construct(IConsolidateRepository $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(IConsolidateRepository $model, Request $request)
     {


         $page = $this->model->transWord('consolidate');
         $columnList = ['week' => $this->model->transWord('week'),
         'company_id' => $this->model->transWord('company_id'),
         'q_hours' => $this->model->transWord('q_hours'),
         'vl_salary' => $this->model->transWord('vl_salary'),
       ];
         $search = "";
         $routeName = $this->route;

         if(isset($request->search))
         {
             $search = $request->search;
             $list = $model->findWhereLike(['id','week'],$search,'id','DESC');
         }else{
             $list = $model->paginate($this->paginate, 'id', 'DESC');
         }






         $user = auth()->user();
         $listRel = $user->companies;
         $listRel2 = $user->specialhours;


          //Format DATETIME to DATE and COMPANY ID to COMPANY NAME
         foreach ($list->all() as $key => $value) {

           $list[$key]['q_hours'] = number_format($value->q_hours,2,'.','');
           $list[$key]['vl_salary'] = number_format($value->vl_salary,2,'.','');

              foreach ($listRel as $key2 => $value2)
              {
                 if($value2->id == $value->company_id)
                 {
                    $list[$key]['company_id'] = $value2->name;


                 }
              }
         }

         $breadcumber = [
             (object)['url'=>route('home'),'title'=>$this->model->transWord('home')],
             (object)['url'=>'','title'=>$this->model->transWord('list',$page)],
         ];

        return view('report.'.$routeName.'.index',compact('list', 'search','page','routeName','columnList','breadcumber'));
     }
}
