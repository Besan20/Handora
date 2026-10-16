<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .product-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .product-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .product-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .product-breadcrumb a:hover { text-decoration: underline; }
        .product-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .product-main { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; position: relative; z-index: 1; padding: 0 20px; margin-bottom: 40px; }
        .product-images { display: flex; flex-direction: column; gap: 12px; }
        .product-images__main { background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); overflow: hidden; height: 400px; }
        .product-images__main img { width: 100%; height: 100%; object-fit: cover; }
        .product-images__thumbnails { display: flex; gap: 10px; }
        .product-images__thumb { width: 80px; height: 80px; border-radius: 12px; overflow: hidden; border: 2px solid transparent; cursor: pointer; transition: all 0.3s ease; background: rgba(255,255,255,0.5); }
        .product-images__thumb img { width: 100%; height: 100%; object-fit: cover; }
        .product-images__thumb:hover { border-color: #D4AF37; }
        .product-images__thumb.active { border-color: #9E2A2B; }
        .product-info { display: flex; flex-direction: column; gap: 14px; }
        .product-info__badge { display: inline-block; font-size: 0.65rem; font-weight: 700; padding: 4px 14px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; width: fit-content; }
        .product-info__badge--new { background: rgba(84,98,58,0.15); color: #54623A; }
        .product-info__badge--sale { background: rgba(212,175,55,0.15); color: #B8962A; }
        .product-info__name { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; }
        .product-info__artisan { display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: #47483c; }
        .product-info__artisan a { color: #9E2A2B; font-weight: 600; text-decoration: none; }
        .product-info__artisan a:hover { text-decoration: underline; }
        .product-info__rating { display: flex; align-items: center; gap: 6px; font-size: 0.95rem; color: #D4AF37; }
        .product-info__rating .reviews { color: #a0a094; font-size: 0.85rem; }
        .product-info__price { font-size: 2rem; font-weight: 800; color: #6F1D1B; }
        .product-info__description { font-size: 0.95rem; line-height: 1.8; color: #47483c; }
        .product-info__meta { display: flex; gap: 20px; flex-wrap: wrap; font-size: 0.85rem; color: #77786b; }
        .product-info__meta span { display: flex; align-items: center; gap: 4px; }
        .product-info__meta .material-symbols-outlined { font-size: 18px; color: #9E2A2B; }
        .product-info__actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 8px; }
        .product-info__qty { display: flex; align-items: center; border: 1px solid rgba(200,199,184,0.2); border-radius: 12px; overflow: hidden; background: rgba(255,255,255,0.5); }
        .product-info__qty button { background: none; border: none; padding: 8px 14px; cursor: pointer; font-size: 1.2rem; color: #1c1c16; transition: all 0.3s ease; }
        .product-info__qty button:hover { background: rgba(159,42,43,0.06); }
        .product-info__qty input { width: 50px; text-align: center; border: none; background: transparent; font-family: 'Tajawal', sans-serif; font-size: 1rem; font-weight: 600; color: #1c1c16; outline: none; padding: 8px 0; }
        .btn--add-to-cart { background: #9E2A2B; color: #fff; border: none; border-radius: 12px; padding: 10px 28px; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; flex: 1; justify-content: center; }
        .btn--add-to-cart:hover { background: #7A1F20; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(159,42,43,0.2); }
        .btn--wishlist { background: none; border: 1px solid rgba(200,199,184,0.2); border-radius: 12px; padding: 10px 16px; cursor: pointer; transition: all 0.3s ease; color: #77786b; display: flex; align-items: center; justify-content: center; }
        .btn--wishlist:hover { border-color: #dc3545; color: #dc3545; background: rgba(220,53,69,0.04); }
        .btn--wishlist .material-symbols-outlined { font-size: 24px; }
        .related-products { position: relative; z-index: 1; padding: 0 20px; }
        .related-products__header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .related-products__header h2 { font-size: 1.3rem; font-weight: 800; color: #6F1D1B; display: flex; align-items: center; gap: 8px; }
        .related-products__header h2 .material-symbols-outlined { color: #9E2A2B; }
        .related-products__grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; }
        .related-product-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; }
        .related-product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: #D4AF37; }
        .related-product-card__image { height: 160px; overflow: hidden; background: #f7f3e9; }
        .related-product-card__image img { width: 100%; height: 100%; object-fit: cover; }
        .related-product-card__body { padding: 10px 14px; }
        .related-product-card__name { font-size: 0.85rem; font-weight: 700; color: #1c1c16; margin-bottom: 2px; }
        .related-product-card__artisan { font-size: 0.65rem; color: #77786b; margin-bottom: 4px; }
        .related-product-card__bottom { display: flex; justify-content: space-between; align-items: center; }
        .related-product-card__price { font-size: 0.95rem; font-weight: 800; color: #6F1D1B; }

        /* ===== Toast Notification ===== */
        .toast-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }
        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 22px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            font-family: 'Tajawal', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1c1c16;
            min-width: 300px;
            max-width: 450px;
            pointer-events: auto;
            animation: toastSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-right: 4px solid #54623A;
        }
        .toast--success { border-right-color: #54623A; }
        .toast--error { border-right-color: #dc3545; }
        .toast--info { border-right-color: #4285f4; }

        .toast__icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .toast--success .toast__icon { background: rgba(84, 98, 58, 0.15); color: #54623A; }
        .toast--error .toast__icon { background: rgba(220, 53, 69, 0.12); color: #dc3545; }
        .toast--info .toast__icon { background: rgba(66, 133, 244, 0.12); color: #4285f4; }

        .toast__icon .material-symbols-outlined { font-size: 22px; }
        .toast__message { flex: 1; line-height: 1.4; }
        .toast__close {
            background: none;
            border: none;
            color: #a0a094;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .toast__close:hover { background: rgba(0,0,0,0.05); color: #1c1c16; }
        .toast__close .material-symbols-outlined { font-size: 18px; }

        @keyframes toastSlideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes toastSlideOut {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(-30px); opacity: 0; }
        }
        .toast.removing {
            animation: toastSlideOut 0.3s ease forwards;
        }

        @media (max-width: 992px) {
            .product-main { grid-template-columns: 1fr; gap: 24px; padding: 0 20px; }
            .product-images__main { height: 300px; }
        }
        @media (max-width: 768px) {
            .product-page { margin-top: 16px; padding: 12px 0 24px; }
            .product-main { padding: 0 16px; }
            .product-images__main { height: 250px; }
            .product-images__thumb { width: 60px; height: 60px; }
            .product-info__name { font-size: 1.4rem; }
            .product-info__price { font-size: 1.5rem; }
            .related-products { padding: 0 16px; }
            .related-products__grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .product-breadcrumb { padding: 0 16px; }
            .toast { min-width: auto; max-width: calc(100vw - 40px); }
        }
        @media (max-width: 480px) {
            .product-images__main { height: 200px; }
            .product-images__thumb { width: 50px; height: 50px; }
            .product-info__name { font-size: 1.2rem; }
            .product-info__price { font-size: 1.3rem; }
            .product-info__actions { flex-direction: column; }
            .btn--add-to-cart { flex: none; width: 100%; }
            .related-products__grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .product-main { padding: 0 12px; }
            .related-products { padding: 0 12px; }
            .product-breadcrumb { padding: 0 12px; }
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

    <!-- ===== PRODUCT PAGE ===== -->
    <main class="product-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="product-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <a href="{{ route('customer.shop') }}">المتجر</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">{{ $product->name }}</span>
            </div>

            <!-- ===== Product Main ===== -->
            <div class="product-main">

                <!-- ===== Product Images ===== -->
                <div class="product-images">
                    <div class="product-images__main">
                        @php
                            $images = $product->images ?? [];
                            if (!is_array($images)) {
                                $images = json_decode($images, true) ?? [];
                            }
                            $mainImage = count($images) > 0 ? asset('storage/' . $images[0]) : asset('assets/img/products/product1-1.jpg');
                        @endphp
                        <img src="{{ $mainImage }}" alt="{{ $product->name }}" id="mainImage" />
                    </div>
                    <div class="product-images__thumbnails" id="thumbnails">
                        @forelse($images as $index => $image)
                            <div class="product-images__thumb {{ $index === 0 ? 'active' : '' }}" data-src="{{ asset('storage/' . $image) }}">
                                <img src="{{ asset('storage/' . $image) }}" alt="صورة {{ $index + 1 }}" />
                            </div>
                        @empty
                            <div class="product-images__thumb active" data-src="{{ asset('assets/img/products/product1-1.jpg') }}">
                                <img src="{{ asset('assets/img/products/product1-1.jpg') }}" alt="صورة 1" />
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ===== Product Info ===== -->
                <div class="product-info">
                    <span class="product-info__badge product-info__badge--new">جديد</span>

                    <h1 class="product-info__name">{{ $product->name }}</h1>

                    <div class="product-info__artisan">
                        <span class="material-symbols-outlined" style="color:#9E2A2B;">person</span>
                        بواسطة <a href="#">{{ $product->artisan->name ?? 'حرفي' }}</a>
                    </div>

                    <div class="product-info__rating">
                        <span class="material-symbols-outlined">star</span>
                        <span>4.9</span>
                        <span class="reviews">(12 تقييمات)</span>
                    </div>

                    <div class="product-info__price">
                        <span>${{ number_format($product->price, 2) }}</span>
                    </div>

                    <p class="product-info__description">
                        {{ $product->description }}
                    </p>

                    <div class="product-info__meta">
                        <span>
                            <span class="material-symbols-outlined">category</span>
                            التصنيف: <span>{{ $product->category->name ?? 'غير مصنف' }}</span>
                        </span>
                        <span>
                            <span class="material-symbols-outlined">inventory_2</span>
                            الكمية المتاحة: <span>{{ $product->stock }}</span>
                        </span>
                        <span>
                            <span class="material-symbols-outlined">local_shipping</span>
                            شحن مجاني
                        </span>
                    </div>

                    <div class="product-info__actions">
                        <div class="product-info__qty">
                            <button type="button" onclick="updateQty(-1)">−</button>
                            <input type="number" id="qtyInput" value="1" min="1" max="{{ $product->stock }}" />
                            <button type="button" onclick="updateQty(1)">+</button>
                        </div>

                        <button class="btn--add-to-cart" id="addToCartBtn" onclick="addToCart({{ $product->id }})">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                            أضف للسلة
                        </button>

                        <button class="btn--wishlist" title="أضف لقائمة الرغبات">
                            <span class="material-symbols-outlined">favorite_border</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- ===== Related Products ===== -->
            <section class="related-products">
                <div class="related-products__header">
                    <h2>
                        <span class="material-symbols-outlined">recommend</span>
                        منتجات مشابهة
                    </h2>
                    <a href="{{ route('customer.shop') }}" style="font-size:0.8rem; font-weight:600; color:#9E2A2B; text-decoration:none; display:flex; align-items:center; gap:4px;">
                        عرض الكل
                        <span class="material-symbols-outlined" style="font-size:1rem;">arrow_left_alt</span>
                    </a>
                </div>
                <div class="related-products__grid">
                    @forelse($relatedProducts ?? [] as $related)
                        <a href="{{ route('customer.product', $related->id) }}" style="text-decoration:none; color:inherit; display:block;">
                            <div class="related-product-card">
                                <div class="related-product-card__image">
                                    @php
                                        $rImages = $related->images ?? [];
                                        if (!is_array($rImages)) {
                                            $rImages = json_decode($rImages, true) ?? [];
                                        }
                                        $rImage = count($rImages) > 0 ? asset('storage/' . $rImages[0]) : asset('assets/img/products/product1-1.jpg');
                                    @endphp
                                    <img src="{{ $rImage }}" alt="{{ $related->name }}" />
                                </div>
                                <div class="related-product-card__body">
                                    <h3 class="related-product-card__name">{{ $related->name }}</h3>
                                    <p class="related-product-card__artisan">{{ $related->artisan->name ?? 'حرفي' }}</p>
                                    <div class="related-product-card__bottom">
                                        <span class="related-product-card__price">${{ number_format($related->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p style="text-align:center; padding:20px; color:#77786b; grid-column: 1 / -1;">
                            لا توجد منتجات مشابهة حالياً
                        </p>
                    @endforelse
                </div>
            </section>

        </div>

    </main>

    <!-- ===== TOAST CONTAINER ===== -->
    <div class="toast-container" id="toastContainer"></div>

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
        // ===== Toast Function =====
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const icons = {
                success: 'check_circle',
                error: 'error',
                info: 'info'
            };

            const toast = document.createElement('div');
            toast.className = `toast toast--${type}`;
            toast.innerHTML = `
                <div class="toast__icon">
                    <span class="material-symbols-outlined">${icons[type] || 'info'}</span>
                </div>
                <div class="toast__message">${message}</div>
                <button class="toast__close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-outlined">close</span>
                </button>
            `;

            container.appendChild(toast);

            // إزالة تلقائية بعد 3 ثواني
            setTimeout(() => {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ===== Change Image =====
        document.querySelectorAll('.product-images__thumb').forEach(thumb => {
            thumb.addEventListener('click', function() {
                const src = this.dataset.src;
                document.getElementById('mainImage').src = src;
                document.querySelectorAll('.product-images__thumb').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ===== Update Quantity =====
        function updateQty(change) {
            const input = document.getElementById('qtyInput');
            let value = parseInt(input.value) + change;
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 99;
            if (value < min) value = min;
            if (value > max) value = max;
            input.value = value;
        }

        // ===== Add to Cart =====
        function addToCart(productId) {
            const quantity = parseInt(document.getElementById('qtyInput').value) || 1;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const btn = document.getElementById('addToCartBtn');
            const originalText = btn.innerHTML;

            // تعطيل الزر مؤقتاً
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined">hourglass_top</span> جاري الإضافة...';

            fetch('{{ route("customer.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => {
                if (response.status === 419) {
                    showToast('انتهت الجلسة، يرجى تحديث الصفحة', 'error');
                    setTimeout(() => location.reload(), 1500);
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    const badge = document.querySelector('.nav-badge');
                    if (badge) {
                        badge.textContent = data.cart_count || (parseInt(badge.textContent) + quantity);
                    }
                    showToast('تم إضافة المنتج إلى السلة', 'success');
                } else if (data) {
                    showToast(data.message || 'حدث خطأ', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('حدث خطأ في الاتصال', 'error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        }

        // ===== Prevent negative input =====
        document.getElementById('qtyInput').addEventListener('change', function() {
            let value = parseInt(this.value);
            const min = parseInt(this.min) || 1;
            const max = parseInt(this.max) || 99;
            if (isNaN(value) || value < min) this.value = min;
            if (value > max) this.value = max;
        });
    </script>

</body>
</html>
