<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'hoge',
                'email' => 'hoge@example.com',
                'password' => Hash::make('hoge1234'),
            ],
            [
                'name' => 'fuga',
                'email' => 'fuga@example.com',
                'password' => Hash::make('fuga1234'),
            ],
        ]);
        DB::table('items')->insert([
            [
                'user_id' => '1',
                'condition_id' => '1',
                'image' => 'storage/images/watch.jpg',
                'name' => '腕時計',
                'price' => '15000',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'brand' => 'メンズ腕時計',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '1',
                'condition_id' => '2',
                'image' => 'storage/images/hard_disk.jpg',
                'name' => 'HDD',
                'price' => '5000',
                'description' => '高速で信頼性の高いハードディスク',
                'brand' => 'ハードディスク',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '1',
                'condition_id' => '3',
                'image' => 'storage/images/onions.jpg',
                'name' => '玉ねぎ3束',
                'price' => '300',
                'description' => '新鮮な玉ねぎ3束のセット',
                'brand' => '玉ねぎ',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '1',
                'condition_id' => '4',
                'image' => 'storage/images/leather_shoes.jpg',
                'name' => '革靴',
                'price' => '4000',
                'description' => 'クラシックなデザインの革靴',
                'brand' => '革靴',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '1',
                'condition_id' => '1',
                'image' => 'storage/images/laptop.jpg',
                'name' => 'ノートPC',
                'price' => '45000',
                'description' => '高性能なノートパソコン',
                'brand' => 'ノートパソコン',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '2',
                'condition_id' => '2',
                'image' => 'storage/images/microphone.jpg',
                'name' => 'マイク',
                'price' => '8000',
                'description' => '高音質のレコーディング用マイク',
                'brand' => 'マイク',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '2',
                'condition_id' => '3',
                'image' => 'storage/images/shoulder_bag.jpg',
                'name' => 'ショルダーバッグ',
                'price' => '3500',
                'description' => 'おしゃれなショルダーバッグ',
                'brand' => 'ショルダーバッグ',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '2',
                'condition_id' => '4',
                'image' => 'storage/images/tumbler.jpg',
                'name' => 'タンブラー',
                'price' => '500',
                'description' => '使いやすいタンブラー',
                'brand' => 'タンブラー',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '2',
                'condition_id' => '1',
                'image' => 'storage/images/coffee_mill.jpg',
                'name' => 'コーヒーミル',
                'price' => '4000',
                'description' => '手動のコーヒーミル',
                'brand' => 'コーヒーミル',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
            [
                'user_id' => '2',
                'condition_id' => '2',
                'image' => 'storage/images/makeup_set.jpg',
                'name' => 'メイクセット',
                'price' => '2500',
                'description' => '便利なメイクアップセット',
                'brand' => 'メイクアップセット',
                'number_likes' => '0',
                'number_comments' => '0',
            ],
        ]);
        DB::table('purchases')->insert([
            [
                'user_id' => '1',
                'item_id' => '6',
                'post_code' => '000-1111',
                'address' => 'hoge',
                'building' => 'hoge',
                'payment_method' => '1',
            ],
            [
                'user_id' => '1',
                'item_id' => '7',
                'post_code' => '000-1111',
                'address' => 'hoge',
                'building' => 'hoge',
                'payment_method' => '2',
            ],
        ]);
    }
}
