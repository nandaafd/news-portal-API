<?php

namespace App\Repositories\NewsLog;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\NewsLog;

class NewsLogRepositoryImplement extends Eloquent implements NewsLogRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(NewsLog $model)
    {
        $this->model = $model;
    }

    public function getNewsLog()
    {
        return $this->model->all();
    }
    public function getNewsLogById($id)
    {
        return $this->model->find($id);
    }
}
