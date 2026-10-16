<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>المتجر - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .shop-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .shop-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .shop-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .shop-breadcrumb a:hover { text-decoration: underline; }
        .shop-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .shop-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .shop-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .shop-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .shop-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .shop-filters { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; padding: 12px 18px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 14px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); position: relative; z-index: 1; margin-left: 20px; margin-right: 20px; }
        .shop-filters__categories { display: flex; gap: 6px; flex-wrap: wrap; }
        .shop-filters__categories .filter-btn { padding: 4px 14px; border-radius: 9999px; border: 1px solid rgba(200,199,184,0.2); background: rgba(255,255,255,0.4); font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; color: #77786b; text-decoration: none; }
        .shop-filters__categories .filter-btn:hover { background: rgba(159,42,43,0.06); border-color: #9E2A2B; }
        .shop-filters__categories .filter-btn.active { background: #9E2A2B; color: #ffffff; border-color: #9E2A2B; }
        .shop-filters__sort { display: flex; align-items: center; gap: 8px; }
        .shop-filters__sort label { font-size: 0.75rem; font-weight: 600; color: #77786b; }
        .shop-filters__sort select { padding: 4px 12px; border-radius: 9999px; border: 1px solid rgba(200,199,184,0.2); background: rgba(255,255,255,0.4); font-family: 'Tajawal', sans-serif; font-size: 0.75rem; font-weight: 600; color: #1c1c16; outline: none; cursor: pointer; }
        .shop-filters__search { display: flex; align-items: center; gap: 8px; background: rgba(247,243,233,0.5); border-radius: 9999px; padding: 4px 14px; border: 1px solid rgba(200,199,184,0.15); }
        .shop-filters__search .material-symbols-outlined { color: #77786b; font-size: 1.1rem; }
        .shop-filters__search input { border: none; background: transparent; padding: 6px 0; font-size: 0.85rem; outline: none; color: #1c1c16; width: 140px; }
        .shop-filters__search input::placeholder { color: #a0a094; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .product-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: #D4AF37; }
        .product-card__image { position: relative; height: 180px; overflow: hidden; background: #f7f3e9; }
        .product-card__image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-card__image img { transform: scale(1.05); }
        .product-card__badge { position: absolute; top: 10px; right: 10px; font-size: 0.5rem; font-weight: 700; padding: 2px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; }
        .product-card__badge--new { background: rgba(84,98,58,0.15); color: #54623A; }
        .product-card__badge--sale { background: rgba(212,175,55,0.15); color: #B8962A; }
        .product-card__body { padding: 12px 14px; }
        .product-card__name { font-size: 0.9rem; font-weight: 700; color: #1c1c16; margin-bottom: 2px; }
        .product-card__artisan { font-size: 0.7rem; color: #77786b; margin-bottom: 4px; }
        .product-card__rating { display: flex; align-items: center; gap: 2px; font-size: 0.75rem; color: #D4AF37; margin-bottom: 6px; }
        .product-card__rating .reviews { color: #a0a094; font-size: 0.6rem; }
        .product-card__bottom { display: flex; justify-content: space-between; align-items: center; }
        .product-card__price { font-size: 1rem; font-weight: 800; color: #6F1D1B; }
        .product-card__cart-btn { background: #9E2A2B; color: #fff; border: none; border-radius: 9999px; padding: 4px 10px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 4px; font-family: 'Tajawal', sans-serif; font-size: 0.65rem; font-weight: 700; }
        .product-card__cart-btn:hover { background: #7A1F20; transform: scale(1.02); }
        .product-card__cart-btn .material-symbols-outlined { font-size: 16px; }
        .empty-state { text-align: center; padding: 60px 20px; grid-column: 1 / -1; }
        .empty-state .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-state h3 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-state p { color: #77786b; }
        .alert-success { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 12px; margin: 0 20px 20px; text-align: center; }
        @media (max-width: 768px) {
            .shop-page { margin-top: 16px; padding: 12px 0 24px; }
            .shop-header { flex-direction: column; align-items: stretch; padding: 0 16px; }
            .shop-header__title p { margin-right: 0; }
            .shop-filters { flex-direction: column; align-items: stretch; margin-left: 16px; margin-right: 16px; padding: 10px 14px; }
            .shop-filters__search input { width: 100%; }
            .shop-filters__search { width: 100%; }
            .shop-filters__sort { justify-content: space-between; }
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 0 16px; }
            .product-card__image { height: 140px; }
            .shop-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .products-grid { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .product-card__image { height: 120px; }
            .product-card__name { font-size: 0.8rem; }
            .product-card__price { font-size: 0.85rem; }
            .product-card__cart-btn { font-size: 0.55rem; padding: 3px 8px; }
            .product-card__cart-btn .material-symbols-outlined { font-size: 14px; }
            .shop-filters { margin-left: 12px; margin-right: 12px; }
            .shop-filters__categories .filter-btn { font-size: 0.65rem; padding: 3px 10px; }
            .shop-filters__sort select { font-size: 0.65rem; padding: 3px 10px; }
            .shop-breadcrumb { padding: 0 12px; }
            .shop-header { padding: 0 12px; }
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
                <a href="{{ route('customer.shop') }}" class="nav-desktop__link active">المتجر</a>
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

    <!-- ===== SHOP PAGE ===== -->
    <main class="shop-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="shop-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">المتجر</span>
            </div>

            <!-- ===== Flash Message ===== -->
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <!-- ===== Header ===== -->
            <div class="shop-header">
                <div class="shop-header__title">
                    <h1>
                        <span class="material-symbols-outlined">storefront</span>
                        المتجر
                    </h1>
                    <p>اكتشف تشكيلتنا من الحرف اليدوية الأصيلة</p>
                </div>
            </div>

            <!-- ===== Filters ===== -->
            <div class="shop-filters">
                <div class="shop-filters__categories">
                    <a href="{{ route('customer.shop') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">الكل</a>
                    @forelse($categories ?? [] as $category)
                        <a href="{{ route('customer.shop', ['category' => $category->id]) }}" 
                           class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @empty
                        <a href="#" class="filter-btn">تطريز</a>
                        <a href="#" class="filter-btn">خزف</a>
                        <a href="#" class="filter-btn">مجوهرات</a>
                        <a href="#" class="filter-btn">أعمال خشبية</a>
                    @endforelse
                </div>
                <form action="{{ route('customer.shop') }}" method="GET" class="shop-filters__sort" style="display:flex; gap:8px; align-items:center;">
                    <label for="sortSelect">ترتيب:</label>
                    <select id="sortSelect" name="sort" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>الأحدث</option>
                        <option value="price-low" {{ request('sort') === 'price-low' ? 'selected' : '' }}>الأقل سعراً</option>
                        <option value="price-high" {{ request('sort') === 'price-high' ? 'selected' : '' }}>الأعلى سعراً</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>الأكثر مبيعاً</option>
                    </select>
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}" />
                    @endif
                </form>
                <form action="{{ route('customer.shop') }}" method="GET" class="shop-filters__search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث عن منتج..." />
                </form>
            </div>

            <!-- ===== Products Grid ===== -->
            <div class="products-grid">
                @forelse($products ?? [] as $product)
                <a href="{{ route('customer.product', $product->id) }}" style="text-decoration:none; color:inherit; display:block;">
                    <div class="product-card">
                        <div class="product-card__image">
                            @php
                                $imagePath = 'assets/img/products/product1-1.jpg';
                                if ($product->images && is_array($product->images) && count($product->images) > 0) {
                                    $imagePath = 'storage/' . $product->images[0];
                                }
                            @endphp
                            <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" />
                            @if($loop->first)
                                <span class="product-card__badge product-card__badge--new">جديد</span>
                            @endif
                        </div>
                        <div class="product-card__body">
                            <h3 class="product-card__name">{{ $product->name }}</h3>
                            <p class="product-card__artisan">{{ $product->artisan->name ?? 'حرفي' }}</p>
                            <div class="product-card__rating">
                                <span class="material-symbols-outlined" style="font-size:0.9rem;">star</span>
                                <span>4.9</span>
                                <span class="reviews">(12)</span>
                            </div>
                            <div class="product-card__bottom">
                                <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
                                <form action="{{ route('customer.cart.add') }}" method="POST" style="display:inline;" onclick="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    <input type="hidden" name="quantity" value="1" />
                                    <button type="submit" class="product-card__cart-btn">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                        أضف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="empty-state">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <h3>لا توجد منتجات</h3>
                    <p>لم نجد أي منتجات مطابقة لبحثك</p>
                    <a href="{{ route('customer.shop') }}" style="display:inline-block; margin-top:16px; padding:10px 24px; background:#9E2A2B; color:#fff; border-radius:12px; text-decoration:none; font-weight:600;">عرض جميع المنتجات</a>
                </div>
                @endforelse
            </div>

            <!-- ===== Pagination ===== -->
            @if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
            <div class="pagination">
                {{ $products->appends(request()->query())->links('pagination::simple-default') }}
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