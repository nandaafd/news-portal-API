<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Repositories\News\NewsRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    private $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $result = $this->newsRepository->getAllNews();
        return response()->json([
            'message'=>'berhasil ambil data',
            'data'=>$result
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tittle'=>'required',
            'publish_date'=>'required',
            'writer'=>'required',
            'news_text'=>'required',
            'image'=>'file|mimes:jpeg,png'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $data = $request->all();
        if (Gate::allows('admin')) {
            $result = $this->newsRepository->storeNews($data);
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'berhasil tambah data',
            'data'=>$result
        ],201);
    }

    public function show($id)
    {
        $result = $this->newsRepository->getNews($id);
        $comment = $this->newsRepository->getComment($id);
        return response()->json([
            'message'=>'berhasil ambil data',
            'data'=>$result,
            'comment'=>$comment
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'tittle'=>'required',
            'publish_date'=>'required',
            'writer'=>'required',
            'news_text'=>'required',
            'image'=>'file|mimes:jpeg,png'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $data = $request->all();
        if (Gate::allows('admin')) {
            $result = $this->newsRepository->updateNews($id, $data);
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'berhasil edit data',
            'data'=>$result
        ],200);
    }

    public function destroy(string $id)
    {
        if (Gate::allows('admin')) {
            $this->newsRepository->deleteNews($id);
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'data berhasil dihapus',
        ],200);
    }
}
