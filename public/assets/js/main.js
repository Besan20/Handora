document.addEventListener('DOMContentLoaded', function () {
    // ===== MOBILE MENU TOGGLE =====
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            console.log('Mobile menu toggle clicked');
        });
    }

    // ===== SCROLL ANIMATIONS =====
    const animatedElements = document.querySelectorAll('.animate__animated');
    
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        return rect.top <= windowHeight - 100;
    }

    function animateElement(el) {
        if (el.classList.contains('animate__visible')) return;
        
        const animation = el.getAttribute('data-animation');
        const delay = parseInt(el.getAttribute('data-delay')) || 0;
        
        if (animation) {
            setTimeout(() => {
                el.classList.add('animate__visible', animation);
            }, delay);
        }
    }

    function checkAnimations() {
        animatedElements.forEach(el => {
            if (isElementInViewport(el)) {
                animateElement(el);
            }
        });
    }

    setTimeout(checkAnimations, 300);

    let scrollTimeout;
    window.addEventListener('scroll', function () {
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = window.requestAnimationFrame(checkAnimations);
    });

    window.addEventListener('resize', checkAnimations);

    // ===== SMOOTH SCROLLING (الصفحة الرئيسية فقط) =====
    const navLinks = document.querySelectorAll('.nav-desktop__link');
    
    // Check if we're on the homepage with sections
    const sections = document.querySelectorAll('section[id]');
    
    if (sections.length > 0) {
        navLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId.startsWith('#')) {
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const navbarHeight = document.querySelector('.navbar').offsetHeight;
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                    navLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Update active link on scroll (الصفحة الرئيسية فقط)
        window.addEventListener('scroll', function () {
            const scrollPosition = window.pageYOffset + 100;
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    const currentId = section.getAttribute('id');
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#' + currentId) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
    }

    // ===== LOGIN PAGE SPECIFIC =====
    // Password Toggle
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordInput = document.getElementById('password');

    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            }
        });
    }

    // Login Form Submit
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const email = document.getElementById('email')?.value;
            const password = document.getElementById('password')?.value;
            
            if (!email || !password) {
                alert('الرجاء إدخال البريد الإلكتروني وكلمة المرور');
                return;
            }

            const submitBtn = this.querySelector('.login-submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جاري تسجيل الدخول...';
            submitBtn.disabled = true;

            setTimeout(() => {
                alert('تم تسجيل الدخول بنجاح!');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                // window.location.href = 'index.html';
            }, 1500);
        });
    }

    // Social Login Buttons
    const socialBtns = document.querySelectorAll('.login-social-btn');
    socialBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const provider = this.classList.contains('login-social-btn--google') ? 'Google' : 'Facebook';
            alert(`جاري تسجيل الدخول عبر ${provider}...`);
        });
    });

    console.log('Handora website initialized.');
});
// ===== REGISTER PAGE =====
// Password Toggle
const registerPasswordToggle = document.getElementById('passwordToggle');
const registerPasswordInput = document.getElementById('password');

if (registerPasswordToggle && registerPasswordInput) {
    registerPasswordToggle.addEventListener('click', function () {
        const type = registerPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        registerPasswordInput.setAttribute('type', type);
        
        const icon = this.querySelector('.material-symbols-outlined');
        if (icon) {
            icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
        }
    });
}

// Register Form Submit
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const fullname = document.getElementById('fullname')?.value;
        const email = document.getElementById('email')?.value;
        const password = document.getElementById('password')?.value;
        const confirmPassword = document.getElementById('confirmPassword')?.value;
        const role = document.querySelector('input[name="role"]:checked')?.value;
        
        // Validation
        if (!fullname || !email || !password || !confirmPassword) {
            alert('الرجاء ملء جميع الحقول');
            return;
        }
        
        if (password !== confirmPassword) {
            alert('كلمة المرور غير متطابقة');
            return;
        }
        
        if (password.length < 6) {
            alert('كلمة المرور يجب أن تكون 6 أحرف على الأقل');
            return;
        }
        
        const submitBtn = this.querySelector('.register-submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'جاري إنشاء الحساب...';
        submitBtn.disabled = true;

        setTimeout(() => {
            alert(`مرحباً ${fullname}! تم إنشاء حسابك بنجاح كـ ${role === 'artisan' ? 'حرفي' : 'زبون'} 🎉`);
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            // window.location.href = 'index.html';
        }, 1500);
    });
}

// Social Registration Buttons
const registerSocialBtns = document.querySelectorAll('.register-social-btn');
registerSocialBtns.forEach(btn => {
    btn.addEventListener('click', function () {
        const provider = this.classList.contains('register-social-btn--google') ? 'Google' : 'Facebook';
        alert(`جاري التسجيل عبر ${provider}...`);
    });
});