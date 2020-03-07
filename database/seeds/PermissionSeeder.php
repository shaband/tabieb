<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $actions = ['create' => 'اضاقه', 'view' => 'مشاهده', 'edit' => 'تعديل', 'delete' => 'حذف'];

        $models = [
            'Admin' => 'مدير',
            //"Activity" => 'سحل',
            "Area" => 'الحى',
            // "Attachment" => 'مرفق',
            "Block" => 'منطقه',
            "Category" => 'قسم',
            "Contact" => 'تواصل',
            "District" => 'محاظفة',
            "Doctor" => 'طبيب',
            "Invoice" => 'فاتوره',
//            "Message" => '',
            "Patient" => 'مريض',
//            "PatientAnswer" => 'اجابه طبيب',
            "PatientQuestion" => 'سؤال للمريض',
            "Permission" => 'اذن',
            "Pharmacy" => 'الصيديلية',
            "PharmacyRep" => 'مندوب صيدليه',
            "Prescription" => 'روشته',
//            "PrescriptionItem" => '',
            "Question" => 'سؤال',
//            "Rating" => '',
            "Reservation" => 'حجز',
            "Role" => 'صلاحية',
            "Schedule" => 'موعد',
            "Setting" => 'اعدادات',
            "SocialSecurity" => 'تامين اجتماعى',
        ];

        $ids = [];

        foreach ($models as $en => $ar) {


            $model = Str::title($en);


            foreach ($actions as $en_action => $ar_action) {
                $attributes = [
                    'name' => Str::title("{$en_action} {$en}"),
                    'label_ar' => "{$ar_action} {$ar}",
                    'label_en' => Str::title("{$en_action} {$en}"),
                    'group_name' => Str::plural($en),
                    'guard_name' => 'admin',
                ];
                $permission = \App\Models\Permission::firstOrCreate($attributes, $attributes);

                $ids[] = $permission->id;
            }
        }

        \App\Models\Permission::whereNotIn('id', $ids)->delete();
       // \App\Models\Permission::whereIn('name', [])->delete();

    }

    public function getModels()
    {

        $directory = app_path('Models');

        function removeSuffix(string $class)
        {
            return basename($class, ".php");
        }

        $models = scandir($directory);
        //remove back unwanted values'
        $unwanted_models = ['..', '.', 'User.php', 'PrescriptionItem', 'Chat', "Message"];
        $models = array_diff($models, $unwanted_models);
        return array_map('removeSuffix', $models);

    }
}
