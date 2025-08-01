<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php $this->load->view('common/Commonlinks'); ?>

    <link rel="stylesheet" href="<?php echo base_url('assets\styles.css'); ?>">

    <style>
        .cat-img-zoom {
            transition: transform 0.39s cubic-bezier(.32, 1.49, .61, 1), box-shadow 0.23s;
            border-radius: 50%;
            box-shadow: 0 2px 14px rgba(140, 68, 202, 0.13);
            cursor: pointer;
        }

        .cat-img-zoom:hover {
            transform: scale(1.20) rotate(-2deg);
            box-shadow: 0 4px 24px rgba(140, 68, 202, 0.26);
            z-index: 2;
        }

        /* Last Brand Cards  */
        .card {
            border-radius: 15px;
            overflow: hidden;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* height: 450px; */
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            height: 100%;
            object-fit: cover;
            flex-grow: 1;
        }

        .card-body {
            position: relative;
            flex-shrink: 0;
        }

        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade {
            opacity: 0;
            animation: fadeSlideUp 0.8s ease-out forwards;
            animation-delay: 0s;
            /* Can be overridden inline */
        }

        .brand-hover {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            transform-origin: center center;
            border-radius: 12px;
            cursor: pointer;
        }

        .brand-hover:hover {
            transform: scaleY(1.15);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.25);
        }

        .card-container {
            transform-style: preserve-3d;
        }

        .card-container:nth-child(odd) {
            margin-top: 50px;
        }

        .card-container:nth-child(even) {
            margin-bottom: 50px;
        }
    </style>

    <style>
        .carousel-img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            object-position: center;
        }

        /* Medium screens (tablets) */
        @media (max-width: 992px) {
            .carousel-img {
                height: 450px;
            }
        }

        /* Small screens (phones) */
        @media (max-width: 576px) {
            .carousel-img {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>


    <!-- Carousel Section -->
    <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000"
        data-bs-pause="false">
        <div class="carousel-inner">
            <?php foreach ($heroBanner as $index => $banner): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= base_url('uploads/hearo_banners/' . $banner->image) ?>" class="d-block w-100 carousel-img"
                        alt="banner<?= $index + 1 ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Catalogue Section -->
    <section class="py-4 ">
        <div class="container text-center">
            <h2 class="mb-5  fw-bold">Catalogue</h2>
            <div class="row justify-content-center">
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (6).png'); ?>"
                            class=" cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Rings"
                            onclick="window.location.href='<?php echo base_url('products?category=Rings'); ?>'">
                    </div>
                    <p class="mt-2 text-center text-dark ">Rings</p>
                </div>
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (5).png'); ?>"
                            class="cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Nose Pins"
                            onclick="window.location.href='<?php echo base_url('products?category=nose+pin%2Cnose+pins'); ?>'">
                    </div>
                    <p class="mt-2 text-center text-dark">Nose Pins</p>
                </div>
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (1).png'); ?>"
                            class="cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Earring"
                            onclick="window.location.href='<?php echo base_url('products?category=Earring'); ?>'">
                    </div>
                    <p class="mt-2 text-center text-dark">Earring</p>
                </div>
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (2).png'); ?>"
                            class="cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Bangles"
                            onclick="window.location.href='<?php echo base_url('products?category=Bangles'); ?>'">
                    </div>
                    <p class="mt-2 text-center  text-dark ">Bangles</p>
                </div>
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (3).png'); ?>"
                            class="cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Necklace"
                            onclick="window.location.href='<?php echo base_url('products?category=Necklace'); ?>'">
                    </div>
                    <p class="mt-2 text-center text-dark">Necklace</p>
                </div>
                <div class="col-4 col-md-2 mb-4">
                    <div style="width: 120px; height: 120px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/catloge/image (4).png'); ?>"
                            class="cat-img-zoom rounded-circle w-100 h-100" style="object-fit: cover;" alt="Anklet"
                            onclick="window.location.href='<?php echo base_url('products?category=Anklet'); ?>'">
                    </div>
                    <p class="mt-2 text-center text-dark">Anklet</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about-us" class="py-0" style="background-color:rgb(210, 189, 235);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1">
                    <div class="p-4 rounded-3">
                        <h2 class="fw-bold mb-4 ">About Us</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur. Cursus sagittis enim mi placerat odio aliquam
                            eleifend. Fermentum sem convallis magna magna porttitor eu. Vitae sodales mauris sed neque
                            du vulputate porta. Ut neque cursus purus risus. Bibendum est amet turpis.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 order-md-2 text-center">
                    <img src="<?php echo base_url('assets\Home\aboutus.png'); ?>" class="img-fluid" alt="Person">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Why Choose Us?</h2>

            <div class="row g-4">
                <!-- Special Financing Offers -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card feature-card p-4 text-center w-100"
                        style="min-height: 220px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="feature-icon mb-3">
                            <img src="<?php echo base_url('assets/Home/f1.svg.png'); ?>" alt="Special Financing Offers"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h4 class="fs-5 mb-2 flex-shrink-0">Special Financing Offers</h4>
                        <p class="mb-0 flex-grow-1" style="font-size: 0.95rem;">Our stress-free finance department that
                            can find financial solutions to save you money.</p>
                    </div>
                </div>

                <!-- Insurance -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card feature-card p-4 text-center w-100"
                        style="min-height: 220px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="feature-icon mb-3">
                            <img src="<?php echo base_url('assets/Home/f2.svg.png'); ?>" alt="Insurance"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h4 class="mb-2 fs-5 flex-shrink-0">Insurance</h4>
                        <p class="mb-0 flex-grow-1" style="font-size: 0.95rem;">Our stress-free finance department that
                            can find financial solutions to save you money.</p>
                    </div>
                </div>

                <!-- Transparent Pricing -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card feature-card p-4 text-center w-100"
                        style="min-height: 220px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="feature-icon mb-3">
                            <img src="<?php echo base_url('assets/Home/f3.svg.png'); ?>" alt="Transparent Pricing"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h4 class="mb-2 fs-5 flex-shrink-0">Transparent Pricing</h4>
                        <p class="mb-0 flex-grow-1" style="font-size: 0.95rem;">Our stress-free finance department that
                            can find financial solutions to save you money.</p>
                    </div>
                </div>

                <!-- Expert Car Service -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card feature-card p-4 text-center w-100"
                        style="min-height: 220px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="feature-icon mb-3">
                            <img src="<?php echo base_url('assets/Home/f4.svg.png'); ?>" alt="Expert Car Service"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h4 class="mb-2 fs-5 flex-shrink-0">Expert Car Service</h4>
                        <p class="mb-0 flex-grow-1" style="font-size: 0.95rem;">Our stress-free finance department that
                            can find financial solutions to save you money.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bracelet Collection Section -->
    <section class="py-5" style="background: linear-gradient(45deg,rgb(145, 105, 187) 0%, #FFFFFF 100%);">
        <div class="container">
            <h2 class="fw-bold mb-3 text-center">Bracelet Collection</h2>
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <div style="width: 400px; height: 500px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets\Home\Braclet.png'); ?>" class="rounded-3 w-100 h-100"
                            style="object-fit: cover;" alt="Bracelet">
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-4" style="color: #715454;">
                        Discover our stunning collection of bracelets, crafted to perfection for every style and moment,
                        from elegant solitaires and dazzling diamond bands to modern statement pieces and classic gold
                        rings. Each bracelet is designed to add a touch of sophistication and charm to your jewelry
                        collection, making it perfect for gifting or personal indulgence. Explore our exquisite range
                        and find the perfect piece that resonates with your unique style and personality.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn text-white text-center fw-6 px-4 py-2 rounded-3"
                            style="background-color: #5E358E; font-weight:500;"
                            onclick="window.location.href = '<?php echo base_url('products?category=Bracelet'); ?>';">View
                            Collection</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Women's Happiness Section -->
    <section class="py-5" style="background-color: #E6D6F5;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Heading -->
                <div class="col-12 text-center mb-3">
                    <h1 class="fw-bold" style="color: #5E358E; font-size: 3rem;">Celebrate Women's Happiness</h1>


                </div>
                <p class="mb-4 text-center " style="color: #5E358E;">
                    Celebrate your unique style with our exquisite women's jewellery collection.<br> From timeless gold
                    and diamond pieces
                </p>
                <!-- Images and Text -->
                <div class="col-md-4 text-center mb-4 d-flex flex-column align-items-center justify-content-center"
                    style="height: 100%;">
                    <div style="width: 100%; max-width: 300px; margin-top: 120px;">
                        <img src="<?php echo base_url('assets/Home/Group 3.png'); ?>" class="img-fluid rounded-3"
                            alt="Jewelry Image 1">
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4 d-flex flex-column align-items-center justify-content-center"
                    style="height: 100%;">
                    <div style="width: 100%; max-width: 300px;">
                        <img src="<?php echo base_url('assets/Home/Group 2.png'); ?>" class="img-fluid rounded-3"
                            alt="Jewelry Image 2">
                    </div>
                </div>
                <div class="col-md-4 text-center text-md-start">
                    <div style="width: 100%; max-width: 300px; margin: 0 auto;">
                        <img src="<?php echo base_url('assets/Home/Group 1.png'); ?>" class="img-fluid rounded-3 mb-4"
                            alt="Jewelry Image 3">
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn text-white px-4 py-2 rounded-3" style="background-color: #5E358E;"
                        onclick="window.location.href = '<?php echo base_url('UserController/collections'); ?>';">Explore
                        Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Collection Section -->
    <section class="py-5" style="background-color:rgb(202, 142, 90 ,0%);">
        <div class="container ">

            <!-- First row -->
            <div class="row section align-items-center mb-5">
                <div class="col-md-6 d-flex justify-content-center">
                    <div style="max-width: 500px; width: 500px;">
                        <img src="<?php echo base_url('assets/Home/Collection1.png'); ?>" class="img-fluid rounded-3"
                            alt="Engagement Rings" style="width: 100%; height: 350px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="section-title text-center mb-4">Engagement Rings Collection</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur. In purus vitae rutrum risus et fringilla phasellus ipsum
                        eget. Id sagittis ac turpis ultrices non. Ultrices eu sit faucibus turpis. Mi suspendisse
                        aliquet augue purus mauris egestas pharetra in nulla. Viverra.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn text-white px-4 py-2 mb-3 rounded-3" style="background-color: #5E358E;"
                            onclick="window.location.href = '<?php echo base_url('UserController/collections'); ?>';">Explore
                            Now</button>
                    </div>
                </div>
            </div>
            <!-- Second row  -->
            <div class="row section align-items-center">
                <div class="col-md-6 order-md-2 d-flex justify-content-center">
                    <div style="max-width: 400px; width: 100%;">
                        <img src="<?php echo base_url('assets\Home\WeedingBride.png'); ?>" class="img-fluid rounded-3"
                            alt="Wedding Special" style="width: 100%; height: 450px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <h5 class="section-title text-center mb-4">Wedding Special Collection</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur. In purus vitae rutrum risus et fringilla phasellus ipsum
                        eget. Id sagittis ac turpis ultrices non. Ultrices eu sit faucibus turpis. Mi suspendisse
                        aliquet augue purus mauris egestas pharetra in nulla. Viverra.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn text-white px-4 mb-3 py-2 rounded-3" style="background-color: #5E358E"
                            onclick="window.location.href = '<?php echo base_url('UserController/collections'); ?>';">Explore
                            Now</button>
                    </div>
                </div>
            </div>
            <!-- <img src="<?php echo base_url('assets/Home/collection.png'); ?>" class="flower-icon" alt="Flower Icon">
        </div> -->
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row banner" style="background: rgba(66, 10, 92, 0.38); border-radius: 1rem; overflow: hidden;">
                <div class="col-md-6 p-0">
                    <img src="<?php echo base_url('assets\Home\newcollection.png'); ?>" class="img-fluid w-100 h-100"
                        style="object-fit: cover; border-radius: 1rem 0 0 1rem;" alt="Jewelry Collection">
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center" style="min-height: 350px;">
                    <div class="text-center px-3">
                        <h3 class="fw-bold mb-4" ">Explore Our Latest Pendant & Chain Collection</h3>
                        <button class=" btn btn-custom text-white px-4 py-2"
                            style="background-color: #5E358E; border-radius: 0.5rem; cursor: pointer;"
                            onclick="window.location.href = '<?php echo base_url('UserController/collections'); ?>';">
                            Explore Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <h2 class="text-center section-title brand-store mb-5">Brand Store</h2>
            <div class="row g-4 align-items-center justify-content-center">
                <div class="col-md-6 d-flex justify-content-center animate-fade" style="animation-delay: 0.2s;">
                    <img src="<?php echo base_url('assets/Home/brand/brand1.png'); ?>" class="img-fluid  shadow"
                        alt="Shaya Jewelry" style="max-width: 100%; height: auto;">
                </div>
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-12 animate-fade" style="animation-delay: 0.4s;">
                            <img src="<?php echo base_url('assets/Home/brand/brand2.png'); ?>" class="img-fluid  shadow"
                                alt="Everyday Jewelry" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-12 animate-fade" style="animation-delay: 0.6s;">
                            <img src="<?php echo base_url('assets/Home/brand/brand3.png'); ?>" class="img-fluid shadow"
                                alt="Special Jewelry" style="width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="container py-5">

                <div class="row g-4 align-items-center justify-content-center ">
                    <div class="col-md-4 d-flex justify-content-center ">
                        <img src="<?php echo base_url('assets\Home\brand\image 54.png'); ?>"
                            class="img-fluid shadow brand-hover " alt="Brand 1" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <img src="<?php echo base_url('assets/Home/brand/image 56.png'); ?>"
                            class="img-fluid shadow brand-hover" alt="Brand 2" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <img src="<?php echo base_url('assets/Home/brand/image 57.png'); ?>"
                            class="img-fluid shadow brand-hover" alt="Brand 3" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container g-5 text-center">
                <div class="row">
                    <div class="col-md-3 card-container">
                        <div class="card" style="border-radius: 20px; overflow: hidden;">
                            <img src="<?php echo base_url('assets\Home\brand\image 33.png'); ?>" class="card-img-top"
                                alt="Jewelry Image" style="border-radius: 20px 20px 0 0;">
                        </div>
                    </div>
                    <div class="col-md-3 card-container">
                        <div class="card" style="border-radius: 20px; overflow: hidden;">
                            <img src="<?php echo base_url('assets\Home\brand\image 34.png'); ?>" class="card-img-top"
                                alt="Jewelry Image" style="border-radius: 20px 20px 0 0;">
                        </div>
                    </div>
                    <div class="col-md-3 card-container">
                        <div class="card" style="border-radius: 20px; overflow: hidden;">
                            <img src="<?php echo base_url('assets\Home\brand\image 35.png'); ?>" class="card-img-top"
                                alt="Jewelry Image" style="border-radius: 20px 20px 0 0;">
                        </div>
                    </div>
                    <div class="col-md-3 card-container">
                        <div class="card" style="border-radius: 20px; overflow: hidden;">
                            <img src="<?php echo base_url('assets\Home\brand\image 36.png'); ?>" class="card-img-top"
                                alt="Jewelry Image" style="border-radius: 20px 20px 0 0;">
                        </div>
                    </div>
                </div>
                <div class="d-flex m-4 justify-content-center">
                    <button class="btn text-white px-4 mb-3 py-2 rounded-3"
                        style="background-color: #5E358E;">More</button>
                </div>
            </div>
        </section>

    </section>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <?php $this->load->view('common/popup'); ?>


    <!-- SweetAlert2 -->

    <script>
        document.querySelectorAll('.brand-image').forEach(image => {
            image.addEventListener('click', () => {
                image.classList.toggle('elongate');
            });
        });
    </script>

</body>

</html>