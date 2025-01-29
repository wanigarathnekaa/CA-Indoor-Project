<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/DeleteProfile.css">

<body>
    <div class="box">
        <div class="text">
            Are you sure you want to delete your account ?
        </div>
        <form action="<?php echo URLROOT;?>/Coach/delete" method="POST">            
            <div class="buttons">
                <button type="submit" class="button">Delete</button>
                <button class="button">Cancel</button>
            </div>
            <input hidden name='submit' value="<?=$data->email;?>">
        </>

    </div>
</body>

</html>