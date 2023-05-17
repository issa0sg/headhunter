<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedTinyInteger('order_commission')->default(10);
            $table->unsignedTinyInteger('order_type')->default(0);
            $table->unsignedTinyInteger('order_status')->default(0);
            $table->unsignedTinyInteger('category_id')->default(0);
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->string('image')->nullable();
            $table->unsignedInteger('reward');
            $table->unsignedInteger('target_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('hunter_id')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('hunter_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
