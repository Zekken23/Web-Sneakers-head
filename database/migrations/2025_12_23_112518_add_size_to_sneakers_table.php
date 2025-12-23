<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sneakers', function (Blueprint $table) {
            $table->string('size')->nullable()->after('brand'); // Tambah kolom size
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sneakers', function (Blueprint $table) {
            //
        });
    }
};
