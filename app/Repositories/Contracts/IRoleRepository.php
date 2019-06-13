<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IRoleRepository
{
  public function all(string $column = 'id', string $order = 'ASC'):Collection;
  public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;
  public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection;
  public function builderTable();
  public function builderTable2();
  public function transWord($word, $param = []);
  public function create(array $data):bool;
  public function find(int $id);
  public function update(array $data, int $id):Bool;
  public function delete(int $id):Bool;

}
