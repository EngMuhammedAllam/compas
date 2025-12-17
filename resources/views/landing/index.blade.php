@extends('landing.layouts.master' , ['page' => 'home'])

@section('title')
{{ config('app.name') }}
@endsection

@section('content')
<main>
    <!-- ===== Hero Start ===== -->
    <section class="gj do ir hj sp jr i pg hero-section" dir="ltr" style="margin:20px !important;">
        <!-- Hero Images -->
        <div class="xc fn zd/2 2xl:ud-w-187.5 bd 2xl:ud-h-171.5 h q r">
            <img src="{{ secure_asset('land/images/shape-02.svg')}}" alt="shape" class="xc 2xl:ud-block h u p va" />
            <img src="{{ secure_asset('land/images/shape-03.svg')}}" alt="shape" class="xc 2xl:ud-block h v w va" />

            <!-- Hero Container المحسن -->
            <div class="hero-container ud-shadow-xl ud-rounded-lg">
                <img src="{{ secure_asset('storage/' . $heroSection->image) }}" alt="أنظمة التبريد والتكييف المركزية" class="ud-object-cover" />
                <div class="overlay ud-bg-black/50"></div>
                <div class="content ud-px-4 ud-py-8">
                    <div class="ud-max-w-4xl ud-mx-auto">

                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="bb ze ki xn 2xl:ud-px-0">
            <div class="tc _o">
                <div class="animate_left jn/2">
                    <h1 class="fk vj zp or kk wm wb">{{ $heroSection->title }}</h1>
                    <p class="fq">
                        {{ $heroSection->description }}
                    </p>

                    <div class="tc tf yo zf mb">
                        <a href="#!" class="ek jk lk gh gi hi rg ml il vc _d _l">اطلب استشارة مجانية</a>

                        <span class="tc sf">
                            <a href="#!" class="inline-block ek xj kk wm"> اتصل بنا : 0123456789 </a>
                            <span class="inline-block">للاستفسارات والحلول المتخصصة</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Hero End ================ -->

    <!-- ================ Small Features Start ================ -->
    <section id="features">
        <div class="bb ze ki yn 2xl:ud-px-12.5">
            <div class="tc uf zo xf ap zf bp mq">
                <!-- مميزات التبريد والتكييف - العنصر 1 -->
                @foreach ($features as $feature)
                <div class="animate_left jn/2">
                    <img src="{{ secure_asset('storage/' . $feature->image) }}" style="width: 50px; height: 50px;align-self: center;" alt="مميزات التبريد والتكييف" class="ib" />
                    <h4 class="ek yj mk gb">{{ $feature->title }}</h4>
                    <p class="fq">
                        {{ $feature->description }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== Small Features End ===== -->

    <!-- ===== About Start ===== -->
    <section class="ji gp uq 2xl:ud-py-0 pg i pg qh rm ji hp " style="margin:30px">
        <div class="bb ze ki xn wq">
            <div class="tc wf gg qq">
                <!-- About Images -->
                <div class="animate_left xc gn gg jn/2 i">
                    <div>
                        <img src="{{ secure_asset('land/images/shape-05.svg')}}" alt="Shape" class="h -ud-left-5 x" />
                        <img src="{{ secure_asset('land/images/About1.jpeg')}}" style="height: 350px !important;width: 300px !important;" alt="أنظمة التبريد المتطورة" class="ib" />
                        <img src="{{ secure_asset('land/images/About2.jpeg')}}" style="height: 300px !important;width: 300px !important;" height="100" alt="تركيب الأنظمة المركزية" />
                    </div>
                    <div>
                        <img src="{{ secure_asset('land/images/About3.jpeg')}}" style="height: 300px !important;width: 300px !important;" alt="صيانة الأنظمة" class="ob gb" />
                        <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="Shape" class="bb" />
                    </div>
                </div>

                <!-- About Content -->
                <div class="animate_right jn/2" id="about">
                    <h4 class="ek yj mk gb">{{ $aboutSection->title ?? 'لماذا تختار خدماتنا' }}</h4>
                    <h2 class="fk vj zp pr kk wm qb">{{ $aboutSection->subtitle ?? 'نضمن لك أنظمة تبريد وتكييف مركزية بكفاءة وجودة عالية' }}</h2>
                    <p class="uo">{{ $aboutSection->description ?? '' }}</p>

                    <ul class="uo mb-6">
                        @foreach ($aboutSection->points as $point)
                        <li class="mb-2">• {{ $point->content }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ $aboutSection->video_url ?? 'https://www.youtube.com/watch?v=wBsEe-gpeCQ' }}" data-fslightbox class="vc wf hg mb">
                        <span class="tc wf xf be dd rg i gh ua">
                            <span class="nf h vc yc vd rg gh qk -ud-z-1"></span>
                            <img src="{{ secure_asset('land/images/icon-play.svg')}}" alt="تشغيل" />
                        </span>
                        <span class="kk" style="color:#7c828c">شاهد كيفية عملنا</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== About End ===== -->

    <!-- ===== Projects Start ===== -->
    <section class="pg pj vp mr oj wp nr iq rm ji gp uq" id="projects">

        <!-- Section Title Start -->
        <div
            x-data="{
                sectionTitle: '{{ $projectSection->title ?? '' }}',
                sectionTitleText: '{{ $projectSection->description ?? '' }}'
            }">
            <div class="animate_top bb ze rj ki xn vq">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>
        </div>
        <!-- Section Title End -->

        <!-- Tabs & Projects -->
        <div class="bb ze ki xn 2xl:ud-px-0 jb" x-data="{ filterTab: 0 }">

            <!-- Project Tabs -->
            <div class="projects-tab _e bb tc uf wf xf cg rg hh rm vk xm si ti fc">

                <button
                    @click="filterTab = 0"
                    :class="{ 'gh lk' : filterTab === 0 }"
                    class="project-tab-btn ek rg ml il vi mi">
                    جميع المشاريع
                </button>

                @foreach ($projectcategories as $index => $category)
                @php $tabIndex = $index + 1; @endphp

                <button
                    @click="filterTab = {{ $tabIndex }} * 1"
                    :class="{ 'gh lk' : filterTab === {{ $tabIndex }} * 1 }"
                    class="project-tab-btn ek rg ml il vi mi">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

            <!-- Projects Wrapper -->
            <div class="projects-wrapper tc -ud-mx-5">
                <div class="project-sizer"></div>

                @foreach ($projectcategories as $index => $category)
                @php $tabIndex = $index + 1; @endphp

                @foreach ($category->images as $image)

                <div
                    class="project-item wi fb vd jn/2 to/3 {{ $category->slug }}"
                    x-show="filterTab === 0 || filterTab === {{ $tabIndex }} * 1"
                    x-transition
                    x-cloak>

                    <div class="c i pg sg z-1">

                        <img src="{{ secure_asset('storage/projects/' . $image->image) }}"
                            alt="{{ $image->title ?? $category->name }}"
                            style="width:100%; height:350px" />

                        <div class="h s r df nl kl im tc sf wf xf vd yc sg al hh/20 z-10">
                            <h4 class="ek tj kk hc">
                                {{ $image->title ?? $category->name }}
                            </h4>

                            <p>{{ $image->description ?? '' }}</p>

                            <a class="c tc wf xf ie ld rg _g dh ml il ph jm km jc" href="#!">
                                <svg class="th lm ml il" width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.4763 6.16664L6.00634 1.69664L7.18467 0.518311L13.6663 6.99998L7.18467 13.4816L6.00634 12.3033L10.4763 7.83331H0.333008V6.16664H10.4763Z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

                @endforeach
                @endforeach
            </div>

        </div>

    </section>
    <!-- ===== Projects End ===== -->

    <!-- ===== Services Start ===== -->
    <section class="lj tp kr i pg fh rm ji gp uq">

        <!-- Section Title Start -->
        <div
            x-data="{
                sectionTitle: '{{ $serviceSection->title ?? '' }}',
                sectionTitleText: '{{ $serviceSection->description ?? '' }}'
            }">

            <div class="animate_top bb ze rj ki xn vq">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>

        </div>
        <!-- Section Title End -->

        <div class="bb ze ki xn yq mb en">
            <div class="wc qf pn xo ng">

                @foreach ($services as $service)
                <div class="animate_top sg oi pi zq ml il am cn _m">

                    @if($service->icon)
                    <img src="{{ secure_asset('storage/' . $service->icon) }}" alt="{{ $service->title }}">
                    @else
                    <img src="{{ secure_asset('land/images/shape-08.svg') }}" alt="{{ $service->title }}">
                    @endif

                    <h4 class="ek zj kk wm nb _b">{{ $service->title }}</h4>

                    <p>{{ $service->description }}</p>

                </div>
                @endforeach

            </div>
        </div>

    </section>
    <!-- ===== Services End ===== -->

    <!-- ===== Testimonials Start ===== -->
    <section class="hj rp hr"
        style="background-image: url('{{ asset('land/images/shape-08.svg')}}'); 
            background-repeat: no-repeat; 
            background-position: center; 
            padding-top: 8rem; 
            padding-bottom: 8rem;">

        <!-- Section Title Start -->
        <div
            x-data="{
                sectionTitle: '{{ $testimonialSection->title ?? '' }}',
                sectionTitleText: '{{ $testimonialSection->description ?? '' }}'
            }">

            <div class="animate_top bb ze rj ki xn vq">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>

                @if($testimonialSection->subtitle)
                <p class="bb on/5 wo/5 hq">{{ $testimonialSection->subtitle }}</p>
                @endif

                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>

        </div>
        <!-- Section Title End -->

        <div class="bb ze ki xn ar">
            <div class="animate_top jb cq">

                <div class="swiper testimonial-01">

                    <div class="swiper-wrapper">

                        @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="i hh rm sg vk xm bi qj">

                                <!-- Border Shape -->
                                <span class="rc je md/2 gh xg h q r"></span>
                                <span class="rc je md/2 mh yg h q p"></span>

                                <div class="tc sf rn tn un zf dp">

                                    <div>
                                        <img src="{{ secure_asset('land/images/icon-quote.svg')}}" alt="اقتباس" />

                                        <p class="ek ik xj _p kc fb">
                                            "{{ $testimonial->message }}"
                                        </p>

                                        <div class="tc yf vf">
                                            <div>
                                                <span class="rc ek xj kk wm zb">{{ $testimonial->name }}</span>

                                                @if($testimonial->position)
                                                <span class="rc">{{ $testimonial->position }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Navigation -->
                    <div class="tc wf xf fg jb">
                        <div class="swiper-button-prev c tc wf xf ie ld rg _g dh pf ml vr hh rm tl zm rl ym">
                            <svg class="th lm" width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.52366 7.83336L7.99366 12.3034L6.81533 13.4817L0.333663 7.00002L6.81533 0.518357L7.99366 1.69669L3.52366 6.16669L13.667 6.16669L13.667 7.83336L3.52366 7.83336Z"
                                    fill="" />
                            </svg>
                        </div>

                        <div class="swiper-button-next c tc wf xf ie ld rg _g dh pf ml vr hh rm tl zm rl ym">
                            <svg class="th lm" width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.4763 6.16664L6.00634 1.69664L7.18467 0.518311L13.6663 6.99998L7.18467 13.4816L6.00634 12.3033L10.4763 7.83331H0.333008V6.16664H10.4763Z"
                                    fill="" />
                            </svg>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>

    <!-- ===== Testimonials End ===== -->

    <!-- ===== Counter Start ===== -->
    <section class="i pg qh rm ji hp">
        <img src="{{ secure_asset('land/images/shape-11.svg')}}" alt="Shape" class="of h ga ha ke" />
        <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="Shape" class="h ia o ae jf" />
        <img src="{{ secure_asset('land/images/shape-14.svg')}}" alt="Shape" class="h ja ka" />
        <img src="{{ secure_asset('land/images/shape-15.svg')}}" alt="Shape" class="h q p" />

        <div class="bb ze i va ki xn br">
            <div class="tc uf sn tn xf un gg">

                @foreach($counters as $counter)
                <div class="animate_top me/5 ln rj">
                    <h2 class="gk vj zp or kk wm hc">{{ $counter->number }}</h2>
                    <p class="ek bk aq">{{ $counter->title }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- ===== Counter End ===== -->

    <!-- ===== Blog Start ===== -->
    <section class="ji gp uq" id="news">

        <!-- Section Title Start -->
        <div
            x-data="{
            sectionTitle: 'أحدث المقالات والأخبار',
            sectionTitleText: 'تابع أحدث المستجدات والتقنيات في عالم التبريد والتكييف. نشارككم نصائح وخبرات تساعدكم في الحفاظ على كفاءة أنظمتكم وتوفير الطاقة.'
        }">

            <div class="animate_top bb ze rj ki xn vq">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>

        </div>
        <!-- Section Title End -->

        <div class="bb ye ki xn vq jb jo">
            <div class="wc qf pn xo zf iq">

                @foreach ($posts as $post)
                <div class="animate_top sg vk rm xm">

                    <!-- Image -->
                    <div class="c rc i z-1 pg">
                        <img class="w-full"
                            src="{{ secure_asset('storage/blogs/' . $post->image ?? 'land/images/blog-01.jpg') }}"
                            alt="{{ $post->title }}"
                            style="height: 329px;width: 100%;" />

                        <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                            <a href="{{ route('blog.show', $post->id) }}"
                                class="vc ek rg lk gh sl ml il gi hi">
                                اقرأ المزيد
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="yh">

                        <div class="tc uf wf ag jq">

                            <!-- Author -->
                            <div class="tc wf ag">
                                <img src="{{ secure_asset('land/images/icon-man.svg') }}" alt="كاتب" />
                                <p>{{ $post->author }}</p>
                            </div>

                            <!-- Date -->
                            <div class="tc wf ag">
                                <img src="{{ secure_asset('land/images/icon-calender.svg') }}" alt="تاريخ" />
                                <p>{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</p>
                            </div>

                        </div>

                        <!-- Title -->
                        <h4 class="ek tj ml il kk wm xl eq lb">
                            <a href="{{ route('blog.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h4>

                    </div>

                </div>
                @endforeach

            </div>
        </div>

    </section>

    <!-- ===== Blog End ===== -->

    <!-- ===== Contact Start ===== -->
    <section id="support" class="i pg fh rm ji gp uq" dir="rtl">
        <!-- الأشكال الخلفية -->
        <img src="{{ secure_asset('land/images/shape-03.svg')}}" alt="شكل" class="h ca u" />
        <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="شكل" class="h w da ee" />
        <img src="{{ secure_asset('land/images/shape-12.svg')}}" alt="شكل" class="h p s" />
        <img src="{{ secure_asset('land/images/shape-13.svg')}}" alt="شكل" class="h r q" />

        <!-- عنوان القسم -->
        <div id="contact" class="bb ze rj ki xn vq mb en"
            x-data="{ sectionTitle: `تواصل معنا`, sectionTitleText: `نحن متخصصون في تصميم وتنفيذ غرف التبريد والتجميد وأنظمة التكييف المركزي بجودة عالية. تواصل معنا لأي استفسار أو طلب عرض سعر.` }">
            <div class="animate_top bb ze rj ki xn vq text-center">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>
        </div>

        <!-- محتوى التواصل -->
        <div class="i va bb ye ki xn wq jb mo">
            <div class="tc uf sn tf rn un zf xl:gap-10 flex flex-wrap gap-8">

                <!-- معلومات التواصل -->
                <div class="animate_top w-full lg:w-1/2 mn/5 to/3 vk sg hh sm yh rq i pg relative">
                    <img src="{{ secure_asset('land/images/shape-03.svg')}}" alt="شكل" class="h la x wd absolute top-0 left-0" />

                    <div class="fb space-y-6">
                        <div>
                            <h4 class="wj kk wm cc">البريد الإلكتروني</h4>
                            <p><a href="mailto:{{ $contactSetting->email ?? '' }}">{{ $contactSetting->email ?? '' }}</a></p>
                        </div>

                        <div>
                            <h4 class="wj kk wm cc">موقع المكتب</h4>
                            <p>{{ $contactSetting->address ?? '' }}</p>
                        </div>

                        <div>
                            <h4 class="wj kk wm cc">رقم الهاتف</h4>
                            <p><a href="tel:{{ $contactSetting->phone ?? '' }}">{{ $contactSetting->phone  ?? ''}}</a></p>
                        </div>

                        <div>
                            <h4 class="wj kk wm cc">واتساب الدعم الفني</h4>
                            <p><a href="https://wa.me/{{ $contactSetting->phone ?? '' }}">اضغط هنا للتحدث الآن</a></p>
                        </div>

                        <div>
                            <h4 class="wj kk wm qb">تابعنا على</h4>
                            <ul class="tc wf fg flex gap-4">
                                @if($contactSetting && $contactSetting->facebook)
                                <li><a href="{{ $contactSetting->facebook }}" class="c tc wf xf ie ld rg ml il tl" aria-label="فيسبوك"><i class="fa-brands fa-facebook-f"></i></a></li>
                                @endif
                                @if($contactSetting && $contactSetting->twitter)
                                <li><a href="{{ $contactSetting->twitter }}" class="c tc wf xf ie ld rg ml il tl" aria-label="تويتر"><i class="fa-brands fa-x-twitter"></i></a></li>
                                @endif
                                @if($contactSetting && $contactSetting->linkedin)
                                <li><a href="{{ $contactSetting->linkedin }}" class="c tc wf xf ie ld rg ml il tl" aria-label="لينكدإن"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                @endif
                                @if($contactSetting && $contactSetting->instagram)
                                <li><a href="{{ $contactSetting->instagram }}" class="c tc wf xf ie ld rg ml il tl" aria-label="إنستجرام"><i class="fa-brands fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- نموذج التواصل -->
                <div class="animate_top w-full lg:w-1/2 nn/5 vo/3 vk sg hh sm yh tq">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="tc sf yo ap zf ep qb">
                            <div class="vd to/2">
                                <label class="rc ac" for="fullname">الاسم الكامل</label>
                                <input type="text" name="fullname" id="fullname" placeholder="أدخل اسمك الكامل"
                                    class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                            </div>

                            <div class="vd to/2">
                                <label class="rc ac" for="email">البريد الإلكتروني</label>
                                <input type="email" name="email" id="email" placeholder="example@email.com"
                                    class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                            </div>
                        </div>

                        <div class="tc sf yo ap zf ep qb">
                            <div class="vd to/2">
                                <label class="rc ac" for="phone">رقم الهاتف</label>
                                <input type="text" name="phone" id="phone" placeholder="+20 123 456 7890"
                                    class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                            </div>

                            <div class="vd to/2">
                                <label class="rc ac" for="subject">عنوان الرسالة</label>
                                <input type="text" name="subject" id="subject" placeholder="استفسار عن غرفة تبريد"
                                    class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                            </div>
                        </div>

                        <div class="fb">
                            <label class="rc ac" for="message">الرسالة</label>
                            <textarea name="message" id="message" rows="4" placeholder="أدخل رسالتك أو طلبك هنا..."
                                class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 ci"></textarea>
                        </div>

                        <div class="tc xf mt-4">
                            <button type="submit" class="vc rg lk gh ml il hi gi _l">إرسال الرسالة</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== Contact End ===== -->

    <!-- ===== CTA Start ===== -->
    <section class="i pg gh ji" dir="rtl" style="text-align:center;">
        <!-- خلفية زخرفية -->
        <img class="h p q" src="{{ secure_asset('land/images/shape-16.svg')}}" alt="شكل زخرفي" />

        <div class="bb ye i z-10 ki xn dr">
            <div class="tc uf sn tn un gg">
                <!-- النص -->
                <div class="animate_left to/2">
                    <h2 class="fk vj zp pr lk ac">
                        {{ $ctaSection->title ?? 'انضم إلى أكثر من 1000 عميل يثقون بخدماتنا في غرف التبريد والتجميد وأنظمة التكييف.' }}
                    </h2>
                    <p class="lk">
                        {{ $ctaSection->description ?? 'نقدم حلول متكاملة في تصميم وتنفيذ غرف التبريد والتجميد وأنظمة التكييف المركزي للمصانع، المخازن، والمشروعات التجارية بجودة وكفاءة عالية.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== CTA End ===== -->
</main>

@endsection