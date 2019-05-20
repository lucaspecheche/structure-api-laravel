<?php

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new $this->model;
    }

    public function model():Model
    {
        return new $this->model;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }
}
