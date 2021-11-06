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

        $group = FilterGroup::create(['title' => "Մարզ","position" => 3, "type" => "select", "name" => "region","cat" => FilterGroup::CAT_HALL]);

        foreach ($regions as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $group = FilterGroup::create(['title' => "Մարզ","position" => 3, "type" => "select", "name" => "region","cat" => FilterGroup::CAT_SERVICE]);

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

        $group = FilterGroup::create(['title' => "Գին","position" => 6, "type" => "checkbox", "name" => "price","cat" => FilterGroup::CAT_HALL]);

        foreach ($prices as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $custom = [
            "Ավտոկայանատեղի",
            "Այգի",
            "Շատրվան",
            "Կենդանի երաժշտություն",
            "Լողավազան",
            "Մանկական սենյակ",
            "Պարահրապարակ",
        ];

        $group = FilterGroup::create(['title' => "Լրացուցիչ","position" => 1, "type" => "checkbox", "name" => "custom","cat" => FilterGroup::CAT_HALL]);

        foreach ($custom as $k => $item) {
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $types = [
            "Հարսանյաց սրահ",
            "Մանկական սրճարան",
            "Հանդիսությունների սրահ",
            "Քոթեջ",
            "Հանգստյան Տներ",
            "Վիլլաներ",
        ];

        $group = FilterGroup::create(['title' => "Տիպ","position" => 2, "type" => "select", "name" => "type","cat" => FilterGroup::CAT_HALL]);

        foreach ($types as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }

        $group = FilterGroup::create(['title' => "Տիպ","position" => 2, "type" => "select", "name" => "type","cat" => FilterGroup::CAT_SERVICE]);

        foreach ($types as $k => $item){
            $group->items()->create(['position' => $k, "title" => $item]);
        }
    }
}
