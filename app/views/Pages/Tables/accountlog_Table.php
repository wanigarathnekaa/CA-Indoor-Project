<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/accountlog_Table.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<section class="taable">
  <!--for demo wrap-->
  <h1>User Activity Log</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Last-login</th>
          <th>Last-logout</th>
          <th><b>Creation Date</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
      <?php foreach ($logs as $log): ?>
      <tr>
        <td><?php echo $log->user_name; ?></td>
        <td><?php echo $log->email; ?></td>
        <td><?php echo $log->create_date; ?></td>
        <td><?php echo $log->last_login; ?></td>
        <td><?php echo $log->last_logout; ?></td>
        <!-- Add other table columns as needed -->
      </tr>
<?php endforeach; ?>



      </tbody>
    </table>
  </div>
</section>


<!-- follow me template -->
<div class="made-with-love">
 
</div>
</body>
</html>
