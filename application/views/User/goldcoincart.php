<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 Gram 24 KT Gold Coin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">

</head>

<body>

    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <div class="container my-4">

        <?= print_r($product); ?>

        <!-- Breadcrumb -->
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('UserController/home'); ?>" ">HOME</a></li>
                        <li class=" breadcrumb-item"><a href="<?php echo base_url('UserController/goldcoins'); ?>">Gold
                                    Coins</a></li>
                        <li class=" breadcrumb-item active" aria-current="page">2 Gram 24 KT Gold Coin</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Left: Product Image -->
            <div class="col-md-6 text-center mb-4">
                <img src="<?php echo base_url('assets\products\goldcoin.png'); ?>" alt="2 Gram 24 KT Gold Coin"
                    class="img-fluid" style="max-width: 300px;">
            </div>

            <!-- Right: Product Details -->
            <div class="col-md-6">
                <h2 class="fw-bold" style="font-family: 'Cormorant Garamond', serif; color: #420A5C !important;">2 Gram
                    24 KT Gold Coin</h2>
                <p class="fs-4 fw-semibold">Rs. 20,089</p>
                <div class="d-flex align-items-center mb-3">
                    <div class="text-warning">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <span class="ms-2 text-muted">40 (56)</span>
                    <a href="#" class="ms-2 text-muted text-decoration-none">WRITE A REVIEW</a>
                </div>

                <!-- Pincode Input -->
                <p class="text-muted">Lorem ipsum dolor sit amet consectetur</p>
                <div class="mb-3">
                    <label for="pincode" class="form-label fw-semibold">Enter Your Pincode</label>
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" id="pincode"
                            placeholder="Provide pincode for delivery date & nearby stores">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>

                <!-- Buttons -->
                <button class="btn text-white mb-3"
                    style="background: linear-gradient(90deg, #6f42c1, #a855f7); width: 200px;">Buy Now</button>
                <div>
                    <a href="#" class="text-muted text-decoration-none wishlist-btn">
                        <i class="bi bi-heart me-1"></i> Save to Wishlist
                    </a>

                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const wishlistButtons = document.querySelectorAll(".wishlist-btn");

            wishlistButtons.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    const icon = this.querySelector("i");

                    if (icon.classList.contains("bi-heart")) {
                        icon.classList.remove("bi-heart");
                        icon.classList.add("bi-heart-fill");
                        icon.classList.add("text-danger"); // makes it red
                    } else {
                        icon.classList.remove("bi-heart-fill");
                        icon.classList.add("bi-heart");
                        icon.classList.remove("text-danger");
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>