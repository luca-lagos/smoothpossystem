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
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn('document_id');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('document_id')->after('status')->constrained('documents')->onDelete('cascade');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->string('document', 20)->after('document_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void

    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn('document_id');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('document_id')->after('status')->unique()->constrained('documents')->onDelete('cascade');
        });


        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('document');
        });
    }
};
