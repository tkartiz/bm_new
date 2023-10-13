<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'user_id' => 1,
                'subject' => '秋祭りイベント',
                'works_quantity' => 3,
                'severity' => '通常',
                'revision' => 0,
                'applicated_at' => null,
                'desired_dlvd_at' => date('2023-12-10')
            ],
            [
                'user_id' => 2,
                'subject' => 'ハロウィーンイベント',
                'works_quantity' => 5,
                'severity' => '通常',
                'revision' => 0,
                'applicated_at' => null,
                'desired_dlvd_at' => date('2023-12-25')
            ],
            [
                'user_id' => 1,
                'subject' => 'オクトーバーフェストイベント',
                'works_quantity' => 1,
                'severity' => '通常',
                'revision' => 0,
                'applicated_at' => null,
                'desired_dlvd_at' => date('2024-01-10')
            ],
        ]);
    }
}
