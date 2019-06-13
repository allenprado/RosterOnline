<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPermissionRepository;
use App;
use Validator;
use Illuminate\Validation\Rule;


class PermissionController extends Controller
{

    private $route = 'permissions';
    private $paginate = 10;
    private $search = ['id','name','description'];
    private $model;

    function __construct(IPermissionRepository $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(IPermissionRepository $model, Request $request)
     {

         $page = $this->model->transWord('permission_list');
         $columnList = $this->model->builderTable2();
         $search = "";
         $routeName = $this->route;


         if(isset($request->search))
         {
             $search = $request->search;
             $list = $model->findWhereLike(['id','name','description'],$search,'id','DESC');
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
         $page = $this->model->transWord('permission_list');
         $page_create = $this->model->transWord('permission');

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
            'description' => ['required', 'string', 'max:300'],
        ])->validate();

        if($this->model->create($data)){

            session()->flash('msg', $this->model->transWord('Permission_registered'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_permission_registered'));
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

            $page = $this->model->transWord('permission_list');
            $page2 = $this->model->transWord('permission');

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

            $page = $this->model->transWord('permission_list');
            $page2 = $this->model->transWord('permission');

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
          'description' => ['required', 'string', 'max:300'],
        ])->validate();

        if($this->model->update($data,$id)){

            session()->flash('msg', $this->model->transWord('Permission_updated'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_permission_updated'));
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

            session()->flash('msg', $this->model->transWord('Permission_deleted'));
            session()->flash('status', 'success'); //Success error notification
        }else{
            session()->flash('msg', $this->model->transWord('error_permission_deleted'));
            session()->flash('status', 'error'); //Success error notification
        }

        $routeName = $this->route;
        return redirect()->route($routeName.'.index');
    }
}
