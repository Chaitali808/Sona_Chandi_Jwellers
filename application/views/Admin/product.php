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



  <style>
    html,
    body {
      width: 100vw;
      height: 100vh;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    :root {
      /* Text Colors */
      --text-primary: #212529;
      --text-secondary: #6c757d;
      --text-light: #ffffff;

      /* Button Colors */
      --btn-primary-bg: #0d6efd;
      --btn-primary-hover: #0b5ed7;
      --btn-secondary-bg: #6c757d;
      --btn-secondary-hover: #5c636a;

      /* Icon Colors */
      --icon-color: #495057;
      --icon-hover-color: #0d6efd;
    }

    table {
      border-collapse: separate;
      border-spacing: 5px 7px;
      margin: 3px;

    }


    tbody tr,
    thead {
      background-color: rgb(234, 168, 193);
      border-radius: 12px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.26);
    }



    tbody td {
      border: none;
      padding: 1rem;
    }

    tbody td {
      border: none;
      padding: 1rem;
    }

    th {

      height: 60px;
    }

    td img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 6px;
    }



    @media (max-width: 576px) {

      table td,
      table th {
        font-size: 13px;
      }

      td img {
        width: 45px;
        height: 45px;
      }

      .edit-btn {
        font-size: 16px;
        padding: 4px 8px;
      }

      .gradient-button {
        padding: 5px 8px;
        font-size: 10px;

        width: 100%;
      }

      .table-responsive-sm {
        max-height: 300px;
      }
    }

    /* Tablets (577px - 768px) */
    @media (min-width: 577px) and (max-width: 768px) {

      table td,
      table th {
        font-size: 14px;
      }

      td img {
        width: 50px;
        height: 50px;
      }


      .table-responsive-sm {
        max-height: 400px;
      }
    }

    /* Small laptops (769px - 992px) */
    @media (min-width: 769px) and (max-width: 992px) {

      table td,
      table th {
        font-size: 15px;
      }

      td img {
        width: 55px;
        height: 55px;
      }

      .gradient-button {
        font-size: 16px;
        padding: 12px 25px;
      }
    }


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



    .card-custom {
      border-radius: 10px;
      border: 1px solid #ccc;
      padding: 20px;
      background-color: #fff;
    }

    .dashed-box {
      border: 2px dashed #ddd;
      text-align: center;
      padding: 40px;
      border-radius: 6px;
      color: #aaa;
    }

    .tag-box span {
      background-color: #f0f0f0;
      padding: 5px 10px;
      margin-right: 5px;
      border-radius: 20px;
      display: inline-block;
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

    #addProductModal .modal-body {
      max-height: 70vh;
      /* adjust height as needed */
      overflow-y: auto;
      padding-right: 10px;
    }

    /* Optional: smooth scroll & fix padding flicker */
    #addProductModal .modal-body::-webkit-scrollbar {
      width: 6px;
    }

    #addProductModal .modal-body::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.2);
      border-radius: 3px;
    }

    .dynamic-category {
      padding: 4px 0;
    }

    /* Add to your CSS file */
    .filter-container {
      display: flex;
      gap: 10px;
    }

    .filter-container .form-select {
      flex: 1;
      min-width: 150px;
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
      <!-- sidebar -->
      <?php include 'sidebar.php'; ?>

      <div class="col-lg-9 col-xl-10 col-12 offset-xl-2 offset-lg-3 text-white">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>


        <!-- main content here -->
        <div class="container-fluid m-2 d-flex justify-content-start align-items-center p-2">
          <form class="d-flex p-2 w-50" role="search">
            <input type="text" class="form-control rounded-start-5 p-2 rounded-end-0 border-end-0 text-center"
              style="border:1px solid rgba(106, 15, 224, 0.47);" placeholder="Search products"
              aria-label="Search products">
            <span class="input-group-text bg-white rounded-end-5 rounded-start-0 border-start-0"
              style="border:1px solid rgba(106, 15, 224, 0.47);">
              <i class="fa-solid text-dark fa-magnifying-glass fs-5 text-muted"></i>
            </span>
          </form>
        </div>

        <div class="container-fluid px-3 mt-4">
          <div class="row align-items-center justify-content-between">
            <!-- Filter Dropdowns -->
            <div class="col-12 col-sm-6 col-md-4 mb-2 d-flex gap-2">
              <!-- Type Filter -->
              <select id="typeFilter" name="Filter" class="form-select">
                <option value="All">All Types</option>
                <option value="Gold">Gold</option>
                <option value="Silver">Silver</option>
                <option value="Diamond">Diamond</option>
                <option value="Astrogems">Astrogems</option>
              </select>

              <!-- New Category Filter -->
              <select id="categoryFilter" name="categoryFilter" class="form-select">
                <option value="All">All Categories</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= htmlspecialchars($category->name) ?>">
                    <?= htmlspecialchars($category->name) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Add Product Button -->
            <div class="col-12 col-sm-6 col-md-3 text-sm-end mb-2">
              <button type="button" class="btn gradient-button" data-bs-toggle="modal"
                data-bs-target="#addProductModal">
                <i class="fa-solid fa-plus"></i> Add Product
              </button>
            </div>
          </div>
        </div>

        <div class="container-sm-fluid table-responsive-sm px-3">
          <table class="table text-center table-sm table-borderless rounded align-middle">
            <thead class="align-middle">
              <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Carat</th>
                <th>Discount %</th>
                <th>Weight</th>
                <th>Making Charges</th>
                <th>GST</th>
                <th>Type</th>
                <th>Tags</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($products as $product): ?>
                <tr>
                  <td><?= $product->product_code ?></td>
                  <td>
                    <img src="<?= base_url('' . $product->image); ?>" alt="Main Image" width="50" height="50"
                      style="object-fit: cover; border-radius: 8px;">
                  </td>
                  <td><?= $product->product_name ?></td>
                  <td>
                    <?php
                    $weightData = json_decode($product->weight, true);
                    $caratData = json_decode($product->carat, true);
                    $rates = $rates ?? []; // Passed from controller
                  
                    if (!is_array($weightData) || empty($weightData)) {
                      echo "N/A";
                    } else {
                      $total_material_price = 0;

                      foreach ($weightData as $material => $weight_gram) {
                        $weight_gram = floatval($weight_gram);
                        $material_lower = strtolower(trim($material));
                        $carat = isset($caratData[$material]) ? strtolower(trim($caratData[$material])) : '';

                        $price_per_gram = 0;

                        if ($material_lower === 'gold') {
                          $price_per_gram = $rates['gold'][$carat] ?? 0;
                        } elseif (in_array($material_lower, ['silver', 'platinum'])) {
                          $price_per_gram = $rates[$material_lower][$carat] ?? 0;
                        } elseif ($material_lower === 'diamond') {
                          $price_per_gram = $rates['diamond'][$carat] ?? 0;
                        }

                        $material_price = $weight_gram * $price_per_gram;
                        $total_material_price += $material_price;
                      }

                      // Charges
                      $making_charges = floatval($product->making_charges);
                      $discount = floatval($product->discount_percentage);
                      $gst = floatval($product->gst);
                      $other_charges = isset($product->other_charges) ? floatval($product->other_charges) : 0;

                      $discounted_making = $making_charges - ($making_charges * $discount / 100);
                      $subtotal = $total_material_price + $discounted_making;

                      // Include other_charges if it's greater than 0
                      if ($other_charges > 0) {
                        $subtotal += $other_charges;
                      }

                      $gst_amount = $subtotal * $gst / 100;
                      $total_price = $subtotal + $gst_amount;

                      echo "₹ " . number_format($total_price, 2);
                    }
                    ?>
                  </td>
                  <td>
                    <?= is_array($product->categories) ? implode(', ', $product->categories) : $product->categories ?>
                  </td>
                  <td>
                    <?php
                    $caratData = json_decode($product->carat, true);
                    if (is_array($caratData)) {
                      foreach ($caratData as $type => $carat) {
                        echo "$type: $carat<br>";
                      }
                    } else {
                      echo $product->carat;
                    }
                    ?>
                  </td>
                  <td><?= $product->discount_percentage ?></td>
                  // In your product listing view
                  <td>
                    <?php
                    $weightData = json_decode($product->weight, true);
                    if (is_array($weightData)) {
                      foreach ($weightData as $type => $weight) {
                        echo "$type: $weight g<br>";
                      }
                    } else {
                      echo $product->weight;
                    }
                    ?>
                  </td>
                  <td><?= $product->making_charges ?></td>
                  <td><?= $product->gst ?></td>

                  <td>
                    <?= is_array($product->type) ? implode(', ', $product->type) : $product->type ?>
                  </td>
                  <td><?= $product->tags ?></td>
                  <td>
                    <button class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal"
                      data-id="<?= $product->id ?>">
                      <i class="fa-regular fa-pen-to-square fs-5"></i>
                    </button>
                    <button class="delete-btn ms-2" data-id="<?= $product->id ?>" style="border:none;background:none;">
                      <i class="fa-solid fa-trash-can"style="color:red;"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <nav class="mt-4 mb-5">
            <ul class="pagination justify-content-center" id="pagination"></ul>
          </nav>

        </div>
      </div>
    </div>
  </div>

  <!-- Edit Product Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content" style="max-height: 95vh;">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="editProductForm" enctype="multipart/form-data">
          <input type="hidden" name="product_id" id="editProductId">
          <input type="hidden" name="removed_images" id="removedImages">

          <div class="modal-body" style="overflow-y: auto; max-height: 70vh;">
            <div class="row">
              <!-- LEFT SECTION -->
              <div class="col-lg-8">
                <div class="card-custom mb-4 h-100">
                  <h6><strong>Information</strong></h6>


                  <div class="mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="product_name" id="editProductName" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Product ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="product_code" id="editProductCode" readonly>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="editDescription" rows="3"></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Current Main Image <span class="text-danger">*</span></label><br>
                    <img id="editCurrentImage" src="" style="height: 100px;" class="border rounded">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Change Main Image</label>
                    <input type="file" name="main_image" class="form-control" id="editMainImageInput">
                    <div id="editMainImagePreview" class="mt-2"></div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Gallery Images</label>
                    <div class="current-images-container mb-3">
                      <div class="d-flex flex-wrap gap-2" id="currentGalleryImages"></div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Add More Images</label>
                      <input type="file" name="images[]" class="form-control" id="editGalleryImagesInput" multiple>
                      <div class="d-flex flex-wrap gap-2 mt-2" id="editGalleryImagesPreview"></div>
                    </div>
                  </div>

                  <!-- Add these fields inside the LEFT SECTION div, below the existing fields but before the closing </div> -->

                  <!-- Size and Dimensions -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Size</label>
                      <input type="text" class="form-control" name="size" id="editSize">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Length</label>
                      <input type="text" class="form-control" name="length" id="editLength">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Height</label>
                      <input type="text" class="form-control" name="height" id="editHeight">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Width</label>
                      <input type="text" class="form-control" name="width" id="editWidth">
                    </div>
                  </div>

                  <!-- Pricing Section -->
                  <div class="card-custom mb-3 p-3">
                    <h6><strong>Pricing Details</strong></h6>

                    <!-- Dynamic Price Inputs by Type -->
                    <div id="editDynamicPriceInputs"></div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Making Charges <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="editMakingCharges" name="making_charges" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">GST (%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="editGst" name="gst" required>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Discount (%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="editDiscountPercentage" name="discount_percentage"
                          required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Other Charges</label>
                        <input type="number" class="form-control" id="editOtherCharges" name="other_charges">
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- RIGHT SECTION -->
              <div class="col-lg-4">
                <!-- In your edit modal form (inside the right section) -->
                <div class="card-custom mb-4">
                  <h6><strong>Categories</strong></h6>
                  <div id="editCategoryBox" class="d-flex flex-wrap gap-2"></div>
                </div>

                <div class="card-custom mb-4">
                  <h6><strong>SubCategories</strong></h6>
                  <div id="editSubcategoryBox" class="d-flex flex-wrap gap-2"></div>
                </div>


                <div class="card-custom mb-4">
                  <h6><strong>Tags</strong></h6>
                  <input type="text" id="editTagInput" class="form-control mb-2"
                    placeholder="Enter tag and press Enter or comma" list="tags">
                  <div class="tag-box d-flex flex-wrap gap-2" id="editTagBox"></div>
                  <input type="hidden" name="tags" id="editTags">
                  <datalist id="tags">
                    <option value="men">
                    <option value="women">
                    <option value="daily">
                    <option value="ocasion">
                    <option value="noraml">
                  </datalist>
                </div>

                <div class="card-custom">
                  <h6><strong>SEO Settings</strong></h6>
                  <div class="mb-3">
                    <label class="form-label">SEO Title</label>
                    <input type="text" class="form-control" name="seo_title" id="editSeoTitle">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">SEO Description</label>
                    <textarea class="form-control" name="seo_description" id="editSeoDescription" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer border-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn text-white"
              style="background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);">Update Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="productForm" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="container p-2">
              <div class="row">
                <!-- Left Section -->
                <div class="col-lg-8">
                  <div class="card-custom mb-4 h-100">
                    <h6><strong>Information</strong></h6>
                    <div class="mb-3">
                      <label class="form-label">Product ID <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="product_code" placeholder="Product Unique ID"
                        required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Product Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Product Description</label>
                      <textarea class="form-control" name="description" rows="3"
                        placeholder="Product description"></textarea>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Main Image <span class="text-danger">*</span></label>
                      <div class="dashed-box">
                        <input type="file" name="main_image" id="mainImageInput" class="form-control" required>
                        <small>Recommended: 1 main image only</small>
                      </div>
                      <div id="mainImagePreview" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Gallery Images</label>
                      <div class="dashed-box">
                        <input type="file" name="images[]" id="multiImageInput" class="form-control" multiple>
                        <small>You can upload multiple gallery images</small>
                      </div>
                      <div id="imagePreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                    </div>




                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Size <span class="text-muted">(in mm)</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="size" placeholder="Enter size">
                          <span class="input-group-text">mm</span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Length <span class="text-muted">(in mm)</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="length" placeholder="Enter length">
                          <span class="input-group-text">mm</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Height <span class="text-muted">(in mm)</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="height" placeholder="Enter height">
                          <span class="input-group-text">mm</span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Width <span class="text-muted">(in mm)</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="width" placeholder="Enter width">
                          <span class="input-group-text">mm</span>
                        </div>
                      </div>
                    </div>




                    <!-- PRODUCT TYPE FILTER -->
                    <div class="card-custom mb-4 p-3">
                      <h6><strong>Product Type <span class="text-danger">*</span></strong></h6>
                      <?php
                      $types = ["Gold", "Silver", "Diamond", "Astrogems", "Platinum"];
                      foreach ($types as $type): ?>
                        <div class="form-check">
                          <input class="form-check-input type-checkbox" type="checkbox" name="type[]" value="<?= $type ?>"
                            id="type<?= $type ?>">
                          <label class="form-check-label" for="type<?= $type ?>"><?= $type ?></label>
                        </div>
                      <?php endforeach; ?>
                    </div>

                    <div id="dynamicPriceInputs"></div>

                    <div class="card-custom mb-4 p-3">
                      <h6><strong>Additional Charges</strong></h6>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Making Charges <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="making_charges" name="making_charges"
                            placeholder="Enter Making Charges" required>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">GST (%) <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="gst" name="gst" placeholder="Enter GST"
                            required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Discount (%) <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
                            placeholder="Enter Discount %" required>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Other Charges</label>
                          <input type="number" class="form-control" id="other_charges" name="other_charges"
                            placeholder="Enter Discount %">
                        </div>

                      </div>
                    </div>

                  </div>
                </div>

                <!-- Right Section -->
                <div class="col-lg-4">
                  <!-- <div class="card-custom mb-4 mt-4">
                    
                <h6><strong>Categories</strong></h6>

                    <?php if (!empty($categories)): ?>
                      <?php foreach ($categories as $cat): ?>
                        <div class="form-check dynamic-category" data-id="<?= $cat->id ?>">
                          <input type="checkbox" name="categories[]" value="<?= htmlspecialchars($cat->name) ?>"
                            class="form-check-input" id="cat<?= $cat->id ?>">
                          <label class="form-check-label"
                            for="cat<?= $cat->id ?>"><?= htmlspecialchars($cat->name) ?></label>
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <p class="text-muted">No categories available.</p>
                    <?php endif; ?>

                    <div id="newCategoryContainer" class="mt-2"></div>
                    <a href="javascript:void(0);" class="text-decoration-none"
                      id="showNewCategoryInput">Create/Delete</a>
                  </div> -->



                  <!-- CATEGORY FILTER -->
                  <div class="card-custom mb-4 mt-4">
                    <h6><strong>Categories</strong></h6>
                    <div id="categoryContainer">
                      <p class="text-muted">Select a product type to view categories.</p>
                    </div>
                  </div>

                  <!-- SUBCATEGORY FILTER (Dynamic) -->
                  <div class="card-custom mb-4 mt-4">
                    <h6><strong>Subcategories</strong></h6>
                    <div id="subcategoryContainer">
                      <p class="text-muted">Select a category to view subcategories.</p>
                    </div>
                  </div>

                  <script>
                    const categoriesData = <?= json_encode($subcategory) ?>;

                    document.querySelectorAll('.type-checkbox').forEach(checkbox => {
                      checkbox.addEventListener('change', updateCategoryFilter);
                    });

                    function updateCategoryFilter() {
                      const selectedTypes = Array.from(document.querySelectorAll('.type-checkbox:checked')).map(cb => cb.value);
                      const categoryContainer = document.getElementById('categoryContainer');
                      const subcategoryContainer = document.getElementById('subcategoryContainer');
                      categoryContainer.innerHTML = '';
                      subcategoryContainer.innerHTML = '<p class="text-muted">Select a category to view subcategories.</p>';

                      if (selectedTypes.length === 0) {
                        categoryContainer.innerHTML = '<p class="text-muted">Select a product type to view categories.</p>';
                        return;
                      }

                      const filtered = categoriesData.filter(item => selectedTypes.includes(item.type));

                      if (filtered.length === 0) {
                        categoryContainer.innerHTML = '<p class="text-muted">No categories match the selected product type(s).</p>';
                        return;
                      }

                      const addedCategories = new Set();

                      filtered.forEach(item => {
                        const cleanName = item.name.replace(/\s+/g, '-').toLowerCase();
                        const cleanType = item.type.replace(/\s+/g, '-').toLowerCase();
                        const checkboxId = `cat-${cleanType}-${cleanName}`;

                        if (!addedCategories.has(checkboxId)) {
                          const html = `
          <div class="form-check dynamic-category" data-type="${item.type}">
            <input type="checkbox" name="categories[]" value="${item.name}" class="form-check-input category-checkbox" id="${checkboxId}">
            <label class="form-check-label" for="${checkboxId}">${item.name} (${item.type})</label>
          </div>`;
                          categoryContainer.insertAdjacentHTML('beforeend', html);
                          addedCategories.add(checkboxId);
                        }
                      });

                      // Attach subcategory filter after category checkboxes are rendered
                      attachSubcategoryFilter();
                    }

                    function attachSubcategoryFilter() {
                      const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
                      categoryCheckboxes.forEach(cb => {
                        cb.addEventListener('change', updateSubcategoryFilter);
                      });
                    }

                    function updateSubcategoryFilter() {
                      const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value);
                      const subcategoryContainer = document.getElementById('subcategoryContainer');
                      subcategoryContainer.innerHTML = '';

                      if (selectedCategories.length === 0) {
                        subcategoryContainer.innerHTML = '<p class="text-muted">Select a category to view subcategories.</p>';
                        return;
                      }

                      const filteredSubs = categoriesData.filter(item => selectedCategories.includes(item.name));
                      const addedSubIds = new Set();

                      if (filteredSubs.length === 0) {
                        subcategoryContainer.innerHTML = '<p class="text-muted">No subcategories found for selected category(ies).</p>';
                        return;
                      }

                      filteredSubs.forEach(item => {
                        const cleanCat = item.name.replace(/\s+/g, '-').toLowerCase();
                        const cleanType = item.type.replace(/\s+/g, '-').toLowerCase();
                        const cleanSub = item.subName.replace(/\s+/g, '-').toLowerCase();
                        const checkboxId = `sub-${cleanType}-${cleanCat}-${cleanSub}`;

                        if (!addedSubIds.has(checkboxId)) {
                          const html = `
          <div class="form-check dynamic-subcategory" data-cat="${item.name}">
            <input type="checkbox" name="subcategories[]" value="${item.subName}" class="form-check-input" id="${checkboxId}">
            <label class="form-check-label" for="${checkboxId}">
              ${item.subName}
            </label>
          </div>`;
                          subcategoryContainer.insertAdjacentHTML('beforeend', html);
                          addedSubIds.add(checkboxId);
                        }
                      });
                    }
                  </script>



                  <div class="card-custom mb-4">
                    <h6><strong>Tags</strong></h6>
                    <input type="text" id="tagInput" class="form-control mb-2"
                      placeholder="Enter tag and press Enter or comma" list="tags">
                    <div class="tag-box d-flex flex-wrap gap-2" id="tagContainer"></div>
                    <input type="hidden" name="tags" id="hiddenTagsInput" placeholder="Tags">
                    <datalist id="tags">
                      <option value="birthday">
                      <option value="Engagement">
                      <option value="Wedding">
                      <option value="Anniversary">
                      <option value="Festivals">
                      <option value="Daily Wear">
                    </datalist>
                  </div>

                  <div class="card-custom">
                    <h6><strong>SEO Settings</strong></h6>
                    <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" name="seo_title" placeholder="SEO Title">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea class="form-control" name="seo_description" rows="3"
                        placeholder="Description"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancel
            </button>
            <button type="submit" class="btn text-white" id="saveProductBtn"
              style="background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);">
              <i class="fa-solid fa-floppy-disk me-1"></i> Save Product
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>
  <script>
    function updatePriceInputs() {
      const selectedTypes = $('.type-checkbox:checked').map(function () {
        return $(this).val();
      }).get();

      const $container = $('#dynamicPriceInputs');
      $container.html('');

      selectedTypes.forEach(type => {
        $container.append(generateInputGroup(type, type.toLowerCase()));
      });

      // Bind input change for recalculating
      $('input').off('input').on('input', calculateTotal);
    }

    function generateInputGroup(label, suffix) {
      const caratOptions = {
        gold: [24, 22, 21, 20, 18, 14, 10, 9],
        silver: [99.9, 92.5, 90.0],
        diamond: ['fl', 'if', 'vvs1', 'vs1', 'si1', 'i1'],
        platinum: [99.9, 95.0, 90.0]
      };

      const options = (caratOptions[suffix] || []).map(carat => {
        return `<option value="${carat}">${carat}</option>`;
      }).join('');

      return `
  <div class="card-custom mb-3 p-3 border">
    <h6><strong>${label} Weight & Carat</strong></h6>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Weight <span class="text-muted">(in grams)</span> <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="weight_${suffix}" id="weight_${suffix}" placeholder="Enter Weight" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Carat <span class="text-danger">*</span></label>
        <select class="form-select" name="carat_${suffix}" id="carat_${suffix}" required>
          <option value="">Select Carat</option>
          ${options}
        </select>
      </div>
    </div>
  </div>
  `;
    }



    function calculateTotal() {
      const making_charges = parseFloat($('#making_charges').val()) || 0;
      const gst = parseFloat($('#gst').val()) || 0;
      const discount = parseFloat($('#discount').val()) || 0;

      let total = making_charges;
      total += (gst / 100) * total;
      total -= (discount / 100) * total;

      $('#total_price').val(total.toFixed(2));
    }


    function calculateEditTotal() {
      const making_charges = parseFloat($('#editMakingCharges').val()) || 0;
      const gst = parseFloat($('#editGst').val()) || 0;
      const discount = parseFloat($('#editDiscountPercentage').val()) || 0;

      let total = making_charges;
      total += (gst / 100) * total;
      total -= (discount / 100) * total;

      $('#editTotalPrice').val(total.toFixed(2));
    }


    // Initialize
    $(document).ready(function () {
      $('.type-checkbox').on('change', updatePriceInputs);
    });

    function generateEditInputGroup(label, suffix, weightValue = '', caratValue = '') {
      const caratOptionsMap = {
        gold: [24, 22, 21, 20, 18, 14, 10, 9],
        silver: [99.9, 92.5, 90.0],
        diamond: ['fl', 'if', 'vvs1', 'vs1', 'si1', 'i1'],
        platinum: [99.9, 95.0, 90.0]
      };

      const options = (caratOptionsMap[suffix] || [])
        .map(c => `<option value="${c}" ${c == caratValue ? 'selected' : ''}>${c}</option>`)
        .join('');

      return `
  <div class="card-custom mb-3 p-3 border">
    <h6><strong>${label} Weight & Carat</strong></h6>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Weight span class="text-muted">(in grams)</span> <span class="text-danger">*</span></label>
        <input type="number" class="form-control edit-weight" name="weight_${suffix}" id="edit_weight_${suffix}" value="${weightValue}" placeholder="Enter Weight" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Carat <span class="text-danger">*</span></label>
<select class="form-select edit-carat" name="carat_${suffix}" id="edit_carat_${suffix}" disabled required>
          <option value="">Select Carat</option>
          ${options}
        </select>
      </div>
    </div>
  </div>
  `;
    }



    $(document).ready(function () {
      // Initialize tag systems
      initializeTagSystem('#tagInput', '#tagContainer', '#hiddenTagsInput');
      initializeTagSystem('#editTagInput', '#editTagBox', '#editTags');

      // Category management
      let inputVisible = false;
      $('#showNewCategoryInput').on('click', function () {
        if (!inputVisible) {
          $('#newCategoryContainer').html(`
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="newCategoryInput" placeholder="Enter category for Add/Delete">
              <button class="btn btn-success" id="toggleCategoryBtn" type="button">Apply</button>
            </div>
            <div id="categoryMessage" class="text-danger small mt-1"></div>
          `);
          inputVisible = true;
        } else {
          $('#newCategoryContainer').html('');
          inputVisible = false;
        }
      });

      $(document).on('click', '#toggleCategoryBtn', function () {
        const name = $('#newCategoryInput').val().trim();
        if (name === '') {
          $('#categoryMessage').text('Please enter a category name.');
          return;
        }

        $.ajax({
          url: '<?= base_url("AdminController/toggleCategory") ?>',
          type: 'POST',
          data: {
            name: name
          },
          success: function (res) {
            try {
              const response = JSON.parse(res);
              if (response.success) {
                if (response.action === 'added') {
                  const checkbox = `
                    <div class="form-check dynamic-category" data-id="${response.id}">
                      <input type="checkbox" class="form-check-input" name="categories[]" 
                             value="${name}" id="catNew${response.id}" checked>
                      <label class="form-check-label" for="catNew${response.id}">${name}</label>
                    </div>`;
                  $('#newCategoryContainer').before(checkbox);
                } else if (response.action === 'deleted') {
                  $(`.dynamic-category[data-id="${response.id}"]`).remove();
                }
                $('#newCategoryContainer').html('');
                inputVisible = false;
              } else {
                $('#categoryMessage').text(response.message);
              }
            } catch (e) {
              $('#categoryMessage').text('Invalid server response.');
            }
          },
          error: function () {
            $('#categoryMessage').text('Server error. Please try again.');
          }
        });
      });

      // Image preview handlers
      $('#mainImageInput').change(function (e) {
        previewImage(e.target.files[0], '#mainImagePreview', 100);
      });

      $('#multiImageInput').change(function (e) {
        previewMultipleImages(e.target.files, '#imagePreview', 80);
      });

      $('#editMainImageInput').change(function (e) {
        previewImage(e.target.files[0], '#editMainImagePreview', 100);
      });

      $('#editGalleryImagesInput').change(function (e) {
        previewMultipleImages(e.target.files, '#editGalleryImagesPreview', 80);
      });

      // Product CRUD operations
      $('#productForm').submit(function (e) {
        e.preventDefault();
        submitForm('<?= base_url("AdminController/addProduct") ?>', $(this), 'Product added.');
      });

      $(document).on('click', '.edit-btn', function () {
        const productId = $(this).data('id');
        $('#removedImages').val('[]');

        $.ajax({
          url: '<?= base_url("AdminController/getProductById") ?>',
          type: 'POST',
          data: {
            id: productId
          },
          dataType: 'json',
          success: function (product) {
            populateEditForm(product);
            loadGalleryImages(productId);
            $('#editProductModal').modal('show');
          }
        });
      });

      $(document).on('click', '.remove-image-btn', function () {
        const imageId = $(this).data('image-id');
        let removedImages = JSON.parse($('#removedImages').val() || '[]');

        if (!removedImages.includes(imageId)) {
          removedImages.push(imageId);
          $('#removedImages').val(JSON.stringify(removedImages));
          $(this).closest('.position-relative').fadeOut(300, function () {
            $(this).remove();
          });
        }
      });

      // Edit Product Form Submission
      $('#editProductForm').submit(function (e) {
        e.preventDefault();

        // Show loading state
        const submitBtn = $(this).find('[type="submit"]');
        const originalBtnText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');

        // Create FormData object
        const formData = new FormData(this);

        // Get removed images
        const removedImages = JSON.parse($('#removedImages').val() || '[]');
        formData.append('removed_images', JSON.stringify(removedImages));

        // Submit the form
        $.ajax({
          url: '<?= base_url("AdminController/updateProduct") ?>',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (res) {
            try {
              const response = JSON.parse(res);
              if (response.status === 'success') {
                Swal.fire({
                  title: 'Success!',
                  text: 'Product updated successfully',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1500
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire('Error!', response.message || 'Update failed', 'error');
                submitBtn.prop('disabled', false).html(originalBtnText);
              }
            } catch (e) {
              Swal.fire('Error!', 'Invalid server response', 'error');
              submitBtn.prop('disabled', false).html(originalBtnText);
            }
          },
          error: function (xhr, status, error) {
            Swal.fire('Error!', 'Failed to update product: ' + error, 'error');
            submitBtn.prop('disabled', false).html(originalBtnText);
          }
        });
      });

      $(document).on('click', '.delete-btn', function () {
        const productId = $(this).data('id');
        const row = $(this).closest('tr');

        Swal.fire({
          title: 'Are you sure?',
          text: "This action cannot be undone.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '<?= base_url("AdminController/deleteProduct") ?>',
              type: 'POST',
              data: {
                id: productId
              },
              success: function (res) {
                const response = JSON.parse(res);
                if (response.status === 'success') {
                  Swal.fire({
                    title: 'Deleted!',
                    text: 'Product has been deleted.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                  });
                  setTimeout(() => {
                    row.fadeOut(500, () => row.remove());
                  }, 1000);
                } else {
                  Swal.fire('Error!', response.message || 'Delete failed.', 'error');
                }
              },
              error: function () {
                Swal.fire('Error!', 'Something went wrong.', 'error');
              }
            });
          }
        });
      });

      // Filter functionality
      $('input[placeholder="Search products"]').on('keyup', function () {
        applyFilters();
      });

      $('#typeFilter').on('change', function () {
        applyFilters();
      });

      // Helper functions
      function initializeTagSystem(inputSelector, containerSelector, hiddenInputSelector) {
        $(inputSelector).on('keypress', function (e) {
          if (e.which === 13 || e.which === 44) {
            e.preventDefault();
            addTag($(this).val().trim(), containerSelector, hiddenInputSelector);
            $(this).val('');
          }
        });

        $(inputSelector).on('blur', function () {
          if ($(this).val().trim() !== '') {
            addTag($(this).val().trim(), containerSelector, hiddenInputSelector);
            $(this).val('');
          }
        });

        $(document).on('click', containerSelector + ' .remove-tag', function () {
          $(this).parent().remove();
          updateHiddenTags(containerSelector, hiddenInputSelector);
        });
      }

      function addTag(tagText, containerSelector, hiddenInputSelector) {
        if (tagText === '') return;

        let exists = false;
        $(containerSelector + ' .tag-item').each(function () {
          if ($(this).text().replace('✕', '').trim() === tagText) {
            exists = true;
            return false;
          }
        });

        if (!exists) {
          const $tag = $(`
            <span class="badge bg-primary tag-item me-1 mb-1">
              ${tagText}
              <span class="remove-tag ms-1" style="cursor:pointer;">✕</span>
            </span>
          `);
          $(containerSelector).append($tag);
          updateHiddenTags(containerSelector, hiddenInputSelector);
        }
      }

      function updateHiddenTags(containerSelector, hiddenInputSelector) {
        let tags = [];
        $(containerSelector + ' .tag-item').each(function () {
          tags.push($(this).text().replace('✕', '').trim());
        });
        $(hiddenInputSelector).val(tags.join(','));
      }

      function previewImage(file, previewSelector, size) {
        const preview = $(previewSelector);
        preview.empty();
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            Object.assign(img.style, {
              height: size + 'px',
              width: size + 'px',
              objectFit: 'cover',
              border: '1px solid #ccc',
              borderRadius: '4px'
            });
            preview.append(img);
          };
          reader.readAsDataURL(file);
        }
      }

      function previewMultipleImages(files, previewSelector, size) {
        const previewContainer = $(previewSelector);
        previewContainer.empty();
        Array.from(files).forEach(file => {
          const reader = new FileReader();
          reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            Object.assign(img.style, {
              height: size + 'px',
              width: size + 'px',
              objectFit: 'cover',
              border: '1px solid #ccc',
              borderRadius: '4px',
              marginRight: '5px'
            });
            previewContainer.append(img);
          };
          reader.readAsDataURL(file);
        });
      }

      function submitForm(url, form, successMessage) {
        var formData = new FormData(form[0]);
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (res) {
            let response = JSON.parse(res);
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire('Error!', response.message || 'Operation failed.', 'error');
            }
          },
          error: function () {
            Swal.fire('Error!', 'Something went wrong.', 'error');
          }
        });
      }

      function loadGalleryImages(productId) {
        $.ajax({
          url: '<?= base_url("AdminController/getProductImages") ?>',
          type: 'POST',
          data: {
            product_id: productId
          },
          dataType: 'json',
          success: function (images) {
            const $container = $('#currentGalleryImages');
            $container.empty();

            if (images.length > 0) {
              images.forEach(image => {
                $container.append(`
                  <div class="position-relative d-inline-block m-1">
                    <img src="<?= base_url() ?>${image.image_path}" 
                         class="img-thumbnail" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                    <button type="button" 
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1 remove-image-btn"
                            data-image-id="${image.id}">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                `);
              });
            } else {
              $container.append('<p class="text-muted">No gallery images</p>');
            }
          },
          error: function () {
            $('#currentGalleryImages').html('<p class="text-danger">Failed to load images</p>');
          }
        });
      }
      function populateEditForm(product) {
        $('#editProductId').val(product.id);
        $('#editProductName').val(product.product_name);
        $('#editProductCode').val(product.product_code);
        $('#editDescription').val(product.description);
        $('#editCurrentImage').attr('src', '<?= base_url("") ?>' + product.image);
        $('#editSeoTitle').val(product.seo_title);
        $('#editSeoDescription').val(product.seo_description);
        $('#editSize').val(product.size);
        $('#editLength').val(product.length);
        $('#editHeight').val(product.height);
        $('#editWidth').val(product.width);
        $('#editMakingCharges').val(product.making_charges);
        $('#editGst').val(product.gst);
        $('#editDiscountPercentage').val(product.discount_percentage);
        $('#editOtherCharges').val(product.other_charges);
        $('#editTotalPrice').val(product.total_price);

        // Parse weight and carat JSON
        const weightData = product.weight ? JSON.parse(product.weight) : {};
        const selectedTypes = product.type || [];
        const caratData = product.carat ? JSON.parse(product.carat) : {};

        const $container = $('#editDynamicPriceInputs');
        $container.html('');

        selectedTypes.forEach(type => {
          const suffix = type.toLowerCase();
          const weightValue = weightData[type] || '';
          const caratValue = caratData[type] || '';

          $container.append(`
      <div class="card-custom mb-3 p-3 border">
        <h6><strong>${type} Weight</strong></h6>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Weight</label>
            <input type="number" class="form-control edit-weight" name="weight_${suffix}" id="edit_weight_${suffix}" value="${weightValue}" placeholder="Enter Weight">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Carat</label>
            <input type="number" class="form-control" name="carat_${suffix}" id="edit_carat_${suffix}" value="${caratValue}">
          </div>
        </div>
      </div>
    `);
        });

        // Checkbox state for types
        $('.edit-type-checkbox').each(function () {
          const val = $(this).val();
          $(this).prop('checked', selectedTypes.includes(val));
        });

        // Handle tags
        const tags = product.tags ? product.tags.split(',') : [];
        $('#editTagBox').html('');
        $('#editTags').val(product.tags || '');
        tags.forEach(tag => {
          if (tag.trim() !== '') {
            $('#editTagBox').append(`
        <span class="badge bg-primary tag-item me-1 mb-1">
          ${tag.trim()} 
          <span class="remove-tag ms-1" style="cursor:pointer;">✕</span>
        </span>
      `);
          }
        });

        // Display categories
        const categories = product.categories ? JSON.parse(product.categories) : [];
        $('#editCategoryBox').html('');
        categories.forEach(cat => {
          $('#editCategoryBox').append(`
      <span class="badge bg-success me-2 mb-1">${cat}</span>
    `);
        });

        // Display subcategories
        const subcategories = product.subcategories ? JSON.parse(product.subcategories) : [];
        $('#editSubcategoryBox').html('');
        subcategories.forEach(sub => {
          $('#editSubcategoryBox').append(`
      <span class="badge bg-info me-2 mb-1">${sub}</span>
    `);
        });

        // Rebind calculator
        $('.edit-weight').on('input', calculateEditTotal);
      }


      function applyFilters() {
        const productCode = $('input[placeholder="Search products"]').val(); // rename variable for clarity
        const typeFilter = $('#typeFilter').val();
        const categoryFilter = $('#categoryFilter').val();

        $.ajax({
          url: '<?= base_url("AdminController/filterProducts") ?>',
          type: 'POST',
          data: {
            product_code: productCode, // renamed key to match PHP
            type: typeFilter,
            category: categoryFilter
          },
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              updateProductTable(response.products);
            }
          },
          error: function () {
            Swal.fire('Error!', 'Failed to filter products.', 'error');
          }
        });
      }

      // Add event listener for category filter
      $('#categoryFilter').on('change', function () {
        applyFilters();
      });

      function updateProductTable(products) {
        const $tbody = $('tbody');
        $tbody.empty();

        if (products.length === 0) {
          $tbody.append('<tr><td colspan="10" class="text-center">No products found</td></tr>');
          return;
        }

        products.forEach(function (product, index) {
          const $row = $(`
            <tr>
              <td>${product.product_code}</td>
              <td><img src="<?= base_url() ?>${product.image}" width="50" height="50" style="object-fit: cover; border-radius: 8px;"></td>
              <td>${product.product_name}</td>
                            <td>calculating</td>

              <td>${Array.isArray(product.categories) ? product.categories.join(', ') : product.categories}</td>
<td>${(() => {
              try {
                const carats = typeof product.carat === 'string' ? JSON.parse(product.carat) : product.carat;
                return Object.entries(carats)
                  .map(([type, carat]) => `${type}: ${carat}`)
                  .join(', ');
              } catch (e) {
                return 'N/A';
              }
            })()
            }</td>
              <td>${product.discount_percentage}</td>
<td>${(() => {
              try {
                const weights = typeof product.weight === 'string' ? JSON.parse(product.weight) : product.weight;
                return Object.entries(weights)
                  .map(([type, weight]) => `${type}: ${weight}g`)
                  .join(', ');
              } catch (e) {
                return 'N/A';
              }
            })()
            }</td>
                            <td>${product.making_charges}</td>

                            <td>${product.gst}</td>

              <td>${Array.isArray(product.type) ? product.type.join(', ') : product.type}</td>
              <td>${product.tags}</td>
              <td>
                <button class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="${product.id}">
                  <i class="fa-regular fa-pen-to-square fs-5"></i>
                </button>
                <button class="delete-btn ms-2" data-id="${product.id}" style="border:none;background:none;">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </td>
            </tr>
          `);
          $tbody.append($row);
        });
      }
    });
  </script>

  <script>
    $(document).ready(function () {
      const rowsPerPage = 10;
      const rows = $("table tbody tr");
      const totalRows = rows.length;
      const totalPages = Math.ceil(totalRows / rowsPerPage);
      const pagination = $("#pagination");

      function showPage(page) {
        rows.hide();
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.slice(start, end).show();

        pagination.find("li").removeClass("active");
        pagination.find(`li.page-number[data-page="${page}"]`).addClass("active");

        $("#prevPage").toggleClass("disabled", page === 1);
        $("#nextPage").toggleClass("disabled", page === totalPages);
      }

      function buildPagination() {
        let paginationHtml = `
        <li class="page-item disabled" id="prevPage">
          <a class="page-link" href="#" aria-label="Previous">&laquo;</a>
        </li>
      `;

        for (let i = 1; i <= totalPages; i++) {
          paginationHtml += `
          <li class="page-item page-number${i === 1 ? ' active' : ''}" data-page="${i}">
            <a class="page-link" href="#">${i}</a>
          </li>`;
        }

        paginationHtml += `
        <li class="page-item${totalPages === 1 ? ' disabled' : ''}" id="nextPage">
          <a class="page-link" href="#" aria-label="Next">&raquo;</a>
        </li>
      `;

        pagination.html(paginationHtml);
      }

      buildPagination();
      showPage(1);

      pagination.on("click", "li.page-number", function () {
        const page = parseInt($(this).data("page"));
        showPage(page);
      });

      pagination.on("click", "#prevPage", function () {
        const currentPage = parseInt(pagination.find("li.active").data("page"));
        if (currentPage > 1) showPage(currentPage - 1);
      });

      pagination.on("click", "#nextPage", function () {
        const currentPage = parseInt(pagination.find("li.active").data("page"));
        if (currentPage < totalPages) showPage(currentPage + 1);
      });
    });
  </script>



</body>

</html>