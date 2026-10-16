<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل الملف الشخصي - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .edit-profile-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .side-decorations { position: absolute; inset: 0; z-index: 0; pointer-events: none; }
        .side-deco-right { position: absolute; right: -40px; top: 25%; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center; gap: 20px; opacity: 1; }
        .side-deco-right .deco-img { width: 320px; height: auto; object-fit: contain; }
        .side-deco-right .deco-img--medium { width: 250px; height: auto; object-fit: contain; }
        .side-deco-left { position: absolute; left: -60px; top: 30%; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center; gap: 20px; opacity: 1; }
        .side-deco-left .deco-img { width: 450px; height: auto; object-fit: contain; }
        .side-deco-left .deco-img--medium { width: 320px; height: auto; object-fit: contain; }
        @media (max-width: 1400px) {
            .side-deco-right { right: -30px; }
            .side-deco-right .deco-img { width: 260px; }
            .side-deco-right .deco-img--medium { width: 200px; }
            .side-deco-left { left: -40px; }
            .side-deco-left .deco-img { width: 380px; }
            .side-deco-left .deco-img--medium { width: 280px; }
            .side-deco-right { gap: 16px; }
            .side-deco-left { gap: 16px; top: 28%; }
        }
        @media (max-width: 1200px) {
            .side-deco-right { right: -20px; }
            .side-deco-right .deco-img { width: 200px; }
            .side-deco-right .deco-img--medium { width: 150px; }
            .side-deco-left { left: -30px; }
            .side-deco-left .deco-img { width: 300px; }
            .side-deco-left .deco-img--medium { width: 220px; }
            .side-deco-right { gap: 12px; }
            .side-deco-left { gap: 12px; top: 26%; }
        }
        @media (max-width: 992px) {
            .side-deco-right { right: -10px; }
            .side-deco-right .deco-img { width: 140px; }
            .side-deco-right .deco-img--medium { width: 100px; }
            .side-deco-left { left: -20px; }
            .side-deco-left .deco-img { width: 200px; }
            .side-deco-left .deco-img--medium { width: 150px; }
            .side-deco-right { gap: 10px; }
            .side-deco-left { gap: 10px; top: 24%; }
        }
        @media (max-width: 768px) {
            .side-decorations { display: none; }
            .edit-profile-page { margin-top: 16px; padding: 12px 0 24px; }
        }
        .edit-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 1; padding: 0 20px; }
        .edit-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .edit-breadcrumb a:hover { text-decoration: underline; }
        .edit-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .edit-header { position: relative; z-index: 1; padding: 0 20px; margin-bottom: 24px; }
        .edit-header h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .edit-header h1 .material-symbols-outlined { color: #9E2A2B; }
        .edit-header p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .edit-card { position: relative; z-index: 1; background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.05); padding: 32px 36px; max-width: 820px; margin: 0 auto; transition: all 0.3s ease; }
        .edit-card:hover { box-shadow: 0 12px 48px rgba(0,0,0,0.08); }
        .edit-card__section { margin-bottom: 28px; }
        .edit-card__section:last-child { margin-bottom: 0; }
        .edit-card__section-title { font-size: 0.95rem; font-weight: 700; color: #6F1D1B; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid rgba(159,42,43,0.06); padding-bottom: 8px; }
        .edit-card__section-title .material-symbols-outlined { font-size: 22px; color: #9E2A2B; }
        .edit-card__section-desc { font-size: 0.8rem; color: #77786b; margin-bottom: 14px; }
        .form-group { margin-bottom: 16px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #1c1c16; margin-bottom: 4px; }
        .form-group label .required { color: #dc3545; }
        .form-group .hint { font-size: 0.7rem; color: #a0a094; margin-top: 4px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid rgba(200,199,184,0.2); border-radius: 12px; font-family: 'Tajawal', sans-serif; font-size: 0.95rem; color: #1c1c16; background: rgba(247,243,233,0.5); transition: all 0.3s ease; outline: none; }
        .form-control:focus { border-color: #D4AF37; background: rgba(255,255,255,0.9); box-shadow: 0 0 0 4px rgba(212,175,55,0.08); }
        .form-control::placeholder { color: #a0a094; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .product-toggle-list { display: flex; flex-direction: column; gap: 10px; }
        .product-toggle-item { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: rgba(247,243,233,0.4); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(200,199,184,0.06); }
        .product-toggle-item:hover { background: rgba(247,243,233,0.7); }
        .product-toggle-item__info { display: flex; align-items: center; gap: 12px; }
        .product-toggle-item__image { width: 48px; height: 48px; border-radius: 8px; overflow: hidden; flex-shrink: 0; background: #f7f3e9; }
        .product-toggle-item__image img { width: 100%; height: 100%; object-fit: cover; }
        .product-toggle-item__name { font-size: 0.9rem; font-weight: 600; color: #1c1c16; }
        .product-toggle-item__price { font-size: 0.85rem; font-weight: 700; color: #6F1D1B; }
        .product-toggle-item__status { font-size: 0.6rem; font-weight: 700; padding: 2px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em; }
        .product-toggle-item__status--visible { background: rgba(84,98,58,0.12); color: #54623A; }
        .product-toggle-item__status--hidden { background: rgba(200,199,184,0.15); color: #77786b; }
        .toggle-switch { position: relative; width: 44px; height: 24px; flex-shrink: 0; cursor: pointer; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-switch .slider { position: absolute; inset: 0; background: #ccc; border-radius: 9999px; transition: all 0.3s ease; }
        .toggle-switch .slider::before { content: ''; position: absolute; width: 18px; height: 18px; left: 3px; bottom: 3px; background: #fff; border-radius: 50%; transition: all 0.3s ease; }
        .toggle-switch input:checked + .slider { background: #9E2A2B; }
        .toggle-switch input:checked + .slider::before { transform: translateX(20px); }
        .form-actions { display: flex; gap: 12px; margin-top: 28px; padding-top: 20px; border-top: 1px solid rgba(200,199,184,0.12); }
        .form-actions .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        .empty-products { text-align: center; padding: 30px 20px; color: #77786b; }
        @media (max-width: 768px) {
            .edit-header { padding: 0 16px; }
            .edit-header p { margin-right: 0; }
            .edit-card { padding: 20px; border-radius: 16px; }
            .form-actions { flex-direction: column; }
            .form-actions .btn { justify-content: center; }
            .edit-breadcrumb { padding: 0 16px; }
            .product-toggle-item { flex-wrap: wrap; gap: 8px; }
            .product-toggle-item__info { flex: 1; min-width: 0; }
            .product-toggle-item__image { width: 40px; height: 40px; }
        }
        @media (max-width: 480px) {
            .edit-card { padding: 16px; border-radius: 14px; }
            .form-control { font-size: 0.85rem; padding: 10px 12px; }
            .edit-header h1 { font-size: 1.4rem; }
            .form-actions .btn { font-size: 13px; padding: 10px 20px; }
            .product-toggle-item__name { font-size: 0.8rem; }
            .product-toggle-item__price { font-size: 0.75rem; }
            .product-toggle-item__image { width: 36px; height: 36px; }
            .edit-breadcrumb { padding: 0 12px; }
            .edit-header { padding: 0 12px; }
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

    <!-- ===== EDIT PROFILE PAGE ===== -->
    <main class="edit-profile-page">

        <!-- ===== SIDE DECORATIONS ===== -->
        <div class="side-decorations">
            <div class="side-deco-right">
                <img src="{{ asset('assets/img/sid/2.png') }}" alt="تطريز" class="deco-img" />
                <img src="{{ asset('assets/img/sid/2.png') }}" alt="تطريز" class="deco-img deco-img--medium" />
            </div>
            <div class="side-deco-left">
                <img src="{{ asset('assets/img/sid/1.png') }}" alt="تطريز" class="deco-img" />
                <img src="{{ asset('assets/img/sid/1.png') }}" alt="تطريز" class="deco-img deco-img--medium" />
            </div>
        </div>

        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="edit-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">تعديل الملف الشخصي</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="edit-header">
                <h1>
                    <span class="material-symbols-outlined">edit</span>
                    تعديل الملف الشخصي
                </h1>
                <p>عدل معلوماتك الشخصية واختر المنتجات التي تظهر في متجرك</p>
            </div>

            <!-- ===== Form ===== -->
            <div class="edit-card">
                <form id="editProfileForm" action="{{ route('artisan.update-profile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ===== Personal Information ===== -->
                    <div class="edit-card__section">
                        <div class="edit-card__section-title">
                            <span class="material-symbols-outlined">person</span>
                            المعلومات الشخصية
                        </div>

                        <div class="form-group">
                            <label for="artisanName">الاسم <span class="required">*</span></label>
                            <input type="text" id="artisanName" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required />
                            @error('name')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="artisanBio">الوصف التعريفي</label>
                            <textarea id="artisanBio" name="bio" class="form-control" rows="4">{{ old('bio', auth()->user()->bio) }}</textarea>
                            <div class="hint">هذا النص سيظهر للعملاء في متجرك</div>
                        </div>

                        <div class="form-group">
                            <label for="artisanSpecialty">التخصص</label>
                            <input type="text" id="artisanSpecialty" name="specialty" class="form-control" value="{{ old('specialty', auth()->user()->specialty) }}" placeholder="مثال: تطريز فلسطيني، خزف..." />
                        </div>

                        <div class="form-group">
                            <label for="artisanPhone">رقم الهاتف</label>
                            <input type="text" id="artisanPhone" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+970 599 123 456" />
                        </div>

                        <div class="form-group">
                            <label for="artisanAddress">العنوان</label>
                            <input type="text" id="artisanAddress" name="address" class="form-control" value="{{ old('address', auth()->user()->address) }}" placeholder="فلسطين، رام الله" />
                        </div>
                    </div>

                    <!-- ===== Product Visibility ===== -->
                    <div class="edit-card__section">
                        <div class="edit-card__section-title">
                            <span class="material-symbols-outlined">visibility</span>
                            إظهار / إخفاء المنتجات
                        </div>
                        <div class="edit-card__section-desc">
                            اختر المنتجات التي تريد ظهورها في متجرك
                        </div>

                        <div class="product-toggle-list">
                            @forelse($products ?? [] as $product)
                            <div class="product-toggle-item">
                                <div class="product-toggle-item__info">
                                    <div class="product-toggle-item__image">
                                        @php
                                            $imagePath = 'assets/img/products/product1-1.jpg';
                                            if ($product->images && is_array($product->images) && count($product->images) > 0) {
                                                $imagePath = 'storage/' . $product->images[0];
                                            }
                                        @endphp
                                        <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" />
                                    </div>
                                    <div>
                                        <div class="product-toggle-item__name">{{ $product->name }}</div>
                                        <div class="product-toggle-item__price">${{ number_format($product->price, 2) }}</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <span class="product-toggle-item__status product-toggle-item__status--{{ $product->is_visible ? 'visible' : 'hidden' }}">
                                        {{ $product->is_visible ? 'مرئي' : 'مخفي' }}
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" 
                                               class="product-visibility-toggle" 
                                               data-product-id="{{ $product->id }}"
                                               {{ $product->is_visible ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            @empty
                            <div class="empty-products">
                                <p>لا توجد منتجات حالياً</p>
                                <a href="{{ route('artisan.add-product') }}" style="color:#9E2A2B; font-weight:600; text-decoration:none;">
                                    + إضافة منتج جديد
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- ===== Form Actions ===== -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary">
                            <span class="material-symbols-outlined">check</span>
                            حفظ التغييرات
                        </button>
                        <a href="{{ route('artisan.home') }}" class="btn btn--outline">
                            <span class="material-symbols-outlined">close</span>
                            إلغاء
                        </a>
                        <a href="{{ route('artisan.shop-preview') }}" class="btn btn--outline" style="margin-right: auto;">
                            <span class="material-symbols-outlined">visibility</span>
                            معاينة المتجر
                        </a>
                    </div>

                </form>
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
        document.addEventListener('DOMContentLoaded', function() {

            // ===== Toggle Product Visibility =====
            document.querySelectorAll('.product-visibility-toggle').forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const item = this.closest('.product-toggle-item');
                    const statusBadge = item.querySelector('.product-toggle-item__status');
                    const productId = this.dataset.productId;
                    const isVisible = this.checked;

                    // تحديث الـ Badge
                    if (isVisible) {
                        statusBadge.textContent = 'مرئي';
                        statusBadge.className = 'product-toggle-item__status product-toggle-item__status--visible';
                    } else {
                        statusBadge.textContent = 'مخفي';
                        statusBadge.className = 'product-toggle-item__status product-toggle-item__status--hidden';
                    }

                    // إرسال طلب AJAX لتحديث الحالة
                    fetch(`/artisan/product/${productId}/toggle`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('✅ تم تحديث حالة المنتج');
                        }
                    })
                    .catch(error => {
                        console.error('❌ خطأ:', error);
                        // إرجاع التبديل في حالة الخطأ
                        this.checked = !isVisible;
                    });
                });
            });

            // ===== Form Submit (مع AJAX اختياري) =====
            const form = document.getElementById('editProfileForm');
            form.addEventListener('submit', function(e) {
                const name = document.getElementById('artisanName').value.trim();
                if (!name) {
                    e.preventDefault();
                    alert('الرجاء إدخال الاسم');
                    return;
                }
                // النموذج يُرسل عادةً عبر POST
            });

        });
    </script>

</body>
</html>