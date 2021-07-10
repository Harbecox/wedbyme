<?php

namespace Database\Seeders;

use App\Models\FilterGroup;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $custom = [
            "Ավտոկայանատեղի",
            "Այգի",
            "Շատրվան",
            "Կենդանի երաժշտություն",
            "Լողավազան",
            "Մանկական սենյակ",
            "Պարահրապարակ",
        ];

        $group = FilterGroup::create(['title' => "Լրացուցիչ","position" => 1, "type" => "checkbox"]);

        foreach ($custom as $k => $item) {
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $types = [
            "Հարսանյաց սրահ",
            "Սգո սրահ",
            "Հանդիսությունների սրահ",
            "Քոթեջ",
            "Հանգստյան Տներ",
            "Վիլլաներ",
        ];

        $group = FilterGroup::create(['title' => "Տիպ","position" => 2, "type" => "select"]);

        foreach ($types as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }
    }
}
