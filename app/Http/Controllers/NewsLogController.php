<?php

namespace App\Http\Controllers;

use App\Repositories\NewsLog\NewsLogRepository;
use Illuminate\Http\Request;

class NewsLogController extends Controller
{

    private $newsLogRepository;
    public function __construct(NewsLogRepository $newsLogRepository)
    {
        $this->newsLogRepository = $newsLogRepository;
    }
    public function index()
    {
        $result = $this->newsLogRepository->getNewsLog();
        return response()->json([
            'message'=>'berhasil ambil semua log',
            'data'=>$result
        ],200);
    }

    public function show(string $id)
    {
        $result = $this->newsLogRepository->getNewsLogById($id);
        return response()->json([
            'message'=>'berhasil ambil log',
            'data'=>$result
        ],200);
    }

}
