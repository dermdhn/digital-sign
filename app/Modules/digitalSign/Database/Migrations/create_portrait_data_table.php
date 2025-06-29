<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portrait_data', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('heading');
            $table->string('subheading')->nullable();
            $table->string('nama_tokoh');
            $table->string('jabatan_tokoh');
            $table->string('gambar_tokoh')->nullable(); // Contoh: 'nama_file.png'
            $table->boolean('is_aktif'); // Contoh: 'nama_file.png'

            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portrait_data');
    }
};
