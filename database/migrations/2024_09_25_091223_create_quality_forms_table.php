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
        Schema::create('quality_forms', function (Blueprint $table) {
            $table->id();
     
            $table->string('product_name');
            $table->string('inspection_result');
            $table->text('comments')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('technician_id');  // Technician ID null olamaz
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_forms');
    }
};
