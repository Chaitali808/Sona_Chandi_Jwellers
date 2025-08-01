<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astrogems - Birthstone Jewelry Collection</title>

    <?php $this->load->view('common/Commonlinks'); ?>
    <style>
        :root {
            --purple-primary: rgba(94, 53, 142, 1);
            --purple-secondary: rgba(197, 115, 191, 1);
            --purple-light: rgba(178, 142, 202, 1);
            --purple-dark: #4a148c;
            --text-light: #f8f9fa;
        }

        body {
            background-color: #faf5ff;
            font-family: 'Garet', serif;
        }





        .hero-section {
            background: linear-gradient(rgba(95, 53, 142, 0.24), rgba(74, 20, 140, 0.23)), url('https://images.unsplash.com/photo-1605100804763-247f67b3557e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            margin-bottom: 4rem;
            text-align: center;
        }

        .page-title {
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .page-subtitle {
            font-weight: 300;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* Fixed Size Gem Cards */
        .gem-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(94, 53, 142, 0.1);
            margin-bottom: 2rem;
            background-color: white;
            height: 600px;
            /* Fixed height */
            display: flex;
            flex-direction: column;
        }

        .gem-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(94, 53, 142, 0.15);
        }

        .gem-header {
            background: white;
            color: var(--purple-primary);
            padding: 1rem 0rem 1rem 0rem;
            text-align: center;
        }

        .gem-month {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
            letter-spacing: 0.5px;
        }

        .gem-name {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--purple-secondary);
            margin-bottom: 1rem;
        }

        .gem-image-container {
            height: 100px;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gem-image {
            max-width: 140px;
            max-height: 140px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .gem-card:hover .gem-image {
            transform: scale(1.03);
        }

        .gem-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .gem-properties {

            flex-grow: 1;
        }

        .gem-property {
            display: flex;
            margin-bottom: 1rem;
            align-items: flex-start;
        }

        .gem-property i {
            color: var(--purple-secondary);
            margin-right: 10px;
            margin-top: 3px;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .gem-property span {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .btn-elegant {
            background: linear-gradient(135deg, var(--purple-secondary), var(--purple-primary));
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(197, 115, 191, 0.3);
            align-self: center;
            margin-top: auto;
        }

        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(197, 115, 191, 0.4);
        }

        /* Month Selector */
        .month-selector {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(94, 53, 142, 0.1);
            margin-bottom: 3rem;
        }

        .selector-title {
            color: var(--purple-primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.3rem;
        }

        .month-btn {
            background-color: white;
            color: var(--purple-primary);
            border: 1px solid var(--purple-light);
            margin: 0.3rem;
            border-radius: 50px;
            padding: 0.5rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .month-btn:hover,
        .month-btn.active {
            background: linear-gradient(135deg, var(--purple-secondary), var(--purple-primary));
            color: white;
            border-color: transparent;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 4rem 0;
            }

            .page-title {
                font-size: 2rem;
            }

            .gem-card {
                height: auto;
                min-height: 550px;
            }

            .month-btn {
                padding: 0.4rem 1rem;
                font-size: 0.85rem;
            }
        }

        /* Bubble Icon */
        .zoom-bubble {
            position: fixed;
            bottom: 80px;
            right: 30px;
            background: linear-gradient(135deg, #6f42c1, #a855f7);
            color: white;
            padding: 14px 16px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            text-align: center;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .zoom-bubble:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #a855f7, #6f42c1);
        }

        /* Zoom Bubble Icon */
        .zoom-modal-content {
            border-radius: 1rem;
            border: none;
            background: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            font-family: 'Garet', sans-serif;
        }

        .zoom-modal-content .modal-header {
            background: linear-gradient(135deg, var(--purple-secondary), var(--purple-primary));
            color: var(--text-light);
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-bottom: none;
        }


        .zoom-modal-content .modal-title {
            font-weight: 600;
        }

        .zoom-modal-content .btn-elegant {
            background: linear-gradient(135deg, var(--purple-secondary), var(--purple-primary));
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1.3rem;
            border: none;
            box-shadow: 0 4px 10px rgba(197, 115, 191, 0.3);
            font-weight: 500;
        }

        .zoom-modal-content .btn-elegant:hover {
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
        }
    </style>

    <!-- Custom Styles (Optional) -->
    <style>
        .zoom-bubble-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        .zoom-bubble {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #6f42c1;
            color: white;
            border: none;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .zoom-bubble:hover {
            background-color: #5a32a3;
        }

        /* .modal-body .btn {
            width: 50px;
            height: 50px;
            font-size: 20px;
        } */
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="page-title">CELESTIAL ASTROGEMS</h1>
            <p class="page-subtitle">Discover the perfect birthstone that resonates with your cosmic energy. Each gem is
                meticulously selected to harmonize with your birth month, bringing balance, protection, and positive
                vibrations to your life.</p>
        </div>
    </section>

    <!-- Month Selector -->
    <div class="container month-selector">
        <h3 class="selector-title"><i class="fas fa-calendar-alt me-2"></i>Find Your Birthstone</h3>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn month-btn active" data-month="all">All Gems</button>
            <button class="btn month-btn" data-month="january">January</button>
            <button class="btn month-btn" data-month="february">February</button>
            <button class="btn month-btn" data-month="march">March</button>
            <button class="btn month-btn" data-month="april">April</button>
            <button class="btn month-btn" data-month="may">May</button>
            <button class="btn month-btn" data-month="june">June</button>
            <button class="btn month-btn" data-month="july">July</button>
            <button class="btn month-btn" data-month="august">August</button>
            <button class="btn month-btn" data-month="september">September</button>
            <button class="btn month-btn" data-month="october">October</button>
            <button class="btn month-btn" data-month="november">November</button>
            <button class="btn month-btn" data-month="december">December</button>
        </div>
    </div>

    <!-- Gems Grid -->
    <div class="container mb-5">
        <div class="row g-4" id="gems-container">
            <?php foreach ($birthstones as $stone): ?>
                <div class="col-md-6 col-lg-4 col-xl-3 gem-item" data-month="<?= strtolower($stone->month) ?>">
                    <div class="gem-card h-100">
                        <div class="gem-header">
                            <div class="gem-month"><?= ucfirst($stone->month) ?></div>
                            <div class="gem-name"><?= $stone->gemstone_name ?></div>
                        </div>
                        <div class="gem-image-container">
                            <img src="<?= base_url($stone->image_path) ?>" alt="<?= $stone->gemstone_name ?>"
                                class="gem-image">
                        </div>
                        <div class="gem-body">
                            <div class="gem-properties">
                                <?php
                                $points = json_decode($stone->description); // Decode JSON array
                            
                                if (is_array($points)) {
                                    foreach ($points as $point):
                                        $cleanPoint = trim($point);
                                        if ($cleanPoint === '')
                                            continue;

                                        // Word wrap every 12 characters
                                        $wrappedText = wordwrap($cleanPoint, 34, "<br>", true);
                                        ?>
                                        <div class="gem-property">
                                            <i class="fas fa-gem"></i>
                                            <span><?= $wrappedText ?></span>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                ?>
                            </div>

                            <button class="btn btn-elegant">Explore Collection</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Astrologer Info Bubble Icon -->
    <div class="zoom-bubble-wrapper">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <button type="button" class="zoom-bubble" title="Astrologer Info" data-bs-toggle="modal"
            data-bs-target="#astrologerModal">
            <i class="fas fa-user-astronaut"></i>
        </button>
    </div>

    <!-- Astrologer Info Modal -->
    <div class="modal fade" id="astrologerModal" tabindex="-1" aria-labelledby="astrologerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header text-white"
                    style="background: linear-gradient(to right, #5E358E, #4A2A70, #1A0F28);">
                    <h5 class="modal-title" id="astrologerModalLabel">Astrologer Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <?php if (!empty($astrolgerData)) { ?>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><strong>Name:</strong> <?= ucfirst($astrolgerData->name); ?></li>
                            <li class="list-group-item"><strong>Experience:</strong> <?= $astrolgerData->experience; ?>
                                Years</li>
                            <li class="list-group-item"><strong>Expertise:</strong>
                                <?= ucfirst($astrolgerData->expertise); ?></li>
                            <li class="list-group-item"><strong>Charges:</strong> ₹ <?= $astrolgerData->charges; ?> /
                                session</li>
                        </ul>
                        <div class="d-flex justify-content-evenly align-items-center mt-4">
                            <a href="tel:+91<?= $astrolgerData->mobile; ?>"
                                class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-phone fs-4"></i> <!-- fs-4 = ~22px -->
                            </a>
                            <a href="https://wa.me/91<?= $astrolgerData->whatsapp; ?>" target="_blank"
                                class="btn btn-outline-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fab fa-whatsapp fs-4"></i>
                            </a>
                            <a href="mailto:<?= $astrolgerData->email; ?>"
                                class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope fs-4"></i>
                            </a>
                        </div>


                    <?php } else { ?>
                        <p class="text-center text-danger mb-0">Astrologer details not available.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <script>
        // ------------------ Filter Gems by Month ------------------
        document.querySelectorAll('.month-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.month-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const month = this.getAttribute('data-month');
                const gems = document.querySelectorAll('.gem-item');

                gems.forEach(gem => {
                    gem.style.display = (month === 'all' || gem.getAttribute('data-month') === month) ? 'block' : 'none';
                });
            });
        });
    </script>


    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // ------------------ Filter Gems by Month ------------------
        document.querySelectorAll('.month-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.month-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const month = this.getAttribute('data-month');
                const gems = document.querySelectorAll('.gem-item');

                gems.forEach(gem => {
                    gem.style.display = (month === 'all' || gem.getAttribute('data-month') === month) ? 'block' : 'none';
                });
            });
        });

        // ------------------ Zoom Meeting Modal Form Submission ------------------
        document.getElementById('submitMeetingBtn').addEventListener('click', function () {
            const date = document.getElementById('meetingDate').value;
            const time = document.getElementById('meetingTime').value;
            const description = document.getElementById('description').value;

            // Basic validation
            if (!date || !time) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Fields',
                    text: 'Please select both Date and Time.',
                });
                return;
            }

            // Combine selected date and time
            const selectedDateTime = new Date(`${date}T${time}`);
            const now = new Date();

            // Check if selected datetime is in the future
            if (selectedDateTime < now) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Date or Time',
                    text: 'Please select a future date and time.',
                });
                return;
            }

            const data = {
                meetingDate: date,
                meetingTime: time,
                description: description
            };

            fetch("<?= base_url('UserController/submitAstroGemsMeetingAppointment') ?>", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        });

                        // Clear form fields
                        document.getElementById('meetingDate').value = '';
                        document.getElementById('meetingTime').value = '';
                        document.getElementById('description').value = '';
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'Something went wrong!'
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to submit meeting.'
                    });
                });
        });
    </script>


</body>

</html>