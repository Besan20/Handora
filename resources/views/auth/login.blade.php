<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تسجيل الدخول - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="container navbar__inner">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Handora Logo" />
                <span class="logo__brand">Handora</span>
            </a>
            <div class="nav-actions">
                <div class="nav-actions__buttons">
                    <a href="{{ route('register') }}"><button class="btn btn--primary">إنشاء حساب</button></a>
                    <a href="{{ route('login') }}"><button class="btn btn--outline">تسجيل الدخول</button></a>
                </div>
                <button class="menu-toggle" aria-label="القائمة">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- ===== LOGIN PAGE CONTENT ===== -->
    <section class="login-page">
        <div class="login-container">
            <!-- Left Side - Image -->
            <div class="login-image">
                <div class="login-image-overlay"></div>
                <div class="login-image-pattern"></div>
                <img src="{{ asset('assets/img/login.jpg') }}" alt="التراث الفلسطيني" class="login-image-bg" />
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-form-wrapper">
                <div class="login-form-container">
                    <h1 class="login-title">مرحباً بعودتك</h1>
                    <p class="login-subtitle">سجل الدخول للاستمرار في استكشاف الحرف اليدوية الأصيلة</p>

                    <form class="login-form" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="login-form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <div class="login-input-wrapper {{ $errors->has('email') ? 'error' : '' }}">
                                <span class="material-symbols-outlined">email</span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" required />
                            </div>
                            @error('email')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-form-group">
                            <label for="password">كلمة المرور</label>
                            <div class="login-input-wrapper {{ $errors->has('password') ? 'error' : '' }}">
                                <span class="material-symbols-outlined">lock</span>
                                <input type="password" id="password" name="password" placeholder="••••••••" required />
                                <button type="button" class="login-password-toggle" id="passwordToggle">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-options">
                            <label class="login-checkbox">
                                <input type="checkbox" name="remember" />
                                <span>تذكرني</span>
                            </label>
                            <a href="#" class="login-forgot">نسيت كلمة المرور؟</a>
                        </div>

                        <button type="submit" class="login-submit-btn">تسجيل الدخول</button>

                        <p class="login-register">
                            ليس لديك حساب؟ <a href="{{ route('register') }}">سجل الآن</a>
                        </p>

                        <div class="login-divider">
                            <span>أو</span>
                        </div>

                        <div class="login-social">
                            <button type="button" class="login-social-btn login-social-btn--google">
                                <i class="fab fa-google"></i>
                                <span>تسجيل الدخول بـ Google</span>
                            </button>
                            <button type="button" class="login-social-btn login-social-btn--facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>تسجيل الدخول بـ Facebook</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
        const passwordToggle = document.getElementById('passwordToggle');
        if (passwordToggle) {
            passwordToggle.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('.material-symbols-outlined');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    passwordInput.type = 'password';
                    icon.textContent = 'visibility';
                }
            });
        }
    </script>
</body>
</html>