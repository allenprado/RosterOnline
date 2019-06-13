<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ICompanyRepository;
use App\Company;


class CompanyRepository extends ARepository implements ICompanyRepository
{

    protected $model = Company::class;

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
