<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'title' => 'حلول متكاملة لأنظمة التبريد والتكييف المركزية',
            'image' => 'hero/home.jpeg',
            'description' => 'نقدم أحدث الحلول المتكاملة في مجال غرف التبريد والتكييف والأنظمة المركزية، مصممة لتلبي احتياجاتك بدقة عالية وكفاءة استثنائية. نضمن لك بيئات مبردة ومكيفة بمعايير الجودة العالمية لقطاعات الصناعة والتجارة والخدمات.'
        ]);
    }
}
