<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <h1>This is about the view.</h1>
    <!-- <h2>Hello, <?php echo $data['userName']?></h2> -->
    <h1>Users</h1>
    <?php foreach($data['users'] as $user):?>
        <h3><?php echo "{$user->name} - {$user->email} - {$user->age}"?></h3>
    <?php endforeach;?>
</body>
</html>