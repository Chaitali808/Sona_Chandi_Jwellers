<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->load->view('common/Commonlinks'); ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wishlist - GlamUp</title>

    <style>
        :root {
            --primary: #5E358E;
            --secondary: #f5f5f5;
            --accent: #b39ddb;
            --text-dark: #2d1a47;
            --text-light: #fff;
            --highlight: #e1bee7;
            --button: #42065680;
            --gold: #66456c;
            --gold-gradient: linear-gradient(90deg, #937fa6 0%, #7c3897 100%);
        }

        body {
            background-color: var(--secondary);
            color: var(--text-dark);
            font-family: 'Segoe UI', 'Poppins', sans-serif;
        }

        .wishlist-header {
            font-weight: 700;
            border-radius: 10px;
            padding: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .wishlist-card {
            border: none;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .wishlist-card:hover {
            transform: translateY(-7px);
        }

        .wishlist-card img {
            border-radius: 12px;
            height: 220px;
            object-fit: cover;
        }

        .card-title {
            font-weight: 600;
            color: var(--primary);
        }

        .btn-cart {
            background-color: var(--primary);
            color: var(--text-light);
            border-radius: 25px;
            padding: 6px 16px;
            font-weight: 500;
        }

        .btn-cart:hover {
            background-color: #4c2b72;
        }

        .remove-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.85;
            background-color: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }


        .remove-icon:hover {
            background-color: #310f5d;
            transform: scale(1.1);
            opacity: 0.7;
        }

        @media (max-width: 576px) {
            .wishlist-card img {
                height: 180px;
            }
        }
    </style>

    <style>
        .wishlist-img {
            width: 100%;
            height: 220px;
            /* Adjust height as needed */
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>

<body>

    <?php $this->load->view('common/navbar'); ?>
    <div class="container py-5">
        <h2 class="text-center wishlist-header mb-5" style="font-family: Cormorant Garamond; color: #2d1a47;">My
            Wishlist</h2>
        <div class="row g-4 justify-content-center">

            <?php foreach ($products as $product): ?>
                <?php
                $weightData = json_decode($product->weight, true);
                $caratData = json_decode($product->carat, true);
                $typeArray = json_decode($product->type, true);
                $rates = $rates ?? []; // Coming from controller
            
                if (empty($weightData) || !is_array($weightData))
                    return;

                $total_material_price = 0;
                $total_weight_gram = 0;

                foreach ($weightData as $material => $weight_gram) {
                    $weight_gram = floatval($weight_gram);
                    $total_weight_gram += $weight_gram;

                    $material_lower = strtolower($material);
                    $carat = $caratData[$material] ?? '';
                    $rate_key = strtolower((string) $carat); // For keys like "22", "99.9", "fl"
            
                    $price_per_gram = 0;
                    if (in_array($material_lower, ['gold', 'silver', 'platinum'])) {
                        $price_per_gram = $rates[$material_lower][$rate_key] ?? 0;
                    } elseif ($material_lower === 'diamond') {
                        $price_per_gram = $rates['diamond'][$rate_key] ?? 0;
                    }

                    $material_price = $weight_gram * $price_per_gram;
                    $total_material_price += $material_price;
                }

                // Charges and taxes
                $making_charges = (float) $product->making_charges;
                $discount = (float) $product->discount_percentage;
                $gst = (float) $product->gst;
                $other_charges = (float) $product->other_charges; // New section
            
                // Apply discount on making charges
                $discount_amount = $making_charges * $discount / 100;
                $discounted_making = $making_charges - $discount_amount;

                // Subtotal before GST
                $subtotal = $total_material_price + $discounted_making + $other_charges;

                // GST
                $gst_amount = $subtotal * $gst / 100;

                // Final total
                $total_price = $subtotal + $gst_amount;
                ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card wishlist-card p-3">
                        <button class="remove-icon btn btn-sm btn-danger rounded-circle" title="Remove"
                            data-product-id="<?= $product->id ?>"
                            style="width: 32px; height: 32px; line-height: 16px; padding: 0; text-align: center;">
                            <i class="bi bi-x-lg"></i>
                        </button>


                        <!-- Product Image -->
                        <img src="<?= base_url($product->image) ?>" class="img-fluid wishlist-img rounded card-img-top"
                            alt="<?= $product->product_name ?>">

                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Cormorant Garamond;">
                                <?= $product->product_name ?>
                            </h5>

                            <p class="card-text mb-3" style="font-family: garet;">
                                Price: <strong>₹<?= number_format($total_price, 2) ?></strong>
                            </p>

                            <button class="btn btn-cart w-100" style="background-color: #310f5d; color:white"
                                onclick="addToCart(<?= $product->id ?>)">
                                Add to Cart
                            </button>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>




        </div>
    </div>
    <?php $this->load->view('common/chatbot'); ?>
    <?php $this->load->view('common/footer'); ?>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const removeButtons = document.querySelectorAll('.remove-icon');

            removeButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    const card = this.closest('.col-md-4'); // or .product-card based on your layout

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to remove this item from your wishlist?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, remove it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("<?= base_url('UserController/removeFromWishlist') ?>", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: `product_id=${productId}`
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'removed') {
                                        Swal.fire({
                                            title: 'Removed!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 3000,
                                            showConfirmButton: false
                                        });
                                        if (card) card.remove(); // remove product card from UI
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 3000,
                                            showConfirmButton: false
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Something went wrong.',
                                        icon: 'error',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>

    <script>
      function addToCart(productId) {
    fetch("<?= base_url('UserController/addToCart') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "product_id=" + encodeURIComponent(productId)
    })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: data.status === "success" ? "Added to Cart" : "Failed",
                text: data.message,
                icon: data.status,
                timer: 2000,
                showConfirmButton: false
            });

            if (data.status === "success") {
                setTimeout(() => {
                    window.location.href = "<?= base_url('UserController/finalcart') ?>";
                }, 2000);
            }
        })
        .catch(error => {
            Swal.fire("Error", "Server Error: " + error.message, "error");
        });
}

    </script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>