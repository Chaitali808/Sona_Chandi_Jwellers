<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <style>
    .profile {
      text-align: center;
      width: 100%;
      margin-bottom: 30px;
    }

    .profile img {
      width: 100px;
      height: 100px;

      border-radius: 50%;
      object-fit: cover;
      background-color: #ffffff;
    }

    .nav-item a {
      color: white !important;

    }




    #sidebar {



      position: fixed;
      top: 0;
      left: 0;
      height: auto;
      transition: transform .25s ease-in-out;
      z-index: 10;
      background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);

      overflow-Y: auto;
    }








    #sidebar::-webkit-scrollbar {
      width: 6px;
    }

    #sidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      /* light transparent track */
    }

    #sidebar::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.4);
      /* white-ish thumb */
      border-radius: 10px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
      background-color: rgba(255, 255, 255, 0.6);
    }

    /* For Firefox */
    #sidebar {
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, 0.2) transparent;


    }




    .nav-item .link {


      color: white;
      font-size: 20px;



    }

    .nav {
      border: none;

    }

    .nav-item .link:hover {
      border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      background-color: white;

      color: #9a55ff !important;
      text-shadow: 4px 0px 6px rgba(0, 0, 0, 0.32);

    }

    #productMenu a {}

    .collapse a:hover {
      color: #9a55ff !important;
      background: white;

    }

    .btn1 {

      background: linear-gradient(to right, #da8cff, #9a55ff);
      color: white;

    }





    @media (max-width: 768px) {

      #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: auto;
        width: 200px;
        overflow-Y: auto;
        transition: transform .25s ease-in-out;
        z-index: 1050;
        background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
        overflow-Y: auto;
      }

    }
  </style>
</head>

<body>

  <aside class="d-flex bg-purple h-100 col-xl-2 col-md-3 d-lg-block   d-none flex-column  " id="sidebar">
    <div class="d-flex d-lg-none justify-content-end mr-0 p-2 b">
      <button class="btn p-2" id="sidebarToggle" style="background: transparent; border: none;">
        <i class="fa-solid fa-xmark fs-4  text-white	 px-2 py-1  " onclick="hideSidebar()"></i>

      </button>
    </div>
    <div class="profile p-2 mb-4">
      <img src="<?php echo base_url("assets/Admin/logo.png"); ?>" class="rounded-circle" alt="Profile">
    </div>
    <ul class="nav flex-column    ">
      <li class="nav-item   fs-6">
        <a href="<?php echo base_url('Dashboard'); ?>" class="nav-link link  ">
          <i class="fas rounded-circle   p-2 fs-4 fa-chart-line me-1"></i> Dashboard
        </a>
      </li>
      <li class="nav-item fs-6">
        <a data-bs-toggle="collapse" href="#productMenu" class="nav-link link" role="button" aria-expanded="false"
          aria-controls="productMenu">
          <i class="fas fa-box rounded-circle p-2 fs-4 me-1"></i> Product
        </a>

        <div class="collapse  ms-4" id="productMenu" data-bs-parent="#sidebarMenu">
          <ul class="nav flex-column py-2">

            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/product'); ?>" class="nav-link rounded-pill m-1 text-white">
                <i class="fas fa-cogs me-2"></i> Manage Product
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/ManageCategories'); ?>"
                class="nav-link rounded-pill m-1 text-white">
                <i class="fas fa-cogs me-2"></i> Manage Category
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/ManageAstrogames'); ?>"
                class="nav-link rounded-pill m-1 text-white">
                <i class="fas fa-cogs me-2"></i> Manage Astrogames
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item   fs-6">
        <a href="<?php echo site_url('AdminController/orders'); ?>" class="nav-link link  ">
          <i class="fas rounded-circle   p-2 fs-4 fa-cart-shopping me-1"></i> Order
        </a>
      </li>
      <li class="nav-item fs-6">
        <a data-bs-toggle="collapse" href="#reviewMenu" class="nav-link link" role="button" aria-expanded="false"
          aria-controls="reviewMenu">
          <i class="fas rounded-circle   p-2 fs-4 fa-comment-dots me-1"></i> Reviews
        </a>

        <div class="collapse  ms-4" id="reviewMenu" data-bs-parent="#sidebarMenu">
          <ul class="nav flex-column py-2">

            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/rating'); ?>" class="nav-link rounded-pill m-1 text-white">
                <i class="fas fa-cogs me-2"></i> Shop Reviews
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Productrating'); ?>"
                class="nav-link rounded-pill m-1 text-white">
                <i class="fas fa-cogs me-2"></i> Product Reviews
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item   fs-6">
        <a href="<?php echo site_url('AdminController/cust'); ?>" class="nav-link  link ">
          <i class="fas rounded-circle   p-2 fs-4 fa-user-group me-1"></i> Customers
        </a>
      <li class="nav-item   fs-6">
        <a href="<?php echo site_url('AdminController/feedback'); ?>" class="nav-link  link ">
          <i class="fa-solid  p-2 fs-4 me-1 fa-comments"></i> Feedback
        </a>
      </li>


      <li class="nav-item ">
        <!-- Toggle for Plan Submenu -->
        <a data-bs-toggle="collapse" href="#planMenu" class="nav-link link text-white" role="button"
          aria-expanded="false" aria-controls="planMenu">
          <i class="fa-solid rounded-circle   p-2 fs-4  fa-money-check-dollar me-2"></i> Plan
        </a>

        <!-- Collapsible Plan Submenu -->
        <div class="collapse ms-4" id="planMenu" data-bs-parent="#sidebarMenu">
          <ul class="nav flex-column py-2">
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Scheme10_2'); ?>"
                class="nav-link rounded-pill m-1 text-white ">
                <i class="fa-solid fa-coins me-2"></i> 10+2
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Scheme11_1'); ?>"
                class="nav-link rounded-pill m-1 text-white ">
                <i class="fa-solid fa-gem me-2"></i> 11+1
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Scheme12_0'); ?>"
                class="nav-link rounded-pill m-1 text-white ">
                <i class="fa-solid fa-coins me-2"></i> 12+0
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <!-- Toggle for Plan Submenu -->
        <a data-bs-toggle="collapse" href="#appointment" class="nav-link link text-white" role="button"
          aria-expanded="false" aria-controls="appointment">
          <i class="fa-solid fa-user-clock   p-2 fs-4  fa-money-check-dollar me-2"></i> Appointment
        </a>

        <!-- Collapsible Plan Submenu -->
        <div class="collapse ms-4" id="appointment" data-bs-parent="#sidebarMenu">
          <ul class="nav flex-column py-2">
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Piercing'); ?>"
                class="nav-link rounded-pill m-1 text-white ">
                <i class="fa-solid fa-gem me-2"></i> Piercing
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('AdminController/Repairing'); ?>"
                class="nav-link rounded-pill m-1 text-white ">
                <i class="fa-solid fa-coins me-2"></i> Reparing
              </a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item   fs-6">
        <a href="<?php echo site_url('AdminController/Astrologer'); ?>" class="nav-link  link ">
          <i class="fa-solid  p-2 fs-4 me-1 fa-user-astronaut"></i> Astrologer
        </a>
      </li>
      <li class="nav-item log-out justify-self-end fs-6">
        <a href="<?php echo site_url('AdminController/logout'); ?>" class="nav-link link" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="fas rounded-circle p-2 fs-4 fa-right-from-bracket me-1"></i> Logout
        </a>
      </li>




    </ul>

  </aside>




  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">

        <div class="modal-body">
          <div class="popup-icon mb-3">
            <i class="fas fa-sign-out-alt fa-2x" style="color: #915cd1;"></i>
          </div>
          <h5 class="fw-bold mb-2" id="logoutModalLabel">Log Out?</h5>
          <p class="text-muted mb-4">Are you sure you want to logout from your account?</p>

          <div class="d-flex justify-content-center gap-3">
            <a href="<?php echo site_url('AdminController/logout'); ?>" class="btn btn1 text-white ">Yes, Logout</a>
            <button type="button" class="btn btn1 text-white" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>
  </div>




  </script>
</body>

</html>