<?php

use Illuminate\Database\Seeder;

class HomePageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Setting::create(
            [
                'name' => 'our vision in arabic',
                'slug_ar' => 'ؤويتنا بالعربية',
                'slug_en' => 'our vision in arabic',
                'value' => ' when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'our goal in arabic',
                'slug_ar' => 'هدفنا بالعربية',
                'slug_en' => 'our goal in arabic',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'our idea in arabic',
                'slug_ar' => 'فكرتنا بالعربية',
                'slug_en' => 'our idea in arabic',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]);
        \App\Models\Setting::create(
            [
                'name' => 'our vision in english',
                'slug_ar' => 'ؤويتنا بالانجليزية',
                'slug_en' => 'our vision in english',
                'value' => ' when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'our goal in english',
                'slug_ar' => 'هدفنا بالانجليزية',
                'slug_en' => 'our goal in english',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'our idea in english',
                'slug_ar' => 'فكرتنا بالانجليزية',
                'slug_en' => 'our idea in english',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Search Box Text in english',
                'slug_ar' => 'نص ابحث',
                'slug_en' => 'Search Box Text in english',
                'value' => 'By speciatilty doctor name or fees',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Search Box Text in arabic',
                'slug_ar' => 'نص ابحث',
                'slug_en' => 'Search Box Text in arabic',
                'value' => 'By speciatilty doctor name or fees',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'Compare & Choose Box Text in english',
                'slug_ar' => 'قارن واختار',
                'slug_en' => 'Compare & Choose Box Text in english',
                'value' => 'Based on real patients reviews',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Compare & Choose Text in arabic',
                'slug_ar' => 'قارن و احتار',
                'slug_en' => 'Compare & Choose Text in arabic',
                'value' => 'Based on real patients reviews',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'Booking Box Text in english',
                'slug_ar' => 'قارن واختار',
                'slug_en' => 'Booking Box Text in english',
                'value' => 'pay at the clinic at no extra cost',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Booking Box Text in arabic',
                'slug_ar' => 'قارن واختار',
                'slug_en' => 'Booking Box Text in arabic',
                'value' => 'pay at the clinic at no extra cost',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Download App Description in arabic',
                'slug_ar' => 'نص تحميل الابلكشم',
                'slug_en' => 'Download App Description in arabic',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]);
        \App\Models\Setting::create(
            [
                'name' => 'Download App Description in english',
                'slug_ar' => 'نص تحميل الابلكشم',
                'slug_en' => 'Download App Description in english',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'App Google Play Link',
                'slug_ar' => 'رابط التحميل من جوجل بلاى',
                'slug_en' => ' App Google Play Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'App Play Store Link',
                'slug_ar' => 'رابط التحميل من بلاى ستور',
                'slug_en' => ' App Play Store Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'Facebook Link',
                'slug_ar' => 'رابط الفيسبوك',
                'slug_en' => 'Facebook Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_FOOTER,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'twitter Link',
                'slug_ar' => 'رابط تويتر',
                'slug_en' => 'twitter  Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_FOOTER,
            ]
        );\App\Models\Setting::create(
            [
                'name' => 'snapchat Link',
                'slug_ar' => 'رابط سناب شات',
                'slug_en' => 'snapchat Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_FOOTER,
            ]
        );
    }
}
