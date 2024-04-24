<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coachcard.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/ComplaintDetails.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/notification.css">


</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "Admin";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <div class="carddiv">
            <div class="card">
                <img src="">
                <div class="hasini">
                    <div class="right-side">
                        <div class="topic-text">Compose your message to the user</div>
                        <form id="contact">
                            <div class="input-box">
                                <input type="text" id="name" name="name" placeholder="Enter your name" value="">
                            </div>
                            <div class="input-box">
                                <input type="text" id="email" name="email" placeholder="Enter your email" value="">
                            </div>


                            <div class="input-box" id="abc">
                                <textarea id="message" name="message" placeholder="Enter your Message here" value=""
                                    rows="6"></textarea>
                            </div>
                            <div class="button">
                                <input type="submit" id="send" name="send" value="Send Now">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            function closeModal() {
                modal.style.display = "none";
                location.reload();
            }

            $(document).ready(function () {
                $("#send").click(function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    var name = $("#name").val(); // Get the value of name input
                    var email = $("#email").val(); // Get the value of email input
                    var message = $("#message").val(); // Get the value of message textarea

                    console.log("Name:", name);
                    console.log("Email:", email);
                    console.log("Message:", message);

                    $.ajax({
                        url: "<?php echo URLROOT; ?>/Complaint/sendMsgEmail",
                        type: "POST",
                        data: {
                            name: name,
                            email: email,
                            message: message
                        },

                        success: function (response) {
                            console.log("Response:", response);
                            if (response.status == "success") {
                                // alert("Message sent successfully");
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Message sent successfully</h3><p class="notification_message">Thank you for your message</p></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 3000);
                                closeModal();
                            } else {
                                // alert("Failed to send message");
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Failed to send message</h3><p class="notification_message">Please try again later</p></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 3000);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("XHR:", xhr);
                            console.log("Status:", status);
                            console.log("Error:", error);
                            // alert("Failed to send message");
                            var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Fill all the fields</h3><p class="notification_message">Please try again later</p></div><div class="notification_progress"></div></div>');
                            $('body').append(notificationDiv);
                            setTimeout(function() {
                                notificationDiv.remove();
                            }, 3000);
                        }
                    });
                });
            });
        </script>


    </section>
</body>

</html>