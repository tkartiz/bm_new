<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('creators')->insert([
            [
                'name' => '未設定',
                'affiliation' => 'デザイン部',
                'email' => 'unfixed@artiz.com',
                'phone' => '',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'デザイナーCさん',
                'affiliation' => 'デザイン部',
                'email' => 'c@artiz.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'デザイナーDさん',
                'affiliation' => 'デザイン部',
                'email' => 'd@artiz.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ]
        ]);
    }
}
