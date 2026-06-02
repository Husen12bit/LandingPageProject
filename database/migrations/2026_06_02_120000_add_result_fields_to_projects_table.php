<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('result_file')->nullable();
            $table->string('result_link')->nullable();
            $table->text('result_note')->nullable();
            $table->timestamp('result_submitted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'result_file',
                'result_link',
                'result_note',
                'result_submitted_at',
            ]);
        });
    }
};
