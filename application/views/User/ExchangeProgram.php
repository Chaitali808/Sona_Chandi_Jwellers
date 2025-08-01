<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange program</title>
    <?php $this->load->view('common/Commonlinks'); ?>
   
    <style>
        :root {
            --primary: #6d5cae;
            --secondary: #f5f5f5;
            --accent: #b39ddb;
            --text-dark: #2d1a47;
            --text-light: #fff;
            --highlight: #e1bee7;
            --button: #422987;
            --gold: #66456c;
            --gold-gradient: linear-gradient(90deg, #937fa6 0%, #7c3897 100%);
            ;
        }

        body {
            background: var(--secondary);
            font-family: 'Roboto', Arial, sans-serif;
            color: var(--text-dark);
        }

        .navbar {
            background: var(--secondary);
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.07);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--primary) !important;
            letter-spacing: 2px;
        }

        .search-bar {
            border-radius: 2rem;
            border: 1px solid var(--accent);
            padding-left: 1.5rem;
        }

        .hero-section {
            background: linear-gradient(90deg, var(--highlight) 60%, var(--secondary) 100%);
            border-radius: 2rem;
            padding: 3rem 2rem 2.5rem 2rem;
            margin-bottom: 2.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(109, 92, 174, 0.10);
            position: relative;
            overflow: hidden;
        }

        .hero-img {
            max-width: 420px;
            border-radius: 1.5rem;
            margin-right: 2.5rem;
            box-shadow: 0 4px 32px rgba(230, 194, 0, 0.18);
            border: 4px solid #fffbe6;
        }

        .hero-content {
            flex: 1;
            min-width: 250px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2.9rem;
            margin-bottom: 1.2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .hero-offer {
            font-size: 1.4rem;
            color: var(--gold);
            font-weight: 700;
            margin-bottom: 0.7rem;
            text-shadow: 0 2px 8px #fffbe6;
        }

        .badge-exchange {
            background: var(--primary);
            color: var(--text-light);
            font-size: 1.1rem;
            border-radius: 1rem;
            padding: 0.6rem 1.4rem;
            margin-top: 1rem;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.13);
        }

        .gold-divider {
            width: 80px;
            height: 4px;
            border-radius: 2px;
            background: var(--gold-gradient);
            margin: 1.2rem auto 1.5rem auto;
            display: block;
        }

        .advantage-section {
            background: var(--accent);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            margin-bottom: 2.5rem;
            color: var(--text-dark);
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.07);
            position: relative;
        }

        .advantage-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2.1rem;
            margin-bottom: 1.2rem;
            text-align: center;
        }


        .testimonial-form-section {
            background: var(--highlight);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            margin-bottom: 2.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.07);
        }

        .testimonial {
            font-style: italic;
            color: var(--primary);
            font-size: 1.15rem;
            background: var(--secondary);
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            box-shadow: 0 2px 8px rgba(230, 194, 0, 0.10);
            text-align: center;
            border: 2px solid #fffbe6;
        }

        .testimonial img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.7rem;
            border: 3px solid var(--gold);
            box-shadow: 0 2px 8px #fffbe6;
        }

        .form-control,
        .btn-primary {
            border-radius: 2rem;
        }

        .btn-primary {
            background: var(--gold-gradient);
            color: var(--text-dark);
            border: none;
            font-weight: 600;
            box-shadow: 0 2px 8px #fffbe6;
            transition: background 0.2s, color 0.2s;
        }

        .btn-primary:hover {
            background: var(--primary);
            color: var(--text-light);
        }

        .store-locator {
            background: var(--secondary);
            border-radius: 1.5rem;
            padding: 2.2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.07);
        }

        .store-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .city-badge {
            background: var(--accent);
            color: var(--text-dark);
            border-radius: 1rem;
            padding: 0.7rem 1.2rem;
            margin: 0.2rem 0.4rem 0.2rem 0;
            font-size: 1rem;
            display: inline-block;
            border: 1.5px solid var(--gold);
            font-weight: 500;
        }

        .how-it-works {
            background: var(--accent);
            border-radius: 1.5rem;
            padding: 2.2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 2px 8px rgba(109, 92, 174, 0.07);
        }

        .how-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .accordion-button:not(.collapsed) {
            background: var(--highlight);
            color: var(--primary);
            font-weight: 600;
        }

        .accordion-button:after {
            filter: hue-rotate(45deg) brightness(1.2);
        }

        .cta-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            margin-bottom: 2.5rem;
        }

        .cta-card {
            background: var(--secondary);
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px rgba(230, 194, 0, 0.10);
            padding: 2rem 1.2rem 1.5rem 1.2rem;
            flex: 1 1 260px;
            max-width: 340px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 2px solidrgb(212, 166, 229);
            position: relative;
        }

        .cta-card:hover {
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 8px 32px rgba(230, 194, 0, 0.18);
            border-color: var(--gold);
        }

        .cta-card img {
            max-width: 100%;
            border-radius: 0.7rem;
            margin-bottom: 1.2rem;
            box-shadow: 0 2px 8pxrgb(218, 179, 222);
            border: 2px solid var(--gold);
        }

        .cta-card h5 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 0.5rem;
            font-weight: 700;
        }

        .cta-card {
            position: relative;
            overflow: hidden;
        }

        .cta-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(120deg,
                    rgba(255, 255, 255, 0.2) 0%,
                    rgba(255, 255, 255, 0.6) 50%,
                    rgba(255, 255, 255, 0.2) 100%);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
            z-index: 2;
        }

        .cta-card:hover::after {
            left: 125%;
        }

        @media (max-width: 991px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 2rem 0.5rem 1.5rem 0.5rem;
            }

            .hero-img {
                margin: 0 0 1.5rem 0;
            }

            .testimonial-form-section {
                flex-direction: column;
                text-align: center;
                padding: 2rem 0.5rem;
            }

            .cta-cards {
                flex-direction: column;
                gap: 1.2rem;
            }
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 2rem;
            }

            .advantage-title {
                font-size: 1.3rem;
            }

            .hero-section,
            .advantage-section,
            .testimonial-form-section,
            .store-locator,
            .how-it-works {
                padding: 1.2rem 0.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 1rem 0.2rem 1rem 0.2rem;
            }

            .hero-img {
                max-width: 100%;
                margin: 0 0 1rem 0;
            }

            .hero-title {
                font-size: 1.3rem;
            }

            .hero-offer {
                font-size: 1rem;
            }

            .advantage-section,
            .testimonial-form-section,
            .store-locator,
            .how-it-works {
                padding: 1rem 0.2rem;
            }

            .cta-cards {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-card {
                max-width: 100%;
                padding: 1rem 0.5rem;
            }

            .testimonial img {
                width: 60px;
                height: 60px;
            }
        }

        .advantage-card {
            border-radius: 1rem;
            background: var(--secondary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .advantage-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .icon-box i {
            transition: transform 0.3s ease;
        }

        .advantage-card:hover .icon-box i {
            transform: scale(1.2) rotate(5deg);
        }

        .accordion-button:focus {
            box-shadow: none;

        }

        /* Logo */
        .logo-band {
            background: var(--gold-gradient);
            /* elegant background */
            padding: 1.5rem 0;
        }

        .logo-band img {
            max-height: 60px;
            object-fit: contain;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.5rem;
        }

        .logo-band img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .logo-band img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 2px solid var(--text-light);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>


    <main class="container mt-4">
        <!-- Hero Banner -->
        <section class="hero-section mb-4">
            <img src="<?php echo base_url("/assets/GoldExchange/image.webp"); ?>" alt="Gold Jewellery" class="hero-img">
            <div class="hero-content">
                <h1 class="hero-title">Exchange your old gold for more gold!</h1>
                <div class="hero-offer mb-2">Get up to <b>2KT*</b> extra on old gold value and upgrade to new designs.
                </div>
                <span class="badge-exchange">Festival of Exchange</span>
                <div class="mt-2"><small>*Conditions apply.</small></div>
            </div>
        </section>

        <span class="gold-divider"></span>

        <!-- Exchange Advantage -->
        <section class="advantage-section mb-5">
            <div class="row align-items-center g-4">
                <!-- Image Column -->
                <div class="col-md-5 text-center">
                    <img src="<?php echo base_url("/assets/GoldExchange/image1.jpg"); ?>" alt="Gold Bangles" class="img-fluid rounded shadow"
                        style="max-height: 340px; object-fit: cover; width: 100%; max-width: 400px;">
                </div>

                <!-- Advantage Text Column -->
                <div class="col-md-7">
                    <h2 class="advantage-title fw-bold mb-4" style="color: var(--primary);">Sonachandi Exchange Advantage
                    </h2>

                    <div class="row g-3">
                        <!-- Card 1 -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm h-100 advantage-card">
                                <div class="card-body d-flex align-items-start">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-shield-check fs-2 text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-1" style="color: var(--primary);">Trust</h5>
                                        <p class="mb-0 text-muted small">Only 24K gold available.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm h-100 advantage-card">
                                <div class="card-body d-flex align-items-start">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-cash-coin fs-2 text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-1" style="color: var(--primary);">Best Exchange Value
                                        </h5>
                                        <p class="mb-0 text-muted small">Get full exchange value on gold, no hidden
                                            deductions</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm h-100 advantage-card">
                                <div class="card-body d-flex align-items-start">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-gem fs-2 text-danger"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-1" style="color: var(--primary);">Any Jeweller
                                            Accepted</h5>
                                        <p class="mb-0 text-muted small">Exchange old gold jewellery bought from
                                            anywhere</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <span class="gold-divider d-block my-4"
            style="height: 4px; background: var(--gold); border-radius: 5px;"></span>
        <!-- LOGO -->
        <!-- HTML -->
        <div class="container-fluid logo-band">
            <div class="text-center mb-3 fw-bold" style="color: var(--text-dark); font-size: 1.25rem;">
                Certification Partners
            </div>
            <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
                <img src="<?php echo base_url("/assets/GoldExchange/bois.png"); ?>" alt="Logo 1">
                <img src="<?php echo base_url("/assets/GoldExchange/sgl.png"); ?>" alt="Logo 2">
            </div>
        </div>

        <span class="gold-divider"></span>
        <!-- Testimonial & Form -->
        <section class="testimonial-form-section mb-4">
            <div class="flex-fill" style="min-width:220px;max-width:400px;">
                <h3 class="section-title" style="font-size:1.5rem;">Interested in an Exchange?</h3>
                <p>Our Experts Will Get in Touch with You!</p>
                <form class="row g-2">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Enter Your Name" required>
                    </div>
                    <div class="col-12">
                        <input type="tel" class="form-control" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Get in Touch</button>
                    </div>
                </form>
            </div>
            <div class="flex-fill" style="min-width:220px;max-width:400px;">
                <div class="testimonial">
                    <img src="<?php echo base_url("/assets/GoldExchange/customer.jpg"); ?>" alt="Customer with Gold Jewellery" class="mb-2">
                    <blockquote>"I was not worried about the rising gold rates. Because I knew I could simply exchange
                        my old jewellery at Tanishq."</blockquote>
                    <footer class="blockquote-footer mt-2">Kanika Kapoor, Gujarat</footer>
                </div>
            </div>
        </section>

        <span class="gold-divider"></span>

        <!-- Store Locator & How it Works -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <section class="store-locator">
                    <h4 class="store-title">
                        <i class="bi bi-geo-alt me-1 text-primary"></i>
                        Find your preferred store
                    </h4>

                    <input type="text" class="form-control mb-3" placeholder="Search By City">

                    <div class="d-flex flex-wrap gap-2">
                        <span class="city-badge">
                            <i class="bi bi-geo-alt me-1 text-primary"></i> Pune <small>(Wakad)</small>
                        </span>
                        <span class="city-badge">
                            <i class="bi bi-geo-alt me-1 text-primary"></i> Pune <small>(Hinjawadi)</small>
                        </span>
                    </div>
                </section>

            </div>
            <div class="col-lg-6">
                <section class="how-it-works">
                    <h4 class="how-title">How it works</h4>
                    <div class="accordion" id="howAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" ">
                                    Bring your old gold purchased from any jeweller.
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#howAccordion">
                                <div class="accordion-body" style="font-family:garet;">
                                    We accept gold from 9KT to 22KT, even in the smallest quantities.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Have it purity checked in front of you.
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#howAccordion">
                                <div class="accordion-body" style="font-family:garet;">
                                    100% transparency in purity testing.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Your gold is melted before your eyes.
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#howAccordion">
                                <div class="accordion-body" style="font-family:garet;">
                                    Complete process is visible to you for trust and assurance.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Final weight assessed for maximum value.
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#howAccordion">
                                <div class="accordion-body" style="font-family:garet;">
                                    You get the best value for your gold.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Upgrade to new Gold or Diamond jewellery.
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#howAccordion">
                                <div class="accordion-body" style="font-family:garet;">
                                    Choose from the latest designs and collections.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <span class="gold-divider"></span>

        <!-- CTA Cards -->
        <section class="cta-cards">
            <div class="cta-card">
                <img src="<?php echo base_url("/assets/GoldExchange/store.jpg"); ?>" alt="Store with Gold Jewellery" height="300px">
                <h5>Visit Our Store</h5>
            </div>
            <div class="cta-card" onclick="window.location.href='<?php echo base_url('UserController/Custservices'); ?>'" style="cursor:pointer;">
                <img src="<?php echo base_url("/assets/GoldExchange/appoinment.jpg"); ?>" alt="Book Appointment Gold" height="300px">
                <h5>Book an Appointment</h5>
            </div>
           <div class="cta-card">
                <a class="chat-trigger" style="text-decoration: none;">
                    <img src="<?php echo base_url("/assets/GoldExchange/talk.jpg"); ?>" alt="Talk to an Expert Gold" height="300px">
                <h5>Talk to an Expert</h5>
                </a>
            </div>
        </section>
    </main>

        <?php $this->load->view('common/chatbot'); ?>
        <?php $this->load->view('common/footer'); ?>
        <!-- SweetAlert2 -->
</body>

</html>