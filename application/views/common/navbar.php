<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <style>
        .nav-link {
            font-family: 'Cormorant Garamond', serif;
        }

        .metal-name,
        .metal-price,
        .price-change {
            font-family: 'Garet', serif;
        }

        .navbar {
            background-color: #370248;
        }

        .nav-link {
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 1px;
            position: relative;
            /* Add animation for fade-in effect */
            opacity: 0;
            animation-name: navFadeIn;
            animation-duration: 0.7s;
            animation-fill-mode: forwards;
        }

        @keyframes navFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-link.active,
        .nav-link:hover {
            color: white !important;
        }

        /* Gradient underline effect */
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #b53fc2 0%, #fff 100%);
            transition: width 0.3s;
            position: absolute;
            left: 0;
            bottom: 0;

        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-item:nth-child(1) .nav-link {
            animation-delay: 0.1s;
        }

        .nav-item:nth-child(2) .nav-link {
            animation-delay: 0.2s;
        }

        .nav-item:nth-child(3) .nav-link {
            animation-delay: 0.3s;
        }

        .nav-item:nth-child(4) .nav-link {
            animation-delay: 0.4s;
        }

        .nav-item:nth-child(5) .nav-link {
            animation-delay: 0.5s;
        }

        .nav-item:nth-child(6) .nav-link {
            animation-delay: 0.6s;
        }

        .nav-item:nth-child(7) .nav-link {
            animation-delay: 0.7s;
        }

        .nav-item:nth-child(8) .nav-link {
            animation-delay: 0.8s;
        }

        .nav-item:nth-child(9) .nav-link {
            animation-delay: 0.9s;
        }

        .nav-item:nth-child(10) .nav-link {
            animation-delay: 1.0s;
        }

        .nav-item:nth-child(11) .nav-link {
            animation-delay: 1.1s;
        }



        .icon-btn {
            color: #B53FC2;
            font-size: 1.2rem;
            transition: transform 0.2s;
        }

        .icon-btn:hover {
            transform: scale(1.15);
            color: #B53FC2;
            filter: drop-shadow(0 2px 8px rgba(181, 63, 194, 0.25)) brightness(1.1);
        }

        .search-bar {
            max-width: 400px;
            width: 25%;
        }

        .search-bar .input-group {
            border-radius: 20px;
            overflow: hidden;
            border: 2px solid #B53FC2;
        }

        .search-bar .form-control {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            border: none;
            box-shadow: none;
        }

        .search-bar .btn {
            background-color: #fff;
            border: none;
            color: #6f42c1;
        }

        .search-bar .form-control {
            border-radius: 2rem 0 0 2rem;
        }

        .search-bar .btn {
            border-radius: 0 2rem 2rem 0;
            color: #b53fc2;
            background: #fff;
            border: 1px solid #b53fc2;
        }

        .bg-gradient-gold-rates {
            background: linear-gradient(90deg, #370248 60%, #b53fc2 100%);
        }

        @media (max-width: 576px) {

            .bg-gradient-gold-rates strong,
            .bg-gradient-gold-rates i {
                font-size: 0.95rem;
            }

            .bg-gradient-gold-rates marquee {
                font-size: 0.95rem;
            }
        }


        .gold-rates-bar {
            background: linear-gradient(135deg, #1a1625 0%, #2d1b4e 50%, #8b3a9c 100%);
            border-bottom: 1px solid rgba(181, 63, 194, 0.3);
            position: relative;
            overflow: hidden;
        }

        .gold-rates-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(181, 63, 194, 0.5), transparent);
        }

        .rates-header {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            letter-spacing: 0.5px;
        }

        .header-icon {
            color: #d4af37;
            font-size: 1.3rem;
            opacity: 0.9;
        }

        .scroll-wrapper {
            overflow: hidden;
            position: relative;
            flex-grow: 1;

            display: flex;
            align-items: center;
        }

        .rates-ticker {
            font-family: 'Garet', sans-serif;
            font-weight: 100;
            color: #ffffff;
            white-space: nowrap;
            animation: smoothScroll 40s linear infinite;
            display: flex;
            align-items: center;
            font-size: 0.85rem;
        }

        @keyframes smoothScroll {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .rate-segment {
            display: inline-flex;
            align-items: center;
            margin-right: 45px;
            padding: 8px 18px;
            border-radius: 6px;
            transition: all 0.3s ease;

        }

        .rate-segment:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(212, 175, 55, 0.4);
            transform: translateY(-1px);
        }

        .metal-name {
            font-weight: 600;
            color: #d4af37;
            margin-right: 10px;
            font-size: 0.9rem;
            min-width: 65px;
            text-align: left;
        }

        .metal-price {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 0.8rem;
            color: #ffffff;
            letter-spacing: 0.3px;
        }

        .price-change {
            margin-left: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }

        .change-up {
            color: #4ade80;
        }

        .change-down {
            color: #f87171;
        }

        .change-neutral {
            color: #94a3b8;
        }

        .update-info {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.15);
            margin-left: 35px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .live-indicator {
            width: 6px;
            height: 6px;
            background: #4ade80;
            border-radius: 50%;
            animation: subtlePulse 2s ease-in-out infinite;
        }

        @keyframes subtlePulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        .separator {
            color: rgba(255, 255, 255, 0.4);
            margin: 0 15px;
            font-weight: 300;
        }



        /* Custom Dropdown Toggle */
        .custom-dropdown-toggle::after {
            display: none !important;
        }

        .custom-dropdown-toggle {
            background: none !important;
            color: #fff !important;
            font-weight: 600;
            transition: color 0.2s;
        }

        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus {
            color: white !important;
        }

        /* Custom Dropdown Menu */
        .custom-dropdown-menu {
            background: linear-gradient(135deg, #370248 70%, #b53fc2 100%);
            border: none;
            min-width: 180px;
            box-shadow: 0 6px 24px rgba(55, 2, 72, 0.18);
            padding: 0.5rem 0;
            border-radius: 0.7rem;
            margin-top: 0.5rem;
        }

        .custom-dropdown-item {
            color: #fff;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 0.4rem;
            transition: background 0.2s, color 0.2s;
        }

        .custom-dropdown-item:hover,
        .custom-dropdown-item:focus {
            background: rgba(181, 63, 194, 0.18);
            color: #d4af37;
        }


        .gold-mega-dropdown {
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            z-index: 1050;
            padding: 0;
            margin: 0;
            border: none;
            background: linear-gradient(135deg, #370248 70%, #b53fc2 100%);
            border-radius: 0.7rem;
            box-shadow: 0 6px 24px rgba(55, 2, 72, 0.18);
            display: none;
            min-height: 320px;
            min-width: 900px;
            color: #fff;
            animation: fadeInDropdown 0.3s;
        }

        @keyframes fadeInDropdown {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-item.gold-dropdown:hover .gold-mega-dropdown,
        .nav-item.gold-dropdown:focus-within .gold-mega-dropdown,
        .nav-item.gold-dropdown .gold-mega-dropdown.show {
            display: flex;
        }

        .gold-mega-dropdown .dropdown-left {
            background: #f8f5fa;
            color: #370248;
            padding: 30px 0 30px 20px;
            min-width: 210px;
            border-top-left-radius: 0.7rem;
            border-bottom-left-radius: 0.7rem;
        }

        .gold-mega-dropdown .dropdown-left ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .gold-mega-dropdown .dropdown-left li {
            padding: 8px 0 8px 10px;
            font-size: 1.02rem;
            border-radius: 5px 0 0 5px;
            cursor: pointer;
            transition: background 0.16s;
            font-family: 'Cormorant Garamond', serif;
            margin: 5px 0px;
        }

        .gold-mega-dropdown .dropdown-left li.active,
        .gold-mega-dropdown .dropdown-left li:hover {
            background: #e6dbf3;
            color: #b53fc2;
            font-weight: 700;
        }

        .gold-mega-dropdown .dropdown-right {
            flex: 1;
            display: flex;
            gap: 50px;
            padding: 30px 40px;
            background: transparent;
        }

        .gold-mega-dropdown .dropdown-section {
            min-width: 220px;
        }

        .gold-mega-dropdown .dropdown-section h6 {
            font-family: 'Playfair Display', serif !important;
            font-weight: 700 !important;
            color: #d4af37 !important;
            font-size: 1.15rem !important;
            margin-bottom: 18px !important;
        }

        .gold-mega-dropdown .dropdown-item-style {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 17px;
            color: #fff;
            text-decoration: none;
            font-size: 1.02rem;
            transition: color 0.16s;
            font-family: 'Cormorant Garamond', serif;
            border-radius: 6px;
            padding: 5px 7px;
        }

        .gold-mega-dropdown .dropdown-item-style img {
            width: 36px;
            height: 36px;
            object-fit: contain;
            border-radius: 7px;
            border: 1px solid #e8d6f3;
            background: #fff;
        }

        .gold-mega-dropdown .dropdown-item-style:hover {
            color: #d4af37;
            background: rgba(212, 175, 55, 0.10);
        }

        /* Responsive for mega dropdown */
        @media (max-width: 1100px) {
            .gold-mega-dropdown {
                min-width: 100vw;
                left: 0;
                right: 0;
                border-radius: 0;
            }

            .gold-mega-dropdown .dropdown-right {
                gap: 15px;
                padding: 20px 10px;
            }
        }

        @media (max-width: 991.98px) {
            .gold-mega-dropdown {
                flex-direction: column;
                min-width: 100vw;
                left: 0;
                right: 0;
                border-radius: 0;
            }

            .dropdown-left {

                border-radius: 0;
                padding: 15px 0 15px 15px;
                width: 100%;
                min-width: 0;
                box-sizing: border-box;
                overflow-x: auto;
            }

            .gold-mega-dropdown .dropdown-right {
                flex-direction: column;
                gap: 0;
                padding: 15px 10px;
                width: 100%;
                min-width: 0;
            }

            .gold-mega-dropdown .dropdown-left {}

            /* .gold-mega-dropdown .dropdown-right {} */
        }

        @media (max-width: 767.98px) {
            .navbar-brand img {
                width: 32px;
                height: 32px;
            }

            .search-bar {
                max-width: 180px;
                width: 60%;
            }

            .gold-mega-dropdown {
                width: 100%;
                flex-direction: column;
                left: 0;
                right: 0;
                border-radius: 0;
                min-height: unset;
            }

            .gold-mega-dropdown .dropdown-left,
            .gold-mega-dropdown .dropdown-right {
                padding: 10px 7px;
            }

            .gold-mega-dropdown .dropdown-item-style img {
                width: 28px;
                height: 28px;
            }

            .gold-mega-dropdown .dropdown-section {
                min-width: 140px;
            }

            .rates-header {
                font-size: 1rem;
                padding: 8px 0;
            }

            .update-info {
                margin-left: 10px;
                font-size: 0.75rem;
                padding: 3px 8px;
            }

            .rate-segment {
                margin-right: 18px;
                padding: 5px 8px;
            }

            .metal-name {
                min-width: 45px;
                font-size: 0.8rem;
            }

            .metal-price,
            .price-change {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-brand img {
                width: 26px;
                height: 26px;
            }

            .search-bar {
                max-width: 120px;
                width: 70%;
            }

            .icon-btn {
                font-size: 1rem;
                padding: 0 2px;
            }

            .gold-mega-dropdown .dropdown-section h6 {
                font-size: 1rem !important;
                margin-bottom: 10px !important;
            }

            .gold-mega-dropdown .dropdown-section {
                min-width: 100px;
            }

            .gold-mega-dropdown .dropdown-item-style {
                font-size: 0.9rem;
                gap: 7px;
                margin-bottom: 10px;
                padding: 3px 4px;
            }

            .gold-mega-dropdown .dropdown-item-style img {
                width: 20px;
                height: 20px;
            }

            .rates-ticker {
                font-size: 0.7rem;
            }

            .rate-segment {
                margin-right: 10px;
                padding: 3px 4px;
            }

            .update-info {
                font-size: 0.65rem;
                padding: 2px 5px;
                margin-left: 5px;
            }

            .separator {
                margin: 0 5px;
            }
        }

        @media (max-width: 767.98px) {
            .gold-mega-dropdown {
                position: static;
                min-width: 100vw;
            }

            .gold-mega-dropdown .dropdown-left,
            .gold-mega-dropdown .dropdown-right {
                padding: 10px 7px;
            }

            .gold-mega-dropdown .dropdown-item-style img {
                width: 28px;
                height: 28px;
            }
        }

        .gold-mega-dropdown {
            width: 100%;
            min-width: 0;
            overflow-x: auto;
            /* prevent overflow */
        }

        @media (max-width: 991.98px) {}

        /* Unique Code for gold diamond silver  */
        .jewellery-mega-dropdown-unique {
            position: relative;
        }

        .jewellery-dropdown-toggle-unique::after {
            display: none !important;
        }

        .jewellery-dropdown-toggle-unique {
            background: none !important;
            color: #fff !important;
            font-weight: 600;
        }

        .jewellery-mega-dropdown-menu-unique {
            display: none;
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            z-index: 1050;
            background: linear-gradient(135deg, #370248 70%, #b53fc2 100%);
            border-radius: 0.7rem;
            box-shadow: 0 6px 24px rgba(55, 2, 72, 0.18);
            min-height: 320px;
            min-width: 900px;
            color: #fff;
            animation: fadeInDropdown 0.3s;
        }

        .jewellery-mega-dropdown-unique:hover .jewellery-mega-dropdown-menu-unique,
        .jewellery-mega-dropdown-unique:focus-within .jewellery-mega-dropdown-menu-unique,
        .jewellery-mega-dropdown-menu-unique.show {
            display: flex;
        }

        .dropdown-left-unique {
            background: #f8f5fa;
            color: #370248;
            padding: 30px 0 30px 20px;
            min-width: 210px;
            border-top-left-radius: 0.7rem;
            border-bottom-left-radius: 0.7rem;
        }

        .dropdown-left-unique ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dropdown-left-unique li {
            padding: 8px 0 8px 10px;
            font-size: 1.02rem;
            border-radius: 5px 0 0 5px;
            cursor: pointer;
            transition: background 0.16s;
            font-family: 'Cormorant Garamond', serif;
            margin: 5px 0px;
        }

        .dropdown-left-unique li.active,
        .dropdown-left-unique li:hover {
            background: #e6dbf3;
            color: #b53fc2;
            font-weight: 700;
        }

        .dropdown-right-unique {
            flex: 1;
            display: flex;
            gap: 50px;
            padding: 30px 40px;
            background: transparent;
        }

        .dropdown-section-unique {
            min-width: 220px;
        }

        .dropdown-section-unique h6 {
            font-family: 'Playfair Display', serif !important;
            font-weight: 700 !important;
            color: #d4af37 !important;
            font-size: 1.15rem !important;
            margin-bottom: 18px !important;
        }

        .dropdown-item-style-unique {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 17px;
            color: #fff;
            text-decoration: none;
            font-size: 1.02rem;
            transition: color 0.16s;
            font-family: 'Cormorant Garamond', serif;
            border-radius: 6px;
            padding: 5px 7px;
        }

        .dropdown-item-style-unique img {
            width: 36px;
            height: 36px;
            object-fit: contain;
            border-radius: 7px;
            border: 1px solid #e8d6f3;
            background: #fff;
        }

        .dropdown-item-style-unique:hover {
            color: #d4af37;
            background: rgba(212, 175, 55, 0.10);
        }

        .dropdown-tab-content-unique {
            flex-wrap: wrap;
        }

        @media (max-width: 1100px) {
            .jewellery-mega-dropdown-menu-unique {
                min-width: 100vw;
                left: 0;
                right: 0;
                border-radius: 0;
            }

            .dropdown-right-unique {
                gap: 15px;
                padding: 20px 10px;
            }
        }

        @media (max-width: 991.98px) {
            .jewellery-mega-dropdown-menu-unique {
                flex-direction: column;
                min-width: 100vw;
                left: 0;
                right: 0;
                border-radius: 0;
            }

            .dropdown-left-unique {
                border-radius: 0;
                padding: 15px 0 15px 15px;
                width: 100%;
                min-width: 0;
                box-sizing: border-box;
                overflow-x: auto;
            }

            .dropdown-right-unique {
                flex-direction: column;
                gap: 0;
                padding: 15px 10px;
                width: 100%;
                min-width: 0;
            }
        }

        @media (max-width: 767.98px) {
            .jewellery-mega-dropdown-menu-unique {
                width: 100%;
                flex-direction: column;
                left: 0;
                right: 0;
                border-radius: 0;
                min-height: unset;
            }

            .dropdown-left-unique,
            .dropdown-right-unique {
                padding: 10px 7px;
            }

            .dropdown-item-style-unique img {
                width: 28px;
                height: 28px;
            }

            .dropdown-section-unique {
                min-width: 140px;
            }
        }

        @media (max-width: 575.98px) {
            .dropdown-section-unique h6 {
                font-size: 1rem !important;
                margin-bottom: 10px !important;
            }

            .dropdown-section-unique {
                min-width: 100px;
            }

            .dropdown-item-style-unique {
                font-size: 0.9rem;
                gap: 7px;
                margin-bottom: 10px;
                padding: 3px 4px;
            }

            .dropdown-item-style-unique img {
                width: 20px;
                height: 20px;
            }
        }

        .jewellery-mega-dropdown-menu-unique {
            width: 100%;
            min-width: 0;
            overflow-x: auto;
        }

        .dropdown-item:hover {
            color: white !important;

        }
    </style>

    <style>
        #star-rating i {
            cursor: pointer;
            transition: color 0.2s;
        }
    </style>

</head>

<body>
    <!-- Gold Rates Bar -->
    <div class="gold-rates-bar">
        <div class="container-fluid d-flex align-items-center">
            <div class="scroll-wrapper">
                <div class="rates-ticker">
                    <?php
                    $output = [];

                    // Only process 'gold' and 'silver'
                    foreach (['gold', 'silver'] as $metal) {
                        if (!isset($rates[$metal]))
                            continue;

                        // Get top 3 rates
                        $topRates = array_slice($rates[$metal], 0, 3, true);

                        foreach ($topRates as $karat => $price) {
                            $metalLabel = ucfirst($metal);
                            $rateLabel = is_numeric($karat) ? "{$karat}K $metalLabel" : strtoupper($karat) . " $metalLabel";
                            $rateValue = "₹" . number_format($price, 2) . "/gm";

                            $output[] = '
            <div class="rate-segment">
                <span class="metal-name">' . $rateLabel . '</span>
                <span class="metal-price">' . $rateValue . '</span>
            </div>';
                        }
                    }

                    // Output segments with separators
                    $total = count($output);
                    foreach ($output as $index => $segmentHtml) {
                        echo $segmentHtml;

                        // Add separator except after last item
                        if ($index < $total - 1) {
                            echo '<span class="separator">|</span>';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Top Bar -->
    <div class="bg-white border-bottom py-1">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-3" href="#">
                <img src="<?php echo base_url('assets/navbar/logo.png'); ?>" alt="Logo" width="40" height="40"
                    class="rounded-circle">

            </a>
            <!-- Search Bar -->
            <form class="search-bar d-flex" method="GET" action="<?= base_url('Products/Search') ?>">
                <div class="input-group">
                    <input type="text" name="search" class="form-control border border-end-0" placeholder="Search Here"
                        aria-label="Search">
                    <button class="btn border border-start-0" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>


            <div class="flex-grow-1"></div>
            <!-- Icons -->
            <div class="d-flex align-items-center">
                <a href="<?php echo base_url('UserController/home'); ?>" class="icon-btn px-1"><i
                        class="bi bi-shop"></i></a>
                <!-- Wallet -->

                <a class="icon-btn px-1 <?php echo !$this->session->userdata('user_email') ? 'require-login' : ''; ?>"
                    href="javascript:void(0);" <?php if ($this->session->userdata('user_email')): ?>
                        data-bs-toggle="modal" data-bs-target="#walletModal" <?php endif; ?>>
                    <i class="bi bi-wallet2"></i>
                    </i>
                </a>


                <!-- Wishlist -->
                <a class="icon-btn px-1 position-relative <?php echo !$this->session->userdata('user_email') ? 'require-login' : ''; ?>"
                    href="<?php echo $this->session->userdata('user_email') ? base_url('UserController/wishlist') : 'javascript:void(0);'; ?>">

                    <i class="bi bi-heart fs-5"></i>

                    <?php if ($this->session->userdata('user_email')): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.6rem;">
                            <?php echo $likeCount; ?>
                        </span>
                    <?php endif; ?>
                </a>




                <!-- Cart -->
                <a class="icon-btn px-1 position-relative <?php echo !$this->session->userdata('user_email') ? 'require-login' : ''; ?>"
                    href="<?php echo $this->session->userdata('user_email') ? base_url('UserController/finalcart') : 'javascript:void(0);'; ?>">

                    <i class="bi bi-cart fs-5"></i>

                    <?php if ($this->session->userdata('user_email')): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.6rem;">
                            <?php echo $cartCount; ?>
                        </span>
                    <?php endif; ?>
                </a>


                <!-- Feedback Button (Trigger Modal) -->
                <a href="#" class="icon-btn px-1" data-bs-toggle="modal" data-bs-target="#feedbackModal"
                    title="Feedback">
                    <i class="bi bi-chat-left-text"></i>
                </a>

                <a href="<?php echo base_url('UserController/profile'); ?>" class="icon-btn px-1"><i
                        class="bi bi-person"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e358e; color: white;">
                    <h5 class="modal-title" id="walletModalLabel">My Wallet</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <i class="bi bi-wallet2 fs-1" style="color: #5e358e"></i>
                    </div>
                    <h4>Loyalty Points</h4>
                    <?php
                    $loyalty_points = 0;
                    $email = $this->session->userdata('user_email');
                    if ($email) {
                        $customer = $this->db->get_where('customers', ['email' => $email])->row();
                        if ($customer && isset($customer->loyalty_points)) {
                            $loyalty_points = $customer->loyalty_points;
                        }
                    }
                    ?>
                    <h1 class="text-dark fw-bold"><?= $loyalty_points ?></h1>
                    <p class="text-muted small">Use loyalty points for discounts at checkout</p>
                    <div class="mt-3">
                        <a href="<?php echo base_url('UserController/finalcart'); ?>" class="btn btn-dark">Use
                            Points</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->

    <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler text-dark bg-light border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white px-3"
                            href="<?php echo base_url('UserController/home'); ?>">Home</a>
                    </li>

                    <?php
                    $groupedDropdowns = [];

                    foreach ($navbarData as $item) {
                        $type = $item->type;
                        $category = $item->category_name;

                        if (!isset($groupedDropdowns[$type][$category])) {
                            $groupedDropdowns[$type][$category] = [
                                'style_subcategories' => [],
                                'occasion_subcategories' => []
                            ];
                        }

                        if (!empty($item->style_subcategories)) {
                            $groupedDropdowns[$type][$category]['style_subcategories'] = array_merge(
                                $groupedDropdowns[$type][$category]['style_subcategories'],
                                explode(',', $item->style_subcategories)
                            );
                        }

                        if (!empty($item->occasion_subcategories)) {
                            $groupedDropdowns[$type][$category]['occasion_subcategories'] = array_merge(
                                $groupedDropdowns[$type][$category]['occasion_subcategories'],
                                explode(',', $item->occasion_subcategories)
                            );
                        }
                    }
                    ?>

                    <?php foreach ($groupedDropdowns as $type => $categories): ?>
                        <li class="nav-item jewellery-mega-dropdown-unique position-static dropdown">
                            <a class="nav-link text-white px-3 d-flex align-items-center gap-1 jewellery-dropdown-toggle-unique dropdown-toggle"
                                href="#" id="dropdown-<?php echo $type; ?>" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><?php echo $type; ?></span>
                            </a>

                            <div class="dropdown-menu jewellery-mega-dropdown-menu-unique"
                                aria-labelledby="dropdown-<?php echo $type; ?>" data-dropdown-id="<?php echo $type; ?>">

                                <div class="dropdown-left-unique">
                                    <ul>
                                        <?php $first = true; ?>
                                        <?php foreach ($categories as $categoryName => $subcategories): ?>
                                            <li class="<?= $first ? 'active' : '' ?>" data-tab="<?php echo $categoryName; ?>">
                                                <?php echo $categoryName; ?>
                                            </li>
                                            <?php $first = false; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="dropdown-right-unique">
                                    <?php $firstContent = true; ?>
                                    <?php foreach ($categories as $categoryName => $subcategories): ?>
                                        <div class="dropdown-tab-content-unique tab-<?php echo $categoryName; ?>"
                                            style="display: <?= $firstContent ? 'flex' : 'none'; ?>;">
                                            <?php if (!empty($subcategories['style_subcategories'])): ?>
                                                <div class="dropdown-section-unique">
                                                    <h6>Shop by Style</h6>
                                                    <?php foreach ($subcategories['style_subcategories'] as $style): ?>
                                                        <a href="#" class="dropdown-item dropdown-item-style-unique"
                                                            data-main="<?php echo $type; ?>" data-sub="<?php echo $categoryName; ?>"
                                                            data-actual="<?php echo strtolower(str_replace([' ', ':'], ['-', ''], $style)); ?>">
                                                            <!-- <img src="<?php echo base_url('assets/img/dummy.jpg'); ?>"
                                                                alt="<?php //echo htmlspecialchars($style); 
                                                                                ?>"> -->
                                                            <?php echo htmlspecialchars($style); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($subcategories['occasion_subcategories'])): ?>
                                                <div class="dropdown-section-unique">
                                                    <h6>Shop by Occasion</h6>
                                                    <?php foreach ($subcategories['occasion_subcategories'] as $occasion): ?>
                                                        <a href="#" class="dropdown-item dropdown-item-style-unique"
                                                            data-main="<?php echo $type; ?>" data-sub="<?php echo $categoryName; ?>"
                                                            data-actual="<?php echo strtolower(str_replace([' ', ':'], ['-', ''], $occasion)); ?>">
                                                            <!-- <img src="<?php echo base_url('assets/img/dummy.jpg'); ?>"
                                                                alt="<?php //echo htmlspecialchars($occasion); 
                                                                                ?>"> -->
                                                            <?php echo htmlspecialchars($occasion); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php $firstContent = false; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>



                    <li class="nav-item">
                        <a class="nav-link text-white px-3"
                            href="<?php echo base_url('UserController/collections'); ?>">Collections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3"
                            href="<?php echo base_url('UserController/goldcoins'); ?>">Gold Coin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3"
                            href="<?php echo base_url('UserController/astrogems'); ?>">Astro Gems</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3"
                            href="<?php echo base_url('UserController/gallery'); ?>">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3" href="<?php echo base_url('UserController/scheme'); ?>">Gold
                            Saving Scheme</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white px-3 d-flex align-items-center gap-1 " href="#"
                            id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>More</span>
                            <i class="bi bi-chevron-down" style="font-size:0.5rem;"></i>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end"
                            aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item custom-dropdown-item " style="color:white;"
                                    href="<?php echo base_url('UserController/PiercingService'); ?>">Piercing
                                    Services</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" style="color:white;"
                                    href="<?php echo base_url('UserController/RepairingService'); ?>">Repairing
                                    Services</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" style="color:white;"
                                    href="<?php echo base_url('UserController/ExchangeProgram'); ?>">Exchange
                                    Program</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" style="color:white;"
                                    href="<?php echo base_url('UserController/LoyalityPoints'); ?>">Loyality Points</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e358e; color: white;">
                    <h5 class="modal-title" id="feedbackModalLabel">We Value Your Feedback ✨</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"
                        style="opacity: 0.8;"></button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm">
                        <div class="mb-3">
                            <label for="feedback_full_name" class="form-label">Your Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="feedback_full_name" name="feedback_full_name"
                                placeholder="Enter your full name">
                        </div>
                        <div class="mb-3">
                            <label for="feedback_email_address" class="form-label">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="feedback_email_address"
                                name="feedback_email_address" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">How do you rate your experience? <span
                                    class="text-danger">*</span></label>
                            <div id="star-rating" class="text-warning fs-4">
                                <i class="bi bi-star" data-value="1"></i>
                                <i class="bi bi-star" data-value="2"></i>
                                <i class="bi bi-star" data-value="3"></i>
                                <i class="bi bi-star" data-value="4"></i>
                                <i class="bi bi-star" data-value="5"></i>
                            </div>
                            <input type="hidden" id="feedback_experience_rating" name="feedback_experience_rating">
                        </div>

                        <div class="mb-3">
                            <label for="feedback_user_message" class="form-label">Your Message <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="feedback_user_message" name="feedback_user_message"
                                rows="4" placeholder="Share your thoughts..."></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-elegant"
                                style="background-color:#5e358e; color: white;">Submit Feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Define baseUrl to match .htaccess and products.js
            const baseUrl = '<?php echo base_url(); ?>'; // Outputs http://localhost/Sona_Chandi_Jwellers/

            // Handle mega-dropdown tab switching
            document.querySelectorAll('.jewellery-mega-dropdown-unique').forEach(function (dropdown) {
                const dropdownMenu = dropdown.querySelector('.jewellery-mega-dropdown-menu-unique');
                const leftTabs = dropdown.querySelectorAll('.dropdown-left-unique li');
                const tabContents = dropdown.querySelectorAll('.dropdown-tab-content-unique');

                // Initialize first tab
                if (tabContents.length) tabContents[0].style.display = 'flex';

                // Handle tab clicks
                leftTabs.forEach(function (tab) {
                    tab.addEventListener('click', function (e) {
                        e.stopPropagation();
                        leftTabs.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                        tabContents.forEach(tc => tc.style.display = 'none');
                        const tabName = this.getAttribute('data-tab');
                        const showTab = dropdown.querySelector('.tab-' + tabName);
                        if (showTab) showTab.style.display = 'flex';
                    });
                });

                // Sync tab with dropdown show
                dropdownMenu.addEventListener('shown.bs.dropdown', function () {
                    const activeTab = dropdown.querySelector('.dropdown-left-unique li.active');
                    if (activeTab) {
                        const tabName = activeTab.getAttribute('data-tab');
                        tabContents.forEach(tc => tc.style.display = 'none');
                        const showTab = dropdown.querySelector('.tab-' + tabName);
                        if (showTab) showTab.style.display = 'flex';
                    }
                });
            });

            // Handle SPA navigation for dropdown items
            document.querySelectorAll('.dropdown-item-style-unique').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const main = link.getAttribute('data-main');
                    const sub = link.getAttribute('data-sub');
                    const actual = link.getAttribute('data-actual');
                    const href = `${baseUrl}products/${main}/${sub}/${actual}`;
                    console.log('Navigating to:', href);
                    history.pushState({
                        main,
                        sub,
                        actual
                    }, '', href);
                    if (typeof renderProducts === 'function') {
                        renderProducts(main, sub, actual);
                    } else {
                        console.log('renderProducts undefined, falling back to server');
                        window.location.href = href;
                    }
                });
            });

            // Handle browser back/forward navigation
            window.addEventListener('popstate', (event) => {
                console.log('Popstate triggered:', event.state);
                if (event.state && event.state.main && typeof renderProducts === 'function') {
                    renderProducts(event.state.main, event.state.sub, event.state.actual);
                } else {
                    const path = window.location.pathname;
                    const match = path.match(/\/Sona_Chandi_Jwellers\/products\/([^/]+)\/([^/]+)\/([^/]+)/);
                    if (match) {
                        const [, main, sub, actual] = match;
                        if (typeof renderProducts === 'function') {
                            renderProducts(main, sub, actual);
                        } else {
                            console.log('Reloading page for:', path);
                            window.location.href = path; // Use full URL
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.require-login').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent default link behavior

                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: 'Please login to view !',
                        confirmButtonText: 'OK',
                        showCancelButton: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to homepage (update the URL if needed)
                            window.location.href = "<?php echo base_url('UserController/home'); ?>";
                        }
                    });
                });
            });
        });
    </script>

    <!-- jQuery must be included before the script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Feedback Star Rating Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#star-rating i');
            const ratingInput = document.getElementById('feedback_experience_rating');

            stars.forEach((star, idx) => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.getAttribute('data-value'));
                    ratingInput.value = value;

                    stars.forEach((s, i) => {
                        s.classList.remove('bi-star-fill');
                        s.classList.add('bi-star');
                        if (i < value) {
                            s.classList.remove('bi-star');
                            s.classList.add('bi-star-fill');
                        }
                    });
                });

                star.addEventListener('mouseover', () => {
                    const value = parseInt(star.getAttribute('data-value'));
                    stars.forEach((s, i) => {
                        s.classList.remove('bi-star-fill');
                        s.classList.add('bi-star');
                        if (i < value) {
                            s.classList.remove('bi-star');
                            s.classList.add('bi-star-fill');
                        }
                    });
                });

                star.addEventListener('mouseout', () => {
                    const selected = parseInt(ratingInput.value);
                    stars.forEach((s, i) => {
                        s.classList.remove('bi-star-fill');
                        s.classList.add('bi-star');
                        if (i < selected) {
                            s.classList.remove('bi-star');
                            s.classList.add('bi-star-fill');
                        }
                    });
                });
            });
        });
    </script>

    <!-- Feedback Form Submission Script -->
    <script>
        $('#feedbackForm').on('submit', function (e) {
            e.preventDefault();

            const name = $('#feedback_full_name').val().trim();
            const email = $('#feedback_email_address').val().trim();
            const rating = $('#feedback_experience_rating').val();
            const message = $('#feedback_user_message').val().trim();

            if (!name) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Name is required',
                    text: 'Please enter your full name.',
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            if (!email) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Email is required',
                    text: 'Please enter your email address.',
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            if (!rating) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Rating is required',
                    text: 'Please give a rating for your experience.',
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            if (!message) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Message is required',
                    text: 'Please write a feedback message.',
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }


            // Send data via AJAX to controller
            $.ajax({
                type: 'POST',
                url: '<?= base_url('UserController/submitFeedback') ?>',
                data: {
                    name: name,
                    email: email,
                    rating: rating,
                    message: message
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank you!',
                        text: 'Your feedback has been submitted.',
                        showConfirmButton: false,    // hide OK button
                        timer: 2000                  // auto close after 2 seconds
                    });
                    $('#feedbackForm')[0].reset();
                    $('#feedback_experience_rating').val('');
                    $('#star-rating i').removeClass('bi-star-fill').addClass('bi-star');
                    $('#feedbackModal').modal('hide');
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong while submitting your feedback.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });
    </script>



    <!-- SweetAlert CDN (put in <head> or before </body>) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>