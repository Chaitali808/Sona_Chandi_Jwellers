<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Gateway</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .card-container {
      max-width: 850px;
      width: 50%;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      display: flex;
      flex-wrap: wrap;
    }

    .image-section {
      flex: 1 1 50%;
      min-height: 300px;
    }

    .image-section img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px 0 0 15px;
    }

    .form-section {
      flex: 1 1 50%;
      padding: 30px;
      background-color: var(--secondary);
    }

    .form-section h2 {
      color: var(--text-dark);
      font-weight: bold;
      margin-bottom: 20px;
    }

    .form-check-label {
      color: var(--text-dark);
      margin-right: 15px;
    }

    .card-icons img {
      height: 30px;
      margin-right: 8px;
    }

    .form-control {
      border: 1px solid var(--accent);
      border-radius: 6px;
      padding: 10px;
      font-size: 14px;
      margin-bottom: 15px;
    }

    .pay-btn {
      width: 100%;
      padding: 12px;
      border: none;
      background: var(--gold-gradient);
      color: var(--text-light);
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .pay-btn:hover {
      opacity: 0.9;
    }

    .hidden {
      display: none;
    }

    @media (max-width: 768px) {
      .card-container {
        width: 100%;
      }

      .image-section {
        display: none;
      }

      .form-section {
        flex: 1 1 100%;
      }
    }
  </style>
</head>

<body>

  <div class="card-container">
    <div class="image-section">
      <img src="<?php echo base_url('/assets/Images/jewel2.jpg'); ?>" alt="Jewelry Image">
    </div>
    <div class="form-section">
      <h2>PAYMENT GATEWAY</h2>

      <!-- Payment Methods -->
      <div class="mb-3">
        <label class="form-check-label">
          <input class="form-check-input me-1" type="radio" name="method" value="debit" checked> ATM / Debit Card
        </label>
        <label class="form-check-label">
          <input class="form-check-input me-1" type="radio" name="method" value="paytm"> Paytm
        </label>
        <label class="form-check-label">
          <input class="form-check-input me-1" type="radio" name="method" value="upi"> UPI
        </label>
      </div>

      <!-- Debit Form -->
      <div id="debit-form" class="payment-form">
        <label class="mb-1">Credit/Debit Card</label>
        <div class="d-flex align-items-center mb-3 card-icons">
          <img src="https://img.icons8.com/color/48/000000/visa.png" />
          <img src="https://img.icons8.com/color/48/000000/mastercard.png" />
          <img src="https://img.icons8.com/color/48/000000/amex.png" />
          <img src="https://img.icons8.com/color/48/000000/discover.png" />
        </div>

        <input type="text" class="form-control" placeholder="Card Number" />
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="MM / YY" />
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="CVV" />
          </div>
        </div>
      </div>

      <!-- Paytm Form -->
      <div id="paytm-form" class="payment-form hidden">
        <label class="mb-1">Pay via Paytm</label>
        <p>Scan QR code or enter your Paytm UPI ID:</p>
        <img src="<?php echo base_url('/assets/Images/image.png'); ?>" alt="Paytm QR" style="width: 150px;"
          class="mb-2" />
        <input type="text" class="form-control" placeholder="Enter Paytm UPI ID" />
      </div>

      <!-- UPI Form -->
      <div id="upi-form" class="payment-form hidden">
        <label class="mb-1">UPI Payment</label>
        <p>Enter your UPI ID (e.g., name@upi):</p>
        <input type="text" class="form-control mb-2" placeholder="Enter UPI ID" />
        <p>Or scan your app's QR code:</p>
        <img src="<?php echo base_url('/assets/Images/image.png'); ?>" alt="UPI QR" style="width: 150px;" />
      </div>

      <button class="pay-btn">Pay Now</button>
    </div>
  </div>

  <script>
    const methodRadios = document.querySelectorAll('input[name="method"]');
    const debitForm = document.getElementById('debit-form');
    const paytmForm = document.getElementById('paytm-form');
    const upiForm = document.getElementById('upi-form');

    methodRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        debitForm.classList.add('hidden');
        paytmForm.classList.add('hidden');
        upiForm.classList.add('hidden');

        if (radio.value === 'debit') {
          debitForm.classList.remove('hidden');
        } else if (radio.value === 'paytm') {
          paytmForm.classList.remove('hidden');
        } else if (radio.value === 'upi') {
          upiForm.classList.remove('hidden');
        }
      });
    });
  </script>
</body>

</html>