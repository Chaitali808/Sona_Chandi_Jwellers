<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .main {
            height: 100vh;
            width: 100%;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-box {
            width: 600px;
            background: rgba(255, 255, 255, 0);
            box-shadow: 0 8px 32px 0 rgb(53, 45, 45);
            border: 1px solid #d9d9d9;
            border-radius: 10px;
            padding: 20px;
        }

        .form-label {
            color: white;
        }

        .form-control {
            background: rgba(217, 217, 217, 0.33);
            border: 1px solid #d9d9d9;
            color: white;
            box-shadow: 0 5px 7px 0 rgb(53, 45, 45);
        }

        .button {
            background: rgba(103, 52, 123, 1);
            box-shadow: 0 8px 15px rgba(46, 139, 87, 0.3);
            color: #fff;
            font-weight: bold;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        #otp-section {
            display: none;
        }
    </style>
    <style>
        #otp-loader {
            display: none;
            color: white;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <section class="main" style="background-image: url('<?php echo base_url("assets/Home/loginbackground.jpg"); ?>');">
        <div class="content-box">
            <form id="registrationForm" action="javascript:void(0);">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Name" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" class="form-control" placeholder="Address" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date of Birth</label>
                    <input type="date" id="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" id="contact" class="form-control" placeholder="Contact" required>
                </div>

                <div class="mb-3" id="otp-section">
                    <label for="otp" class="form-label">Enter OTP</label>
                    <input type="text" id="otp" class="form-control" placeholder="Enter OTP">
                </div>
                <small id="otp-loader">Sending OTP...</small>



                <div class="mb-3">
                    <button type="submit" id="registerBtn" class="button border border-dark rounded-2">Register</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        let generatedOtp = "";
        let otpSent = false;

        $('#registrationForm').on('submit', function (e) {
            e.preventDefault();

            const name = $('#name').val().trim();
            const address = $('#address').val().trim();
            const dob = $('#date').val().trim();
            const email = $('#email').val().trim();
            const contact = $('#contact').val().trim();
            const otp = $('#otp').val().trim();

            if (!otpSent) {
                // Send OTP
                $('#otp-loader').show();
                $.post("<?= base_url('UserController/send_otp') ?>", { email }, function (res) {
                    $('#otp-loader').hide();

                    res = typeof res === 'string' ? JSON.parse(res) : res;

                    if (res.status === 'success') {
                        generatedOtp = res.otp;
                        otpSent = true;
                        $('#otp-section').show();
                        Swal.fire('OTP Sent!', 'Check your email.', 'info');
                    } else if (res.status === 'wait') {
                        Swal.fire('Wait', res.message, 'warning');
                    } else {
                        Swal.fire('Error', res.message || 'Failed to send OTP.', 'error');
                    }
                });
            } else {
                // Verify OTP
                if (otp !== generatedOtp) {
                    Swal.fire('Invalid OTP', 'Incorrect OTP entered.', 'error');
                    return;
                }

                $.post("<?= base_url('UserController/register_customer') ?>", {
                    name, address, dob, email, contact
                }, function (res) {
                    res = typeof res === 'string' ? JSON.parse(res) : res;
                    if (res.status === 'success') {
                        Swal.fire('Success', 'Registered successfully with 100 points!', 'success');
                        $('#registrationForm')[0].reset();
                        $('#otp-section').hide();
                        otpSent = false;
                    } else {
                        Swal.fire('Error', res.message || 'Registration failed.', 'error');
                    }
                });
            }
        });

    </script>
</body>

</html>