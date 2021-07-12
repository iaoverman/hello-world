<!-- header -->

<?php
    $page_heading ="Add a new performance venue.";
    require_once('header.php');

?>

    
<?php
    //require_once('concertForm.php');
    require_once('connectvars.php');
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    
    if (isset($_POST['submit'])) {
        //return confirmation info -->
        if ($error != 'none') {
            echo 'Query error: ' + $error + '<br />';
        } else {
            echo 'Success! Venue Added<br />';
        }
        
        //ALL the Variables!
        $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        $location = mysqli_real_escape_string($dbc, trim($_POST['location']));
        $capacity = mysqli_real_escape_string($dbc, trim($_POST['capacity']));    
        $contact = mysqli_real_escape_string($dbc, trim($_POST['contact']));
        $notes = mysqli_real_escape_string($dbc, trim($_POST['notes']));
        $isActive = mysqli_real_escape_string($dbc, trim($_POST['isActive'])); 
        $error = 'none';
        
        //insert statements -->    
        $query = "insert into venues (name, location, capacity, contact, note, isActive)" .
                " values ('" . $name . "', '" . $location . "', '" . $capacity . "', '" .
                $contact . "', '" . $notes . "', '". $isActive ."')";      //    */
        //echo $query . '<br />';
        mysqli_query($dbc, $query) or die('Error inserting venue.');

        mysqli_close($dbc);
    }
 
    
?>

    <!-- new venue form -->
        <!--//get info -->
    <form id="venue" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <label for="name">Venue Name</label>
            <input type="text" name="name" /><br />
            
            <label for="location">Address</label>
            <input type="text" name="location" /><br />
            
            <label for="capacity">Capacity</label>
            <input type="text" name="capacity" /><br />
            
            <label for="contact">Contact</label>
            <input type="textarea" name="contact" /><br />
            
            <label for="notes">Notes</label>
            <input type="textarea" name="notes" /><br />
            
            <label for="isActive">Are you actively using this venue?</label><br />
            <input type="radio" name="isActive" value="1" />Yes
            <input type="radio" name="isActive" value="0" />No<br />
            
        </fieldset>
        <br />
        <input type="submit" value="Submit New Venue" name="submit" />
    </form>
    
    <a href="admin.php">Home</a><span class="spacer"></span>
    <a href="deleteVenue.php">Delete a Venue</a>
    


<!-- footer -->
<?php
    require_once('footer.php');
?>