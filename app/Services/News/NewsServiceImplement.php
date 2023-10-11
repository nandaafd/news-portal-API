<?php

namespace App\Services\News;

use LaravelEasyRepository\Service;
use App\Repositories\News\NewsRepository;

class NewsServiceImplement extends Service implements NewsService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(NewsRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
