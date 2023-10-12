<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'news_logs';
    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
