<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Handora - هاندورا</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    
    <style>
        /* ========================================
           HERO
           ======================================== */
        .hero {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 2rem 0;
            scroll-margin-top: 80px;
        }

        .hero__image-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image: url('{{ asset('assets/img/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero__bg {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            background-image: url('https://lh3.googleusercontent.com/aida/AP1WRLukRvpSQYSx7Pmbwmjp1XzpmkGp9rhTO9ZpvBUC8GaT2p2xdP2wU1TZOa4mWgFuJAlizplPd8Ic7aEpi92X9gjY7LbQ2bJOyFodfkIiCbWI3OGZKwaPKMr_7135YCyGvYBnsBlEkk2QmQBsZ_ShPAuZKQGjUqde3vgfyVyl66g7mLrQynHSz8Yz7D0EzcfMx-xI_EVrHe4h-nBriJseFfsPD12twdx5iUJVeMbAu7NTTnja9Dvp_loF7Js');
            background-size: 200px;
            background-repeat: repeat;
            opacity: 0.05;
        }

        .hero__content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3rem;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        @media (min-width: 768px) { .hero__content { gap: 4rem; } }

        @media (min-width: 992px) {
            .hero__content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 4rem;
                padding: 0 8rem;  
                margin-right: 100px; 
            }
        }

        @media (min-width: 1200px) {
            .hero__content {
                gap: 5rem;
                padding: 0 10rem;
            }
        }

        @media (min-width: 1400px) {
            .hero__content {
                gap: 6rem;
                padding: 0 12rem;
            }
        }

        .hero__text-wrapper {
            flex: 1;
            text-align: center;
            order: 1;
            max-width: 100%;
        }

        @media (min-width: 992px) {
            .hero__text-wrapper {
                text-align: right;
                order: 1;
                flex: 1;
                max-width: 50%;
            }
        }

        .hero__title {
            font-size: 32px;
            font-weight: 900;
            line-height: 1.2;
            color: #6F1D1B;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(111, 29, 27, 0.1);
        }

        .hero__title .handora-name {
            font-family: 'Tajawal', sans-serif;
            font-size: 1.2em;
            font-weight: 900;
            color: #6F1D1B;
            letter-spacing: 2px;
            position: relative;
            display: inline-block;
        }
        .hero__title .handora-name::after {
            content: '';
            position: absolute;
            bottom: -4px;
            right: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to left, #9E2A2B, #D4AF37, #9E2A2B);
            border-radius: 3px;
        }

        .hero__title .tagline {
            display: inline;
            font-size: 0.5em;
            font-weight: 800;
            color: #3E2723;
            margin-top: 0.5rem;
            letter-spacing: 1px;
            position: relative;
        }

        .hero__title .tagline .quote {
            color: #D4AF37;
            font-size: 1.2em;
            font-weight: 400;
        }
        .hero__title .tagline .quote-left { margin-left: 6px; }
        .hero__title .tagline .quote-right { margin-right: 6px; }

        @media (min-width: 576px) { .hero__title { font-size: 38px; } }
        @media (min-width: 768px) {
            .hero__title {
                font-size: 48px;
                font-weight: 900;
                letter-spacing: -0.02em;
                line-height: 1.1;
            }
        }
        @media (min-width: 992px) { .hero__title { font-size: 56px; } }
        @media (min-width: 1200px) { .hero__title { font-size: 64px; } }

        .hero__subtitle {
            font-size: 15px;
            line-height: 1.6;
            font-weight: 500;
            color: #47483c;
            max-width: 42rem;
            margin: 0 auto 1.5rem;
        }
        @media (min-width: 768px) { .hero__subtitle { font-size: 16px; } }
        @media (min-width: 992px) {
            .hero__subtitle {
                margin: 0 0 1.5rem 0;
                font-size: 17px;
            }
        }
        @media (min-width: 1200px) { .hero__subtitle { font-size: 18px; } }

        .hero__actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            justify-content: center;
            align-items: center;
        }
        @media (min-width: 576px) {
            .hero__actions {
                flex-direction: row;
                gap: 1rem;
            }
        }
        @media (min-width: 992px) { .hero__actions { justify-content: flex-start; } }

        .hero__logo-wrapper {
            flex: 0 0 auto;
            order: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            animation: float 6s ease-in-out infinite;
            width: 100%;
            max-width: 400px;
        }

        @media (min-width: 768px) {
            .hero__logo-wrapper { max-width: 450px; }
        }
        @media (min-width: 992px) {
            .hero__logo-wrapper {
                order: 2;
                flex: 0 0 45%;
                justify-content: flex-start;
                max-width: 100%;
            }
        }
        @media (min-width: 1200px) { .hero__logo-wrapper { flex: 0 0 48%; } }
        @media (min-width: 1400px) { .hero__logo-wrapper { flex: 0 0 50%; } }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        @media (min-width: 992px) {
            @keyframes float {
                0% { transform: translateX(0) translateY(0px); }
                50% { transform: translateX(0) translateY(-15px); }
                100% { transform: translateX(0) translateY(0px); }
            }
        }
        @media (max-width: 991px) { .hero__logo-wrapper { animation: none; } }

        .hero__logo {
            width: 280px;
            height: auto;
            object-fit: contain;
            mix-blend-mode: multiply;
            transition: transform 0.3s ease;
        }
        @media (min-width: 576px) { .hero__logo { width: 320px; } }
        @media (min-width: 768px) { .hero__logo { width: 380px; } }
        @media (min-width: 992px) { .hero__logo { width: 420px; transform: scale(1); } }
        @media (min-width: 1200px) { .hero__logo { width: 500px; transform: scale(1.02); } }
        @media (min-width: 1400px) { .hero__logo { width: 580px; transform: scale(1.05); } }

        /* ========================================
           ABOUT (قصة هاندورا)
           ======================================== */
        .about {
            padding: 20px 0 5rem 0;
            background: #f7f3e9;
            scroll-margin-top: 12px !important; 
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .about { padding: 20px 0 6rem 0; }
        }

        .about__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .about__grid {
                grid-template-columns: 1fr 1fr;
                gap: 4rem;
            }
        }

        .about__image-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about__image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 0;
            mask-image: linear-gradient(
                to left,
                rgba(0, 0, 0, 1) 40%,
                rgba(0, 0, 0, 0.6) 70%,
                rgba(0, 0, 0, 0) 100%
            );
            -webkit-mask-image: linear-gradient(
                to left,
                rgba(0, 0, 0, 1) 40%,
                rgba(0, 0, 0, 0.6) 70%,
                rgba(0, 0, 0, 0) 100%
            );
        }

        @media (min-width: 1024px) {
            .about__image {
                height: 550px;
                mask-image: linear-gradient(
                    to left,
                    rgba(0, 0, 0, 1) 30%,
                    rgba(0, 0, 0, 0.4) 70%,
                    rgba(0, 0, 0, 0) 100%
                );
                -webkit-mask-image: linear-gradient(
                    to left,
                    rgba(0, 0, 0, 1) 30%,
                    rgba(0, 0, 0, 0.4) 70%,
                    rgba(0, 0, 0, 0) 100%
                );
            }
        }

        .about__text {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 1rem;
            margin-top: 0;
        }

        /* ✅ على الشاشات الكبيرة: النص لليمين + إزاحة لليسار */
        @media (min-width: 1024px) {
            .about__text {
                align-items: flex-start;
                text-align: right;
                padding: 0 2rem 0 5rem;
                transform: translateX(-30px);
            }
        }

        .about__divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            width: 100%;
            max-width: 300px;
            margin: 0 auto 1.5rem;
        }

        @media (min-width: 1024px) {
            .about__divider {
                margin: 0 0 1.5rem 0;
            }
        }

        .about__divider::before,
        .about__divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #6F1D1B;
            opacity: 0.3;
        }

        .about__divider .fa-heart {
            color: #6F1D1B;
            font-size: 18px;
        }

        .about__divider--bottom {
            margin-top: 1.5rem;
            margin-bottom: 0;
        }

        .about__title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #6F1D1B;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .about__title { font-size: 2.8rem; }
        }

        .about__description {
            font-size: 1rem;
            line-height: 1.8;
            color: #47483c;
            max-width: 650px;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .about__description {
                margin: 0;
            }
        }

        .about__description p {
            margin-bottom: 1rem;
        }

        .about__description p:last-of-type {
            margin-bottom: 0;
        }

        .about__highlight {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #ebdcd5;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            margin-top: 1.5rem;
            width: 100%;
            max-width: 650px;
        }

        .about__highlight .material-symbols-outlined {
            font-size: 2.4rem;
            color: #6F1D1B;
            flex-shrink: 0;
        }

        .about__highlight-text {
            font-size: 1rem;
            font-weight: 700;
            color: #6F1D1B;
            line-height: 1.6;
            text-align: right;
        }

        @media (max-width: 1023px) {
            .about__image {
                mask-image: linear-gradient(
                    to bottom,
                    rgba(0, 0, 0, 1) 50%,
                    rgba(0, 0, 0, 0) 100%
                );
                -webkit-mask-image: linear-gradient(
                    to bottom,
                    rgba(0, 0, 0, 1) 50%,
                    rgba(0, 0, 0, 0) 100%
                );
                height: 350px;
            }
            .about__highlight { padding: 1rem; }
            .about__highlight .material-symbols-outlined { font-size: 2rem; }
            .about__highlight-text { font-size: 0.9rem; }
        }

        @media (max-width: 480px) {
            .about__title { font-size: 1.8rem; }
            .about__description { font-size: 0.9rem; }
            .about__highlight {
                flex-direction: column;
                text-align: center;
                padding: 1rem;
            }
            .about__highlight-text { text-align: center; }
            .about__image { height: 280px; }
        }

        /* ========================================
           CATEGORIES - إستكشف الحرف
           ======================================== */
        .categories {
            padding: 25px 0 5rem 0;
            background: #fdf9ef;
            position: relative;
            overflow: hidden;
            scroll-margin-top: 0px !important; 
        }

        @media (min-width: 768px) {
            .categories { padding: 25px 0 6rem 0; }
        }

        .categories__bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image: url('https://lh3.googleusercontent.com/aida/AP1WRLukRvpSQYSx7Pmbwmjp1XzpmkGp9rhTO9ZpvBUC8GaT2p2xdP2wU1TZOa4mWgFuJAlizplPd8Ic7aEpi92X9gjY7LbQ2bJOyFodfkIiCbWI3OGZKwaPKMr_7135YCyGvYBnsBlEkk2QmQBsZ_ShPAuZKQGjUqde3vgfyVyl66g7mLrQynHSz8Yz7D0EzcfMx-xI_EVrHe4h-nBriJseFfsPD12twdx5iUJVeMbAu7NTTnja9Dvp_loF7Js');
            background-size: 200px;
            background-repeat: repeat;
            opacity: 0.05;
        }

        .categories__inner {
            position: relative;
            z-index: 10;
        }

        .categories__header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .categories__title {
            font-size: 2.4rem;
            font-weight: 800;
            color: #6F1D1B;
            margin-bottom: 0.5rem;
        }

        .categories__title .material-symbols-outlined {
            font-size: 2.4rem;
            color: #9E2A2B;
            vertical-align: middle;
        }

        .categories__subtitle {
            font-size: 1.1rem;
            line-height: 1.6;
            font-weight: 500;
            color: #47483c;
        }

        @media (min-width: 768px) {
            .categories__title { font-size: 2.8rem; }
            .categories__title .material-symbols-outlined { font-size: 2.8rem; }
        }

        .categories__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 900px;
            margin: 0 auto;
        }

        @media (min-width: 640px) {
            .categories__grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
        }

        .category-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1.5rem;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            transition: all 0.3s;
            text-align: center;
        }

        .category-card:hover {
            border-color: #D4AF37;
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(159, 42, 43, 0.08);
        }

        .category-card__icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(159, 42, 43, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: background 0.2s;
            border: 2px solid rgba(159, 42, 43, 0.06);
            flex-shrink: 0;
            overflow: hidden;
        }

        .category-card__icon img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
        }
        .category-card:hover .category-card__icon {
            background: rgba(159, 42, 43, 0.12);
            border-color: #D4AF37;
        }

        .category-card__label {
            font-size: 1.05rem;
            font-weight: 700;
            color: #6F1D1B;
            margin-bottom: 0.25rem;
        }

        .category-card__desc {
            font-size: 0.85rem;
            color: #77786b;
            line-height: 1.5;
        }

        /* ========================================
           ARTISANS
           ======================================== */
        .artisans {
            padding: 4rem 0;
            background: #ece8de;
            scroll-margin-top: 80px;
        }
        @media (min-width: 768px) { .artisans { padding: 5rem 0; } }

        .artisans__header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
        }
        @media (min-width: 768px) { .artisans__header { margin-bottom: 3rem; } }

        .artisans__title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
            color: #6F1D1B;
        }
        @media (min-width: 768px) { .artisans__title { font-size: 32px; } }

        .artisans__subtitle {
            font-size: 16px;
            line-height: 1.6;
            font-weight: 500;
            color: #47483c;
        }

        .artisans__view-all {
            display: none;
            align-items: center;
            gap: 0.5rem;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9E2A2B;
            transition: color 0.2s;
        }
        .artisans__view-all:hover { color: #6F1D1B; }
        @media (min-width: 768px) { .artisans__view-all { display: flex; } }

        .artisans__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 576px) {
            .artisans__grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }
        @media (min-width: 992px) {
            .artisans__grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }

        .artisan-card {
            background: #fdf9ef;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(200, 199, 184, 0.2);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        .artisan-card:hover {
            transform: translateY(-4px);
            border-color: #D4AF37;
            box-shadow: 0 8px 30px rgba(159, 42, 43, 0.08);
        }

        .artisan-card__image {
            height: 160px;
            overflow: hidden;
        }
        @media (min-width: 768px) { .artisan-card__image { height: 192px; } }

        .artisan-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .artisan-card:hover .artisan-card__image img { transform: scale(1.1); }

        .artisan-card__body {
            padding: 1rem;
            text-align: center;
        }
        @media (min-width: 768px) { .artisan-card__body { padding: 1.5rem; } }

        .artisan-card__name {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            color: #6F1D1B;
            margin-bottom: 0.25rem;
        }
        @media (min-width: 768px) { .artisan-card__name { font-size: 24px; } }

        .artisan-card__role {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9E2A2B;
            margin-bottom: 0.75rem;
        }
        @media (min-width: 768px) {
            .artisan-card__role {
                font-size: 12px;
                margin-bottom: 1rem;
            }
        }

        /* ========================================
           CONTACT
           ======================================== */
        .contact {
            padding: 4rem 0;
            background: #fdf9ef;
            scroll-margin-top: 80px;
        }
        @media (min-width: 768px) { .contact { padding: 5rem 0; } }

        .contact__header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        @media (min-width: 768px) { .contact__header { margin-bottom: 3rem; } }

        .contact__header .section-label { justify-content: center; }

        .section-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .section-label__line {
            height: 2px;
            width: 48px;
            background: #9E2A2B;
            display: block;
        }

        .section-label__text {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9E2A2B;
        }

        .contact__title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
            color: #6F1D1B;
            margin-bottom: 0.5rem;
        }
        @media (min-width: 768px) { .contact__title { font-size: 32px; } }

        .contact__subtitle {
            font-size: 16px;
            line-height: 1.6;
            font-weight: 500;
            color: #47483c;
        }

        .contact__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 992px) {
            .contact__grid {
                grid-template-columns: 1fr 1.5fr;
                gap: 3rem;
            }
        }

        .contact__info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        @media (min-width: 992px) { .contact__info { gap: 2rem; } }

        .contact__info-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        @media (min-width: 768px) { .contact__info-item { gap: 1rem; } }

        .contact__info-item .material-symbols-outlined {
            font-size: 28px;
            color: #9E2A2B;
            background: rgba(159, 42, 43, 0.08);
            padding: 0.5rem;
            border-radius: 12px;
            flex-shrink: 0;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        @media (min-width: 768px) {
            .contact__info-item .material-symbols-outlined {
                font-size: 32px;
                padding: 0.75rem;
            }
        }

        .contact__info-item h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1c1c16;
            margin-bottom: 0.25rem;
        }
        @media (min-width: 768px) { .contact__info-item h4 { font-size: 18px; } }

        .contact__info-item p {
            font-size: 15px;
            line-height: 1.6;
            font-weight: 500;
            color: #47483c;
        }
        @media (min-width: 768px) { .contact__info-item p { font-size: 16px; } }

        .contact__form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (min-width: 768px) { .contact__form { gap: 1.5rem; } }

        .contact__form-group input,
        .contact__form-group textarea {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid rgba(200, 199, 184, 0.4);
            border-radius: 8px;
            background: #f7f3e9;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            color: #1c1c16;
            transition: border-color 0.3s;
        }
        @media (min-width: 768px) {
            .contact__form-group input,
            .contact__form-group textarea {
                padding: 0.75rem 1rem;
                font-size: 16px;
            }
        }

        .contact__form-group input:focus,
        .contact__form-group textarea:focus {
            outline: none;
            border-color: #D4AF37;
        }

        .contact__form-group textarea { resize: vertical; }
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
            <nav class="nav-desktop">
                <a href="#home" class="nav-desktop__link active">الرئيسية</a>
                <a href="#about" class="nav-desktop__link">من نحن</a>
                <a href="#categories" class="nav-desktop__link">استكشف الحرف</a>
                <a href="#artisans" class="nav-desktop__link">حرفيون</a>
                <a href="#contact" class="nav-desktop__link">تواصل معنا</a>
            </nav>
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

    <main class="index-page">
        
        <!-- ===== HERO ===== -->
        <section id="home" class="hero">
            <div class="hero__image-bg"></div>
            <div class="hero__bg"></div>

            <div class="container hero__content">
                <div class="hero__text-wrapper animate__animated" data-animation="animate__fadeInRight">
                    <h1 class="hero__title">
                        <span class="handora-name">..Handora</span>
                        <span class="tagline">
                            <span class="quote quote-left">"</span>
                            صُنعت بيدٍ لتبقى حكاية
                            <span class="quote quote-right">"</span>
                        </span>
                    </h1>
                    <p class="hero__subtitle">
                        اكتشف عالمًا من الحرف اليدوية، حيث يلتقي الإبداع بالأصالة، وتتحول مهارات الحرفيين إلى قطع فريدة تحمل روح صُنّاعها.
                    </p>
                    <div class="hero__actions">
                        <a href="{{ route('login') }}" class="btn btn--large btn--primary">تسوق الآن</a>
                        <a href="{{ route('register') }}" class="btn btn--large btn--outline-secondary">انضم كحرفي</a>
                    </div>
                </div>
                <div class="hero__logo-wrapper animate__animated" data-animation="animate__fadeInLeft">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Handora Hero Logo" class="hero__logo" />
                </div>
            </div>
        </section>

        <!-- ===== ABOUT ===== -->
        <section id="about" class="about">
            <div class="container about__grid">
                <div class="about__image-wrapper animate__animated" data-animation="animate__fadeInRight">
                    <img src="{{ asset('assets/img/about1.jpg') }}" alt="قصة هاندورا" class="about__image" />
                </div>
                <div class="about__text animate__animated" data-animation="animate__fadeInLeft">
                    <div class="about__divider">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <h2 class="about__title">قصة هاندورا</h2>
                    <div class="about__description">
                        <p>
                            وراء كل قطعة يدوية حكاية، ووراء كل حرفة يدٌ تستحق أن تُرى.
                            من هنا بدأت هاندورا؛ بفكرة أن الحرفي لا يجب أن يبقى محصورًا في محيطه، وأن الوصول إلى قطعة مميزة لا يجب أن يكون رحلة بحث طويلة.
                        </p>
                        <p>
                            صنعنا مساحة تجمع الحرفي بمن يبحث عن إبداعه؛ مساحة يعرّف فيها الحرفيون عن أنفسهم ومهاراتهم، يعرضون أعمالهم، ويستقبلون طلبات العملاء، بينما يكتشف العملاء قطعًا فريدة أو يطلبونها بتفاصيلهم الخاصة.
                        </p>
                    </div>
                    <div class="about__highlight">
                        <span class="material-symbols-outlined">psychiatry</span>
                        <span class="about__highlight-text">
                            هاندورا ليست مجرد منصة لبيع المنتجات اليدوية، بل جسرٌ يصل الحرفة بمن يقدّرها.
                        </span>
                    </div>
                    <div class="about__divider about__divider--bottom">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== CATEGORIES - إستكشف الحرف ===== -->
        <section id="categories" class="categories">
            <div class="categories__bg"></div>
            <div class="container categories__inner">
                <div class="categories__header animate__animated" data-animation="animate__fadeInDown">
                    <h2 class="categories__title">
                        <span class="material-symbols-outlined">explore</span>
                        استكشف الحرف
                    </h2>
                    <p class="categories__subtitle">اكتشف عالم الحرف اليدوية بتنوعها وجمالها</p>
                </div>
                <div class="categories__grid">

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="100">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/tatreez-palestine.jpg') }}" alt="التطريز الفلسطيني" />
                        </div>
                        <span class="category-card__label">التطريز الفلسطيني</span>
                        <span class="category-card__desc">تراثنا الأصيل بلمسة عصرية</span>
                    </a>

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="200">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/tatreez-modern.jpg') }}" alt="التطريز الحديث" />
                        </div>
                        <span class="category-card__label">التطريز الحديث</span>
                        <span class="category-card__desc">تصاميم معاصرة بأنامل مبدعة</span>
                    </a>

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="300">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/beads.jpg') }}" alt="الخرز والإكسسوارات" />
                        </div>
                        <span class="category-card__label">الخرز والإكسسوارات</span>
                        <span class="category-card__desc">تفاصيل تضفي لمسة جمالية</span>
                    </a>

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="400">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/crochet.jpg') }}" alt="الكروشيه والحياكة" />
                        </div>
                        <span class="category-card__label">الكروشيه والحياكة</span>
                        <span class="category-card__desc">دفء وإبداع في كل غرزة</span>
                    </a>

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="500">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/art-craft.jpg') }}" alt="الفن والأعمال اليدوية" />
                        </div>
                        <span class="category-card__label">الفن والأعمال اليدوية</span>
                        <span class="category-card__desc">إبداع يتجسد في كل قطعة</span>
                    </a>

                    <a href="#" class="category-card animate__animated" data-animation="animate__zoomIn" data-delay="600">
                        <div class="category-card__icon">
                            <img src="{{ asset('assets/img/categories/custom-gifts.jpeg') }}" alt="الهدايا المخصصة" />
                        </div>
                        <span class="category-card__label">الهدايا المخصصة</span>
                        <span class="category-card__desc">قطعة فريدة تحمل بصمتك</span>
                    </a>

                </div>
            </div>
        </section>

        <!-- ===== ARTISANS ===== -->
        <section id="artisans" class="artisans">
            <div class="container artisans__inner">
                <div class="artisans__header animate__animated" data-animation="animate__fadeInDown">
                    <div>
                        <h2 class="artisans__title">حرفيون مبدعون</h2>
                        <p class="artisans__subtitle">تعرف على الأيدي التي تصنع الجمال</p>
                    </div>
                    <a href="#" class="artisans__view-all">
                        <span>عرض جميع الحرفيين</span>
                        <span class="material-symbols-outlined">arrow_left_alt</span>
                    </a>
                </div>
                <div class="artisans__grid">
                    <div class="artisan-card animate__animated" data-animation="animate__fadeInUp" data-delay="100">
                        <div class="artisan-card__image">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=400" alt="Artisan" />
                        </div>
                        <div class="artisan-card__body">
                            <h3 class="artisan-card__name">ليلى أحمد</h3>
                            <p class="artisan-card__role">خبيرة تطريز</p>
                            <a href="#" class="btn btn--small btn--outline-primary">الملف الشخصي</a>
                        </div>
                    </div>
                    <div class="artisan-card animate__animated" data-animation="animate__fadeInUp" data-delay="200">
                        <div class="artisan-card__image">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=400" alt="Artisan" />
                        </div>
                        <div class="artisan-card__body">
                            <h3 class="artisan-card__name">يوسف خليل</h3>
                            <p class="artisan-card__role">فنان خشب</p>
                            <a href="#" class="btn btn--small btn--outline-primary">الملف الشخصي</a>
                        </div>
                    </div>
                    <div class="artisan-card animate__animated" data-animation="animate__fadeInUp" data-delay="300">
                        <div class="artisan-card__image">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=400" alt="Artisan" />
                        </div>
                        <div class="artisan-card__body">
                            <h3 class="artisan-card__name">مريم سعيد</h3>
                            <p class="artisan-card__role">مصممة مجوهرات</p>
                            <a href="#" class="btn btn--small btn--outline-primary">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== CONTACT ===== -->
        <section id="contact" class="contact">
            <div class="container contact__inner">
                <div class="contact__header animate__animated" data-animation="animate__fadeInDown">
                    <div class="section-label">
                        <span class="section-label__line"></span>
                        <span class="section-label__text">تواصل معنا</span>
                    </div>
                    <h2 class="contact__title">نحن هنا لمساعدتك</h2>
                    <p class="contact__subtitle">لديك سؤال أو استفسار؟ تواصل معنا وسنرد عليك في أقرب وقت</p>
                </div>
                <div class="contact__grid">
                    <div class="contact__info">
                        <div class="contact__info-item animate__animated" data-animation="animate__fadeInRight" data-delay="100">
                            <span class="material-symbols-outlined">location_on</span>
                            <div>
                                <h4>العنوان</h4>
                                <p>فلسطين، رام الله</p>
                            </div>
                        </div>
                        <div class="contact__info-item animate__animated" data-animation="animate__fadeInRight" data-delay="200">
                            <span class="material-symbols-outlined">phone</span>
                            <div>
                                <h4>الهاتف</h4>
                                <p>+970 599 123 456</p>
                            </div>
                        </div>
                        <div class="contact__info-item animate__animated" data-animation="animate__fadeInRight" data-delay="300">
                            <span class="material-symbols-outlined">email</span>
                            <div>
                                <h4>البريد الإلكتروني</h4>
                                <p>info@handora.com</p>
                            </div>
                        </div>
                        <div class="contact__info-item animate__animated" data-animation="animate__fadeInRight" data-delay="400">
                            <span class="material-symbols-outlined">schedule</span>
                            <div>
                                <h4>ساعات العمل</h4>
                                <p>الأحد - الخميس: 9:00 - 18:00</p>
                            </div>
                        </div>
                    </div>
                    <form class="contact__form animate__animated" data-animation="animate__fadeInLeft">
                        <div class="contact__form-group">
                            <input type="text" placeholder="الاسم الكامل" required />
                        </div>
                        <div class="contact__form-group">
                            <input type="email" placeholder="البريد الإلكتروني" required />
                        </div>
                        <div class="contact__form-group">
                            <input type="text" placeholder="الموضوع" />
                        </div>
                        <div class="contact__form-group">
                            <textarea rows="5" placeholder="رسالتك..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn--large btn--primary">إرسال الرسالة</button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__grid">
                <div class="footer__brand animate__animated" data-animation="animate__fadeInUp">
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
                <div class="footer__links animate__animated" data-animation="animate__fadeInUp" data-delay="100">
                    <h4 class="footer__links-title">روابط سريعة</h4>
                    <ul>
                        <li><a href="#about">عن هاندورا</a></li>
                        <li><a href="#artisans">بوابة الحرفيين</a></li>
                        <li><a href="#">سياسة الخصوصية</a></li>
                        <li><a href="#contact">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="footer__links animate__animated" data-animation="animate__fadeInUp" data-delay="200">
                    <h4 class="footer__links-title">التصنيفات</h4>
                    <ul>
                        <li><a href="#">تطريز</a></li>
                        <li><a href="#">خزف</a></li>
                        <li><a href="#">مجوهرات</a></li>
                        <li><a href="#">أعمال خشبية</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom animate__animated" data-animation="animate__fadeIn" data-delay="300">
                <p>© {{ date('Y') }} Handora. Handmade with Heritage.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>