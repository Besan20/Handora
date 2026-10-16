<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة تحكم الحرفي - Handora</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,700&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        /* ===== Styles من الكود الأصلي ===== */
        .artisan-dashboard {
            margin-top: 24px;
            padding: 16px 0 32px;
            min-height: calc(100vh - 80px);
            background: #fdf9ef;
            position: relative;
            overflow: hidden;
        }
        .dashboard-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #77786b;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }
        .dashboard-breadcrumb a {
            color: #9E2A2B;
            text-decoration: none;
            font-weight: 500;
        }
        .dashboard-breadcrumb a:hover {
            text-decoration: underline;
        }
        .dashboard-breadcrumb .material-symbols-outlined {
            font-size: 1rem;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }
        .dashboard-header__title h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #6F1D1B;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .dashboard-header__title h1 .material-symbols-outlined {
            color: #D4AF37;
        }
        .dashboard-header__title p {
            color: #47483c;
            margin: 0;
            font-size: 0.95rem;
            margin-right: 40px;
            margin-top: 4px;
        }
        .dashboard-header__stats {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }
        .dashboard-header__stat {
            text-align: center;
            background: #ffffff;
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(200, 199, 184, 0.15);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            min-width: 70px;
        }
        .dashboard-header__stat .number {
            font-size: 1.4rem;
            font-weight: 800;
            color: #9E2A2B;
        }
        .dashboard-header__stat .label {
            font-size: 0.65rem;
            color: #77786b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .quick-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }
        .quick-actions .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .quick-actions .btn--primary {
            background: #9E2A2B;
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(159, 42, 43, 0.2);
        }
        .quick-actions .btn--primary:hover {
            background: #7A1F20;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(159, 42, 43, 0.25);
        }
        .quick-actions .btn--outline {
            background: transparent;
            color: #54623A;
            border: 2px solid #54623A;
        }
        .quick-actions .btn--outline:hover {
            background: rgba(84, 98, 58, 0.06);
            transform: translateY(-2px);
        }
        .quick-actions .btn .material-symbols-outlined {
            font-size: 20px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }
        .dashboard-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.08);
        }
        .dashboard-card__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid rgba(200, 199, 184, 0.08);
        }
        .dashboard-card__header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #6F1D1B;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dashboard-card__header h3 .material-symbols-outlined {
            color: #9E2A2B;
        }
        .dashboard-card__header a {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9E2A2B;
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .dashboard-card__header a:hover {
            color: #6F1D1B;
        }
        .dashboard-card__body {
            padding: 14px 20px;
        }
        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: rgba(247, 243, 233, 0.5);
            border-radius: 10px;
            transition: all 0.3s ease;
            flex-wrap: wrap;
            gap: 6px;
        }
        .order-item:hover {
            background: rgba(247, 243, 233, 0.8);
        }
        .order-item__info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .order-item__id {
            font-size: 0.7rem;
            font-weight: 700;
            color: #6F1D1B;
            background: rgba(159, 42, 43, 0.06);
            padding: 2px 10px;
            border-radius: 9999px;
        }
        .order-item__customer {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1c1c16;
        }
        .order-item__product {
            font-size: 0.75rem;
            color: #47483c;
        }
        .order-item__price {
            font-size: 0.85rem;
            font-weight: 700;
            color: #6F1D1B;
        }
        .order-item__status {
            font-size: 0.6rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .order-item__status--pending {
            background: rgba(255, 165, 0, 0.12);
            color: #FF8C00;
        }
        .order-item__status--shipped {
            background: rgba(66, 133, 244, 0.12);
            color: #4285f4;
        }
        .order-item__status--delivered {
            background: rgba(84, 98, 58, 0.12);
            color: #54623A;
        }
        .products-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .product-mini-card {
            background: rgba(247, 243, 233, 0.5);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(200, 199, 184, 0.06);
        }
        .product-mini-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }
        .product-mini-card img {
            width: 100%;
            height: 90px;
            object-fit: cover;
        }
        .product-mini-card__info {
            padding: 6px 10px;
            text-align: center;
        }
        .product-mini-card__info h4 {
            font-size: 0.75rem;
            font-weight: 600;
            color: #1c1c16;
            margin: 0 0 2px;
        }
        .product-mini-card__info span {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6F1D1B;
        }
        .view-store-container {
            margin-top: 20px;
            text-align: center;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }
        .view-store-container .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            border: 2px solid #9E2A2B;
            color: #9E2A2B;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .view-store-container .btn:hover {
            background: #9E2A2B;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(159, 42, 43, 0.15);
        }
        @media (max-width: 992px) {
            .dashboard-grid { grid-template-columns: 1fr; padding: 0 16px; }
            .dashboard-header { padding: 0 16px; }
            .quick-actions { padding: 0 16px; }
            .view-store-container { padding: 0 16px; }
            .dashboard-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 768px) {
            .artisan-dashboard { margin-top: 16px; padding: 12px 0 24px; }
            .dashboard-header { flex-direction: column; align-items: stretch; }
            .dashboard-header__title p { margin-right: 0; }
            .dashboard-header__stats { justify-content: space-around; }
            .dashboard-header__stat { padding: 8px 14px; min-width: 60px; }
            .dashboard-header__stat .number { font-size: 1.1rem; }
            .quick-actions { flex-direction: column; }
            .quick-actions .btn { justify-content: center; }
            .products-mini-grid { grid-template-columns: 1fr 1fr; }
            .order-item { flex-direction: column; align-items: flex-start; gap: 4px; }
            .order-item__info { flex-wrap: wrap; }
        }
        @media (max-width: 480px) {
            .dashboard-header__stats { flex-direction: column; align-items: stretch; }
            .products-mini-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .product-mini-card img { height: 70px; }
            .dashboard-card__body { padding: 10px 14px; }
            .dashboard-card__header { padding: 10px 14px; }
            .order-item { padding: 8px 10px; }
            .dashboard-grid { padding: 0 12px; }
            .dashboard-header { padding: 0 12px; }
            .quick-actions { padding: 0 12px; }
            .view-store-container { padding: 0 12px; }
            .dashboard-breadcrumb { padding: 0 12px; }
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
                <a href="{{ route('artisan.home') }}" class="nav-desktop__link active">الرئيسية</a>
                <a href="{{ route('artisan.products') }}" class="nav-desktop__link">منتجاتي</a>
                <a href="{{ route('artisan.orders') }}" class="nav-desktop__link">الطلبات</a>
                <a href="{{ route('artisan.analytics') }}" class="nav-desktop__link">التحليلات</a>
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

    <!-- ===== ARTISAN DASHBOARD ===== -->
    <main class="artisan-dashboard">
        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="dashboard-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">لوحة التحكم</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="dashboard-header">
                <div class="dashboard-header__title">
                    <h1>
                        <span class="material-symbols-outlined">dashboard</span>
                        مرحباً، {{ Auth::user()->name }} 👋
                    </h1>
                    <p>اهلاً بك، هنا تلتقي الحِرفة بمن يقدّرها</p>
                </div>
                <div class="dashboard-header__stats">
                    <div class="dashboard-header__stat">
                        <div class="number">{{ $productsCount ?? 0 }}</div>
                        <div class="label">منتجات</div>
                    </div>
                    <div class="dashboard-header__stat">
                        <div class="number">{{ $ordersCount ?? 0 }}</div>
                        <div class="label">طلبات</div>
                    </div>
                    <div class="dashboard-header__stat">
                        <div class="number">4.9</div>
                        <div class="label">تقييم</div>
                    </div>
                </div>
            </div>

            <!-- ===== Quick Actions ===== -->
            <div class="quick-actions">
                <a href="{{ route('artisan.add-product') }}" class="btn btn--primary">
                    <span class="material-symbols-outlined">add</span>
                    إضافة منتج جديد
                </a>
                <a href="{{ route('artisan.products') }}" class="btn btn--outline">
                    <span class="material-symbols-outlined">edit</span>
                    إدارة المنتجات
                </a>
                <a href="{{ route('artisan.orders') }}" class="btn btn--outline">
                    <span class="material-symbols-outlined">receipt_long</span>
                    عرض الطلبات
                </a>
            </div>

            <!-- ===== Dashboard Grid ===== -->
            <div class="dashboard-grid">

                <!-- ===== Recent Orders ===== -->
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <h3>
                            <span class="material-symbols-outlined">receipt_long</span>
                            أحدث الطلبات
                        </h3>
                        <a href="{{ route('artisan.orders') }}">
                            عرض الكل
                            <span class="material-symbols-outlined">arrow_left_alt</span>
                        </a>
                    </div>
                    <div class="dashboard-card__body">
                        <div class="orders-list">
                            @forelse($recentOrders ?? [] as $order)
                            <div class="order-item">
                                <div class="order-item__info">
                                    <span class="order-item__id">{{ $order->order_number ?? '#ORD-001' }}</span>
                                    <span class="order-item__customer">{{ $order->user->name ?? 'عميل' }}</span>
                                </div>
                                <div class="order-item__product">تطريز ملابس</div>
                                <div class="order-item__price">${{ number_format($order->total ?? 45, 2) }}</div>
                                <span class="order-item__status order-item__status--{{ $order->status ?? 'pending' }}">
                                    {{ $order->status ?? 'قيد المعالجة' }}
                                </span>
                            </div>
                            @empty
                            <div style="text-align:center; padding:20px; color:#77786b;">
                                لا توجد طلبات حالياً
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- ===== My Products ===== -->
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <h3>
                            <span class="material-symbols-outlined">inventory_2</span>
                            منتجاتي
                        </h3>
                        <a href="{{ route('artisan.products') }}">
                            عرض الكل
                            <span class="material-symbols-outlined">arrow_left_alt</span>
                        </a>
                    </div>
                    <div class="dashboard-card__body">
                        <div class="products-mini-grid">
                            @forelse($recentProducts as $product)
                                <div class="product-mini-card">
                                    <img src="{{ $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('assets/img/products/product1-1.jpg') }}" alt="{{ $product->name }}" />
                                    <div class="product-mini-card__info">
                                        <h4>{{ $product->name }}</h4>
                                        <span>${{ number_format($product->price, 2) }}</span>
                                    </div>
                                </div>
                            @empty
                                <div style="text-align:center; padding:20px; color:#77786b; grid-column: span 2;">
                                    لا توجد منتجات حالياً
                                    <br>
                                    <a href="{{ route('artisan.add-product') }}" style="color:#9E2A2B; font-weight:600; text-decoration:none; margin-top:10px; display:inline-block;">
                                        + إضافة منتج جديد
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== View Store ===== -->
            <div class="view-store-container">
                <a href="{{ route('artisan.shop-preview') }}" class="btn">
                    <span class="material-symbols-outlined">storefront</span>
                    استعراض متجري
                </a>
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