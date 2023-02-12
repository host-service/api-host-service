<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageSchedulesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('package_schedules', function (Blueprint $table) {
         $table->id();
         $table->unsignedInteger('id_package');
         $table->date('tanggal_mulai');
         $table->date('tanggal_selesai');
         $table->time('waktu');
         $table->integer('jumlah_dewasa')->default(0);
         $table->integer('jumlah_anak')->default(0);
         $table->timestamp('created_at')->useCurrent();
         $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('package_schedules');
   }
}
