<?php
$coach_email = isset($_GET['email']) ? urldecode($_GET['email']) : "No_Gmail";
$coachUser = array_filter($data, function ($data) use ($coach_email) {
      return $data->email === $coach_email;
});
$coach = array_filter($data1, function ($data1) use ($coach_email) {
      return $data1->email === $coach_email;
});

$coach = array_values($coach);
$coachUser = array_values($coachUser);
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coachcard.css">
</head>

<body>
      <div class="card">
            <img src="<?php echo URLROOT; ?>/images/image2.jpg" />
            <div>
                  <h2><?php echo $coachUser[0]->name;?></h2>
                  <div class="details">
                        <div class="infor"><b>Email</b> : <?php echo $coach_email;?></div>
                        <div class="infor"><b>Mobile Number</b> : <?php echo $coachUser[0]->phoneNumber;?></div>
                        <div class="infor"><b>Experience</b> : <?php echo $coach[0]->experience;?> year experience in coaching</div>
                        <div class="infor"><b>Specialities</b> : <?php echo $coach[0]->specialty;?></div>
                        <div class="infor"><b>Certificate</b> : <?php echo $coach[0]->certificate;?> cricket coach</div>
                  </div>
            </div>
      </div>
</body>

</html>