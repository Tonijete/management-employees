<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor');
            $table->string('jabatan');
            $table->string('departemen')->default('Default Departemen'); // Add default value
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();
            $table->enum('status', ['Kontrak', 'Tetap', 'Probation']);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('employees');
    }
};
