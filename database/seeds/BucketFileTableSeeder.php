<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BucketFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bucket_file')->insert([
            [
                'title' => 'корзина 1',
                'user_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
