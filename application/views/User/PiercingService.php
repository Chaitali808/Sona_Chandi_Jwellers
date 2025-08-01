<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Piercing Appointment</title>
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
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--secondary);
            color: var(--text-dark);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(139, 137, 147, 0.75), rgba(49, 47, 59, 0.75)), url(<?php echo base_url("/assets/CustServices/appointwall.png"); ?>) center/cover no-repeat;
            padding: 6rem 1rem;
            color: var(--text-light);
            text-align: center;
            position: relative;
        }

        .hero-section h1 {
            font-size: 3.2rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Piercing Types Section */
        .piercing-types {
            /* background: white; */
            padding: 3rem 0;
            border-radius: 1rem;
            /* box-shadow: 0 5px 15px rgba(0,0,0,0.05); */
        }

        .piercing-option {
            border: 2px solid var(--accent);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .piercing-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(109, 92, 174, 0.2);
            border-color: var(--primary);
        }

        .piercing-option.active {
            background: var(--highlight);
            border-color: var(--primary);
        }

        .piercing-option img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        /* Form Styling */
        .form-container {
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(109, 92, 174, 0.1);
            border: 1px solid var(--accent);
        }

        .form-icon {
            color: var(--primary);
        }

        .btn-book {
            background: var(--gold-gradient);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(109, 92, 174, 0.3);
        }

        .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(109, 92, 174, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .form-container {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Professional Piercing Services</h1>
            <p>Safe, hygienic and painless ear & nose piercing by certified professionals</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="container my-5">
        <!-- Piercing Types -->
        <div class="piercing-types mb-5">
            <div class="section-title mb-4">
                <h2 style="color: var(--primary);">Choose Your Piercing Type</h2>
                <p class="text-muted">Select from our professional piercing options</p>
            </div>

            <div class="row">
                <!-- Ear Piercing -->
                <div class="col-md-6">
                    <div class="piercing-option active" onclick="selectPiercing('ear')">
                        <img src="<?php echo base_url('/assets/CustServices/ear-piercing.png'); ?>" alt="Ear Piercing">
                        <h4>Ear Piercing</h4>
                        <p>Classic lobe, helix, tragus and more</p>
                        <div class="price-badge">₹499 onwards</div>
                    </div>
                </div>

                <!-- Nose Piercing -->
                <div class="col-md-6">
                    <div class="piercing-option" onclick="selectPiercing('nose')">
                        <img src="<?php echo base_url('/assets/CustServices/nose-piercing.png'); ?>"
                            alt="Nose Piercing">
                        <h4>Nose Piercing</h4>
                        <p>Nostril or septum piercing</p>
                        <div class="price-badge">₹599 onwards</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="form-container">
            <h3 class="text-center mb-4" style="color: var(--primary);">Book Your Piercing Appointment</h3>

            <form id="piercingForm">
                <input type="hidden" id="piercingType" name="piercingType" value="ear">

                <div class="row g-3">
                    <!-- Personal Details -->
                    <div class="col-md-6 form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person form-icon"></i></span>
                            <input type="text" class="form-control" id="fullName" placeholder="Your name">
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone form-icon"></i></span>
                            <input type="tel" class="form-control" id="phone" placeholder="10-digit mobile number"
                                maxlength="10" pattern="\d{10}">
                        </div>
                    </div>

                    <!-- Age Group -->
                    <div class="col-md-6 form-group">
                        <label for="ageGroup" class="form-label">Age Group</label>
                        <select class="form-select" id="ageGroup">
                            <option value="">Select age group</option>
                            <option value="Baby (0-5 years)">Baby (0-5 years)</option>
                            <option value="Child (6-12 years)">Child (6-12 years)</option>
                            <option value="Teen (13-17 years)">Teen (13-17 years)</option>
                            <option value="Adult (18+ years)">Adult (18+ years)</option>
                        </select>
                    </div>

                    <!-- Ear Piercing Options (shown by default) -->
                    <div class="col-md-6 form-group" id="earOptions">
                        <label for="earPiercingType" class="form-label">Ear Piercing Type</label>
                        <select class="form-select" id="earPiercingType">
                            <option value="">Select Ear Piercing Type</option>
                            <option value="Earlobe">Earlobe (Standard)</option>
                            <option value="Helix">Helix (Upper Ear)</option>
                            <option value="Tragus">Tragus</option>
                            <option value="Conch">Conch</option>
                            <option value="Multiple Piercings">Multiple Piercings</option>
                        </select>
                    </div>

                    <!-- Nose Piercing Options (hidden by default) -->
                    <div class="col-md-6 form-group" id="noseOptions" style="display:none;">
                        <label for="nosePiercingType" class="form-label">Nose Piercing Type</label>
                        <select class="form-select" id="nosePiercingType">
                            <option value="">Select Nose Piercing Type</option>
                            <option value="Nostril">Nostril (Standard)</option>
                            <option value="Septum">Septum</option>
                            <option value="Both Nostrils">Both Nostrils</option>
                        </select>
                    </div>

                    <!-- Date & Time -->
                    <div class="col-md-6 form-group">
                        <label for="appointmentDate" class="form-label">Preferred Date</label>
                        <input type="date" class="form-control" id="appointmentDate" min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="appointmentTime" class="form-label">Preferred Time</label>
                        <select class="form-select" id="appointmentTime">
                            <option value="">Select time slot</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                        </select>
                    </div>

                    <!-- Location -->
                    <div class="col-md-12 form-group">
                        <label for="location" class="form-label">Preferred Location</label>
                        <select class="form-select" id="location">
                            <option value="">Select location</option>
                            <option value="Hinjawadi">Pune - Hinjawadi</option>
                            <option value="Wakad">Pune - Wakad</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-book">
                            <i class="bi bi-calendar-check me-2"></i>Book Appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Piercing Care Tips -->
    <section class="container my-5 py-4" style="background: var(--highlight); border-radius: 1rem;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?php echo base_url('/assets/CustServices/piercing-care.png'); ?>" alt="Piercing Care"
                    class="img-fluid rounded"
                    style="border: 3px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 300px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <h3 style="color: var(--primary);">Piercing Aftercare Tips</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Clean twice daily with
                        saline solution</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Avoid touching with
                        unwashed hands</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Don't remove jewelry
                        during healing</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Avoid swimming for 2 weeks
                    </li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Come back for free check-up after 2
                        weeks</li>
                </ul>
            </div>
        </div>
    </section>

    <script>
        // Set minimum date for appointment
        document.getElementById('appointmentDate').min = new Date().toISOString().split('T')[0];

        // Toggle between ear and nose piercing options
        function selectPiercing(type) {
            document.getElementById('piercingType').value = type;

            // Update active state on options
            document.querySelectorAll('.piercing-option').forEach(opt => {
                opt.classList.remove('active');
            });
            event.currentTarget.classList.add('active');

            // Show/hide relevant options
            if (type === 'ear') {
                document.getElementById('earOptions').style.display = 'block';
                document.getElementById('noseOptions').style.display = 'none';
            } else {
                document.getElementById('earOptions').style.display = 'none';
                document.getElementById('noseOptions').style.display = 'block';
            }
        }

        // Form submission
        document.getElementById('piercingForm').addEventListener('submit', function (e) {
            e.preventDefault();
            // Here you would typically send the form data to your server

            const name = document.getElementById('fullName').value;
            const mobile = document.getElementById('phone').value;
            const ageGroup = document.getElementById('ageGroup').value;
            const earPiercingType = document.getElementById('earPiercingType').value;
            const nosePiercingType = document.getElementById('nosePiercingType').value;
            const appointmentDate = document.getElementById('appointmentDate').value;
            const appointmentTime = document.getElementById('appointmentTime').value;
            const location = document.getElementById('location').value;
            const piercingType = document.getElementById('piercingType').value;

            let selectedPiercingType = "";
            if (piercingType === 'ear') {
                selectedPiercingType = earPiercingType;
            } else if (piercingType === 'nose') {
                selectedPiercingType = nosePiercingType;
            }

            const fullNamePattern = /^[a-zA-Z]{2,}(?: [a-zA-Z]{2,})+$/;

            if (!fullNamePattern.test(name)) {
                Swal.fire('Validation Error', 'Please enter a valid full name.', 'warning');
                return;
            }

            if (!/^\d{10}$/.test(mobile)) {
                Swal.fire('Validation Error', 'Please enter a valid 10-digit mobile number.', 'warning');
                return;
            }

            if (ageGroup === "") {
                Swal.fire('Validation Error', 'Please select your age group.', 'warning');
                return;
            }

            if (selectedPiercingType === "") {
                Swal.fire('Validation Error', `Please select a ${piercingType} piercing type.`, 'warning');
                return;
            }

            if (appointmentDate === "") {
                Swal.fire('Validation Error', 'Please select a preferred appointment date.', 'warning');
                return;
            }

            if (appointmentTime === "") {
                Swal.fire('Validation Error', 'Please select a preferred appointment time.', 'warning');
                return;
            }

            if (location === "") {
                Swal.fire('Validation Error', 'Please select a preferred location.', 'warning');
                return;
            }

            const formData = {
                name: name,
                mobile: mobile,
                ageGroup: ageGroup,
                piercingType: piercingType,
                selectedPiercingType: selectedPiercingType,
                appointmentDate: appointmentDate,
                appointmentTime: appointmentTime,
                type: piercingType,
                location: location
            };

            fetch('<?= base_url("UserController/submitPiercingAppointmentForm") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Success', data.message, 'success');
                        document.getElementById('piercingForm').reset();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                });
        });
    </script>

    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->
</body>

</html>