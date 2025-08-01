<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <!-- sidebar -->
      <?php include 'sidebar.php'; ?>

      <div class="col-lg-9 col-xl-10 col-12 shadow offset-xl-2 offset-lg-3">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>

        <div class="container p-5">
          <h2>Manage Categories</h2>

          <!-- Add Category -->
          <div class="row mb-4">
            <div class="col-md-3">
              <input type="text" id="catName" class="form-control" placeholder="Enter Category Name">
            </div>
            <div class="col-md-3">
              <select id="catType" class="form-select">
                <option value="">Select Type</option>
                <option value="Gold">Gold</option>
                <option value="Silver">Silver</option>
                <option value="Diamond">Diamond</option>
                <option value="Platinum">Platinum</option>
              </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
              <button id="catActionBtn" class="btn gradient-button w-100" onclick="addCategory()">
                <i class="fas fa-plus"></i> Add
              </button>

              <button id="cancelEdit" onclick="cancelEditMode()" class="btn btn-secondary w-100" style="display: none;">
                Cancel
              </button>
            </div>

          </div>


          <!-- Category Table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Category ID</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="catTable">
                <?php $i = 1;

                foreach ($categories as $cat): ?>
                  <tr data-id="<?= $cat->id ?>">
                    <td class="text-center"><?= $i++ ?></td>

                    <td class="text-center"><?= $cat->id ?></td>
                    <td class="text-center"><?= $cat->type ?></td>
                    <td class="text-center"><?= $cat->name ?></td>

                    <td class="text-center">
                      <button class="btn btn-sm gradient-button me-2"
                        onclick="editCategory(<?= $cat->id ?>, '<?= $cat->name ?>', '<?= $cat->type ?>')">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button class="btn btn-sm gradient-button" onclick="deleteCategory(<?= $cat->id ?>)">
                        <i class="fas fa-trash"></i> Delete
                      </button>

                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <hr>

          <h2>Add Subcategory</h2>
          <div class="row mb-4">
            <div class="col-md-3">
              <select id="subCatCategory" class="form-select">
                <option value="">Select Category</option>
                <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat->id ?>"><?= $cat->name ?> (<?= $cat->type ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <input type="text" id="subCatName" class="form-control" placeholder="Subcategory Name">
            </div>
            <div class="col-md-3">
              <select id="groupType" class="form-select">
                <option value="">Select Group Type</option>
                <option value="Shop by Style">Shop by Style</option>
                <option value="Shop by Occasion">Shop by Occasion</option>
              </select>
            </div>
            <input type="hidden" id="editCatId" value="">

            <div class="col-md-2">
              <button class="btn gradient-button w-100" onclick="addSubcategory()">
                <i class="fas fa-plus"></i> Add
              </button>
            </div>
          </div>

          <!-- Subcategory Table -->
          <h3>Subcategories</h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Group Type</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="subcatTable">
                <?php $i = 1;

                foreach ($subcategories as $sub): ?>
                  <tr data-id="<?= $sub->id ?>">
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= $sub->category_id ?></td>
                    <td class="text-center"><?= $sub->name ?></td>
                    <td class="text-center"><?= $sub->group_type ?></td>
                    <td class="text-center">
                      <button class="btn btn-sm gradient-button" onclick="deleteSubcategory(<?= $sub->id ?>)">
                        <i class="fas fa-trash"></i> Delete
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function addCategory() {
      const name = document.getElementById("catName").value.trim();
      const type = document.getElementById("catType").value;
      const catId = document.getElementById("editCatId").value;

      if (!name || !type) return Swal.fire("Error", "Enter category name and select type", "warning");

      const url = catId ? "<?= base_url('AdminController/updateCategory') ?>" : "<?= base_url('AdminController/addCategory') ?>";
      const body = catId ?
        `id=${catId}&name=${encodeURIComponent(name)}&type=${type}` :
        `name=${encodeURIComponent(name)}&type=${type}`;

      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: body
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: catId ? 'Category updated!' : 'Category added!',
              showConfirmButton: false,
              timer: 1500
            }).then(() => location.reload());
          } else {
            Swal.fire("Error", data.message, "error");
          }
        });
    }

    function editCategory(id, name, type) {
      document.getElementById("catName").value = name;
      document.getElementById("editCatId").value = id;
      document.getElementById("catType").value = type;

      // Focus input
      const input = document.getElementById("catName");
      input.focus();

      // Change button to Update
      const btn = document.getElementById("catActionBtn");
      btn.innerHTML = '<i class="fas fa-edit"></i> Update';
      btn.classList.remove("gradient-button");
      btn.classList.add("btn-warning");

      // Show Cancel button
      document.getElementById("cancelEdit").style.display = "block";

      // Optional: Scroll smoothly to input
      input.scrollIntoView({ behavior: "smooth", block: "center" });

      // Optional SweetAlert
      Swal.fire({
        icon: "info",
        title: "Edit Mode",
        text: "You're editing a category.",
        showConfirmButton: false,
        timer: 1000
      });
    }


    function cancelEditMode() {
      document.getElementById("catName").value = "";
      document.getElementById("editCatId").value = "";

      const btn = document.getElementById("catActionBtn");
      btn.innerHTML = '<i class="fas fa-plus"></i> Add';
      btn.classList.remove("btn-warning");
      btn.classList.add("gradient-button");

      document.getElementById("cancelEdit").style.display = "none";
    }




    function deleteCategory(id) {
      Swal.fire({
        title: "Delete Category?",
        text: "This will also delete all related subcategories!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff5c8d",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.isConfirmed) {
          fetch("<?= base_url('AdminController/deleteCategory') ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id=${id}`
          })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Deleted!',
                  text: 'Category has been deleted.',
                  showConfirmButton: false,
                  timer: 1500
                }).then(() => document.querySelector(`tr[data-id="${id}"]`).remove());
              }
            });
        }
      });
    }

    function addSubcategory() {
      const category_id = document.getElementById("subCatCategory").value;
      const name = document.getElementById("subCatName").value.trim();
      const group_type = document.getElementById("groupType").value;

      if (!category_id || !name || !group_type) {
        return Swal.fire("Error", "All fields are required", "warning");
      }

      fetch("<?= base_url('AdminController/addSubcategory') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `category_id=${category_id}&name=${encodeURIComponent(name)}&group_type=${group_type}`
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Subcategory added!',
              showConfirmButton: false,
              timer: 1500
            }).then(() => location.reload());
          } else {
            Swal.fire("Error", data.message, "error");
          }
        });
    }

    function deleteSubcategory(id) {
      Swal.fire({
        title: "Delete Subcategory?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff5c8d",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.isConfirmed) {
          fetch("<?= base_url('AdminController/deleteSubcategory') ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id=${id}`
          })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Deleted!',
                  text: 'Subcategory has been deleted.',
                  showConfirmButton: false,
                  timer: 1500
                }).then(() => document.querySelector(`#subcatTable tr[data-id="${id}"]`).remove());
              }
            });
        }
      });
    }
  </script>
</body>

</html>