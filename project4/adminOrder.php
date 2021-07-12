
    
<?php 
    $page_heading = "Purchase Tickets";
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
    
    $friOrder = new FridayForm();
    $sunOrder = new SundayForm();
    
    

    if (isset($_POST['submit'])) {
        
        require_once('confirm.php');
        
        $friOrder->setFirstName($_POST['fname']);
        $friOrder->setLastName($_POST['lname']);
        $friOrder->setAddress($_POST['address']);
        $friOrder->setCity($_POST['city']);
        $friOrder->setState($_POST['state']);
        $friOrder->setZip($_POST['zip']);
        $friOrder->setEmail($_POST['email']);
        
        $friOrder->setAdultTix($_POST['adultF']);
        $friOrder->setStudentTix($_POST['studentF']);
        $friOrder->setCompTix($_POST['compF']);
        
        $sunOrder->setFirstName($_POST['fname']);
        $sunOrder->setLastName($_POST['lname']);
        $sunOrder->setAddress($_POST['address']);
        $sunOrder->setCity($_POST['city']);
        $sunOrder->setState($_POST['state']);
        $sunOrder->setZip($_POST['zip']);
        $sunOrder->setEmail($_POST['email']);
        
        $sunOrder->setAdultTix($_POST['adultS']);
        $sunOrder->setStudentTix($_POST['studentS']);
        $sunOrder->setCompTix($_POST['compS']);
        
        $payment = $_POST['payment'];
        
        
        $queryB = "insert into friday" . $concertId . " (firstName, lastName, address, " . 
                "city, state, zip, email, payment, numAdFri, numStuFri, numComFri) values ('" . 
                $friOrder->getFirstName() . "', '" .
                $friOrder->getLastName() . "', '" . $friOrder->getAddress() . "', '" . 
                $friOrder->getCity() . "', '" . $friOrder->getState() .
                "', " . $friOrder->getZip() . ", '" . $friOrder->getEmail() . "', '" . $payment ."', " . 
                $friOrder->getAdultTix() . ", " . $friOrder->getStudentTix() . ", " . $friOrder->getCompTix() . ")";
        
        //echo $queryB;
    
        
        $result2 = mysqli_query($dbc, $queryB) or die('<br />error processing order- query b');
        
        
        $queryC = "insert into sunday" . $concertId . " (firstName, lastName, address, " . 
                "city, state, zip, email, payment, numAdSun, numStuSun, numComSun) values ('" . 
                $sunOrder->getFirstName() . "', '" .
                $sunOrder->getLastName() . "', '" . $sunOrder->getAddress() . "', '" . 
                $sunOrder->getCity() . "', '" . $sunOrder->getState() .
                "', " . $sunOrder->getZip() . ", '" . $sunOrder->getEmail() . "', '" . $payment ."', " . 
                $sunOrder->getAdultTix() . ", " . $sunOrder->getStudentTix() . ", " . $sunOrder->getCompTix() . ")";
       
       // echo $queryC;
        $result3 = mysqli_query($dbc, $queryC) or die('<br />error processing order- query c');
        
    }

    $friOrder->display1();
    echo '</fieldset><br />';
    $friOrder->display($adultPrice, $studentPrice);
    echo '<label for="compF">Number of Comp Tickets</label>
            <input type="number" name="compF" min="0" defaultValue="0" />';
    echo '</fieldset><br />';
    $sunOrder->display($adultPriceS, $studentPriceS);
    echo '<label for="compS">Number of Comp Tickets</label>
            <input type="number" name="compS" min="0" defaultValue="0" />';
    echo '</fieldset><br />';
?>
    <label>Card</label>
    <input type="radio" value="Card" name="payment" /> 
    <label>Cash</label>
    <input type="radio" value="Cash" name="payment" /> 
    <label>Check</label>
    <input type="radio" value="Check" name="payment" /> <br />
    <!--<input type="textarea" name="notes" />-->
    </fieldset>
    <br /><input type="submit" value="Sumbit Order" name="submit" /><br />
    </form>
<?php
    echo '</fieldset>';
    echo '</form>';
        
    require_once('footer.php');
?>