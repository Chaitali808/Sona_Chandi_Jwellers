<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sona Chandi Plan</title>
    <?php $this->load->view('common/Commonlinks'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }

        .p {
            font-family: garet;
        }

        .h1 {
            font-family: Cormorant Garamond;
        }

        .main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 12px;
        }

        .hero-section {
            position: relative;
            width: 100%;
        }

        .hero-section img.hero-bg {
            width: 100%;
            height: 700px;
            object-fit: cover;
            object-position: left top;
            display: block;
        }

        .offer-img-group {
            position: absolute;
            top: 30%;
            right: 5vw;
            transform: translateY(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            width: 370px;
            max-width: 90vw;
        }

        .offer-img-group img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .offer-img-main {
            width: 340px;
            margin-bottom: 10px;
        }

        .offer-img-sub {
            width: 320px;
        }

        .subscription-form-card {
            position: relative;
            top: -32px;
            margin-bottom: -32px;
            z-index: 3;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            background: #fff;
            padding: 0.7rem 1rem 0.7rem 1rem;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            border: 1px solid #bdbdbd;
            font-size: 1rem;
            height: 44px;
            background: #fafafa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #b39ddb;
            box-shadow: 0 0 0 0.1rem #b39ddb33;
            background: #fff;
        }

        .btn-purple {
            background: #b39ddb;
            color: #fff;
            font-weight: 700;
            border-radius: 6px;
            border: 1px solid #b39ddb;
            height: 44px;
            font-size: 1rem;
        }

        .btn-purple:hover {
            background: #9575cd;
            border-color: #9575cd;
            color: #fff;
        }

        .calculator-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            padding: 2.2rem 2rem 2rem 2rem;
            /*            margin-top: 2.5rem; */
            border: 1px solid #e0e0e0;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .calculator-box h4 {
            color: #bdbdbd;
            font-weight: 800;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            font-size: 1.2rem;
            font-family: garet;
        }

        .pie-chart img {
            width: 230px;
            margin-bottom: 10px;
        }

        .pie-chart p {
            color: #b39ddb;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .result p {
            font-size: 1rem;
            color: #444;
            margin-bottom: 0.7rem;
        }

        .highlight-text {
            color: #b39ddb;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .result .row {
            align-items: center;
        }

        .result-label {
            color: #888;
            font-weight: 500;
        }

        .result-value {
            text-align: right;
            font-weight: 500;
        }

        .result-hr {
            border-top: 1.5px solid #e0e0e0;
            margin: 0.7rem 0;
        }

        @media (max-width: 991px) {
            .main-wrapper {
                max-width: 100vw;
                padding: 0 2vw;
            }

            .hero-section img.hero-bg {
                height: 400px;
            }

            .offer-img-group {
                width: 220px;
                right: 2vw;
                top: 50%;
            }

            .offer-img-main {
                width: 200px;
            }

            .offer-img-sub {
                width: 180px;
            }

            .calculator-box,
            .subscription-form-card {
                width: 100%;
                padding-left: 2vw;
                padding-right: 2vw;
            }
        }

        @media (max-width: 767px) {
            .hero-section img.hero-bg {
                height: 200px;
                border-radius: 0 0 8px 8px;
            }

            .offer-img-group {
                width: 80px;
                right: 4vw;
                top: 10px;
                transform: none;
            }

            .offer-img-main {
                width: 110px;

            }

            .offer-img-sub {
                width: 100px;
            }

            .calculator-box,
            .subscription-form-card {
                padding: 1rem;
            }

            .pie-chart img {
                width: 150px;
                margin-top: 10px;
            }

            .input-group {
                height: 20px;

            }
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <img src="<?php echo base_url("/assets/Images/schemeimage/scheme1.png"); ?>" alt="Jewelry Image"
            class="hero-bg w-100">
        <div class="offer-img-group">
            <img src="<?php echo base_url("/assets/Images/schemeimage/scheme2.png"); ?>"
                alt="10 + 1 Monthly Installment Plan" class="offer-img-main">
            <img src="<?php echo base_url("/assets/Images/schemeimage/scheme3.png"); ?>"
                alt="Pay 10 installments and get 100% off on 11th installment" class="offer-img-sub">
        </div>
    </div>

    <!-- Subscription Form -->
    <div style="margin:0px 40px;">
        <div class="subscription-form-card shadow-sm">
            <form id="subscriptionForm" class="row g-2 align-items-center justify-content-center"
                aria-label="Subscription form">
                <div class="col-md-3 col-12 mb-2 mb-md-0">
                    <input type="number" class="form-control" id="formMonthlyAmount" placeholder="Enter Monthly Amount"
                        aria-label="Monthly Amount">
                </div>
                <div class="col-md-3 col-12 mb-2 mb-md-0">
                    <input type="text" class="form-control" id="mobileNumber" placeholder="Enter Mobile No."
                        aria-label="Mobile Number" pattern="[0-9]{10}">
                </div>
                <div class="col-md-2 col-6 mb-2 mb-md-0">
                    <select class="form-select" id="subscription_schemeType" name="subscription_schemeType"
                        aria-label="Scheme Type" onchange="updateSubscriptionCategoryOptions()">
                        <option selected disabled value="">Scheme Type</option>
                        <option value="10+2">10+2</option>
                        <option value="11+1">11+1</option>
                        <option value="12+0">12+0</option>
                    </select>
                </div>

                <div class="col-md-2 col-6 mb-2 mb-md-0">
                    <select class="form-select" id="subscription_category" name="subscription_category"
                        aria-label="Category" disabled>
                        <option selected disabled value="">Category</option>
                    </select>
                </div>
                <div class="col-md-2 col-4 d-grid">
                    <button type="submit" class="btn btn-purple" aria-label="Subscribe">Subscribe</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateSubscriptionCategoryOptions() {
            const scheme = document.getElementById('subscription_schemeType').value;
            const category = document.getElementById('subscription_category');
            category.innerHTML = ''; // Clear existing options

            let options = [];

            if (scheme === '10+2') {
                options = ['Diamond'];
            } else if (scheme === '11+1') {
                options = ['Gold', 'Diamond', 'Silver'];
            } else if (scheme === '12+0') {
                options = ['Gold'];
            }

            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.disabled = true;
            defaultOption.selected = true;
            defaultOption.textContent = 'Category';
            defaultOption.value = '';
            category.appendChild(defaultOption);

            // Add new options
            options.forEach(opt => {
                const optionElement = document.createElement('option');
                optionElement.value = opt;
                optionElement.textContent = opt;
                category.appendChild(optionElement);
            });

            // Enable category dropdown
            category.disabled = false;
        }
    </script>


    <!-- Calculator Section -->
    <div class="calculator-box">
        <h4 class="mb-4">Gold Mine Calculator</h4>
        <div class="row justify-content-center mb-4 calculator-form">
            <div class="col-md-3 col-6 mb-2 mb-md-0">
                <select class="form-select" id="calcScheme" required>
                    <option selected disabled>Choose Scheme</option>
                    <option value="11+1">11+1</option>
                    <option value="10+2">10+2</option>
                    <option value="12+0">12+0</option>
                </select>
            </div>
            <div class="col-md-4 col-6">
                <div class="input-group">
                    <input type="number" id="monthlyAmount" class="form-control" placeholder="Enter Monthly Amount"
                        required>
                    <button class="btn btn-purple" type="button" id="calculateBtn">Check</button>
                </div>
            </div>
        </div>

        <div class="row gy-4 align-items-center">
            <div class="col-md-4 text-center pie-chart mb-4 mb-md-0">
                <canvas id="pieChart" width="200" height="200"
                    style="display: block; margin: 0 auto 10px; max-width: 200px; max-height: 200px;"></canvas>
                <p style="font-family: garet;"><strong>You Pay:</strong> <span id="displayPay">Rs. 0</span></p>
            </div>
            <div class="col-md-8">
                <div class="row mb-2">
                    <div class="col-8 result-label">Your total payment (as per scheme)</div>
                    <div class="col-4 result-value" id="totalPayment">Rs. 0</div>
                </div>
                <div class="row mb-2">
                    <div class="col-8 result-label" id="discountLabel"><span id="discountDesc">Discount</span></div>
                    <div class="col-4 result-value" id="discount">Rs. 0</div>
                </div>
                <div class="result-hr"></div>
                <div class="row mb-2">
                    <div class="col-8 result-label">Buy any jewellery worth (after maturity)</div>
                    <div class="col-4 result-value highlight-text" id="jewelleryWorth">Rs. 0</div>
                </div>
                <div class="result-hr"></div>
                <div class="row mb-2">
                    <div class="col-8 result-label">You effectively pay</div>
                    <div class="col-4 result-value" id="effectivePay">Rs. 0</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>

    <script>
        document.getElementById("subscriptionForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const amount = document.getElementById("formMonthlyAmount").value.trim();
            const mobile = document.getElementById("mobileNumber").value.trim();
            const category = document.getElementById("subscription_category").value;
            const scheme = document.getElementById("subscription_schemeType").value;


            // Validation
            if (amount === "" || amount <= 0) {
                Swal.fire("Validation Error", "Please enter a valid Monthly Amount.", "warning");
                return;
            }

            if (!/^\d{10}$/.test(mobile)) {
                Swal.fire("Validation Error", "Please enter a valid 10-digit mobile number.", "warning");
                return;
            }

            if (!category || category === "Category") {
                Swal.fire("Validation Error", "Please select a category.", "warning");
                return;
            }

            if (!scheme || scheme === "Scheme Type") {
                Swal.fire("Validation Error", "Please select a scheme type.", "warning");
                return;
            }

            // AJAX request
            fetch("<?= base_url('UserController/submitSchemeForm') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    monthlyAmount: amount,
                    mobileNumber: mobile,
                    category: category,
                    schemeType: scheme
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire("Success", data.message, "success");
                        document.getElementById("subscriptionForm").reset();
                    } else {
                        // Check if the error message is the login required one
                        if (data.message === "Login required to submit subscription.") {
                            Swal.fire({
                                title: "Login Required",
                                text: data.message,
                                icon: "warning",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.href = "<?= base_url('UserController/home') ?>";
                            });
                        } else {
                            Swal.fire("Error", data.message || "Submission failed!", "error");
                        }
                    }
                })
                .catch(() => {
                    Swal.fire("Error", "Something went wrong. Please try again.", "error");
                });
        });
    </script>

    <script>
        document.getElementById('category')?.addEventListener('change', function () {
            const category = this.value;
            const schemeDropdown = document.getElementById('schemeType');
            schemeDropdown.innerHTML = '<option disabled selected>Scheme Type</option>';

            if (category === 'Diamond') {
                schemeDropdown.innerHTML += '<option value="10+2">10+2</option>';
                schemeDropdown.innerHTML += '<option value="11+1">11+1</option>';
                schemeDropdown.innerHTML += '<option value="12+0">12+0</option>';
            } else if (category === 'Gold' || category === 'Silver') {
                schemeDropdown.innerHTML += '<option value="11+1">11+1</option>';
                schemeDropdown.innerHTML += '<option value="12+0">12+0</option>';
            }
        });

        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Your Payment', 'Discount'],
                datasets: [{
                    data: [1, 0],
                    backgroundColor: ['#b39ddb', '#f48fb1'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            padding: 10,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: Rs. ${context.parsed.toLocaleString()}`;
                            }
                        }
                    }
                },
                layout: {
                    padding: 0
                }
            }
        });

        document.getElementById('calculateBtn').addEventListener('click', function () {
            const amount = parseFloat(document.getElementById('monthlyAmount').value);
            const scheme = document.getElementById('calcScheme').value;

            if (!amount || !scheme) {
                alert("Please enter amount and select scheme.");
                return;
            }

            let totalMonths = 0;
            let freeInstallment = 0;
            let makingFree = false;

            if (scheme === '11+1') {
                totalMonths = 11;
                freeInstallment = 1;
            } else if (scheme === '10+2') {
                totalMonths = 10;
                freeInstallment = 2;
            } else if (scheme === '12+0') {
                totalMonths = 12;
                freeInstallment = 0;
                makingFree = true;
            }

            const totalPayment = amount * totalMonths;
            const discount = amount * freeInstallment;
            const jewelleryWorth = totalPayment + discount;
            const effectivePay = totalPayment;

            document.getElementById('totalPayment').textContent = `Rs. ${totalPayment.toLocaleString()}`;
            document.getElementById('discount').textContent = makingFree
                ? "Making Charges Waived"
                : `Rs. ${discount.toLocaleString()}`;
            document.getElementById('jewelleryWorth').textContent = makingFree
                ? `Rs. ${totalPayment.toLocaleString()} (No Making Charges)`
                : `Rs. ${jewelleryWorth.toLocaleString()}`;
            document.getElementById('effectivePay').textContent = `Rs. ${effectivePay.toLocaleString()}`;
            document.getElementById('displayPay').textContent = `Rs. ${totalPayment.toLocaleString()}`;
            document.getElementById('discountDesc').textContent = makingFree
                ? 'Making Charges Waived'
                : `100% Discount on ${freeInstallment} installment(s)`;

            pieChart.data.datasets[0].data = makingFree
                ? [totalPayment, 0]
                : [totalPayment, discount];
            pieChart.update();
        });
    </script>






    <!-- SweetAlert2 -->

</body>

</html>