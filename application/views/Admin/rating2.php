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

        <div class="container-fluid px-3 mt-4">
          <div class="row">
            <div class="col-6   col-sm-2 ">
              <div class="my-2">
                <select id="reviewStatus" class="form-select">
                  <option value="all">All</option>
                  <option value="Pending">Pending</option>
                  <option value="Approved">Approved</option>
                  <option value="Rejected">Rejected</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="container table-responsive-sm px-3 my-4">

          <table class="table text-center table-sm-borderless align-middle">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Message</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($reviews)) {
                $i = 1;
                foreach ($reviews as $review) { ?>
                  <tr data-status="<?= strtolower($review->status) ?>">
                    <td><?= $i++ ?></td>
                    <td><?= $review->name ?></td>
                    <td><?= $review->email ?></td>

                    <td class="fs-4">
                      <p class="icons">
                        <?php
                        $rating = $review->rating;
                        echo str_repeat("★ ", $rating);
                        echo str_repeat("☆ ", 5 - $rating);
                        ?>
                      </p>
                    </td>
                    <td><?= $review->message ?></td>
                    <td>
                      <?php if (strtolower($review->status) == 'pending') { ?>
                        <i class="fa-solid fa-square-check add-btn fs-4 text-success" data-id="<?= $review->id ?>"
                          style="cursor:pointer;"></i>
                        <i class="fa-solid fa-square-xmark remove-btn fs-4 text-danger" data-id="<?= $review->id ?>"
                          style="cursor:pointer;"></i>
                      <?php } elseif (strtolower($review->status) == 'approved') { ?>
                        <i class="fa-solid fa-circle-check text-success fs-5"></i>
                      <?php } elseif (strtolower($review->status) == 'rejected') { ?>
                        <i class="fa-solid fa-circle-xmark text-danger fs-5"></i>
                      <?php } ?>
                    </td>


                  </tr>
                  <?php
                }
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

  <div class="popup-overlay popup-overlay-remove" style="display:none;">
    <div class="popup-box">
      <div class="popup-icon"><i class="fas fa-exclamation"></i></div>
      <div class="popup-message">Are you sure?</div>
      <div class="popup-sub">Do you want to remove this review on the user side?</div>
      <div class="popup-buttons d-flex justify-content-center gap-3">
        <button class="btn gradient-button btn-yes">Yes</button>
        <button class="btn gradient-button btn-cancel">Cancel</button>
      </div>
    </div>
  </div>

  <!-- Add Confirmation Popup -->
  <div class="popup-overlay popup-overlay-add" style="display:none;">
    <div class="popup-box">
      <div class="popup-icon"><i class="fas fa-exclamation"></i></div>
      <div class="popup-message">Are you sure?</div>
      <div class="popup-sub">Do you want to add this review on the user side?</div>
      <div class="popup-buttons d-flex justify-content-center gap-3">
        <button class="btn gradient-button btn-yes">Yes</button>
        <button class="btn gradient-button btn-cancel">Cancel</button>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>

  <script>
    let selectedReviewId = null;

    // Remove popup logic
    document.querySelectorAll(".remove-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        selectedReviewId = btn.getAttribute("data-id");
        document.querySelector(".popup-overlay-remove").style.display = "flex";
      });
    });

    document.querySelector(".popup-overlay-remove .btn-cancel").addEventListener("click", () => {
      document.querySelector(".popup-overlay-remove").style.display = "none";
    });

    // Add popup logic
    document.querySelectorAll(".add-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        selectedReviewId = btn.getAttribute("data-id");
        document.querySelector(".popup-overlay-add").style.display = "flex";
      });
    });

    document.querySelector(".popup-overlay-add .btn-cancel").addEventListener("click", () => {
      document.querySelector(".popup-overlay-add").style.display = "none";
    });

    // AJAX call for approving
    document.querySelector(".popup-overlay-add .btn-yes").addEventListener("click", () => {
      if (selectedReviewId) {
        updateReviewStatus(selectedReviewId, 'approved');
      }
      document.querySelector(".popup-overlay-add").style.display = "none";
    });

    // AJAX call for rejecting
    document.querySelector(".popup-overlay-remove .btn-yes").addEventListener("click", () => {
      if (selectedReviewId) {
        updateReviewStatus(selectedReviewId, 'rejected');
      }
      document.querySelector(".popup-overlay-remove").style.display = "none";
    });

    function updateReviewStatus(id, status) {
      fetch("<?= site_url('AdminController/updateReviewStatus') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${id}&status=${status}`
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: data.message,
              timer: 2000,
              showConfirmButton: false
            });

            // Update the row UI without reloading
            const row = document.querySelector(`.add-btn[data-id="${id}"]`)?.closest('tr') ||
              document.querySelector(`.remove-btn[data-id="${id}"]`)?.closest('tr');

            if (row) {
              row.setAttribute("data-status", status); // Update data-status attribute for filter

              let actionCell = row.querySelector("td:last-child");
              if (status === 'approved') {
                actionCell.innerHTML = `<i class="fa-solid fa-circle-check text-success fs-5"></i>`;
              } else if (status === 'rejected') {
                actionCell.innerHTML = `<i class="fa-solid fa-circle-xmark text-danger fs-5"></i>`;
              }
            }

          } else {
            Swal.fire("Error", data.message, "error");
          }
        })
        .catch(error => {
          Swal.fire("Error", "Something went wrong!", "error");
          console.error("Error:", error);
        });
    }

  </script>


  <script>
    const rowsPerPage = 10;
    const table = document.querySelector("table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const pagination = document.getElementById("pagination");
    const statusFilter = document.getElementById("reviewStatus");

    let currentPage = 1;

    function getFilteredRows() {
      const selectedStatus = statusFilter.value.toLowerCase();
      return rows.filter(row => {
        const status = row.getAttribute("data-status")?.toLowerCase();
        return selectedStatus === "all" || status === selectedStatus;
      });
    }

    function showPage(page) {
      const filteredRows = getFilteredRows();
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      rows.forEach(row => row.style.display = "none");

      const visibleRows = filteredRows.slice(start, end);
      visibleRows.forEach((row, index) => {
        row.style.display = "";

        const srNoCell = row.querySelector("td:first-child");
        if (srNoCell) {
          if (statusFilter.value.toLowerCase() !== "all") {
            srNoCell.textContent = index + 1;
          } else {
            srNoCell.textContent = start + index + 1;
          }
        }
      });

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

      // Page numbers
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

    // Initial load
    showPage(currentPage);

    // Filter listener
    statusFilter.addEventListener("change", () => {
      currentPage = 1;
      showPage(currentPage);
    });
  </script>



</body>

</html>