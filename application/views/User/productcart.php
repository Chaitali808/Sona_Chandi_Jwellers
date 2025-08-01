<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diamond Bracelet</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Zoom & Thumbnail Styling -->
  <style>
    .main-img-wrapper {
      position: relative;
      width: 100%;
      overflow: hidden;
    }

    .main-img-wrapper img {
      width: 100%;
      display: block;
    }

    .zoom-lens {
      position: absolute;
      border: 1px solid #000;
      width: 100px;
      height: 100px;
      background: rgba(255, 255, 255, 0.4);
      display: none;
      pointer-events: none;
    }

    .zoom-result {
      position: absolute;
      left: 105%;
      top: 0;
      width: 400px;
      height: 400px;
      border: 1px solid #ccc;
      background-repeat: no-repeat;
      display: none;
      z-index: 100;
    }


    @media(max-width: 767px) {
      .zoom-result {
        display: none !important;
      }
    }

    .main-img-wrapper:hover img {
      transform: scale(1.5);
      cursor: zoom-out;
    }

    .thumbnail-img {
      max-width: 100%;
      height: 80px;
      cursor: pointer;
      border: 2px solid transparent;
      border-radius: 4px;
    }

    .thumbnail-img.active {
      border-color: #6f42c1;
    }

    .modal-margin-top .modal-dialog {
      margin-top: 90px;
      /* Adjust the value as needed */
    }
  </style>


  <style>
    .add-to-cart-btn {
      width: 75%;
      background: linear-gradient(90deg, #eecdf2 0%, #b53fc2 100%);
      color: #fff;
      border: none;
      border-radius: 0.7rem;
      font-weight: 600;
      margin-top: .4rem;
      margin-bottom: .2rem;
      box-shadow: 0 2px 6px rgba(156, 96, 221, 0.09);
      opacity: 1;
      transform: translateY(30px);
      transition: all 0.33s cubic-bezier(.4, 2, .6, 1);
      font-size: 1rem;
      letter-spacing: .5px;
    }

    .card:hover .add-to-cart-btn {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body>
  <?php $this->load->view('common/navbar'); ?>


  <?php
  // Decode product data safely
  $weightData = json_decode($product->weight ?? '{}', true);
  $caratData = json_decode($product->carat ?? '{}', true);


  $basePrice = 0;

  if (is_array($weightData)) {
    foreach ($weightData as $metal => $weightGram) {
      $metalLower = strtolower($metal);
      $weightGram = (float) $weightGram;

      if (isset($rates[$metalLower])) {
        $purityKey = $caratData[$metal] ?? null;

        // Normalize keys (e.g., 24K -> 24)
        if ($metalLower == 'gold' && strpos($purityKey, 'k') !== false) {
          $purityKey = str_replace('k', '', strtolower($purityKey));
        }

        $purityKey = strtolower(trim($purityKey ?? ''));

        // Use default value if not provided
        if (!$purityKey || !isset($rates[$metalLower][$purityKey])) {
          // Fallback values
          if ($metalLower == 'gold')
            $purityKey = '22';
          elseif ($metalLower == 'silver')
            $purityKey = '92.5';
          elseif ($metalLower == 'platinum')
            $purityKey = '95.0';
          elseif ($metalLower == 'diamond')
            $purityKey = 'si1';
        }

        $rate = $rates[$metalLower][$purityKey] ?? 0;
        $basePrice += $weightGram * $rate;
      }
    }
  }

  // Charges & Taxes
  $makingCharges = isset($product->making_charges) ? (float) $product->making_charges : 0;
  $discountPercentage = isset($product->discount_percentage) ? (float) $product->discount_percentage : 0;
  $gstPercentage = isset($product->gst) ? (float) $product->gst : 0;
  $otherCharges = isset($product->other_charges) ? (float) $product->other_charges : 0;

  // Apply discount on making charges
  $discountAmount = $makingCharges * $discountPercentage / 100;
  $discountedMaking = $makingCharges - $discountAmount;

  // Final calculation with optional other charges
  $subtotal = $basePrice + $discountedMaking + ($otherCharges > 0 ? $otherCharges : 0);
  $gstAmount = $subtotal * $gstPercentage / 100;
  $totalPrice = $subtotal + $gstAmount;

  // Optional calculation without discount
  $subtotalWithoutDiscount = $basePrice + $makingCharges + ($otherCharges > 0 ? $otherCharges : 0);
  $gstWithoutDiscount = $subtotalWithoutDiscount * $gstPercentage / 100;
  $totalPriceWithoutDiscount = $subtotalWithoutDiscount + $gstWithoutDiscount;

  // Star Rating (if needed)
  $rating = isset($rating) ? $rating : 0;
  $fullStars = floor($rating);
  $emptyStars = 5 - $fullStars;
  ?>

  <div class="container my-5">
    <div class="row">
      <!-- LEFT: IMAGE SECTION -->
      <div class="col-md-6 d-flex align-items-center justify-content-center mb-4">
        <div id="productImageCarousel" class="carousel slide w-75 p-4" data-bs-ride="carousel">
          <div class="carousel-inner ratio ratio-1x1">
            <div class="carousel-item active">
              <img src="<?= base_url($product->image ?? 'assets/img/default.png'); ?>"
                alt="<?= htmlspecialchars($product->product_name ?? 'Product'); ?>"
                class="d-block w-100 h-100 object-fit-contain">
            </div>

            <?php if (!empty($product->images) && is_array($product->images)): ?>
              <?php foreach ($product->images as $img): ?>
                <div class="carousel-item">
                  <img src="<?= base_url($img->image_path ?? 'assets/img/default.png'); ?>"
                    alt="<?= htmlspecialchars($product->product_name ?? 'Product'); ?>"
                    class="d-block w-100 h-100 object-fit-contain">
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <?php if (!empty($product->images) && is_array($product->images)): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          <?php endif; ?>
        </div>
      </div>

      <!-- RIGHT: PRODUCT DETAILS -->
      <div class="col-md-6">
        <h2 class="fw-bold" style="font-family: 'Cormorant Garamond', serif; color: #420A5C;">
          <?= htmlspecialchars($product->product_name ?? '', ENT_QUOTES, 'UTF-8') ?>
        </h2>
        <p class="fs-4 fw-semibold">
          ₹<?= number_format($totalPrice, 2) ?>
          <span class="text-decoration-line-through text-muted">
            ₹<?= number_format($totalPriceWithoutDiscount, 2) ?>
          </span>
        </p>
        <p class="text-muted">
          <?= htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8') ?>
        </p>

        <div class="d-flex align-items-center mb-3">
          <div class="text-warning">
            <?php for ($i = 0; $i < $fullStars; $i++): ?>
              <i class="fas fa-star"></i>
            <?php endfor; ?>
            <?php for ($i = 0; $i < $emptyStars; $i++): ?>
              <i class="far fa-star"></i>
            <?php endfor; ?>
          </div>

          <a href="#" class="ms-2 text-muted text-decoration-none" data-bs-toggle="modal"
            data-bs-target="#productFeedbackModal" data-product-id="<?= $product->id ?? 0 ?>">WRITE A REVIEW</a>
        </div>

        <p class="fw-semibold">METAL:
          <?php
          if (is_array($weightData)) {
            foreach ($weightData as $metal => $weightGram) {
              echo htmlspecialchars(ucfirst(strtolower($metal))) . ": " . htmlspecialchars($weightGram) . " gm, ";
            }
          }
          ?>
        </p>

        <div class="row">
          <div class="col-md-8 mb-3">
            <button class="btn text-white mb-3" onclick="addToCart(<?= $product->id ?? 0 ?>)"
              style="background: linear-gradient(90deg, #6f42c1, #a855f7); width: 100%;">
              Add to Cart
            </button>
          </div>
          <div class="col-md-4 mb-3">
            <div class="mb-3">
              <a href="#" class="text-muted text-decoration-none wishlist-btn d-flex align-items-center"
                data-product-id="<?= $product->id ?? 0 ?>" style="width: 100%;">
                <i class="bi <?= !empty($isInWishlist) ? 'bi-heart-fill text-danger' : 'bi-heart' ?> me-2 fs-4"></i>
                <span class="fw-semibold">Save to Wishlist</span>
              </a>
            </div>

          </div>
        </div>

        <!-- PRICE BREAKDOWN -->
        <div class="border-top pt-3">
          <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse"
            href="#priceBreakdownCollapse" role="button" aria-expanded="false" aria-controls="priceBreakdownCollapse">
            <span class="fs-6 fw-semibold text-dark">Price Breakdown</span>
            <span class="toggle-icon fs-5 text-primary">+</span>
          </a>

          <div class="collapse mt-2" id="priceBreakdownCollapse">
            <div class="card shadow-sm border-0 rounded-3 bg-white p-3">
              <div class="d-flex justify-content-between mb-1">
                <span class="text-muted small">Base Price</span>
                <strong class="text-dark small">&#8377;<?= number_format($basePrice, 2) ?></strong>
              </div>

              <div class="d-flex justify-content-between mb-1">
                <span class="text-muted small">Making Charges</span>
                <strong class="text-dark small">&#8377;<?= number_format($makingCharges, 2) ?></strong>
              </div>

              <div class="d-flex justify-content-between mb-1">
                <span class="text-muted small">Discount (<?= $discountPercentage ?>%)</span>
                <strong class="text-danger small">-&#8377;<?= number_format($discountAmount, 2) ?></strong>
              </div>

              <?php if (!empty($otherCharges)): ?>
                <div class="d-flex justify-content-between mb-1">
                  <span class="text-muted small">Other Charges</span>
                  <strong class="text-dark small">&#8377;<?= number_format($otherCharges, 2) ?></strong>
                </div>
              <?php endif; ?>

              <div class="d-flex justify-content-between mb-1">
                <span class="text-muted small">Subtotal</span>
                <strong class="text-dark small">&#8377;<?= number_format($subtotal, 2) ?></strong>
              </div>

              <div class="d-flex justify-content-between mb-1">
                <span class="text-muted small">GST (<?= $gstPercentage ?>%)</span>
                <strong class="text-dark small">&#8377;<?= number_format($gstAmount, 2) ?></strong>
              </div>

              <hr class="my-2">

              <div class="d-flex justify-content-between">
                <span class="fw-semibold text-dark">Final Price</span>
                <span class="fw-bold text-success">&#8377;<?= number_format($totalPrice, 2) ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- PRODUCT SPECIFICATIONS -->
        <div class="border-top pt-3">
          <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse"
            href="#productSpecsCollapse" role="button" aria-expanded="false" aria-controls="productSpecsCollapse">
            <span class="fs-6 fw-semibold text-dark">Product Specifications</span>
            <span class="toggle-icon fs-5 text-primary">+</span>
          </a>

          <div class="collapse mt-2" id="productSpecsCollapse">
            <div class="card shadow-sm border-0 rounded-3 bg-white p-3">
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Size</span>
                <strong class="text-dark small"><?= htmlspecialchars($product->size ?? '-') ?> mm</strong>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Length</span>
                <strong class="text-dark small"><?= htmlspecialchars($product->length ?? '-') ?> mm</strong>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Height</span>
                <strong class="text-dark small"><?= htmlspecialchars($product->height ?? '-') ?> mm</strong>
              </div>
              <div class="d-flex justify-content-between">
                <span class="text-muted small">Width</span>
                <strong class="text-dark small"><?= htmlspecialchars($product->width ?? '-') ?> mm</strong>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>


  <!-- Similar Products Section -->
  <div class="container-fluid my-4 py-4"
    style="background: linear-gradient(to bottom, #EFDEF5 0%, #fff 100%); border-radius: 16px;">
    <h3 class="text-center mb-4 fw-bold" style="font-family: 'Cormorant Garamond', serif; color: #420A5C !important;">
      Similar Products
    </h3>

    <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center mx-0">
      <?php

      if (!empty($similarProducts) && is_array($similarProducts)) {
        foreach (array_slice($similarProducts, 0, 4) as $product) {
          // Decode safely
          $weightData = json_decode($product->weight ?? '{}', true);
          $caratData = json_decode($product->carat ?? '{}', true);

          // Initialize base price and rate mapping
          $basePrice = 0;
          $pricePerGram = [];

          if (is_array($weightData)) {
            foreach ($weightData as $metal => $weightGram) {
              $metalLower = strtolower($metal);
              $weightGram = (float) $weightGram;

              // Get carat/type key
              if ($metalLower === 'gold') {
                $caratValue = isset($caratData['Gold']) ? (int) $caratData['Gold'] : 22;
                $caratKey = (string) $caratValue;
              } elseif (isset($caratData[$metal])) {
                $caratKey = strtolower(trim($caratData[$metal]));
              } else {
                $caratKey = array_key_first($rates[$metalLower] ?? []);
              }

              // Get rate from defined rates
              if (isset($rates[$metalLower][$caratKey])) {
                $pricePerGram[$metalLower] = $rates[$metalLower][$caratKey];
                $basePrice += $weightGram * $pricePerGram[$metalLower];
              }
            }
          }

          $makingCharges = isset($product->making_charges) ? (float) $product->making_charges : 0;
          $discountPercentage = isset($product->discount_percentage) ? (float) $product->discount_percentage : 0;
          $gstPercentage = isset($product->gst) ? (float) $product->gst : 0;
          $otherCharges = isset($product->other_charges) ? (float) $product->other_charges : 0;

          $discountAmount = $makingCharges * $discountPercentage / 100;
          $discountedMaking = $makingCharges - $discountAmount;

          $subtotal = $basePrice + $discountedMaking + $otherCharges;
          $gstAmount = $subtotal * $gstPercentage / 100;
          $totalPrice = $subtotal + $gstAmount;
          ?>
          <div class="col px-2">
            <div class="card h-100 border-0 text-center shadow-none bg-transparent d-flex flex-column">
              <div class="image-wrapper mx-auto" style="height: 200px; width: 200px; overflow: hidden;">
                <img src="<?= base_url($product->image ?? 'assets/img/default.png'); ?>"
                  alt="<?= htmlspecialchars($product->product_name ?? 'Product'); ?>" class="img-fluid"
                  style="height: 100%; width: 100%; object-fit: contain;">
              </div>
              <div class="card-body p-0 d-flex flex-column justify-content-end">
                <h6 class="card-title mt-2"><?= htmlspecialchars($product->product_name ?? ''); ?></h6>
                <p class="card-text fw-semibold mb-2">
                  ₹<?= number_format($totalPrice, 2); ?>
                </p>
              </div>
              <div class="text-center">
                <a href="<?= base_url('UserController/productcart/' . ($product->id ?? 0)); ?>" class="btn add-to-cart-btn">
                  View Details
                </a>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        echo '<p class="text-center">No similar products found.</p>';
      }
      ?>
    </div>
  </div>





  <!-- script for add and remove from wishlist -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".wishlist-btn").forEach(btn => {
        btn.addEventListener("click", function (e) {
          e.preventDefault();
          const icon = this.querySelector("i");
          const productId = this.getAttribute("data-product-id");

          if (icon.classList.contains("bi-heart")) {
            // Add to wishlist
            fetch("<?= base_url('UserController/addToWishlist') ?>", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              body: "product_id=" + productId
            })
              .then(res => res.json())
              .then(data => {
                if (data.status === 'error') {
                  // Show login required alert
                  Swal.fire({
                    title: "Login Required",
                    text: data.message,
                    icon: "warning",
                    confirmButtonText: "OK"
                  }).then(() => {
                    window.location.href = "<?= base_url('UserController/home ') ?>"; // redirect to home
                  });
                } else {
                  // Wishlist added
                  icon.classList.replace("bi-heart", "bi-heart-fill");
                  icon.classList.add("text-danger");
                  Swal.fire({
                    title: "Added!",
                    text: data.message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                  });
                }
              });
          } else {
            // Remove from wishlist
            fetch("<?= base_url('UserController/removeFromWishlist') ?>", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              body: "product_id=" + productId
            })
              .then(res => res.json())
              .then(data => {
                icon.classList.replace("bi-heart-fill", "bi-heart");
                icon.classList.remove("text-danger");
                Swal.fire({
                  title: "Removed!",
                  text: data.message,
                  icon: "info",
                  showConfirmButton: false,
                  timer: 2000
                });
              });
          }
        });
      });
    });
  </script>



  <?php $this->load->view('common/footer'); ?>
  <?php $this->load->view('common/chatbot'); ?>
  <!-- script for the add to cart button -->
  <script>
    function addToCart(productId) {
      const formData = new URLSearchParams();
      formData.append('product_id', productId);

      fetch("<?= base_url('UserController/addToCart') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: formData.toString()
      })
        .then(async response => {
          const text = await response.text();
          try {
            const data = JSON.parse(text);

            if (data.status === "success") {
              Swal.fire({
                title: "Added to Cart",
                text: data.message,
                icon: "success",
                showConfirmButton: false,
                timer: 2000
              }).then(() => {
                window.location.href = "<?= base_url('UserController/finalcart') ?>";
              });
            } else if (data.status === "error") {
              Swal.fire({
                title: "Login Required",
                text: data.message,
                icon: "warning",
                confirmButtonText: "Login"
              }).then(() => {
                window.location.href = "<?= base_url('UserController/home') ?>";
              });
            } else {
              Swal.fire("Notice", data.message, "info");
            }

          } catch (e) {
            console.error("Invalid JSON from server:", text);
            Swal.fire("Error", "Unexpected server response. Please try again.", "error");
          }
        })
        .catch(error => {
          Swal.fire("Error", "Server Error: " + error.message, "error");
        });
    }
  </script>


  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert CDN (put in <head> or before </body>) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Product Feedback Modal -->
  <div class="modal fade modal-margin-top" id="productFeedbackModal" tabindex="-1"
    aria-labelledby="productFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #5e358e; color: white;">
          <h5 class="modal-title" id="productFeedbackModalLabel">Write a Product Review</h5>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"
            style="opacity: 0.8;"></button>
        </div>

        <form id="productFeedbackForm" enctype="multipart/form-data" data-product-id="">
          <div class="modal-body">
            <div class="row">
              <div class="mb-3">
                <label class="form-label" for="productFeedbackName">Your Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="productFeedbackName" name="productFeedbackName">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">How do you rate your product experience? <span
                  class="text-danger">*</span></label>
              <div id="productFeedbackStarRating" class="text-warning fs-4">
                <i class="bi bi-star" data-value="1"></i>
                <i class="bi bi-star" data-value="2"></i>
                <i class="bi bi-star" data-value="3"></i>
                <i class="bi bi-star" data-value="4"></i>
                <i class="bi bi-star" data-value="5"></i>
              </div>
              <input type="hidden" id="productFeedbackExperienceRating" name="productFeedbackExperienceRating">
            </div>

            <div class="mb-3">
              <label class="form-label" for="productFeedbackReview">Your Product Review <span
                  class="text-danger">*</span></label>
              <textarea class="form-control" id="productFeedbackReview" name="productFeedbackReview"
                rows="3"></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label" for="productFeedbackImage">Upload Product Image (optional)</label>
              <input type="file" class="form-control" id="productFeedbackImage" name="productFeedbackImage"
                accept="image/*">
            </div>

            <div class=" text-center">
              <button type="submit" class="btn btn-elegant" style="background-color:#5e358e; color: white;">
                Submit Product Review
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- product feedback submission script -->
  <script>
    $(document).ready(function () {
      let selectedRating = 0;

      // Show modal and set product ID
      $('#productFeedbackModal').on('show.bs.modal', function (e) {
        const productId = $(e.relatedTarget).data('product-id');
        $('#productFeedbackForm').attr('data-product-id', productId);
      });

      // Star rating logic
      $('#productFeedbackStarRating i').on('click', function () {
        selectedRating = $(this).data('value');
        $('#productFeedbackExperienceRating').val(selectedRating);
        $('#productFeedbackStarRating i').removeClass('bi-star-fill').addClass('bi-star');
        $(this).prevAll().addBack().removeClass('bi-star').addClass('bi-star-fill');
      });

      // SweetAlert error function (square style)
      function showError(message) {
        Swal.fire({
          icon: 'error',
          title: message,
          width: 400,
          heightAuto: true,
          showConfirmButton: false,
          timer: 2500
        });
      }

      // Form submit with validation
      $('#productFeedbackForm').on('submit', function (e) {
        e.preventDefault();

        const name = $('#productFeedbackName').val().trim();
        const rating = $('#productFeedbackExperienceRating').val().trim();
        const review = $('#productFeedbackReview').val().trim();
        const productId = $(this).data('product-id');

        if (name === '') {
          showError('Name is required');
          return;
        }

        if (rating === '' || rating === '0') {
          showError('Rating is required');
          return;
        }

        if (review === '') {
          showError('Review cannot be empty');
          return;
        }

        const formData = new FormData(this);
        formData.append('product_id', productId);

        $.ajax({
          url: '<?= base_url("UserController/submitProductReview") ?>',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (res) {
            const result = JSON.parse(res);
            Swal.fire({
              icon: result.status === 'success' ? 'success' : 'error',
              title: result.message,
              width: 300,
              heightAuto: false,
              customClass: {
                popup: 'swal2-xl-square'
              },
              showConfirmButton: false,
              timer: 2000
            });

            if (result.status === 'success') {
              $('#productFeedbackForm')[0].reset();
              $('#productFeedbackStarRating i').removeClass('bi-star-fill').addClass('bi-star');
              $('#productFeedbackModal').modal('hide');
            }
          },
          error: function () {
            showError('Something went wrong!');
          }
        });
      });
    });
  </script>

  <!-- for prodcut review rating script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const stars = document.querySelectorAll('#productFeedbackStarRating i');
      const ratingInput = document.getElementById('productFeedbackExperienceRating');

      stars.forEach((star, idx) => {
        star.addEventListener('click', () => {
          const value = parseInt(star.getAttribute('data-value'));
          ratingInput.value = value;

          stars.forEach((s, i) => {
            s.classList.remove('bi-star-fill');
            s.classList.add('bi-star');
            if (i < value) {
              s.classList.remove('bi-star');
              s.classList.add('bi-star-fill');
            }
          });
        });

        star.addEventListener('mouseover', () => {
          const value = parseInt(star.getAttribute('data-value'));
          stars.forEach((s, i) => {
            s.classList.remove('bi-star-fill');
            s.classList.add('bi-star');
            if (i < value) {
              s.classList.remove('bi-star');
              s.classList.add('bi-star-fill');
            }
          });
        });

        star.addEventListener('mouseout', () => {
          const selected = parseInt(ratingInput.value);
          stars.forEach((s, i) => {
            s.classList.remove('bi-star-fill');
            s.classList.add('bi-star');
            if (i < selected) {
              s.classList.remove('bi-star');
              s.classList.add('bi-star-fill');
            }
          });
        });
      });
    });
  </script>

  <!-- base url scipt -->
  <script>
    const basePhpUrl = "<?= base_url('UserController/productcart') ?>";
  </script>
</body>


</html>