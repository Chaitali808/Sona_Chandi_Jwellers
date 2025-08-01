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
    .form-control:focus, .form-select:focus {
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
                     value="<?= isset($customer) ? htmlspecialchars($customer->contact) : '' ?>" 
                     pattern="[0-9]{10}" required>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Delivery Address</label>
              <textarea id="address" class="form-control" rows="3" required><?= isset($customer) ? htmlspecialchars($customer->address) : '' ?></textarea>
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
      <div class="col-md-5">
        <div class="order-summary">
          <h5>Order Summary</h5>
          <div id="orderItems">
            <?php if(!empty($cartItems)): ?>
              <?php foreach($cartItems as $item): ?>
                <div class="order-item">
                  <div class="product-info">
                    <h6 class="mb-1"><?= htmlspecialchars($item->product_name) ?></h6>
                    <?php 
                      $weightData = json_decode($item->weight, true);
                      $metalType = array_keys($weightData)[0];
                      $weight = $weightData[$metalType];
                    ?>
                    <small class="text-muted"><?= $weight ?>g <?= $metalType ?>
                      <?= ($metalType == 'Gold' && isset(json_decode($item->carat, true)['Gold'])) ? 
                          json_decode($item->carat, true)['Gold'].'K' : '' ?>
                    </small>
                  </div>
                  <div class="product-price">
                    <!-- ₹<?= number_format($item->final_price, 2) ?> -->
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
          
          <?php if(isset($discountAmount) && $discountAmount > 0): ?>
            <div class="d-flex justify-content-between text-success">
              <span>Discount:</span>
              <span>-₹<?= number_format($discountAmount, 2) ?></span>
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-between">
            <span>Delivery:</span>
            <span>FREE</span>
          </div>

          <div class="total-row d-flex justify-content-between">
            <span>Total:</span>
            <span class="fw-bold">₹<?= isset($totalAmount) ? number_format($totalAmount, 2) : '0.00' ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentSelect = document.getElementById('payment');
      const placeOrderBtn = document.getElementById('placeOrderBtn');
      const customerId = <?= $this->session->userdata('customer_id') ?? 'null' ?>;
      
      // Update payment button based on selection
      paymentSelect.addEventListener('change', function() {
        if (this.value === 'cod') {
          placeOrderBtn.textContent = 'PLACE COD ORDER';
          placeOrderBtn.className = 'cod-button';
        } else {
          placeOrderBtn.textContent = 'PROCEED TO PAYMENT';
          placeOrderBtn.className = 'gradient-button';
        }
      });

      // Handle order submission
      placeOrderBtn.addEventListener('click', function() {
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

      // Process online payment
      function processOnlinePayment() {
        Swal.fire('Info', 'Online payment integration will be processed here', 'info');
        // Implement your Razorpay or other payment gateway integration
      }

      // Submit order to server
      function processOrder(paymentMethod) {
        const orderData = {
          customer_id: customerId,
          fullname: document.getElementById('fullname').value.trim(),
          contact: document.getElementById('contact').value.trim(),
          address: document.getElementById('address').value.trim(),
          payment_method: paymentMethod,
          // contact:"9082483426",
          items: <?= json_encode($cartItems) ?>,
          total_amount: <?= $totalAmount ?? 0 ?>
        };

        Swal.fire({
          title: 'Processing your order...',
          allowOutsideClick: false,
          didOpen: () => { Swal.showLoading(); }
        });

        fetch('<?= base_url('UserController/createCodOrder') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(orderData)
        })
        .then(response => {
          if (!response.ok) throw new Error('Network response was not ok');
          return response.json();
        })
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