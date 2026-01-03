<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        DB::table('chat_messages')->insert([
            [
                'chat_id' => 1,
                'user_id' => 2,
                'content' => '【既読】購入ありがとうございます。発送準備を進めます。',
                'is_read' => true,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'chat_id' => 1,
                'user_id' => 2,
                'content' => '【既読】発送が完了しました。到着までお待ち下さい。',
                'is_read' => true,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'chat_id' => 1,
                'user_id' => 1,
                'content' => '【既読】商品を受け取りました。ありがとうございます。',
                'is_read' => true,
                'created_at' => Carbon::now()->subHour(),
                'updated_at' => Carbon::now()->subHour(),
            ],
            [
                'chat_id' => 1,
                'user_id' => 2,
                'content' => '【未読】受け取り確認の連絡ありがとうございます。',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30),
            ],
            [
                'chat_id' => 1,
                'user_id' => 2,
                'content' => '【未読】商品の中身の確認をお願いします。',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinutes(10),
                'updated_at' => Carbon::now()->subMinutes(10),
            ],
            [
                'chat_id' => 1,
                'user_id' => 2,
                'content' => '【未読】問題なければ取引完了処理をお願いします。',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinutes(5),
                'updated_at' => Carbon::now()->subMinutes(5),
            ],
            [
                'chat_id' => 2,
                'user_id' => 2,
                'content' => '【未読】購入ありがとうございます。発送準備を進めます。',
                'is_read' => false,
                'created_at' => Carbon::now()->subMinute(),
                'updated_at' => Carbon::now()->subMinute(),
            ],
        ]);
    }
}
