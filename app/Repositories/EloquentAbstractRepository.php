<?php

namespace App\Repositories;

abstract class EloquentAbstractRepository
{
    public $perPage = 10;

    public function setPerPage($limit)
    {
        return $this->perPage = $limit;
    }

    public function getAll()
    {
        if ($this->perPage > 0) {
            return $this->getModel()->latest()->paginate($this->perPage);
        } else {
            return $this->getModel()->latest()->get();
        }
    }

    public function findById($eid)
    {
        return $this->getModel()->find($eid);
    }

    public function findBy($key, $value, $operator = '=')
    {
        if ($this->perPage > 0) {
            return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage);
        } else {
            return $this->getModel()->where($key, $operator, $value)->get();
        }
    }

    public function delete($eid)
    {
        $article = $this->findById($eid);

        if (!is_null($article)) {
            $article->delete();

            return true;
        }

        return false;
    }

    public function deleteAll($key, $value)
    {
        return $this->getModel()->whereIn($key, $value)->delete();
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function getCount($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->count();
    }
}
