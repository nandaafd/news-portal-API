<?php

namespace App\Repositories\News;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\News;

class NewsRepositoryImplement implements NewsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }
    public function getAllNews()
    {
        return $this->model->paginate(10);
    }
    public function getNews($id)
    {
        return $this->model->where('id',$id)->first();
    }
    public function storeNews($data)
    {
        return $this->model->create($data);
    }
    public function updateNews($id, $data)
    {
        $news = $this->model->find($id);
        $news->update($data);
        return $news;
    }
    public function deleteNews($id)
    {
        return $this->model->find($id)->delete();
    }
}
