window.addEventListener("load", loaded, false);

function loaded() {
    // Below are eventListeners for submit button on create.php and verify.php
    let here = location.pathname;
    let newfrReg = /newfr.php$/; // Regex for "ending in create.php.
    let verifyfrReg = /verifyfr.php$/;
    if(newfrReg.test(here)) {
        // Takes the submit away and runs checkForeman() first.
        document.getElementById("submitButton").addEventListener
        ("click",function(event) {
            event.preventDefault();
            },false);
        document.getElementById("submitButton").addEventListener("click",checkForeman,false);
    }
    // Need to run the Regex for verify.php?
}
function checkForeman() {
    var failVar = document.getElementById("foreman").value;
    if (failVar == "Foreman") {
       alert("Please select Foreman.")
    } else {
        document.getElementById("createform").submit();
    }
}





// This is the AJAX for index.php
function loadDoc(url, cFunction) {
    var xhr;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this); // myFunction(this) || "(this)" returns XMLHttpRequest Object, which after executed
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}
function displayOne(xhr) {
    document.getElementById("display").innerHTML = xhr.responseText;
}
function displayTwo(xhr) {
    document.getElementById("display2").innerHTML = xhr.responseText;
}
function displayThree(xhr) {
    document.getElementById("display3").innerHTML = xhr.responseText;
}





function addEmpLine(num) {
    if (num < 11) {
        $("#EmpUL-"+num).attr("class", "");
        num++;
        $("#NextEmpLineBUTTON").attr("onClick", "addEmpLine("+num+")");
    } else {
        alert("More than 10 employees today??");
    }

}
function addEqLine(num) {
    if (num < 11) {
        $("#EquipUL-"+num).attr("class", "");
        num++;
        $("#NextEqLineBUTTON").attr("onClick", "addEqLine("+num+")");
    } else {
        alert("More than 10 pieces of equipment today??");
    }
}
function addTLine(num) {
    if (num < 21) {
        $("#TruckUL-"+num).attr("class", "");
        num++;
        $("#NextTLineBUTTON").attr("onClick", "addTLine("+num+")")
    } else {
        alert("More than 20 trucks today??");
    }
}



function totalOdo(num) {
    let here = location.pathname;
    let newfrReg = /newfr.php$/;
    let verifyfrReg = /verifyfr.php$/;
    if(newfrReg.test(here)) {
        var showTotals = false;
    } else {
        var showTotals = true;
    }
    let startOdo = document.getElementById("EquipOdoStart"+num).value;
    let endOdo = document.getElementById("EquipOdoEnd"+num).value;
    let updateThis = document.getElementById("EquipOdoTotal"+num);
    let total = endOdo - startOdo;
    
    if (showTotals) {
        updateThis.innerHTML = total;
    }
    updateThis.nextElementSibling.value = total;
}
function totalTime(category, num) {
    let here = location.pathname;
    let newfrReg = /newfr.php$/;
    let verifyfrReg = /verifyfr.php$/;
    if(newfrReg.test(here)) {
        var showTotals = false;
    } else {
        var showTotals = true;
    }
    
    if (category == 1) {
        var cate = "Emp";
    } else if (category == 2) {
        var cate = "Truck";
    }
    let startTime = document.getElementById(cate+"TimeIn"+num).value;
    var endTime = document.getElementById(cate+"TimeOut"+num).value;
    var updateThis = document.getElementById(cate+"Total"+num);
    var addZero = "";
    
	var startArray = startTime.split(":");		// Split the start time on either side of the :
	var startTimeHour = startArray[0];			// 0 = First side of :
	var startTimeMin = startArray[1];			// 1 = Next item in array, or everything right of the :
	var startAM = /a/.test(startTimeMin);		// The slashes are for RegEx. Testing startTimeMin for an 'a'
	startTimeMin = startTimeMin.slice(0,-2);	// Trim startTimeMin so its just the minutes.
	startTimeMin = parseInt(startTimeMin, 10);	// Turn them both into integers to do maths.
	startTimeHour = parseInt(startTimeHour, 10);	
	if (!startAM && startTimeHour != 12) {
		startTimeHour += 12;					// IF its PM and not 12. So 1pm-11pm add 12.
	}
	
	var endArray = endTime.split(":");			// Same exact operations for the endTime.
	var endTimeHour = endArray[0];
	var endTimeMin = endArray[1];
	var endAM = /a/.test(endTimeMin);
	endTimeMin = endTimeMin.slice(0,-2);
	endTimeMin = parseInt(endTimeMin, 10);
	endTimeHour = parseInt(endTimeHour,10);
	if (!endAM && endTimeHour != 12) {
		endTimeHour += 12;
	}
												// Time for some simple math.
	var hoursTotal = (endTimeHour - startTimeHour);
	var minsTotal = (endTimeMin - startTimeMin);
	
	if (minsTotal == 0) {
		var addZero = "0";
	}											// But the minutes might come out negative...
	if (/^-/.test(minsTotal)) { 				// IF the minutes is negative.
		hoursTotal -= 1;						// Simply subtract one from the hours total and then convert the minutes.
		if (minsTotal == -15) {
			minsTotal = 45;
		} else if (minsTotal == -30) {
			minsTotal = 30;
		} else if (minsTotal == -45) {
			minsTotal = 15;
		}
	}
    if (showTotals) {
        updateThis.innerHTML = (hoursTotal + ":" + minsTotal + addZero);
    }
    updateThis.nextElementSibling.value = (hoursTotal + ":" + minsTotal + addZero);
}
	
	


// FUNCTION: This does the accordian menu. Dont ask me.
$( function() {
    $( "#accordion" ).accordion({
        heightStyle: "content"
    });
});

// FUNCTION: JQuery datepicker. Feel Free: http://api.jquery.com
$( function() { 
    $( "#datepicker" ).datepicker({
        dateFormat: 'D yy-mm-dd' });
});

// FUNCTION: JQuery timepicker. Have at it: http://jonthornton.github.io/jquery-timepicker/
$(function(){
	$('.timepicker').timepicker({
step: 15,
minTime: '4',
maxTime: '11:45pm',
dynamic: false,
dropdown: true,
scrollbar: true
	});
});





