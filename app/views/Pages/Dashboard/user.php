<!-- <h1 style="left: 47vw; width: calc(100% - 47vw);position:fixed;padding-right: 4rem;">Welcome <?php echo $_SESSION['user_name'] ?></h1> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/landingStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />


</head>

<body>
    <!-- partial:index.partial.html -->
    <!-- <header id="header">
        <a href="#"><img src="<?php echo URLROOT;?>/images/logo.png" class="logo"></a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </header> -->
    <main>
        <Section>
            <div class="companyName">
                <h1>C&A<BR>INDOOR CRICKET NET</h1>
            </div>
            <div class="btnrow">
                <a href="#" class="btn">Explore</a>
            </div>
        </Section>

        <div class="sec">
            <div class="tagrow">
                <h2>ABOUT US</h2>
            </div>
            <hr>
            <div class="box">
                <div>
                    <h4>Business Hours</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class='lead'><strong>Day</strong></th>
                                <th scope="col" class='lead'><strong>Hour</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class='lead'>Sunday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Monday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Tuesday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Wednesday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Thursday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Friday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                            <tr>
                                <th scope="row" class='lead'>Saturday</th>
                                <td>7 a.m - 11 p.m</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mainbox">
                    <div class="parking">
                        <i class='bx bxs-car'></i>
                        <h3>Parking Available</h3>
                    </div><br>
                    <div>
                        <h4>Reservations have to be made through phone calls and to see the booking confirmations on the
                            calendar, please refresh the page</h4>
                    </div>
                    <br>
                    <div class="box2">
                        <div>
                            <h4>Available Bookings</h4>
                            <ul>
                                <li>Normal Booking</li>
                                <li>Recurring Booking (Daily, Weekly) </li>
                            </ul>
                        </div>
                        <div>
                            <h4>What you can get</h4>
                            <ul>
                                <li>Net Practice</li>
                                <li>Bowling Machine</li>
                                <li>Private Coaching</li>
                                <li>Baseball Practice</li>
                                <li>Buddy Cricket</li>
                                <li>Cricket Academy</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sec">
            <div class="tagrow">
                <h2>FIND US HERE</h2>
            </div>
            <div class="google-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.982584570147!2d79.92213817448265!3d6.892686118764102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25138514423cb%3A0x981f4120a1d021d1!2sC%26A%20Indoor%20Cricket%20Net!5e0!3m2!1sen!2slk!4v1698731444163!5m2!1sen!2slk"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="sec">
            <div class="tagrow">
                <h2>AVAILABLE DATES</h2>
            </div>

            <div class="box">
                <div class="calander">
                    <iframe
                        src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FColombo&showTitle=0&showDate=1&showPrint=0&showCalendars=0&mode=WEEK&src=Y2FpbmRvb3I0NEBnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4tZ2IubGsjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%2333B679&color=%230B8043"
                        frameBorder="0" scrolling="no" title='Bookings'></iframe>
                </div>
                <div class="mainbox2">
                    <div class="mainbox3">
                        <div class="box2">
                            <h3>A, B - Normal Net</h3>
                        </div>
                        <div class="box2">
                            <h3>C - Bowling Machine Net</h3>
                        </div>
                    </div>
                    <div class="mainbox3">
                        <div>
                            <h6>Use the event calender to get an idea of reserved dates Contact us to book a time and a
                                date at your convenience</h6>
                        </div>

                        <button class="btn">Contact Us</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="sec">
            <div class="tagrow">
                <h2>PRICING INFORMATION</h2>
            </div>

            <div class="box">
                <div class="box4">
                    <h3>Normal<br>Rs. 700 per hour</h3>
                </div>
                <div class="box4">
                    <h3>Machine Net without Operator<br>Rs. 1100 per hour</h3>
                </div>
                <div class="box4">
                    <h3>Machine Net Operator<br>Rs. 1200 per hour</h3>
                </div>
            </div>
        </div>

    </main>

    <footer>
        <div class="footer">
            <div class="tagrow">
                <h4>KEEP IN TOUCH</h4>
            </div>
            <div class="content">
                <div class="contentbox">
                    <i class='bx bxs-phone'></i>
                    <a href="tel:077-072-2933">077-072-2933</a>
                </div>
                <div class="contentbox">
                    <i class='bx bxs-envelope'></i>
                    <a href="mailto: caindoor44@gmail.com">caindoor44@gmail.com</a>
                </div>
                <div class="contentbox">
                    <i class='bx bxs-map-pin'></i>
                    <address>
                        Singhepura,<br>
                        Battaramulla, 10120,<br>
                        Sri Lanka.
                    </address>
                </div>
            </div>
        </div>

    </footer>
</body>

</html>

<?php
$role = "User";
require APPROOT . '/views/Pages/Dashboard/header.php';
require APPROOT . '/views/Components/Side Bars/sideBar.php';
?>
<?php require APPROOT . '/views/Pages/Dashboard/Footer.php'; ?>