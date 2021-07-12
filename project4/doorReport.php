
<?php 
    $page_heading = "Door Report: for Door People at Doors";
    require_once('header.php');
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $day;
    
    if (strpos($actual_link, 'friday') != false) {
        $day = 'friday';
    }
    
    if (strpos($actual_link, 'sunday') != false) {
        $day = 'sunday';
    }
    
    //echo '<br />' . $_GET['concert'];
    
    $query = 'select * from ' . $_GET['concert'];
    //echo '<br />' . $query;
    $result = mysqli_query($dbc, $query) or die('<br />Error querying database');
    //var_dump($result);
    

    echo '<table><tr><th>Name</th><th>#Adult</th><th>#Student</th><th>#Comp</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        if ($row[8] != 0 || $row[9] != 0 || $row[10] != 0) {
            echo '<tr>';
            echo '<td>' . $row[1] . ', ' . $row[2] . '</td>';
            echo '<td>' . $row[8] . '</td>';
            echo '<td>' . $row[9] . '</td>';
            echo '<td>' . $row[10] . '</td>';
            echo '</tr>'; 
        }
    }
    echo '</table>';
    
    echo '<br />' ;
    
    //-- getting the venue capacity
    //series number
    $string = $_GET['concert'];
    $pattern = '/[^\d+]/';
    $seriesNumber = preg_replace($pattern, '', $string);
    //echo $seriesNumber;
    
    $queryF = 'select venueId from concertSeries where id = "' . $seriesNumber . '"';
    $resultF = mysqli_query($dbc, $queryF) or die('<br />Error getting venue id');
    $rowF = mysqli_fetch_array($resultF);
    $venueId = $rowF[0];
    
    $queryG = "select capacity from venues where id = '" . $venueId . "'";
    $resultG = mysqli_query($dbc, $queryG) or die ('<br />error getting venue capacity');
    $rowG = mysqli_fetch_array($resultG);
    
    //var_dump($rowG);
    $capacity = $rowG[0];
    //echo '<br />' . $capacity;
    
    
    //--getting the presold tickets
    if ($day == 'friday') {
        $queryH = "select numAdFri, numStuFri, numComFri from " . $string;
    }
    
    if ($day == 'sunday') {
        $queryH = "select numAdSun, numStuSun, numComSun from " . $string;
    }
    
    $resultH = mysqli_query($dbc, $queryH) or die('error querying ticket counts');
    //var_dump($resultH);
    
    $count = array(0);
    while ($rowH = mysqli_fetch_array($resultH)) {
        array_push($count, intval($rowH[0]) ?: 0);
        array_push($count, intval($rowH[1]) ?: 0);
        array_push($count, intval($rowH[2]) ?: 0);
    }
    
    //var_dump($count);
    
    $presold = array_sum($count);
    //echo '<br />' . $presold . '<br />';
    
    //--get remaining seats
    $remaining = $capacity - $presold;  //$PRESOLD!!!
    
    echo 'Presold Tickets: ' . $presold;
    echo '<br />Seats Available for Door Sales: ' . $remaining;
    
?>
    <br /><br /><br /><br /><br />
    <a href="admin.php">Home</a>