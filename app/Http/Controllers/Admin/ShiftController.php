<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IShiftRepository;
use App;
use Validator;
use Illuminate\Validation\Rule;


class ShiftController extends Controller
{

    private $route = 'shifts';
    private $paginate = 10;
    private $search = ['id','date','hourStart','hourEnd','breakTime','hourSpec','week'];
    private $model;

    function __construct(IShiftRepository $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(IShiftRepository $model, Request $request)
     {


         $page = $this->model->transWord('shift_list');
         $columnList = ['id' => '#',
         'date' => $this->model->transWord('date'),
         'week' => $this->model->transWord('week'),
         'company_id' => $this->model->transWord('company_id'),
         'hourStart' => $this->model->transWord('hourStart'),
         'hourEnd' => $this->model->transWord('hourEnd'),
         'breakTime' => $this->model->transWord('breakTime'),
         'total_day' => $this->model->transWord('total_day'),
         'total_money' => $this->model->transWord('total_money'),
         'hourSpec' => $this->model->transWord('hourSpec'),

       ];
         $search = "";
         $routeName = $this->route;

         if(isset($request->search))
         {
             $search = $request->search;
             $list = $model->findWhereLike(['id','date','week'],$search,'id','DESC');
         }else{
             $list = $model->paginate($this->paginate, 'id', 'DESC');
         }

         $user = auth()->user();
         $listRel = $user->companies;
         $listRel2 = $user->specialhours;


          //Format DATETIME to DATE and COMPANY ID to COMPANY NAME
         foreach ($list->all() as $key => $value) {

              $list[$key]['date'] = $this->model->dateDisplay($value->date);

              foreach ($listRel as $key2 => $value2)
              {
                 if($value2->id == $value->company_id)
                 {
                    $list[$key]['company_id'] = $value2->name;

                    $total_day = $this->model->calcHoursTot($value->hourStart,$value->hourEnd, $value->breakTime);
                    $list[$key]['total_day'] = $total_day;

                    foreach ($listRel2 as $key4 => $value4) {
                      if($value4->id == $value->hourSpec){
                        $list[$key]['total_money'] = $this->model->calcHoursValue($total_day,$value2->valHour,$value4->operator,$value4->value);
                      }

                    }

                 }
              }

              foreach ($listRel2 as $key3 => $value3)
              {
                 if($value3->id == $value->hourSpec)
                 {
                    $list[$key]['hourSpec'] = $value3->name;
                 }
              }
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
         $page = $this->model->transWord('shift_list');
         $page_create = $this->model->transWord('shift');

         $user = auth()->user();
         $listRel = $user->companies;
         $listRel2 = $user->specialhours;

         $breadcumber = [
             (object)['url'=>route('home'),'title'=>$this->model->transWord('home')],
             (object)['url'=>route($routeName.'.index'),'title'=>$this->model->transWord('list',$page)],
             (object)['url'=>'','title'=>$this->model->transWord('create_crud',$page_create)],
         ];

         return view('admin.'.$routeName.'.create',compact( 'page','page_create','routeName','breadcumber','listRel','listRel2'));
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
            'date' => ['required'],
            'hourStart' => ['required'],
            'hourEnd' => ['required'],
            'breakTime' => ['required'],
            'company_id' => ['required'],
            'hourSpec' => ['required'],

        ])->validate();



        if($this->model->create($data)){

            session()->flash('msg', $this->model->transWord('shift_registered'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_shift_registered'));
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

            //Format DATETIME to DATE and COMPANY ID to COMPANY NAME
            $register['date'] = $this->model->dateDisplay($register['date']);

            $user = auth()->user();
            $listRel = $user->companies;
            $listRel2 = $user->specialhours;

            foreach ($listRel2 as $key => $value)
            {
               if($value->id == $register->hourSpec)
               {


                  $register['hourSpec'] = $value->name;
                  $total_day =  $this->model->calcHoursTot($register->hourStart,$register->hourEnd, $register->breakTime);
                  $register['total_day'] = $total_day;

                  foreach ($listRel as $key2 => $value2)
                  {

                     if($value2->id == $register->company_id)
                     {

                        $register['total_money'] = $this->model->calcHoursValue($total_day,$value2->valHour,$value->operator,$value->value);
                     }
                  }

               }


            foreach ($listRel as $key => $value)
            {
               if($value->id == $register->company_id)
               {
                  $register['company_name'] = $value->name;
               }
            }



            }



            $page = $this->model->transWord('shift_list');
            $page2 = $this->model->transWord('shift');

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

            $page = $this->model->transWord('shift_list');
            $page2 = $this->model->transWord('shift');

            $user = auth()->user();
            $listRel = $user->companies;
            $listRel2 = $user->specialhours;
            $register_specialhours = $register->hourSpec;

            $breadcumber = [
                (object)['url' => route('home'), 'title' => $this->model->transWord('home')],
                (object)['url' => route($routeName . '.index'), 'title' => $this->model->transWord('list', $page)],
                (object)array('url' => '', 'title' => $this->model->transWord('edit_crud', $page2)),
            ];

            return view('admin.' . $routeName . '.edit', compact('register','register_specialhours','page', 'page2', 'routeName', 'breadcumber','listRel','listRel2'));

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
            'date' => ['required'],
            'hourStart' => ['required'],
            'hourEnd' => ['required'],
            'breakTime' => ['required'],
            'company_id' => ['required'],
            'hourSpec' => ['required'],

        ])->validate();


        if($this->model->update($data,$id)){

            session()->flash('msg', $this->model->transWord('shift_updated'));
            session()->flash('status', 'success'); //Success error notification
            return redirect()->back();

        }else{
            session()->flash('msg', $this->model->transWord('error_shift_updated'));
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

            session()->flash('msg', $this->model->transWord('shift_deleted'));
            session()->flash('status', 'success'); //Success error notification
        }else{
            session()->flash('msg', $this->model->transWord('error_shift_deleted'));
            session()->flash('status', 'error'); //Success error notification
        }

        $routeName = $this->route;
        return redirect()->route($routeName.'.index');
    }
}
