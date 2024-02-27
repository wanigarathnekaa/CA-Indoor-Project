<!doctype html>

<html>
<head>
<title>Reports in PHP</title>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
</head>
<body>
<div class="container">
<div class="wrapper">
<h1>Reservations of Users</h1>
</div>
<div class="data">
<form action="<?php echo URLROOT; ?>/Reports/view2" method="POST">
<select name="date">
<option>Select Date</option>
<?php foreach ($data["reservations"] as $reservations): ?>

<option><?php echo $reservations->date?></option>
<?php endforeach; ?>

</select>

<select name="user_name">
<option>Select User</option>
<?php foreach ($data["usernames"] as $usernames): ?>

<option><?php echo $usernames->name?></option>
<?php endforeach; ?>

</select>
<input type="submit" name="submit" class="submit"/>
</form>
<div class="table-container">
                  <table id="coachTable">
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Net type</th>
                                    <!-- <th>No.of reservations</th> -->
                                    
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                                    <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <!-- <td></td> -->

                                          
                                    </tr>
                                    
                        </tbody>
                  </table>
            </div>


  

</div>
</div>
</body>
</html>
 

 


</html>
