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
        Schema::table('matkuls', function (Blueprint $row) {
            $row->string('hari')->nullable();
            $row->time('jam_mulai')->nullable();
            $row->time('jam_selesai')->nullable();
            $row->string('ruangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matkuls', function (Blueprint $row) {
            $row->dropColumn(['hari', 'jam_mulai', 'jam_selesai', 'ruangan']);
        });
    }
};
