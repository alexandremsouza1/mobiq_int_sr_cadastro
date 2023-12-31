<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements IEntityRepository
{
    /**
     * @var Model
     */
    protected $model;


    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);
        if($result) {
            return $result;
        }
        return false;
    }

    public function findByKey($key, $value)
    {
        $result = $this->model->where($key, $value)->first();
        if($result) {
            return $result;
        }
        return false;
    }

    // public function store($data)
    // {
    //     if($this->model->validate($data)) {
    //         $modelInstance = new $this->model($data);
    //         if($modelInstance->save()) {
    //             return $modelInstance->id;
    //         }
    //     }
    //     return false;
    // }

    public function store($data,$key = 'id')
    {
        $this->model->fill($data);
        if($this->model->validate($data)) {
            $item = $this->model->updateOrCreate(
                [$key => $data[$key]],
                $data
            );
            return $item;
        }
        return false;
    }

    public function update($id, $data)
    {
        $now = Carbon::now();
        $data['updated_at'] = $now->format('Y-m-d\TH:i:s.u\Z');
        if($this->model->validate($data)) {
            if(!$this->model->where('id', $id)->update($data)) {
                return false;
            }
        }
        return true;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}