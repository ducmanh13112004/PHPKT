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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->string('TenDN')->primary(); // Khóa chính, không dấu
            $table->string('Ho', 100); // Chuỗi tối đa 100 ký tự
            $table->string('Ten', 20); // Chuỗi tối đa 20 ký tự
            $table->string('HinhDaiDien', 255); // Chuỗi tối đa 255 ký tự
            $table->unsignedBigInteger('MaLoaiNV'); // Khóa ngoại

            $table->foreign('MaLoaiNV')->references('MaLoai')->on('loai_nhan_viens')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('nhan_viens', function (Blueprint $table) {
            $table->string('HinhDaiDien')->nullable()->after('MaLoaiNV'); // Thêm cột HinhDaiDien
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhan_viens');
    }
};