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
        <!-- Search Bar -->
        <div class="container m-2 d-flex justify-content-start align-items-center p-2 pt-4">
          <form class="d-flex p-2 w-50" role="search">
            <input type="text" id="searchInput" class="form-control rounded-start-5 p-2 rounded-end-0 border-end-0"
              placeholder="Search Here" aria-label="Search user">
            <span class="input-group-text bg-white rounded-end-5 rounded-start-0 border-start-0">
              <i class="fa-solid text-dark fa-magnifying-glass"></i>
            </span>
          </form>
        </div>
        <!-- Table Section -->
        <div class="container-sm-fluid  table-responsive-sm px-3 ">
          <table id="ordersTable" class="table text-center table-sm rounded align-middle mt-2">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Amount/Month</th>
                <th>Scheme Type</th>
                <th>Category</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($schemes as $index => $scheme): ?>
                <tr>
                  <<td><?php echo $index + 1; ?></td>
                    <td><?php echo ucwords($scheme->name); ?></td>
                    <td><?php echo $scheme->mobile; ?></td>
                    <td><?php echo strtolower($scheme->email); ?></td>
                    <td><?php echo $scheme->amount; ?></td>
                    <td><?php echo ucfirst($scheme->type); ?></td>
                    <td><?php echo ucfirst($scheme->category); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($scheme->created_at)); ?></td>
                </tr>
              <?php endforeach; ?>
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
  <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>
  <!-- Scripts for Pagination and Search -->
  <script>
    const rowsPerPage = 10;
    const table = document.getElementById("ordersTable");
    const tbody = table.querySelector("tbody");
    let rows = Array.from(tbody.querySelectorAll("tr"));
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

      const prev = document.createElement("li");
      prev.className = "page-item" + (activePage === 1 ? " disabled" : "");
      prev.innerHTML = `<a class="page-link" href="#">&laquo; </a>`;
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

      const next = document.createElement("li");
      next.className = "page-item" + (activePage === totalPages ? " disabled" : "");
      next.innerHTML = `<a class="page-link" href="#"> &raquo;</a>`;
      next.onclick = e => {
        e.preventDefault();
        if (currentPage < totalPages) {
          currentPage++;
          showPage(currentPage);
        }
      };
      pagination.appendChild(next);
    }

    // Search Function
    function performSearch() {
      const searchInput = document.getElementById("searchInput");
      const filter = searchInput.value.toUpperCase();
      const allRows = tbody.querySelectorAll("tr");

      rows = [];

      allRows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let matchFound = false;

        for (let cell of cells) {
          if (cell.textContent.toUpperCase().includes(filter)) {
            matchFound = true;
            break;
          }
        }

        if (matchFound) {
          row.style.display = "";
          rows.push(row); // include only matched rows
        } else {
          row.style.display = "none";
        }
      });

      currentPage = 1;
      showPage(currentPage);
    }

    // Initialize
    document.getElementById("searchInput").addEventListener("keyup", performSearch);
    showPage(currentPage);
  </script>
</body>

</html>