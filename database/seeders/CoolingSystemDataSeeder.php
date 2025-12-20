<?php

namespace Database\Seeders;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\Projects\ProjectCategory;
use App\Models\Service\Service;
use App\Models\Service\ServiceSection;
use App\Models\Contact;
use App\Models\Client;
use App\Models\Feature;
use App\Models\Counter;
use App\Models\Testimonials\Testimonial;
use App\Models\Testimonials\SectionTestimonial;
use App\Models\CoolingSensor;
use App\Models\TemperatureReading;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CoolingSystemDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Blog Categories
        $categories = [
            ['name' => 'غرف التبريد', 'is_active' => true],
            ['name' => 'أنظمة التكييف', 'is_active' => true],
            ['name' => 'الصيانة الوقائية', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            $blogCat = BlogCategory::updateOrCreate(['name' => $cat['name']], $cat);

            // 2. Blog Posts (spread systematically across last 6 months)
            for ($monthOffset = 0; $monthOffset < 6; $monthOffset++) {
                $postsPerMonth = rand(2, 4);
                for ($p = 0; $p < $postsPerMonth; $p++) {
                    $date = Carbon::now()->subMonths($monthOffset)->subDays(rand(1, 28));

                    BlogPost::create([
                        'title' => 'كيفية الحفاظ على ' . $cat['name'] . ' - ' . Str::random(5),
                        'excerpt' => 'تعرف على أفضل الممارسات للحفاظ على كفاءة ' . $cat['name'] . ' وتوفير الطاقة.',
                        'content' => 'محتوى مفصل حول أهمية الصيانة الدورية لـ ' . $cat['name'] . ' وكيفية تجنب الأعطال المفاجئة...',
                        'author' => 'م. أحمد علي',
                        'published_at' => $date,
                        'image' => 'cooling_room_' . rand(1, 3) . '.jpg',
                        'blog_category_id' => $blogCat->id,
                        'is_active' => true,
                        'views' => rand(500, 10000),
                        'created_at' => $date,
                    ]);
                }
            }
        }

        // 3. Project Categories
        $projCategories = [
            ['name' => 'غرف تبريد صناعية', 'slug' => 'industrial-cooling'],
            ['name' => 'أنظمة تكييف مركزي', 'slug' => 'central-ac'],
            ['name' => 'ثلاجات عرض تجارية', 'slug' => 'commercial-fridges'],
        ];

        foreach ($projCategories as $pc) {
            ProjectCategory::updateOrCreate(['slug' => $pc['slug']], [
                'name' => $pc['name'],
                'is_active' => true
            ]);
        }

        // 4. Service Section & Services
        $serviceSection = ServiceSection::firstOrCreate([], [
            'title' => 'خدماتنا المميزة',
            'description' => 'نقدم أفضل حلول التبريد والتكييف لعملائنا',
            'is_active' => true
        ]);

        $services = [
            'تركيب غرف تبريد متكاملة',
            'صيانة دورية لأنظمة التكييف',
            'توريد قطع غيار أصلية',
            'تصميم أنظمة تبريد موفرة للطاقة'
        ];

        foreach ($services as $s) {
            Service::create([
                'title' => $s,
                'description' => 'نحن متخصصون في ' . $s . ' بأعلى معايير الجودة العالمية.',
                'icon' => 'services/icon-0'.''.rand(1, 7).'.svg',
                'is_active' => true,
                'service_section_id' => $serviceSection->id
            ]);
        }

        for ($monthOffset = 0; $monthOffset < 6; $monthOffset++) {
            $contactsPerMonth = rand(10, 25);
            for ($i = 0; $i < $contactsPerMonth; $i++) {
                $date = Carbon::now()->subMonths($monthOffset)->subDays(rand(1, 28));

                Contact::create([
                    'fullname' => 'عميل محتمل ' . ($monthOffset . $i),
                    'email' => 'client' . $monthOffset . $i . '@example.com',
                    'phone' => '05' . rand(11111111, 99999999),
                    'subject' => 'استفسار عن خدمة ' . $services[rand(0, 3)],
                    'message' => 'أريد الاستفسار عن خدمة ' . $services[rand(0, 3)] . ' وتكلفة المشروع التقريبية لغرفة تبريد متوسطة.',
                    'created_at' => $date,
                ]);
            }
        }

        // 6. Clients
        $clients = ['شركة المراعي', 'مجموعة صافولا', 'مستشفى الملك فهد', 'هايبر بنده', 'كارفور'];
        foreach ($clients as $c) {
            Client::create([
                'name' => $c,
                'image' => 'client_logo.png'
            ]);
        }

        // 7. Testimonials
        $sectionTestimonial = SectionTestimonial::firstOrCreate([], ['title' => 'ماذا قالوا عنا', 'is_active' => true]);
        $testimonials = [
            ['name' => 'خالد محمد', 'position' => 'مدير فني', 'feedback' => 'أفضل شركة لتركيب غرف التبريد في المنطقة.'],
            ['name' => 'سارة أحمد', 'position' => 'مالكة مطعم', 'feedback' => 'سرعة في الاستجابة واحترافية عالية في الصيانة.'],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create([
                'name' => $t['name'],
                'position' => $t['position'],
                'message' => $t['feedback'],
                'section_testimonial_id' => $sectionTestimonial->id,
                'active' => true
            ]);
        }

        // 8. Features
        $features = [
            ['title' => 'خدمة 24 ساعة', 'description' => 'نحن متواجدون دائماً لخدمتكم في حالات الطوارئ'],
            ['title' => 'ضمان حقيقي', 'description' => 'نقدم ضماناً شاملاً على جميع أعمالنا وقطع الغيار'],
            ['title' => 'فريق متخصص', 'description' => 'مهندسون وفنيون مدربون على أعلى مستوى'],
        ];

        foreach ($features as $f) {
            Feature::create([
                'title' => $f['title'],
                'description' => $f['description'],
                'image' => 'feature_icon.png'
            ]);
        }

        // 9. Counters
        Counter::query()->delete();
        Counter::create(['title' => 'غرفة تبريد منفذة', 'number' => 150]);
        Counter::create(['title' => 'عميل راضي', 'number' => 500]);
        Counter::create(['title' => 'سنة خبرة', 'number' => 12]);
        Counter::create(['title' => 'فني متخصص', 'number' => 45]);

        // 10. Cooling Sensors & Readings
        $sensors = [
            ['name' => 'غرفة تبريد مخزن A', 'location' => 'مستودع 1', 'sensor_key' => 'SENSOR_001', 'min_threshold' => -5, 'max_threshold' => 10],
            ['name' => 'ثلاجة عرض اللحوم', 'location' => 'السوبر ماركت الرئيسي', 'sensor_key' => 'SENSOR_002', 'min_threshold' => 0, 'max_threshold' => 5],
            ['name' => 'غرفة تجميد الأسماك', 'location' => 'ميناء جدة', 'sensor_key' => 'SENSOR_003', 'min_threshold' => -20, 'max_threshold' => -10],
        ];

        foreach ($sensors as $s) {
            $sensor = CoolingSensor::updateOrCreate(['sensor_key' => $s['sensor_key']], $s);

            // Generate readings for the last 24 hours
            for ($h = 24; $h >= 0; $h--) {
                $temp = rand($s['min_threshold'] * 10, $s['max_threshold'] * 10) / 10;
                // Occasionally generate an alert/outlier
                if (rand(1, 100) > 90) {
                    $temp += rand(5, 10); // Heat spike
                }

                TemperatureReading::create([
                    'cooling_sensor_id' => $sensor->id,
                    'temperature' => $temp,
                    'created_at' => Carbon::now()->subHours($h)
                ]);
            }
        }
    }
}
