<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard with Banner Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .cursor-pointer {
      cursor: pointer;
    }

    :root {
      --purple-light: #f6efff;
      --purple-main: #9a55ff;
      --accent: #ff5c8d;
      --bg-light: #f3f4f6;
      --radius: 12px;
    }

    body {
      background: var(--bg-light);
      font-family: 'Segoe UI', sans-serif;
      color: #333;
    }

    h5.section-title {
      font-weight: 600;
      margin-bottom: 12px;
      color: #222;
    }

    .card-stats {
      background: white;
      border-radius: var(--radius);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s;
    }

    .card-stats:hover {
      transform: translateY(-3px);
    }

    .card-stats .icon-circle {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--purple-main);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.4rem;
      margin-right: 16px;
    }

    .card-stats .stat-value {
      font-size: 1.7rem;
      font-weight: 600;
    }

    .card-stats .stat-label {
      color: #666;
      font-size: 0.9rem;
    }

    .chart-container {
      background: white;
      border-radius: var(--radius);
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link.active {
      background: var(--purple-light);
      color: var(--purple-main);
    }

    .mini-card {
      background: white;
      border-radius: var(--radius);
      padding: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
      text-align: center;
    }

    .mini-card .avatar-sm {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: var(--purple-light);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: var(--purple-main);
      font-size: 1rem;
      margin-bottom: 8px;
    }

    .table thead th {
      font-weight: 600;
      color: var(--purple-main);
      border-bottom: none;
    }

    .table tbody tr:hover {
      background: #fafafa;
    }

    .progress {
      height: 6px;
      border-radius: 3px;
    }

    .progress-bar {
      border-radius: 3px;
    }
  </style>
</head>

<body style="background-color:#f8f9fa">
  <div class="container-fluid p-0" style=" background:#FAFAF9">
    <div class="row g-0">
      <!-- sidebar   -->
      <?php include 'sidebar.php'; ?>

      <div class="col-lg-9 col-xl-10 col-12  shadow offset-xl-2 offset-lg-3  ">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>



        <div class="container-fluid py-4">
          <div class="container">

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="card-stats d-flex align-items-center p-3">
                  <div class="icon-circle"><i class="fa-solid fa-file-lines"></i></div>
                  <div>
                    <div class="stat-value">75</div>
                    <div class="stat-label">Total Orders</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card-stats d-flex align-items-center p-3">
                  <div class="icon-circle"><i class="fa-solid fa-user-group"></i></div>
                  <div>
                    <div class="stat-value">120</div>
                    <div class="stat-label">Total Clients</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card-stats d-flex align-items-center p-3">
                  <div class="icon-circle"><i class="fa-solid fa-truck"></i></div>
                  <div>
                    <div class="stat-value">60</div>
                    <div class="stat-label">Total Delivered</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card-stats d-flex align-items-center p-3">
                  <div class="icon-circle"><i class="fa-solid fa-dollar-sign"></i></div>
                  <div>
                    <div class="stat-value">$1.8K</div>
                    <div class="stat-label">Total Revenue</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Top Products + Expense Chart -->
            <div class="row g-4 mb-4">

  <div class="col-lg-8">
    <div class="chart-container p-3 mb-4">
      <h5 class="section-title mb-3">Today's Rate</h5>
      <div class="table-responsive">
        <table class="table align-middle table-hover">
          <thead>
             <tr>
      <th>Sr. No</th>
      <th>Category</th>
      <th>Price (₹)</th>
      <th>Increased By (₹)</th>
      <th>Decreased By (₹)</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- Row Template (Repeat for all rows) -->
    <tr>
      <td>01</td>
      <td class="editable">Gold 24K</td>
      <td class="editable">₹5,800</td>
      <td class="editable">₹50</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>02</td>
      <td class="editable">Silver 99.9</td>
      <td class="editable">₹72</td>
      <td class="editable">₹2</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>03</td>
      <td class="editable">Platinum 99.9</td>
      <td class="editable">₹3,200</td>
      <td class="editable">-</td>
      <td class="editable">₹100</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>04</td>
      <td class="editable">Diamond FL</td>
      <td class="editable">₹52,000</td>
      <td class="editable">₹500</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>05</td>
      <td class="editable">Diamond IF</td>
      <td class="editable">₹48,000</td>
      <td class="editable">-</td>
      <td class="editable">₹300</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>06</td>
      <td class="editable">Diamond VVS1</td>
      <td class="editable">₹44,500</td>
      <td class="editable">₹250</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>07</td>
      <td class="editable">Diamond VS1</td>
      <td class="editable">₹40,000</td>
      <td class="editable">₹100</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>08</td>
      <td class="editable">Diamond SI1</td>
      <td class="editable">₹35,000</td>
      <td class="editable">-</td>
      <td class="editable">₹200</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
    <tr>
      <td>09</td>
      <td class="editable">Diamond I1</td>
      <td class="editable">₹30,000</td>
      <td class="editable">₹150</td>
      <td class="editable">-</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
          <i class="fa fa-edit"></i>
        </button>
      </td>
    </tr>
  </tbody>

        </table>
      </div>
    </div>
    <div class="row g-3 mb-4 ">
      <div class="col-md-7 col-lg-12 ">
        <div class="chart-container p-3 mb-4">
          <h5 class="section-title">Top Products</h5>
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>Sr. No</th>
                  <th>Name</th>
                  <th>Popularity</th>
                  <th class="text-end">Sales</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>01</td>
                  <td>Twisted Ring</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar bg-primary" style="width:90%"></div>
                    </div>
                  </td>
                  <td class="text-end text-primary">45%</td>
                </tr>
                <tr>
                  <td>02</td>
                  <td>Golden Studs</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar bg-success" style="width:75%"></div>
                    </div>
                  </td>
                  <td class="text-end text-success">29%</td>
                </tr>
                <tr>
                  <td>03</td>
                  <td>Butterfly Pendant</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar" style="background:var(--purple-main);width:45%"></div>
                    </div>
                  </td>
                  <td class="text-end" style="color:var(--purple-main)">18%</td>
                </tr>
                <tr>
                  <td>04</td>
                  <td>Traditional Necklace</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar bg-warning" style="width:55%"></div>
                    </div>
                  </td>
                  <td class="text-end text-warning">25%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-lg-4">
    <div class="chart-container p-3 mb-4">
      <h5 class="section-title">Expenses</h5>
      <!-- Nav Pills -->
      <ul class="nav nav-pills mb-3 tab-pill justify-content-center">
        <li class="nav-item">
          <button class="nav-link" data-type="daily">Daily</button>
        </li>
        <li class="nav-item">
          <button class="nav-link active" data-type="weekly">Weekly</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-type="monthly">Monthly</button>
        </li>
      </ul>
      <!-- Chart -->
      <canvas id="expenseChart" height="200"></canvas>
    </div>
    <div class="chart-container p-3 mb-4">
      <h5 class="section-title">Top Clients</h5>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Sr. No</th>
              <th>Name</th>
              <th>Orders</th>
              <th class="text-end">Client ID</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01</td>
              <td><i class="fa-solid fa-user"></i> Aditi T</td>
              <td>3</td>
              <td class="text-end">2</td>
            </tr>
            <tr>
              <td>02</td>
              <td><i class="fa-solid fa-user"></i> Aditi T</td>
              <td>3</td>
              <td class="text-end">2</td>
            </tr>
            <tr>
              <td>03</td>
              <td><i class="fa-solid fa-user"></i> Aditi T</td>
              <td>3</td>
              <td class="text-end">2</td>
            </tr>
            <tr>
              <td>04</td>
              <td><i class="fa-solid fa-user"></i> Aditi T</td>
              <td>3</td>
              <td class="text-end">2</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
            </div>

            <!-- Clients & Requests -->

            <div class="col-lg-4">
              <h5 class="section-title">Client Requests</h5>
              <div class="d-flex flex-column gap-3">
                <div class="mini-card d-flex align-items-center gap-3">
                  <div class="avatar-sm" style="width:36px;height:36px;font-size:14px"><i class="fa-solid fa-user"></i>
                  </div>
                  <div class="flex-grow-1">Aditi Thigle</div>
                  <span class="text-muted small">IDR</span>
                </div>
              </div>
            </div>
          </div>
          <div class="container my-4">
            <h4 class="mb-4">Hero Banners</h4>
            <div class="row" id="banner-container">

              <?php foreach ($banners as $banner): ?>
                <div class="col-md-3 mb-3 banner-card" data-id="<?= $banner->id ?>">
                  <div class="card">
                    <img src="<?= base_url('uploads/hearo_banners/' . $banner->image) ?>" class="card-img-top"
                      height="200" width="100%">
                    <div class="card-footer text-center">
                      <button class="btn btn-danger btn-sm" onclick="deleteBanner(<?= $banner->id ?>)"><i
                          class="fa fa-trash"></i></button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

              <!-- Upload New -->
              <div class="col-md-3 mb-3 mt-4 pl-5">
                <!-- <div class="card text-center"> -->
                <div class="card-body">
                  <input type="file" name="banner_image" id="fileInput" class="d-none">
                  <label for="fileInput" class="cursor-pointer">
                    <img src="<?= base_url('assets/Admin/add.jpeg') ?>" height="150" width="100%" alt="Upload">
                  </label>
                </div>
              </div>
            </div>

          </div>
        </div>

        <script>
          $(document).ready(function () {
            $('#fileInput').change(function () {
              var formData = new FormData();
              formData.append('banner_image', this.files[0]);

              $.ajax({
                url: "<?= base_url('AdminController/uploadBannerAjax') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                  const $newCard = $(response).hide();
                  $('#banner-container').prepend($newCard);
                  $newCard.fadeIn(400);
                  Swal.fire({
                    icon: 'success',
                    title: 'Banner uploaded!',
                    showConfirmButton: false,
                    timer: 2000
                  });
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Upload failed!',
                    timer: 2000,
                    showConfirmButton: false
                  });
                }
              });
            });
          });

          function deleteBanner(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#6c757d',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: "<?= base_url('AdminController/deleteBannerAjax') ?>/" + id,
                  type: "POST",
                  success: function () {
                    $('.banner-card[data-id="' + id + '"]').fadeOut(400, function () {
                      $(this).remove();
                    });
                    Swal.fire({
                      icon: 'success',
                      title: 'Banner deleted!',
                      showConfirmButton: false,
                      timer: 2000
                    });
                  },
                  error: function () {
                    Swal.fire({
                      icon: 'error',
                      title: 'Delete failed!',
                      timer: 2000,
                      showConfirmButton: false
                    });
                  }
                });
              }
            });
          }
        </script>

        <!-- Inline Edit Script -->
<script>
  document.querySelectorAll(".edit-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const row = this.closest("tr");
      const isEditing = row.classList.contains("editing");

      if (!isEditing) {
        // Start Editing
        row.classList.add("editing");
        this.innerHTML = '<i class="fa fa-save"></i>';

        row.querySelectorAll("td.editable").forEach(function (cell) {
          const val = cell.innerText.trim().replace('₹', '').replace(',', '');
          cell.innerHTML = `<input type="text" class="form-control form-control-sm" value="${val}">`;
        });
      } else {
        // Save
        row.classList.remove("editing");
        this.innerHTML = '<i class="fa fa-edit"></i>';

        row.querySelectorAll("td.editable").forEach(function (cell) {
          const input = cell.querySelector("input");
          if (input) {
            let value = input.value.trim();
            if (value !== '-' && !value.startsWith('₹')) {
              value = '₹' + value;
            }
            cell.innerText = value;
          }
        });

        // SweetAlert confirmation
        Swal.fire({
          icon: 'success',
          title: 'Updated!',
          text: 'The row has been updated successfully.',
          timer: 1800,
          showConfirmButton: false
        });
      }
    });
  });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById("expenseChart").getContext("2d");

          const dataMap = {
            daily: [450, 1000 - 450],
            weekly: [5670, 14500 - 5670],
            monthly: [9500, 30000 - 9500]
          };

          let currentType = 'weekly';
          const expenseChart = new Chart(ctx, {
            type: "doughnut",
            data: {
              labels: ["Spent", "Remaining"],
              datasets: [{
                data: dataMap[currentType],
                backgroundColor: ["#ff5c8d", "#9a55ff"],
                borderWidth: 0
              }]
            },
            options: {
              cutout: "70%",
              plugins: {
                legend: {
                  display: false
                }
              }
            }
          });

          // Make the nav pills clickable and update chart
          document.querySelectorAll('.nav-pills .nav-link').forEach(function(btn) {
            btn.addEventListener('click', function() {
              document.querySelectorAll('.nav-pills .nav-link').forEach(function(b) {
                b.classList.remove('active');
              });
              this.classList.add('active');
              const type = this.getAttribute('data-type');
              currentType = type;
              expenseChart.data.datasets[0].data = dataMap[type];
              expenseChart.update();
            });
          });
        </script>

</body>

</html>