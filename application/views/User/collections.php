<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Style Showcase - Jewelry</title>
    <?php $this->load->view('common/Commonlinks'); ?>
    <style>
        :root {
            --primary: #5E358E;
            --secondary: #f5f5f5;
            --accent: #b39ddb;
            --text-dark: #2d1a47;
            --text-light: #fff;
            --highlight: #e1bee7;
            --button: #42065680;
            --gold: #66456c;
            --gold-gradient: linear-gradient(90deg, #937fa6 0%, #7c3897 100%);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--secondary);
            color: var(--text-dark);

        }


        .hero {
            background: var(--gold-gradient);
            color: var(--text-light);
            padding: 60px 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;

        }

        .hero p {
            color: var(--highlight);
        }

        .btn-style {
            background-color: var(--button);
            color: var(--text-light);
            border: none;
        }

        .btn-style:hover {
            background-color: var(--gold);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1rem;
            color: var(--text-dark);
        }

        .card-text {
            color: var(--primary);
            font-weight: 500;
        }


        .occasion-img {
            height: 300px;
            object-fit: cover;
            transition: transform 0.4s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }

        .occasion-card:hover .occasion-img {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .occasion-card {
            transition: transform 0.3s ease;
        }

        .occasion-card:hover {
            transform: translateY(-5px);
        }

        @media(max-width: 800px) {
            .hero-image {
                display: none;
            }
        }

        .dropdown-options {
            display: none;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.15);
            /* semi-transparent white */
            backdrop-filter: blur(10px);
            /* blur effect */
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            position: absolute;
            z-index: 10;
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            transform: translate(-50%, -50%);
            padding: 8px 0;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            width: 200px;
            text-align: center;
            transition: all 0.3s ease-in-out;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .dropdown-options a {
            padding: 8px 10px;
            margin: 4px 0;
            border-radius: 6px;
            color: #4a148c;
            font-weight: 500;
            text-decoration: none;
            background: #f3e5f5;
            transition: background 0.3s;
            background: rgba(255, 255, 255, 0.2);
            /* transparent */
        }

        .dropdown-options a:hover {
            background-color: #e1bee7;
        }

        .occasion-card:hover .dropdown-options {
            display: flex;
        }

        .occasion-img {
            cursor: pointer;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</head>

<body>


    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 style="font-family: Cormorant Garamond;">Style That Speaks</h1>
                    <p class="lead mb-4" style="font-family: garet;">Discover bold, beautiful, and brilliant pieces to
                        elevate your look.</p>
                    <a href="#" class="btn btn-style px-4 py-2">Shop Now</a>
                </div>
                <div class="col-md-6 text-center hero-image">
                    <img src=<?php echo base_url("assets\Images\collections\hero-image.png") ?> alt="Jewelry Model"
                        class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <!-- Occasion-based Collections -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4" style="font-family: Cormorant Garamond; color: #420A5C !important;">Shop By Occasion</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card" id="occasionCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/engagement.jpg'); ?>"
                            class="img-fluid mb-2 occasion-img" alt="Engagement" id="occasionImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Engagement</p>

                        <div class="dropdown-options" id="engagementDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=engagement'); ?>"> Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=engagement'); ?>"> Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=engagement'); ?>"> Diamond</a>
                        </div>

                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card" id="weddingCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/weeding.jpg'); ?>"
                            class="img-fluid mb-2 occasion-img" alt="Wedding" id="weddingImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Wedding</p>

                        <div class="dropdown-options" id="weddingDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=wedding'); ?>">Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=wedding'); ?>">Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=wedding'); ?>">Diamond</a>
                        </div>
                    </div>

                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card" id="anniversaryCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/anniversary.jpg'); ?>"
                            class="img-fluid mb-2 occasion-img" alt="Anniversary" id="anniversaryImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Anniversary</p>

                        <div class="dropdown-options" id="anniversaryDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=anniversary'); ?>">Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=anniversary'); ?>">Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=anniversary'); ?>">Diamond</a>
                        </div>
                    </div>

                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card position-relative" id="birthdayCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/birthday.jpg'); ?>"
                            class="img-fluid mb-2 rounded occasion-img" alt="Birthday" id="birthdayImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Birthday</p>

                        <div class="dropdown-options" id="birthdayDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=birthday'); ?>">Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=birthday'); ?>">Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=birthday'); ?>">Diamond</a>
                        </div>
                    </div>

                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card position-relative" id="festivalCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/festival.jpg'); ?>"
                            class="img-fluid mb-2 rounded occasion-img" alt="Festivals" id="festivalImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Festivals</p>

                        <div class="dropdown-options" id="festivalDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=festivals'); ?>">Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=festivals'); ?>">Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=festivals'); ?>">Diamond</a>
                        </div>
                    </div>

                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="occasion-card position-relative" id="dailyCard">
                        <img src="<?php echo base_url('assets/Images/collections/festivities/dailywear.jpg'); ?>"
                            class="img-fluid mb-2 rounded occasion-img" alt="Daily Wear" id="dailyImage">

                        <p class="fw-semibold" style="font-family: garet; color: #420A5C;">Daily Wear</p>

                        <div class="dropdown-options" id="dailyDropdown">
                            <a href="<?php echo base_url('products?type=gold&tags=daily wear'); ?>">Gold</a>
                            <a href="<?php echo base_url('products?type=silver&tags=daily wear'); ?>">Silver</a>
                            <a href="<?php echo base_url('products?type=diamond&tags=daily wear'); ?>">Diamond</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Trending Products -->
    <!-- <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-4" style="font-family: Cormorant Garamond; color: #420A5C !important;">Trending
                Products</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm product-card">
                        <img src=<?php echo base_url("assets\Images\collections\\trending\\ring.jpg") ?>
                            class="card-img-top product-img" alt="Crystal Ring">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-family: Cormorant Garamond; color: #420A5C !important;">
                                Crystal Ring</h5>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm product-card">
                        <img src=<?php echo base_url("assets\Images\collections\\trending\\earrings.jpg") ?>
                            class="card-img-top product-img" alt="Diamond Earrings">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-family: Cormorant Garamond; color: #420A5C !important;">
                                Diamond Earrings</h5>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm product-card">
                        <img src=<?php echo base_url("assets\Images\collections\\trending\\pearl.jpg") ?>
                            class="card-img-top product-img" alt="Pearl Pendant">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-family: Cormorant Garamond; color: #420A5C !important;">
                                Pearl Pendant</h5>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100  shadow-sm product-card">
                        <img src=<?php echo base_url("assets\Images\collections\\trending\\bracelet.jpg") ?>
                            class="card-img-top product-img" alt="Gold Bracelet">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-family: Cormorant Garamond; color: #420A5C !important;">
                                Gold Bracelet</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->
    <script>
        const image = document.getElementById("occasionImage");
        const dropdown = document.getElementById("dropdownOptions");

        image.addEventListener("click", function (e) {
            dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
            e.stopPropagation(); // Prevent bubbling
        });

        // Hide dropdown on click outside
        window.addEventListener("click", function () {
            dropdown.style.display = "none";
        });

        // Prevent closing when clicking inside dropdown
        dropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    </script>

</body>

</html>