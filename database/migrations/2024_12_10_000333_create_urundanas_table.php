<?php

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
        Schema::create('urundanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'urundanas_user_id'
            );
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'urundanas_categories_id'
            );
            $table->string('foto')->nullable();
            $table->string('name');
            $table->string('slug_urundana')->unique();
            $table->text('description');
            $table->unsignedBigInteger('jumlah_orang')->nullable();
            $table->unsignedBigInteger('dana_terkumpul')->nullable();
            $table->unsignedBigInteger('jumlah_target_dana');
            $table->date('tanggal_batas_urundana');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urundanas');
    }
};
