<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Astrogames</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
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

    h2,
    h3 {
      font-weight: 600;
      margin-bottom: 20px;
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

    .table {
      background: white;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
      font-weight: 600;
      color: var(--purple-main);
      border-bottom: none;
      background-color: var(--purple-light);
    }

    .table tbody tr:hover {
      background: #fafafa;
    }

    .btn-success {
      background-color: var(--purple-main);
      border-color: var(--purple-main);
    }

    .btn-success:hover {
      background-color: #8a4be8;
      border-color: #8a4be8;
    }

    .btn-danger {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .btn-danger:hover {
      background-color: #e64c7f;
      border-color: #e64c7f;
    }

    .form-control,
    .form-select {
      border-radius: var(--radius);
      border: 1px solid #ddd;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--purple-main);
      box-shadow: 0 0 0 0.25rem rgba(154, 85, 255, 0.25);
    }

    hr {
      margin: 2rem 0;
      border-top: 1px solid #eee;
    }

    .container {
      background: white;
      border-radius: var(--radius);
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .gradient-button {
      background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
      color: white !important;
      padding: 12px 25px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease-in-out;
      box-shadow: 0 4px 10px rgba(154, 85, 255, 0.3);
    }

    .gradient-button:hover {
      opacity: 0.9;
      transform: scale(1.03);
    }
  </style>
</head>

<body style="background-color:#f8f9fa">
  <div class="container-fluid p-0" style="background:#FAFAF9">
    <div class="row g-0">
      <?php include 'sidebar.php'; ?>
      <div class="col-lg-9 col-xl-10 col-12 shadow offset-xl-2 offset-lg-3">
        <?php include 'navbar.php'; ?>
        <div class="container p-5">
          <h2>Manage Astrogames</h2>
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Astrogames List</h3>
            <button class="gradient-button" data-bs-toggle="modal" data-bs-target="#astroModal">+ Add Astrogame</button>
          </div>
          <table class="table table-bordered table-hover mt-3">
            <thead>
              <tr>
                <th>Image</th>

                <th>Month</th>
                <th>Gemstone</th>
                <th>Description</th>
                <!-- <th>Benefits</th> -->
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($astrogames as $row): ?>
                <tr>
                  <td><img src="<?= base_url($row['image_path']) ?>" width="60" height="60" class="rounded-circle"></td>

                  <td><?= $row['month'] ?></td>
                  <td><?= $row['gemstone_name'] ?></td>
                  <td>
                    <ul class="mb-0 ps-3">
                      <?php
                      $descArray = json_decode($row['description'], true);
                      if (is_array($descArray)) {
                        foreach ($descArray as $d) {
                          echo "<li>" . htmlspecialchars($d) . "</li>";
                        }
                      } else {
                        echo "<li>" . htmlspecialchars($row['description']) . "</li>";
                      }
                      ?>
                    </ul>
                  </td>
                  <!-- <td><?= $row['benefits'] ?></td> -->
                  <td>
                    <button class="btn btn-success btn-sm editBtn" data-id="<?= $row['id'] ?>"
                      data-month="<?= $row['month'] ?>" data-gem="<?= $row['gemstone_name'] ?>"
                      data-desc='<?= json_encode(json_decode($row['description'], true)) ?>'
                      data-image="<?= $row['image_path'] ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-id="<?= $row['id'] ?>">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="astroModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form method="post" enctype="multipart/form-data" action="<?= base_url('AdminController/save_astrogame') ?>">
        <input type="hidden" name="id" id="astro_id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add/Edit Astrogame</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <label>Month</label>
              <input type="text" class="form-control" name="month" id="month" required>
            </div>
            <div class="col-md-6">
              <label>Gemstone Name</label>
              <input type="text" class="form-control" name="gemstone_name" id="gemstone_name" required>
            </div>
            <div class="col-md-6">
              <label>Image</label>
              <input type="file" class="form-control" name="image">
              <input type="hidden" name="old_image" id="old_image">
              <div id="previewImage" class="mt-2"></div>
            </div>
            <div class="col-12">
              <label>Descriptions</label>
              <div id="descriptionFields"></div>
              <button type="button" class="btn btn-secondary btn-sm" id="addDesc">+ Add Description</button>
            </div>
            <!-- <div class="col-12">
            <label>Benefits</label>
            <textarea class="form-control" name="benefits" id="benefits"></textarea>
          </div> -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="astroSaveBtn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Show SweetAlert on Save button click (before form submit)
    $(document).on('click', '#astroSaveBtn', function(e) {
      Swal.fire({
        icon: 'success',
        title: 'Astrogem added successfully!',
        showConfirmButton: false,
        timer: 3000
      });
    });
    $('.editBtn').on('click', function () {
      $('#astro_id').val($(this).data('id'));
      $('#month').val($(this).data('month'));
      $('#gemstone_name').val($(this).data('gem'));
      $('#old_image').val($(this).data('image'));
      $('#previewImage').html(`<img src="<?= base_url() ?>${$(this).data('image')}" width="60">`);

      let descriptions = $(this).data('desc');
      if (!Array.isArray(descriptions)) {
        descriptions = [descriptions];
      }
      $('#descriptionFields').html('');
      descriptions.forEach(function (desc) {
        $('#descriptionFields').append(`
        <div class="input-group mb-2">
          <input type="text" name="description[]" class="form-control" value="${String(desc).replace(/"/g, '&quot;')}">
          <button type="button" class="btn btn-danger remove-desc"><i class="fa fa-times"></i></button>
        </div>
      `);
      });
      $('#astroModal').modal('show');
    });

    $('#addDesc').click(function () {
      $('#descriptionFields').append(`
      <div class="input-group mb-2">
        <input type="text" name="description[]" class="form-control" placeholder="Enter a description">
        <button type="button" class="btn btn-danger remove-desc"><i class="fa fa-times"></i></button>
      </div>
    `);
    });

    $(document).on('click', '.remove-desc', function () {
      $(this).closest('.input-group').remove();
    });

    $('.deleteBtn').on('click', function () {
      let id = $(this).data('id');
      Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '<?= base_url("AdminController/delete_astrogame/") ?>' + id;
        }
      });
    });
  </script>

</body>

</html>