<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>طلباتي - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .customer-orders-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; }
        .orders-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .orders-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .orders-breadcrumb a:hover { text-decoration: underline; }
        .orders-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .orders-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .orders-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .orders-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .orders-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .orders-stats { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .orders-stats__item { background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); padding: 10px 20px; border-radius: 12px; border: 1px solid rgba(200,199,184,0.12); box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 10px; }
        .orders-stats__item .number { font-size: 1.3rem; font-weight: 800; color: #9E2A2B; }
        .orders-stats__item .label { font-size: 0.8rem; color: #77786b; }
        .orders-list { position: relative; z-index: 1; padding: 0 20px; }
        .order-card { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); padding: 20px 24px; margin-bottom: 16px; transition: all 0.3s ease; }
        .order-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.06); }
        .order-card__header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; padding-bottom: 12px; border-bottom: 1px solid rgba(200,199,184,0.08); }
        .order-card__id { font-size: 0.85rem; font-weight: 700; color: #6F1D1B; }
        .order-card__id .material-symbols-outlined { font-size: 18px; color: #9E2A2B; vertical-align: middle; }
        .order-card__date { font-size: 0.8rem; color: #77786b; }
        .order-card__status { font-size: 0.65rem; font-weight: 700; padding: 4px 14px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; }
        .order-card__status--pending { background: rgba(255,165,0,0.12); color: #FF8C00; }
        .order-card__status--shipped { background: rgba(66,133,244,0.12); color: #4285f4; }
        .order-card__status--delivered { background: rgba(84,98,58,0.12); color: #54623A; }
        .order-card__status--cancelled { background: rgba(220,53,69,0.12); color: #dc3545; }
        .order-card__body { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; padding-top: 12px; }
        .order-card__products { display: flex; flex-direction: column; gap: 4px; }
        .order-card__product-item { font-size: 0.85rem; color: #1c1c16; }
        .order-card__product-item .qty { color: #77786b; font-size: 0.75rem; }
        .order-card__total { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; }
        .order-card__actions { display: flex; gap: 8px; }
        .order-card__actions .btn { display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 10px; font-weight: 700; font-size: 0.75rem; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; background: transparent; border: 1px solid rgba(200,199,184,0.2); color: #77786b; }
        .order-card__actions .btn:hover { background: rgba(159,42,43,0.06); border-color: #9E2A2B; color: #9E2A2B; }
        .order-card__actions .btn .material-symbols-outlined { font-size: 18px; }
        .empty-state { text-align: center; padding: 60px 20px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); }
        .empty-state .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-state h2 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-state p { color: #77786b; margin-bottom: 16px; }
        .empty-state .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; background: #9E2A2B; color: #fff; }
        .empty-state .btn:hover { background: #7A1F20; transform: translateY(-2px); }
        @media (max-width: 768px) {
            .customer-orders-page { margin-top: 16px; padding: 12px 0 24px; }
            .orders-header { padding: 0 16px; flex-direction: column; align-items: stretch; }
            .orders-header__title p { margin-right: 0; }
            .orders-stats { padding: 0 16px; justify-content: center; }
            .orders-stats__item { padding: 8px 14px; }
            .orders-list { padding: 0 16px; }
            .order-card { padding: 16px 18px; }
            .order-card__header { flex-direction: column; align-items: flex-start; }
            .order-card__body { flex-direction: column; align-items: flex-start; }
            .order-card__actions { width: 100%; }
            .order-card__actions .btn { flex: 1; justify-content: center; }
            .orders-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .order-card { padding: 14px 16px; }
            .orders-stats { flex-direction: column; align-items: stretch; }
            .orders-stats__item { justify-content: center; }
            .orders-header__title h1 { font-size: 1.4rem; }
            .order-card__total { font-size: 1rem; }
            .order-card__product-item { font-size: 0.8rem; }
            .orders-breadcrumb { padding: 0 12px; }
            .orders-header { padding: 0 12px; }
            .orders-stats { padding: 0 12px; }
            .orders-list { padding: 0 12px; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="container navbar__inner">
            <a href="{{ route('customer.home') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Handora Logo" />
                <span class="logo__brand">Handora</span>
            </a>
            <nav class="nav-desktop">
                <a href="{{ route('customer.home') }}" class="nav-desktop__link">الرئيسية</a>
                <a href="{{ route('customer.shop') }}" class="nav-desktop__link">المتجر</a>
                <a href="{{ route('customer.orders') }}" class="nav-desktop__link active">طلباتي</a>
                <a href="{{ route('customer.profile') }}" class="nav-desktop__link">ملفي</a>
            </nav>
            <div class="nav-actions">
                <div class="nav-actions__buttons">
                    <a href="{{ route('customer.cart') }}" class="nav-icon-btn" aria-label="السلة">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span class="nav-badge">{{ $cartCount ?? 0 }}</span>
                    </a>
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

    <!-- ===== CUSTOMER ORDERS PAGE ===== -->
    <main class="customer-orders-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="orders-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">طلباتي</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="orders-header">
                <div class="orders-header__title">
                    <h1>
                        <span class="material-symbols-outlined">receipt_long</span>
                        طلباتي
                    </h1>
                    <p>تابع جميع طلباتك السابقة والحالية</p>
                </div>
            </div>

            @if($orders->isEmpty())
                <!-- ===== Empty State ===== -->
                <div class="empty-state">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h2>لا توجد طلبات</h2>
                    <p>لم تقم بأي طلب حتى الآن</p>
                    <a href="{{ route('customer.shop') }}" class="btn">
                        <span class="material-symbols-outlined">storefront</span>
                        تسوق الآن
                    </a>
                </div>
            @else
                <!-- ===== Stats ===== -->
                <div class="orders-stats">
                    <div class="orders-stats__item">
                        <span class="number">{{ $totalOrders }}</span>
                        <span class="label">إجمالي الطلبات</span>
                    </div>
                    <div class="orders-stats__item">
                        <span class="number">{{ $pendingCount }}</span>
                        <span class="label">قيد المعالجة</span>
                    </div>
                    <div class="orders-stats__item">
                        <span class="number">{{ $shippedCount }}</span>
                        <span class="label">تم الشحن</span>
                    </div>
                    <div class="orders-stats__item">
                        <span class="number">{{ $deliveredCount }}</span>
                        <span class="label">تم التسليم</span>
                    </div>
                </div>

                <!-- ===== Orders List ===== -->
                <div class="orders-list">
                    @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-card__header">
                            <div>
                                <span class="order-card__id">
                                    <span class="material-symbols-outlined">receipt</span>
                                    {{ $order->order_number }}
                                </span>
                                <span class="order-card__date"> | {{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <span class="order-card__status order-card__status--{{ $order->status }}">
                                @if($order->status === 'pending') قيد المعالجة
                                @elseif($order->status === 'shipped') تم الشحن
                                @elseif($order->status === 'delivered') تم التسليم
                                @elseif($order->status === 'cancelled') ملغي
                                @endif
                            </span>
                        </div>
                        <div class="order-card__body">
                            <div class="order-card__products">
                                @foreach($order->items as $item)
                                    <span class="order-card__product-item">
                                        {{ $item->product->name ?? 'منتج' }} <span class="qty">×{{ $item->quantity }}</span>
                                    </span>
                                @endforeach
                            </div>
                            <div class="order-card__total">${{ number_format($order->total, 2) }}</div>
                            <div class="order-card__actions">
                                <a href="{{ route('customer.order.details', $order->id) }}" class="btn">
                                    <span class="material-symbols-outlined">visibility</span>
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

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
                        <li><a href="{{ route('customer.shop') }}">المتجر</a></li>
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