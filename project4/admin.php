<?php
    $page_heading = "Welcome to IVE's ticket tracker/ticket purchase place admin homepage.";
    require_once('header.php');
?>
<main>
<h2>Here are some useful links.</h2><br />
<nav>
<a href="newConcert.php">New Concert</a><br />
<a href="deleteConcert.php">Delete Concert</a><br />
<a href="newVenue.php">Add Venue</a><br />
<a href="deleteVenue.php">Delete Venue</a><br />
<a href="selectReport.php">Get a Report</a><br />
<a href="adminOrder.php">Order Tickets</a><br />
</nav>
</main>

<?php
    require_once('footer.php');
?>