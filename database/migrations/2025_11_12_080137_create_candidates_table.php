<?php

use App\Models\CandidateType;
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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('head_name', 100);
            $table->string('vice_name', 100);
            $table->text('photo')->nullable();
            $table->text('resume')->nullable();
            $table->boolean('is_blank')->default(false);
            $table->foreignIdFor(CandidateType::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
