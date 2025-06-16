<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
        {
            Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->double('total_price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
