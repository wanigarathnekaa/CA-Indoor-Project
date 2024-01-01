<!-- <h1 style="left: 47vw; width: calc(100% - 47vw);position:fixed;padding-right: 4rem;">Welcome <?php echo $_SESSION['user_name'] ?></h1> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/landingStyle.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/sideBar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />


</head>

<body>
    <?php
    $role = "User";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <section class="home">
        <div class="sec-landing">
            <div class="companyName">
                <h1>C&A<BR>INDOOR CRICKET NET</h1>
            </div>
            <div class="btnrow">
                <a href="#" class="btn">Explore</a>
            </div>
        </div>

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



<!-- </body>

</html> -->


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
            <?php
function build_calendar($month, $year)
{
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));

    $calendar = "<center><h2 class='date'>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . $prev_month . "&year=" . $prev_year . "' target='_self'_>Prev Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender'>Current Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . $next_month . "&year=" . $next_year . "'>NextMonth</a></center> ";

    $calendar .= "<br><table class='calander'> ";
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $calendar .= "</tr><tr>";
    $currentDay = 1;
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    // echo "Today's date: $dateToday";
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayName = strtolower(date('l', strtotime($date)));
        $today = ($date == $dateToday) ? 'today' : '';

        if ($date < date('Y-m-d')) {
            $calendar .= "<a class = 'btn btn-danger btn-xs'><td class='$today'><h4>$currentDay</h4></td></a>";
        }
        else {
            // $calendar .= "<td class='$today'><h4>$currentDay</h4><a href='http://localhost/C&A_Indoor_Project/Pages/Booking/user' class = 'btn btn-success btn-xs' target='_top'>Book</a></td>";
            $calendar .= "<td class='$today'><a href='http://localhost/C&A_Indoor_Project/Pages/Booking/user?fulldate=$date' class = 'btn btn-success btn-xs' target='_top'><h4>$currentDay</h4></a></td>";
        }
        // echo $today;
 

        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek < 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr></table>";

    return $calendar;
}

?>

<!-- <html> -->

<head>
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/calander_style.css">
</head>

<!-- <body> -->
    <div class="calander-container">
                <?php
                $dateComponent = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponent['mon'];
                    $year = $dateComponent['year'];
                }

                echo build_calendar($month, $year);
                ?>
    </div>

            <div class="box">
                <!-- <div class="calander">
                    <iframe
                        src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FColombo&showTitle=0&showDate=1&showPrint=0&showCalendars=0&mode=WEEK&src=Y2FpbmRvb3I0NEBnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4tZ2IubGsjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%2333B679&color=%230B8043"
                        frameBorder="0" scrolling="no" title='Bookings'></iframe>
                </div> -->
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

        <div class="tagrow">
                <h2>ADVERTISEMENT</h2>
            </div>
            <div class="wrapper">
      
      

      
      <i id="left" class="fa-solid fa-angle-left"></i>
      <ul class="carousel">
        <li class="card">

          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad3.jpg" /></div>
          <h2>Practice Session</h2>
          <span>Coach Bhanuka</span>
          
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>



        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad1.jpeg" /></div>
          <h2>Interactive Workshop</h2>
          <span>Coach Lasantha</span>
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>
        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" /></div>
          <h2>Team approach</h2>
          <span>Coach Kasun</span>
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>       </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" /></div>
          <h2>Individual learning</h2>
          <span>Coach Shantha</span>
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>
        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad1.jpeg" /></div>
          <h2>Team approach</h2>
          <span>Coach Shantha</span>
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>
        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad3.jpg" /></div>
          <h2>Individual learning</h2>
          <span>Coach Shantha</span>
          <div >
              <a  class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
              </a>
        </div>
        </li>
      </ul>

      <i id="right" class="fa-solid fa-angle-right"></i>

    </div>
    <script  src="<?php echo URLROOT; ?>/js/advertisment.js"></script>

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
    </section>
        

        

    <!-- side bar -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
</body>
</html>


