<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipment = [
            // 胸
            [
                'name' => 'ベンチプレス',
                'category' => 'chest',
                'description' => '大胸筋を鍛える基本的な器具',
                'is_default' => true,
            ],
            [
                'name' => 'インクラインベンチプレス',
                'category' => 'chest',
                'description' => '大胸筋上部を重点的に鍛える器具',
                'is_default' => true,
            ],
            [
                'name' => 'チェストプレスマシン',
                'category' => 'chest',
                'description' => '安全に胸筋を鍛えられるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'ペックフライマシン',
                'category' => 'chest',
                'description' => '胸筋の内側を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'ダンベル',
                'category' => 'chest',
                'description' => '胸筋トレーニング用ダンベル',
                'is_default' => true,
            ],

            // 背中
            [
                'name' => 'ラットプルダウン',
                'category' => 'back',
                'description' => '広背筋を鍛える基本的なマシン',
                'is_default' => true,
            ],
            [
                'name' => 'シーテッドローイング',
                'category' => 'back',
                'description' => '僧帽筋・広背筋を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'チンニング（懸垂）バー',
                'category' => 'back',
                'description' => '自重で背筋を鍛える器具',
                'is_default' => true,
            ],
            [
                'name' => 'Tバーローイング',
                'category' => 'back',
                'description' => '背中の厚みを作るフリーウェイト器具',
                'is_default' => true,
            ],

            // 脚
            [
                'name' => 'レッグプレス',
                'category' => 'legs',
                'description' => '大腿四頭筋・大臀筋を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'スクワットラック',
                'category' => 'legs',
                'description' => 'フリーウェイトでスクワットを行う器具',
                'is_default' => true,
            ],
            [
                'name' => 'レッグエクステンション',
                'category' => 'legs',
                'description' => '大腿四頭筋を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'レッグカール',
                'category' => 'legs',
                'description' => 'ハムストリングを鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'カーフレイズマシン',
                'category' => 'legs',
                'description' => 'ふくらはぎを鍛えるマシン',
                'is_default' => true,
            ],

            // 腕
            [
                'name' => 'プリーチャーカール',
                'category' => 'arms',
                'description' => '上腕二頭筋を鍛える器具',
                'is_default' => true,
            ],
            [
                'name' => 'ケーブルマシン',
                'category' => 'arms',
                'description' => '腕の様々な筋肉を鍛えられる器具',
                'is_default' => true,
            ],
            [
                'name' => 'ディップスバー',
                'category' => 'arms',
                'description' => '上腕三頭筋を鍛える器具',
                'is_default' => true,
            ],

            // 肩
            [
                'name' => 'ショルダープレス',
                'category' => 'shoulders',
                'description' => '三角筋を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'サイドレイズマシン',
                'category' => 'shoulders',
                'description' => '三角筋中部を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'リアデルトマシン',
                'category' => 'shoulders',
                'description' => '三角筋後部を鍛えるマシン',
                'is_default' => true,
            ],

            // 腹
            [
                'name' => 'アブクランチマシン',
                'category' => 'abs',
                'description' => '腹筋を鍛えるマシン',
                'is_default' => true,
            ],
            [
                'name' => 'アブコースター',
                'category' => 'abs',
                'description' => '腹筋・腹斜筋を鍛える器具',
                'is_default' => true,
            ],
            [
                'name' => 'ローマンチェア',
                'category' => 'abs',
                'description' => '腹筋・背筋を鍛える器具',
                'is_default' => true,
            ],

            // 有酸素
            [
                'name' => 'トレッドミル',
                'category' => 'cardio',
                'description' => 'ランニングマシン',
                'is_default' => true,
            ],
            [
                'name' => 'エアロバイク',
                'category' => 'cardio',
                'description' => '有酸素運動用自転車',
                'is_default' => true,
            ],
            [
                'name' => 'エリプティカル',
                'category' => 'cardio',
                'description' => '全身有酸素運動マシン',
                'is_default' => true,
            ],
            [
                'name' => 'ローイングマシン',
                'category' => 'cardio',
                'description' => '全身有酸素運動マシン',
                'is_default' => true,
            ],
        ];

        foreach ($equipment as $item) {
            Equipment::create($item);
        }
    }
}
