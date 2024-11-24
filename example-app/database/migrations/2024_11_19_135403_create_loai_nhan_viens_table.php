<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_nhan_viens', function (Blueprint $table) {
            $table->id('MaLoai'); // Khóa chính, tự động tăng
            $table->string('TenLoai', 50); // Chuỗi tối đa 50 ký tự
            $table->integer('TrangThai'); // Số nguyên (1 hoặc 0)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai_nhan_viens');
    }
};