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
        Schema::table('mobils', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('nama_mobil');
            $table->string('cover', 255)->nullable()->after('nama_mobil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            if (Schema::hasColumn('mobils', 'slug')){
                $table->dropColumn('slug');
            }

            if (Schema::hasColumn('mobils', 'cover')){
                $table->dropColumn('cover');
            }
        });
    }
};
