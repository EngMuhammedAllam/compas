@extends('dashboard.layouts.master')
@section('title')
 الصفحة الرئيسية - غرف التبريد
@endsection
@section('content')
<!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Start::page-header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div>
                    <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                        مرحبًا بك في صفحة مراقبة غرف التبريد
                    </h1>
                    <span class="fs-semibold text-muted">هنا ستجد جميع التنبيهات المتعلقة بغرف التبريد</span>
                </div>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text-capitalize ">
                                <a href="{{ route('dashboard') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item text-capitalize active " aria-current="page">
                                غرف التبريد
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End::page-header -->
            <div class="detections-page">
                <div class="row">
                    <!-- حالات ارتفاع درجة الحرارة -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card custom-card overflow-hidden border-top-card border-top-warning">
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mb-1">
                                            <span class="d-block fw-semibold fs-16 text-capitalize">
                                                ارتفاع درجة الحرارة
                                            </span>
                                        </div>
                                        <div>
                                            <span class="avatar border-0 bg-warning">
                                                <i class="ti ti-temperature fs-20"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1">
                                            <span class="fs-24 fw-semibold">
                                                257
                                            </span>
                                            <span class="text-muted fs-12 ms-1 text-capitalize">
                                                حالة
                                            </span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted"> أكثر من الشهر الماضي</span>
                                            <span class="fs-12 text-success ms-2">
                                                <i class="ti ti-trending-up me-1 d-inline-block"></i>
                                                0.5%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="tempTrack"></div>
                            </div>
                        </div>
                    </div>

                    <!-- أعطال في نظام التبريد -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card custom-card overflow-hidden border-top-card border-top-danger">
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mb-1">
                                            <span class="d-block fw-semibold fs-16 text-capitalize">
                                                أعطال نظام التبريد
                                            </span>
                                        </div>
                                        <div>
                                            <span class="avatar border-0 bg-danger">
                                                <i class="ti ti-alert-octagon fs-20"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1">
                                            <span class="fs-24 fw-semibold">
                                                27
                                            </span>
                                            <span class="text-muted fs-12 ms-1 text-capitalize">
                                                حالة
                                            </span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted"> أقل من الشهر الماضي</span>
                                            <span class="fs-12 text-danger ms-2">
                                                <i class="ti ti-trending-down me-1 d-inline-block"></i>
                                                0.2%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="coolingFaultTrack"></div>
                            </div>
                        </div>
                    </div>

                    <!-- انقطاع التيار الكهربائي -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card custom-card overflow-hidden border-top-card border-top-info">
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mb-1">
                                            <span class="d-block fw-semibold fs-16 text-capitalize">
                                                انقطاع كهرباء
                                            </span>
                                        </div>
                                        <div>
                                            <span class="avatar border-0 bg-info">
                                                <i class="ti ti-power fs-20"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1">
                                            <span class="fs-24 fw-semibold">
                                                103
                                            </span>
                                            <span class="text-muted fs-12 ms-1 text-capitalize">
                                                حالة
                                            </span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted">أكثر من الشهر الماضي</span>
                                            <span class="fs-12 text-success ms-2">
                                                <i class="ti ti-trending-up me-1 d-inline-block"></i>
                                                0.8%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="powerTrack"></div>
                            </div>
                        </div>
                    </div>

                    <!-- جدول التنبيهات -->
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header justify-content-between">
                                        <div class="card-title text-capitalize">
                                            حالات غرف التبريد
                                        </div>
                                        <div class="d-flex">
                                            <div class="dropdown">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-primary btn-sm btn-wave waves-effect waves-light"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    ترتيب حسب<i
                                                        class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                                </a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="dropdown-item text-capitalize" href="javascript:void(0);">اليوم</a></li>
                                                    <li><a class="dropdown-item text-capitalize" href="javascript:void(0);">الشهر</a></li>
                                                    <li><a class="dropdown-item text-capitalize" href="javascript:void(0);">السنة</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="file-export" class="table table-bordered text-nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th><input class="form-check-input check-all" type="checkbox" id="all-products"></th>
                                                    <th>التاريخ</th>
                                                    <th>الوقت</th>
                                                    <th>الصورة</th>
                                                    <th>الغرفة</th>
                                                    <th>المنطقة</th>
                                                    <th>نوع الحالة</th>
                                                    <th>درجة الحرارة</th>
                                                    <th>الحالة</th>
                                                    <th>الإجراءات</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="product-list">
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>١٢ أكتوبر ٢٠٢٣</td>
                                                    <td>١٢:٠٩ ص</td>
                                                    <td><span class="avatar avatar-md p-0"><img src="{{ secure_asset('assets/images/cooling/temp-alert.jpg') }}" alt="تنبيه درجة حرارة"></span></td>
                                                    <td>#CR-08</td>
                                                    <td>المنطقة الشرقية</td>
                                                    <td>ارتفاع حرارة</td>
                                                    <td>٨.٥°م</td>
                                                    <td class="text-capitalize"><span class="badge bg-danger">حرج</span></td>
                                                    <td class="text-capitalize"><span class="badge bg-danger-transparent">تم التبليغ</span></td>
                                                    <td>
                                                        <div class="hstack gap-2 fs-15">
                                                            <a href="cooling-case.html" class="btn btn-icon btn-sm btn-primary-light" data-bs-toggle="tooltip" title="عرض التفاصيل">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- يمكنك تكرار الصفوف كما في النموذج الأصلي مع تعديل البيانات -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">أكثر الأيام نشاطًا في التنبيهات</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div id="heatmap-colorrange"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- خريطة المصنع + مخطط تحليلي -->
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">خريطة غرف التبريد</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="position-relative">
                                            <img id="myImgId" class="img-fluid" src="{{ secure_asset('assets/images/maps/cooling-rooms-map.png') }}" alt="خريطة غرف التبريد">
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <p class="m-0 fs-16 text-capitalize">خريطة توزيع غرف التبريد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">تقرير يومي لدرجات الحرارة</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div id="area-spline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End::app-content -->
@endsection