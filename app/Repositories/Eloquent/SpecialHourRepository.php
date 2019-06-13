<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ISpecialHourRepository;
use App\SpecialHour;


class SpecialHourRepository extends ARepository implements ISpecialHourRepository
{

    protected $model = SpecialHour::class;



    public function create(array $data):bool
    {

        $data['user_id'] = Auth()->user()->id;
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){
           $data['user_id'] = Auth()->user()->id;
           return (bool) $register->update($data);
        }else{
            return false;
        }
    }



}
