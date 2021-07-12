
<?php
    $page_heading = "This is where concerts come to die.";
    require_once('header.php');
    require_once('connectvars.php');
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    //--delete as selected on submit
    if (isset($_POST['submit']) && isset($_POST['todelete'])) {
        foreach ($_POST['todelete'] as $delete_id){
            $query = "DELETE FROM concertSeries WHERE id = $delete_id";
            mysqli_query($dbc, $query)
                    or die('Error querying database.');
            $query2 = "drop table friday" . $delete_id;
            mysqli_query($dbc, $query)
                    or die('Error deleting friday table.');
            $query3 = "drop table sunday" . $delete_id;
            mysqli_query($dbc, $query)
                    or die('Error deleting sunday table.');
        }
        echo 'Concert(s) removed.';
    }
    
    //--deactivate as selected on submit
    if (isset($_POST['deactivate']) && isset($_POST['todelete'])) {
        foreach ($_POST['todelete'] as $delete_id){
            $query = "update concertSeries set isActive = 0 WHERE id = $delete_id";
            mysqli_query($dbc, $query)
                    or die('Error querying database.');
            
        }
        echo 'Concert(s) deactivated.';
    }
    
    $query = "select * from concertSeries";
    $result = mysqli_query($dbc, $query);
    mysqli_close($dbc);
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
    //create checkbox list of concerts
    while ($row = mysqli_fetch_array($result))
    {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
        echo $row['title'];
        echo '<br />';
    }
    
?>
        <input type="submit" name="submit" value="Delete" 
                onclick="return confirm('Are you sure?\nSelecting OK will delete this concert(s) and any corresponding data.')" />
        <input type="submit" name="deactivate" value="Deactivate" />
    </form>
    
    <a href="admin.php">Home</a><span class="spacer"></span>
    <a href="newConcert.php">New Concert</a>
<?php
    require_once('footer.php');
?>