<?php

namespace App\Repositories;

use \App\Http\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    protected $model;

    /**
     * To bind model to the repository
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Getter for the model
    public function getModel()
    {
        return $this->model;
    }

    // Setter for the model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager Loading
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
