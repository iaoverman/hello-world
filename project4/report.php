
<?php 
    $page_heading = "Oh, what beautiful numbers";
    require_once('header.php');
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    $query = 'select * from concertSeries where id = ' . $_GET['concert'];
    
    //echo '<br />' . $query;
    $result = mysqli_query($dbc, $query) or die('Error querying database');
    //var_dump($result);
    $row = mysqli_fetch_array($result);
    
    
    $queryF = "select * from friday" . $_GET['concert'];
    $resultF = mysqli_query($dbc, $queryF) or die ('query error F');
    //$rowF = mysqli_fetch_array($resultF);
    //var_dump($rowF);
    
    $queryS = "select * from sunday" . $_GET['concert'];
    $resultS = mysqli_query($dbc, $queryS) or die('error query F');
    //$rowS = mysqli_fetch_array($resultS);
    //var_dump($rowS);
    
    $friAd = array(0);
    $friStu = array(0);
    $friComp = array(0);
    $sunAd = array(0);
    $sunStu = array(0);
    $sunComp = array(0);
    $totalAd = array(0);
    $totalStu = array(0);
    $totalComp = array(0);
    $totalAll = array(0);
    
    while ($rowF = mysqli_fetch_array($resultF)) {
        array_push($friAd, intval($rowF[8]) ?: 0);
        array_push($friStu, intval($rowF[9]) ?: 0);
        array_push($friComp, intval($rowF[10]) ?: 0);
    }
    
    while ($rowS = mysqli_fetch_array($resultS)) {
        array_push($sunAd, intval($rowS[8]) ?: 0);
        array_push($sunStu, intval($rowS[9]) ?: 0);
        array_push($sunComp, intval($rowS[10]) ?: 0);
    }
    
    $totalAd = array_merge($friAd, $sunAd);
    $totalStu = array_merge($friStu, $sunStu);
    $totalComp = array_merge($friComp, $sunComp);
    
    $totalAll = array_merge($totalAd, $totalStu, $totalComp);
    
    
    echo '<br />Total Presold Tickets: ' . array_sum($totalAll);
    echo '<br />';
    echo '<br />Friday Presold Adult: ' . array_sum($friAd);
    echo '<br />Friday Presold Student: ' . array_sum($friStu);
    echo '<br />Friday Presold Comp: ' . array_sum($friComp);
    echo '<br />';
    echo '<br />Sunday Presold Adult: ' . array_sum($sunAd);
    echo '<br />Sunday Presold Student: ' . array_sum($sunStu);
    echo '<br />Sunday Presold Comp: ' . array_sum($sunComp);
    echo '<br />';
    echo '<br />Total Presold Adult: ' . array_sum($totalAd);
    echo '<br />Total Presold Student: ' . array_sum($totalStu);
    echo '<br />Total Presold Comp: ' . array_sum($totalComp);
    
    //var_dump($totalAll);
    
    
?>