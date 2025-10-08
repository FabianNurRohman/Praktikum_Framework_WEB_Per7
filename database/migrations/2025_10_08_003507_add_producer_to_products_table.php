<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom producer.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('producer', 255)->after('qty');
        });
    }

    /**
     * Batalkan perubahan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('producer');
        });
    }
};
