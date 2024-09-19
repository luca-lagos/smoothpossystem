<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            ['document_type' => 'DNI'],
            ['document_type' => 'CE'],
            ['document_type' => 'Passport'],
            ['document_type' => 'RUC'],
            ['document_type' => 'VISA']
        ]);
    }
}
