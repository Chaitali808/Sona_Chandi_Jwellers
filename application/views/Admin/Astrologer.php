<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Astrologer Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap, FontAwesome & SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .required::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .modal-header {
            background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
            color: white;
        }

        .gradient-header {
            background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%) !important;
        }

        .gradient-btn {
            background: linear-gradient(90deg, #a259e6 0%, #6d28d9 100%);
            border: none;
            color: white !important;
        }

        .gradient-btn:hover {
            filter: brightness(0.95);
        }

        .btn-primary {
            background-color: #915cd1 !important;
        }

        .astro-name {
            color: #915cd1 !important;
        }
    </style>
    <style>
        .gradient-header {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        }

        .gradient-btn {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: 0.3s ease-in-out;
        }

        .gradient-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .astrologer-card {
            background-color: #fff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .astrologer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .container-box {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .btn-outline-primary,
        .btn-outline-danger {
            border-radius: 20px;
            padding: 6px 18px;
        }
    </style>

</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- sidebar -->
            <?php include 'sidebar.php'; ?>
            <div class="col-lg-9 col-xl-10 col-6 offset-xl-2 offset-lg-3 text-dark bg-light min-vh-100">
                <!-- navbar -->
                <?php include 'navbar.php'; ?>

                <nav class="navbar navbar-expand navbar-dark gradient-header mb-4 px-2 py-3 shadow-sm rounded-0">
                    <div class="w-100 text-center">
                        <span class="navbar-brand mb-0 h4 text-uppercase fw-bold">Astrologer Management</span>
                    </div>
                </nav>


                <div class="container-box col-7">
                    <div id="astrologerContainer" class="mb-4"></div>
                    <div id="addButtonContainer" class="text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="astrologerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="astrologerForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Astrologer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="astro_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="required">Name</label>
                            <input type="text" class="form-control" name="name"  placeholder ="Astrologer Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">Experience</label>
                            <input type="text" class="form-control" name="experience"  placeholder ="Astrologer Experience" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">Expertise</label>
                            <input type="text" class="form-control" name="expertise"  placeholder ="Astrologer Expertise" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">Mobile</label>
                            <input type="text" class="form-control" name="mobile" placeholder ="Mobile Number" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp" placeholder ="WhatsApp" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">Email</label>
                            <input type="email" class="form-control" name="email" placeholder ="Email Id" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="required">Charges</label>
                            <input type="text" class="form-control" name="charges"  placeholder ="Charges" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Astrologer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const modal = new bootstrap.Modal(document.getElementById('astrologerModal'));
        function openAddModal() {
            document.getElementById("modalTitle").innerText = "Add Astrologer";
            document.getElementById("astrologerForm").reset();
            document.getElementById("astro_id").value = "";
            modal.show();
        }

        function openEditModal(data) {
            document.getElementById("modalTitle").innerText = "Edit Astrologer";
            document.getElementById("astro_id").value = data.id;
            for (let key in data) {
                if (document.querySelector(`[name="${key}"]`)) {
                    document.querySelector(`[name="${key}"]`).value = data[key];
                }
            }
            modal.show();
        }

        function loadAstrologer() {
            fetch("<?= base_url('AdminController/getAstrologer') ?>")
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById("astrologerContainer");
                    const addBtnContainer = document.getElementById("addButtonContainer");

                    if (data && data.id) {
                        container.innerHTML = `
    <div class="card astrologer-card shadow-lg border-0 rounded-4">
        <div class="card-body p-3">
            <h4 class="card-title text-center astro-name fw-bold fs-2 mb-4 border-bottom pb-3">${data.name}</h4>
            <div class="row">
                <!-- Label + Icon column -->
                <div class="col-md-4 text-start pe-4">
                    <p class="mb-4"><i class="bi bi-award-fill text-warning me-2"></i><strong>Experience</strong></p>
                    <p class="mb-4"><i class="bi bi-star-fill text-info me-2"></i><strong>Expertise</strong></p>
                    <p class="mb-4"><i class="bi bi-telephone-fill text-success me-2"></i><strong>Mobile</strong></p>
                    <p class="mb-4"><i class="bi bi-whatsapp text-success me-2"></i><strong>WhatsApp</strong></p>
                    <p class="mb-4"><i class="bi bi-envelope-fill text-danger me-2"></i><strong>Email</strong></p>
                    <p><i class="bi bi-currency-rupee text-dark me-2"></i><strong>Charges</strong></p>
                </div>

                <!-- Separator column -->
                <div class="col-md-1 text-center d-none d-md-block">
                    <p class="mb-4">:</p>
                    <p class="mb-4">:</p>
                    <p class="mb-4">:</p>
                    <p class="mb-4">:</p>
                    <p class="mb-4">:</p>
                    <p>:</p>
                </div>

                <!-- Values column -->
                <div class="col-md-7 ps-4">
                    <p class="mb-4">${data.experience}</p>
                    <p class="mb-4">${data.expertise}</p>
                    <p class="mb-4">${data.mobile}</p>
                    <p class="mb-4">${data.whatsapp}</p>
                    <p class="mb-4">${data.email}</p>
                    <p>₹${data.charges}</p>
                </div>
            </div>

            <div class="text-end mt-4">
                <button class="btn gradient-btn me-2" onclick='openEditModal(${JSON.stringify(data)})'>
                    <i class="bi bi-pencil-square me-1"></i> Update
                </button>
                <button class="btn btn-outline-danger" onclick='deleteAstrologer(${data.id})'>
                    <i class="bi bi-trash-fill me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
`;
                        addBtnContainer.innerHTML = ""; // Hide Add Button
                    } else {
                        container.innerHTML = `<div class="alert alert-info text-center">No astrologer found.</div>`;
                        addBtnContainer.innerHTML = `<button class="gradient-btn" onclick="openAddModal()">Add Astrologer</button>`;
                    }
                });
        }

        document.getElementById("astrologerForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const isUpdate = formData.get("id");
            const url = isUpdate ?
                "<?= base_url('AdminController/updateAstrologer') ?>" :
                "<?= base_url('AdminController/addAstrologer') ?>";

            fetch(url, {
                method: "POST",
                body: formData
            })
                .then(res => res.json())
                .then(result => {
                    modal.hide();
                    Swal.fire({
                        icon: 'success',
                        title: result.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    loadAstrologer();
                });
        });

        function deleteAstrologer(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You will delete this astrologer permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("<?= base_url('AdminController/deleteAstrologer') ?>", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: "id=" + id
                    })
                        .then(res => res.json())
                        .then(result => {
                            Swal.fire({
                                icon: 'success',
                                title: result.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                            loadAstrologer();
                        });
                }
            });
        }

        loadAstrologer();
    </script>

</body>

</html>