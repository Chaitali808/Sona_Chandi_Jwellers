<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f5f5f7;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px 20px;
            width: 100vw;
            max-width: 100vw;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 8px;
            font-size: 24px;
            color: #333;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: 500;
            color: #555;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;

            border-radius: 10px;
            border: 1px solid #ccc;
            margin-top: 6px !important;
            margin-bottom: 12px !important;
        }

        .time-row {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .time-col {
            flex: 1;
        }

        textarea {
            resize: vertical;
        }

        .gradient-button {
            background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.3);

        }

        .gradient-button:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }

        .success {
            text-align: center;
            color: green;
            margin-top: 10px;
        }

        @media (min-width: 600px) {
            .time-row {
                flex-direction: row;
            }
        }



        .invalid-feedback {
            display: none;
            color: red;
            font-size: 13px;
        }

        .was-validated .is-invalid+.invalid-feedback {
            display: block;
        }
    </style>


    <style>
        @media print {

            body,
            html {
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden !important;
            }

            body * {
                visibility: hidden;
            }

            .print-only,
            .print-only * {
                visibility: visible;
            }

            .print-only {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 50vh;
                background: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                margin: 0 !important;
                padding: 0 !important;
                z-index: 9999;
            }

            /* Enlarge QR image and remove margin/padding */
            .print-only #qrcode img {
                width: 330px !important;
                height: 330px !important;
            }

            /* Hide the print button */
            .print-btn {
                display: none !important;
            }

            /* Hide backdrop */
            .modal-backdrop {
                display: none !important;
            }

        }
    </style>

    <style>
        .btn-primary {
            background-color: #915cd1 !important;
        }
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</head>

<body>


    <div class="container-fluid p-0" style=" background:#FAFAF9">
        <div class="row g-0">
            <!-- sidebar   -->
            <?php include 'sidebar.php'; ?>

            <div class="col-lg-9 col-xl-10 col-12  shadow offset-xl-2 offset-lg-3  ">
                <!-- navbar -->
                <?php include 'navbar.php'; ?>



                <div class="wrapper">

                    <div class="form-container">
                        <div class="text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#qrModal">
                                Generate QR
                            </button>
                            <button class="btn btn-primary"
                                onclick="window.location.href='<?= base_url('index.php/AdminController/AllFeedback'); ?>'">
                                View All Feedback
                            </button>
                        </div>

                        <h2>Customer Feedback Entry</h2>
                        <form id="feedbackForm">
                            <div class="row">
                                <div class="row mb-2">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="name" class="px-2">Full Name</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Customer Name">
                                        <div class="invalid-feedback mt-1">Please enter a name.</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="px-2">Email</label>
                                        <input type="email" name="email" id="email" placeholder="Enter your Email">
                                        <div class="invalid-feedback mt-1">Please enter a valid email address.</div>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="phone" class="px-2">Mobile Number</label>
                                        <input type="tel" name="phone" id="phone" class="m-1"
                                            placeholder="Enter Mobile number">
                                        <div class="invalid-feedback mt-1">Please enter a valid mobile number.</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="purpose" class="px-2">Purpose</label>
                                        <select name="purpose" id="purpose" class="m-1">
                                            <option value="">Select Purpose</option>
                                            <option value="Enquiry">Enquiry</option>
                                            <option value="Purchase">Purchase</option>
                                        </select>
                                        <div class="invalid-feedback mt-1">Please select a purpose.</div>
                                    </div>
                                </div>
                                <!-- Date and DOB -->
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="date" class="px-2">Date</label>
                                        <input type="date" name="date" id="date" class="m-1">
                                        <div class="invalid-feedback mt-1">Please select a date.</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="dob" class="px-2">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" class="m-1">
                                        <div class="invalid-feedback mt-1">Please select a Date of Birth.</div>
                                    </div>
                                </div>

                                <!-- In Time and Out Time -->
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="in_time" class="px-2">In Time</label>
                                        <input type="time" name="in_time" id="in_time" class="m-1">
                                        <div class="invalid-feedback mt-1">Please select an entry time.</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="out_time" class="px-2">Out Time</label>
                                        <input type="time" name="out_time" id="out_time" class="m-1">
                                        <div class="invalid-feedback mt-1">Please select an out time.</div>
                                    </div>
                                </div>

                                <!-- Feedback -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="feedback" class="px-2">Feedback</label>
                                        <textarea name="feedback" id="feedback" rows="4" class="m-1"
                                            placeholder="Enter feedback..."></textarea>
                                        <div class="invalid-feedback mt-1">Please enter feedback.</div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary ms-auto">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- QR Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content print-only">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="qrModalLabel">Customer Feedback Form QR Code</h5>
                    <button type="button" class="btn-close print-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="qrcode" style="width: 300px; height: 300px; margin: 0 auto;"></div>
                    <button class="btn btn-success print-btn mt-3" onclick="printQR()">Print QR</button>
                </div>
            </div>
        </div>
    </div>


    <!-- for genarate the qr code and print it -->
    <script>
        // Generate QR when modal opens
        const modal = document.getElementById('qrModal');
        modal.addEventListener('shown.bs.modal', function () {
            const qrContainer = document.getElementById("qrcode");
            qrContainer.innerHTML = ""; // Clear old QR

            new QRCode(qrContainer, {
                text: "http://localhost/sonachandi/index.php/AdminController/feedback",
                width: 300,
                height: 300,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        });

        // Print only modal content
        function printQR() {
            window.print();
        }
    </script>



    <!-- Form Submiting the form -->
    <script>
        document.getElementById("feedbackForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const form = this;
            let isValid = true;

            // Field references
            const name = document.getElementById("name");
            const email = document.getElementById("email");
            const phone = document.getElementById("phone");
            const inTime = document.getElementById("in_time");
            const outTime = document.getElementById("out_time");
            const purpose = document.getElementById("purpose");
            const date = document.getElementById("date");
            const feedback = document.getElementById("feedback");
            const dob = document.getElementById("dob");


            // Get today's date in yyyy-mm-dd format
            const today = new Date().toISOString().split('T')[0];

            // Set max attribute to today's date minus 1 day
            document.getElementById("date").setAttribute("max", today);
            document.getElementById("dob").setAttribute("max", today);

            // Array of all fields
            const fields = [name, email, phone, inTime, outTime, purpose, date, dob, feedback];

            // Reset previous errors
            fields.forEach(input => {
                input.classList.remove("is-invalid");
            });

            // Validation
            if (!name.value.trim()) {
                name.classList.add("is-invalid");
                isValid = false;
            }
            if (!email.value.trim()) {
                email.classList.add("is-invalid");
                isValid = false;
            }
            if (!phone.value.trim() || !/^[6-9]\d{9}$/.test(phone.value)) {
                phone.classList.add("is-invalid");
                isValid = false;
            }
            if (!inTime.value.trim()) {
                inTime.classList.add("is-invalid");
                isValid = false;
            }
            if (!outTime.value.trim()) {
                outTime.classList.add("is-invalid");
                isValid = false;
            }
            if (!purpose.value.trim()) {
                purpose.classList.add("is-invalid");
                isValid = false;
            }
            if (!date.value.trim()) {
                date.classList.add("is-invalid");
                isValid = false;
            }
            if (!dob.value.trim()) {
                dob.classList.add("is-invalid");
                isValid = false;
            }
            if (!feedback.value.trim()) {
                feedback.classList.add("is-invalid");
                isValid = false;
            }

            // Show validation error styles if invalid
            if (!isValid) {

                return;
            }

            // Form is valid — prepare to submit
            let formData = new FormData(form);

            fetch("<?= base_url('AdminController/addFeedbackForm') ?>", {
                method: "POST",
                body: formData
            })
                .then(response => {
                    if (!response.ok) throw new Error("Network response was not ok");
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        });

                        // Reset form
                        form.reset();
                        form.classList.remove("was-validated");
                        fields.forEach(input => input.classList.remove("is-invalid"));
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error("Error in fetch:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again."
                    });
                });
        });



    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>


    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>




</html>