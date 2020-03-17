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


        \App\Models\Setting::whereIn('category',
            [
                \App\Models\Setting::CATEGORY_HOME_SECTIONS,
                \App\Models\Setting::CATEGORY_FOOTER,
                \App\Models\Setting::CATEGORY_CONTACT,

            ]
        )->delete();
        \App\Models\Setting::create(
            [
                'name' => 'vision_ar ',
                'slug_ar' => 'رويتنا بالعربية',
                'slug_en' => 'our vision in arabic',
                'value' => ' when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'goal_ar',
                'slug_ar' => 'هدفنا بالعربية',
                'slug_en' => 'our goal in arabic',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'idea_ar',
                'slug_ar' => 'فكرتنا بالعربية',
                'slug_en' => 'our idea in arabic',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]);
        \App\Models\Setting::create(
            [
                'name' => 'vision_en',
                'slug_ar' => 'ؤويتنا بالانجليزية',
                'slug_en' => 'our vision in english',
                'value' => ' when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'goal_en',
                'slug_ar' => 'هدفنا بالانجليزية',
                'slug_en' => 'our goal in english',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'why_us_en',
                'slug_ar' => 'لماذا نحن بالانجليزية',
                'slug_en' => 'why us in english',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );

        \App\Models\Setting::create(
            [
                'name' => 'why_us_ar',
                'slug_ar' => 'لماذا نحن بالعربية',
                'slug_en' => 'why us in english',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'idea_en',
                'slug_ar' => 'فكرتنا بالانجليزية',
                'slug_en' => 'our idea in english',
                'value' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'search_box_en',
                'slug_ar' => 'نص ابحث بالانجليزية',
                'slug_en' => 'Search Box Text in english',
                'value' => 'By speciatilty doctor name or fees',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'search_box_ar',
                'slug_ar' => 'نص ابحث بالعربية',
                'slug_en' => 'Search Box Text in arabic',
                'value' => 'By speciatilty doctor name or fees',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'compare_box_en',
                'slug_ar' => 'نص قارن واخنار بالانجليزية',
                'slug_en' => 'Compare & Choose Box Text in english',
                'value' => 'Based on real patients reviews',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'compare_box_ar',
                'slug_ar' => ' قارن و احتار بالعربية',
                'slug_en' => 'Compare & Choose Text in arabic',
                'value' => 'Based on real patients reviews',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );


        \App\Models\Setting::create(
            [
                'name' => 'book_box_en',
                'slug_ar' => ' نص احجز الان بالانجليزية',
                'slug_en' => 'Booking Box Text in english',
                'value' => 'pay at the clinic at no extra cost',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'book_box_ar',
                'slug_ar' => ' نص احجز الان بالعربية',
                'slug_en' => 'Booking Box Text in arabic',
                'value' => 'pay at the clinic at no extra cost',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'download_description_ar',
                'slug_ar' => 'نص تحميل الابلكشن بالعربية',
                'slug_en' => 'Download App Description in arabic',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]);
        \App\Models\Setting::create(
            [
                'name' => 'download_description_en',
                'slug_ar' => 'نص تحميل الابلكشن بالعربية',
                'slug_en' => 'Download App Description in english',
                'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'input_type' => \App\Models\Setting::INPUT_TEXTAREA,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'andriod_link',
                'slug_ar' => 'رابط التحميل من جوجل بلاى',
                'slug_en' => ' App Google Play Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'ios_link',
                'slug_ar' => 'رابط التحميل من بلاى ستور',
                'slug_en' => ' App Play Store Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_HOME_SECTIONS,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'facebook Link',
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
        );
        \App\Models\Setting::create(
            [
                'name' => 'snapchat Link',
                'slug_ar' => 'رابط سناب شات',
                'slug_en' => 'snapchat Link',
                'value' => '#',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_FOOTER,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'address_ar',
                'slug_ar' => 'العنوان باللغة العربية',
                'slug_en' => 'Address in Arabic',
                'value' => 'Saudi Arabia - Makkah - 122 Block',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_CONTACT,
            ]
        );

        \App\Models\Setting::create(
            [
                'name' => 'address_en',
                'slug_ar' => 'العنوان باللغة الانجليزية',
                'slug_en' => 'Address in English',
                'value' => 'Saudi Arabia - Makkah - 122 Block',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_CONTACT,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'phone 1',
                'slug_ar' => 'رقم الهاتف 1',
                'slug_en' => 'Phone Number 1',
                'value' => '0000000000000',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_CONTACT,
            ]
        );
        \App\Models\Setting::create(
            [
                'name' => 'phone 2',
                'slug_ar' => 'رقم الهاتف 2',
                'slug_en' => 'Phone Number 2',
                'value' => '0000000000000',
                'input_type' => \App\Models\Setting::INPUT_TEXT,
                'category' => \App\Models\Setting::CATEGORY_CONTACT,
            ]
        );

    }
}
