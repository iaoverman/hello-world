<!-- header -->
<?php
    $page_heading ="Salutations! Here's where you make a concert!";
    require_once('header.php');

?>
    
    
<?php
    
    require_once('connectvars.php');
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    
    $query4 = "select * from venues where isActive = 1";
    $result4 = mysqli_query($dbc, $query4) or die('error query 4');
    $options = "";

    while ($row4 = mysqli_fetch_array($result4)) {
        $options .= '<option value=' . $row4['id'] . '>' . $row4['name'] . ' - ' . $row4['location'] . '</option>';
    }

    
    if (isset($_POST['submit'])) {
        //ALL the Variables!
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $date1 = mysqli_real_escape_string($dbc, trim($_POST['date1']));
        $time1 = mysqli_real_escape_string($dbc, trim($_POST['time1']));    
        $venue1 = $_POST['venue1'];
        $adult = mysqli_real_escape_string($dbc, trim($_POST['adult1']));
        $student = mysqli_real_escape_string($dbc, trim($_POST['student1']));
        $date2 = mysqli_real_escape_string($dbc, trim($_POST['date2']));
        $time2 = mysqli_real_escape_string($dbc, trim($_POST['time2']));    
        $venue2 = $_POST['venue2'];
        $adult2 = mysqli_real_escape_string($dbc, trim($_POST['adult']));
        $student2 = mysqli_real_escape_string($dbc, trim($_POST['student']));
        
        $error = 'none';
        
     
        
        //insert into series THIS QUERY ISN'T FlippING WORKING    also you didn't do any deactivating-->    
        $query = "insert into concertSeries (title, venueId, venueId2, adultPrice, studentPrice, " .
                "adultPriceSun, studentPriceSun, friDate, friTime, sunDate, sunTime, isActive)" .
                " values ('" . $title . "', '" . $venue1 . "', '" . $venue2 . "', " .
                $adult . ", " . $student . ", " . $adult2 . ", " . $student2 . ", '" . $date1 . "', '" . $time1  . 
                "', '" . $date2 . "', '" . $time2 . "', 1)";      

        mysqli_query($dbc, $query) or die('Error inserting concert.');
        
        //get id
        $queryId = "select id from concertSeries where title = '" .
                $title . "' limit 1";

        $resultId = mysqli_query($dbc, $queryId) or die('<br />error query for this id');
        $rowId = mysqli_fetch_array($resultId);
        $id = $rowId[0];

        
        //create friday table
        $query2 = "create table friday" . $id . " (id int primary key auto_increment, " .
                "firstName varchar(30), lastName varchar(40), address varchar(50), " .
                "city varchar(25), state varchar(2), zip int(5), email varchar(50), " .
                "numAdFri int, numStuFri int, numComFri int, payment varchar(15), notes varchar(20))";  
        mysqli_query($dbc, $query2) or $error = 'Error creating new friday table.';        
        
        //create sunday table     
        $query3 = "create table sunday" . $id . " (id int primary key auto_increment, " .
                "firstName varchar(30), lastName varchar(40), address varchar(50), " .
                "city varchar(25), state varchar(2), zip int(5), email varchar(50), " .
                "numAdSun int, numStuSun int, numComSun int, payment varchar(15), notes varchar(20))";  
        mysqli_query($dbc, $query3) or $error = 'Error creating new sunday table.';
        
        
        
        mysqli_close($dbc);
        
        //return confirmation info -->
        if ($error != 'none') {
            echo 'Query error: ' + $error;
        } else {
            echo 'Success! Concert Added<br />';
        }
        
    }
 
?>
    <!-- new concert series form -->
        <!--//get info -->
    <form id="concert" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset id="concertfieldset">
            <span id="concertitle">
            <label for="title">Concert Series Title</label>
            <input type="text" name="title" /><br /></span>
            <span id="friday">
            <label>Friday</label><br />
            <label for="date1">Date</label>
            <input type="text" name="date1" /><br />
            <label for="time1">Time</label>
            <input type="text" name="time1" /><br />
            <label for="venue1">Venue</label>
            <select name="venue1">
                <?php echo $options; ?>
            </select><br />
            
            <label for="adult1">Price of Adult Ticket</label>
            <input type="text" name="adult1" /><br />
            <label for="student1">Price of Student Ticket</label>
            <input type="text" name="student1" /><br /></span>
            <br />
            <span id="sunday">
            <label>Sunday</label><br />
            <label for="date2">Date</label>
            <input type="text" name="date2" /><br />
            <label for="time2">Time</label>
            <input type="text" name="time2" /><br />
            <label for="venue2">Venue</label>
            <select name="venue2">
                <?php echo $options; ?>
            </select><br /><br />
            
            <label for="adult">Price of Adult Ticket</label>
            <input type="text" name="adult" /><br />
            <label for="student">Price of Student Ticket</label>
            <input type="text" name="student" /><br /></span>
        </fieldset>
        <br />
        <input type="submit" value="Submit New Concert" name="submit" />
    </form>

    
    <a href="admin.php">Home</a><span class="spacer"></span>
    <a href="deleteConcert.php">Delete a Concert</a>
    


<!-- footer -->
<?php
    require_once('footer.php');
?>