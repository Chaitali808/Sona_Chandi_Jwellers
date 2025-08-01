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



</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- sidebar   -->
            <?php include 'sidebar.php'; ?>
            <div class="col-lg-9 col-xl-10 col-12 offset-xl-2 offset-lg-3 text-white ">
                <!-- navbar -->
                <?php include 'navbar.php'; ?>
                <!-- Place this inside your HTML body (e.g. after navbar include) -->

                <div class="container mt-4 text-dark">
                    <div class="card shadow rounded-4 p-4">
                        <h4 class="mb-4">Product Filter Form</h4>
                        <form id="productForm">
                            <!-- Type Selection -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Select Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">Silver</option>
                                    <option value="diamond">Diamond</option>
                                    <option value="platinum">Platinum</option>
                                </select>
                            </div>

                            <!-- Category Section -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Select Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">-- Select Category --</option>
                                    <option value="ring">Ring</option>
                                    <option value="bracelet">Bracelet</option>
                                    <option value="chain">Chain</option>
                                </select>
                                <div class="mt-2">
                                    <input type="text" class="form-control" id="newCategory"
                                        placeholder="Or add new category" />
                                    <button type="button" class="btn btn-sm btn-primary mt-2"
                                        onclick="addCategory()">Add Category</button>
                                </div>
                            </div>

                            <!-- Shop by Style -->
                            <div class="mb-3">
                                <label for="styleInput" class="form-label">Shop by Style</label>
                                <input type="text" class="form-control" id="styleInput"
                                    placeholder="Type and press Enter">
                                <div class="mt-2" id="styleTags"></div>
                            </div>

                            <!-- Shop by Type -->
                            <div class="mb-3">
                                <label for="typeInput" class="form-label">Shop by Type</label>
                                <input type="text" class="form-control" id="typeInput"
                                    placeholder="Type and press Enter">
                                <div class="mt-2" id="typeTags"></div>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Add new category to dropdown
        function addCategory() {
            const newCatInput = document.getElementById('newCategory');
            const categorySelect = document.getElementById('category');
            const newValue = newCatInput.value.trim();

            if (newValue) {
                const option = document.createElement('option');
                option.value = newValue.toLowerCase();
                option.text = newValue;
                option.selected = true;
                categorySelect.appendChild(option);
                newCatInput.value = '';
            }
        }

        // Tag input logic
        function handleTagInput(inputId, tagContainerId, tagList) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(tagContainerId);

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const value = input.value.trim();
                    if (value && !tagList.includes(value)) {
                        tagList.push(value);
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-primary rounded-pill me-1 mb-1';
                        badge.innerHTML = `${value} <span class="ms-1" style="cursor:pointer;" onclick="this.parentElement.remove(); tagList.splice(tagList.indexOf('${value}'), 1);">&times;</span>`;
                        container.appendChild(badge);
                        input.value = '';
                    }
                }
            });
        }

        const styleTags = [];
        const typeTags = [];

        handleTagInput('styleInput', 'styleTags', styleTags);
        handleTagInput('typeInput', 'typeTags', typeTags);

        // Submit form
        document.getElementById('productForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Here you can collect form data and send to backend
            const type = document.getElementById('type').value;
            const category = document.getElementById('category').value;

            Swal.fire({
                title: 'Submitted!',
                html: `
                <b>Type:</b> ${type}<br/>
                <b>Category:</b> ${category}<br/>
                <b>Style Tags:</b> ${styleTags.join(', ')}<br/>
                <b>Type Tags:</b> ${typeTags.join(', ')}
            `,
                icon: 'success'
            });
        });
    </script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>