<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f9f7fb;
            margin: 0;
        }

        .filter-section {
            background: #fff;
            color: #6f42c1;
            padding: 1.3rem 1.5rem 1.1rem 1.5rem;
            border-radius: 1.2rem;
            margin-bottom: 28px;
            box-shadow: 0 2px 16px rgba(156, 96, 221, 0.09);
        }

        .filter-label {
            font-weight: 500;
            color: #b53fc2;
            font-size: 1rem;
            letter-spacing: 1px;
            /* margin-bottom: 0.8rem; */
        }

        .styled-select {
            border: 2px solid #b53fc2;
            border-radius: 2rem;
            padding: 0.3rem 1rem 0.3rem 1rem;
            background: linear-gradient(90deg, #eecdf2 0%, #f7eefa 100%);
            color: #6f42c1;
            font-weight: 600;
            font-size: 1.05rem;
            transition: border-color .2s, box-shadow .2s;
            margin-right: 0.8rem;
        }

        .styled-select:focus {
            border-color: #6f42c1;
            box-shadow: 0 2px 8px rgba(156, 96, 221, 0.13);
        }

        .filter-icons {
            font-size: 1.45rem;
            color: #b53fc2;
            background: #f7eefa;
            border-radius: 50%;
            padding: 0.35rem 0.6rem;
            margin-left: 0.4rem;
            margin-top: -2px;
            transition: background 0.2s, color 0.2s;
        }

        .filter-icons:hover {
            background: #b53fc2;
            color: #fff;
        }

        .coin-card {
            border: none;
            border-radius: 1rem;
            background: #fff;
            box-shadow: 0 2px 10px rgba(156, 96, 221, .08);
            transition: box-shadow 0.3s, transform 0.3s;
            overflow: hidden;
            min-height: 320px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 0;
            margin-bottom: 0.5rem;
            padding-top: 0.5rem;
        }

        .coin-card:hover {
            box-shadow: 0 8px 30px rgba(111, 66, 193, 0.17);
            transform: translateY(-6px) scale(1.03);
            z-index: 2;
        }

        .coin-img {
            width: 100%;
            height: 150px;
            object-fit: contain;
            margin-top: 18px;
            transition: transform 0.3s;
        }

        .coin-card:hover .coin-img {
            transform: scale(1.11);
        }

        .discount-banner {
            background: linear-gradient(90deg, #EECDF2 0%, #C9A7F6 100%);
            color: #7c37a6;
            font-weight: 600;
            font-size: 0.97rem;
            border-radius: .7rem .7rem 0 0;
            padding: 0.4rem 0;
            text-align: center;
            box-shadow: 0 2px 6px rgba(156, 96, 221, 0.10);
            border-bottom: 2px solid #b53fc2;
            letter-spacing: 1px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            opacity: 0;
            transform: translateY(-100%);
            transition: all 0.3s cubic-bezier(.4, 2, .6, 1);
            z-index: 1;
        }

        .coin-card:hover .discount-banner {
            opacity: 1;
            transform: translateY(0);
        }

        .card-details {
            padding: 1.3rem 1.1rem 1.2rem 1.1rem;
            background: transparent;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            z-index: 2;
        }

        .coin-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.06rem;
            color: #6f42c1;
            font-weight: 600;
            margin-bottom: .1rem;
        }

        .coin-price {
            color: #b53fc2;
            font-weight: 700;
            font-size: 1.09rem;
            margin-bottom: .3rem;
        }

        .add-to-cart-btn {
            width: 100%;
            background: linear-gradient(90deg, #eecdf2 0%, #b53fc2 100%);
            color: #fff;
            border: none;
            border-radius: 0.7rem;
            font-weight: 600;
            margin-top: .4rem;
            margin-bottom: .2rem;
            box-shadow: 0 2px 6px rgba(156, 96, 221, 0.09);
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.33s cubic-bezier(.4, 2, .6, 1);
            font-size: 1rem;
            letter-spacing: .5px;
        }

        .coin-card:hover .add-to-cart-btn {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive for 4-in-row grid */
        @media (min-width: 1200px) {
            .col-xl-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (max-width: 1199.98px) {
            .col-lg-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (max-width: 991.98px) {
            .col-md-4 {
                flex: 0 0 33.3333%;
                max-width: 33.3333%;
            }
        }

        @media (max-width: 767.98px) {
            .col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 575.98px) {
            .col-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>


    <style>
        .dropdown-menu .dropdown-item:hover {
            color: #000 !important;
            /* Make font color black on hover */
            background-color: #f0e9ff;
            /* Optional: subtle light purple background */
        }
    </style>

</head>

<body class="bg-light">
    <?php $this->load->view('common/navbar'); ?>
    <div class="container my-4">

        <!-- Breadcrumb -->
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('UserController/home'); ?>">HOME</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="<?php echo base_url('UserController/collections'); ?>">COLLECTIONS</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo isset($actual_category) ? strtoupper(str_replace('-', ' ', $actual_category)) : 'PRODUCTS'; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Filter and Sort -->
        <div class="row mb-3 align-items-center">
            <div class="col-auto ps-0">
                <button class="btn btn-outline-secondary shadow-sm rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#filterModal">
                    <i class="bi bi-funnel"></i> Filter By
                </button>
            </div>
            <div class="col-auto ms-auto">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle rounded-pill shadow-sm" type="button"
                        id="sortDropdown" data-bs-toggle="dropdown">
                        SORT BY
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li class="dropdown-item" data-sort="low-to-high">Price: Low to High</li>
                        <li class="dropdown-item" data-sort="high-to-low">Price: High to Low</li>
                    </ul>

                </div>
            </div>
        </div>
        <!-- Filter Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="filterModalLabel">Filter By</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="d-flex flex-wrap gap-4">
                            <!-- Category Section -->
                            <div class="flex-grow-1" style="min-width: 300px;">
                                <h6>Category</h6>
                                <div class="row">
                                    <?php
                                    $count = 0;

                                    foreach ($FilterCategory as $cat) {
                                        // Sanitize ID (replace spaces and special characters)
                                        $safeId = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($cat->name));

                                        // Start a new column for every 6 items
                                        if ($count % 6 == 0) {
                                            if ($count != 0)
                                                echo '</div>'; // close previous column
                                            echo '<div class="col-md-6">'; // open new column
                                        }
                                        ?>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="<?= $safeId ?>"
                                                value="<?= $cat->name ?>">
                                            <label class="form-check-label" for="<?= $safeId ?>"><?= $cat->name ?></label>
                                        </div>
                                        <?php
                                        $count++;
                                    }

                                    // Close the last column
                                    echo '</div>';
                                    ?>
                                </div>


                            </div>

                            <!-- Material Section -->
                            <div style="min-width: 300px; max-width: 300px; flex-shrink: 1;">
                                <h6>Material</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gold" value="gold">
                                    <label class="form-check-label" for="gold">Gold</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="silver" value="silver">
                                    <label class="form-check-label" for="silver">Silver</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="platinum" value="platinum">
                                    <label class="form-check-label" for="platinum">Platinum</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="diamond" value="diamond">
                                    <label class="form-check-label" for="diamond">Diamond</label>
                                </div>
                            </div>

                            <!-- Price Section -->
                            <div style="min-width: 300px; max-width: 300px; flex-shrink: 1;">
                                <h6>Price</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="under10k" value="0-10000">
                                    <label class="form-check-label" for="under10k">Under ₹10k</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="10kto20k" value="10000-20000">
                                    <label class="form-check-label" for="10kto20k">₹10k to ₹20k</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="20kto30k" value="20000-30000">
                                    <label class="form-check-label" for="20kto30k">₹20k to ₹30k</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="30kto50k" value="30000-75000">
                                    <label class="form-check-label" for="30kto50k">₹30k to ₹75k</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="75kabove"
                                        value="75000-100000000">
                                    <label class="form-check-label" for="75kabove">₹75k & above</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill"
                            data-bs-dismiss="modal">Clear</button>
                        <button type="button" class="btn btn-outline-secondary shadow-sm rounded-pill custom-apply-btn"
                            id="applyFiltersBtn">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="coinCardContainer">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <?php
                    $weightData = json_decode($product->weight, true);
                    $caratData = json_decode($product->carat, true);
                    $typeArray = json_decode($product->type, true);

                    if (empty($weightData) || !is_array($weightData)) {
                        return;
                    }

                    $total_material_price = 0;
                    $total_weight_gram = 0;

                    foreach ($weightData as $material => $weight_gram) {
                        $weight_gram = floatval($weight_gram);
                        $total_weight_gram += $weight_gram;

                        $material_lower = strtolower($material);
                        $carat = isset($caratData[$material]) ? trim(strtolower($caratData[$material])) : '';

                        $price_per_gram = 0;

                        if ($material_lower === 'gold' && isset($rates['gold'][$carat])) {
                            $price_per_gram = $rates['gold'][$carat];
                        } elseif ($material_lower === 'silver' && isset($rates['silver'][$carat])) {
                            $price_per_gram = $rates['silver'][$carat];
                        } elseif ($material_lower === 'platinum' && isset($rates['platinum'][$carat])) {
                            $price_per_gram = $rates['platinum'][$carat];
                        } elseif ($material_lower === 'diamond' && isset($rates['diamond'][$carat])) {
                            $price_per_gram = $rates['diamond'][$carat];
                        }

                        $material_price = $weight_gram * $price_per_gram;
                        $total_material_price += $material_price;
                    }

                    // Charges and taxes
                    $making_charges = (float) $product->making_charges;
                    $other_charges = isset($product->other_charges) ? (float) $product->other_charges : 0;
                    $discount = (float) $product->discount_percentage;
                    $gst = (float) $product->gst;

                    // Apply discount on making charges
                    $discounted_making = $making_charges - ($making_charges * $discount / 100);
                    $discount_amount = $making_charges * $discount / 100;

                    // Subtotal before GST, include other_charges only if > 0
                    $subtotal = $total_material_price + $discounted_making;
                    if ($other_charges > 0) {
                        $subtotal += $other_charges;
                    }

                    // GST calculation
                    $gst_amount = $subtotal * $gst / 100;

                    // Final total
                    $total_price = $subtotal + $gst_amount;

                    // Optional UI elements
                    $firstMaterial = array_key_first($weightData);
                    $firstWeightGram = number_format($weightData[$firstMaterial], 2) . "g";
                    $firstCarat = isset($caratData[$firstMaterial]) ? $caratData[$firstMaterial] : 'N/A';
                    ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 coin-card-wrapper"
                        data-price="<?= number_format($total_price, 2, '.', '') ?>">
                        <div class="coin-card w-100">
                            <div class="discount-banner">
                                Flat <?= !empty($product->discount_percentage) ? $product->discount_percentage : 0 ?>% Discount
                            </div>
                            <img src="<?= base_url($product->image) ?>" alt="<?= htmlspecialchars($product->product_name) ?>"
                                class="coin-img pt-4">
                            <div class="card-details">
                                <div class="coin-title">
                                    <?= htmlspecialchars($product->product_name) ?>
                                </div>
                                <div class="coin-title">
                                    <?= number_format($total_weight_gram, 2) ?> gram
                                </div>
                                <div class="coin-price">Rs. <?= number_format($total_price, 2) ?></div>
                                <a href="<?= base_url('UserController/productcart/' . $product->id) ?>"
                                    class="btn add-to-cart-btn">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Results Message -->
                <div id="noResultsMessage" class="text-center w-100 py-5">
                    <div class="alert alert-warning d-inline-block mx-auto shadow-sm" role="alert"
                        style="max-width: 400px;">
                        <h5 class="mb-2"><i class="bi bi-exclamation-circle-fill me-2 text-warning"></i>No matching products
                            found</h5>
                        <p class="mb-0">Try changing the filter options or check back later.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination items will be dynamically added here -->
                </ul>
            </nav>
        </div>



    </div>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <script>
        document.getElementById('applyFiltersBtn').addEventListener('click', function () {
            const selectedCategories = [];
            const selectedMaterials = [];
            let priceLows = [];
            let priceHighs = [];
            let is75kSelected = false;

            const sections = document.querySelectorAll('#filterModal .modal-body .flex-grow-1, #filterModal .modal-body [style*="min-width: 300px"]');

            sections.forEach(function (section) {
                const heading = section.querySelector('h6')?.innerText?.toLowerCase().trim();

                if (heading === 'category') {
                    section.querySelectorAll('input[type="checkbox"]:checked').forEach(function (el) {
                        selectedCategories.push(el.value);
                    });
                } else if (heading === 'material') {
                    section.querySelectorAll('input[type="checkbox"]:checked').forEach(function (el) {
                        selectedMaterials.push(el.value);
                    });
                } else if (heading === 'price') {
                    section.querySelectorAll('input[type="checkbox"]:checked').forEach(function (el) {
                        const range = el.value.split("-");
                        const low = parseInt(range[0]);
                        const high = parseInt(range[1]);

                        if (el.id === "75kabove") {
                            is75kSelected = true;
                        }

                        if (!isNaN(low)) priceLows.push(low);
                        if (!isNaN(high) && high !== 100000000) priceHighs.push(high);
                    });
                }
            });

            const params = new URLSearchParams();

            if (selectedMaterials.length > 0) {
                params.append('type', selectedMaterials.join(','));
            }
            if (selectedCategories.length > 0) {
                params.append('category', selectedCategories.join(','));
            }

            if (is75kSelected && priceLows.length === 1) {
                params.append('lowest', 75000);
            } else if (is75kSelected && priceLows.length > 1) {
                const lowest = Math.min(...priceLows);
                params.append('lowest', lowest);
            } else if (priceLows.length > 0 && priceHighs.length > 0) {
                const lowest = Math.min(...priceLows);
                const highest = Math.max(...priceHighs);
                params.append('lowest', lowest);
                params.append('highest', highest);
            }

            const baseUrl = "<?= base_url('products') ?>";
            const fullUrl = `${baseUrl}?${params.toString()}`;
            window.location.href = fullUrl;
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cardsPerPage = 20;
            const container = document.getElementById("coinCardContainer");
            const paginationContainer = document.getElementById("pagination");
            const dropdownItems = document.querySelectorAll(".dropdown-menu .dropdown-item");

            let allCards = Array.from(container.querySelectorAll(".coin-card-wrapper"));
            let currentPage = 1;
            let totalPages = Math.ceil(allCards.length / cardsPerPage);

            shuffleCards(allCards);
            renderCards(allCards);

            // ✅ Only attach sorting logic to specific items
            dropdownItems.forEach(item => {
                const text = item.textContent.trim();
                if (["Price: Low to High", "Price: High to Low", "Random"].includes(text)) {
                    item.addEventListener("click", function (e) {
                        e.preventDefault();

                        if (text === "Price: Low to High") {
                            allCards.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
                        } else if (text === "Price: High to Low") {
                            allCards.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
                        } else {
                            shuffleCards(allCards);
                        }

                        renderCards(allCards);
                    });
                }
            });

            function shuffleCards(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }

            function renderCards(cardsToRender) {
                container.innerHTML = "";
                cardsToRender.forEach(card => container.appendChild(card));
                totalPages = Math.ceil(cardsToRender.length / cardsPerPage);

                if (totalPages <= 1) {
                    paginationContainer.style.display = "none";
                    cardsToRender.forEach(card => card.style.display = "block");
                } else {
                    paginationContainer.style.display = "flex";
                    showPage(1);
                }
            }

            function showPage(page) {
                currentPage = page;
                allCards.forEach((card, index) => {
                    card.style.display = (index >= (page - 1) * cardsPerPage && index < page * cardsPerPage) ? "block" : "none";
                });

                renderPagination();
            }

            function renderPagination() {
                paginationContainer.innerHTML = "";

                const prevLi = createPageItem("Previous", currentPage === 1, () => {
                    if (currentPage > 1) showPage(currentPage - 1);
                });
                paginationContainer.appendChild(prevLi);

                for (let i = 1; i <= totalPages; i++) {
                    const li = createPageItem(i, false, () => showPage(i), i === currentPage);
                    paginationContainer.appendChild(li);
                }

                const nextLi = createPageItem("Next", currentPage === totalPages, () => {
                    if (currentPage < totalPages) showPage(currentPage + 1);
                });
                paginationContainer.appendChild(nextLi);
            }

            function createPageItem(label, disabled, onClick, active = false) {
                const li = document.createElement("li");
                li.className = "page-item" + (disabled ? " disabled" : "") + (active ? " active" : "");

                const a = document.createElement("a");
                a.className = "page-link";
                a.href = "#";
                a.textContent = label;
                a.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (!disabled) onClick();
                });

                li.appendChild(a);
                return li;
            }
        });
    </script>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>