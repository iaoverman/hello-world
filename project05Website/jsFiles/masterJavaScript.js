/*----------------------------------------------------------------------
    This is the master javaScript file to be used in conjunction with
    the used book store. These functions apply to all web pages for the
    website.
    Author: Isabel Overman
    Date: 12/17/2018
-----------------------------------------------------------------------*/

/**
    The purpose of this function is to display a different image across the
    top of a page depending on the season.
*/
function displayTopBanner() {
    "use strict";
    //define all variables
    var thisDate;
    var thisMonth;
    var banner;

    //set up and get month
    banner = document.getElementById("topBanner");
    thisDate = new Date();
    thisMonth = thisDate.getMonth();

    //thisMonth = 9;    //FOR DEMO PURPOSES

    //interrogate month and display appropriate banner
    if (thisMonth == 11 || thisMonth == 0 || thisMonth == 1) {
        banner.innerHTML = "<img alt='holiday lights' src='../images/lightsBanner_2.png' id='lightsBannerImage'/>";
    } else if (thisMonth == 2 || thisMonth == 3 || thisMonth == 4) {
        banner.innerHTML = "<img alt='spring flowers' src='../images/flowersBanner_3.png' id='flowersBannerImage' />";
    } else if (thisMonth == 5 || thisMonth == 6 || thisMonth == 7) {
        banner.innerHTML = "<img alt='blue waves' src='../images/wavesBanner.png' id='wavesBannerImage' />";
    } else {
        banner.innerHTML = "<img alt='fall leaves' src='../images/leavesBanner_3.png' id='leavesBannerImage' />";
    }

    //size the banner
    document.getElementsByTagName("IMG")[0].style.width = "100%";
}


/**
    The purpose of this function is to display the date the webpage was
    rendered.
*/
function dateRendered() {
    "use strict";
    //define all variables
    var todaysDate;

    //get date and make pretty
    todaysDate = new Date();
    todaysDate = todaysDate.toDateString();

    //display date
    document.write("Rendered: " + todaysDate);
}


/**
    The purpose of this function is to add the volunteer form to the volunteer
    web page as a result of a click.
*/
function displayForm() {
    "use strict";
    //define all variables
    var volunteerForm;

    //find the place to put the form
    volunteerForm = document.getElementById("formArticle");

    //display form
    volunteerForm.innerHTML = "<!--FORM STARTS HERE -->"
            + "<form action='http://itins3.madisoncollege.edu/echo.php'"
            + "method='post'"
            + "name='newVolunteerForm'"
            + "id='newVolunteerForm'>"
            + "<fieldset>"
            + "<legend>New Volunteer Form</legend>"
            + "<!--FIRST NAME -->"
            + "<label for='firstName' class='setWidth'>First Name</label>"
            + "<input type='text' name='firstName' id='firstName' required='required' />"
            + "&emsp;"
            + "<!--LAST NAME -->"
            + "<label for='lastName' class='setWidth'>Last Name</label>"
            + "<input type='text' name='lastName' id='lastName' required='required' />"
            + "<br /><br />"
            + "<!--HOME ADDRESS -->"
            + "<label for='homeAddress' class='setWidth'>Home Address</label>"
            + "<input type='text' name='homeAddress' id='homeAddress' required='required' />"
            + "<br /><br />"
            + "<!--EMAIL -->"
            + "<label for='emailAddress' class='setWidth'>Email Address</label>"
            + "<input type='text' name='emailAddress' id='emailAddress' required='required' />"
            + "&emsp;"
            + "<!--PHONE -->"
            + "<label for='phoneNumber' class='setWidth'>Phone Number</label>"
            + "<input type='text' name='phoneNumber' id='phoneNumber' required='required' />"
            + "<br /><br />"
            + "<!--BEST WAY TO CONTACT YOU -->"
            + "<label for='bestContact'>What's the best way to contact you?</label>"
            + "<br />"
            + "<input type='radio' name='bestContact' value='email'"
            + "id='bestContactEmail' required='required' />"
            + "<label for='bestContactEmail' id='bestContactEmail'>Email</label>"
            + "&emsp;"
            + "<input type='radio' name='bestContact' value='phone'"
            + "id='bestContactPhone' required='required' />"
            + "<label for='bestContactPhone' id='bestContactPhone'>Phone</label>"
            + "<br /><br />"
            + "<!--STUDENT -->"
            + "<label for='studentStatus'>Are you a student?</label>"
            + "<br />"
            + "<input type='radio' name='studentStatus' value='yes'"
            + "id='studentStatusYes' required='required' />"
            + "<label for='studentStatusYes' id='studentStatusYes'>Yes</label>"
            + "&emsp;"
            + "<input type='radio' name='studentStatus' value='no'"
            + "id='studentStatusNo' required='required' />"
            + "<label for='studentStatusNo' id='studentStatusNo'>No</label>"
            + "<br /><br />"
            + "<!--COMMENT BOX -->"
            + "<label for='commentBox'>If you have anything else you would like to add,"
            + "you may add it here:</label>"
            + "<br />"
            + "<textarea name='commentBox' id='commentBox' rows='4' cols='85'"
            + "maxlength='1500'></textarea>"
            + "<br /><br />"
            + "<!--SUBMIT BUTTONS -->"
            + "<p id='buttonsParaph'>"
            + "<input type='submit' value='Submit Form' class='submitButton' />"
            + "&nbsp;&nbsp;&nbsp;&nbsp;"
            + "<input type='reset' value='Clear Form' class='submitButton' />"
            + "</p>"
            + "</fieldset>"
            + "</form>"
            + "<!--END OF FORM -->";
    innerHTML
}

