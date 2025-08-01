<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Place Order - Sona Chandi Jewellers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php $this->load->view('common/Commonlinks'); ?>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .order-container {
      max-width: 1000px;
      margin: auto;
      padding: 2rem 1rem;
    }

    .order-summary {
      background: #fff;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .order-summary h5 {
      border-bottom: 1px solid #ddd;
      padding-bottom: 0.5rem;
      margin-bottom: 1rem;
    }

    .gradient-button {
      background: linear-gradient(90deg, #6f42c1, #a855f7);
      color: white;
      border: none;
      padding: 0.75rem 2rem;
      width: 100%;
      border-radius: 6px;
      font-weight: bold;
      transition: 0.3s;
    }

    .gradient-button:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }

    .cod-button {
      background: linear-gradient(90deg, #28a745, #4caf50);
      color: white;
      border: none;
      padding: 0.75rem 2rem;
      width: 100%;
      border-radius: 6px;
      font-weight: bold;
      transition: 0.3s;
    }

    .cod-button:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }

    .order-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid #eee;
    }

    .order-item:last-child {
      border-bottom: none;
    }

    .product-info {
      flex: 2;
    }

    .product-price {
      flex: 1;
      text-align: right;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #6d5cae;
      box-shadow: 0 0 0 0.25rem rgba(109, 92, 174, 0.25);
    }

    .total-row {
      font-size: 1.1rem;
      font-weight: bold;
      padding: 1rem 0;
      border-top: 2px solid #eee;
    }
  </style>
</head>

<body>
  <?php $this->load->view('common/navbar'); ?>

  <div class="container order-container">
    <div class="row g-4">
      <!-- Billing Details -->
      <div class="col-md-7">
        <div class="order-summary">
          <h5>Billing Details</h5>
          <form id="orderForm">
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" id="fullname" class="form-control"
                value="<?= isset($customer) ? htmlspecialchars($customer->name) : '' ?>" required>
            </div>
            <div class="mb-3">
              <label for="contact" class="form-label">contact Number</label>
              <input type="text" id="contact" class="form-control"
                value="<?= isset($customer) ? htmlspecialchars($customer->contact) : '' ?>" pattern="[0-9]{10}"
                required>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Delivery Address</label>
              <textarea id="address" class="form-control" rows="3"
                required><?= isset($customer) ? htmlspecialchars($customer->address) : '' ?></textarea>
            </div>
            <div class="mb-3">
              <label for="payment" class="form-label">Payment Method</label>
              <select id="payment" class="form-select" required>
                <option value="">Select Payment Method</option>
                <option value="cod">Cash on Delivery</option>
                <option value="upi">UPI Payment</option>
                <option value="card">Credit/Debit Card</option>
              </select>
            </div>
            <button type="button" id="placeOrderBtn" class="gradient-button mt-3">
              PROCEED TO PAYMENT
            </button>
          </form>
        </div>
      </div>

      <!-- Order Summary -->
      <!-- Order Summary Section (corrected) -->
      <div class="col-md-5">
        <div class="order-summary">
          <h5>Order Summary</h5>
          <div id="orderItems">
            <?php if (!empty($cartItems)): ?>
              <?php foreach ($cartItems as $item): ?>
                <div class="order-item">
                  <div class="product-info d-flex justify-content-between align-items-start gap-3">
                    <!-- Left: Product Details -->
                    <div class="flex-grow-1">
                      <div class="d-flex justify-content-between align-items-start">
                        <div>
                          <h5 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($item->product_name) ?></h5>
                          <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-light text-dark me-2">
                              <i class="fas fa-box-open me-1"></i> Qty: <?= $item->qty ?? 1 ?>
                            </span>
                            <?php
                            $weightData = json_decode($item->weight, true);
                            $metalType = array_keys($weightData)[0];
                            $weight = $weightData[$metalType];
                            $carat = ($metalType == 'Gold' && isset(json_decode($item->carat, true)['Gold'])) ?
                              json_decode($item->carat, true)['Gold'] . 'K' : '';
                            ?>
                            <span class="badge bg-light text-dark">
                              <i class="fas fa-weight-hanging me-1"></i>
                              <?= $weight ?>g <?= $metalType ?>
                              <?php if ($carat): ?>
                                <span class="text-warning"><?= $carat ?></span>
                              <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <?php if (isset($item->final_price)): ?>
                          <div class="text-end">
                            <div class="text-success fw-bold fs-5">₹<?= number_format($item->final_price, 2) ?></div>
                            <?php if (isset($item->discount_percentage) && $item->discount_percentage > 0): ?>
                              <small class="text-decoration-line-through text-muted">
                                ₹<?= number_format($item->final_price / (1 - ($item->discount_percentage / 100)), 2) ?>
                              </small>
                              <span class="badge bg-success ms-1"><?= $item->discount_percentage ?>% OFF</span>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>
                      </div>

                      <!-- Additional product details -->
                      <div class="product-meta mt-2">
                        <div class="d-flex flex-wrap gap-2">
                          <span class="badge bg-light text-dark">
                            <i class="fas fa-hammer me-1"></i> Making: ₹<?= number_format($item->making_charges, 2) ?>
                          </span>
                          <?php if (isset($item->gst) && $item->gst > 0): ?>
                            <span class="badge bg-light text-dark">
                              <i class="fas fa-receipt me-1"></i> GST: <?= $item->gst ?>%
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>

                    <!-- Right: Product Image -->
                    <div style="width: 100px; min-width: 100px;">
                      <img src="<?= base_url($item->image) ?>" alt="Product Image" class="img-fluid rounded shadow-sm">
                    </div>
                  </div>


                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="alert alert-warning">Your cart is empty</div>
            <?php endif; ?>
          </div>

          <div class="total-row d-flex justify-content-between">
            <span>Subtotal:</span>
            <span>₹<?= isset($totalAmount) ? number_format($totalAmount, 2) : '0.00' ?></span>
          </div>

          <?php if (isset($totalDiscount) && $totalDiscount > 0): ?>
            <div class="d-flex justify-content-between text-success">
              <span>Discount:</span>
              <span>-₹<?= number_format($totalDiscount, 2) ?></span>
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-between">
            <span>Delivery:</span>
            <span>FREE</span>
          </div>

          <?php if ($usedLoyaltyPoints > 0): ?>
            <div class="d-flex justify-content-between text-success">
              <span>Loyalty Points Used:</span>
              <span>-₹<?= number_format($loyaltyDiscount, 2) ?></span>
            </div>
          <?php endif; ?>

          <div class="total-row d-flex justify-content-between">
            <span>Total:</span>
            <!-- Changed to show totalAmountAfterLoyalty instead of totalAmount -->
            <span
              class="fw-bold">₹<?= isset($totalAmountAfterLoyalty) ? number_format($totalAmountAfterLoyalty, 2) : '0.00' ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const paymentSelect = document.getElementById('payment');
      const placeOrderBtn = document.getElementById('placeOrderBtn');
      const customerId = <?= $this->session->userdata('customer_id') ?? 'null' ?>;

      // Update payment button based on selection
      paymentSelect.addEventListener('change', function () {
        if (this.value === 'cod') {
          placeOrderBtn.textContent = 'PLACE COD ORDER';
          placeOrderBtn.className = 'cod-button';
        } else {
          placeOrderBtn.textContent = 'PROCEED TO PAYMENT';
          placeOrderBtn.className = 'gradient-button';
        }
      });

      // Handle order submission
      placeOrderBtn.addEventListener('click', function () {
        const paymentMethod = paymentSelect.value;

        if (!paymentMethod) {
          Swal.fire('Error', 'Please select a payment method', 'error');
          return;
        }

        if (!validateForm()) {
          return;
        }

        if (paymentMethod === 'cod') {
          placeCodOrder();
        } else {
          processOnlinePayment();
        }
      });

      // Form validation
      function validateForm() {
        const fullname = document.getElementById('fullname').value.trim();
        const contact = document.getElementById('contact').value.trim();
        const address = document.getElementById('address').value.trim();

        if (!fullname || !contact || !address) {
          Swal.fire('Error', 'Please fill all required fields', 'error');
          return false;
        }

        if (!/^\d{10}$/.test(contact)) {
          Swal.fire('Error', 'Please enter a valid 10-digit contact number', 'error');
          return false;
        }

        return true;
      }

      // Process COD order
      function placeCodOrder() {
        if (!customerId) {
          Swal.fire('Error', 'Please login to place order', 'error');
          return;
        }

        Swal.fire({
          title: 'Confirm COD Order',
          text: 'Are you sure you want to place this Cash on Delivery order?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, Place Order',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            processOrder('cod');
          }
        });
      }

      // Replace the existing processOnlinePayment() function with this:
      function processOnlinePayment() {
        const paymentMethod = document.getElementById('payment').value;
        const orderData = prepareOrderData(paymentMethod);

        // First create an order record
        fetch('<?= base_url('UserController/createOrderRecord') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(orderData)
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              // Now proceed with Razorpay payment
              initiateRazorpayPayment(data.order_id, data.order_amount);
            } else {
              throw new Error(data.message || 'Failed to create order record');
            }
          })
          .catch(error => {
            Swal.fire('Error', error.message, 'error');
            console.error('Error:', error);
          });
      }

      function initiateRazorpayPayment(orderId, amount) {
        // For test mode, use these test credentials
        const options = {
          "key": "rzp_test_YcEtdZa9f7N8R6", // Test API Key
          "amount": amount * 100, // Amount in paise
          "currency": "INR",
          "name": "Sona Chandi Jewellers",
          "description": "Order Payment",
          "image": "<?= base_url('assets/img/logo.png') ?>",
          "order_id": "", // This will be set from Razorpay order creation
          "handler": function (response) {
            // Handle successful payment
            verifyPayment(response, orderId);
          },
          "prefill": {
            "name": document.getElementById('fullname').value.trim(),
            "email": "<?= isset($customer) ? $customer->email : 'customer@example.com' ?>",
            "contact": document.getElementById('contact').value.trim()
          },
          "notes": {
            "address": document.getElementById('address').value.trim()
          },
          "theme": {
            "color": "#6d5cae"
          }
        };

        // First create a Razorpay order
        fetch('<?= base_url('UserController/createRazorpayOrder') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({
            amount: amount,
            order_id: orderId
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              options.order_id = data.razorpay_order_id;

              // Open Razorpay payment modal
              const rzp = new Razorpay(options);
              rzp.open();
            } else {
              throw new Error(data.message || 'Failed to create Razorpay order');
            }
          })
          .catch(error => {
            Swal.fire('Error', error.message, 'error');
            console.error('Error:', error);
          });
      }

      function verifyPayment(paymentResponse, orderId) {
        Swal.fire({
          title: 'Verifying Payment',
          text: 'Please wait while we verify your payment',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        fetch('<?= base_url('UserController/verifyPayment') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({
            razorpay_payment_id: paymentResponse.razorpay_payment_id,
            razorpay_order_id: paymentResponse.razorpay_order_id,
            razorpay_signature: paymentResponse.razorpay_signature,
            order_id: orderId
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Payment Successful!',
                text: 'Your order has been placed successfully',
                showConfirmButton: false,
                timer: 3000
              }).then(() => {
                window.location.href = "<?= base_url('UserController/orderSuccess/') ?>" + orderId;
              });
            } else {
              throw new Error(data.message || 'Payment verification failed');
            }
          })
          .catch(error => {
            Swal.fire('Error', error.message, 'error');
            console.error('Error:', error);
          });
      }

      // Helper function to prepare order data
      function prepareOrderData(paymentMethod) {
        const rawItems = <?= json_encode($cartItems) ?>;

        const items = rawItems.map(item => {
          const weight = typeof item.weight === 'string' ? JSON.parse(item.weight) : item.weight;
          const carat = typeof item.carat === 'string' ? JSON.parse(item.carat) : item.carat;

          return {
            product_id: item.id,
            product_name: item.product_name,
            product_image: item.image,
            quantity: item.qty ?? 1,
            unit_price: item.final_price,
            final_price: item.final_price,
            metal_type: Object.keys(weight)[0],
            weight: weight,
            carat: carat,
            making_charges: item.making_charges,
            discount_percentage: item.discount_percentage,
            gst_percentage: item.gst
          };
        });

        return {
          customer_id: customerId,
          fullname: document.getElementById('fullname').value.trim(),
          contact: document.getElementById('contact').value.trim(),
          address: document.getElementById('address').value.trim(),
          payment_method: paymentMethod,
          total_amount: <?= $totalAmountAfterLoyalty ?? 0 ?>,
          items: items,
          used_loyalty_points: <?= $usedLoyaltyPoints ?? 0 ?>
        };
      }
      function processOrder(paymentMethod) {
        const rawItems = <?= json_encode($cartItems) ?>;

        const items = rawItems.map(item => {
          const weight = typeof item.weight === 'string' ? JSON.parse(item.weight) : item.weight;
          const carat = typeof item.carat === 'string' ? JSON.parse(item.carat) : item.carat;

          return {
            product_id: item.id,
            product_name: item.product_name,
            product_image: item.image,
            quantity: item.qty ?? 1,
            unit_price: item.final_price,
            final_price: item.final_price,
            metal_type: Object.keys(weight)[0],
            weight: weight,
            carat: carat,
            making_charges: item.making_charges,
            discount_percentage: item.discount_percentage,
            gst_percentage: item.gst
          };
        });

        const orderData = {
          customer_id: customerId,
          fullname: document.getElementById('fullname').value.trim(),
          contact: document.getElementById('contact').value.trim(),
          address: document.getElementById('address').value.trim(),
          payment_method: paymentMethod,
          total_amount: <?= $totalAmountAfterLoyalty ?? 0 ?>,
          items: items,
          used_loyalty_points: <?= $usedLoyaltyPoints ?? 0 ?>
        };

        Swal.fire({
          title: 'Placing Your Order',
          text: 'Please wait while we process your order. Do not close or go back.',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });


        fetch('<?= base_url('UserController/createCodOrder') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(orderData)
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Order Placed!',
                text: 'Your order has been placed successfully',
                showConfirmButton: false,
                timer: 3000
              }).then(() => {
                window.location.href = "<?= base_url('UserController/orderSuccess/') ?>" + data.order_id;
              });
            } else {
              throw new Error(data.message || 'Failed to place order');
            }
          })
          .catch(error => {
            Swal.fire('Error', error.message, 'error');
            console.error('Error:', error);
          });
      }

    });
  </script>

  <?php $this->load->view('common/footer'); ?>
</body>

</html>