<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
<style>
  </style>
  </head>
  <body>


  <div class="container-fluid p-0" style=" background:#FAFAF9">
<div class="row g-0">
  <!-- sidebar   -->
      <?php include 'sidebar.php';?>

      <div class="col-lg-9 col-xl-10 col-12  shadow offset-xl-2 offset-lg-3  ">
<!-- navbar -->
<?php include 'navbar.php';?>


</div>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url("assets/js/sidebar.js"); ?>"></script>


</body>
</html>