<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Selaraskan tabel pengguna lama (tbl_pengguna) dengan kebutuhan aplikasi:
     * password bcrypt (60 karakter), role_id, dan timestamp.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_pengguna')) {
            return;
        }

        //--Password hash bcrypt membutuhkan minimal 60 karakter.
        DB::statement('ALTER TABLE `tbl_pengguna` MODIFY `password` VARCHAR(255) NOT NULL');

        if (!Schema::hasColumn('tbl_pengguna', 'role_id')) {
            Schema::table('tbl_pengguna', function (Blueprint $table) {
                $table->integer('role_id')->default(1)->after('role');
            });
        }

        if (!Schema::hasColumn('tbl_pengguna', 'created_at')) {
            Schema::table('tbl_pengguna', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //--Tidak dikembalikan agar tidak memotong hash password yang sudah tersimpan.
    }
};
