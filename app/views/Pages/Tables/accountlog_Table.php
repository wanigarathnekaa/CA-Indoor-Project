<?php

$filter_date = date('Y-m-d'); 
$new_data = array_filter($data['logs'], function ($item) use ($filter_date) {
    $last_login_date = substr($item->last_login, 0, 10);     // get only the date 
    return $last_login_date === $filter_date; 
});

?>

<html>

<head>
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Accountlog.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>


    <div class="recentOrders">
    <div class="cardHeader">
        <!-- date -->
        <h2>
                <?php echo date('Y-m-d'); ?>
            </h2>
    <h2>User Account Logs</h2>
    </div>


        <div class="table-container">
            <table>
                <!-- table header -->
                <thead>
                    <tr style="text-align: center;">
                    
                        <td>Name</td>
                        <td class="left-align">Email </td>
                        <td>Creation Date</td>
                        <td>Last-login</td>
                        <td>Last-logout</td>

                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
            <?php if (empty($new_data)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: red;" >No users logged in today.</td>
                </tr>
           <?php else: ?>
            
           <?php foreach ($new_data as $log): 
             
                 $status_color = '';
                 $status_colorr = '';

                 
                if (!empty($log->last_login) || !empty($log->last_logout)) {
                    $status_color = '#30c030'; // Green
                    $status_colorr = '#e03333'; // Red
                }
                
                  
             ?>                     

    <tr onclick="openLogPopup(<?php echo htmlspecialchars(json_encode($log));?>)" style="text-align: center;">
    <td><?php echo $log->user_name; ?></td>
    <td class="left-align"><?php echo $log->email; ?></td>
    <td><?php echo date('Y-m-d', strtotime($log->create_date)); ?></td>
    <td><span class="status" style="background-color: <?php echo $status_color; ?>;"><?php echo $log->last_login ?></span></td>
    <td><span class="status" style="background-color: <?php echo $status_colorr; ?>;"><?php echo $log->last_logout ?></span></td>
    <!-- <td><button onclick="viewCustomer()">View Customer</button></td> -->

</tr>
<?php endforeach; ?>
<?php endif; ?>

</tbody>
</table>
</div>
</div>

<!-- Popup message -->
<div class="popupcontainer" id="popupcontainer">
    <div class="popup" id="popup">
        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
        <h2>User Log</h2>
        <hr>
        <div class="popupdetails">
            <div class="popupdetail">
                <h2><b>User ID :</b> <span class="l_id"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>User Name :</b> <span class="l_name"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Creation Date :</b> <span class="l_date"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Last LOGIN Time :</b> <span class="l_last_login"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Last LOGOUT Time :</b> <span class="l_last_logout"></span></h2>
            </div>
        </div>
    </div>
</div>



    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/popup.js"></script>
    

</body>

</html>