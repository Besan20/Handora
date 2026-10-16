<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>الطلبات - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        /* ===== نفس الـ Styles من الكود الأصلي ===== */
        .orders-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .orders-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .orders-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .orders-breadcrumb a:hover { text-decoration: underline; }
        .orders-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .orders-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .orders-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .orders-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .orders-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .orders-header__stats { display: flex; gap: 10px; flex-wrap: wrap; }
        .orders-header__stats .stat-box { background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(200,199,184,0.12); text-align: center; min-width: 60px; }
        .orders-header__stats .stat-box .number { font-size: 1.2rem; font-weight: 800; color: #9E2A2B; }
        .orders-header__stats .stat-box .label { font-size: 0.6rem; color: #77786b; text-transform: uppercase; letter-spacing: 0.04em; }
        .orders-controls { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; padding: 12px 18px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 14px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); position: relative; z-index: 1; margin-left: 20px; margin-right: 20px; }
        .orders-tabs { display: flex; gap: 4px; flex-wrap: wrap; }
        .orders-tabs .tab-btn { padding: 4px 14px; border-radius: 9999px; border: none; background: transparent; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; color: #77786b; }
        .orders-tabs .tab-btn:hover { background: rgba(159,42,43,0.06); color: #9E2A2B; }
        .orders-tabs .tab-btn.active { background: #9E2A2B; color: #ffffff; }
        .orders-tabs .tab-btn .badge { display: inline-block; background: rgba(255,255,255,0.2); padding: 0 6px; border-radius: 9999px; font-size: 0.6rem; margin-right: 4px; }
        .orders-tabs .tab-btn.active .badge { background: rgba(255,255,255,0.2); }
        .orders-controls__search { display: flex; align-items: center; gap: 8px; background: rgba(247,243,233,0.5); border-radius: 9999px; padding: 4px 14px; border: 1px solid rgba(200,199,184,0.15); }
        .orders-controls__search .material-symbols-outlined { color: #77786b; font-size: 1.1rem; }
        .orders-controls__search input { border: none; background: transparent; padding: 6px 0; font-size: 0.85rem; outline: none; color: #1c1c16; width: 140px; }
        .orders-controls__search input::placeholder { color: #a0a094; }
        .orders-table { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.04); position: relative; z-index: 1; margin: 0 20px; }
        .orders-table__header { display: grid; grid-template-columns: 70px 0.9fr 1.1fr 60px 80px 110px 180px; gap: 8px; padding: 12px 16px; background: rgba(0,0,0,0.02); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #77786b; border-bottom: 1px solid rgba(200,199,184,0.08); }
        .orders-table__row { display: grid; grid-template-columns: 70px 0.9fr 1.1fr 60px 80px 110px 180px; gap: 8px; padding: 10px 16px; align-items: center; border-bottom: 1px solid rgba(200,199,184,0.04); transition: all 0.2s ease; }
        .orders-table__row:last-child { border-bottom: none; }
        .orders-table__row:hover { background: rgba(159,42,43,0.02); }
        .orders-table__order-id { font-size: 0.75rem; font-weight: 700; color: #6F1D1B; }
        .orders-table__customer { display: flex; align-items: center; gap: 8px; }
        .orders-table__customer .avatar { width: 28px; height: 28px; border-radius: 50%; background: #9E2A2B; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; flex-shrink: 0; }
        .orders-table__customer .name { font-weight: 600; font-size: 0.85rem; color: #1c1c16; }
        .orders-table__customer .name small { font-weight: 400; color: #77786b; font-size: 0.65rem; display: block; }
        .orders-table__product { font-size: 0.85rem; color: #1c1c16; }
        .orders-table__product small { display: block; font-size: 0.6rem; color: #77786b; }
        .orders-table__qty { font-size: 0.85rem; font-weight: 600; color: #1c1c16; text-align: center; }
        .orders-table__price { font-size: 0.9rem; font-weight: 700; color: #6F1D1B; }
        .orders-table__status { font-size: 0.6rem; font-weight: 700; padding: 4px 12px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; display: inline-block; text-align: center; border: none; cursor: default; white-space: nowrap; }
        .orders-table__status--pending { background: rgba(255,165,0,0.12); color: #FF8C00; }
        .orders-table__status--approved { background: rgba(84,98,58,0.12); color: #54623A; }
        .orders-table__status--rejected { background: rgba(220,53,69,0.12); color: #dc3545; }
        .orders-table__status--shipped { background: rgba(66,133,244,0.12); color: #4285f4; }
        .orders-table__status--delivered { background: rgba(84,98,58,0.12); color: #54623A; }
        .orders-table__actions { display: flex; gap: 4px; align-items: center; flex-wrap: nowrap; justify-content: flex-start; }
        .orders-table__actions button, .orders-table__actions form button { background: none; border: none; padding: 4px 10px; border-radius: 6px; cursor: pointer; transition: all 0.3s ease; color: #77786b; display: inline-flex; align-items: center; justify-content: center; gap: 4px; font-family: 'Tajawal', sans-serif; font-size: 0.65rem; font-weight: 700; white-space: nowrap; }
        .orders-table__actions button .material-symbols-outlined { font-size: 16px; }
        .orders-table__actions button.view:hover { background: rgba(66,133,244,0.08); color: #4285f4; }
        .orders-table__actions .btn-approve { background: rgba(84,98,58,0.10); color: #54623A; padding: 4px 12px; border-radius: 9999px; font-size: 0.6rem; font-weight: 700; }
        .orders-table__actions .btn-approve:hover { background: #54623A; color: #ffffff; transform: translateY(-1px); }
        .orders-table__actions .btn-reject { background: rgba(220,53,69,0.10); color: #dc3545; padding: 4px 12px; border-radius: 9999px; font-size: 0.6rem; font-weight: 700; }
        .orders-table__actions .btn-reject:hover { background: #dc3545; color: #ffffff; transform: translateY(-1px); }
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-state h3 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-state p { color: #77786b; }
        .order-modal { display: none; position: fixed; inset: 0; z-index: 1000; background: rgba(0,0,0,0.4); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 20px; }
        .order-modal.active { display: flex; }
        .order-modal__content { background: rgba(255,255,255,0.92); backdrop-filter: blur(16px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 30px 80px rgba(0,0,0,0.2); padding: 32px; max-width: 560px; width: 100%; max-height: 90vh; overflow-y: auto; }
        .order-modal__header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .order-modal__header h2 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 8px; }
        .order-modal__header h2 .material-symbols-outlined { color: #9E2A2B; }
        .order-modal__close { background: none; border: none; color: #77786b; cursor: pointer; padding: 4px; transition: all 0.3s ease; }
        .order-modal__close:hover { color: #dc3545; transform: rotate(90deg); }
        .order-modal__close .material-symbols-outlined { font-size: 28px; }
        .order-modal__body { display: flex; flex-direction: column; gap: 14px; }
        .order-modal__field { display: flex; flex-direction: column; gap: 4px; }
        .order-modal__field .label { font-size: 0.7rem; font-weight: 600; color: #77786b; text-transform: uppercase; letter-spacing: 0.04em; }
        .order-modal__field .value { font-size: 0.95rem; font-weight: 600; color: #1c1c16; padding: 8px 12px; background: rgba(247,243,233,0.4); border-radius: 8px; }
        .order-modal__field .value.notes { min-height: 60px; white-space: pre-wrap; }
        .order-modal__divider { height: 1px; background: rgba(200,199,184,0.15); margin: 4px 0; }
        .order-modal__actions { display: flex; gap: 10px; margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(200,199,184,0.1); }
        .order-modal__actions .btn { padding: 10px 20px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; flex: 1; text-align: center; display: flex; align-items: center; justify-content: center; gap: 6px; font-family: 'Tajawal', sans-serif; text-decoration: none; }
        .order-modal__actions .btn .material-symbols-outlined { font-size: 20px; }
        .btn--approve { background: #54623A; color: #ffffff; }
        .btn--approve:hover { background: #3E4A2B; transform: translateY(-2px); }
        .btn--reject { background: #dc3545; color: #ffffff; }
        .btn--reject:hover { background: #b02a37; transform: translateY(-2px); }
        .btn--close-modal { background: transparent; color: #77786b; border: 1px solid rgba(200,199,184,0.3); }
        .btn--close-modal:hover { background: #f7f3e9; }
        @media (max-width: 1024px) {
            .orders-table__header, .orders-table__row { grid-template-columns: 60px 0.9fr 1fr 50px 70px 100px 160px; gap: 6px; padding: 8px 12px; font-size: 0.75rem; }
        }
        @media (max-width: 768px) {
            .orders-page { margin-top: 16px; padding: 12px 0 24px; }
            .orders-header { flex-direction: column; align-items: stretch; padding: 0 16px; }
            .orders-header__title p { margin-right: 0; }
            .orders-header__stats { justify-content: center; }
            .orders-controls { flex-direction: column; align-items: stretch; margin-left: 16px; margin-right: 16px; padding: 10px 14px; }
            .orders-controls__search input { width: 100%; }
            .orders-controls__search { width: 100%; }
            .orders-table { margin: 0 16px; }
            .orders-table__header { display: none; }
            .orders-table__row { grid-template-columns: 1fr; gap: 6px; padding: 14px 16px; }
            .orders-table__qty { text-align: left; }
            .orders-table__status { width: fit-content; }
            .orders-breadcrumb { padding: 0 16px; }
            .order-modal__content { padding: 20px; margin: 10px; }
            .order-modal__actions { flex-direction: column; }
        }
        @media (max-width: 480px) {
            .orders-header__stats { flex-direction: column; align-items: stretch; }
            .orders-header__stats .stat-box { padding: 6px 12px; }
            .orders-tabs { gap: 2px; }
            .orders-tabs .tab-btn { font-size: 0.65rem; padding: 3px 10px; }
            .orders-table__row { padding: 12px 14px; }
            .orders-controls { margin-left: 12px; margin-right: 12px; }
            .orders-table { margin: 0 12px; }
            .orders-breadcrumb { padding: 0 12px; }
            .orders-header { padding: 0 12px; }
            .order-modal__content { padding: 16px; }
            .order-modal__header h2 { font-size: 1.2rem; }
            .order-modal__field .value { font-size: 0.85rem; }
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
                <a href="{{ route('artisan.orders') }}" class="nav-desktop__link active">الطلبات</a>
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

    <!-- ===== ORDERS PAGE ===== -->
    <main class="orders-page">
        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="orders-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">الطلبات</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="orders-header">
                <div class="orders-header__title">
                    <h1>
                        <span class="material-symbols-outlined">receipt_long</span>
                        الطلبات
                    </h1>
                    <p>إدارة ومتابعة جميع طلباتك الواردة</p>
                </div>
                <div class="orders-header__stats">
                    <div class="stat-box">
                        <div class="number">{{ $orders->count() ?? 0 }}</div>
                        <div class="label">إجمالي</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">{{ $orders->where('status', 'pending')->count() ?? 0 }}</div>
                        <div class="label">قيد المراجعة</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">{{ $orders->where('status', 'shipped')->count() ?? 0 }}</div>
                        <div class="label">تم الشحن</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">{{ $orders->where('status', 'delivered')->count() ?? 0 }}</div>
                        <div class="label">تم التسليم</div>
                    </div>
                </div>
            </div>

            <!-- ===== Controls ===== -->
            <div class="orders-controls">
                <div class="orders-tabs">
                    <button class="tab-btn active" data-filter="all">الكل <span class="badge">{{ $orders->count() ?? 0 }}</span></button>
                    <button class="tab-btn" data-filter="pending">قيد المراجعة <span class="badge">{{ $orders->where('status', 'pending')->count() ?? 0 }}</span></button>
                    <button class="tab-btn" data-filter="shipped">تم الشحن <span class="badge">{{ $orders->where('status', 'shipped')->count() ?? 0 }}</span></button>
                    <button class="tab-btn" data-filter="delivered">تم التسليم <span class="badge">{{ $orders->where('status', 'delivered')->count() ?? 0 }}</span></button>
                </div>
                <div class="orders-controls__search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" id="searchInput" placeholder="بحث عن طلب..." />
                </div>
            </div>

            <!-- ===== Orders Table ===== -->
            <div class="orders-table">

                <!-- Table Header -->
                <div class="orders-table__header">
                    <span>#</span>
                    <span>العميل</span>
                    <span>المنتج</span>
                    <span>الكمية</span>
                    <span>السعر</span>
                    <span>الحالة</span>
                    <span>إجراءات</span>
                </div>

                @forelse($orders ?? [] as $order)
                @php
                    $firstItem = $order->items->first();
                    $productName = $firstItem && $firstItem->product ? $firstItem->product->name : 'منتج';
                    $productCategory = $firstItem && $firstItem->product && $firstItem->product->category ? $firstItem->product->category->name : 'غير مصنف';
                    $statusClass = $order->status === 'pending' ? 'pending' : ($order->status === 'shipped' ? 'shipped' : ($order->status === 'delivered' ? 'delivered' : 'rejected'));
                    $statusText = $order->status === 'pending' ? 'قيد المراجعة' : ($order->status === 'shipped' ? 'تم الشحن' : ($order->status === 'delivered' ? 'تم التسليم' : 'ملغي'));
                @endphp
                <div class="orders-table__row" data-order-id="{{ $order->id }}" data-status="{{ $order->status }}" data-search="{{ $order->order_number }} {{ $order->user->name ?? '' }}">
                    <span class="orders-table__order-id">{{ $order->order_number }}</span>
                    <div class="orders-table__customer">
                        <div class="avatar" style="background: #9E2A2B;">{{ substr($order->user->name ?? 'ع', 0, 1) }}</div>
                        <span class="name">{{ $order->user->name ?? 'عميل' }} <small>{{ $order->phone ?? '' }}</small></span>
                    </div>
                    <div class="orders-table__product">
                        {{ $productName }}
                        <small>{{ $productCategory }}</small>
                    </div>
                    <div class="orders-table__qty">{{ $firstItem->quantity ?? 1 }}</div>
                    <div class="orders-table__price">${{ number_format($order->total ?? 0, 2) }}</div>
                    <div>
                        <span class="orders-table__status orders-table__status--{{ $statusClass }}">{{ $statusText }}</span>
                    </div>
                    <div class="orders-table__actions">
                        <button class="view" title="عرض التفاصيل" onclick="openOrderModal({{ $order->id }})">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                        @if($order->status === 'pending')
                            <form action="{{ route('artisan.update-order', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="shipped">
                                <button type="submit" class="btn-approve">
                                    <span class="material-symbols-outlined">check_circle</span>
                                    موافقة
                                </button>
                            </form>
                            <form action="{{ route('artisan.update-order', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn-reject">
                                    <span class="material-symbols-outlined">cancel</span>
                                    رفض
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>لا توجد طلبات</h3>
                    <p>لم تصل أي طلبات بعد</p>
                </div>
                @endforelse

            </div>

        </div>
    </main>

    <!-- ===== ORDER DETAIL MODAL ===== -->
    <div class="order-modal" id="orderModal">
        <div class="order-modal__content">
            <div class="order-modal__header">
                <h2>
                    <span class="material-symbols-outlined">receipt_long</span>
                    تفاصيل الطلب
                </h2>
                <button class="order-modal__close" onclick="closeOrderModal()">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="order-modal__body">
                <div class="order-modal__field">
                    <span class="label">رقم الطلب</span>
                    <span class="value" id="modalOrderId">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">العميل</span>
                    <span class="value" id="modalCustomer">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">رقم الهاتف</span>
                    <span class="value" id="modalPhone">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">المنتج</span>
                    <span class="value" id="modalProduct">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">الكمية</span>
                    <span class="value" id="modalQty">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">السعر الإجمالي</span>
                    <span class="value" id="modalPrice">-</span>
                </div>
                <div class="order-modal__divider"></div>
                <div class="order-modal__field">
                    <span class="label">عنوان التوصيل</span>
                    <span class="value" id="modalAddress">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">ملاحظات العميل</span>
                    <span class="value notes" id="modalNotes">-</span>
                </div>
                <div class="order-modal__field">
                    <span class="label">حالة الطلب</span>
                    <span class="value" id="modalStatus">-</span>
                </div>
                <div class="order-modal__actions">
                    <button class="btn btn--close-modal" onclick="closeOrderModal()">
                        <span class="material-symbols-outlined">close</span>
                        إغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        // ===== Open Order Modal =====
        function openOrderModal(orderId) {
            const row = document.querySelector(`.orders-table__row[data-order-id="${orderId}"]`);
            if (!row) return;

            const orderIdText = row.querySelector('.orders-table__order-id').textContent;
            const customerName = row.querySelector('.orders-table__customer .name').childNodes[0].textContent.trim();
            const customerPhone = row.querySelector('.orders-table__customer .name small')?.textContent || '-';
            const productName = row.querySelector('.orders-table__product').childNodes[0].textContent.trim();
            const qty = row.querySelector('.orders-table__qty').textContent;
            const price = row.querySelector('.orders-table__price').textContent;
            const status = row.querySelector('.orders-table__status').textContent;

            document.getElementById('modalOrderId').textContent = orderIdText;
            document.getElementById('modalCustomer').textContent = customerName;
            document.getElementById('modalPhone').textContent = customerPhone;
            document.getElementById('modalProduct').textContent = productName;
            document.getElementById('modalQty').textContent = qty;
            document.getElementById('modalPrice').textContent = price;
            document.getElementById('modalStatus').textContent = status;

            document.getElementById('orderModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // ===== Close Order Modal =====
        function closeOrderModal() {
            document.getElementById('orderModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== Close modal on outside click =====
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        // ===== Close modal on ESC =====
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeOrderModal();
            }
        });

        // ===== Tabs Filter =====
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                document.querySelectorAll('.orders-table__row').forEach(row => {
                    if (filter === 'all') {
                        row.style.display = 'grid';
                    } else {
                        row.style.display = row.dataset.status === filter ? 'grid' : 'none';
                    }
                });
            });
        });

        // ===== Search =====
        document.getElementById('searchInput')?.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            document.querySelectorAll('.orders-table__row').forEach(row => {
                const searchText = (row.dataset.search || '').toLowerCase();
                row.style.display = searchText.includes(query) ? 'grid' : 'none';
            });
        });
    </script>

</body>
</html>