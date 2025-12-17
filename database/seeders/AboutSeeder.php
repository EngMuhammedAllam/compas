<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSection;
use App\Models\AboutPoint;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        $about = AboutSection::create([
            'title' => 'لماذا تختار خدماتنا',
            'subtitle' => 'نضمن لك أنظمة تبريد وتكييف مركزية بكفاءة وجودة عالية',
            'description' => 'نتميز بخبرة واسعة في تصميم وتركيب وصيانة أنظمة التبريد والتكييف المركزية. نستخدم أحدث التقنيات ونتابع أحدث المعايير العالمية لضمان أداء مثالي وطويل الأمد لأنظمتك.',
            'video_url' => 'https://www.youtube.com/watch?v=wBsEe-gpeCQ',
            'image1' => 'land/images/About1.jpeg',
            'image2' => 'land/images/About2.jpeg',
            'image3' => 'land/images/About3.jpeg',
        ]);

        $points = [
            'خبرة أكثر من 15 عاماً في مجال التبريد والتكييف',
            'فريق فني مؤهل ومدرب على أحدث التقنيات',
            'استخدام معدات وقطع غيار عالية الجودة',
            'خدمة عملاء على مدار 24/7 للطوارئ',
            'ضمان على الأعمال والقطع لمدة تصل إلى 5 سنوات',
        ];

        foreach ($points as $point) {
            AboutPoint::create([
                'about_section_id' => $about->id,
                'content' => $point,
            ]);
        }
    }
}
