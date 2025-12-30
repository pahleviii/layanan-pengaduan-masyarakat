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
    Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->string('ticket_number', 50)->unique();
        $table->string('name');
        $table->string('email');
        $table->string('phone', 20);
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('description');
        $table->string('photo')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])->default('pending');
        $table->text('admin_note')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
