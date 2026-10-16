<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>متجر {{ $artisan->name }} - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .shop-preview { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .shop-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .shop-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .shop-breadcrumb a:hover { text-decoration: underline; }
        .shop-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .artisan-profile { background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.05); padding: 28px 32px; margin-bottom: 28px; position: relative; z-index: 1; display: flex; align-items: center; gap: 28px; flex-wrap: wrap; }
        .artisan-profile__avatar { width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #9E2A2B, #6F1D1B); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2.8rem; font-weight: 800; flex-shrink: 0; border: 3px solid #D4AF37; box-shadow: 0 4px 20px rgba(159,42,43,0.15); }
        .artisan-profile__info { flex: 1; }
        .artisan-profile__info h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0 0 4px; display: flex; align-items: center; gap: 10px; }
        .artisan-profile__info h1 .badge { font-size: 0.6rem; background: #D4AF37; color: #fff; padding: 2px 14px; border-radius: 9999px; font-weight: 700; }
        .artisan-profile__info .specialty { color: #9E2A2B; font-size: 0.95rem; font-weight: 600; margin-bottom: 6px; }
        .artisan-profile__info .bio { color: #47483c; font-size: 0.9rem; max-width: 500px; line-height: 1.6; }
        .artisan-profile__stats { display: flex; gap: 20px; flex-wrap: wrap; }
        .artisan-profile__stat { text-align: center; background: rgba(247,243,233,0.5); padding: 8px 18px; border-radius: 10px; min-width: 60px; }
        .artisan-profile__stat .number { font-size: 1.2rem; font-weight: 800; color: #6F1D1B; }
        .artisan-profile__stat .label { font-size: 0.6rem; color: #77786b; text-transform: uppercase; letter-spacing: 0.04em; }
        .artisan-profile__edit { margin-right: auto; }
        .artisan-profile__edit .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 10px; font-weight: 700; font-size: 13px; border: 2px solid #9E2A2B; color: #9E2A2B; background: transparent; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        .artisan-profile__edit .btn:hover { background: #9E2A2B; color: #ffffff; transform: translateY(-2px); }
        .shop-controls { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .shop-controls__filters { display: flex; gap: 6px; flex-wrap: wrap; }
        .shop-controls__filters .filter-btn { padding: 4px 16px; border-radius: 9999px; border: 1px solid rgba(200,199,184,0.2); background: rgba(255,255,255,0.6); backdrop-filter: blur(4px); font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; color: #77786b; }
        .shop-controls__filters .filter-btn:hover { background: rgba(159,42,43,0.06); border-color: #9E2A2B; }
        .shop-controls__filters .filter-btn.active { background: #9E2A2B; color: #ffffff; border-color: #9E2A2B; }
        .shop-controls__search { display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); border-radius: 9999px; padding: 4px 16px; border: 1px solid rgba(200,199,184,0.15); }
        .shop-controls__search .material-symbols-outlined { color: #77786b; font-size: 1.2rem; }
        .shop-controls__search input { border: none; background: transparent; padding: 8px 0; font-size: 0.9rem; outline: none; color: #1c1c16; width: 160px; }
        .shop-controls__search input::placeholder { color: #a0a094; }
        .shop-products { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .product-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: #D4AF37; }
        .product-card__image { position: relative; height: 200px; overflow: hidden; background: #f7f3e9; }
        .product-card__image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-card__image img { transform: scale(1.05); }
        .product-card__badge { position: absolute; top: 10px; right: 10px; font-size: 0.55rem; font-weight: 700; padding: 3px 12px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; }
        .product-card__badge--new { background: rgba(84,98,58,0.15); color: #54623A; }
        .product-card__badge--sale { background: rgba(212,175,55,0.15); color: #B8962A; }
        .product-card__body { padding: 14px 16px; }
        .product-card__name { font-size: 1rem; font-weight: 700; color: #1c1c16; margin-bottom: 2px; }
        .product-card__artisan { font-size: 0.75rem; color: #77786b; margin-bottom: 4px; }
        .product-card__rating { display: flex; align-items: center; gap: 2px; font-size: 0.8rem; color: #D4AF37; margin-bottom: 8px; }
        .product-card__rating .reviews { color: #a0a094; font-size: 0.65rem; }
        .product-card__bottom { display: flex; justify-content: space-between; align-items: center; }
        .product-card__price { font-size: 1.1rem; font-weight: 800; color: #6F1D1B; }
        .product-card__cart-btn { background: #9E2A2B; color: #ffffff; border: none; border-radius: 9999px; padding: 6px 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 4px; font-family: 'Tajawal', sans-serif; font-size: 0.75rem; font-weight: 700; }
        .product-card__cart-btn:hover { background: #7A1F20; transform: scale(1.02); }
        .product-card__cart-btn .material-symbols-outlined { font-size: 18px; }
        .empty-state { text-align: center; padding: 60px 20px; grid-column: 1 / -1; }
        .empty-state .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-state h3 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-state p { color: #77786b; margin-bottom: 16px; }
        @media (max-width: 768px) {
            .shop-preview { margin-top: 16px; padding: 12px 0 24px; }
            .artisan-profile { padding: 20px; flex-direction: column; align-items: center; text-align: center; }
            .artisan-profile__info h1 { justify-content: center; flex-wrap: wrap; }
            .artisan-profile__info .bio { max-width: 100%; }
            .artisan-profile__stats { justify-content: center; }
            .artisan-profile__edit { margin-right: 0; }
            .shop-controls { flex-direction: column; align-items: stretch; padding: 0 16px; }
            .shop-controls__search input { width: 100%; }
            .shop-controls__search { width: 100%; }
            .shop-products { grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 0 16px; }
            .product-card__image { height: 150px; }
            .shop-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .artisan-profile { padding: 16px; }
            .artisan-profile__avatar { width: 80px; height: 80px; font-size: 2rem; }
            .artisan-profile__info h1 { font-size: 1.4rem; justify-content: center; }
            .shop-products { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .product-card__image { height: 130px; }
            .product-card__name { font-size: 0.85rem; }
            .product-card__price { font-size: 0.95rem; }
            .shop-breadcrumb { padding: 0 12px; }
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

    <!-- ===== SHOP PREVIEW ===== -->
    <main class="shop-preview">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="shop-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">متجري</span>
            </div>

            <!-- ===== Artisan Profile ===== -->
            <div class="artisan-profile">
                <div class="artisan-profile__avatar">
                    {{ mb_substr($artisan->name, 0, 1) }}
                </div>
                <div class="artisan-profile__info">
                    <h1>
                        {{ $artisan->name }}
                        <span class="badge">حرفي موثوق</span>
                    </h1>
                    <div class="specialty">{{ $artisan->specialty ?? 'حرفي' }}</div>
                    <p class="bio">{{ $artisan->bio ?? 'مرحباً بك في متجري، اكتشف منتجاتي اليدوية الفريدة.' }}</p>
                </div>
                <div class="artisan-profile__stats">
                    <div class="artisan-profile__stat">
                        <div class="number">{{ $products->count() }}</div>
                        <div class="label">منتجات</div>
                    </div>
                    <div class="artisan-profile__stat">
                        <div class="number">4.9</div>
                        <div class="label">تقييم</div>
                    </div>
                    <div class="artisan-profile__stat">
                        <div class="number">{{ $products->sum('sales_count') ?? 0 }}</div>
                        <div class="label">مبيعات</div>
                    </div>
                </div>
                <div class="artisan-profile__edit">
                    <a href="{{ route('artisan.edit-profile') }}" class="btn">
                        <span class="material-symbols-outlined">edit</span>
                        تعديل المتجر
                    </a>
                </div>
            </div>

            <!-- ===== Shop Controls ===== -->
            <div class="shop-controls">
                <div class="shop-controls__filters">
                    <button class="filter-btn active" data-filter="all">الكل</button>
                    <button class="filter-btn" data-sort="newest">الأحدث</button>
                    <button class="filter-btn" data-sort="price-low">الأقل سعراً</button>
                    <button class="filter-btn" data-sort="price-high">الأعلى سعراً</button>
                </div>
                <div class="shop-controls__search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" id="searchInput" placeholder="ابحث في المتجر..." />
                </div>
            </div>

            <!-- ===== Products Grid ===== -->
            <div class="shop-products" id="productsGrid">

                @forelse($products as $product)
                <div class="product-card" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-created="{{ $product->created_at }}">
                    <div class="product-card__image">
                        @php
                            $imagePath = 'assets/img/products/product1-1.jpg';
                            if ($product->images && is_array($product->images) && count($product->images) > 0) {
                                $imagePath = 'storage/' . $product->images[0];
                            }
                        @endphp
                        <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" />
                        @if($product->created_at->diffInDays(now()) < 7)
                            <span class="product-card__badge product-card__badge--new">جديد</span>
                        @endif
                    </div>
                    <div class="product-card__body">
                        <h3 class="product-card__name">{{ $product->name }}</h3>
                        <p class="product-card__artisan">{{ $artisan->name }}</p>
                        <div class="product-card__rating">
                            <span class="material-symbols-outlined" style="font-size:1rem;">star</span>
                            <span>4.9</span>
                            <span class="reviews">(12 تقييم)</span>
                        </div>
                        <div class="product-card__bottom">
                            <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
                            <button class="product-card__cart-btn">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                                أضف
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <span class="material-symbols-outlined">storefront</span>
                    <h3>لا توجد منتجات</h3>
                    <p>لم تقم بإضافة أي منتجات بعد</p>
                </div>
                @endforelse

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

    <script>
        // ===== Filter Buttons =====
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ===== Search =====
        document.getElementById('searchInput')?.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                const name = card.dataset.name.toLowerCase();
                card.style.display = name.includes(query) ? '' : 'none';
            });
        });
    </script>

</body>
</html>