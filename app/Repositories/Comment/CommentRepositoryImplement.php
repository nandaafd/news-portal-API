<?php

namespace App\Repositories\Comment;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Comment;

class CommentRepositoryImplement implements CommentRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
    public function getComment()
    {
        return $this->model->all();
    }
    public function createComment($data)
    {
        return $this->model->create($data);
    }
    public function getCommentById($id)
    {
        return $this->model->find($id);
    }
    public function updateComment($id, array $data)
    {
        $comment = $this->model->find($id);
        $comment->update($data);
        return $comment;
    }
    public function deleteComment($id)
    {
        return $this->model->find($id)->delete($id);
    }
}
