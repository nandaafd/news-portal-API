<?php

namespace App\Repositories\News;

use LaravelEasyRepository\Repository;

interface NewsRepository{
    public function getAllNews();
    public function getNews($id);
    public function getComment($id);
    public function storeNews(array $data, $path);
    public function updateNews($id, array $data, $path);
    public function deleteNews($id);

}
