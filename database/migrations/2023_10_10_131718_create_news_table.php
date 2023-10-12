<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('tittle');
            $table->date('publish_date');
            $table->string('writer');
            $table->string('news_text');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void    
    {
        Schema::dropIfExists('news');
    }
};
