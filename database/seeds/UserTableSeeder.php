<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'email' => 'admin@admin.admin',
                'password' => '$2y$12$9E.Vf7KTlt5AcdzZ6DjmSe6P.dWGzSy.Dsp4s9Eo5XZTA7SGQ4g8W',
                'role' => 'admin',
            ],
        ]);
    }
}
