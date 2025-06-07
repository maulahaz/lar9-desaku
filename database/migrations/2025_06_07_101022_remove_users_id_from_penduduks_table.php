<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            //--First, drop the foreign key constraint
            $table->dropForeign(['users_id']);

            //--Then, drop the column
            $table->dropColumn('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            //--If you need to reverse this migration, add the column back
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
        });
    }
};
