<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('packages', function (Blueprint $table) {
         $table->id();
         $table->unsignedInteger('id_business');
         $table->text('nama');
         $table->text('deskripsi');
         $table->enum('jenis', ['private', 'public']);
         $table->text('terms_condition');
         $table->text('syarat_refund');
         $table->integer('umur_min');
         $table->integer('umur_max');
         $table->integer('is_refund');
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
      Schema::dropIfExists('packages');
   }
}
