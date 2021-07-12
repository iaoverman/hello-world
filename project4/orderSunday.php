
    
<?php 
    $page_heading = "Tickets for Sunday's Concert";
    require_once('header.php');
    require_once('connectvars.php');
    require_once('formCustomer.php');
    require_once('formFriday.php');
    require_once('formSunday.php');
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME) 
            or die ('Error connecting to database.');
    $query = "select * from concertSeries where isActive = 1";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $concertId = $row['id'];
    //echo $id;

    $adultPrice = $row[5];
    $studentPrice = $row[6];        
    
    $order = new SundayForm();
    

    
    if (isset($_POST['submit'])) {
        
        require_once('confirm.php');

        $order->setFirstName($_POST['fname']);
        $order->setLastName($_POST['lname']);
        $order->setAddress($_POST['address']);
        $order->setCity($_POST['city']);
        $order->setState($_POST['state']);
        $order->setZip($_POST['zip']);
        $order->setEmail($_POST['email']);
        
        $order->setAdultTix($_POST['adultF']);
        $order->setStudentTix($_POST['studentF']);

        $queryB = $order->query($concertId);
        //echo $queryB;
        
        $result2 = mysqli_query($dbc, $queryB) or die('error processing order');
        
        //var_dump($result2);
        
        //echo '<br />Yay you ordered Tickets! sort of. hopefully...<br />';
        
        
    }
    
    $order->display1();
    echo '</fieldset><br />';
    $order->display($adultPrice, $studentPrice);
    echo '</fieldset><br />';
    echo '<br /><input type="submit" value="Sumbit Order" name="submit" /><br />';
    echo '</form>';
    
    require_once('footer.php');
        
        
   
    
    
?>