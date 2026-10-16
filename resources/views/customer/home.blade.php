<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Handora - الرئيسية</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .customer-home { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .hero-section { position: relative; z-index: 1; padding: 0 20px; margin-bottom: 40px; }
        .hero-section__content { background: rgba(255,255,255,0.7); backdrop-filter: blur(12px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.04); padding: 40px 48px; display: flex; align-items: center; gap: 40px; flex-wrap: wrap; }
        .hero-section__text { flex: 1; min-width: 280px; }
        .hero-section__text h1 { font-size: 2.2rem; font-weight: 800; color: #6F1D1B; margin: 0 0 8px; }
        .hero-section__text h1 .highlight { color: #D4AF37; }
        .hero-section__text p { font-size: 1rem; color: #47483c; margin: 0 0 20px; line-height: 1.8; max-width: 500px; }
        .hero-section__search { display: flex; align-items: center; gap: 0; background: rgba(247,243,233,0.5); border-radius: 9999px; border: 1px solid rgba(200,199,184,0.15); overflow: hidden; max-width: 450px; }
        .hero-section__search input { flex: 1; border: none; background: transparent; padding: 12px 20px; font-family: 'Tajawal', sans-serif; font-size: 0.9rem; color: #1c1c16; outline: none; }
        .hero-section__search input::placeholder { color: #a0a094; }
        .hero-section__search button { background: #9E2A2B; border: none; color: #fff; padding: 10px 20px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px; font-family: 'Tajawal', sans-serif; font-weight: 600; font-size: 0.85rem; }
        .hero-section__search button:hover { background: #7A1F20; }
        .hero-section__search button .material-symbols-outlined { font-size: 20px; }
        .hero-section__image { flex: 0 0 180px; display: flex; justify-content: center; align-items: center; }
        .hero-section__image img { width: 160px; height: auto; object-fit: contain; mix-blend-mode: multiply; }
        .categories-bar { position: relative; z-index: 1; padding: 0 20px; margin-bottom: 32px; }
        .categories-bar__inner { background: rgba(255,255,255,0.6); backdrop-filter: blur(8px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.4); padding: 10px 20px; display: flex; gap: 20px; overflow-x: auto; scrollbar-width: none; }
        .categories-bar__inner::-webkit-scrollbar { display: none; }
        .categories-bar__link { font-size: 0.85rem; font-weight: 600; color: #47483c; white-space: nowrap; padding: 6px 0; border-bottom: 2px solid transparent; transition: all 0.3s ease; text-decoration: none; }
        .categories-bar__link:hover { color: #9E2A2B; border-bottom-color: #9E2A2B; }
        .categories-bar__link.active { color: #9E2A2B; border-bottom-color: #9E2A2B; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 0 20px; position: relative; z-index: 1; }
        .section-header__title { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; display: flex; align-items: center; gap: 8px; }
        .section-header__title .material-symbols-outlined { color: #9E2A2B; }
        .section-header__link { font-size: 0.8rem; font-weight: 600; color: #9E2A2B; text-decoration: none; display: flex; align-items: center; gap: 4px; transition: color 0.3s; }
        .section-header__link:hover { color: #6F1D1B; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; padding: 0 20px; position: relative; z-index: 1; }
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
        .artisans-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; padding: 0 20px; position: relative; z-index: 1; }
        .artisan-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; text-align: center; }
        .artisan-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: #D4AF37; }
        .artisan-card__image { width: 80px; height: 80px; border-radius: 50%; margin: 16px auto 8px; overflow: hidden; background: #f7f3e9; border: 2px solid #D4AF37; }
        .artisan-card__image img { width: 100%; height: 100%; object-fit: cover; }
        .artisan-card__name { font-size: 0.95rem; font-weight: 700; color: #6F1D1B; }
        .artisan-card__role { font-size: 0.75rem; color: #77786b; }
        .artisan-card__rating { display: flex; align-items: center; justify-content: center; gap: 2px; font-size: 0.8rem; color: #D4AF37; margin: 4px 0 12px; }
        .artisan-card__rating .reviews { color: #a0a094; font-size: 0.6rem; }
        .empty-state { text-align: center; padding: 40px 20px; grid-column: 1 / -1; }
        .empty-state .material-symbols-outlined { font-size: 60px; color: #a0a094; }
        .empty-state h3 { font-size: 1.2rem; font-weight: 800; color: #6F1D1B; margin: 10px 0 6px; }
        .empty-state p { color: #77786b; }
        @media (max-width: 768px) {
            .customer-home { margin-top: 16px; padding: 12px 0 24px; }
            .hero-section__content { padding: 24px 20px; flex-direction: column; text-align: center; }
            .hero-section__text h1 { font-size: 1.6rem; }
            .hero-section__text p { max-width: 100%; }
            .hero-section__search { max-width: 100%; }
            .hero-section__image { flex: 0 0 auto; }
            .hero-section__image img { width: 120px; }
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 0 16px; }
            .artisans-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 0 16px; }
            .categories-bar { padding: 0 16px; }
            .section-header { padding: 0 16px; }
            .hero-section { padding: 0 16px; }
            .product-card__image { height: 140px; }
        }
        @media (max-width: 480px) {
            .products-grid { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .artisans-grid { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .product-card__image { height: 120px; }
            .product-card__name { font-size: 0.8rem; }
            .product-card__price { font-size: 0.85rem; }
            .hero-section__content { padding: 16px; }
            .hero-section__text h1 { font-size: 1.3rem; }
            .hero-section__search input { font-size: 0.8rem; padding: 10px 14px; }
            .hero-section__search button { font-size: 0.75rem; padding: 8px 14px; }
            .hero-section__image img { width: 100px; }
            .categories-bar { padding: 0 12px; }
            .categories-bar__inner { gap: 14px; padding: 8px 14px; }
            .categories-bar__link { font-size: 0.75rem; }
            .section-header { padding: 0 12px; }
            .section-header__title { font-size: 1.1rem; }
            .hero-section { padding: 0 12px; }
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
                <a href="{{ route('customer.home') }}" class="nav-desktop__link active">الرئيسية</a>
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

    <!-- ===== CUSTOMER HOME ===== -->
    <main class="customer-home">

        <div class="container">

            <!-- ===== Hero Section ===== -->
            <section class="hero-section">
                <div class="hero-section__content">
                    <div class="hero-section__text">
                        <h1>اكتشف <span class="highlight">ما لا تصنعه الآلة</span> ، فتتحول<br />المهارة إلى فنٍّ ساحر</h1>
                        <p>منصة تجمع الحِرف اليدوية المتنوعة من مختلف الثقافات، وتربط الحرفيين المبدعين بعشّاق الفن والأعمال الأصيلة .</p>
                        <form action="{{ route('customer.shop') }}" method="GET" class="hero-section__search">
                            <input type="text" name="search" placeholder="ابحث عن منتج..." />
                            <button type="submit">
                                <span class="material-symbols-outlined">search</span>
                                بحث
                            </button>
                        </form>
                    </div>
                    <div class="hero-section__image">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Handora" />
                    </div>
                </div>
            </section>

            <!-- ===== Categories Bar ===== -->
            <section class="categories-bar">
                <div class="categories-bar__inner">
                    <a href="{{ route('customer.shop') }}" class="categories-bar__link active">الكل</a>
                    @forelse($categories ?? [] as $category)
                        <a href="{{ route('customer.shop', ['category' => $category->id]) }}" class="categories-bar__link">{{ $category->name }}</a>
                    @empty
                        <a href="#" class="categories-bar__link">تطريز</a>
                        <a href="#" class="categories-bar__link">خزف</a>
                        <a href="#" class="categories-bar__link">مجوهرات</a>
                        <a href="#" class="categories-bar__link">أعمال خشبية</a>
                    @endforelse
                </div>
            </section>

            <!-- ===== Featured Products ===== -->
            <div class="section-header">
                <h2 class="section-header__title">
                    <span class="material-symbols-outlined">stars</span>
                    منتجات مميزة
                </h2>
                <a href="{{ route('customer.shop') }}" class="section-header__link">
                    عرض الكل
                    <span class="material-symbols-outlined">arrow_left_alt</span>
                </a>
            </div>

            <div class="products-grid">
                @forelse($featuredProducts ?? [] as $product)
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
                            <span class="product-card__badge product-card__badge--new">جديد</span>
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
                                <button class="product-card__cart-btn" onclick="event.preventDefault(); event.stopPropagation(); addToCart({{ $product->id }})">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                    أضف
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="empty-state">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <h3>لا توجد منتجات حالياً</h3>
                    <p>ترقبوا المنتجات الجديدة قريباً</p>
                </div>
                @endforelse
            </div>

            <!-- ===== Featured Artisans ===== -->
            <div class="section-header" style="margin-top: 32px;">
                <h2 class="section-header__title">
                    <span class="material-symbols-outlined">handshake</span>
                    حرفيون مميزون
                </h2>
                <a href="{{ route('customer.shop') }}" class="section-header__link">
                    عرض الكل
                    <span class="material-symbols-outlined">arrow_left_alt</span>
                </a>
            </div>

            <div class="artisans-grid">
                @forelse($featuredArtisans ?? [] as $artisan)
                <div class="artisan-card">
                    <div class="artisan-card__image">
                        @php
                            $avatarPath = 'assets/img/artisans/artisan-1.jpg';
                            if ($artisan->avatar) {
                                $avatarPath = 'storage/' . $artisan->avatar;
                            }
                        @endphp
                        <img src="{{ asset($avatarPath) }}" alt="{{ $artisan->name }}" />
                    </div>
                    <h3 class="artisan-card__name">{{ $artisan->name }}</h3>
                    <p class="artisan-card__role">{{ $artisan->specialty ?? 'حرفي' }}</p>
                    <div class="artisan-card__rating">
                        <span class="material-symbols-outlined" style="font-size:0.9rem;">star</span>
                        <span>4.9</span>
                        <span class="reviews">(124)</span>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span class="material-symbols-outlined">person</span>
                    <h3>لا يوجد حرفيون حالياً</h3>
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
        // ===== Add to Cart =====
        function addToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('{{ route("customer.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ 
                    product_id: productId, 
                    quantity: 1 
                })
            })
            .then(response => {
                if (response.status === 419) {
                    alert('❌ انتهت الجلسة، يرجى تحديث الصفحة');
                    location.reload();
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    const badge = document.querySelector('.nav-badge');
                    if (badge) {
                        badge.textContent = data.cart_count || (parseInt(badge.textContent) + 1);
                    }
                    alert('✅ تم إضافة المنتج إلى السلة');
                } else if (data) {
                    alert('❌ ' + (data.message || 'حدث خطأ'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ حدث خطأ في الاتصال');
            });
        }
    </script>

</body>
</html>