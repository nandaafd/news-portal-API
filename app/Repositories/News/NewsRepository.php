<?php

namespace App\Repositories\News;

use LaravelEasyRepository\Repository;

interface NewsRepository{
    public function getAllNews();
    public function getNews($id);
    public function storeNews(array $data);
    public function updateNews($id, array $data);
    public function deleteNews($id);

}
