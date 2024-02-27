<?php
class Model {
    public function getPlayersAndCoachesCount() {
        $link = mysqli_connect("localhost", "root", "", "c&a_indoor_net");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $result = array();

        $res_coaches = mysqli_query($link, "SELECT COUNT(*) AS coach_count FROM coaches");
        $row_coaches = mysqli_fetch_assoc($res_coaches);
        $coach_count = $row_coaches['coach_count'];

        $res_total_users = mysqli_query($link, "SELECT COUNT(*) AS total_user_count FROM user");
        $row_total_users = mysqli_fetch_assoc($res_total_users);
        $total_user_count = $row_total_users['total_user_count'];

        $player_count = $total_user_count - $coach_count;

        $result['players'] = $player_count;
        $result['coaches'] = $coach_count;

        mysqli_close($link);

        return $result;
    }
}
?>
