<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Load jQuery first -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Then Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Then other libraries -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Correct CSS path -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
  <style>
    :root {
      --otp-primary: #5e358e;
      --otp-dark: #4a148c;
      --otp-text-light: #f8f9fa;
    }

    .otp-modal-content {
      border-radius: 1rem;
      overflow: hidden;
      border: none;
      background: none;
    }

    .otp-popup-container {
      display: flex;
      flex-direction: row;
      border-radius: 1rem;
      background-color: #fff;
    }

    .btn-outline-lavender {
      color: #5e358e;
      /* lavender tone */
      border-color: #5e358e;
      background-color: transparent;
    }

    .btn-outline-lavender:hover,
    .btn-outline-lavender:focus {
      background-color: #5e358e;
      color: #fff;
      border-color: #5e358e;
    }

    .otp-left {
      background: url('<?php echo base_url("assets/Admin/pearl.png"); ?>') center center/cover no-repeat;
      padding: 2rem;
      flex: 1;
      position: relative;
      color: #fff;
      border-radius: 1rem 0 0 1rem;
    }

    .otp-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      border-radius: 1rem 0 0 1rem;
      z-index: 1;
    }

    .otp-left * {
      position: relative;
      z-index: 2;
    }

    .otp-right {
      padding: 2rem;
      flex: 1;
      background-color: #f8f9fa;
      border-radius: 0 1rem 1rem 0;
    }

    .otp-title {
      font-weight: bold;
      margin-bottom: 0.5rem;
      color: var(--otp-dark);
    }

    .otp-btn {
      background-color: #5e358e;
      color: var(--otp-text-light);
      border: none;
      padding: 10px 0;
      border-radius: 30px;
      font-weight: bold;
      width: 100%;
    }

    .otp-btn:hover {
      background-color: var(--otp-primary);
    }

    .otp-footer {
      font-size: 0.8rem;
      color: #6c757d;
      margin-top: 0.5rem;
    }

    .otp-footer a {
      color: var(--otp-dark);
      text-decoration: underline;
      cursor: pointer;
    }

    .input-group,
    .form-control,
    .input-group-text {
      border-radius: 0.5rem;
    }

    @media (max-width: 768px) {
      .otp-popup-container {
        flex-direction: column;
      }

      .otp-left {
        border-radius: 1rem 1rem 0 0;
      }

      .otp-right {
        border-radius: 0 0 1rem 1rem;
      }
    }

    /* Z-index and navbar protection */
    .modal {
      z-index: 1055;
    }

    .modal-backdrop {
      z-index: 1050;
    }

    .navbar,
    .dropdown-menu {
      position: relative;
      z-index: 1100 !important;
    }

    body.modal-open {
      padding-right: 0 !important;
    }

    /* Update your existing styles */
    .modal {
      z-index: 1105;
      /* Higher than navbar */
    }

    .modal-backdrop {
      z-index: 1100;
      /* Higher than navbar but lower than modal */
    }

    .navbar,
    .dropdown-menu {
      position: relative;
      z-index: 1099 !important;
      /* Slightly lower than backdrop */
    }

    /* Fix SweetAlert2 z-index so it appears above Bootstrap modal */
    .swal2-container {
      z-index: 1150 !important;
    }

    .btn-close {
      background-color: #fff;
      border-radius: 50%;
      opacity: 1;
    }
  </style>
</head>

<body>
  <!-- OTP Modal -->
  <div class="modal fade mt-5" id="otpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content otp-modal-content">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
          aria-label="Close"></button>

        <div class="otp-popup-container">
          <div class="otp-left text-center"></div>
          <div class="otp-right">
            <h5 class="otp-title">Welcome to SonaChandi</h5>
            <p class="text-muted small mb-3">Enter Email to receive OTP</p>

            <form id="otpLoginForm">
              <div class="mb-3">
                <label>Email ID</label>
                <input type="email" class="form-control" name="email" id="email" required />
              </div>

              <div class="mb-3" id="otp-section" style="display:none;">
                <label>Enter OTP</label>
                <input type="text" class="form-control" id="otp" required />
              </div>
              <div id="otp-timer" class="text-muted small mb-2" style="display: none;">Resend available in <span
                  id="loginCountdown">60</span>s</div>
              <button type="button" id="resendOtpBtn" class="btn btn-outline-lavender w-100 mb-4"
                style="display: none;">Resend OTP</button>

              <div id="otp-loader" class="text small mb-2" style="display:none;">Sending OTP...</div>

              <button type="button" id="requestOtpBtn" class="btn btn-outline-lavender w-100 mb-2">Request OTP</button>
              <button type="submit" id="verifyOtpBtn" class="btn btn-success w-100" style="display:none;">Verify
                OTP</button>
            </form>

            <p class="otp-footer mt-3">
              By continuing, you agree to our <a>Terms</a> & <a>Privacy</a>
            </p>
            <div class="text-center mt-2">
              <span class="text-muted small">Don't have an account?</span>
              <a href="javascript:void(0);" id="showRegistrationBtn"
                class="btn btn-outline-lavender btn-sm ms-2">Register</a>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Registration Modal -->
  <div class="modal fade mt-5" id="registrationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Changed to modal-lg for wider width -->
      <div class="modal-content otp-modal-content">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
          aria-label="Close"></button>

        <div class="otp-popup-container">
          <div class="otp-left text-center"></div>
          <div class="otp-right">
            <h4 class="otp-title mb-2 text-center">Register</h4>

            <form id="registrationForm">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-1">
                    <label>Name</label>
                    <input type="text" class="form-control" id="reg_name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-1">
                    <label>Email</label>
                    <input type="email" class="form-control" id="reg_email" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-1">
                    <label>Contact</label>
                    <input type="text" class="form-control" id="reg_contact" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-1">
                    <label>DOB</label>
                    <input type="date" class="form-control" id="reg_dob" required>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label>Address</label>
                <textarea class="form-control" id="reg_address" required></textarea>
              </div>

              <div class="mb-3" id="reg_otp_section" style="display: none;">
                <label>Enter OTP</label>
                <input type="text" class="form-control" id="reg_otp" required>
              </div>
              <div id="reg-otp-timer" class="text-muted small mb-2" style="display: none;">Resend available in <span
                  id="regCountdown">60</span>s</div>
              <button type="button" id="regResendOtpBtn" class="btn btn-outline-lavender w-100 mb-3"
                style="display: none;">Resend OTP</button>

              <div id="reg-otp-loader" class="text small mb-2" style="display:none;">Sending OTP...</div>

              <div class="d-flex gap-2">
                <button type="button" id="regRequestOtpBtn" class="btn btn-outline-lavender flex-grow-1">Request
                  OTP</button>
                <button type="submit" id="regVerifyOtpBtn" class="btn btn-outline-lavender flex-grow-1"
                  style="display:none;">Register</button>
              </div>

              <div class="text-center mt-3">
                <span class="text-muted small">Already have an account?</span>
                <button type="button" id="showLoginBtn" class="btn btn-outline-lavender btn-sm ms-2">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $('#reg_email').on('blur', function () {
      const email = $(this).val().trim();

      if (email !== '') {
        $.ajax({
          url: '<?= base_url("UserController/checkEmailUnique") ?>',
          method: 'POST',
          data: {
            email: email
          },
          dataType: 'json',
          success: function (response) {
            if (!response.unique) {
              Swal.fire({
                icon: 'error',
                title: 'Email Already Registered',
                text: 'Please go to login.',
                timer: 2000,
                showConfirmButton: false
              });

              $('#reg_email').val('').focus();
            }
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Server Error',
              text: 'Please try again later.',
              timer: 2000,
              showConfirmButton: false
            });
          }
        });
      }
    });

    function startCountdown(seconds, displaySelector, callback) {
      let counter = seconds;
      $(displaySelector).text(counter);
      const interval = setInterval(() => {
        counter--;
        $(displaySelector).text(counter);
        if (counter <= 0) {
          clearInterval(interval);
          callback();
        }
      }, 1000);
    }

    $(document).ready(function () {
      // Initialize modals with proper accessibility
      const otpModal = new bootstrap.Modal(document.getElementById('otpModal'), {
        keyboard: false,
        focus: true
      });

      const registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'), {
        keyboard: false,
        focus: true
      });

      // Show login modal if user not logged in
      <?php if (!$this->session->userdata('user_email')): ?>
        otpModal.show();
      <?php endif; ?>

      // ========== LOGIN OTP HANDLING ==========
      $('#requestOtpBtn').click(function () {
        const email = $('#email').val().trim();

        if (!validateEmail(email)) {
          Swal.fire("Error", "Please enter a valid email address", "error");

          return;
        }

        $(this).prop('disabled', true);
        $('#otp-loader').show();

        $.ajax({
          url: '<?= base_url("UserController/send_otp") ?>',
          method: 'POST',
          data: {
            email: email
          },
          dataType: 'json',
          success: function (response) {
            $('#otp-loader').hide();
            if (response.status === "success") {
              $('#otp-section').show();
              $('#verifyOtpBtn').show();
              $('#requestOtpBtn').hide();
              $('#resendOtpBtn').hide();
              $('#otp-timer').show();
              startCountdown(60, '#loginCountdown', function () {
                $('#otp-timer').hide();
                $('#resendOtpBtn').show();
              });
              $('#otp').focus();
              $('#resendOtpBtn').click(function () {
                $('#requestOtpBtn').click(); // Trigger resend
                $(this).hide();
              });

              Swal.fire({
                title: "Success",
                text: "OTP sent to your email",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
              });
            } else {
              $('#requestOtpBtn').prop('disabled', false);
              Swal.fire("Error", response.message || "Failed to send OTP", "error");
            }
          },
          error: function () {
            $('#otp-loader').hide();
            $('#requestOtpBtn').prop('disabled', false);
            Swal.fire("Error", "Failed to send OTP. Please try again.", "error");
          }
        });
      });

      $('#otpLoginForm').submit(function (e) {
        e.preventDefault();

        const email = $('#email').val().trim();
        const otp = $('#otp').val().trim();

        if (!otp || otp.length !== 6) {
          Swal.fire("Error", "Please enter a valid 6-digit OTP", "error");
          return;
        }

        $('#verifyOtpBtn').prop('disabled', true)
          .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...');

        $.ajax({
          url: '<?= base_url("UserController/verify_otp") ?>',
          method: 'POST',
          data: {
            email: email,
            otp: otp
          },
          dataType: 'json',
          success: function (response) {
            $('#verifyOtpBtn').prop('disabled', false)
              .html('Verify OTP');

            if (response.status === "success") {
              Swal.fire({
                title: "Success",
                text: "Login successful!",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                otpModal.hide();
                window.location.href = response.redirect_url;
              });
            } else {
              Swal.fire("Error", response.message || "Invalid OTP", "error");
            }
          },
          error: function () {
            $('#verifyOtpBtn').prop('disabled', false)
              .html('Verify OTP');
            Swal.fire("Error", "Failed to verify OTP", "error");
          }
        });

      });

      // ========== REGISTRATION OTP HANDLING ==========
      $('#regRequestOtpBtn').click(function () {
        const email = $('#reg_email').val().trim();
        const contact = $('#reg_contact').val().trim();

        if (!validateEmail(email)) {
          Swal.fire("Error", "Please enter a valid email address", "error");
          return;
        }

        if (!contact || contact.length < 10) {
          Swal.fire("Error", "Please enter a valid contact number", "error");
          return;
        }

        $(this).prop('disabled', true);
        $('#reg-otp-loader').show();

        $.ajax({
          url: '<?= base_url("UserController/send_registration_otp") ?>',
          method: 'POST',
          data: {
            email: email,
            contact: contact
          },
          dataType: 'json',
          success: function (response) {
            $('#reg-otp-loader').hide();
            if (response.status === 'success') {
              $('#reg_otp_section').show();
              $('#regVerifyOtpBtn').show();
              $('#regRequestOtpBtn').hide();
              $('#regResendOtpBtn').hide();
              $('#reg-otp-timer').show();
              startCountdown(60, '#regCountdown', function () {
                $('#reg-otp-timer').hide();
                $('#regResendOtpBtn').show();
              });
              $('#reg_otp').focus();
              $('#regResendOtpBtn').click(function () {
                $('#regRequestOtpBtn').click(); // Trigger resend
                $(this).hide();
              });

              Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
                timer: 2000,
                showConfirmButton: false
              });
            } else {
              $('#regRequestOtpBtn').prop('disabled', false);
              Swal.fire('Error', response.message, 'error');
            }
          },
          error: function () {
            $('#reg-otp-loader').hide();
            $('#regRequestOtpBtn').prop('disabled', false);
            Swal.fire('Error', 'Failed to send OTP. Please try again.', 'error');
          }
        });
      });

      $('#registrationForm').submit(function (e) {
        e.preventDefault();

        const otp = $('#reg_otp').val().trim();
        if (!otp || otp.length !== 6) {
          Swal.fire("Error", "Please enter a valid 6-digit OTP", "error");
          return;
        }

        const formData = {
          name: $('#reg_name').val().trim(),
          address: $('#reg_address').val().trim(),
          dob: $('#reg_dob').val().trim(),
          otp: otp
        };

        // Validate all fields
        if (!formData.name || formData.name.length < 3) {
          Swal.fire("Error", "Please enter a valid name (min 3 characters)", "error");
          return;
        }

        $('#regVerifyOtpBtn').prop('disabled', true)
          .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering...');

        $.ajax({
          url: '<?= base_url("UserController/verify_registration_otp") ?>',
          method: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            $('#regVerifyOtpBtn').prop('disabled', false).html('Register');

            if (response.status === 'success') {
              Swal.fire({
                title: 'Registration Successful!',
                html: '<b>Welcome to SonaChandi!</b><br>You have earned <b>50 loyalty points 🎁</b>',
                icon: 'success',
                timer: 7000,
                showConfirmButton: false
              }).then(() => {
                registrationModal.hide();
                window.location.href = response.redirect;
              });
            } else {
              Swal.fire('Error', response.message, 'error');
            }
          },
          error: function () {
            $('#regVerifyOtpBtn').prop('disabled', false).html('Register');
            Swal.fire('Error', 'Registration failed. Please try again.', 'error');
          }
        });

      });

      // ========== MODAL SWITCHING ==========
      $('#showRegistrationBtn').click(function () {
        otpModal.hide();
        setTimeout(() => {
          registrationModal.show();
          $('#reg_email').focus();
        }, 300);
      });

      $('#showLoginBtn').click(function () {
        registrationModal.hide();
        setTimeout(() => {
          otpModal.show();
          $('#email').focus();
        }, 300);
      });

      // Focus trap for accessibility
      $('.modal').on('shown.bs.modal', function () {
        $(this).find('input:visible:first').focus();
      });

      // Email validation helper
      function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
      }
    });
  </script>
</body>

</html>