
<?php 
    $page_heading = "Purchase Tickets for Isthmus Vocal Ensemble's Concerts!";
    require_once('header.php');
    
?>
    <article id="index">
        Next Concerts: 
        <ul>
            <li><a href="https://www.isthmusvocalensemble.org/upcoming-performances">Friday, August 2, 2019 7:00 pm</a></li>
            <li><a href="https://www.isthmusvocalensemble.org/upcoming-performances">Sunday, August 4, 2019 3:00 pm</a></li>
        </ul>
    </article>
<?php
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


    if (isset($_POST['friday']))  {
        header("Location: orderFriday.php");
    } elseif (isset($_POST['sunday'])) {
        header("Location: orderSunday.php");
    } elseif (isset($_POST['both'])) {
        header("Location: orderBoth.php");
    } else {
        ?>
        <form method="post" id="index">
            <input type="submit" value="Get Tickets for Friday" name="friday" />
            
            <input type="submit" value="Get Tickets for Sunday" name="sunday" />
            
            <input type="submit" value="Get Tickets for Both" name="both" />
        </form>
        <?php
    }
     
    ?>
    </main>
    </body>
    <footer>
    <p>
        
        <a href=https://www.isthmusvocalensemble.org/ target="summat">Visit IVE's Website</a>
    </p>
    </footer>