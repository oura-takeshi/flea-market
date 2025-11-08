<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
            [
                'purchase_id' => 1,
                'is_finished' => false,
            ],
            [
                'purchase_id' => 2,
                'is_finished' => false,
            ],
            [
                'purchase_id' => 3,
                'is_finished' => false,
            ],
            [
                'purchase_id' => 4,
                'is_finished' => false,
            ],
        ]);
    }
}
