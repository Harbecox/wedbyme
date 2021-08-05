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

        $group = FilterGroup::create(['title' => "Լրացուցիչ","position" => 1, "type" => "checkbox", "name" => "custom"]);

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

        $group = FilterGroup::create(['title' => "Տիպ","position" => 2, "type" => "select", "name" => "type"]);

        foreach ($types as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $regions = [
            'Երևան',
            'Արագածոտն',
            'Արարատ',
            'Արմավիր',
            'Վայոց ձոր',
            'Գեղարքունիք',
            'Կոտայք',
            'Լոռի',
            'Սյունիք',
            'Տավուշ',
            'Շիրակ',
        ];

        $group = FilterGroup::create(['title' => "Մարզ","position" => 3, "type" => "select", "name" => "region"]);

        foreach ($regions as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $prices = [
            '1000-3000',
            '3000-10000',
            '10000-30000',
            '30000-100000',
            '100000+',
        ];

        $group = FilterGroup::create(['title' => "Գին","position" => 6, "type" => "checkbox", "name" => "price"]);

        foreach ($prices as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }
    }
}
