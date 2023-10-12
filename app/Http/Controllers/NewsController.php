<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use App\Http\Requests\NewsRequest;
use App\Repositories\News\NewsRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

    public function store(NewsRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('NewsImage');
        }else {
            $path = null;
        }

        $data = $request->all();
        if (Gate::allows('admin')) {
            $news = $this->newsRepository->storeNews($data, $path);
            event(new NewsCreated($news));
        }else{
            return response()->json(['message'=>'Anda tidak memiliki akses'],403);
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

    public function update(NewsRequest $request, $id)
    {
        $oldImage = $request->oldImage;
        if ($request->hasFile('newImage')) {
            if ($request->oldImage) {
                Storage::delete($oldImage);
            }
            $path = $request->file('newImage')->store('NewsImage');
        }else{
            $path = $oldImage;
        }

        $data = $request->all();
        if (Gate::allows('admin')) {
            $news = $this->newsRepository->updateNews($id, $data, $path);
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
