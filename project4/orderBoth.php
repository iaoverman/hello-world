
    
<?php 
    $page_heading = "Tickets for Friday's and Saturday's Concerts";
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
    $adultPrice = $row[3];
    $studentPrice = $row[4];
    $adultPriceS = $row[5];
    $studentPriceS = $row[6];
    
    $order = new FridayForm();
    $sunOrder = new SundayForm();
    
    
    

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
        
        $sunOrder->setFirstName($_POST['fname']);
        $sunOrder->setLastName($_POST['lname']);
        $sunOrder->setAddress($_POST['address']);
        $sunOrder->setCity($_POST['city']);
        $sunOrder->setState($_POST['state']);
        $sunOrder->setZip($_POST['zip']);
        $sunOrder->setEmail($_POST['email']);
        
        $sunOrder->setAdultTix($_POST['adultS']);
        $sunOrder->setStudentTix($_POST['studentS']);
        

        $queryB = "insert into friday" . $concertId . " (firstName, lastName, address, " . 
                "city, state, zip, email, payment, numAdFri, numStuFri) values ('" . 
                $order->getFirstName() . "', '" .
                $order->getLastName() . "', '" . $order->getAddress() . "', '" . 
                $order->getCity() . "', '" . $order->getState() .
                "', " . $order->getZip() . ", '" . $order->getEmail() . "', 'credit card', " . 
                $order->getAdultTix() . ", " . $order->getStudentTix() . ")";
        

        $result2 = mysqli_query($dbc, $queryB) or die('error processing order- query b');
        
        //var_dump($result2);
        
        
        $queryC = "insert into sunday" . $concertId . " (firstName, lastName, address, " . 
                "city, state, zip, email, payment, numAdSun, numStuSun) values ('" . 
                $sunOrder->getFirstName() . "', '" .
                $sunOrder->getLastName() . "', '" . $sunOrder->getAddress() . "', '" . 
                $sunOrder->getCity() . "', '" . $sunOrder->getState() .
                "', " . $sunOrder->getZip() . ", '" . $sunOrder->getEmail() . "', 'credit card', " . 
                $sunOrder->getAdultTix() . ", " . $sunOrder->getStudentTix() . ")";
       
        $result3 = mysqli_query($dbc, $queryC) or die('error processing order- query c');
        
        //require_once('confirm.php');
        //echo '<br />Yay you ordered Tickets! sort of. hopefully...<br />';
    }

    $order->display1();
    echo '</fieldset><br />';
    $order->display($adultPrice, $studentPrice);
    echo '</fieldset><br />';
    $sunOrder->display($adultPriceS, $studentPriceS);
    echo '</fieldset><br />';
    echo '<br /><input type="submit" value="Sumbit Order" name="submit" /><br />';
    echo '</form>';
        
    require_once('footer.php');
    
    
?>