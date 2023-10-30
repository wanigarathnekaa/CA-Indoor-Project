<?php
    $role = "User";
    require APPROOT.'/views/Pages/Dashboard/header.php';
    require APPROOT.'/views/Components/Side Bars/sideBar.php';
?>
    <h1 style="left: 47vw; width: calc(100% - 47vw);position:fixed;padding-right: 4rem;">Welcome <?php echo $_SESSION['user_name'] ?></h1>
    <div class="topic">
        <h1>C & A INDOOR CRICKET NET</h1>
        <h2>Nobody goes undefeated all the time. If you can 
            <br>pickup after a crushing defeat, and go on to win 
            <br>again, you are going to be a champion someday!!!
            <br><center>Kumar Sangakkara</center>
        </h2>
    </div>
    
<?php require APPROOT.'/views/Pages/Dashboard/Footer.php'; ?>
