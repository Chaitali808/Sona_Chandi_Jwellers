<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    :root {
      /* Text Colors */
      --text-primary: #212529;
      --text-secondary: #6c757d;
      --text-light: #ffffff;

      /* Button Colors */
      --btn-primary-bg: #0d6efd;
      --btn-primary-hover: #0b5ed7;
      --btn-secondary-bg: #6c757d;
      --btn-secondary-hover: #5c636a;

      /* Icon Colors */
      --icon-color: #495057;
      --icon-hover-color: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
      ;
    }




    .notification-card {
      border-left: 4px solid #915cd1;
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 10px 15px;
      margin-bottom: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .message {
      font-size: 1rem;
      color: #333;
    }

    .timestamp {
      font-size: 0.85rem;
      color: gray;
    }

    .navbar i {

      background: var(--icon-hover-color) !important;

      transform: scale(1.05) !important;
      background-clip: text !important;
      color: transparent !important;



    }

    .mark-all-read {
      background-color: #915cd1 !important;
      color: var(--text-light) !important;
      border: none !important;
      transition: background-color 0.3s ease !important;
    }

    .mark-all-read:hover {
      background-color: #915cd1 !important;
      color: var(--text-light) !important;
    }
  </style>
</head>

<body>




  <div
    class="container-fluid  shadow-sm bg-white navbar d-flex py-lg-3  justify-content-between justify-content-lg-end align-items-center p-2">
    <div class="d-lg-none p-2 ">
      <button class="btn p-2" id="sidebarToggle" style="background: transparent; border: none;">
        <i class="fas fa-bars fs-4 " onclick="showSidebar()"></i>
      </button>
    </div>

    <div>
      <!-- Notification Bell with Badge -->
      <div class="position-relative d-inline-block me-3" style="cursor: pointer;" data-bs-toggle="modal"
        data-bs-target="#notificationModal">
        <i class="fa-solid fa-bell p-2 fs-4"></i>

        <!-- Badge -->
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
          style="font-size: 0.6rem;">
          <?php echo $notificationsCount; ?>
        </span>
      </div>

      <a href="<?php echo site_url('AdminController/profile'); ?>" class=" text-dark "><i
          class="fa-regular  fa-user p-2 me-3 fs-4"></i></a>
    </div>

  </div>

  <div class="modal fade" id="notificationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Notifications</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>


        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">

          <?php if (!empty($notifications)): ?>

            <!-- Mark All as Read Button -->
            <div class="d-flex justify-content-end mb-3">
              <button class="btn btn-sm mark-all-read">
                <i class="bi bi-check2-circle me-1"></i> Mark All as Read
              </button>
            </div>



            <?php foreach ($notifications as $notification): ?>
              <div class="notification-card d-flex align-items-start justify-content-between mb-2">
                <div>
                  <div class="message"><?= $notification->message; ?></div>
                  <div class="timestamp text-muted"><?= date('d M Y, h:i A', strtotime($notification->date)); ?></div>
                </div>
                <div class="ms-3">
                  <?php if ($notification->status === 'unread'): ?>
                    <i class="bi bi-bell-fill text-secondary mark-as-read" title="Unread" data-id="<?= $notification->id; ?>"
                      style="cursor: pointer;"></i>
                  <?php else: ?>
                    <i class="bi bi-check-circle text-success" title="Read"></i>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>

          <?php else: ?>
            <div class="text-center text-muted">No notifications found.</div>
          <?php endif; ?>

        </div>


      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).on("click", ".mark-as-read", function () {
      var notificationId = $(this).data("id");
      var icon = $(this);

      $.ajax({
        url: "<?= base_url('AdminController/NotificationMarkAsRead'); ?>",
        method: "POST",
        data: { id: notificationId },
        success: function (response) {
          // Change the icon to 'read'
          icon.removeClass("bi-bell-fill text-secondary")
            .addClass("bi-check-circle text-success")
            .attr("title", "Read");
        },
        error: function () {
          alert("Something went wrong while updating notification status.");
        }
      });
    });
  </script>


  <script>
    document.querySelector('.mark-all-read').addEventListener('click', function () {
      fetch("<?= base_url('AdminController/markAllNotificationsRead') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            location.reload(); // Refresh the page
          } else {
            alert("Something went wrong!");
          }
        })
        .catch(error => {
          console.error("Error:", error);
          alert("AJAX error!");
        });
    });
  </script>

</body>

</html>