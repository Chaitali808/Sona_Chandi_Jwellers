<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('common/Commonlinks.php'); ?>
  <link rel="stylesheet" href="<?= base_url('assets/styles.css'); ?>">

  <style>
    :root {
      --primary: #5E358E;
      --secondary: #f9f6fb;
      --accent: #d1b3f5;
      --text-dark: #2c1a47;
      --text-light: #ffffff;
      --highlight: #f3e5f5;
      --gold: #8b479b;
      --gold-gradient: linear-gradient(135deg, #a678d8 0%, #7b38a1 100%);
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--secondary);
      color: var(--text-dark);

    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: var(--text-light);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(94, 53, 142, 0.2);
    }

    h2 {
      text-align: center;
      color: var(--primary);
      margin-bottom: 30px;
    }

    .profile-item {
      margin-bottom: 20px;
      padding: 15px;
      background-color: var(--highlight);
      border-left: 6px solid var(--primary);
      border-radius: 10px;
    }

    .label {
      font-weight: bold;
      color: var(--gold);
    }

    .value {
      margin-top: 5px;
    }

    .btn-edit,
    .btn-logout,
    .btn-points {
      display: block;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
      color: var(--text-light);
      transition: all 0.3s ease;
    }

    .btn-edit {
      background: var(--gold-gradient);
    }

    .btn-edit:hover {
      background: var(--primary);
    }

    .logout {
      display: block;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
      color: var(--text-light);
      transition: all 0.3s ease;
      text-decoration: none;
      text-align: center;
    }

    .logout {
      background: var(--gold-gradient);
    }

    .logout:hover {
      background: var(--primary);
    }

    .btn-points {
      background: #00796b;
    }

    .btn-points:hover {
      background: #004d40;
    }

    /* Modal */
    .modal1 {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal1-content {
      background-color: var(--text-light);
      margin: 8% auto;
      padding: 20px;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .modal1-content h3 {
      color: var(--primary);
      text-align: center;
    }

    .form-group {
      margin: 15px 0;
    }

    .form-group label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
      color: var(--gold);
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid var(--accent);
      border-radius: 8px;
    }

    .modal1-buttons {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-save {
      background: var(--gold-gradient);
      color: var(--text-light);
    }

    .btn-cancel {
      background: #999;
      color: var(--text-light);
    }
    /* Style for My Orders table */
.table-responsive table {
  border-collapse: separate;
  border-spacing: 0 10px;
  width: 100%;
  padding: 50px;
}

.table-responsive thead {
  background-color: var(--highlight);
  color: var(--primary);
  font-weight: bold;
  text-align: center;
  border-radius: 12px;
}

.table-responsive tbody tr {
  background-color: #fff;
  border-left: 5px solid var(--primary);
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}

.table-responsive tbody tr:hover {
  background-color: #f3e5f5;
  transform: scale(1.01);
}

.table-responsive td,
.table-responsive th {
  vertical-align: middle;
  text-align: center;
  padding: 12px;
  border: none;
}

.table-responsive td {
  font-size: 15px;
  color: var(--text-dark);
}

.table-responsive th {
  font-size: 14px;
  letter-spacing: 0.5px;
}

.table-responsive .table-bordered {
  border: none;
}

  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <?php $this->load->view('common/navbar'); ?>

  <div class="container">
    <h2>👤 User Profile</h2>

    <div class="profile-item">
      <div class="label">Name</div>
      <div class="value" id="profileName"><?= htmlspecialchars($user->name) ?></div>
    </div>

    <div class="profile-item">
      <div class="label">Email ID</div>
      <div class="value" id="profileEmail"><?= htmlspecialchars($user->email) ?></div>
    </div>

    <div class="profile-item">
      <div class="label">Phone Number</div>
      <div class="value" id="profilePhone"><?= htmlspecialchars($user->contact) ?></div>
    </div>

    <div class="profile-item">
      <div class="label">Address</div>
      <div class="value" id="profileAddress"><?= htmlspecialchars($user->address) ?></div>
    </div>

    <div class="profile-item">
      <div class="label">Loyalty Points</div>
      <div class="value"><?= (int) $user->loyalty_points ?> Points</div>
    </div>

    <div class="d-flex justify-content-between align-items-center gap-2 mt-3">
      <button class="btn-edit" onclick="openModal()">Edit Profile</button>
      <a href="<?= base_url('UserController/logout') ?>" class="logout">Logout</a>
    </div>

  </div>
<h3 class="mt-4" align="center">🛒 My Orders</h3>
<?php if (!empty($orders)): ?>
  <div class="table-responsive mt-3">
    <table class="table table-bordered table-sm">
      <thead class="table-light">
        <tr>
          <th>Order #</th>
          <th>Date</th>
          <th>Total</th>
          <th>Payment</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= htmlspecialchars($order->order_number) ?></td>
            <td><?= date('d M Y', strtotime($order->order_date)) ?></td>
            <td>₹<?= number_format($order->total, 2) ?></td>
            <td><?= ucfirst($order->payment_method) ?></td>
            <td><?= ucfirst($order->status) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <p class="text-muted">You have not placed any orders yet.</p>
<?php endif; ?>

  <!-- Modal -->
  <div id="editModal" class="modal1">
    <div class="modal1-content">
      <h3>Edit Profile</h3>
      <div class="form-group">
        <label>Name</label>
        <input type="text" id="editName" />
      </div>
      <div class="form-group">
        <label>Email ID</label>
        <input type="email" id="editEmail" />
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" id="editPhone" />
      </div>
      <div class="form-group">
        <label>Address</label>
        <textarea id="editAddress" rows="3"></textarea>
      </div>
      <div class="modal1-buttons">
        <button class="btn btn-save" onclick="saveChanges()">Save</button>
        <button class="btn btn-cancel" onclick="closeModal()">Cancel</button>
      </div>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('editModal').style.display = 'block';
      document.getElementById('editName').value = document.getElementById('profileName').textContent;
      document.getElementById('editEmail').value = document.getElementById('profileEmail').textContent;
      document.getElementById('editPhone').value = document.getElementById('profilePhone').textContent;
      document.getElementById('editAddress').value = document.getElementById('profileAddress').textContent;
    }

    function closeModal() {
      document.getElementById('editModal').style.display = 'none';
    }

    function saveChanges() {
      const name = document.getElementById('editName').value;
      const email = document.getElementById('editEmail').value; // Not updatable in DB
      const phone = document.getElementById('editPhone').value;
      const address = document.getElementById('editAddress').value;

      fetch("<?= base_url('UserController/updateProfile') ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            name: name,
            contact: phone,
            address: address
          }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            document.getElementById('profileName').textContent = name;
            document.getElementById('profilePhone').textContent = phone;
            document.getElementById('profileAddress').textContent = address;
            closeModal();

            Swal.fire({
              icon: 'success',
              title: 'Profile updated!',
              text: data.message,
              showConfirmButton: false,
              timer: 2000
            });

          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message,
              showConfirmButton: false,
              timer: 2000
            });
          }
        })
        .catch(error => {
          console.error("Error:", error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong.',
            showConfirmButton: false,
            timer: 2000
          });
        });
    }



    // Optional: close modal if clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('editModal');
      if (event.target === modal) {
        closeModal();
      }
    }
  </script>

</body>

</html>