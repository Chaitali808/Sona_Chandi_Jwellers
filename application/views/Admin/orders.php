<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    html,
    body {
      width: 100vw;
      height: 100vh;
      margin: 0;
      padding: 0;
      display: flex;
      overflow-x: hidden;
    }

    tbody tr {
      background-color: #fff2f7;
      /* light pink */
    }

    td img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 6px;
    }


    table {
      border-collapse: separate;
      border-spacing: 0 7px;
      /* vertical space between rows */
    }

    tbody tr,
    thead {
      background-color: rgb(234, 168, 193);
      border-radius: 12px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.26);
      height: 60px;
    }

    tbody td {
      border: none;
      padding: 1rem;
    }

    tr {
      height: 50px;

    }

    .icons {
      color: #9C60DD;
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
      margin: 0px 180px 0px 180px;
    }

    .gradient-button:hover {
      opacity: 0.9;
      transform: scale(1.03);
    }



    /* Responsive adjustments */
    @media (max-width: 992px) {
      .table-responsive {
        overflow-x: auto;
      }

      table th,
      table td {
        font-size: 0.95rem;
        padding: 0.75rem;
      }

      select#ProductStatus {
        width: 100%;
        max-width: 250px;
        margin-bottom: 10px;
      }
    }

    @media (max-width: 768px) {

      table th,
      table td {
        font-size: 0.9rem;
        padding: 0.6rem;
      }

      .container-sm-fluid {
        padding-left: 10px;
        padding-right: 10px;
      }
    }

    @media (max-width: 576px) {

      .table th,
      .table td {
        font-size: 0.85rem;
        padding: 0.5rem;
      }

      select#ProductStatus {
        font-size: 0.9rem;
        max-width: 100%;
        margin-bottom: 12px;
      }

      .icons {
        font-size: 1rem;
      }
    }

    table {
      border-collapse: separate;
      border-spacing: 0 12px;
    }

    thead {
      background: linear-gradient(90deg, #efb5cc, #fddde6);
      color: #4b1248;
      font-weight: bold;
      text-align: center;
      border-radius: 10px;
    }

    tbody tr {
      background-color: #fff8fb;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }

    tbody tr:hover {
      background-color: #fff0f5;
      transform: scale(1.01);
    }

    td,
    th {
      padding: 1rem;
      text-align: center;
      vertical-align: middle;
    }
  </style>

  <style>
    .pagination .page-item .page-link {
      background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
      color: white;
      border: none;
      margin: 0 3px;
      border-radius: 6px;
      padding: 6px 12px;
      transition: 0.3s ease;
    }

    .pagination .page-item .page-link:hover {
      filter: brightness(1.1);
    }

    .pagination .page-item.disabled .page-link {
      background: #e0e0e0;
      color: #aaa;
      cursor: not-allowed;
    }

    .pagination .page-item.active .page-link {
      font-weight: bold;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
  </style>

</head>

<body>

  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- sidebar   -->
      <?php include 'sidebar.php'; ?>

      <div class="col-lg-9 col-xl-10 col-12 offset-xl-2 offset-lg-3 text-white ">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>
        <!-- main content here -->



        <div class="container-fluid px-3 mt-4">
          <div class="row">
            <div class="col-6   col-sm-2 ">
              <div class="my-2">
                <select id="ProductStatus" class="form-select">
                  <option value="all">All</option>
                  <option value="pending">Pending</option>
                  <option value="delivered">Delivered</option>
                </select>

              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <h2>All Orders</h2>

          <?php if (!empty($orders)): ?>
            <table class="table">
              <thead>
                <tr>
                  <th>#Order ID</th>
                  <th>Customer</th>
                  <th>Order Number</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Payment</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $order): ?>
                  <tr>
                    <td><?= $order->id ?></td>
                    <td><?= $order->customer_name ?></td>
                    <td><?= $order->order_number ?></td>
                    <td>₹<?= number_format($order->total, 2) ?></td>
                    <td><?= date('d M Y', strtotime($order->order_date)) ?></td>
                    <td><?= $order->payment_method ?></td>
                    <td>
                      <select class="form-select form-select-sm update-status" data-order-id="<?= $order->id ?>">
                        <option value="pending" <?= $order->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="delivered" <?= $order->status == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                      </select>
                      <span
                        class="badge bg-<?= $order->status == 'delivered' ? 'success' : 'warning' ?> ms-2"><?= ucfirst($order->status) ?></span>
                    </td>



                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p>No orders found.</p>
          <?php endif; ?>
        </div>

      </div>
    </div>
    <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>
    <script>
      document.querySelectorAll('.update-status').forEach(function (select) {
        select.addEventListener('change', function () {
          const orderId = this.getAttribute('data-order-id');
          const newStatus = this.value;

          fetch("<?= base_url('AdminController/updateOrderStatus') ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
              order_id: orderId,
              status: newStatus
            })
          })
            .then(res => res.json())
            .then(data => {
              if (data.status === 'success') {
                // Update the data-status on row for filtering to work properly
                this.closest('tr').setAttribute('data-status', newStatus);

                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: data.message,
                  timer: 1500,
                  showConfirmButton: false
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Update Failed',
                  text: data.message
                });
              }
            })
            .catch(err => {
              console.error(err);
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!'
              });
            });
        });
      });

    </script>


    <script>
      const rowsPerPage = 10;
      const table = document.getElementById("ordersTable");
      const tbody = table.querySelector("tbody");
      const rows = Array.from(tbody.querySelectorAll("tr"));
      const pagination = document.getElementById("pagination");
      const statusFilter = document.getElementById("ProductStatus");

      let currentPage = 1;

      function getFilteredRows() {
        const selectedStatus = statusFilter.value;
        return rows.filter(row => {
          const status = row.getAttribute("data-status");
          return selectedStatus === "all" || status === selectedStatus;
        });
      }

      function showPage(page) {
        const filteredRows = getFilteredRows();
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach(row => row.style.display = "none");
        filteredRows.slice(start, end).forEach(row => row.style.display = "");

        updatePaginationButtons(filteredRows.length, page);
      }

      function updatePaginationButtons(totalRows, activePage) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        pagination.innerHTML = "";

        // Previous button using &laquo;
        const prev = document.createElement("li");
        prev.className = "page-item" + (activePage === 1 ? " disabled" : "");
        const prevLink = document.createElement("a");
        prevLink.className = "page-link";
        prevLink.href = "#";
        prevLink.innerHTML = "&laquo;";
        prevLink.onclick = e => {
          e.preventDefault();
          if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
          }
        };
        prev.appendChild(prevLink);
        pagination.appendChild(prev);

        // Page number buttons
        for (let i = 1; i <= totalPages; i++) {
          const li = document.createElement("li");
          li.className = "page-item" + (i === activePage ? " active" : "");
          const link = document.createElement("a");
          link.className = "page-link";
          link.href = "#";
          link.textContent = i;
          link.onclick = e => {
            e.preventDefault();
            currentPage = i;
            showPage(currentPage);
          };
          li.appendChild(link);
          pagination.appendChild(li);
        }

        // Next button using &raquo;
        const next = document.createElement("li");
        next.className = "page-item" + (activePage === totalPages ? " disabled" : "");
        const nextLink = document.createElement("a");
        nextLink.className = "page-link";
        nextLink.href = "#";
        nextLink.innerHTML = "&raquo;";
        nextLink.onclick = e => {
          e.preventDefault();
          if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
          }
        };
        next.appendChild(nextLink);
        pagination.appendChild(next);
      }

      // Initial page load
      showPage(currentPage);

      // Filter change listener
      statusFilter.addEventListener("change", () => {
        currentPage = 1;
        showPage(currentPage);
      });
    </script>



    <script>
      document.getElementById("ProductStatus").addEventListener("change", function () {
        const selected = this.value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
          const status = row.getAttribute("data-status");

          if (selected === "all" || selected === status) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      });
    </script>

</body>

</html>