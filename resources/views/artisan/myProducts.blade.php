<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>منتجاتي - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        /* ===== نفس الـ Styles من الكود الأصلي ===== */
        .products-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .products-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .products-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .products-breadcrumb a:hover { text-decoration: underline; }
        .products-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .products-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .products-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .products-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .products-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .products-header__actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .products-header__actions .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        .products-stats { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; position: relative; z-index: 1; padding: 0 20px; }
        .products-stats__item { background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); padding: 10px 20px; border-radius: 12px; border: 1px solid rgba(200,199,184,0.12); box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 10px; }
        .products-stats__item .number { font-size: 1.3rem; font-weight: 800; color: #9E2A2B; }
        .products-stats__item .label { font-size: 0.8rem; color: #77786b; }
        .products-filters { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; padding: 12px 18px; background: rgba(255,255,255,0.7); backdrop-filter: blur(8px); border-radius: 14px; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); position: relative; z-index: 1; margin-left: 20px; margin-right: 20px; }
        .products-filters__group { display: flex; gap: 6px; flex-wrap: wrap; }
        .products-filters__group .filter-btn { padding: 4px 14px; border-radius: 9999px; border: 1px solid rgba(200,199,184,0.2); background: transparent; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; color: #77786b; }
        .products-filters__group .filter-btn:hover { background: rgba(159,42,43,0.06); border-color: #9E2A2B; }
        .products-filters__group .filter-btn.active { background: #9E2A2B; color: #ffffff; border-color: #9E2A2B; }
        .products-filters__search { display: flex; align-items: center; gap: 8px; background: rgba(247,243,233,0.5); border-radius: 9999px; padding: 4px 14px; border: 1px solid rgba(200,199,184,0.15); }
        .products-filters__search .material-symbols-outlined { color: #77786b; font-size: 1.1rem; }
        .products-filters__search input { border: none; background: transparent; padding: 6px 0; font-size: 0.85rem; outline: none; color: #1c1c16; width: 140px; }
        .products-filters__search input::placeholder { color: #a0a094; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; position: relative; z-index: 1; padding: 0 20px; }
        .product-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.04); transition: all 0.3s ease; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: #D4AF37; }
        .product-card__image { position: relative; height: 180px; overflow: hidden; background: #f7f3e9; }
        .product-card__image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-card__image img { transform: scale(1.04); }
        .product-card__status { position: absolute; top: 10px; right: 10px; font-size: 0.55rem; font-weight: 700; padding: 2px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; }
        .product-card__status--active { background: rgba(84,98,58,0.15); color: #54623A; }
        .product-card__status--draft { background: rgba(200,199,184,0.2); color: #77786b; }
        .product-card__status--sold { background: rgba(159,42,43,0.15); color: #9E2A2B; }
        .product-card__body { padding: 14px 16px; }
        .product-card__name { font-size: 0.95rem; font-weight: 700; color: #1c1c16; margin-bottom: 2px; }
        .product-card__category { font-size: 0.7rem; color: #77786b; margin-bottom: 6px; }
        .product-card__bottom { display: flex; justify-content: space-between; align-items: center; }
        .product-card__price { font-size: 1rem; font-weight: 700; color: #6F1D1B; }
        .product-card__actions { display: flex; gap: 2px; }
        .product-card__actions button, .product-card__actions a { background: none; border: none; padding: 4px 6px; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; color: #77786b; display: flex; align-items: center; justify-content: center; text-decoration: none; }
        .product-card__actions button:hover, .product-card__actions a:hover { background: rgba(159,42,43,0.06); color: #9E2A2B; }
        .product-card__actions button.edit:hover, .product-card__actions a.edit:hover { background: rgba(66,133,244,0.08); color: #4285f4; }
        .product-card__actions button.delete:hover { background: rgba(220,53,69,0.08); color: #dc3545; }
        .product-card__actions .material-symbols-outlined { font-size: 18px; }
        .empty-state { text-align: center; padding: 60px 20px; grid-column: 1 / -1; }
        .empty-state .material-symbols-outlined { font-size: 72px; color: #a0a094; }
        .empty-state h3 { font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin: 12px 0 6px; }
        .empty-state p { color: #77786b; margin-bottom: 16px; }
        .empty-state .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; background: #9E2A2B; color: #fff; }
        .empty-state .btn:hover { background: #7A1F20; transform: translateY(-2px); }
        @media (max-width: 768px) {
            .products-header { flex-direction: column; align-items: stretch; padding: 0 16px; }
            .products-header__title p { margin-right: 0; }
            .products-header__actions { flex-direction: column; }
            .products-header__actions .btn { justify-content: center; }
            .products-stats { justify-content: center; padding: 0 16px; }
            .products-filters { flex-direction: column; align-items: stretch; margin-left: 16px; margin-right: 16px; }
            .products-filters__search { width: 100%; }
            .products-filters__search input { width: 100%; }
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 0 16px; }
            .product-card__image { height: 140px; }
            .products-breadcrumb { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .products-grid { grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 12px; }
            .product-card__image { height: 120px; }
            .product-card__name { font-size: 0.8rem; }
            .product-card__price { font-size: 0.85rem; }
            .products-stats { flex-direction: column; align-items: stretch; padding: 0 12px; }
            .products-stats__item { justify-content: center; }
            .products-filters { margin-left: 12px; margin-right: 12px; }
            .products-breadcrumb { padding: 0 12px; }
            .products-header { padding: 0 12px; }
        }
        /* ===== Delete Modal ===== */
        .delete-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }
        .delete-modal.active {
            display: flex;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .delete-modal__content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 32px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .delete-modal__icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(220, 53, 69, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .delete-modal__icon .material-symbols-outlined {
            font-size: 40px;
            color: #dc3545;
        }
        .delete-modal__title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #6F1D1B;
            margin: 0 0 12px;
        }
        .delete-modal__text {
            font-size: 0.95rem;
            color: #47483c;
            margin: 0 0 24px;
            line-height: 1.6;
        }
        .delete-modal__actions {
            display: flex;
            gap: 10px;
            flex-direction: column;
        }
        .delete-modal__actions form {
            width: 100%;
        }
        .btn--confirm-delete,
        .btn--cancel-delete {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        .btn--confirm-delete {
            background: #dc3545;
            color: #fff;
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.2);
        }
        .btn--confirm-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        }
        .btn--cancel-delete {
            background: transparent;
            color: #54623A;
            border: 2px solid #54623A;
        }
        .btn--cancel-delete:hover {
            background: rgba(84, 98, 58, 0.06);
            transform: translateY(-2px);
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
                <a href="{{ route('artisan.products') }}" class="nav-desktop__link active">منتجاتي</a>
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

    <!-- ===== PRODUCTS PAGE ===== -->
    <main class="products-page">

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="products-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">منتجاتي</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="products-header">
                <div class="products-header__title">
                    <h1>
                        <span class="material-symbols-outlined">inventory_2</span>
                        منتجاتي
                    </h1>
                    <p>إدارة وعرض جميع منتجاتك</p>
                </div>
                <div class="products-header__actions">
                    <a href="{{ route('artisan.add-product') }}" class="btn btn--primary">
                        <span class="material-symbols-outlined">add</span>
                        إضافة منتج جديد
                    </a>
                </div>
            </div>

            <!-- ===== Stats ===== -->
            <div class="products-stats">
                <div class="products-stats__item">
                    <span class="number">{{ $totalProducts ?? 0 }}</span>
                    <span class="label">إجمالي المنتجات</span>
                </div>
                <div class="products-stats__item">
                    <span class="number">{{ $publishedCount ?? 0 }}</span>
                    <span class="label">منشورة</span>
                </div>
                <div class="products-stats__item">
                    <span class="number">{{ $draftCount ?? 0 }}</span>
                    <span class="label">مسودة</span>
                </div>
                <div class="products-stats__item">
                    <span class="number">{{ $soldCount ?? 0 }}</span>
                    <span class="label">مباعة</span>
                </div>
            </div>

            <!-- ===== Filters ===== -->
            <div class="products-filters">
                <div class="products-filters__group">
                    <button class="filter-btn active" data-filter="all">الكل</button>
                    <button class="filter-btn" data-filter="visible">منشور</button>
                    <button class="filter-btn" data-filter="hidden">مخفي</button>
                </div>
                <div class="products-filters__search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" id="searchInput" placeholder="بحث عن منتج..." />
                </div>
            </div>

            <!-- ===== Products Grid ===== -->
            <div class="products-grid" id="productsGrid">

                @forelse($products ?? [] as $product)
                <div class="product-card" data-name="{{ $product->name }}" data-visible="{{ $product->is_visible ? '1' : '0' }}">
                    <div class="product-card__image">
                        @php
                            $imagePath = 'assets/img/products/product1-1.jpg';
                            if ($product->images && is_array($product->images) && count($product->images) > 0) {
                                $imagePath = 'storage/' . $product->images[0];
                            }
                        @endphp
                        <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" />
                        <span class="product-card__status product-card__status--{{ $product->is_visible ? 'active' : 'draft' }}">
                            {{ $product->is_visible ? 'منشور' : 'مسودة' }}
                        </span>
                    </div>
                    <div class="product-card__body">
                        <h3 class="product-card__name">{{ $product->name }}</h3>
                        <p class="product-card__category">{{ $product->category->name ?? 'غير مصنف' }}</p>
                        <div class="product-card__bottom">
                            <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
                            <div class="product-card__actions">
                                <a href="{{ route('artisan.edit-product', $product->id) }}" class="edit" title="تعديل">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('artisan.delete-product', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete" title="حذف" onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <h3>لا توجد منتجات</h3>
                    <p>ابدأ بإضافة منتجاتك الأولى إلى المتجر</p>
                    <a href="{{ route('artisan.add-product') }}" class="btn">
                        <span class="material-symbols-outlined">add</span>
                        إضافة منتج جديد
                    </a>
                </div>
                @endforelse

            </div>

        </div>
        <!-- ===== DELETE MODAL ===== -->
        <div class="delete-modal" id="deleteModal">
            <div class="delete-modal__content">
                <div class="delete-modal__icon">
                    <span class="material-symbols-outlined">delete_forever</span>
                </div>
                <h2 class="delete-modal__title">تأكيد الحذف</h2>
                <p class="delete-modal__text">
                    هل أنت متأكد من حذف المنتج
                    <strong id="deleteProductName"></strong>؟
                    <br>
                    <span style="color:#dc3545; font-size:0.85rem;">لا يمكن التراجع عن هذا الإجراء.</span>
                </p>
                <div class="delete-modal__actions">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn--confirm-delete">
                            <span class="material-symbols-outlined">check</span>
                            نعم، احذف
                        </button>
                    </form>
                    <button type="button" class="btn btn--cancel-delete" onclick="closeDeleteModal()">
                        <span class="material-symbols-outlined">close</span>
                        إلغاء
                    </button>
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

    <script>
        // ===== Filter Buttons =====
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                document.querySelectorAll('.product-card').forEach(card => {
                    if (filter === 'all') {
                        card.style.display = '';
                    } else if (filter === 'visible') {
                        card.style.display = card.dataset.visible === '1' ? '' : 'none';
                    } else if (filter === 'hidden') {
                        card.style.display = card.dataset.visible === '0' ? '' : 'none';
                    }
                });
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
        // ===== Delete Modal Functions =====
        function openDeleteModal(productId, productName) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const nameEl = document.getElementById('deleteProductName');

            // تعيين الرابط
            form.action = `/artisan/product/${productId}`;
            nameEl.textContent = productName;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close on outside click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });

    </script>

</body>
</html>