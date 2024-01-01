<!-- <!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/addAdvertisement.css" />
</head>

<body>
      <div class="box">
            <div class="add-advertisement">Add Advertisement</div>

            <div class="formbox">
                  <form action="<?php echo URLROOT; ?>/Advertisement/add_Advertisement" class="addform">
                        <div class="textbox">
                              <label for="title">Title</label><br>
                              <input type="text" id="title" name="title">
                        </div>
                        <div class="textbox">
                              <label for="description">Description:</label><br>
                              <textarea name="description" id="description" rows="4"></textarea>
                        </div>
                        <div class="textbox">
                              <label for="img">Post:</label><br>
                              <input type="file" id="img" name="img" accept="image/*">
                        </div>
                        <div class="buttons">
                              <button type="submit" class="button">Add</button>
                              <a href="<?php echo URLROOT; ?>/Pages/Coach_Advertisements/advertisement" class="button">Cancel</a>
                        </div>
                  </form>
            </div>


      </div>
</body>

</html> -->



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/addAdvertisement.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ADD advertisement</title>
   </head>
<body>
<?php
      $role = "Coach";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>
      <section class="home">
  <div class="container">
    <div class="title">ADD advertisement</div>
<!--    
   
      <div class="upload">
        <button class=" btn">
          <i class="fa fa-upload"></i>Upload File
          <input type="file">
        </button>
      </div> -->
    
    <div class="content">
    <form action="<?php echo URLROOT; ?>/Advertisement/add_Advertisement" class="addform">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Coach Name</span>
            <input type="text" placeholder="Enter your name" required>
          </div>
         

          <div class="input-box">
            <span class="details">Advertisement Name</span>
            <input type="text" placeholder="Enter your number" required>
          </div>
         
         
          <div class="input-box">
            <span class="details">Date</span>
            <input type="text" placeholder="Confirm your Expeience" >
          </div>
          <div class="input-box">
            <!-- <span class="details">Speciality</span>
            <input type="text" placeholder="Enter your Speciality" required> -->
          </div>
          <div class="input-box " id="content">
            <span class="details">Content</span>
            <input type="text" placeholder="Enter your Certificates" required>
          </div>
          <div class="textbox">
            <label for="img">Post:</label><br>
            <input type="file" id="img" name="img" accept="image/*">
      </div>
        
        </div>
        
        <div class="button">
          <input type="submit" value="Publish" >
        </div>
        

        
      </form>
    </div>
  </div>
      </section>
</body>
</html>