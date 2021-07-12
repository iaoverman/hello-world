<?php
    $page_heading = "Sucess! Your Order has been Received.";
    require_once('header.php');
    //require_once('connectvars.php');
    $num1 = $_POST['adultF'] ?: 0;
    $num2 = $_POST['studentF'] ?: 0;
    $num3 = $_POST['adultS'] ?: 0;
    $num4 = $_POST['studentS'] ?: 0;
    $totalTix = intval($num1) + intval($num2) + intval($num3) + intval($num4);
    $p1 = $_POST['p1'] ?: 0;
    $p2 = $_POST['p2'] ?: 0;
    $p3 = $_POST['p3'] ?: 0;
    $p4 = $_POST['p4'] ?: 0;
    $totp = doubleval($p1) * $num1 + doubleval($p2) * $num2 + doubleval($p3) * $num3 + doubleval($p4) * $num4;
    
?>
    <article id="confirm">
        Ticket Holder: <?php echo $_POST['fname'] . ' ' . $_POST['lname']; ?>
        <br />
        Number of Tickets: <?php echo $totalTix; ?>
        <br />
        Total: $<?php echo $totp; ?>
        <br />
        <p id="done">
            <a href="index.php">Back to Home</a>  
        </p>
    </article>

<?php
    
   // require_once('footer.php');
?>