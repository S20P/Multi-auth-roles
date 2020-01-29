<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('supplier_profile')){
        Schema::create('supplier_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('image');
            $table->string('service_name');
            $table->string('business_name');
            $table->string('category');
            $table->text('service_description');
            $table->string('event_type');
            $table->string('location');
            $table->string('pricing_category');   
            $table->enum('status', ['Approved', 'Disapproved'])->default('Disapproved'); 
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_profile');
    }
}
