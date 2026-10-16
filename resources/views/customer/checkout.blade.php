<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنهاء الطلب - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .checkout-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; }
        .checkout-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .checkout-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .checkout-breadcrumb a:hover { text-decoration: underline; }
        .checkout-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .checkout-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .checkout-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .checkout-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .checkout-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .checkout-main { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .checkout-form { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); padding: 24px; }
        .checkout-form__title { font-size: 1rem; font-weight: 800; color: #6F1D1B; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .checkout-form__title .material-symbols-outlined { color: #9E2A2B; }
        .checkout-form__group { margin-bottom: 16px; }
        .checkout-form__group label { display: block; font-size: 0.85rem; font-weight: 600; color: #1c1c16; margin-bottom: 4px; }
        .checkout-form__group label .required { color: #dc3545; }
        .checkout-form__group input, .checkout-form__group select, .checkout-form__group textarea { width: 100%; padding: 10px 14px; border: 1.5px solid rgba(200,199,184,0.2); border-radius: 10px; background: rgba(247,243,233,0.3); font-family: 'Tajawal', sans-serif; font-size: 0.9rem; color: #1c1c16; outline: none; transition: all 0.3s ease; }
        .checkout-form__group input:focus, .checkout-form__group select:focus, .checkout-form__group textarea:focus { border-color: #D4AF37; background: rgba(255,255,255,0.6); }
        .checkout-form__group textarea { resize: vertical; min-height: 80px; }
        .checkout-form__row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .payment-methods { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }
        .payment-method { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 2px solid rgba(200,199,184,0.15); border-radius: 10px; cursor: pointer; transition: all 0.3s ease; background: rgba(247,243,233,0.2); }
        .payment-method:hover { border-color: #D4AF37; background: rgba(212,175,55,0.03); }
        .payment-method input[type="radio"] { width: 18px; height: 18px; accent-color: #9E2A2B; cursor: pointer; flex-shrink: 0; }
        .payment-method:has(input:checked) { border-color: #9E2A2B; background: rgba(159,42,43,0.04); }
        .payment-method__info { display: flex; align-items: center; gap: 10px; flex: 1; }
        .payment-method__info .material-symbols-outlined { font-size: 28px; color: #9E2A2B; }
        .payment-method__info .name { font-weight: 600; font-size: 0.9rem; color: #1c1c16; }
        .payment-method__info .desc { font-size: 0.75rem; color: #77786b; }
        .order-summary { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); padding: 24px; align-self: start; position: sticky; top: 100px; }
        .order-summary__title { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid rgba(200,199,184,0.08); }
        .order-summary__item { display: flex; gap: 12px; padding: 8px 0; border-bottom: 1px solid rgba(200,199,184,0.04); }
        .order-summary__item:last-child { border-bottom: none; }
        .order-summary__item-image { width: 50px; height: 50px; border-radius: 8px; overflow: hidden; flex-shrink: 0; background: #f7f3e9; }
        .order-summary__item-image img { width: 100%; height: 100%; object-fit: cover; }
        .order-summary__item-info { flex: 1; }
        .order-summary__item-name { font-size: 0.85rem; font-weight: 700; color: #1c1c16; }
        .order-summary__item-meta { font-size: 0.7rem; color: #77786b; }
        .order-summary__item-price { font-size: 0.85rem; font-weight: 700; color: #6F1D1B; white-space: nowrap; }
        .order-summary__row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 0.9rem; color: #47483c; }
        .order-summary__row--total { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; padding-top: 12px; margin-top: 8px; border-top: 2px solid #9E2A2B; }
        .btn--place-order { width: 100%; padding: 14px; background: #9E2A2B; color: #fff; border: none; border-radius: 12px; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 16px; }
        .btn--place-order:hover { background: #7A1F20; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(159,42,43,0.2); }
        .btn--place-order:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .empty-cart { text-align: center; padding: 60px 20px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); }
        .empty-cart .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-cart h2 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-cart .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; background: #9E2A2B; color: #fff; }
        .empty-cart .btn:hover { background: #7A1F20; transform: translateY(-2px); }
        @media (max-width: 1024px) {
            .checkout-main { grid-template-columns: 1fr; }
            .order-summary { position: static; }
        }
        @media (max-width: 768px) {
            .checkout-page { margin-top: 16px; padding: 12px 0 24px; }
            .checkout-header { padding: 0 16px; flex-direction: column; align-items: stretch; }
            .checkout-header__title p { margin-right: 0; }
            .checkout-main { padding: 0 16px; }
            .checkout-form { padding: 20px; }
            .checkout-form__row { grid-template-columns: 1fr; }
            .order-summary { padding: 20px; }
            .checkout-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .checkout-form { padding: 16px; }
            .order-summary { padding: 16px; }
            .checkout-header__title h1 { font-size: 1.4rem; }
            .order-summary__item-image { width: 40px; height: 40px; }
            .checkout-breadcrumb { padding: 0 12px; }
            .checkout-header { padding: 0 12px; }
            .checkout-main { padding: 0 12px; }
            .payment-method { padding: 10px 12px; }
            .payment-method__info .material-symbols-outlined { font-size: 22px; }
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

    <!-- ===== CHECKOUT PAGE ===== -->
    <main class="checkout-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="checkout-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <a href="{{ route('customer.cart') }}">سلة المشتريات</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">إنهاء الطلب</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="checkout-header">
                <div class="checkout-header__title">
                    <h1>
                        <span class="material-symbols-outlined">receipt_long</span>
                        إنهاء الطلب
                    </h1>
                    <p>أكمل بياناتك لتأكيد الطلب</p>
                </div>
            </div>

            @if($cartItems->isEmpty())
                <!-- ===== Empty Cart ===== -->
                <div class="empty-cart">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <h2>سلة المشتريات فارغة</h2>
                    <p>لا يمكن إتمام الطلب بدون منتجات</p>
                    <a href="{{ route('customer.shop') }}" class="btn">
                        <span class="material-symbols-outlined">storefront</span>
                        تسوق الآن
                    </a>
                </div>
            @else
                <!-- ===== Checkout Main ===== -->
                <form action="{{ route('customer.checkout.place') }}" method="POST" class="checkout-main">
                    @csrf

                    <!-- ===== Checkout Form ===== -->
                    <div class="checkout-form">
                        <h2 class="checkout-form__title">
                            <span class="material-symbols-outlined">person</span>
                            بيانات الشحن
                        </h2>

                        <div class="checkout-form__group">
                            <label for="fullName">الاسم الكامل <span class="required">*</span></label>
                            <input type="text" id="fullName" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="أدخل اسمك الكامل" required />
                            @error('name')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="checkout-form__row">
                            <div class="checkout-form__group">
                                <label for="email">البريد الإلكتروني <span class="required">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="example@email.com" required />
                                @error('email')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout-form__group">
                                <label for="phone">رقم الهاتف <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+970 599 000 000" required />
                                @error('phone')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="checkout-form__group">
                            <label for="address">العنوان <span class="required">*</span></label>
                            <input type="text" id="address" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="المدينة، الشارع، المبنى" required />
                            @error('address')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="checkout-form__row">
                            <div class="checkout-form__group">
                                <label for="city">المدينة <span class="required">*</span></label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="رام الله" required />
                            </div>
                            <div class="checkout-form__group">
                                <label for="postal">الرمز البريدي</label>
                                <input type="text" id="postal" name="postal_code" value="{{ old('postal_code') }}" placeholder="00000" />
                            </div>
                        </div>

                        <div class="checkout-form__group">
                            <label for="notes">ملاحظات إضافية</label>
                            <textarea id="notes" name="notes" placeholder="أي ملاحظات تريد إضافتها للطلب...">{{ old('notes') }}</textarea>
                        </div>

                        <h2 class="checkout-form__title" style="margin-top: 20px;">
                            <span class="material-symbols-outlined">payment</span>
                            طريقة الدفع
                        </h2>

                        <div class="payment-methods">
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="card" {{ old('payment_method') === 'card' ? 'checked' : 'checked' }} />
                                <div class="payment-method__info">
                                    <span class="material-symbols-outlined">credit_card</span>
                                    <div>
                                        <div class="name">بطاقة ائتمان</div>
                                        <div class="desc">Visa, MasterCard, Mada</div>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="paypal" {{ old('payment_method') === 'paypal' ? 'checked' : '' }} />
                                <div class="payment-method__info">
                                    <span class="material-symbols-outlined">wallet</span>
                                    <div>
                                        <div class="name">PayPal</div>
                                        <div class="desc">دفع آمن عبر PayPal</div>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="cod" {{ old('payment_method') === 'cod' ? 'checked' : '' }} />
                                <div class="payment-method__info">
                                    <span class="material-symbols-outlined">local_shipping</span>
                                    <div>
                                        <div class="name">الدفع عند الاستلام</div>
                                        <div class="desc">ادفع عند استلام المنتج</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- ===== Order Summary ===== -->
                    <div class="order-summary">
                        <h3 class="order-summary__title">ملخص الطلب</h3>

                        @foreach($cartItems as $item)
                        <div class="order-summary__item">
                            <div class="order-summary__item-image">
                                @php
                                    $imagePath = 'assets/img/products/product1-1.jpg';
                                    if ($item->product->images && is_array($item->product->images) && count($item->product->images) > 0) {
                                        $imagePath = 'storage/' . $item->product->images[0];
                                    }
                                @endphp
                                <img src="{{ asset($imagePath) }}" alt="{{ $item->product->name }}" />
                            </div>
                            <div class="order-summary__item-info">
                                <div class="order-summary__item-name">{{ $item->product->name }}</div>
                                <div class="order-summary__item-meta">الكمية: {{ $item->quantity }}</div>
                            </div>
                            <div class="order-summary__item-price">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                        </div>
                        @endforeach

                        <div class="order-summary__row">
                            <span>إجمالي المنتجات</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="order-summary__row">
                            <span>الشحن</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>

                        <div class="order-summary__row">
                            <span>الضريبة (5%)</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="order-summary__row order-summary__row--total">
                            <span>الإجمالي</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn--place-order">
                            <span class="material-symbols-outlined">done_all</span>
                            تأكيد الطلب
                        </button>
                    </div>

                </form>
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