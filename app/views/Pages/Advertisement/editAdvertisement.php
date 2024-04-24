<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/editAdvertisement.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edit advertisement</title>
   </head>
<body>
      <!-- Sidebar -->
      <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">
        <div class="container">
          <div class="title">Edit Advertisement</div>
          <div class="content">
            <form action="<?php echo URLROOT; ?>/Advertisement/editAdvertisement/<?php echo $data['advertisement_id'] ?>" method="POST" enctype="multipart/form-data">
              <div class="top">
                <div class="user-details">
                  <div class="input-box">
                    <span class="details">Coach Name</span>
                    <input type="text" name="name" placeholder="Enter your name" value="<?php echo $data['name']; ?>">
                    <span class="form-invalid"><?php echo $data['name_err']; ?></span>
                  </div>
                  <div class="input-box">
                    <span class="details">Advertisement Title</span>
                    <input type="text" name="title" placeholder="Title" value="<?php echo $data['title']; ?>">
                    <span class="form-invalid"><?php echo $data['title_err']; ?></span>
                  </div>   
                  <div class="input-box">
                    <span class="details">Date</span> 
                    <input type="date" name="date" placeholder="Date" value="<?php echo $data['date']; ?>">
                    <span class="form-invalid"><?php echo $data['date_err']; ?></span>
                  </div>
                  <div class="input-box " id="content">
                    <span class="details">Content</span>
                    <input type="text" name="content" placeholder="Description" value="<?php echo $data['content']; ?>">
                    <span class="form-invalid"><?php echo $data['content_err']; ?></span>
                  </div>
                  <div class="input-box">
                    <!-- <span class="details"></span> -->
                    <input type="text" hidden name="email" value="<?php echo $data['email']; ?>">
                    <!-- <span class="form-invalid"><?php echo $data['email_err']; ?></span> -->
                  </div> 
                </div>          
                <div class="img">
                  <label for="file" class="add-img">
                    <div class="img-display">
                      <div class="img-showcase">
                        <img id="output" src="<?php echo URLROOT; ?>/public/uploads/<?php echo $data['filename']; ?>" />
                        <span class="camicon"><i class='bx bxs-camera-plus'></i></span>
                      </div>
                      <input type="file" name="file" id="file" hidden onchange="loadFile(event)" value="<?php echo URLROOT; ?>/public/uploads/<?php echo $data['filename']; ?>" />
                    </div>
                  </label>              
                </div>
              </div>
              <div class="button">
                <input type="submit" value="Update" >
              </div> 
            </form>
          </div>
        </div>
      </section>

      <script>
            var loadFile = function (event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
            };
      </script>
</body>
</html>