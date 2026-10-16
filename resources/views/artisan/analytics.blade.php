<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>التحليلات - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .analytics-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .analytics-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .analytics-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .analytics-breadcrumb a:hover { text-decoration: underline; }
        .analytics-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .analytics-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .analytics-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .analytics-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .analytics-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .analytics-header__period { display: flex; gap: 6px; flex-wrap: wrap; }
        .analytics-header__period .period-btn { padding: 4px 14px; border-radius: 9999px; border: 1px solid rgba(200,199,184,0.2); background: rgba(255,255,255,0.6); backdrop-filter: blur(4px); font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; color: #77786b; }
        .analytics-header__period .period-btn:hover { border-color: #9E2A2B; color: #9E2A2B; background: rgba(159,42,43,0.04); }
        .analytics-header__period .period-btn.active { background: #9E2A2B; color: #ffffff; border-color: #9E2A2B; }
        .analytics-stats { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .analytics-stat { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); padding: 16px 18px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; }
        .analytics-stat:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.06); border-color: #D4AF37; }
        .analytics-stat__top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
        .analytics-stat__top .material-symbols-outlined { font-size: 26px; color: #9E2A2B; }
        .analytics-stat__top .trend { font-size: 0.65rem; font-weight: 700; padding: 2px 10px; border-radius: 9999px; }
        .trend--up { background: rgba(84,98,58,0.12); color: #54623A; }
        .trend--down { background: rgba(220,53,69,0.12); color: #dc3545; }
        .trend--neutral { background: rgba(200,199,184,0.15); color: #77786b; }
        .analytics-stat__number { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; }
        .analytics-stat__label { font-size: 0.75rem; color: #77786b; }
        .analytics-charts { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .analytics-chart { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 4px 16px rgba(0,0,0,0.04); overflow: hidden; }
        .analytics-chart__header { display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-bottom: 1px solid rgba(200,199,184,0.06); }
        .analytics-chart__header h3 { font-size: 0.9rem; font-weight: 700; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 8px; }
        .analytics-chart__header h3 .material-symbols-outlined { color: #9E2A2B; }
        .analytics-chart__body { padding: 16px 20px; min-height: 200px; }
        .chart-bars { display: flex; align-items: flex-end; justify-content: space-between; height: 150px; gap: 6px; padding-top: 8px; }
        .chart-bar { flex: 1; border-radius: 6px 6px 0 0; min-height: 16px; transition: all 0.3s ease; position: relative; cursor: pointer; }
        .chart-bar:hover { opacity: 0.8; transform: scaleY(1.02); }
        .chart-bar__tooltip { position: absolute; top: -28px; left: 50%; transform: translateX(-50%); background: #1c1c16; color: #ffffff; font-size: 0.55rem; font-weight: 700; padding: 2px 8px; border-radius: 4px; opacity: 0; transition: opacity 0.3s ease; white-space: nowrap; }
        .chart-bar:hover .chart-bar__tooltip { opacity: 1; }
        .chart-labels { display: flex; justify-content: space-between; margin-top: 6px; font-size: 0.6rem; color: #a0a094; }
        .chart-labels span { flex: 1; text-align: center; }
        .top-products { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 4px 16px rgba(0,0,0,0.04); overflow: hidden; position: relative; z-index: 1; margin: 0 20px; }
        .top-products__header { display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-bottom: 1px solid rgba(200,199,184,0.06); }
        .top-products__header h3 { font-size: 0.9rem; font-weight: 700; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 8px; }
        .top-products__header h3 .material-symbols-outlined { color: #9E2A2B; }
        .top-products__header a { font-size: 0.75rem; font-weight: 600; color: #9E2A2B; text-decoration: none; display: flex; align-items: center; gap: 4px; transition: color 0.3s; }
        .top-products__header a:hover { color: #6F1D1B; }
        .top-products__header a .material-symbols-outlined { font-size: 1rem; }
        .top-products__body { padding: 4px 0; }
        .top-product-item { display: flex; align-items: center; gap: 12px; padding: 8px 20px; border-bottom: 1px solid rgba(200,199,184,0.04); transition: all 0.2s ease; }
        .top-product-item:hover { background: rgba(159,42,43,0.02); }
        .top-product-item:last-child { border-bottom: none; }
        .top-product-item__rank { font-size: 0.75rem; font-weight: 800; color: #77786b; min-width: 22px; }
        .top-product-item__rank--1 { color: #D4AF37; }
        .top-product-item__rank--2 { color: #bdc3c7; }
        .top-product-item__rank--3 { color: #e67e22; }
        .top-product-item__image { width: 36px; height: 36px; border-radius: 8px; background: #f7f3e9; overflow: hidden; flex-shrink: 0; }
        .top-product-item__image img { width: 100%; height: 100%; object-fit: cover; }
        .top-product-item__info { flex: 1; }
        .top-product-item__info h4 { font-size: 0.8rem; font-weight: 600; color: #1c1c16; margin: 0; }
        .top-product-item__info .category { font-size: 0.6rem; color: #77786b; }
        .top-product-item__sales { font-size: 0.8rem; font-weight: 700; color: #9E2A2B; }
        .top-product-item__revenue { font-size: 0.8rem; font-weight: 600; color: #6F1D1B; min-width: 50px; text-align: left; }
        .analytics-activity { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 4px 16px rgba(0,0,0,0.04); overflow: hidden; position: relative; z-index: 1; margin: 20px 20px 0 20px; }
        .analytics-activity__header { display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-bottom: 1px solid rgba(200,199,184,0.06); }
        .analytics-activity__header h3 { font-size: 0.9rem; font-weight: 700; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 8px; }
        .analytics-activity__header h3 .material-symbols-outlined { color: #9E2A2B; }
        .analytics-activity__body { padding: 4px 0; }
        .activity-item { display: flex; align-items: center; gap: 12px; padding: 8px 20px; border-bottom: 1px solid rgba(200,199,184,0.04); }
        .activity-item:last-child { border-bottom: none; }
        .activity-item__icon { width: 34px; height: 34px; border-radius: 9999px; background: rgba(159,42,43,0.06); display: flex; align-items: center; justify-content: center; color: #9E2A2B; flex-shrink: 0; }
        .activity-item__icon .material-symbols-outlined { font-size: 18px; }
        .activity-item__content { flex: 1; }
        .activity-item__content .text { font-size: 0.8rem; color: #1c1c16; }
        .activity-item__content .text strong { color: #6F1D1B; }
        .activity-item__content .time { font-size: 0.6rem; color: #a0a094; }
        .empty-message { text-align: center; padding: 30px; color: #77786b; font-size: 0.9rem; }
        @media (max-width: 1024px) { .analytics-charts { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 768px) {
            .analytics-page { margin-top: 16px; padding: 12px 0 24px; }
            .analytics-header { flex-direction: column; align-items: stretch; padding: 0 16px; }
            .analytics-header__title p { margin-right: 0; }
            .analytics-header__period { justify-content: center; }
            .analytics-charts { grid-template-columns: 1fr; padding: 0 16px; }
            .analytics-stats { grid-template-columns: 1fr 1fr; gap: 12px; padding: 0 16px; }
            .analytics-stat { padding: 14px 16px; }
            .analytics-stat__number { font-size: 1.5rem; }
            .top-products { margin: 0 16px; }
            .analytics-activity { margin: 16px 16px 0 16px; }
            .top-product-item { flex-wrap: wrap; gap: 4px; }
            .top-product-item__revenue { text-align: right; min-width: auto; }
            .analytics-breadcrumb { padding: 0 16px; }
            .chart-bars { height: 120px; gap: 4px; }
            .chart-labels { font-size: 0.55rem; }
        }
        @media (max-width: 480px) {
            .analytics-stats { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .analytics-stat { padding: 12px 14px; }
            .analytics-stat__number { font-size: 1.3rem; }
            .analytics-charts { padding: 0 12px; }
            .analytics-chart__body { padding: 12px 14px; min-height: 140px; }
            .analytics-chart__header { padding: 10px 14px; }
            .top-products { margin: 0 12px; }
            .analytics-activity { margin: 14px 12px 0 12px; }
            .top-product-item { padding: 6px 12px; }
            .top-product-item__image { width: 30px; height: 30px; }
            .top-product-item__info h4 { font-size: 0.75rem; }
            .activity-item { padding: 6px 12px; }
            .analytics-header__period .period-btn { font-size: 0.65rem; padding: 3px 10px; }
            .analytics-breadcrumb { padding: 0 12px; }
            .analytics-header { padding: 0 12px; }
            .chart-bars { height: 100px; gap: 3px; }
            .chart-labels { font-size: 0.5rem; }
            .analytics-stat__top .material-symbols-outlined { font-size: 22px; }
            .analytics-stat__top .trend { font-size: 0.55rem; padding: 1px 8px; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="container navbar__inner">
            <a href="{{ route('artisan.home') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Handora Logo" />
                <span class="logo__brand">Handora</span>
            </a>
            <nav class="nav-desktop">
                <a href="{{ route('artisan.home') }}" class="nav-desktop__link">الرئيسية</a>
                <a href="{{ route('artisan.products') }}" class="nav-desktop__link">منتجاتي</a>
                <a href="{{ route('artisan.orders') }}" class="nav-desktop__link">الطلبات</a>
                <a href="{{ route('artisan.analytics') }}" class="nav-desktop__link active">التحليلات</a>
            </nav>
            <div class="nav-actions">
                <div class="nav-actions__buttons">
                    <a href="{{ route('artisan.add-product') }}"><button class="btn btn--primary">إضافة منتج</button></a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn--outline">تسجيل الخروج</button>
                    </form>
                </div>
                <button class="menu-toggle" aria-label="القائمة">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- ===== ANALYTICS PAGE ===== -->
    <main class="analytics-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="analytics-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">التحليلات</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="analytics-header">
                <div class="analytics-header__title">
                    <h1>
                        <span class="material-symbols-outlined">analytics</span>
                        التحليلات
                    </h1>
                    <p>نظرة شاملة على أداء متجرك ومبيعاتك</p>
                </div>
                <div class="analytics-header__period">
                    <button class="period-btn">اليوم</button>
                    <button class="period-btn active">هذا الأسبوع</button>
                    <button class="period-btn">هذا الشهر</button>
                    <button class="period-btn">هذا العام</button>
                </div>
            </div>

            <!-- ===== Stats Cards ===== -->
            <div class="analytics-stats">
                <div class="analytics-stat">
                    <div class="analytics-stat__top">
                        <span class="material-symbols-outlined">payments</span>
                        <span class="trend trend--up">▲ +12.5%</span>
                    </div>
                    <div class="analytics-stat__number">${{ number_format($totalSales ?? 0, 0) }}</div>
                    <div class="analytics-stat__label">إجمالي الإيرادات</div>
                </div>
                <div class="analytics-stat">
                    <div class="analytics-stat__top">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        <span class="trend trend--up">▲ +8.3%</span>
                    </div>
                    <div class="analytics-stat__number">{{ $totalOrders ?? 0 }}</div>
                    <div class="analytics-stat__label">إجمالي الطلبات</div>
                </div>
                <div class="analytics-stat">
                    <div class="analytics-stat__top">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <span class="trend trend--up">▲ +15.2%</span>
                    </div>
                    <div class="analytics-stat__number">{{ $totalProducts ?? 0 }}</div>
                    <div class="analytics-stat__label">إجمالي المنتجات</div>
                </div>
                <div class="analytics-stat">
                    <div class="analytics-stat__top">
                        <span class="material-symbols-outlined">star</span>
                        <span class="trend trend--neutral">— ثابت</span>
                    </div>
                    <div class="analytics-stat__number">4.9</div>
                    <div class="analytics-stat__label">متوسط التقييم</div>
                </div>
            </div>

            <!-- ===== Charts Grid ===== -->
            <div class="analytics-charts">

                <!-- Chart 1: Sales -->
                <div class="analytics-chart">
                    <div class="analytics-chart__header">
                        <h3>
                            <span class="material-symbols-outlined">trending_up</span>
                            المبيعات الأسبوعية
                        </h3>
                        <span style="font-size:0.65rem; color:#a0a094;">آخر 7 أيام</span>
                    </div>
                    <div class="analytics-chart__body">
                        <div class="chart-bars">
                            <div class="chart-bar" style="height: 40px; background: #9E2A2B;">
                                <span class="chart-bar__tooltip">$120</span>
                            </div>
                            <div class="chart-bar" style="height: 65px; background: #9E2A2B;">
                                <span class="chart-bar__tooltip">$195</span>
                            </div>
                            <div class="chart-bar" style="height: 85px; background: #D4AF37;">
                                <span class="chart-bar__tooltip">$255</span>
                            </div>
                            <div class="chart-bar" style="height: 55px; background: #9E2A2B;">
                                <span class="chart-bar__tooltip">$165</span>
                            </div>
                            <div class="chart-bar" style="height: 95px; background: #D4AF37;">
                                <span class="chart-bar__tooltip">$285</span>
                            </div>
                            <div class="chart-bar" style="height: 70px; background: #9E2A2B;">
                                <span class="chart-bar__tooltip">$210</span>
                            </div>
                            <div class="chart-bar" style="height: 110px; background: #54623A;">
                                <span class="chart-bar__tooltip">$330</span>
                            </div>
                        </div>
                        <div class="chart-labels">
                            <span>أحد</span>
                            <span>إثنين</span>
                            <span>ثلاثاء</span>
                            <span>أربعاء</span>
                            <span>خميس</span>
                            <span>جمعة</span>
                            <span>سبت</span>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Orders by Status -->
                <div class="analytics-chart">
                    <div class="analytics-chart__header">
                        <h3>
                            <span class="material-symbols-outlined">pie_chart</span>
                            الطلبات حسب الحالة
                        </h3>
                    </div>
                    <div class="analytics-chart__body">
                        <div style="display: flex; flex-direction: column; gap: 12px; padding: 4px 0;">
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size:0.75rem; margin-bottom:2px;">
                                    <span style="font-weight:600; color:#1c1c16;">قيد المعالجة</span>
                                    <span style="font-weight:700; color:#FF8C00;">3</span>
                                </div>
                                <div style="width:100%; height:6px; background:#f0efea; border-radius:9999px; overflow:hidden;">
                                    <div style="width:37.5%; height:100%; background:#FF8C00; border-radius:9999px;"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size:0.75rem; margin-bottom:2px;">
                                    <span style="font-weight:600; color:#1c1c16;">تم الشحن</span>
                                    <span style="font-weight:700; color:#4285f4;">3</span>
                                </div>
                                <div style="width:100%; height:6px; background:#f0efea; border-radius:9999px; overflow:hidden;">
                                    <div style="width:37.5%; height:100%; background:#4285f4; border-radius:9999px;"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size:0.75rem; margin-bottom:2px;">
                                    <span style="font-weight:600; color:#1c1c16;">تم التسليم</span>
                                    <span style="font-weight:700; color:#54623A;">2</span>
                                </div>
                                <div style="width:100%; height:6px; background:#f0efea; border-radius:9999px; overflow:hidden;">
                                    <div style="width:25%; height:100%; background:#54623A; border-radius:9999px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== Top Products ===== -->
            <div class="top-products">
                <div class="top-products__header">
                    <h3>
                        <span class="material-symbols-outlined">star</span>
                        أفضل المنتجات مبيعاً
                    </h3>
                    <a href="{{ route('artisan.products') }}">
                        عرض الكل
                        <span class="material-symbols-outlined">arrow_left_alt</span>
                    </a>
                </div>
                <div class="top-products__body">
                    @forelse($topProducts ?? [] as $index => $product)
                    <div class="top-product-item">
                        <span class="top-product-item__rank {{ $index === 0 ? 'top-product-item__rank--1' : ($index === 1 ? 'top-product-item__rank--2' : ($index === 2 ? 'top-product-item__rank--3' : '')) }}">
                            #{{ $index + 1 }}
                        </span>
                        <div class="top-product-item__image">
                            @php
                                $imagePath = 'assets/img/products/product1-1.jpg';
                                if ($product->images && is_array($product->images) && count($product->images) > 0) {
                                    $imagePath = 'storage/' . $product->images[0];
                                }
                            @endphp
                            <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" />
                        </div>
                        <div class="top-product-item__info">
                            <h4>{{ $product->name }}</h4>
                            <span class="category">{{ $product->category->name ?? 'غير مصنف' }}</span>
                        </div>
                        <span class="top-product-item__sales">{{ $product->sales_count ?? 0 }} مباع</span>
                        <span class="top-product-item__revenue">${{ number_format(($product->price ?? 0) * ($product->sales_count ?? 0), 0) }}</span>
                    </div>
                    @empty
                    <div class="empty-message">
                        لا توجد منتجات مبيعة بعد
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- ===== Recent Activity ===== -->
            <div class="analytics-activity">
                <div class="analytics-activity__header">
                    <h3>
                        <span class="material-symbols-outlined">notifications_active</span>
                        آخر النشاطات
                    </h3>
                </div>
                <div class="analytics-activity__body">
                    <div class="activity-item">
                        <div class="activity-item__icon">
                            <span class="material-symbols-outlined">shopping_bag</span>
                        </div>
                        <div class="activity-item__content">
                            <div class="text">طلب جديد بقيمة <strong>$45.00</strong></div>
                            <div class="time">منذ 15 دقيقة</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-item__icon" style="background: rgba(84,98,58,0.06); color:#54623A;">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <div class="activity-item__content">
                            <div class="text">تم تسليم طلب <strong>#ORD-003</strong></div>
                            <div class="time">منذ 45 دقيقة</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-item__icon" style="background: rgba(212,175,55,0.06); color:#D4AF37;">
                            <span class="material-symbols-outlined">star</span>
                        </div>
                        <div class="activity-item__content">
                            <div class="text">تقييم جديد 5 نجوم على منتج</div>
                            <div class="time">منذ ساعتين</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-item__icon" style="background: rgba(66,133,244,0.06); color:#4285f4;">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                        <div class="activity-item__content">
                            <div class="text">تم تعديل منتج - تحديث السعر إلى <strong>$65.00</strong></div>
                            <div class="time">منذ 3 ساعات</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__grid">
                <div class="footer__brand">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Handora Logo" class="footer__logo" />
                    <p class="footer__tagline">منصة الحرف اليدوية الأرقى، تجمع الأصالة بالتصميم المعاصر.</p>
                    <div class="footer__social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer__links">
                    <h4 class="footer__links-title">روابط سريعة</h4>
                    <ul>
                        <li><a href="#">عن هاندورا</a></li>
                        <li><a href="#">بوابة الحرفيين</a></li>
                        <li><a href="#">سياسة الخصوصية</a></li>
                        <li><a href="#">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="footer__links">
                    <h4 class="footer__links-title">التصنيفات</h4>
                    <ul>
                        <li><a href="#">تطريز</a></li>
                        <li><a href="#">خزف</a></li>
                        <li><a href="#">مجوهرات</a></li>
                        <li><a href="#">أعمال خشبية</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <p>© {{ date('Y') }} Handora. Handmade with Heritage.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>