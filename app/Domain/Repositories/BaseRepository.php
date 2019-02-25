<?php

namespace App\Domain\Repositories;

class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new $this->model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $model = $this->model;

        if (count($criteria) == 1) {
            foreach ($criteria as $c) {
                $model = $model->where($c[0], $c[1], $c[2]);
            }
        } elseif (count($criteria > 1)) {
            $model = $model->where($criteria[0], $criteria[1], $criteria[2]);
        }

        if (count($orderBy) == 1) {
            foreach ($orderBy as $order) {
                $model = $model->orderBy($order[0], $order[1]);
            }
        } elseif (count($orderBy > 1)) {
            $model = $model->orderBy($orderBy[0], $orderBy[1]);
        }

        if (count($limit)) {
            $model = $model->take((int)$limit);
        }

        if (count($offset)) {
            $model = $model->skip((int)$offset);
        }

        return $model->get();
    }

    public function findOneBy(array $criteria)
    {
        return $this->findBy($criteria)->first();
    }
}