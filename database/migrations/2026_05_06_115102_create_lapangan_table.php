<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_olahraga_id')->constrained('jenis_olahraga')->onDelete('cascade');
            $table->string('nama', 100);
            $table->decimal('harga_per_jam', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('fasilitas')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangan');
    }
};