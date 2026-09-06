<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Entity;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $ministries = Category::create(['name' => 'Ministries', 'slug' => 'ministries']);
        $universities = Category::create(['name' => 'Universities & Research', 'slug' => 'universities']);
        $governorates = Category::create(['name' => 'Governorates & Municipalities', 'slug' => 'governorates']);

        // Create Sample Entities
        Entity::create([
            'category_id' => $ministries->id,
            'name' => 'Ministry of Communications and Technology',
            'official_url' => 'https://moct.gov.sy',
            'description' => 'Official government portal for communications and technology sector in Syria.',
            'address' => 'Damascus, Syria',
            'emergency_contact' => '123',
            'is_active' => true,
        ]);

        Entity::create([
            'category_id' => $universities->id,
            'name' => 'University of Damascus',
            'official_url' => 'https://damascusuniversity.edu.sy',
            'description' => 'The oldest and largest public university in Syria.',
            'address' => 'Damascus, Al-Mazzeh',
            'emergency_contact' => '011-339230',
            'is_active' => true,
        ]);

        Entity::create([
            'category_id' => $governorates->id,
            'name' => 'Damascus Governorate',
            'official_url' => 'https://damascus.gov.sy',
            'description' => 'Official services portal for Damascus city administration.',
            'address' => 'Damascus, Merjeh',
            'emergency_contact' => '113',
            'is_active' => true,
        ]);
    }
}
