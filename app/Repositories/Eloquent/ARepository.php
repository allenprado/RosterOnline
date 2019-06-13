<?php

namespace App\Repositories\Eloquent;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

abstract class ARepository
{
    protected $model;

    function __construct()
  {
    $this->model = $this->resolveModel();
  }

    public function all(string $column = 'id', string $order = 'ASC'):Collection
  {
    return $this->model->orderBy($column,$order)->get();
  }

    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
  {
    return $this->model->orderBy($column,$order)->paginate($paginate);
  }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
  {
        $query = $this->model;

        foreach ($columns as $key => $value){
            $query =  $query->orWhere($value,'like','%'.$search.'%');
        }

        return $query->orderBy($column,$order)->get();
  }

    protected function resolveModel()
  {
    return app($this->model);
  }

    public function builderTable()
    {

        return ['id' => '#', 'name' => $this->TransWord('name'), 'email' => $this->TransWord('email')];
    }

    public function builderTable2()
    {

        return ['id' => '#', 'name' => $this->TransWord('name'), 'description' => $this->TransWord('description')];
    }

    public function transWord($word, $param = [])
    {
        if ($param) {
            return trans('word.'.$word, ['page' => $param]);
        } else {
            return trans('word.' . $word);
        }
    }

    public function create(array $data):bool
    {
        if(isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return (bool) $this->model->create($data);
    }

    public function find(int $id)
    {

        return $this->model->find($id);

    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){
           return (bool) $register->update($data);
        }else{
            return false;
        }
    }

    public function delete(int $id):Bool
    {

        $register = $this->find($id);
        if($register){
            return (bool) $register->delete();
        }else{
            return false;
        }
    }

    public static function dateDisplay($dateVar)
    {
      $year= substr($dateVar, 0,4);
      $month= substr($dateVar, 5,2);
      $day= substr($dateVar, 8,2);
    return $day."/".$month."/".$year;
    }

    public static function calcHoursTot($hourStart,$hourEnd, $breakTime)
    {

      $hourTot = date('H:i',((strtotime($hourEnd) - strtotime($hourStart))-strtotime($breakTime)));



      $hour = substr($hourTot,0,2);
      $minute = (substr($hourTot,3,2)/60);
      $minute = number_format($minute,2,'.','');
      if($minute == '00'){
          return $hour;
      }else{
        return number_format($hour+$minute,2,'.','');
      }
    }

    public static function calcHoursValue($hours,$valHour,$operator,$value)
    {


      switch ($operator) {
        case '+':
          $valHour = $valHour + $value;
          break;
        case '*':
          $valHour = $valHour * $value;
          break;
        default:
          $valHour = $valHour;
          break;
      }

      return number_format($hours * $valHour,2,'.','');

    }





}
