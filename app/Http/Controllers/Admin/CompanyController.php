<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICompanyRepository;
use App;
use Validator;
use Illuminate\Validation\Rule;


class CompanyController extends Controller
{

    private $route = 'companies';
    private $paginate = 10;
    private $search = ['id','name','valHour'];
    private $model;

    function __construct(ICompanyRepository $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(ICompanyRepository $model, Request $request)
     {

         $page = $this->model->transWord('company_list');
         $columnList = ['id' => '#',
         'name' => $this->model->transWord('name'),
         'valHour' => $this->model->transWord('valHour'),
       ];
         $search = "";
         $routeName = $this->route;


         if(isset($request->search))
         {
             $search = $request->search;
             $list = $model->findWhereLike(['id','name','valHour'],$search,'id','DESC');
         }else{
             $list = $model->paginate($this->paginate, 'id', 'DESC');
         }

         $breadcumber = [
             (object)['url'=>route('home'),'title'=>$this->model->transWord('home')],
             (object)['url'=>'','title'=>$this->model->transWord('list',$page)],
         ];

        return view('admin.'.$routeName.'.index',compact('list', 'search','page','routeName','columnList','breadcumber'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $routeName = $this->route;
         $page = $this->model->transWord('company_list');
         $page_create = $this->model->transWord('company');

         $breadcumber = [
             (object)['url'=>route('home'),'title'=>$this->model->transWord('home')],
             (object)['url'=>route($routeName.'.index'),'title'=>$this->model->transWord('list',$page)],
             (object)['url'=>'','title'=>$this->model->transWord('create_crud',$page_create)],
         ];

         return view('admin.'.$routeName.'.create',compact( 'page','page_create','routeName','breadcumber'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        $data = $request->all();


        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'valHour' => ['required'],
        ])->validate();



        if($this->model->create($data)){

            session()->flash('msg', $this->model->transWord('company_registered'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_company_registered'));
            session()->flash('status', 'error'); //Success error notification
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);
        if($register) {

            $page = $this->model->transWord('company_list');
            $page2 = $this->model->transWord('company');

            $breadcumber = [
                (object)['url' => route('home'), 'title' => $this->model->transWord('home')],
                (object)['url' => route($routeName . '.index'), 'title' => $this->model->transWord('list', $page)],
                (object)array('url' => '', 'title' => $this->model->transWord('show_crud', $page2)),
            ];

            $delete = false;

            if($request->delete ?? false)
            {
                session()->flash('msg', $this->model->transWord('delete_ask'));
                session()->flash('status', 'notification'); //Success error notification
                $delete = true;
            }

            return view('admin.' . $routeName . '.show', compact('register','page', 'page2', 'routeName', 'breadcumber','delete'));

        }else{

            return redirect()->route($routeName.'.show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);
        if($register) {

            $page = $this->model->transWord('company_list');
            $page2 = $this->model->transWord('company');

            $breadcumber = [
                (object)['url' => route('home'), 'title' => $this->model->transWord('home')],
                (object)['url' => route($routeName . '.index'), 'title' => $this->model->transWord('list', $page)],
                (object)array('url' => '', 'title' => $this->model->transWord('edit_crud', $page2)),
            ];

            return view('admin.' . $routeName . '.edit', compact('register','page', 'page2', 'routeName', 'breadcumber'));

        }else{

            return redirect()->route($routeName.'.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();


        Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'valHour' => ['required'],
        ])->validate();

        if($this->model->update($data,$id)){

            session()->flash('msg', $this->model->transWord('company_updated'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_company_updated'));
            session()->flash('status', 'error'); //Success error notification
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {


        if($this->model->delete($id)){

            session()->flash('msg', $this->model->transWord('company_deleted'));
            session()->flash('status', 'success'); //Success error notification
        }else{
            session()->flash('msg', $this->model->transWord('error_company_deleted'));
            session()->flash('status', 'error'); //Success error notification
        }

        $routeName = $this->route;
        return redirect()->route($routeName.'.index');
    }
}
