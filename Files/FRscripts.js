window.addEventListener("load", loaded, false);

let testPath = {
    here: location.pathname,
    newfrReg: /newfr.php$/,
    verifyfrReg: /verifyfr.php$/,
    isnewfr: function() {
        if(this.newfrReg.test(this.here)) {
            return true;
        } else {
            return false;
        }
    }
}

function loaded() {
    if (testPath.isnewfr()) {
        console.log("This only runs on newfr.php, via the object testPath.");
        document.getElementById("submitButton").addEventListener
        ("click",function(event) {
            event.preventDefault();
            },false);
        document.getElementById("submitButton").addEventListener("click",checkForeman,false);
    } // else if ( Need to run the regex for verifyfr.php?? ) {}
}
function checkForeman() {
    var failVar = document.getElementById("foreman").value;
    if (failVar == "Foreman") {
       alert("Please select Foreman.")
    } else {
        if(empDuplicates()) {
            console.log("we have a duplicate employee entry.");
            alert("You have a dupilicate employee entry");
        } else {
            if(equipDuplicates()) {
                console.log("we have a duplicate equipment entry.");
                alert("You have a duplicate equipment entry.");
            } else {
                // ok fine, submit the form
                document.getElementById("createform").submit();
            }
        }
    }
}

function empDuplicates() {
    let emps = [];
    let areDups = false;
    for (i=1; document.getElementById("Emp"+i).value != "Employee"; i++) {
        let employee = document.getElementById("Emp"+i).value;
        if (emps.includes(employee)) {
            areDups = true;
        } else {
            emps.push(employee);
            areDups = false;
        }
    }
    if (areDups == true) {
        return true;
    } else if (areDups == false) {
        return false;
    }
}

function equipDuplicates() {
    let equips = [];
    let areDups = false;
    for (i=1; document.getElementById("Equip"+i).value != "Equip ID"; i++) {
        let equip = document.getElementById("Equip"+i).value;
        if (equips.includes(equip)) {
            areDups = true;
        } else {
            equips.push(equip);
            areDups = false;
        }
    }
    if (areDups == true) {
        return true;
    } else if (areDups == false) {
        return false;
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
    let startOdo = document.getElementById("EquipOdoStart"+num).value;
    let endOdo = document.getElementById("EquipOdoEnd"+num).value;
    let updateThis = document.getElementById("EquipOdoTotal"+num);
    let total = endOdo - startOdo;
    
    if (!(testPath.isnewfr())) {
        updateThis.innerHTML = total;
    }
    updateThis.nextElementSibling.value = total;
}
function totalTime(category, num) {
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
		startTimeHour += 12; // IF its PM and not 12. So 1pm-11pm add 12.
	}
	
	var endArray = endTime.split(":"); // Same exact operations for the endTime.
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
	}						    // But the minutes might come out negative...
	if (/^-/.test(minsTotal)) { // IF the minutes is negative.
		hoursTotal -= 1;		// Simply subtract one from the hours total and then convert the minutes.
		if (minsTotal == -15) {
			minsTotal = 45;
		} else if (minsTotal == -30) {
			minsTotal = 30;
		} else if (minsTotal == -45) {
			minsTotal = 15;
		}
	}
    if (!(testPath.isnewfr())) {
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





