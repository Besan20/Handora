<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء حساب - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem;
            overflow: hidden;
        }
        .register-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
        .register-bg-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }
        .register-bg-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.30);
            z-index: 1;
        }
        .register-bg-pattern {
            position: absolute;
            inset: 0;
            z-index: 2;
            background-image: 
                repeating-linear-gradient(45deg, rgba(255,255,255,0.04) 0px, rgba(255,255,255,0.04) 2px, transparent 2px, transparent 8px),
                repeating-linear-gradient(-45deg, rgba(255,255,255,0.04) 0px, rgba(255,255,255,0.04) 2px, transparent 2px, transparent 8px);
            background-size: 20px 20px;
            pointer-events: none;
        }
        .register-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
        }
        .register-form-wrapper {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 2.5rem 2.8rem;
        }
        .register-title {
            font-size: 30px;
            font-weight: 900;
            color: #6F1D1B;
            margin-bottom: 0.25rem;
            text-align: center;
        }
        .register-subtitle {
            font-size: 15px;
            font-weight: 500;
            color: #47483c;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .register-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .register-form-group {
            margin-bottom: 0.5rem;
        }
        .register-form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #1c1c16;
            display: block;
            margin-bottom: 4px;
        }
        .register-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(245, 245, 240, 0.6);
            border: 1.5px solid rgba(200, 199, 184, 0.3);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .register-input-wrapper:focus-within {
            border-color: #D4AF37;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.12);
        }
        .register-input-wrapper .material-symbols-outlined {
            padding: 0 0.5rem 0 0;
            color: #77786b;
            font-size: 18px;
            user-select: none;
        }
        .register-input-wrapper input {
            flex: 1;
            padding: 0.65rem 0.5rem 0.65rem 0;
            border: none;
            background: transparent;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            color: #1c1c16;
            outline: none;
            width: 100%;
        }
        .register-input-wrapper input::placeholder {
            color: #a0a094;
            font-size: 13px;
        }
        .register-input-wrapper.error {
            border-color: #dc3545;
            background: rgba(220, 53, 69, 0.05);
        }
        .register-input-wrapper.error:focus-within {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.12);
        }
        .register-input-wrapper .error-icon {
            color: #dc3545;
            font-size: 18px;
            padding: 0 0.5rem;
            display: none;
        }
        .register-input-wrapper.error .error-icon {
            display: block;
        }
        .field-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        .register-password-toggle {
            background: none;
            border: none;
            padding: 0 0.5rem;
            cursor: pointer;
            color: #77786b;
            transition: color 0.3s;
        }
        .register-password-toggle:hover {
            color: #D4AF37;
        }
        .register-password-toggle .material-symbols-outlined {
            font-size: 18px;
        }
        .register-role-section {
            margin: 0.5rem 0;
        }
        .register-role-label {
            font-size: 13px;
            font-weight: 600;
            color: #1c1c16;
            display: block;
            margin-bottom: 0.5rem;
        }
        .register-role-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .register-role-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.85rem 0.5rem;
            border: 2px solid rgba(200, 199, 184, 0.25);
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            background: rgba(245, 245, 240, 0.3);
        }
        .register-role-card:hover {
            border-color: rgba(200, 199, 184, 0.5);
            transform: translateY(-2px);
        }
        .register-role-card input[type="radio"] {
            display: none;
        }
        .register-role-card.active {
            border-color: #D4AF37 !important;
            background: rgba(212, 175, 55, 0.10) !important;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.06);
            transform: scale(1.02);
        }
        .register-role-card.active .register-role-icon {
            background: rgba(212, 175, 55, 0.15);
            border-color: #D4AF37;
        }
        .register-role-card.active .register-role-name {
            color: #D4AF37;
        }
        .register-role-icon {
            width: 44px;
            height: 44px;
            border-radius: 9999px;
            background: rgba(200, 199, 184, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.3rem;
            border: 2px solid rgba(200, 199, 184, 0.15);
            transition: all 0.3s ease;
        }
        .register-role-icon .material-symbols-outlined {
            font-size: 22px;
            color: #77786b;
            transition: color 0.3s ease;
        }
        .register-role-card.active .register-role-icon .material-symbols-outlined {
            color: #D4AF37;
        }
        .register-role-name {
            font-size: 14px;
            font-weight: 600;
            color: #1c1c16;
            transition: color 0.3s ease;
        }
        .register-role-desc {
            font-size: 10px;
            font-weight: 400;
            color: #77786b;
            margin-top: 0.1rem;
        }
        .register-terms {
            margin: 0.5rem 0;
        }
        .register-checkbox {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 13px;
            font-weight: 500;
            color: #47483c;
            cursor: pointer;
        }
        .register-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #D4AF37;
            cursor: pointer;
            flex-shrink: 0;
        }
        .register-checkbox a {
            color: #6F1D1B;
            font-weight: 600;
        }
        .register-submit-btn {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #9E2A2B, #7A1F20);
            color: #ffffff;
            font-family: 'Tajawal', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 20px rgba(159, 42, 43, 0.2);
        }
        .register-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(159, 42, 43, 0.3);
        }
        .register-login {
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            color: #47483c;
            margin-top: 0.5rem;
        }
        .register-login a {
            color: #6F1D1B;
            font-weight: 700;
            text-decoration: none;
        }
        .register-login a:hover {
            text-decoration: underline;
        }
        .register-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0.5rem 0;
        }
        .register-divider::before,
        .register-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(200, 199, 184, 0.3);
        }
        .register-divider span {
            font-size: 13px;
            font-weight: 500;
            color: #a0a094;
            padding: 0 0.5rem;
        }
        .register-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }
        .register-social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            border: 1px solid rgba(200, 199, 184, 0.3);
            background: rgba(245, 245, 240, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 22px;
        }
        .register-social-btn:hover {
            transform: translateY(-3px) scale(1.05);
            border-color: rgba(200, 199, 184, 0.5);
        }
        .register-social-btn--google { color: #EA4335; }
        .register-social-btn--facebook { color: #1877F2; }
        .register-social-btn i { font-size: 22px; }
        .register-social-btn:hover { background: rgba(245, 245, 240, 0.8); }

        @media (max-width: 768px) {
            .register-row { grid-template-columns: 1fr; gap: 0.5rem; }
            .register-form-wrapper { padding: 1.5rem; }
            .register-role-options { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .register-form-wrapper { padding: 1rem; border-radius: 16px; }
            .register-title { font-size: 22px; }
            .register-role-options { grid-template-columns: 1fr; }
        }
    </style>
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

    <!-- ===== REGISTER PAGE ===== -->
    <section class="register-page">
        <div class="register-bg">
            <img src="{{ asset('assets/img/register.jpg') }}" alt="التراث الفلسطيني" class="register-bg-image" />
            <div class="register-bg-overlay"></div>
            <div class="register-bg-pattern"></div>
        </div>

        <div class="register-container">
            <div class="register-form-wrapper">
                <div class="register-form-container">
                    <h1 class="register-title">انضم إلينا</h1>
                    <p class="register-subtitle">اختر هويتك وابدأ رحلتك مع الحرف اليدوية</p>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- ===== الاسم ===== -->
                        <div class="register-row">
                            <div class="register-form-group">
                                <label for="name">الاسم الكامل <span style="color:#dc3545;">*</span></label>
                                <div class="register-input-wrapper {{ $errors->has('name') ? 'error' : '' }}">
                                    <span class="material-symbols-outlined">person</span>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="أحمد محمد" />
                                    <span class="error-icon material-symbols-outlined">error</span>
                                </div>
                                @error('name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ===== البريد الإلكتروني ===== -->
                            <div class="register-form-group">
                                <label for="email">البريد الإلكتروني <span style="color:#dc3545;">*</span></label>
                                <div class="register-input-wrapper {{ $errors->has('email') ? 'error' : '' }}">
                                    <span class="material-symbols-outlined">email</span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" />
                                    <span class="error-icon material-symbols-outlined">error</span>
                                </div>
                                @error('email')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- ===== كلمة المرور ===== -->
                        <div class="register-row">
                            <div class="register-form-group">
                                <label for="password">كلمة المرور <span style="color:#dc3545;">*</span></label>
                                <div class="register-input-wrapper {{ $errors->has('password') ? 'error' : '' }}">
                                    <span class="material-symbols-outlined">lock</span>
                                    <input type="password" id="password" name="password" placeholder="••••••••" />
                                    <button type="button" class="register-password-toggle" id="passwordToggle">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <span class="error-icon material-symbols-outlined">error</span>
                                </div>
                                @error('password')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ===== تأكيد كلمة المرور ===== -->
                            <div class="register-form-group">
                                <label for="password_confirmation">تأكيد كلمة المرور <span style="color:#dc3545;">*</span></label>
                                <div class="register-input-wrapper {{ $errors->has('password') ? 'error' : '' }}">
                                    <span class="material-symbols-outlined">lock</span>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" />
                                    <span class="error-icon material-symbols-outlined">error</span>
                                </div>
                            </div>
                        </div>

                        <!-- ===== نوع الحساب ===== -->
                        <div class="register-role-section">
                            <label class="register-role-label">نوع الحساب <span style="color:#dc3545;">*</span></label>
                            <div class="register-role-options">
                                <label class="register-role-card {{ old('role') === 'artisan' || !old('role') ? 'active' : '' }}">
                                    <input type="radio" name="role" value="artisan" {{ old('role') === 'artisan' || !old('role') ? 'checked' : '' }} />
                                    <span class="register-role-icon">
                                        <span class="material-symbols-outlined">brush</span>
                                    </span>
                                    <span class="register-role-name">حرفي</span>
                                    <span class="register-role-desc">أمارس الحرف اليدوية وأعرض منتجاتي</span>
                                </label>
                                <label class="register-role-card {{ old('role') === 'customer' ? 'active' : '' }}">
                                    <input type="radio" name="role" value="customer" {{ old('role') === 'customer' ? 'checked' : '' }} />
                                    <span class="register-role-icon">
                                        <span class="material-symbols-outlined">shopping_bag</span>
                                    </span>
                                    <span class="register-role-name">زبون</span>
                                    <span class="register-role-desc">أبحث عن قطع فريدة وأشتريها</span>
                                </label>
                            </div>
                            @error('role')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ===== حقول إضافية للحرفي (اختيارية) ===== -->
                        <div id="artisanFields" style="display: {{ old('role') === 'artisan' || !old('role') ? 'block' : 'none' }};">
                            <div class="register-row">
                                <div class="register-form-group">
                                    <label for="specialty">التخصص <span style="color:#77786b; font-weight:400;">(اختياري)</span></label>
                                    <div class="register-input-wrapper">
                                        <span class="material-symbols-outlined">work</span>
                                        <input type="text" id="specialty" name="specialty" value="{{ old('specialty') }}" placeholder="مثال: خياطة، تطريز، خشب..." />
                                    </div>
                                </div>
                                <div class="register-form-group">
                                    <label for="bio">نبذة عنك <span style="color:#77786b; font-weight:400;">(اختياري)</span></label>
                                    <div class="register-input-wrapper">
                                        <span class="material-symbols-outlined">description</span>
                                        <input type="text" id="bio" name="bio" value="{{ old('bio') }}" placeholder="مهاراتك وخبراتك..." />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== رقم الهاتف + العنوان ===== -->
                        <div class="register-row">
                            <div class="register-form-group">
                                <label for="phone">رقم الهاتف <span style="color:#77786b; font-weight:400;">(اختياري)</span></label>
                                <div class="register-input-wrapper">
                                    <span class="material-symbols-outlined">phone</span>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+970 599 123 456" />
                                </div>
                            </div>
                            <div class="register-form-group">
                                <label for="address">العنوان <span style="color:#77786b; font-weight:400;">(اختياري)</span></label>
                                <div class="register-input-wrapper">
                                    <span class="material-symbols-outlined">location_on</span>
                                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="فلسطين، رام الله" />
                                </div>
                            </div>
                        </div>

                        <!-- ===== الموافقة على الشروط ===== -->
                        <div class="register-terms">
                            <label class="register-checkbox">
                                <input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }} />
                                <span>أوافق على <a href="#">الشروط والأحكام</a> و <a href="#">سياسة الخصوصية</a> <span style="color:#dc3545;">*</span></span>
                            </label>
                            @error('terms')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="register-submit-btn">إنشاء الحساب</button>

                        <p class="register-login">
                            لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
                        </p>

                        <div class="register-divider">
                            <span>أو</span>
                        </div>

                        <div class="register-social">
                            <button type="button" class="register-social-btn register-social-btn--google">
                                <i class="fab fa-google"></i>
                            </button>
                            <button type="button" class="register-social-btn register-social-btn--facebook">
                                <i class="fab fa-facebook-f"></i>
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
        // ===== Role Selection Styling =====
        document.querySelectorAll('.register-role-card').forEach(function(card) {
            card.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                }
                document.querySelectorAll('.register-role-card').forEach(function(opt) {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // ===== Toggle Artisan Fields =====
        document.querySelectorAll('input[name="role"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const artisanFields = document.getElementById('artisanFields');
                if (this.value === 'artisan') {
                    artisanFields.style.display = 'block';
                } else {
                    artisanFields.style.display = 'none';
                }
            });
        });

        // ===== Password Toggle =====
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