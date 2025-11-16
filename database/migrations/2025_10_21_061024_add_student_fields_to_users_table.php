<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->nullable()->after('name');
            $table->string('course')->nullable()->after('student_id');
            $table->string('phone')->nullable()->after('course');
            $table->text('address')->nullable()->after('phone');
            $table->text('health_condition')->nullable()->after('address');
            $table->string('health_file')->nullable()->after('health_condition');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['student_id', 'course', 'phone', 'address', 'health_condition', 'health_file']);
        });
    }
};
