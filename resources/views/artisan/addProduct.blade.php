<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إضافة منتج جديد - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    
    <style>
        .add-product-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; position: relative; overflow: hidden; }
        .side-decorations { position: absolute; inset: 0; z-index: 0; pointer-events: none; }
        .side-deco-right { position: absolute; right: -40px; top: 25%; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center; gap: 20px; opacity: 1; }
        .side-deco-right .deco-img { width: 320px; height: auto; object-fit: contain; }
        .side-deco-right .deco-img--medium { width: 250px; }
        .side-deco-left { position: absolute; left: -60px; top: 30%; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center; gap: 20px; opacity: 1; }
        .side-deco-left .deco-img { width: 450px; height: auto; object-fit: contain; }
        .side-deco-left .deco-img--medium { width: 320px; }
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
            .add-product-page { margin-top: 16px; padding: 12px 0 24px; }
        }
        .add-product-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 12px; position: relative; z-index: 1; padding: 0 20px; }
        .add-product-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .add-product-breadcrumb a:hover { text-decoration: underline; }
        .add-product-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .add-product-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; position: relative; z-index: 1; padding: 0 120px; }
        .add-product-header__title h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .add-product-header__title h1 .material-symbols-outlined { color: #9E2A2B; font-size: 2.2rem; }
        .add-product-header__title p { color: #47483c; margin: 0; font-size: 0.95rem; margin-right: 45px; margin-top: 4px; }
        .form-card { position: relative; z-index: 1; background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.6); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: 36px 40px; max-width: 820px; margin: 0 auto; transition: all 0.3s ease; }
        .form-card:hover { box-shadow: 0 12px 48px rgba(0,0,0,0.08); }
        .form-card__section { margin-bottom: 28px; }
        .form-card__section:last-child { margin-bottom: 0; }
        .form-card__section-title { font-size: 0.95rem; font-weight: 700; color: #6F1D1B; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid rgba(159,42,43,0.06); padding-bottom: 8px; }
        .form-card__section-title .material-symbols-outlined { font-size: 22px; color: #9E2A2B; }
        .form-card__section-desc { font-size: 0.8rem; color: #77786b; margin-bottom: 14px; }
        .form-group { margin-bottom: 16px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #1c1c16; margin-bottom: 4px; }
        .form-group label .required { color: #dc3545; }
        .form-group .hint { font-size: 0.7rem; color: #a0a094; margin-top: 4px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid rgba(200,199,184,0.2); border-radius: 12px; font-family: 'Tajawal', sans-serif; font-size: 0.95rem; color: #1c1c16; background: rgba(247,243,233,0.5); transition: all 0.3s ease; outline: none; }
        .form-control:focus { border-color: #D4AF37; background: rgba(255,255,255,0.9); box-shadow: 0 0 0 4px rgba(212,175,55,0.08); }
        .form-control::placeholder { color: #a0a094; }
        textarea.form-control { resize: vertical; min-height: 120px; }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2377786b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: left 14px center; padding-left: 36px; cursor: pointer; }
        .image-upload-area { border: 2px dashed rgba(200,199,184,0.25); border-radius: 14px; padding: 32px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: rgba(247,243,233,0.3); }
        .image-upload-area:hover { border-color: #D4AF37; background: rgba(212,175,55,0.03); }
        .image-upload-area .material-symbols-outlined { font-size: 48px; color: #a0a094; }
        .image-upload-area h4 { font-size: 1rem; color: #1c1c16; margin: 8px 0 4px; }
        .image-upload-area p { font-size: 0.8rem; color: #77786b; }
        .image-preview { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px,1fr)); gap: 10px; margin-top: 12px; }
        .image-preview__item { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 1; border: 1px solid rgba(200,199,184,0.15); }
        .image-preview__item img { width: 100%; height: 100%; object-fit: cover; }
        .image-preview__item .remove-btn { position: absolute; top: 4px; right: 4px; width: 24px; height: 24px; border-radius: 50%; border: none; background: rgba(220,53,69,0.85); color: #fff; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; }
        .image-preview__item .remove-btn:hover { background: #dc3545; }
        .new-category-field { display: none; margin-top: 10px; }
        .new-category-field.active { display: block; }
        .new-category-field .form-control { border-color: #D4AF37; }
        .form-actions { display: flex; gap: 12px; margin-top: 28px; padding-top: 20px; border-top: 1px solid rgba(200,199,184,0.12); }
        .form-actions .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        @media (max-width: 768px) {
            .add-product-header { padding: 0 20px; }
            .add-product-header__title p { margin-right: 0; }
            .form-card { padding: 24px 20px; border-radius: 16px; }
            .form-actions { flex-direction: column; }
            .form-actions .btn { justify-content: center; }
            .add-product-breadcrumb { padding: 0; }
        }
        @media (max-width: 480px) {
            .form-card { padding: 16px; border-radius: 14px; }
            .form-control { font-size: 0.85rem; padding: 10px 12px; }
            .add-product-header__title h1 { font-size: 1.4rem; }
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

    <!-- ===== ADD PRODUCT PAGE ===== -->
    <main class="add-product-page">

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
            <div class="add-product-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <a href="{{ route('artisan.products') }}">منتجاتي</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">إضافة منتج جديد</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="add-product-header">
                <div class="add-product-header__title">
                    <h1>
                        <span class="material-symbols-outlined">add_box</span>
                        إضافة منتج جديد
                    </h1>
                    <p>أضف منتجاً جديداً إلى متجرك وشاركه مع العالم</p>
                </div>
            </div>

            <!-- ===== Form ===== -->
            <div class="form-card">
                <form action="{{ route('artisan.store-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- ===== Basic Information ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">info</span>
                            المعلومات الأساسية
                        </div>

                        <div class="form-group">
                            <label for="productName">اسم المنتج <span class="required">*</span></label>
                            <input type="text" id="productName" name="name" class="form-control" value="{{ old('name') }}" placeholder="مثال: طقم تطريز فلسطيني تقليدي" required />
                            @error('name')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="productDescription">وصف المنتج <span class="required">*</span></label>
                            <textarea id="productDescription" name="description" class="form-control" placeholder="وصف تفصيلي للمنتج، المواد المستخدمة، الأبعاد، القصة..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label for="productPrice">السعر ($) <span class="required">*</span></label>
                                <input type="number" id="productPrice" name="price" class="form-control" value="{{ old('price') }}" placeholder="45.00" min="0" step="0.01" required />
                                @error('price')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="productStock">الكمية المتاحة <span class="required">*</span></label>
                                <input type="number" id="productStock" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="10" min="1" required />
                                @error('stock')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ===== Category ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">category</span>
                            التصنيف
                        </div>
                        <div class="form-card__section-desc">
                            اختر التصنيف المناسب لمنتجك، أو أضف تصنيفاً جديداً
                        </div>

                        <div class="form-group">
                            <label for="productCategory">التصنيف <span class="required">*</span></label>
                            <select id="productCategory" name="category_id" class="form-control" required>
                                <option value="">-- اختر تصنيفاً --</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="1">تطريز</option>
                                    <option value="2">خزف</option>
                                    <option value="3">مجوهرات</option>
                                    <option value="4">أعمال خشبية</option>
                                    <option value="5">إكسسوارات</option>
                                @endif
                                <option value="__new__">✨ إنشاء فئة جديدة</option>
                            </select>
                            @error('category_id')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ===== New Category Field ===== -->
                        <div class="new-category-field" id="newCategoryField">
                            <div class="form-group">
                                <label for="newCategoryName">اسم الفئة الجديدة <span class="required">*</span></label>
                                <input type="text" id="newCategoryName" name="new_category" class="form-control" placeholder="أدخل اسم الفئة الجديدة..." />
                            </div>
                        </div>
                    </div>

                    <!-- ===== Product Images ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">image</span>
                            صور المنتج
                        </div>
                        <div class="form-card__section-desc">
                            أضف صوراً واضحة للمنتج (يفضل 4 صور على الأقل)
                        </div>

                        <div class="image-upload-area" id="imageUploadArea">
                            <span class="material-symbols-outlined">cloud_upload</span>
                            <h4>انقر لرفع الصور</h4>
                            <p>PNG, JPG, WEBP (الحد الأقصى 5 صور)</p>
                            <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple style="display:none;" />
                        </div>

                        <div class="image-preview" id="imagePreview"></div>
                        @error('images.*')
                            <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ===== Form Actions ===== -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary">
                            <span class="material-symbols-outlined">check</span>
                            نشر المنتج
                        </button>
                        <button type="button" class="btn btn--outline" onclick="window.location.href='{{ route('artisan.products') }}'">
                            <span class="material-symbols-outlined">close</span>
                            إلغاء
                        </button>
                        <button type="button" class="btn btn--outline" style="margin-right: auto;">
                            <span class="material-symbols-outlined">save</span>
                            حفظ كمسودة
                        </button>
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

            // ===== New Category Toggle =====
            const categorySelect = document.getElementById('productCategory');
            const newCategoryField = document.getElementById('newCategoryField');
            const newCategoryInput = document.getElementById('newCategoryName');

            categorySelect.addEventListener('change', function() {
                if (this.value === '__new__') {
                    newCategoryField.classList.add('active');
                    newCategoryInput.setAttribute('required', 'required');
                } else {
                    newCategoryField.classList.remove('active');
                    newCategoryInput.removeAttribute('required');
                    newCategoryInput.value = '';
                }
            });

            // ===== Image Upload =====
            const uploadArea = document.getElementById('imageUploadArea');
            const fileInput = document.getElementById('imageUpload');
            const previewContainer = document.getElementById('imagePreview');
            let uploadedFiles = [];

            uploadArea.addEventListener('click', () => fileInput.click());

            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#D4AF37';
                this.style.background = 'rgba(212, 175, 55, 0.05)';
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(200, 199, 184, 0.3)';
                this.style.background = 'rgba(247, 243, 233, 0.3)';
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(200, 199, 184, 0.3)';
                this.style.background = 'rgba(247, 243, 233, 0.3)';
                addFiles(e.dataTransfer.files);
            });

            fileInput.addEventListener('change', function() {
                addFiles(this.files);
            });

            function addFiles(files) {
                const maxFiles = 5;
                const remaining = maxFiles - uploadedFiles.length;

                if (remaining <= 0) {
                    alert('وصلت للحد الأقصى 5 صور');
                    return;
                }

                const newFiles = Array.from(files).filter(f => f.type.startsWith('image/'));

                if (newFiles.length > remaining) {
                    alert('يمكنك رفع ' + remaining + ' صور فقط');
                }

                newFiles.slice(0, remaining).forEach(file => {
                    uploadedFiles.push(file);
                });

                // ✅ مزامنة الـ input (الأهم!)
                syncInputFiles();

                // ✅ عرض المعاينة
                renderPreview();
            }

            function syncInputFiles() {
                const dataTransfer = new DataTransfer();
                uploadedFiles.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            }

            function renderPreview() {
                previewContainer.innerHTML = '';
                uploadedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const item = document.createElement('div');
                        item.className = 'image-preview__item';
                        item.innerHTML = `
                            <img src="${e.target.result}" alt="صورة المنتج" />
                            <button type="button" class="remove-btn" data-index="${index}">✕</button>
                        `;
                        previewContainer.appendChild(item);

                        item.querySelector('.remove-btn').addEventListener('click', function() {
                            const idx = parseInt(this.dataset.index);
                            uploadedFiles.splice(idx, 1);
                            syncInputFiles();
                            renderPreview();
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }

        });
    </script>

</body>
</html>