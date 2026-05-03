<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('assigned_freelancer_id')->nullable()->constrained('freelancers')->onDelete('set null');
            $table->decimal('agreed_budget', 10, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['assigned_freelancer_id']);
            $table->dropColumn(['assigned_freelancer_id', 'agreed_budget']);
        });
    }
};
