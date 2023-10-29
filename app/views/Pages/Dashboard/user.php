<?php
    $role = "User";
    require APPROOT.'/views/Pages/Dashboard/header.php';
    require APPROOT.'/views/Components/Side Bars/sideBar.php';
?>
    <h1 style="left: 47vw; width: calc(100% - 47vw);position:fixed;padding-right: 4rem;">Welcome <?php echo $_SESSION['user_name'] ?></h1>
<?php require APPROOT.'/views/Pages/Dashboard/Footer.php'; ?>
