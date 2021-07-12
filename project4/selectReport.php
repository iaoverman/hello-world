<?php
    $page_heading = "Ah. . . the Numbers!";
    require_once('header.php');
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    //--
    if (isset($_POST['summary']) && isset($_POST['toreport'])) {
        $report_id = $_POST['toreport'];
        $query = "select * FROM concertSeries WHERE id = $report_id";
        mysqli_query($dbc, $query) or die('Error querying database');
        header("Location: report.php?concert=" . $report_id);
        exit;
    } else if (isset($_POST['friday']) && isset($_POST['toreport'])) {
        $report_id = $_POST['toreport'];
        $query = "select * FROM concertSeries WHERE id = $report_id";
        mysqli_query($dbc, $query) or die('Error querying database');
        header("Location: doorReport.php?concert=friday" . $report_id);
        exit;
    } else if (isset($_POST['sunday']) && isset($_POST['toreport'])) {
        $report_id = $_POST['toreport'];
        $query = "select * FROM concertSeries WHERE id = $report_id";
        mysqli_query($dbc, $query) or die('Error querying database');
        header("Location: doorReport.php?concert=sunday" . $report_id);
        exit;
    }
    
    $query = "select * from concertSeries";
    $result = mysqli_query($dbc, $query);
    
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
    //create checkbox list of concerts
    while ($row = mysqli_fetch_array($result))
    {
        echo '<label><input type="radio" value="' . $row['id'] . '" name="toreport" />';
        echo $row['title'] . '</label>';
        echo '<br />';
    }
    
?>
        <br />
        <input type="submit" name="friday" value="Door Report - Friday" />
        <input type="submit" name="sunday" value="Door Report - Sunday" />
        <input type="submit" name="summary" value="Summary Report" />
    </form>
    
    
    <a href="admin.php">Home</a>   
<?php
    mysqli_close($dbc);
?>
