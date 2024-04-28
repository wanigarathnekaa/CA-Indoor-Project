<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/product.css">

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
            <h2>Products</h2>
            <button type="button" id="addProduct" onclick="openModal()">Add New Product +</button>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2 class="modal-title">Add New Product</h2>
                    <!-- action="<?php echo URLROOT; ?>/Category/saveCategory ?>" -->
                    <form method="POST" id="productForm" enctype="multipart/form-data">
                        <!-- Product Title -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" name="productName" placeholder="Enter Product name">
                                <span class="form-invalid-1"></span>
                            </div>
                        </div>

                        <!-- Product Category Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <select name="category_name" id="category_name" class="form-control">
                                    <option value="0">Select Category</option>
                                    <?php foreach ($data['categories'] as $category): ?>
                                        <option value="<?php echo $category->category_id; ?>">
                                            <?php echo $category->category_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="form-invalid-2"></span>
                            </div>
                            <!-- Product Brand Name -->
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <select name="brand_name" id="brand_name" class="form-control">
                                    <option value="0">Select a Category first</option>
                                </select>
                                <span class="form-invalid-3"></span>
                            </div>
                        </div>

                        <!-- Regular Price of the Product -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="regular_price">Regular Price</label>
                                <input type="text" id="regular_price" name="regular_price" placeholder="Regular Price">
                                <span class="form-invalid-4"></span>
                            </div>
                            <!-- Selling Price of the Product -->
                            <div class="form-group">
                                <label for="selling_price">Selling Price</label>
                                <input type="text" id="selling_price" name="selling_price" placeholder="Selling Price">
                                <span class="form-invalid-5"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Quantity -->
                            <div class="form-group">
                                <label for="productName">Quantity</label>
                                <input type="text" id="productQty" name="productQty"
                                    placeholder="Enter Product quantity">
                                <span class="form-invalid-8"></span>
                            </div>

                            <!-- Discount -->
                            <div class="form-group">
                                <label for="productName">Discount</label>
                                <input type="number" step="0.01" id="productDiscount" name="productDiscount"
                                    placeholder="Enter Product discount" min="0" value="0.00">
                                <span class="form-invalid-9"></span>
                            </div>
                        </div>

                        <!-- thumbnail -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_thumbnail">Product Thumbnail</label>
                                <input type="file" id="product_thumbnail" name="product_thumbnail">
                                <span class="form-invalid-7"></span>
                            </div>
                        </div>

                        <!-- short Description -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" name="short_description" id="short_description" rows="5"
                                    placeholder="Short Description"></textarea>
                                <span class="form-invalid-6"></span>
                            </div>
                        </div>


                        <div class="btn">
                            <input type="hidden" id="form_type" name="form_type">
                            <button type="submit" id="submit">Save</button>
                            <button type="button" onclick="closeModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="searchbar">
            <div class="serachselect">
                <i class="fa-solid fa-magnifying-glass icon"></i>
                <select id="filterProduct" class="btn">
                    <option value="All">All</option>
                    <option value="Insufficient Quantity">Low Quantity</option>
                    <option value="Sufficient Quantity">High Quantity</option>
                </select>
            </div>
        </div>

        <div class="table-container">
            <table id="coachTable">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Thumbnail</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Re-order Level</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTable">
                    <?php foreach ($data['products'] as $product): ?>
                        <tr>
                            <td>
                                <?php echo $product->product_id; ?>
                            </td>
                            <td>
                                <img src="<?php echo URLROOT; ?>/CricketShop/<?php echo $product->product_thumbnail; ?>"
                                    alt="product thumbnail" height="100px">
                            </td>
                            <td>
                                <?php echo $product->product_title; ?>
                            </td>
                            <td>
                                <?php
                                $matchedCategoryName = '';
                                foreach ($data['categories'] as $category) {
                                    if ($category->category_id == $product->category_id) {
                                        $matchedCategoryName = $category->category_name;
                                        break;
                                    }
                                }
                                echo $matchedCategoryName;
                                ?>
                            </td>
                            <td>
                                <?php echo $product->reorder_level; ?>
                                <button type="button" id="Change_Level" class="Change_Level"
                                    p_id="<?php echo $product->product_id; ?>"><i class="fa-solid fa-pen"></i></button>
                            </td>
                            <td>
                                <?php echo $product->qty; ?>
                                <button type="button" id="Change_Quantity" class="Change_Quantity"
                                    p_id="<?php echo $product->product_id; ?>"><i class="fa-solid fa-pen"></i></button>
                            </td>
                            <td>
                                <?php echo $product->discount; ?>
                                <?php echo "%"; ?>
                                <button type="button" id="Change_Discount" class="Change_Discount"
                                    p_id="<?php echo $product->product_id; ?>"><i class="fa-solid fa-pen"></i></button>
                            </td>
                            <td>
                                <?php echo $product->created_at; ?>
                            </td>
                            <td>
                                <button type="button" class="edit" id="<?php echo $product->product_id; ?>">
                                    <i class="fas fa-edit icon"></i></button>
                                <?php if ($product->active_state) { ?>
                                    <a href="<?php echo URLROOT; ?>/Product/deleteProduct/<?php echo $product->product_id; ?>">
                                        Active</a>
                                <?php } else { ?>
                                    <a href="<?php echo URLROOT; ?>/Product/deleteProduct/<?php echo $product->product_id; ?>">
                                        De-active</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    endforeach; ?>
                </tbody>
            </table>
        </div>


        <!-- popup -->
        <div id="quantityChange" class="modal">
            <div class="modal-content">
                <div class="title">
                    <h2 class="modal-title">Update Product Quantity</h2>
                </div>
                <hr>

                <div class="form-group">
                    <label for="productName">New Quantity :</label>
                    <input type="number" id="productQuantity" class="productQuantity" name="productQuantity"
                        placeholder="Enter New Product quantity"><br>
                    <span class="form-invalid-8"></span>
                </div>

                <hr>

                <div class="btn">
                    <button type="button" id="updateQuantity">Update</button>
                    <button type="button" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- popup -->
        <div id="levelChange" class="modal">
            <div class="modal-content">
                <div class="title">
                    <h2 class="modal-title">Update Re-order Level</h2>
                </div>
                <hr>

                <div class="form-group">
                    <label for="productName">New Level :</label>
                    <input type="number" id="productLevel" class="productLevel" name="productLevel"
                        placeholder="Enter New Reorder Level"><br>
                    <span class="form-invalid-10"></span>
                </div>

                <hr>

                <div class="btn">
                    <button type="button" id="updateLevel">Update</button>
                    <button type="button" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- popup -->
        <div id="discountChange" class="modal">
            <div class="modal-content">
                <div class="title">
                    <h2 class="modal-title">Update Product Discount</h2>
                </div>
                <hr>

                <div class="form-group">
                    <label for="productName">New Discount</label>
                    <input type="number" step="0.01" id="productDisc" name="productDisc"
                        placeholder="Enter Product discount" min="0" value="0.00">
                    <span class="form-invalid-9"></span>
                </div>

                <hr>

                <div class="btn">
                    <button type="button" id="updateDiscount">Update</button>
                    <button type="button" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <ul class="pagination">
                <li><a href="#" class="page-link" id="prevLink">&laquo; Prev</a></li>
                <li><a href="#" class="page-link">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li><a href="#" class="page-link">3</a></li>
                <li><a href="#" class="page-link">4</a></li>
                <li><a href="#" class="page-link">5</a></li>
                <li><a href="#" class="page-link" id="nextLink">Next &raquo;</a></li>
            </ul>
        </div>
    </section>

    <!-- javascripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/product.js"></script>
    <script>
        $(document).ready(function () {
            $('#filterProduct').change(function () {
                var filterValue = $(this).val();

                // Show all rows initially
                $('#categoryTable tr').show();

                // Filter rows based on the selected option
                if (filterValue === 'Insufficient Quantity') {
                    $('#categoryTable tr').each(function () {
                        var quantity = parseInt($(this).find('td:eq(5)').text(), 10);
                        if (quantity > 3) {
                            $(this).hide();
                        }
                    });
                } else if (filterValue === 'Sufficient Quantity') {
                    $('#categoryTable tr').each(function () {
                        var quantity = parseInt($(this).find('td:eq(5)').text(), 10);
                        if (quantity <= 3) {
                            $(this).hide();
                        }
                    });
                } else {
                    location.reload();
                }
            });
            $('#productForm').submit(function (e) {
                e.preventDefault();
                var formType = $('#form_type').val();
                var productName = $('#productName').val();
                var category_name = $('#category_name').val();
                var brand_name = $('#brand_name').val();
                var regular_price = $('#regular_price').val();
                var selling_price = $('#selling_price').val();
                var short_description = $('#short_description').val();
                var quantity = $('#productQty').val();
                var discount = $('#productDiscount').val();

                // Create FormData object
                var formData = new FormData(this);

                if ($('#form_type').val() === "edit") {
                    var id = $('.edit').attr('id');
                }
                else {
                    var id = "";
                }

                // Append additional form data
                formData.append('formType', formType);
                formData.append('productName', productName);
                formData.append('category_name', category_name);
                formData.append('brand_name', brand_name);
                formData.append('regular_price', regular_price);
                formData.append('selling_price', selling_price);
                formData.append('short_description', short_description);
                formData.append('id', id);
                formData.append('quantity', quantity);
                formData.append('discount', discount);

                // Get the file input element
                var fileInput = $('#product_thumbnail')[0];
                // Check if a file is selected
                if (fileInput.files.length > 0) {
                    // Append the file to FormData
                    formData.append('product_thumbnail', fileInput.files[0]);
                }

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Product/saveProduct",
                    data: formData,
                    contentType: false, // Set content type to false
                    processData: false, // Don't process the data
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === "success") {
                            location.reload();
                        } else {
                            $('.form-invalid-1').html(response.messageProductName);
                            $('.form-invalid-2').html(response.messageCategoryName);
                            $('.form-invalid-3').html(response.messageBrandName);
                            $('.form-invalid-4').html(response.messageRegularPrice);
                            $('.form-invalid-5').html(response.messageSellingPrice);
                            $('.form-invalid-6').html(response.messageShortDescription);
                            $('.form-invalid-7').html(response.messageProductThumbnail);
                            $('.form-invalid-8').html(response.messageQuantity);
                            $('.form-invalid-9').html(response.messageDiscount);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", error);
                    }
                });
            });

            $(".edit").click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                var btn = "edit";
                $('#myModal').css("display", "block");
                $('#form_type').val(btn);
                $('.modal-title').html("Edit Product");
                $('#submit').html("Update").css("background-color", "goldenrod");

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Product/getProductById",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('#productName').val(response.product_title);
                        $('#regular_price').val(response.regular_price);
                        $('#selling_price').val(response.selling_price);
                        $('#short_description').val(response.short_description);
                        $('#productQty').val(response.qty);
                        $('#productDiscount').val(response.discount);

                        $("#category_name").val(response.category_id);

                        $("#category_name").trigger("change");

                        $("#brand_name").val(response.brand_id);

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", error);
                    }
                });
            });

            $("#category_name").change(function (e) {
                e.preventDefault();
                var id = $("#category_name").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Brand/getBrandCategoryById",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $("#brand_name").html(response.output);
                    }
                })
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.Change_Quantity').forEach(item => {
                item.addEventListener('click', event => {
                    $('#quantityChange').css("display", "block");
                    $('#updateQuantity').click(function (e) {
                        var id = $(item).attr('p_id');
                        e.preventDefault();
                        var quantity = parseInt($('#productQuantity').val());
                        if (isNaN(quantity)) { // Check if quantity is NaN
                            quantity = 0; // Set quantity to 0 if NaN
                        }
                        console.log(quantity);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo URLROOT; ?>/Product/updateQuantity",
                            data: {
                                id: id,
                                quantity: quantity
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == "success") {
                                    location.reload();
                                } else {
                                    $('.form-invalid-8').html(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX request failed:", error);
                            }
                        });
                    });
                })
            })
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.Change_Discount').forEach(item => {
                item.addEventListener('click', event => {
                    $('#discountChange').css("display", "block");
                    $('#updateDiscount').click(function (e) {
                        var id = $(item).attr('p_id');
                        e.preventDefault();
                        var discount = $('#productDisc').val();
                        console.log(discount);
                        if (isNaN(discount)) { // Check if Discount is NaN
                            discount = 0; // Set Discount to 0 if NaN
                        }
                        console.log(discount);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo URLROOT; ?>/Product/updateDiscount",
                            data: {
                                id: id,
                                discount: discount
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == "success") {
                                    location.reload();
                                } else {
                                    $('.form-invalid-9').html(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX request failed:", error);
                            }
                        });
                    });
                })
            })
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.Change_Level').forEach(item => {
                item.addEventListener('click', event => {
                    $('#levelChange').css("display", "block");
                    $('#updateLevel').click(function (e) {
                        var id = $(item).attr('p_id');
                        e.preventDefault();
                        var level = parseInt($('#productLevel').val());
                        if (isNaN(level)) { // Check if quantity is NaN
                            quantity = 0; // Set quantity to 0 if NaN
                        }
                        console.log(level);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo URLROOT; ?>/Product/updateReorderLevel",
                            data: {
                                id: id,
                                level: level
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == "success") {
                                    location.reload();
                                } else {
                                    $('.form-invalid-10').html(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX request failed:", error);
                            }
                        });
                    });
                })
            })
        });
    </script>

</body>

</html>