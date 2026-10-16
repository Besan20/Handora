<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>سلة المشتريات - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .cart-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; }
        .cart-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .cart-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .cart-breadcrumb a:hover { text-decoration: underline; }
        .cart-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .cart-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .cart-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .cart-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .cart-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .cart-main { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .cart-items { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); overflow: hidden; }
        .cart-items__header { display: grid; grid-template-columns: 3fr 1fr 1fr 1fr; gap: 12px; padding: 14px 20px; background: rgba(0,0,0,0.02); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #77786b; border-bottom: 1px solid rgba(200,199,184,0.08); }
        .cart-item { display: grid; grid-template-columns: 3fr 1fr 1fr 1fr; gap: 12px; padding: 14px 20px; align-items: center; border-bottom: 1px solid rgba(200,199,184,0.04); transition: all 0.2s ease; }
        .cart-item:last-child { border-bottom: none; }
        .cart-item:hover { background: rgba(159,42,43,0.02); }
        .cart-item__product { display: flex; align-items: center; gap: 12px; }
        .cart-item__image { width: 60px; height: 60px; border-radius: 10px; overflow: hidden; background: #f7f3e9; flex-shrink: 0; }
        .cart-item__image img { width: 100%; height: 100%; object-fit: cover; }
        .cart-item__info { display: flex; flex-direction: column; }
        .cart-item__name { font-size: 0.9rem; font-weight: 700; color: #1c1c16; }
        .cart-item__artisan { font-size: 0.7rem; color: #77786b; }
        .cart-item__remove { background: none; border: none; color: #a0a094; cursor: pointer; transition: all 0.3s ease; padding: 4px; border-radius: 6px; display: flex; align-items: center; gap: 4px; font-size: 0.7rem; font-weight: 600; }
        .cart-item__remove:hover { background: rgba(220,53,69,0.08); color: #dc3545; }
        .cart-item__remove .material-symbols-outlined { font-size: 18px; }
        .cart-item__price { font-size: 0.9rem; font-weight: 600; color: #6F1D1B; }
        .cart-item__qty { display: flex; align-items: center; border: 1px solid rgba(200,199,184,0.2); border-radius: 8px; overflow: hidden; background: rgba(255,255,255,0.5); width: fit-content; }
        .cart-item__qty button { background: none; border: none; padding: 4px 10px; cursor: pointer; font-size: 1rem; color: #1c1c16; transition: all 0.3s ease; }
        .cart-item__qty button:hover { background: rgba(159,42,43,0.06); }
        .cart-item__qty input { width: 36px; text-align: center; border: none; background: transparent; font-family: 'Tajawal', sans-serif; font-size: 0.85rem; font-weight: 600; color: #1c1c16; outline: none; padding: 4px 0; }
        .cart-item__qty input::-webkit-inner-spin-button { -webkit-appearance: none; }
        .cart-item__total { font-size: 0.95rem; font-weight: 700; color: #6F1D1B; }
        .cart-summary { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); padding: 24px; align-self: start; position: sticky; top: 100px; }
        .cart-summary__title { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid rgba(200,199,184,0.08); }
        .cart-summary__row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 0.9rem; color: #47483c; }
        .cart-summary__row--total { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; padding-top: 12px; margin-top: 8px; border-top: 2px solid #9E2A2B; }
        .cart-summary__row .label { font-weight: 600; }
        .cart-summary__row .value { font-weight: 700; }
        .cart-summary__coupon { display: flex; gap: 8px; margin: 12px 0 16px; }
        .cart-summary__coupon input { flex: 1; padding: 10px 14px; border: 1px solid rgba(200,199,184,0.2); border-radius: 10px; background: rgba(247,243,233,0.3); font-family: 'Tajawal', sans-serif; font-size: 0.85rem; color: #1c1c16; outline: none; transition: all 0.3s ease; }
        .cart-summary__coupon input:focus { border-color: #D4AF37; }
        .cart-summary__coupon button { background: #9E2A2B; color: #fff; border: none; border-radius: 10px; padding: 10px 18px; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 0.8rem; cursor: pointer; transition: all 0.3s ease; white-space: nowrap; }
        .cart-summary__coupon button:hover { background: #7A1F20; }
        .btn--checkout { width: 100%; padding: 14px; background: #9E2A2B; color: #fff; border: none; border-radius: 12px; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px; text-decoration: none; }
        .btn--checkout:hover { background: #7A1F20; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(159,42,43,0.2); }
        .btn--continue-shopping { display: inline-flex; align-items: center; gap: 8px; color: #9E2A2B; font-weight: 600; font-size: 0.85rem; text-decoration: none; margin-top: 12px; transition: color 0.3s; }
        .btn--continue-shopping:hover { color: #6F1D1B; }
        .empty-cart { text-align: center; padding: 60px 20px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); }
        .empty-cart .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-cart h2 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-cart p { color: #77786b; margin-bottom: 16px; }
        .empty-cart .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; background: #9E2A2B; color: #fff; }
        .empty-cart .btn:hover { background: #7A1F20; transform: translateY(-2px); }
        @media (max-width: 1024px) {
            .cart-main { grid-template-columns: 1fr; }
            .cart-summary { position: static; }
        }
        @media (max-width: 768px) {
            .cart-page { margin-top: 16px; padding: 12px 0 24px; }
            .cart-header { padding: 0 16px; flex-direction: column; align-items: stretch; }
            .cart-header__title p { margin-right: 0; }
            .cart-main { padding: 0 16px; }
            .cart-items__header { display: none; }
            .cart-item { grid-template-columns: 1fr; gap: 8px; padding: 14px 16px; }
            .cart-item__product { gap: 10px; }
            .cart-item__image { width: 50px; height: 50px; }
            .cart-item__price { font-size: 0.85rem; }
            .cart-item__total { font-size: 0.85rem; }
            .cart-item__qty { width: fit-content; }
            .cart-item__remove { justify-content: flex-start; }
            .cart-breadcrumb { padding: 0 16px; }
            .cart-summary { padding: 20px; }
        }
        @media (max-width: 480px) {
            .cart-item__image { width: 44px; height: 44px; }
            .cart-item__name { font-size: 0.8rem; }
            .cart-item__artisan { font-size: 0.6rem; }
            .cart-summary { padding: 16px; }
            .cart-summary__coupon { flex-direction: column; }
            .cart-header__title h1 { font-size: 1.4rem; }
            .cart-breadcrumb { padding: 0 12px; }
            .cart-header { padding: 0 12px; }
            .cart-main { padding: 0 12px; }
            .cart-item { padding: 12px 14px; }
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
                <a href="{{ route('customer.orders') }}" class="nav-desktop__link">طلباتي</a>
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

    <!-- ===== CART PAGE ===== -->
    <main class="cart-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="cart-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">سلة المشتريات</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="cart-header">
                <div class="cart-header__title">
                    <h1>
                        <span class="material-symbols-outlined">shopping_cart</span>
                        سلة المشتريات
                    </h1>
                    <p>مراجعة منتجاتك قبل إتمام الطلب</p>
                </div>
            </div>

            @if($cartItems->isEmpty())
                <!-- ===== Empty Cart ===== -->
                <div class="empty-cart">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <h2>سلة المشتريات فارغة</h2>
                    <p>ابدأ بإضافة منتجات إلى سلتك</p>
                    <a href="{{ route('customer.shop') }}" class="btn">
                        <span class="material-symbols-outlined">storefront</span>
                        تسوق الآن
                    </a>
                </div>
            @else
                <!-- ===== Cart Main ===== -->
                <div class="cart-main">

                    <!-- ===== Cart Items ===== -->
                    <div class="cart-items">
                        <div class="cart-items__header">
                            <span>المنتج</span>
                            <span>السعر</span>
                            <span>الكمية</span>
                            <span>الإجمالي</span>
                        </div>

                        @foreach($cartItems as $item)
                        <div class="cart-item" id="cart-item-{{ $item->id }}">
                            <div class="cart-item__product">
                                <div class="cart-item__image">
                                    @php
                                        $imagePath = 'assets/img/products/product1-1.jpg';
                                        if ($item->product->images && is_array($item->product->images) && count($item->product->images) > 0) {
                                            $imagePath = 'storage/' . $item->product->images[0];
                                        }
                                    @endphp
                                    <img src="{{ asset($imagePath) }}" alt="{{ $item->product->name }}" />
                                </div>
                                <div class="cart-item__info">
                                    <span class="cart-item__name">{{ $item->product->name }}</span>
                                    <span class="cart-item__artisan">{{ $item->product->artisan->name ?? 'حرفي' }}</span>
                                    <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart-item__remove">
                                            <span class="material-symbols-outlined">delete</span>
                                            إزالة
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="cart-item__price">${{ number_format($item->product->price, 2) }}</div>
                            <div class="cart-item__qty">
                                <button type="button" onclick="updateQty({{ $item->id }}, -1)">−</button>
                                <input type="number" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="10" readonly />
                                <button type="button" onclick="updateQty({{ $item->id }}, 1)">+</button>
                            </div>
                            <div class="cart-item__total" id="total-{{ $item->id }}">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ===== Cart Summary ===== -->
                    <div class="cart-summary">
                        <h3 class="cart-summary__title">ملخص الطلب</h3>

                        <div class="cart-summary__row">
                            <span class="label">إجمالي المنتجات</span>
                            <span class="value" id="subtotal">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="cart-summary__row">
                            <span class="label">الشحن</span>
                            <span class="value" id="shipping">${{ number_format($shipping, 2) }}</span>
                        </div>

                        <div class="cart-summary__row">
                            <span class="label">الضريبة (5%)</span>
                            <span class="value" id="tax">${{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="cart-summary__row cart-summary__row--total">
                            <span class="label">الإجمالي</span>
                            <span class="value" id="total">${{ number_format($total, 2) }}</span>
                        </div>

                        <div class="cart-summary__coupon">
                            <input type="text" placeholder="كود الخصم" />
                            <button type="button">تطبيق</button>
                        </div>

                        <a href="{{ route('customer.checkout') }}" class="btn--checkout">
                            <span class="material-symbols-outlined">done_all</span>
                            إتمام الطلب
                        </a>
                        <a href="{{ route('customer.shop') }}" class="btn--continue-shopping">
                            <span class="material-symbols-outlined">arrow_forward</span>
                            مواصلة التسوق
                        </a>
                    </div>

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

    <script>
        // ===== Update Quantity =====
        function updateQty(cartId, change) {
            const input = document.getElementById('qty-' + cartId);
            let value = parseInt(input.value) + change;
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 10;
            if (value < min) value = min;
            if (value > max) value = max;
            if (value === parseInt(input.value)) return;
            
            input.value = value;

            // إرسال AJAX لتحديث الكمية
            fetch('{{ route("customer.cart.update") }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: value,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // تحديث الإجمالي
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                location.reload();
            });
        }
    </script>

</body>
</html>