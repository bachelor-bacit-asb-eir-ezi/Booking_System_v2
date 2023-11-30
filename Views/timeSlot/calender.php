<?php include(__DIR__ . "/../layout/header.php") ?>
<?php
require_once(__DIR__ . "/../../Controllers/TimeSlotController.php");

if (!$_SESSION["user"]["logedIn"]) {
    header("location: ../index.php");
    exit;
}

global $week;

$curYear = Validate::sanitize($week->getYear());
$nextYear = $curYear;
$prevYear = $curYear;

$curWeek = Validate::sanitize($week->getWeekNumber());
$prevWeek = $curWeek - 1;
$nextWeek = $curWeek + 1;

if ($nextWeek > 52) {
    $nextWeek = 1;
    $nextYear++;
}
if ($prevWeek < 1) {
    $prevWeek = 52;
    $prevYear--;
}

echo "<b>" . $curWeek . "</b>";
echo "<div class='d-flex justify-content-center'>";
echo "<form method='GET' class='mx-5 mb-3'>";
echo "<input type='hidden' name='weekNumber' value='" . $prevWeek . "'>";
echo "<input type='hidden' name='currentYear' value='" . $prevYear . "'>";
echo "<button type='submit' name='changeWeek' value='prevWeek' class='btn btn-secondary'>Forrige</button>";
echo "</form>";
echo "<form method='GET' class='mx-5 mb-3'>";
echo "<label for='weekNumber'> Søk etter uke: </label>";
echo "<input type='int' name='weekNumber' min='1' max='52'>";
echo "<input type='hidden' name='currentYear' value='" . $curYear . "'>";
echo "<button type='submit' name='changeWeek' value='searchWeek' class='btn btn-secondary'>Søk</button>";
echo "</form>";
echo "<form method='GET' class='mx-5 mb-3'>";
echo "<input type='hidden' name='weekNumber' value='" . $nextWeek . "'>";
echo "<input type='hidden' name='currentYear' value='" . $nextYear . "'>";
echo "<button type='submit' name='changeWeek' value='nextWeek' class='btn btn-secondary'>Neste</button>";
echo "</form>";
echo "</div>";
echo "<div id='calender'>";

echo "</div>";
?>

<script>
 function updateTimeSlotInCalender() 
    {
        var calender = document.getElementById("calender");
        var xhr = new XMLHttpRequest();

        // Get the current URL
        var currentUrl = window.location.href;

        // Use the URLSearchParams API to extract parameters from the URL
        var urlParams = new URLSearchParams(currentUrl.split("?")[1]);

        // Extract year and weekNumber from the URL parameters
        var currentYear = urlParams.get("currentYear");
        var weekNumber = urlParams.get("weekNumber");

       
        // Replace 'your_script.php' with the actual path to your PHP script
        var url = "../../Tools/CalenderGenerator.php";

        // Parameters to be sent in the GET request
        
        if (weekNumber != null || currentYear != null){ //Plaeholder, bør utvides til å sjekke hvis en mangler fyll inn den andre
            var params = "changeWeek=true&currentYear=" + currentYear + "&weekNumber=" + weekNumber;
        } else{
            var params = "";
        }
        console.log(params);
        xhr.open("GET", url + "?" + params, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response if needed
                calender.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }
    updateTimeSlotInCalender();
    setInterval(updateTimeSlotInCalender, 5000);
</script>

<?php include(__DIR__ . "/../layout/footer.php") ?>