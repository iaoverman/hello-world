
<?php
    $page_heading = "This is where you delete venues";
    require_once('header.php');
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    //--delete as selected on submit
    if (isset($_POST['submit']) && isset($_POST['todelete'])) {
        foreach ($_POST['todelete'] as $delete_id){
            $query = "DELETE FROM venues WHERE id = $delete_id";
            mysqli_query($dbc, $query)
                    or die('Error querying database.');
        }
        echo 'Venue(s) removed.';
    }
    
    $query = "select * from venues order by isActive desc";
    $result = mysqli_query($dbc, $query);
    mysqli_close($dbc);
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
    //create checkbox list of concerts
    while ($row = mysqli_fetch_array($result))
    {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
        echo $row['name'];
        echo ' - ' . $row['location'];
        echo '<br />';
    }
    
?>
        <input type="submit" name="submit" value="Confirm" 
                onclick="return confirm('Are you sure?\nSelecting OK will delete this venue(s) and any corresponding data.')" />
    </form>
    
    <a href="admin.php">Home</a><span class="spacer"></span> 
    <a href="newVenue.php">New Venue</a>
<?php
    require_once('footer.php');
?>