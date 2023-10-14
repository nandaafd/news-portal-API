<?php

namespace App\Repositories\NewsLog;

use LaravelEasyRepository\Repository;

interface NewsLogRepository extends Repository{

    public function getNewsLog();
    public function getNewsLogById($id);
}
