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
        Schema::table('users', function (Blueprint $table): void {
            $table->string('password')->nullable()->change();
            $table->string('avatar')->nullable();
            // This two fields are used to store the external user id and the external auth provider (twiter, facebook, google, etc)
            $table->string('external_id')->nullable();
            $table->string('external_auth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema:: dropifExists('users');
    }
};
