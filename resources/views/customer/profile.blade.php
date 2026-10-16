<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ملفي الشخصي - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .profile-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
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
            .profile-page { margin-top: 16px; padding: 12px 0 24px; }
        }
        .profile-page .container { position: relative; z-index: 1; padding-left: 120px; padding-right: 120px; }
        @media (max-width: 1400px) {
            .profile-page .container { padding-left: 100px; padding-right: 100px; }
        }
        @media (max-width: 1200px) {
            .profile-page .container { padding-left: 80px; padding-right: 80px; }
        }
        @media (max-width: 992px) {
            .profile-page .container { padding-left: 60px; padding-right: 60px; }
        }
        @media (max-width: 768px) {
            .profile-page .container { padding-left: 20px; padding-right: 20px; }
        }
        .profile-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; position: relative; z-index: 2; padding: 0; }
        .profile-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .profile-breadcrumb a:hover { text-decoration: underline; }
        .profile-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .profile-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 2; padding: 0; }
        .profile-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .profile-header__title h1 .material-symbols-outlined { color: #9E2A2B; }
        .profile-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 40px; margin-top: 4px; }
        .profile-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.05); padding: 32px; max-width: 600px; margin: 0 auto; position: relative; z-index: 2; transition: all 0.3s ease; }
        .profile-card:hover { box-shadow: 0 12px 48px rgba(0,0,0,0.08); }
        .profile-card__avatar { width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #9E2A2B, #6F1D1B); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2.8rem; font-weight: 800; margin: 0 auto 16px; border: 3px solid #D4AF37; box-shadow: 0 4px 20px rgba(159,42,43,0.15); }
        .profile-card__name { text-align: center; font-size: 1.4rem; font-weight: 800; color: #6F1D1B; margin-bottom: 4px; }
        .profile-card__role { text-align: center; font-size: 0.9rem; color: #77786b; margin-bottom: 20px; }
        .profile-card__divider { height: 1px; background: rgba(200,199,184,0.15); margin: 16px 0; }
        .profile-card__field { display: flex; align-items: center; gap: 12px; padding: 10px 0; }
        .profile-card__field .material-symbols-outlined { font-size: 24px; color: #9E2A2B; width: 32px; }
        .profile-card__field .label { font-size: 0.75rem; font-weight: 600; color: #77786b; text-transform: uppercase; letter-spacing: 0.04em; min-width: 80px; }
        .profile-card__field .value { font-size: 0.95rem; font-weight: 600; color: #1c1c16; }
        .profile-card__actions { display: flex; gap: 12px; margin-top: 20px; }
        .profile-card__actions .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; flex: 1; justify-content: center; }
        .btn--edit { background: #9E2A2B; color: #ffffff; box-shadow: 0 4px 16px rgba(159,42,43,0.2); }
        .btn--edit:hover { background: #7A1F20; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(159,42,43,0.25); }
        .btn--orders { background: transparent; color: #54623A; border: 2px solid #54623A; }
        .btn--orders:hover { background: rgba(84,98,58,0.06); transform: translateY(-2px); }
        .alert-success { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; text-align: center; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; text-align: center; }
        @media (max-width: 768px) {
            .profile-page { margin-top: 16px; padding: 12px 0 24px; }
            .profile-page .container { padding-left: 20px !important; padding-right: 20px !important; }
            .profile-header { padding: 0; flex-direction: column; align-items: stretch; }
            .profile-header__title p { margin-right: 0; }
            .profile-card { padding: 24px; margin: 0; border-radius: 16px; }
            .profile-card__field { flex-wrap: wrap; }
            .profile-card__field .label { min-width: 60px; }
            .profile-card__actions { flex-direction: column; }
            .profile-breadcrumb { padding: 0; }
        }
        @media (max-width: 480px) {
            .profile-card { padding: 16px; margin: 0; }
            .profile-card__avatar { width: 80px; height: 80px; font-size: 2rem; }
            .profile-card__name { font-size: 1.2rem; }
            .profile-card__field .value { font-size: 0.85rem; }
            .profile-header__title h1 { font-size: 1.4rem; }
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
                <a href="{{ route('customer.profile') }}" class="nav-desktop__link active">ملفي</a>
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

    <!-- ===== PROFILE PAGE ===== -->
    <main class="profile-page">

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
            <div class="profile-breadcrumb">
                <a href="{{ route('customer.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">ملفي الشخصي</span>
            </div>

            <!-- ===== Flash Messages ===== -->
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <!-- ===== Header ===== -->
            <div class="profile-header">
                <div class="profile-header__title">
                    <h1>
                        <span class="material-symbols-outlined">account_circle</span>
                        ملفي الشخصي
                    </h1>
                    <p>عرض وتعديل بياناتك الشخصية</p>
                </div>
            </div>

            <!-- ===== Profile Card ===== -->
            <div class="profile-card">
                <div class="profile-card__avatar">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                </div>
                <h2 class="profile-card__name">{{ auth()->user()->name }}</h2>
                <p class="profile-card__role">عميل منذ {{ auth()->user()->created_at->format('Y') }}</p>

                <div class="profile-card__divider"></div>

                <div class="profile-card__field">
                    <span class="material-symbols-outlined">email</span>
                    <span class="label">البريد الإلكتروني</span>
                    <span class="value">{{ auth()->user()->email }}</span>
                </div>

                <div class="profile-card__field">
                    <span class="material-symbols-outlined">phone</span>
                    <span class="label">رقم الهاتف</span>
                    <span class="value">{{ auth()->user()->phone ?? 'غير مضاف' }}</span>
                </div>

                <div class="profile-card__field">
                    <span class="material-symbols-outlined">location_on</span>
                    <span class="label">العنوان</span>
                    <span class="value">{{ auth()->user()->address ?? 'غير مضاف' }}</span>
                </div>

                <div class="profile-card__divider"></div>

                <div class="profile-card__actions">
                    <a href="#" class="btn btn--edit" onclick="openEditModal(event)">
                        <span class="material-symbols-outlined">edit</span>
                        تعديل الملف
                    </a>
                    <a href="{{ route('customer.orders') }}" class="btn btn--orders">
                        <span class="material-symbols-outlined">receipt_long</span>
                        طلباتي
                    </a>
                </div>
            </div>

        </div>

    </main>

    <!-- ===== EDIT MODAL ===== -->
    <div id="editModal" style="display:none; position:fixed; inset:0; z-index:1000; background:rgba(0,0,0,0.4); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:20px;">
        <div style="background:rgba(255,255,255,0.95); backdrop-filter:blur(16px); border-radius:24px; border:1px solid rgba(255,255,255,0.5); box-shadow:0 30px 80px rgba(0,0,0,0.2); padding:32px; max-width:500px; width:100%; max-height:90vh; overflow-y:auto;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h2 style="font-size:1.4rem; font-weight:800; color:#6F1D1B; margin:0; display:flex; align-items:center; gap:8px;">
                    <span class="material-symbols-outlined" style="color:#9E2A2B;">edit</span>
                    تعديل الملف
                </h2>
                <button type="button" onclick="closeEditModal()" style="background:none; border:none; color:#77786b; cursor:pointer; padding:4px;">
                    <span class="material-symbols-outlined" style="font-size:28px;">close</span>
                </button>
            </div>

            <form action="{{ route('customer.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.85rem; font-weight:600; color:#1c1c16; margin-bottom:4px;">الاسم الكامل</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" required style="width:100%; padding:10px 14px; border:1.5px solid rgba(200,199,184,0.2); border-radius:10px; background:rgba(247,243,233,0.3); font-family:'Tajawal', sans-serif; font-size:0.9rem; color:#1c1c16; outline:none;" />
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.85rem; font-weight:600; color:#1c1c16; margin-bottom:4px;">رقم الهاتف</label>
                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="+970 599 123 456" style="width:100%; padding:10px 14px; border:1.5px solid rgba(200,199,184,0.2); border-radius:10px; background:rgba(247,243,233,0.3); font-family:'Tajawal', sans-serif; font-size:0.9rem; color:#1c1c16; outline:none;" />
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.85rem; font-weight:600; color:#1c1c16; margin-bottom:4px;">العنوان</label>
                    <input type="text" name="address" value="{{ auth()->user()->address }}" placeholder="فلسطين، رام الله" style="width:100%; padding:10px 14px; border:1.5px solid rgba(200,199,184,0.2); border-radius:10px; background:rgba(247,243,233,0.3); font-family:'Tajawal', sans-serif; font-size:0.9rem; color:#1c1c16; outline:none;" />
                </div>

                <div style="display:flex; gap:10px; margin-top:20px; padding-top:16px; border-top:1px solid rgba(200,199,184,0.1);">
                    <button type="submit" style="flex:1; padding:10px 24px; border-radius:12px; font-weight:700; font-size:14px; border:none; cursor:pointer; background:#9E2A2B; color:#fff;">
                        حفظ التغييرات
                    </button>
                    <button type="button" onclick="closeEditModal()" style="flex:1; padding:10px 24px; border-radius:12px; font-weight:700; font-size:14px; border:2px solid #54623A; background:transparent; color:#54623A; cursor:pointer;">
                        إلغاء
                    </button>
                </div>
            </form>
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
        function openEditModal(e) {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        // Close on outside click
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeEditModal();
        });
    </script>

</body>
</html>