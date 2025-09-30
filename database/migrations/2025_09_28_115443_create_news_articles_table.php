<?php

use App\Enum\NewsSourcesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id')->unique();
            $table->string('title');
            $table->string('url')->unique();
            $table->string('headline')->nullable();
            $table->json('keywords')->nullable();
            $table->json('multimedia')->nullable();
            $table->string('news_desk')->nullable();
            $table->string('author')->nullable();
            $table->string('type')->nullable();
            $table->enum('source', NewsSourcesEnum::toArray())->default(NewsSourcesEnum::NEWSAPI);
            $table->string('category')->nullable();
            $table->string('snippet')->nullable();
            $table->string('subsection_name')->nullable();
            $table->text('description')->nullable();
            $table->string('url_to_image')->nullable();
            $table->string('type_of_material')->nullable();
            $table->string('provider_source')->nullable();
            $table->text('content')->nullable();
            $table->integer('word_count')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
