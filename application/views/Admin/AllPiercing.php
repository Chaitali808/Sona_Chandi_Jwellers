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
            background: rgba(0, 0, 0, 0.4);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }

        .popup-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
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
                background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);

                padding: 10px 20px;
                font-size: 14px;
                margin: 10px auto;
                width: 100%;
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

                <div class="container  m-2  d-flex justify-content-start  align-items-center p-2 pt-4">
                    <form class="d-flex p-2  w-50" role="search">
                        <input type="text" id="searchInput"
                            class="form-control rounded-start-5 p-2 rounded-end-0 border-end-0 "
                            placeholder="Search Here" aria-label="Search user">
                        <span class="input-group-text bg-white rounded-end-5 rounded-start-0 border-start-0">
                            <i class="fa-solid text-dark fa-magnifying-glass"></i>
                        </span>
                    </form>
                </div>
                <div class="container-sm-fluid  table-responsive-sm px-3 ">
                    <table id="ordersTable" class="table text-center table-sm table-borderless rounded align-middle">
                        <thead class="align-middle">
                            <tr>
                                <th>Sr.</th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Age Group</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($piercings)) {
                                $i = 1;
                                $statusOptions = ['Pending', 'Repair', 'Cleaning', 'Received', 'Inspection', 'Karigar', 'Working', 'Delivery'];
                                foreach ($piercings as $piercing) {
                                    $currentStatusIndex = array_search(ucfirst($piercing->status), $statusOptions);
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= ucfirst($piercing->full_name); ?></td>
                                        <td><?= ucfirst($piercing->mobile); ?></td>
                                        <td><?= ucfirst($piercing->ageGroup); ?></td>
                                        <td><?= ucfirst($piercing->type); ?></td>
                                        <td><?= ucfirst($piercing->subType); ?></td>
                                        <td><?= date('d-m-Y', strtotime($piercing->preferedDate)); ?></td>
                                        <td><?= ucfirst($piercing->preferedTime); ?></td>
                                        <td><?= ucfirst($piercing->location); ?></td>
                                        <td>
                                            <select class="form-control status-dropdown" data-id="<?= $piercing->id ?>">
                                                <?php foreach ($statusOptions as $index => $status) { ?>
                                                    <option value="<?= $status ?>" <?= ($status == ucfirst($piercing->status)) ? 'selected' : '' ?>
                                                    <?= ($index < $currentStatusIndex) ? 'disabled' : '' ?>>
                                                        <?= $status ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <i class="fa-solid fa-trash del-btn" data-id="<?= $piercing->id ?>"
                                                style="cursor:pointer;"></i>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>

                        </tbody>

                    </table>
                    <nav aria-label="Page navigation" class="mt-3">
                        <ul class="pagination justify-content-center" id="pagination"></ul>
                    </nav>
                </div>



            </div>
        </div>
    </div>

    <div class="popup-overlay popup-overlay-del" style="display:none;">
        <div class="popup-box text-center p-4 bg-white rounded shadow">
            <div class="popup-icon mb-2"><i class="fas fa-exclamation fa-2x " style="color:#915cd1;"></i></div>
            <div class="popup-message fw-bold">Are you sure?</div>
            <div class="popup-sub text-muted mb-3">Do you want to delete the Appointment?</div>
            <div class="popup-buttons d-flex justify-content-center gap-3">
                <button class="btn gradient-button text-white btn-yes">Yes</button>
                <button class="btn gradient-button text-white btn-cancel-del">Cancel</button>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>

    <script>
        document.querySelectorAll('.status-dropdown').forEach(function (dropdown) {
            dropdown.addEventListener('change', function () {
                const selectedStatus = this.value;
                const piercingId = this.getAttribute('data-id');

                Swal.fire({
                    title: "Are you sure?",
                    text: `Do you want to update the status to "${selectedStatus}"?`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("<?= base_url('AdminController/updatePiercingStatus') ?>", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `id=${piercingId}&status=${selectedStatus}`
                        })
                            .then(res => res.json())
                            .then(data => {
                                Swal.fire({
                                    icon: data.status,
                                    title: data.message,
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            })
                            .catch(() => {
                                Swal.fire("Error", "Something went wrong!", "error");
                            });
                    }
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

    let currentPage = 1;

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        updatePaginationButtons(rows.length, page);
    }

    function updatePaginationButtons(totalRows, activePage) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        pagination.innerHTML = "";

        // Previous button with icon only
        const prev = document.createElement("li");
        prev.className = "page-item" + (activePage === 1 ? " disabled" : "");
        prev.innerHTML = `<a class="page-link" href="#" ><span aria-hidden="true">&laquo;</span></a>`;
        prev.onclick = e => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        };
        pagination.appendChild(prev);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.className = "page-item" + (i === activePage ? " active" : "");
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.onclick = e => {
                e.preventDefault();
                currentPage = i;
                showPage(currentPage);
            };
            pagination.appendChild(li);
        }

        // Next button with icon only
        const next = document.createElement("li");
        next.className = "page-item" + (activePage === totalPages ? " disabled" : "");
        next.innerHTML = `<a class="page-link" href="#" ><span aria-hidden="true">&raquo;</span></a>`;
        next.onclick = e => {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        };
        pagination.appendChild(next);
    }

    // Initial call
    showPage(currentPage);
</script>


    <script>
        function performSearch() {
            const searchInput = document.getElementById("searchInput");
            const filter = searchInput.value.toUpperCase();
            const rows = tbody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let found = false;

                for (let j = 0; j < cells.length && !found; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const textValue = cell.textContent || cell.innerText;
                        if (textValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                        }
                    }
                }

                rows[i].style.display = found ? "" : "none";
            }
        }

        document.getElementById("searchInput").addEventListener("keyup", performSearch);

    </script>

    <script>
        let selectedCustomerId = null;

        document.querySelectorAll(".del-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                selectedCustomerId = btn.getAttribute("data-id");
                document.querySelector(".popup-overlay-del").style.display = "flex";
            });
        });

        document.querySelector(".btn-cancel-del").addEventListener("click", () => {
            document.querySelector(".popup-overlay-del").style.display = "none";
        });

        document.querySelector(".btn-yes").addEventListener("click", () => {
            if (selectedCustomerId) {
                fetch("<?= site_url('AdminController/deletAppointmentById') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + selectedCustomerId
                })
                    .then(response => {
                        if (!response.ok) throw new Error("Network response was not ok");
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: data.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error in fetch:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong. Please try again."
                        });
                    });
            }
        });
    </script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>