<!DOCTYPE html>
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

</html>