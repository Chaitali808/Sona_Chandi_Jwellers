<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Coins</title>
    <?php $this->load->view('common/Commonlinks'); ?>
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
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <!-- <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('User/home'); ?>">HOME</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('User/goldcoins'); ?>">COLLECTIONS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">GOLD COINS</li>
                    </ol>
                </nav>
            </div>
        </div> -->
    <!-- Filter Section -->
    <div class="filter-section mb-4">
        <div class="row align-items-center">
            <div class="col-12 d-flex flex-wrap align-items-center">
                <div class="filter-label me-3">Filter By</div>
                <select class="styled-select me-2" id="typeFilter" aria-label="Type">
                    <option value="All" selected>All Types</option>
                    <option value="Gold">Gold</option>
                    <option value="Silver">Silver</option>
                </select>
                <select class="styled-select me-2" id="weightFilter" aria-label="Weight">
                    <option value="All" selected>All Weights</option>
                    <option value="0.5">0.5gm</option>
                    <option value="1">1gm</option>
                    <option value="2">2gm</option>
                    <option value="5">5gm</option>
                    <option value="10">10gm</option>
                    <option value="20">20gm</option>
                    <option value="50">50gm</option>
                </select>
                <select class="styled-select" id="caratFilter" aria-label="Carat">
                    <option value="All" selected>All Carats</option>
                    <option value="24">24</option>
                    <option value="22">22</option>
                    <option value="18">18</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container">
        <div class="row" id="coinCardContainer">
            <?php if (!empty($goldCoinProducts)): ?>
                <?php foreach ($goldCoinProducts as $product): ?>
                    <?php
                    $weightData = json_decode($product->weight, true);
                    $caratData = json_decode($product->carat, true);
                    $typeArray = json_decode($product->type, true);
                    $rates = $rates ?? [];

                    if (empty($weightData) || !is_array($weightData))
                        continue;

                    $total_material_price = 0;
                    $total_weight_gram = 0;

                    foreach ($weightData as $material => $weight_gram) {
                        $weight_gram = floatval($weight_gram);
                        $total_weight_gram += $weight_gram;

                        $material_lower = strtolower($material);
                        $carat = isset($caratData[$material]) ? $caratData[$material] : 0;

                        $price_per_gram = 0;
                        if ($material_lower === 'gold') {
                            // FIXED: Remove 'k' suffix because your rate keys are just numbers like '24', '22'
                            $carat_key = (string) $carat;
                            $price_per_gram = $rates['gold'][$carat_key] ?? 0;
                        } elseif (in_array($material_lower, ['silver', 'platinum'])) {
                            $carat_key = (string) $carat;
                            $price_per_gram = $rates[$material_lower][$carat_key] ?? 0;
                        } elseif ($material_lower === 'diamond') {
                            $clarity_key = strtolower(trim($carat)); // e.g., 'fl', 'vvs1'
                            $price_per_gram = $rates['diamond'][$clarity_key] ?? 0;
                        } else {
                            $price_per_gram = 0;
                        }

                        $material_price = $weight_gram * $price_per_gram;
                        $total_material_price += $material_price;
                    }

                    // Get additional fields
                    $making_charges = (float) $product->making_charges;
                    $discount = (float) $product->discount_percentage;
                    $gst = (float) $product->gst;
                    $other_charges = isset($product->other_charges) ? (float) $product->other_charges : 0.0;

                    // Calculate total with discount and GST
                    $discounted_making = $making_charges - ($making_charges * $discount / 100);
                    $subtotal = $total_material_price + $discounted_making;

                    // Include other charges only if greater than 0
                    if ($other_charges > 0) {
                        $subtotal += $other_charges;
                    }

                    $gst_amount = $subtotal * $gst / 100;
                    $total_price = $subtotal + $gst_amount;

                    // Additional info for display (optional)
                    $firstMaterial = array_key_first($weightData);
                    $firstWeightGramRaw = floatval($weightData[$firstMaterial]);
                    $firstWeightGram = number_format($firstWeightGramRaw, 1);
                    $firstCarat = isset($caratData[$firstMaterial]) ? $caratData[$firstMaterial] : 'N/A';
                    ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 coin-card-wrapper"
                        data-type="<?= htmlspecialchars($firstMaterial) ?>" data-weight="<?= (int) $total_weight_gram ?>
" data-carat="<?= $firstCarat ?>">
                        <div class="coin-card w-100">
                            <div class="discount-banner">
                                Flat <?= !empty($product->discount_percentage) ? $product->discount_percentage : 0 ?>% Discount
                            </div>
                            <img src="<?= base_url($product->image) ?>" alt="<?= htmlspecialchars($product->product_name) ?>"
                                class="coin-img pt-4">
                            <div class="card-details">
                                <div class="coin-title"><?= htmlspecialchars($product->product_name) ?></div>
                                <div class="coin-title"><?= number_format($total_weight_gram, 2) ?> gram</div>
                                <div class="coin-price">Rs. <?= number_format($total_price, 2) ?></div>
                                <a href="<?= base_url('UserController/productcart/' . $product->id) ?>"
                                    class="btn add-to-cart-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div id="noResultsMessage" class="text-center w-100 py-5">
                    <div class="alert alert-warning d-inline-block mx-auto shadow-sm" role="alert"
                        style="max-width: 400px;">
                        <h5 class="mb-2"><i class="bi bi-exclamation-circle-fill me-2 text-warning"></i>No matching products
                            found</h5>
                        <p class="mb-0">Try changing the filter options or check back later.</p>
                    </div>
                </div>
            <?php endif; ?>

            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('typeFilter');
            const weightSelect = document.getElementById('weightFilter');
            const caratSelect = document.getElementById('caratFilter');
            const allCards = document.querySelectorAll('.coin-card-wrapper');
            const paginationContainer = document.getElementById('pagination');
            const noResultsMessage = document.getElementById('noResultsMessage');

            let currentPage = 1;
            const cardsPerPage = 20;

            function filterCards() {
                const selectedType = typeSelect.value;
                const selectedWeight = weightSelect.value.replace('g', '');
                const selectedCarat = caratSelect.value;

                const filteredCards = Array.from(allCards).filter(card => {
                    const cardType = card.getAttribute('data-type');
                    const cardWeight = card.getAttribute('data-weight');
                    const cardCarat = card.getAttribute('data-carat');

                    const typeMatch = selectedType === "All" || cardType.toLowerCase() === selectedType.toLowerCase();
                    const weightMatch = selectedWeight === "All" || cardWeight === selectedWeight;
                    const caratMatch = selectedCarat === "All" || cardCarat === selectedCarat;

                    return typeMatch && weightMatch && caratMatch;
                });

                renderPagination(filteredCards);
                showPage(filteredCards, currentPage);
            }

            function renderPagination(cards) {
                paginationContainer.innerHTML = '';
                const totalPages = Math.ceil(cards.length / cardsPerPage);
                if (totalPages <= 1) return;

                const createPageItem = (label, disabled, onClick) => {
                    const li = document.createElement('li');
                    li.className = `page-item ${disabled ? 'disabled' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#">${label}</a>`;
                    if (!disabled) li.addEventListener('click', e => {
                        e.preventDefault();
                        onClick();
                    });
                    return li;
                };

                paginationContainer.appendChild(createPageItem('Previous', currentPage === 1, () => {
                    currentPage--;
                    showPage(cards, currentPage);
                    renderPagination(cards);
                }));

                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                    li.addEventListener('click', function (e) {
                        e.preventDefault();
                        currentPage = i;
                        showPage(cards, currentPage);
                        renderPagination(cards);
                    });
                    paginationContainer.appendChild(li);
                }

                paginationContainer.appendChild(createPageItem('Next', currentPage === totalPages, () => {
                    currentPage++;
                    showPage(cards, currentPage);
                    renderPagination(cards);
                }));
            }

            function showPage(cards, page) {
                allCards.forEach(card => card.style.display = 'none');

                const start = (page - 1) * cardsPerPage;
                const end = start + cardsPerPage;

                const visibleCards = cards.slice(start, end);
                visibleCards.forEach(card => card.style.display = 'flex');

                noResultsMessage.style.display = cards.length === 0 ? 'block' : 'none';
            }

            typeSelect.addEventListener('change', () => { currentPage = 1; filterCards(); });
            weightSelect.addEventListener('change', () => { currentPage = 1; filterCards(); });
            caratSelect.addEventListener('change', () => { currentPage = 1; filterCards(); });

            // Initialize
            filterCards();
        });
    </script>

    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/chatbot'); ?>
    <!-- SweetAlert2 -->



</body>

</html>