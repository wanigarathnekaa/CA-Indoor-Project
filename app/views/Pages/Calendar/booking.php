<?php
if(isset($_GET['date'])) {
    $date = $_GET['date'];
}

$duration = 60;
$cleanup = 0;
$start = "07:00";
$end = "22:00";
function time_slot($duration, $cleanup, $start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart < $end; $intStart->add($interval)) {
        $endPeriod = clone $intStart;
        // echo $endPeriod->format("H:iA");
        $endPeriod->add($interval);
        // echo $endPeriod->format("H:iA");

        if($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
    }

    return $slots;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <title>Booking</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Book on Date:
            <?php echo date('m/d/Y', strtotime(date("Y/m/d"))); ?>
        </h1>
        <hr>
        <div class="row">
            <h1>Normal Net A</h1>
            <?php $timeslots = time_slot($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts) {
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success">
                            <?php echo $ts; ?>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row">
            <h1>Normal Net B</h1>
            <?php $timeslots = time_slot($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts) {
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success">
                            <?php echo $ts; ?>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row">
            <h1>Machine Net</h1>
            <?php $timeslots = time_slot($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts) {
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success">
                            <?php echo $ts; ?>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>