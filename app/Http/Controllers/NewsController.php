<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
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
            $news = $this->newsRepository->storeNews($data);
            event(new NewsCreated($news));
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'berhasil tambah data',
            'data'=>$news
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
            $news = $this->newsRepository->updateNews($id, $data);
            event(new NewsUpdated($news));
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'berhasil edit data',
            'data'=>$news
        ],200);
    }

    public function destroy(string $id)
    {
        if (Gate::allows('admin')) {
            $news = $this->newsRepository->deleteNews($id);
            event(new NewsDeleted($news));
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
