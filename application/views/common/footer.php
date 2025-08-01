<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer</title>

    <style>
        footer {

            color: white;
            font-family: 'Garet', serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>
</head>

<body>
    <footer class="py-5" style="background: linear-gradient(to right, #5E358E, #4A2A70, #1A0F28);">
        <div class="container">
            <div class="row text-center text-md-start align-items-start">
                <!-- First Column: Description and Social Icons -->
                <div class="col-12 col-md-4 mb-4 d-flex flex-column align-items-center align-items-md-start">
                    <h5 class="fs-4 mb-3" style="color: white !important;">Maa Sona Chandi Jwellers</h5>
                    <p class="fs-6" style="color: white;">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Ut Vel Mi Rutrum, Lobortis Dolor Nec,
                        Feugiat Sapien.
                    </p>
                    <div class="icons mt-2">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>

                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>

                <!-- Second Column: Quick Links -->
                <div class="col-12 col-md-4 mb-4 d-flex flex-column align-items-center align-items-md-start">
                    <h5 class="fs-4 mb-3" style="color: white !important; ">Quick Links</h5>
                    <a href="<?php echo base_url('UserController/home'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Home</a>

                    <a href="<?php echo base_url('UserController/collections'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Collections</a>
                    <a href="<?php echo base_url('UserController/goldcoins'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Gold Coin</a>
                    <a href="<?php echo base_url('UserController/astrogems'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Astro Gems</a>
                    <a href="<?php echo base_url('UserController/gallery'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Gallery</a>
                    <a href="<?php echo base_url('UserController/scheme'); ?>"
                        class="d-block mb-2 text-white text-decoration-none fs-6">Gold Saving Scheme</a>
                </div>

                <!-- Third Column: Contact Us -->
                <div class="col-12 col-md-4 mb-4 d-flex flex-column align-items-center align-items-md-start">
                    <h5 class="fs-4 mb-3" style="color: white !important;">Contact Us</h5>
                    <div>
                        <p class="mb-2 fs-6" style="color: white;"><i class="bi bi-telephone me-2"></i> 424-947-8877</p>
                        <p class="mb-2 fs-6" style="color: white;"><i class="bi bi-envelope me-2"></i>
                            luminary@gmail.com</p>
                        <p class="mb-2 fs-6" style="color: white;"><i class="bi bi-geo-alt me-2"></i> 9256 Abigail
                            Forges, Sao Tome And Principe</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center mt-4 d-flex justify-content-center">
                <p class="mb-1" style="color: white;">© COPYRIGHT 2025 RESERVED BY MAA SONA CHANDI JEWELLERS AND
                    DESIGNED BY MANASVI TECH SOLUTIONS PVT. LTD.</p>
            </div>
        </div>
    </footer>


</body>

</html>