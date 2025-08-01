<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jewelry Repair Services</title>
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
        .repair-hero {
            background: linear-gradient(rgba(109, 92, 174, 0.85), rgba(109, 92, 174, 0.85)),
                url(<?php echo base_url("/assets/CustServices/appointwall.png"); ?>) center/cover no-repeat;
            padding: 6rem 1rem;
            color: var(--text-light);
            text-align: center;
            position: relative;
        }

        .repair-hero h1 {
            font-size: 3.2rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .repair-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Services Section */
        .service-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(109, 92, 174, 0.1);
            transition: all 0.3s ease;
            border: 1px solid var(--accent);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(109, 92, 174, 0.2);
        }

        .service-card img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .service-card .card-body {
            padding: 1.5rem;
        }

        .service-card h3 {
            color: var(--primary);
            font-weight: 600;
        }

        .price-badge {
            background: var(--gold-gradient);
            color: white;
            padding: 0.25rem 1rem;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Repair Process */
        .process-step {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(109, 92, 174, 0.1);
            border: 1px solid var(--accent);
            height: 100%;
        }

        .process-step .step-number {
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-weight: 700;
        }

        /* Form Styling */
        .repair-form {
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(109, 92, 174, 0.1);
            border: 1px solid var(--accent);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--accent);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(109, 92, 174, 0.25);
        }

        .btn-repair {
            background: var(--gold-gradient);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(109, 92, 174, 0.3);
        }

        .btn-repair:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(109, 92, 174, 0.4);
            color: white;
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(109, 92, 174, 0.1);
            border: 1px solid var(--accent);
            height: 100%;
        }

        .testimonial-card .rating {
            color: #ffc107;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .repair-hero h1 {
                font-size: 2.5rem;
            }

            .repair-form {
                padding: 2rem 1rem;
            }
        }

        /* Track process */
        .track-repair {
            background: white;
            border-radius: 1rem;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(109, 92, 174, 0.1);
            border: 1px solid var(--accent);
            margin: 3rem 0;
        }

        .track-repair h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .track-status {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 2rem 0;
        }

        .status-step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .status-step.active .step-circle {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .status-step.completed .step-circle {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: 600;
            color: var(--accent);
        }

        .progress-line {
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent);
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: var(--primary);
            width: 75%;
            /* This would be dynamic based on actual progress */
            transition: width 0.5s ease;
        }

        .repair-details {
            background: var(--secondary);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 2rem;
        }

        .detail-row {
            display: flex;
            margin-bottom: 1rem;
        }

        .detail-label {
            font-weight: 600;
            width: 150px;
            color: var(--primary);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .track-status {
                flex-direction: column;
                align-items: flex-start;
            }

            .status-step {
                text-align: left;
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                width: 100%;
            }

            .step-circle {
                margin: 0 1rem 0 0;
            }

            .progress-line {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <!-- Hero Section -->
    <section class="repair-hero">
        <div class="container">
            <h1>Expert Jewelry Repair Services</h1>
            <p>Restore your precious jewelry to its original beauty with our skilled artisans</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="container my-5 py-4">
        <div class="section-title text-center mb-5">
            <h2 style="color: var(--primary);">Our Repair Services</h2>
            <p class="text-muted">Professional repairs for all types of jewelry</p>
        </div>

        <div class="row g-4">
            <!-- Ring Repair -->
            <div class="col-md-4">
                <div class="service-card">
                    <img src="<?php echo base_url('/assets/Repairing/ring-repair.png'); ?>" alt="Ring Repair">
                    <div class="card-body">
                        <h3>Ring Repair</h3>
                        <p>Resizing, shank replacement, stone tightening, and more</p>
                        <div class="price-badge">Starting at ₹799</div>
                    </div>
                </div>
            </div>

            <!-- Chain Repair -->
            <div class="col-md-4">
                <div class="service-card">
                    <img src="<?php echo base_url('/assets/Repairing/chain-repair.png'); ?>" alt="Chain Repair">
                    <div class="card-body">
                        <h3>Chain Repair</h3>
                        <p>Broken link repair, clasp replacement, lengthening/shortening</p>
                        <div class="price-badge">Starting at ₹599</div>
                    </div>
                </div>
            </div>

            <!-- Stone Replacement -->
            <div class="col-md-4">
                <div class="service-card">
                    <img src="<?php echo base_url('assets\Repairing\stone-replacement.png'); ?>"
                        alt="Stone Replacement">
                    <div class="card-body">
                        <h3>Stone Replacement</h3>
                        <p>Secure setting of loose stones or replacement of missing stones</p>
                        <div class="price-badge">Starting at ₹299/stone</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Repair Process -->
    <section class="container my-5 py-4" style="background: var(--highlight); border-radius: 1rem;">
        <div class="section-title text-center mb-5">
            <h2 style="color: var(--primary);">Our Repair Process</h2>
            <p class="text-muted">Simple steps to restore your jewelry</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Assessment</h4>
                    <p>Our experts evaluate your jewelry and provide a free estimate</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Approval</h4>
                    <p>We discuss repair options and get your approval</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Repair</h4>
                    <p>Skilled artisans perform the repairs using proper tools</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Quality Check</h4>
                    <p>Thorough inspection before returning to you</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Repair Form -->
    <section class="container my-5">
        <div class="repair-form">
            <div class="row">
                <div class="col-lg-6">
                    <h2 style="color: var(--primary);">Request a Repair</h2>
                    <p class="mb-4">Fill out the form and we'll contact you within 24 hours</p>

                    <form id="repairRequestForm">
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="customerName">
                        </div>

                        <div class="mb-3">
                            <label for="customerPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="customerPhone">
                        </div>

                        <div class="mb-3">
                            <label for="jewelryType" class="form-label">Jewelry Type</label>
                            <select class="form-select" id="jewelryType">
                                <option value="">Select jewelry type</option>
                                <option value="ring">Ring</option>
                                <option value="necklace">Necklace/Chain</option>
                                <option value="earrings">Earrings</option>
                                <option value="bracelet">Bracelet</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="repairType" class="form-label">Repair Needed</label>
                            <select class="form-select" id="repairType">
                                <option value="">Select repair type</option>
                                <option value="resizing">Resizing</option>
                                <option value="stone">Stone Replacement</option>
                                <option value="chain">Chain Repair</option>
                                <option value="clasp">Clasp Replacement</option>
                                <option value="polishing">Polishing</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="repairDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="repairDescription" rows="3"
                                placeholder="Describe the issue and any special requests"></textarea>
                        </div>

                        <button type="submit" class="btn btn-repair">Submit Request</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    <img src="<?php echo base_url('/assets/Repairing/repair-form.png'); ?>" alt="Jewelry Repair"
                        class="img-fluid rounded" style="border: 3px solid var(--accent);">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Track Repair Section -->
    <section class="container">
        <div class="track-repair">
            <h2>Track Your Repair</h2>
            <p>Enter your repair ID to check the status of your jewelry repair</p>

            <div class="input-group mb-4" style="max-width: 500px;">
                <input type="text" class="form-control" placeholder="Enter Repair ID" id="repairIdInput">
                <button class="btn btn-repair" onclick="trackRepair()">Track</button>
            </div>


            <!-- This would be displayed after searching for a repair -->
            <!-- <div id="repairStatus" style="display: none;">
                <h4 class="mb-3">Repair #JR-2023-0582</h4>

                <div class="track-status">
                    <div class="progress-line">
                        <div class="progress-bar"></div>
                    </div>

                    <div class="status-step completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div>Received</div>
                        <small class="text-muted">May 12</small>
                    </div>

                    <div class="status-step completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div>Assessment</div>
                        <small class="text-muted">May 13</small>
                    </div>

                    <div class="status-step active">
                        <div class="step-circle">3</div>
                        <div>In Progress</div>
                        <small class="text-muted">May 15</small>
                    </div>

                    <div class="status-step">
                        <div class="step-circle">4</div>
                        <div>Quality Check</div>
                        <small class="text-muted">-</small>
                    </div>

                    <div class="status-step">
                        <div class="step-circle">5</div>
                        <div>Ready for Pickup</div>
                        <small class="text-muted">-</small>
                    </div>
                </div>

                <div class="repair-details">
                    <div class="detail-row">
                        <div class="detail-label">Customer Name:</div>
                        <div>Priya Sharma</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Item Type:</div>
                        <div>Gold Ring</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Repair Type:</div>
                        <div>Resizing + Stone Tightening</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Estimated Completion:</div>
                        <div>May 18, 2023</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div><strong>In Progress</strong> - Being repaired by artisan</div>
                    </div>
                </div>

                <button class="btn btn-repair mt-3">
                    <i class="bi bi-chat-left-text me-2"></i>Contact About This Repair
                </button>
            </div> -->
        </div>
    </section>

    <script>
        function trackRepair() {
            const repairId = $('#repairIdInput').val().trim();

            if (repairId === "") {
                Swal.fire("Error", "Please enter a Repair ID.", "warning");
                return;
            }

            $.ajax({
                url: "<?= base_url('UserController/trackRepair') ?>", // Replace with your actual endpoint
                type: "POST",
                dataType: "json",
                data: { repair_id: repairId },
                success: function (response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        Swal.fire({
                            title: `<span style="font-size: 22px; color: #5E358E;">Repair #${data.repair_code}</span>`,
                            html: `
        <div style="text-align: left; font-size: 16px; line-height: 1.7; padding: 10px 0;">
            <p><strong>Customer:</strong> <span style="color:#333;">${toTitleCase(data.customer_name)}</span></p>
            <p><strong>Jewelry Type:</strong> <span style="color:#333;">${toTitleCase(data.item_type)}</span></p>
            <p><strong>Repair Type:</strong> <span style="color:#333;">${toTitleCase(data.repair_type)}</span></p>
            <p><strong>Submitted On:</strong> <span style="color:#333;">${formatDate(data.date)}</span></p>
            <p><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">${toTitleCase(data.status)}</span></p>
        </div>
    `,
                            icon: "info",
                            confirmButtonText: "OK",
                            customClass: {
                                popup: 'border border-2 rounded-3 shadow-lg'
                            },
                            width: 500,
                            showCloseButton: true,
                            background: '#fefefe'
                        });
                    } else {
                        Swal.fire("Not Found", response.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire("Server Error", "Something went wrong. Please try again.", "error");
                    console.error(xhr.responseText);
                }
            });
        }

        // Capitalize first letter of each word
        function toTitleCase(str) {
            return str.replace(/\w\S*/g, (txt) => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
        }

        // Format date (assuming format: YYYY-MM-DD or full timestamp)
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }   
    </script>


    <!-- <script>
        function trackRepair() {
            // Get the input value (optional: you can validate it if needed)
            var repairId = document.getElementById("repairIdInput").value.trim();

            // If input is not empty, show the repairStatus section
            if (repairId !== "") {
                document.getElementById("repairStatus").style.display = "block";
            } else {
                alert("Please enter a Repair ID");
            }
        }
    </script> -->

    <script>
        document.getElementById('repairRequestForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();
            const jewelryType = document.getElementById('jewelryType').value;
            const repairType = document.getElementById('repairType').value;
            const description = document.getElementById('repairDescription').value.trim();

            // Client-side validation
            if (name === '') {
                Swal.fire('Validation Error', 'Please enter your name.', 'warning');
                return;
            }
            if (phone === '' || !/^\d{10}$/.test(phone)) {
                Swal.fire('Validation Error', 'Please enter a valid 10-digit phone number.', 'warning');
                return;
            }
            if (jewelryType === '') {
                Swal.fire('Validation Error', 'Please select a jewelry type.', 'warning');
                return;
            }
            if (repairType === '') {
                Swal.fire('Validation Error', 'Please select a repair type.', 'warning');
                return;
            }

            // Prepare form data
            const formData = new FormData();
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('jewelry_type', jewelryType);
            formData.append('repair_type', repairType);
            formData.append('description', description);

            // Fetch API call to controller (adjust URL as per your controller method)
            fetch('<?= base_url("UserController/submitReparingAppointmentForm") ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Success',
                            'Your repair request has been submitted!<br><strong>Tracking ID:</strong> ' + data.tracking_id,
                            'success'
                        );
                    } else {
                        Swal.fire('Error', data.message || 'Something went wrong. Please try again.', 'error');
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error', 'Failed to submit request. Please try again later.', 'error');
                });
        });
    </script>


    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->
</body>

</html>