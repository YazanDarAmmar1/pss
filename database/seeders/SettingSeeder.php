<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'local_palestinian',
                'label' => 'فلسطيني داخل فلسطين',
                'value' => '+6M',
                'type' => 'text',
            ],
            [
                'key' => 'palestinians_in_jordan',
                'label' => 'الفلسطينيون في الاردن',
                'value' => '+1M',
                'type' => 'text',
            ],
            [
                'key' => 'palestinians_arab_world',
                'label' => 'الفلسطينيون في الدول العربية',
                'value' => '+10M',
                'type' => 'text',
            ],
            [
                'key' => 'palestinians_abroad',
                'label' => 'الفلسطينيون في الدول الاجنبية',
                'value' => '+5M',
                'type' => 'text',
            ],
            [
                'key' => 'mobile',
                'label' => 'رقم الجوال',
                'value' => '+97317333112',
                'type' => 'text',
            ],
            [
                'key' => 'phone',
                'label' => 'رقم الهاتف',
                'value' => '+97317333112',
                'type' => 'text',
            ],
            [
                'key' => 'location',
                'label' => 'العنوان',
                'value' => 'شقة 11، بناية 494G، طريق 715 مجمع 207 المحرق ص ب 24003 - البحرين',
                'type' => 'text',
            ],
            [
                'key' => 'email',
                'label' => 'البريد الالكتروني',
                'value' => 'info@pss-bh.org',
                'type' => 'email',
            ],
        ]);
    }
}
