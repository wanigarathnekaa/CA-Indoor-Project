<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/category.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "Manager";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <section class="working-panel">
            <div class="fluid-panel">
                <h1 class="display-4">C&A INDOOR CRICKET SHOP</h1>
            </div>
            <div class="image-text">
                <span class="image">
                    <img src="http://localhost/C&A_Indoor_Project/images/Logo3.png" alt="logo">
                </span>
            </div>
            <hr>
        </section>
        <div class="header">
            <h2>Category</h2>
            <button type="button" onclick="openModal()">Add New Category</button>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2>Add New Category</h2>
                    <!-- action="<?php echo URLROOT; ?>/Category/saveCategory ?>" -->
                    <form method="POST" id="categoryForm">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name">
                        <span class="form-invalid"></span>
                        <div class="btn">
                            <button type="submit">Save</button>
                            <button type="button" onclick="closeModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table id="coachTable">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTable">
                    <?php foreach ($data['categories'] as $category): ?>
                        <tr>
                            <td>
                                <?php echo $category->category_id; ?>
                            </td>
                            <td>
                                <?php echo $category->category_name; ?>
                            </td>
                            <td>
                                <a
                                    href="<?php echo URLROOT; ?>/Category/editCategory/<?php echo $category->category_id; ?>"><i
                                        class="fas fa-edit"></i></a>
                                <a
                                    href="<?php echo URLROOT; ?>/Category/deleteCategory/<?php echo $category->category_id; ?>"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <ul class="pagination">
                <li><a href="#" class="page-link">&laquo; Prev</a></li>
                <li><a href="#" class="page-link">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li><a href="#" class="page-link">3</a></li>
                <li><a href="#" class="page-link">4</a></li>
                <li><a href="#" class="page-link">5</a></li>
                <li><a href="#" class="page-link">Next &raquo;</a></li>
            </ul>
        </div>
    </section>

    <!-- javascripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/category.js"></script>
    <script>
        $(document).ready(function () {
            $('#categoryForm').submit(function (e) {
                e.preventDefault();
                var categoryName = $('#categoryName').val();

                if (categoryName == '') {
                    $('.form-invalid').html("Please enter category name");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo URLROOT; ?>/Category/saveCategory",
                        data: {
                            categoryName: categoryName
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#categoryForm')[0].reset();
                                closeModal();
                                location.reload();
                            } else {
                                $('.form-invalid').html(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX request failed:", error);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>