<?php

namespace App\Repositories\Comment;

use LaravelEasyRepository\Repository;

interface CommentRepository{
    public function getComment();
    public function createComment(array $data);
    public function updateComment($id, array $data);
    public function getCommentById($id);
    public function deleteComment($id);
}
