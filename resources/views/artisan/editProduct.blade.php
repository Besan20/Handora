<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل منتج - Handora</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
        .edit-product-page { margin-top: 24px; padding: 16px 0 32px; min-height: calc(100vh - 80px); background: #fdf9ef; }
        .edit-product-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #77786b; margin-bottom: 16px; padding: 0 20px; }
        .edit-product-breadcrumb a { color: #9E2A2B; text-decoration: none; font-weight: 500; }
        .edit-product-breadcrumb a:hover { text-decoration: underline; }
        .edit-product-breadcrumb .material-symbols-outlined { font-size: 1rem; }
        .edit-product-header { margin-bottom: 20px; padding: 0 20px; }
        .edit-product-header h1 { font-size: 1.8rem; font-weight: 800; color: #6F1D1B; margin: 0; display: flex; align-items: center; gap: 10px; }
        .edit-product-header h1 .material-symbols-outlined { color: #9E2A2B; }
        .edit-product-header p { color: #47483c; margin: 4px 0 0 0; font-size: 0.95rem; margin-right: 40px; }
        .form-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.6); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: 36px 40px; max-width: 820px; margin: 0 auto; }
        .form-card__section { margin-bottom: 28px; }
        .form-card__section:last-child { margin-bottom: 0; }
        .form-card__section-title { font-size: 0.95rem; font-weight: 700; color: #6F1D1B; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid rgba(159,42,43,0.06); padding-bottom: 8px; }
        .form-card__section-title .material-symbols-outlined { font-size: 22px; color: #9E2A2B; }
        .form-group { margin-bottom: 16px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #1c1c16; margin-bottom: 4px; }
        .form-group label .required { color: #dc3545; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid rgba(200,199,184,0.2); border-radius: 12px; font-family: 'Tajawal', sans-serif; font-size: 0.95rem; color: #1c1c16; background: rgba(247,243,233,0.5); transition: all 0.3s ease; outline: none; }
        .form-control:focus { border-color: #D4AF37; background: rgba(255,255,255,0.9); box-shadow: 0 0 0 4px rgba(212,175,55,0.08); }
        textarea.form-control { resize: vertical; min-height: 120px; }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2377786b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: left 14px center; padding-left: 36px; cursor: pointer; }
        .current-image { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; padding: 10px; background: rgba(247,243,233,0.5); border-radius: 10px; }
        .current-image img { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; }
        .current-image__info { flex: 1; }
        .current-image__info h4 { font-size: 0.9rem; font-weight: 700; color: #1c1c16; margin: 0 0 4px; }
        .current-image__info p { font-size: 0.75rem; color: #77786b; margin: 0; }
        .image-upload-area { border: 2px dashed rgba(200,199,184,0.25); border-radius: 14px; padding: 24px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: rgba(247,243,233,0.3); }
        .image-upload-area:hover { border-color: #D4AF37; background: rgba(212,175,55,0.03); }
        .image-upload-area .material-symbols-outlined { font-size: 42px; color: #a0a094; }
        .image-upload-area h4 { font-size: 0.95rem; color: #1c1c16; margin: 6px 0 4px; }
        .image-upload-area p { font-size: 0.75rem; color: #77786b; }
        .image-preview { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px,1fr)); gap: 10px; margin-top: 12px; }
        .image-preview__item { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 1; border: 1px solid rgba(200,199,184,0.15); }
        .image-preview__item img { width: 100%; height: 100%; object-fit: cover; }
        .image-preview__item .remove-btn { position: absolute; top: 4px; right: 4px; width: 24px; height: 24px; border-radius: 50%; border: none; background: rgba(220,53,69,0.85); color: #fff; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; }
        .form-actions { display: flex; gap: 12px; margin-top: 28px; padding-top: 20px; border-top: 1px solid rgba(200,199,184,0.12); }
        .form-actions .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        .btn--primary { background: #9E2A2B; color: #ffffff; box-shadow: 0 4px 16px rgba(159,42,43,0.2); }
        .btn--primary:hover { background: #7A1F20; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(159,42,43,0.25); }
        .btn--outline { background: transparent; color: #54623A; border: 2px solid #54623A; }
        .btn--outline:hover { background: rgba(84,98,58,0.06); transform: translateY(-2px); }
        .btn--danger { background: transparent; color: #dc3545; border: 2px solid #dc3545; margin-right: auto; }
        .btn--danger:hover { background: rgba(220,53,69,0.06); transform: translateY(-2px); }
        @media (max-width: 768px) {
            .form-card { padding: 24px 20px; border-radius: 16px; }
            .form-actions { flex-direction: column; }
            .form-actions .btn { justify-content: center; }
            .btn--danger { margin-right: 0; }
            .edit-product-header { padding: 0 16px; }
            .edit-product-header h1 { font-size: 1.4rem; }
            .edit-product-breadcrumb { padding: 0 16px; }
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

    <!-- ===== EDIT PRODUCT PAGE ===== -->
    <main class="edit-product-page">
        <div class="container">

            <!-- ===== Breadcrumb ===== -->
            <div class="edit-product-breadcrumb">
                <a href="{{ route('artisan.home') }}">الرئيسية</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <a href="{{ route('artisan.products') }}">منتجاتي</a>
                <span class="material-symbols-outlined">chevron_left</span>
                <span style="color: #1c1c16; font-weight: 600;">تعديل المنتج</span>
            </div>

            <!-- ===== Header ===== -->
            <div class="edit-product-header">
                <h1>
                    <span class="material-symbols-outlined">edit</span>
                    تعديل المنتج
                </h1>
                <p>{{ $product->name }}</p>
            </div>

            <!-- ===== Form ===== -->
            <div class="form-card">
                <form action="{{ route('artisan.update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ===== Basic Info ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">info</span>
                            المعلومات الأساسية
                        </div>

                        <div class="form-group">
                            <label for="name">اسم المنتج <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required />
                            @error('name')
                                <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">وصف المنتج</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label for="price">السعر ($) <span class="required">*</span></label>
                                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" min="0" step="0.01" required />
                                @error('price')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock">الكمية <span class="required">*</span></label>
                                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required />
                                @error('stock')
                                    <div style="color:#dc3545; font-size:13px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id">التصنيف <span class="required">*</span></label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">-- اختر تصنيفاً --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- ===== Current Images ===== -->
                    @if($product->images && is_array($product->images) && count($product->images) > 0)
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">image</span>
                            الصور الحالية
                        </div>
                        <div class="image-preview">
                            @foreach($product->images as $image)
                                <div class="image-preview__item">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- ===== New Images ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">add_photo_alternate</span>
                            إضافة صور جديدة (اختياري)
                        </div>

                        <div class="image-upload-area" id="imageUploadArea">
                            <span class="material-symbols-outlined">cloud_upload</span>
                            <h4>انقر لرفع الصور</h4>
                            <p>PNG, JPG, WEBP (الحد الأقصى 5 صور)</p>
                            <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple style="display:none;" />
                        </div>

                        <div class="image-preview" id="imagePreview"></div>
                    </div>

                    <!-- ===== Status ===== -->
                    <div class="form-card__section">
                        <div class="form-card__section-title">
                            <span class="material-symbols-outlined">visibility</span>
                            حالة المنتج
                        </div>
                        <div class="form-group">
                            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                                <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', $product->is_visible) ? 'checked' : '' }} style="width:18px; height:18px; accent-color:#9E2A2B;" />
                                <span>إظهار المنتج في المتجر</span>
                            </label>
                        </div>
                    </div>

                    <!-- ===== Form Actions ===== -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary">
                            <span class="material-symbols-outlined">check</span>
                            حفظ التغييرات
                        </button>
                        <a href="{{ route('artisan.products') }}" class="btn btn--outline">
                            <span class="material-symbols-outlined">close</span>
                            إلغاء
                        </a>
                        <button type="button" class="btn btn--danger" onclick="confirmDelete()">
                            <span class="material-symbols-outlined">delete</span>
                            حذف المنتج
                        </button>
                    </div>
                </form>

                <!-- ===== Delete Form (Hidden) ===== -->
                <form id="deleteForm" action="{{ route('artisan.delete-product', $product->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
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
        // ===== Image Upload Preview =====
        const uploadArea = document.getElementById('imageUploadArea');
        const fileInput = document.getElementById('imageUpload');
        const previewContainer = document.getElementById('imagePreview');

        uploadArea.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const item = document.createElement('div');
                    item.className = 'image-preview__item';
                    item.innerHTML = `<img src="${e.target.result}" alt="صورة جديدة" />`;
                    previewContainer.appendChild(item);
                };
                reader.readAsDataURL(file);
            });
        });

        // ===== Confirm Delete =====
        function confirmDelete() {
            if (confirm('هل أنت متأكد من حذف هذا المنتج؟ لا يمكن التراجع عن هذا الإجراء.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>

</body>
</html>