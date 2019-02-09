window.addEventListener("load", loaded);

function loaded() {
    document.getElementById("TSBUTTON").addEventListener("click", function() {
        event.preventDefault();
        console.log("Cancel the button, run the function.");
    });
    document.getElementById("TSBUTTON").addEventListener("click", getTimeSheet);
}


function getTimeSheet() {
    if (checkForMonday(document.getElementById("datepicker").value)) {
        var foremanFail = document.getElementById("foreman").value;
        var dateFail = document.getElementById("datepicker").value;
        if (foremanFail == "-- select --" || dateFail == "") {
            alert("Please Select a Foreman and a Date.");
            return false;
        } else {
            document.getElementById("createtsFORM").submit();
        }
    }
}
function checkForMonday(selectedDate) {
	var dayy = selectedDate.slice(8); // 8 characters in starts the Day
	dayy = parseInt(dayy, 10); // Changing to an integer drops the first 0. so 01 for Jan becomes 1. Nice.
	
	var monthh = selectedDate.slice(5, -3); // 5 characters from the left and 3 from the right = Month
	monthh = parseInt(monthh, 10);
	monthh -= 1; // So months start at 0 but days dont? This subtracts 1, so Jan=0, Feb=1, March=2, etc.
		
	var yearr = selectedDate.slice(0, -6); // 6 characters from the right leaves just the year
	yearr = parseInt(yearr, 10);
	
	var myDate = new Date(yearr, monthh, dayy); // Set the 3 values to a new Date()
	if (myDate.getDay() != 1) { // getDay checks day of the week. 0 for sunday, 0-6. 1 = monday.
		alert("Please choose a Monday."); 
        return false;
	} else {
        return true;
    }
    return;
}



// FUNCTION: JQuery datepicker. Feel Free: http://api.jquery.com
$(document).ready(function(){
	$( "#datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd'
	});
} );

// FUNCTION: JQuery timepicker. Feel Free: http://jonthornton.github.io/jquery-timepicker/
$(document).ready(function(){
	$('.timepicker').timepicker({
step: 15,
minTime: '4',
maxTime: '11:45pm',
dynamic: false,
dropdown: true,
scrollbar: true
	});
}); 