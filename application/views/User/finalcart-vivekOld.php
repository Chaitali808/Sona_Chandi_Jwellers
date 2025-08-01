<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jewellery Cart</title>
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
      background-color: var(--secondary);
      font-family: 'Segoe UI', sans-serif;
      color: var(--text-dark);
    }

    .cart-container {
      max-width: 1200px;
      margin: auto;
      padding: 2rem 1rem;
    }

    .cart-item {
      background-color: #fff;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .cart-item img {
      width: 160px;
      height: 160px;
      object-fit: contain;
      border-radius: 6px;
    }

    .btn-action {
      background: var(--gold-gradient);
      color: var(--text-light);
      border: none;
      border-radius: 6px;
      padding: 0.4rem 1rem;
      font-size: 0.85rem;
      font-weight: 500;
      margin-right: 0.5rem;
      transition: background 0.3s;
    }

    .btn-action:hover {
      background: var(--accent);
    }

    .price-details {
      background-color: #fff;
      border-radius: 8px;
      padding: 1.5rem;
      margin-top: 1rem;
    }

    .place-order-btn {
      background: var(--gold-gradient);
      border: none;
      color: var(--text-light);
      padding: 0.75rem 2rem;
      font-weight: bold;
      border-radius: 6px;
      width: 100%;
      transition: background 0.3s;
    }

    .place-order-btn:hover {
      background: var(--accent);
    }

    .price-highlight {
      color: green;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .cart-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .cart-item img {
        margin-bottom: 1rem;
      }

      .cart-actions {
        justify-content: center;
      }
    }

    #loyalty-line.disabled {
      opacity: 0.4;
    }

    #loyalty-line.disabled {
      opacity: 0.4;
    }
  </style>
</head>

<body>
  <?php $this->load->view('common/navbar'); ?>

  <div class="container cart-container">
    <?php if (!empty($products)): ?>
      <div class="row gy-4">
        <!-- Cart Items -->
        <div class="col-lg-8">
          <?php foreach ($products as $index => $product): ?>
            <?php
            $weightData = json_decode($product->weight, true);
            $typeData = json_decode($product->type, true);
            $caratData = json_decode($product->carat, true);

            $makingCharges = (float) $product->making_charges;
            $discountPercentage = (float) $product->discount_percentage;
            $gstPercentage = (float) $product->gst;
            $otherCharges = isset($product->other_charges) ? (float) $product->other_charges : 0;

            $basePrice = 0;
            // Calculate base price based on weight and rates
            foreach ($weightData as $metal => $weightGram) {
              $metalLower = strtolower($metal);
              $caratKey = isset($caratData[$metal]) ? strtolower((string) $caratData[$metal]) : '';

              if (isset($rates[$metalLower][$caratKey])) {
                $rate = $rates[$metalLower][$caratKey];
              } else {
                $rate = 0;
              }

              $basePrice += $weightGram * $rate;
            }

            // Discount calculation
            $discountAmount = $makingCharges * $discountPercentage / 100;
            $discountedMaking = $makingCharges - $discountAmount;

            // Price with discount
            $subtotalWithDiscount = $basePrice + $discountedMaking;
            $gstWithDiscount = $subtotalWithDiscount * $gstPercentage / 100;
            $finalWithDiscount = $subtotalWithDiscount + $gstWithDiscount;
            if ($otherCharges > 0) {
              $finalWithDiscount += $otherCharges;
            }

            // Price without discount
            $subtotalWithoutDiscount = $basePrice + $makingCharges;
            $gstWithoutDiscount = $subtotalWithoutDiscount * $gstPercentage / 100;
            $finalWithoutDiscount = $subtotalWithoutDiscount + $gstWithoutDiscount;
            if ($otherCharges > 0) {
              $finalWithoutDiscount += $otherCharges;
            }
            ?>

            <div class="cart-item mb-4 p-3 border rounded d-flex gap-3 align-items-start" data-index="<?= $index ?>"
              data-with-discount="<?= $finalWithDiscount ?>" data-without-discount="<?= $finalWithoutDiscount ?>"
              data-active="1" data-product-id="<?= $product->id ?>" data-customer-id="<?= $customer_id ?>"
              data-qty="<?= isset($product->qty) ? $product->qty : 1 ?>">
              <a href="<?= base_url('UserController/productcart/' . $product->id); ?>" class="me-3">
                <img src="<?= base_url($product->image); ?>" alt="Product Image" style="width: 100px; height: auto;">
              </a>
              <div class="flex-grow-1">
                <h6 class="fw-bold mb-1">
                  <a href="<?= base_url('UserController/productcart/' . $product->id); ?>"
                    class="text-decoration-none text-dark">
                    <?= $product->product_name; ?>
                  </a>
                </h6>
                <p class="mb-1 text-muted small">Product Code: <?= $product->product_code ?></p>

                <p class="mb-1 text-decoration-line-through text-muted">
                  ₹<?= number_format($finalWithoutDiscount, 2); ?>
                </p>
                <h5 class="text-success">
                  ₹<?= number_format($finalWithDiscount, 2); ?>
                  <small class="text-muted fs-6"><?= $discountPercentage ?>% Off on making charges</small>
                </h5>

                <div class="d-flex align-items-center mt-2">
                  <button class="btn btn-outline-secondary btn-sm btn-decrease" data-id="<?= $product->id ?>">-</button>
                  <span class="mx-2 qty" id="qty-<?= $product->id ?>"><?= isset($product->qty) ? $product->qty : 1 ?></span>
                  <button class="btn btn-outline-secondary btn-sm btn-increase" data-id="<?= $product->id ?>">+</button>
                </div>


                <div class="cart-actions mt-3 d-flex flex-wrap">
                  <button class="btn-action btn btn-light btn-sm me-2 btn-save-later">SAVE FOR LATER</button>
                  <button class="btn-action btn btn-light btn-sm"
                    onclick="removeFromCart(<?= $product->id ?>, <?= $this->session->userdata('customer_id') ?>)">
                    REMOVE
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Price Details -->
        <div class="col-lg-4">
          <div class="price-details border rounded p-3 bg-light">
            <h5 class="mb-3">PRICE DETAILS</h5>
            <div class="d-flex justify-content-between">
              <span>Price (<span id="total-items">0</span> items)</span>
              <span>₹<span id="price-without-discount">0.00</span></span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Discount on Making</span>
              <span class="text-success">-₹<span id="discount-amount">0.00</span></span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Platform Fee</span>
              <span>₹4.00</span>
            </div>
            <!-- Loyalty Point Option -->




            <!-- <input type="hidden" name="use_loyalty" id="use_loyalty_input" value="0"> -->


            <hr>
            <div class="d-flex justify-content-between align-items-center mb-3 disabled" id="loyalty-line">
              <div class="form-check d-flex align-items-center mb-0">
                <input class="form-check-input me-2" type="checkbox" id="useLoyaltyPoints">
                <label class="form-check-label fw-bold" for="useLoyaltyPoints">
                  Use Loyalty Points (Available: ₹<?= $loyaltyPoints ?>)
                </label>
              </div>
              <span class="text-success fw-bold">-₹<span id="loyalty-discount"><?= $loyaltyPoints ?></span></span>
            </div>

            <hr>


            <div class="d-flex justify-content-between fw-bold">
              <span>Total Amount</span>
              <span>₹<span id="final-amount">0.00</span></span>

            </div>
            <p class="mt-2 price-highlight text-success">
              You will save ₹<span id="savings">0.00</span> on this order
            </p>
            <div class="mt-3">
              <button class="place-order-btn btn btn-primary w-100"
                onclick="window.location.href='<?= base_url('UserController/PlaceOrder') ?>'">
                PLACE ORDER
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <h4>No products to show in your cart.</h4>
        <a href="<?= base_url('UserController/home') ?>" class=" btn-action btn  mt-3">Continue
          Shopping</a>
      </div>
    <?php endif; ?>
  </div>


  <!-- SweetAlert CDN (put in <head> or before </body>) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loyaltyCheckbox = document.getElementById('useLoyaltyPoints');
      const loyaltyLine = document.getElementById('loyalty-line');

      if (loyaltyCheckbox) {
        loyaltyLine.classList.add('disabled'); // Default faded

        loyaltyCheckbox.addEventListener('change', () => {
          if (loyaltyCheckbox.checked) {
            loyaltyLine.classList.remove('disabled');
          } else {
            loyaltyLine.classList.add('disabled');
          }
          updateTotals(); // Trigger price recalculation
        });
      }
    });

    function updateQuantityInDB(productId, customerId, qty) {
      fetch("<?= base_url('UserController/updateCartQuantity') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "product_id=" + productId + "&customer_id=" + customerId + "&quantity=" + qty
      })
        .then(response => response.json())
        .then(data => {
          if (data.status !== "success") {
            Swal.fire("Error", data.message || "Failed to update quantity.", "error");
          }
        })
        .catch(error => {
          Swal.fire("Error", "Something went wrong: " + error.message, "error");
        });
    }

    function removeFromCart(productId, customerId) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to remove this product from your cart!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, remove it!",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("<?= base_url('UserController/removeFromCart') ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "product_id=" + productId + "&customer_id=" + customerId
          })
            .then(response => response.json())
            .then(data => {
              if (data.status === "success") {
                Swal.fire({
                  title: "Removed!",
                  text: data.message,
                  icon: "success",
                  showConfirmButton: false,
                  timer: 2000
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  title: "Error!",
                  text: data.message,
                  icon: "error"
                });
              }
            })
            .catch(error => {
              Swal.fire("Error", "Something went wrong: " + error.message, "error");
            });
        }
      });
    }
  </script>




  <script>
    function saveQuantitiesToStorage() {
      const quantities = {};
      document.querySelectorAll('.cart-item').forEach(item => {
        const productId = item.getAttribute('data-product-id');
        const qty = parseInt(item.getAttribute('data-qty')) || 1;
        quantities[productId] = qty;
      });
      localStorage.setItem('cartQuantities', JSON.stringify(quantities));
    }

    function formatPrice(num) {
      return parseFloat(num).toLocaleString('en-IN', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }
    const loyaltyPoints = <?= $loyaltyPoints ?? 0 ?>;

    // function formatPrice(value) {
    //   return value.toFixed(2);
    // }

    function updateTotals() {
      let totalWithout = 0;
      let totalWith = 0;
      let totalQty = 0;

      document.querySelectorAll('.cart-item').forEach(item => {
        const isActive = item.getAttribute('data-active') === "1";
        const qty = parseInt(item.getAttribute('data-qty')) || 1;

        if (isActive) {
          const priceWith = parseFloat(item.getAttribute('data-with-discount')) || 0;
          const priceWithout = parseFloat(item.getAttribute('data-without-discount')) || 0;

          totalWith += priceWith * qty;
          totalWithout += priceWithout * qty;
          totalQty += qty;
        }
      });

      const discount = totalWithout - totalWith;
      let finalAmount = totalWith + 4;

      // Loyalty points discount
      const useLoyalty = document.getElementById('useLoyaltyPoints');
      let loyaltyDiscount = 0;
      if (useLoyalty && useLoyalty.checked) {
        loyaltyDiscount = Math.min(loyaltyPoints, finalAmount);
        finalAmount -= loyaltyDiscount;
      }

      // Final DOM updates
      const totalSavings = discount + loyaltyDiscount;

      document.getElementById('total-items').innerText = totalQty;
      document.getElementById('price-without-discount').innerText = formatPrice(totalWithout);
      document.getElementById('discount-amount').innerText = formatPrice(discount);
      document.getElementById('final-amount').innerText = formatPrice(finalAmount);
      document.getElementById('savings').innerText = formatPrice(totalSavings);
    }

    document.addEventListener('DOMContentLoaded', () => {
      const loyaltyCheckbox = document.getElementById('useLoyaltyPoints');
      if (loyaltyCheckbox) {
        loyaltyCheckbox.addEventListener('change', updateTotals);
      }
    });


    document.querySelectorAll('.btn-increase').forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.cart-item');
        let qty = parseInt(item.getAttribute('data-qty')) || 1;
        qty++;

        item.setAttribute('data-qty', qty);
        item.querySelector('.qty').innerText = qty;

        // Get product and customer IDs
        const productId = item.getAttribute('data-product-id');
        const customerId = item.getAttribute('data-customer-id');
        updateQuantityInDB(productId, customerId, qty);

        updateTotals();
      });
    });

    document.querySelectorAll('.btn-decrease').forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.cart-item');
        let qty = parseInt(item.getAttribute('data-qty')) || 1;

        if (qty > 1) {
          qty--;

          item.setAttribute('data-qty', qty);
          item.querySelector('.qty').innerText = qty;

          const productId = item.getAttribute('data-product-id');
          const customerId = item.getAttribute('data-customer-id');
          updateQuantityInDB(productId, customerId, qty);

          updateTotals();
        }
      });
    });

    // Replace your existing loyalty points checkbox handler with this:
    document.getElementById('useLoyaltyPoints').addEventListener('change', function () {
      const isChecked = this.checked;
      const loyaltyPoints = <?= $loyaltyPoints ?>;

      // Calculate cart total (same logic as in updateTotals())
      let cartTotal = 0;
      document.querySelectorAll('.cart-item').forEach(item => {
        if (item.getAttribute('data-active') === "1") {
          const priceWith = parseFloat(item.getAttribute('data-with-discount')) || 0;
          const qty = parseInt(item.getAttribute('data-qty')) || 1;
          cartTotal += priceWith * qty;
        }
      });
      cartTotal += 4; // Add platform fee

      const discount = isChecked ? Math.min(loyaltyPoints, cartTotal) : 0;

      // Store in session via AJAX
      fetch('<?= base_url("UserController/setLoyaltyUsage") ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: `use_loyalty=${isChecked ? 1 : 0}&points=${discount}`
      }).then(() => {
        updateTotals(); // Refresh cart totals
      });
    });
    document.querySelectorAll('.btn-save-later').forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.cart-item');
        item.setAttribute('data-active', "0"); // mark as inactive
        btn.disabled = true;
        btn.innerText = "SAVE FOR LATER";
        btn.classList.add('text-muted');
        updateTotals();
      });
    });

    // Initial load
    updateTotals();
  </script>



  <?php $this->load->view('common/chatbot'); ?>
  <?php $this->load->view('common/footer'); ?>
  <?php $this->load->view('common/popup'); ?>
</body>

</html>