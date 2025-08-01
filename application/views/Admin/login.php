<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .main {
      height: 100vh;
      width: 100%;
      background-image: url('<?php echo base_url("assets/Admin/banner.png"); ?>');
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;



      display: flex;
      align-items: center;
      justify-content: center;


    }







    .content-box {
      height: 350px;
      width: 600px;
      background: rgba(47, 22, 28, 0.75);
      box-shadow: 0 8px 32px 0 rgb(53, 45, 45);
      border: 1px solid #D9D9D9 !important;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
    }



    .glass-card {

      display: flex;
      justify-content: space-evenly;


      height: 70%;
      width: 70%;
      flex-direction: column;
      text-align: center;
    }

    .glass-card form {


      display: flex;
      justify-content: center;
      flex-direction: column;

    }

    .glass-card h3 {
      font-weight: bold;
      margin-bottom: 30px;
    }

    .form-control {

      background: rgba(217, 217, 217, 0.33);
      border: 1px solid rgb(217, 217, 217) !important;


      width: 80%;
      height: 90%;
      box-shadow: 0 5px 7px 0 rgb(53, 45, 45);
    }

    ::placeholder {
      color: white !important;

    }

    .button-63 {
      background: #391721;


      box-shadow: 0 8px 15px rgba(46, 139, 87, 0.3);
      color: #ffffff;
      font-weight: bold;
      padding: 10px;
      cursor: pointer;
      transition: all 0.3s ease;

      width: 80%;
      height: 90%;

    }




    .mb-3 {

      display: flex;
      justify-content: center;

    }
  </style>
  <style>
    .form-control {
      background-color: transparent !important;
      color: #fff;
      /* Optional: White text for dark backgrounds */
      border: 1px solid #ccc;
    }

    .form-control:focus {
      background-color: transparent !important;
      box-shadow: none;
      /* Removes blue glow */
      border-color: #999;
      /* Optional: subtle border on focus */
      color: #fff;
    }

    .input-group-text {
      background-color: transparent !important;
      border: none;
    }
  </style>

</head>

<body>
  <section class="main">
    <div class="content-box mx-2">
      <div class="glass-card">
        <form action="<?= base_url('AdminController/login') ?>" method="post">

          <!-- Email Field -->
          <div class="mb-3 w-100">
            <input type="email" class="form-control w-100" placeholder="Email" name="email" id="emailInput" required
              style="height: 45px;">
          </div>

          <!-- Password Field with Eye Toggle Inside Input -->
          <div class="mb-3 w-100">
            <div class="input-group w-100"
              style="height: 45px; border: 1px solid #ccc; border-radius: 5px; overflow: hidden;">
              <input type="password" class="form-control" placeholder="Password" name="password" id="passwordInput"
                required style="height: 100%; border: none; background: transparent; color: white;">
              <span class="input-group-text bg-transparent" style="height: 100%; border: none;">
                <i class="fa fa-eye-slash toggle-password" id="togglePassword"
                  style="cursor: pointer; color: #999;"></i>
              </span>
            </div>
          </div>


          <!-- Error Flash Message -->
          <?php if ($this->session->flashdata('error')): ?>
            <div class="text-danger mt-2 mb-3"><?= $this->session->flashdata('error') ?></div>
          <?php endif; ?>

          <!-- Submit Button -->
          <div class="mb-3 w-100">
            <button type="submit" class="button-63 border rounded-2 w-100" style="height: 45px;">Sign In</button>
          </div>

          <!-- Forgot Password Link -->
          <!-- <div class="register-link d-block text-start">
          <a href="#" class="ms-4 text-white">Forget Password</a>
        </div> -->

        </form>
      </div>
    </div>
  </section>


  <!-- Add JS for toggling password visibility -->
  <script>
    const toggle = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    toggle.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggle.classList.toggle('fa-eye');
      toggle.classList.toggle('fa-eye-slash');
    });
  </script>


</body>

</html>