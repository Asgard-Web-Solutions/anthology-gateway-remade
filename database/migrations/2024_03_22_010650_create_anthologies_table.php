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
        Schema::create('anthologies', function (Blueprint $table) {
            $table->id();

            // Basic Details
            $table->string('name');
            $table->string('description');
            $table->string('about_publishers')->nullable();
            $table->string('distribution')->nullable();
            
            // Dates
            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('end_review_date')->nullable();
            $table->date('est_pub_date')->nullable();

            // Images
            $table->string('header_image')->nullable();
            $table->string('cover_image')->nullable();

            // Submission Details
            $table->integer('sub_ideal_count')->default(20);
            $table->string('sub_guidelines')->nullable();
            $table->integer('sub_min_length')->default(1000);
            $table->integer('sub_max_length')->default(10000);
            $table->tinyInteger('sub_prefer_anon')->default(0);
            
            // Message Text
            $table->string('msg_accept_text')->nullable();
            $table->string('msg_decline_text')->nullable();

            // Payment Settings
            $table->integer('pay_amount')->nullable();
            $table->string('pay_currency')->default('usd');
            $table->string('pay_supplemental')->nullable();

            // MetaData
            $table->tinyInteger('configured_basic_details')->default(0);
            $table->tinyInteger('configured_dates')->default(0);
            $table->tinyInteger('configured_images')->default(0);
            $table->tinyInteger('configured_submission_details')->default(0);
            $table->tinyInteger('configured_message_text')->default(0);
            $table->tinyInteger('configured_payment_details')->default(0);
            $table->string('status')->default('setup');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anthologies');
    }
};
