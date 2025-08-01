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
        :root {
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --text-light: #ffffff;

            --btn-primary-bg: #0d6efd;
            --btn-primary-hover: #0b5ed7;
            --btn-secondary-bg: #6c757d;
            --btn-secondary-hover: #5c636a;

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
            height: 60px;
        }



        tbody td {
            border: none;
            padding: 1rem;
        }

        tbody td {
            border: none;
            padding: 1rem;
        }



        .table-condensed {
            font-size: 0.875rem;

        }

        .table-condensed th,
        .table-condensed td {
            padding: 0.3rem;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(6px);
            background-color: rgba(255, 255, 255, 0.2);
            z-index: 999;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            width: 350px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .popup-icon {
            width: 60px;
            height: 60px;
            background-color: #d9b3ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icons {

            color: rgba(229, 188, 24, 0.94);

        }

        .popup-icon i {
            font-size: 28px;
            color: #7c00b3;
        }

        .popup-message {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .popup-sub {
            font-size: 14px;
            margin-bottom: 20px;
            color: #444;
        }

        .popup-buttons .btn {
            min-width: 100px;
            border-radius: 20px;
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
        }

        .gradient-button:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }

        /* Scrollable table wrapper */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }

        /* Optional: nice scroll style */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        /* Responsive tweaks */
        @media (max-width: 991.98px) {

            .table th,
            .table td {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            .popup-box {
                width: 90%;
                padding: 20px;
            }

            .popup-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .popup-buttons .btn {
                width: 100%;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {

            .table th,
            .table td {
                padding: 0.5rem;
                font-size: 0.8rem;
                white-space: nowrap;
            }

            .popup-box {
                width: 95%;
                padding: 16px;
            }

            .popup-message {
                font-size: 14px;
            }

            .popup-sub {
                font-size: 12px;
            }
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


                <div class="container table-responsive-sm px-3 my-4">
                    <table class="table text-center table-sm-borderless align-middle" id="reviewTable">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Name</th>
                                <th>Feedback</th>
                                <th>Image</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reviews)) {
                                $i = 1;
                                foreach ($reviews as $review) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $review->productcode ?></td>
                                        <td><?= $review->productname ?></td>
                                        <td><?= $review->name ?></td>
                                        <td><?= $review->review ?></td>
                                        <td>
                                            <?php if (!empty($review->image)): ?>
                                                <img src="<?= base_url($review->image) ?>" alt="Review Image"
                                                    style="width: 80px; height: auto;">
                                            <?php endif; ?>
                                        </td>
                                        <td class="fs-4">
                                            <p class="icons">
                                                <?php
                                                $rating = $review->rating;
                                                echo str_repeat("★ ", $rating);
                                                echo str_repeat("☆ ", 5 - $rating);
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-3">
                        <ul class="pagination justify-content-center" id="pagination"></ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>


    <script>
        const rowsPerPage = 10;
        const table = document.getElementById("reviewTable");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const pagination = document.getElementById("pagination");

        let currentPage = 1;

        function showPage(page) {
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            if (page < 1) page = 1;
            if (page > pageCount) page = pageCount;

            currentPage = page;

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, i) => {
                row.style.display = i >= start && i < end ? "" : "none";
            });

            renderPagination();
        }

        function renderPagination() {
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            pagination.innerHTML = "";

            // Previous button
            const prevLi = document.createElement("li");
            prevLi.className = "page-item" + (currentPage === 1 ? " disabled" : "");
            const prevA = document.createElement("a");
            prevA.className = "page-link";
            prevA.href = "#";
            prevA.innerHTML = "&laquo;";
            prevA.addEventListener("click", function (e) {
                e.preventDefault();
                if (currentPage > 1) showPage(currentPage - 1);
            });
            prevLi.appendChild(prevA);
            pagination.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement("li");
                li.className = "page-item" + (i === currentPage ? " active" : "");
                const a = document.createElement("a");
                a.className = "page-link";
                a.href = "#";
                a.textContent = i;
                a.addEventListener("click", function (e) {
                    e.preventDefault();
                    showPage(i);
                });
                li.appendChild(a);
                pagination.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement("li");
            nextLi.className = "page-item" + (currentPage === pageCount ? " disabled" : "");
            const nextA = document.createElement("a");
            nextA.className = "page-link";
            nextA.href = "#";
            nextA.innerHTML = "&raquo;";
            nextA.addEventListener("click", function (e) {
                e.preventDefault();
                if (currentPage < pageCount) showPage(currentPage + 1);
            });
            nextLi.appendChild(nextA);
            pagination.appendChild(nextLi);
        }

        // Initial page load
        showPage(1);
    </script>




</body>

</html>