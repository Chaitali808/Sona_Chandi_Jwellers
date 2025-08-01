<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Share Your Jiva Story</title>
    <?php $this->load->view('common/Commonlinks'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #e0c1f9 0%, #ffffff 30%);
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            overflow-x: hidden;
        }

        h2 {
            margin-top: 30px;
            font-weight: bold;
            color: #7b1fa2;
            font-family: Cormorant Garamond;
        }

        p {
            font-family: garet;

        }

        .share-btn {
            background-color: #7b1fa2;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            margin: 20px auto 40px auto;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background-color: #9b4edd;
            transform: scale(1.1);
            box-shadow: 0 0 15px #b17be6;
        }

        .main-image {
            max-width: 60%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .image-container {
            display: flex;
            justify-content: center;
            padding: 0 15px;
        }

        /* CUSTOMER REVIEWS */
        .customer-reviews {
            /* background: linear-gradient(to bottom, #b57be6, #ffffff); */
            padding-top: 50px;
            perspective: 1200px;
        }

        .carousel-item {
            transition: transform 1s ease-in-out;
            transform-style: preserve-3d;
        }

        .card.testimonial {
            background: linear-gradient(to top, #7e3dd4, #e6d6f4);
            border: none;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
            width: 280px;
            max-width: 90vw;
            transform-style: preserve-3d;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.8s ease, box-shadow 0.4s ease;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .carousel-item.active .card.testimonial {
            transform: translateZ(60px) scale(1.05);
            z-index: 2;
        }

        .carousel-item:not(.active) .card.testimonial {
            transform: translateZ(-40px) scale(0.95);
            z-index: 1;
        }

        .card.testimonial:hover {
            transform: translateZ(80px) scale(1.1) rotateY(5deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            z-index: 3;
        }

        .card.testimonial .card-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #4b0082;
        }

        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* number of lines to show */
            -webkit-box-orient: vertical;
        }

        @media (max-width: 768px) {
            .card.testimonial {
                width: 100%;
                max-width: 100%;
                margin: 20px 0;
                min-height: unset;
                height: 320px;
            }

            .d-flex.justify-content-center.gap-4.flex-wrap {
                flex-direction: column !important;
                align-items: center !important;
                gap: 0 !important;
            }
        }
    </style>
</head>

<body>
    <?php $this->load->view('common/navbar'); ?>

    <h2>#ShareYourSonaChandiStory</h2>

    =
    <div class="image-container mt-5" data-aos="zoom-in">
        <img src="<?php echo base_url("/assets/Images/galleryImages/gallery1.png"); ?>" alt="Jiva Story"
            class="main-image" />
    </div>

    <!-- CUSTOMER REVIEWS SECTION -->
    <section class="customer-reviews py-4">
        <div class="container text-center">
            <h2 class="mb-5" style="color: #4b0082; text-decoration: underline; font-family: Cormorant Garamond;"
                data-aos="fade-up">
                Customer <span style="color:#4b0082; font-family: Cormorant Garamond;">Reviews</span>
            </h2>

            <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $chunks = array_chunk($testimonals, 3); // 3 reviews per slide
                    foreach ($chunks as $index => $chunk): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="d-flex justify-content-center gap-4 flex-wrap">
                                <?php foreach ($chunk as $testimonial): ?>
                                    <div class="card testimonial">
                                        <div class="card-body">
                                            <p class="card-text">❝ <?= htmlspecialchars($testimonial->message) ?> ❞</p>
                                            <p>
                                                <?php
                                                $filled = (int) $testimonial->rating;
                                                $empty = 5 - $filled;
                                                for ($i = 0; $i < $filled; $i++) {
                                                    echo '<i class="fas fa-star text-warning"></i>';
                                                }
                                                for ($i = 0; $i < $empty; $i++) {
                                                    echo '<i class="far fa-star text-warning"></i>';
                                                }
                                                ?>
                                            </p>
                                            <h6 class="mt-3"><?= htmlspecialchars($testimonial->name) ?></h6>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->

    <!-- JS Libraries -->

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            once: true
        });

        const carousel = document.querySelector('#reviewCarousel');
        const bsCarousel = new bootstrap.Carousel(carousel, {
            interval: 1000,
            ride: 'carousel',
            pause: 'hover'
        });
    </script>
</body>

</html>