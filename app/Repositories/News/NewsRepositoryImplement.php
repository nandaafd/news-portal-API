<?php

namespace App\Repositories\News;

use App\Models\Comment;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\News;

class NewsRepositoryImplement implements NewsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;
    protected $comment;

    public function __construct(News $model, Comment $comment)
    {
        $this->model = $model;
        $this->comment = $comment;
    }
    public function getAllNews()
    {
        return $this->model->paginate(10);
    }
    public function getNews($id)
    {
        return $this->model->find($id);
    }
    public function getComment($id)
    {
        return $this->comment->where('news_id',$id)->get();
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
