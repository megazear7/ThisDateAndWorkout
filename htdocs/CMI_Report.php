<!DOCTYPE html>
<html>
<head>

<style>
</style>

<script language="JavaScript" type="text/javascript">

function submit_results()
{
	
	var hr = new XMLHttpRequest();
	

	var file = "get_data.php";
	
	var facility = document.getElementById("facility").value;
	var year = document.getElementById("year").value;
	
	var quarter = document.getElementById("quarter").value;
	
	var type = document.getElementById("type").value;
	var cmi = document.getElementById("cmi").value;
	
	var vars = "facility="+facility+"&year="+year+"&quarter="+quarter+"&type="+type+"&cmi="+cmi;
	
	hr.open("POST", file, true);
	
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function()
	{
		if(hr.readyState == 4 && hr.status == 200)
		{
			var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
			display_facility_info();
		}
	}

	hr.send(vars);
 	
	document.getElementById("status").innerHTML = "processing...";
	document.getElementById("facilityinfo").innerHTML = "processing...";
}

function display_facility_info()
{
	var hr = new XMLHttpRequest();
	var file = "get_facility_info.php";
	var facility = document.getElementById("facility").value;
	var vars = "facility="+facility;

	hr.open("POST", file, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function()
	{
		if(hr.readyState == 4 && hr.status == 200)
		{
			var return_data = hr.responseText;
			document.getElementById("facilityinfo").innerHTML = return_data;
		}
	}

	hr.send(vars);
	document.getElementById("facilityinfo").innerHTML = "processing...";
}

</script>


</head>
<body onload="javascript:display_facility_info();">

<table>
<tr>
<td>Facilitity</td>
<td>
<form>
<select name = "facility" id="facility" onclick="javascript:display_facility_info();">
<option value = "camelot">Camelot</option>
<option value = "springfield">Springfield</option>
<option value = "canton">Canton</option>
<option value = "woodside">Woodside</option>
<option value = "dixon">Dixon</option>

</select>
</form>
</td>
</tr>

<tr>
<td>Year</td>
<td><input type="text" name="year" id="year" size="1" maxlength="4"></td>
</tr>

<tr>
<td>Quarter</td>
<td>
<form action="">
<select name = "quarter" id="quarter">
<option value = "1">First Quarter</option>
<option value = "2">Second Quarter</option>
<option value = "3">Third Quarter</option>
<option value = "4">Fourth Quarter</option>
</select>
</form>
</td>
</tr>

<tr>
<td>Type</td>
<td>
<form action="">
<select name = "type" id="type">
<option value = "first">First</option>
<option value = "second">Second</option>
<option value = "final">Final</option>
</select>
</form>
</td>
</tr>

<tr>
<td>CMI</td>
<td><input type="text" id="cmi" name="CMI" maxlength="6" size="2"></td>
</tr>

<tr><td><input type="submit" onclick="javascript:submit_results();"></td></tr>
</table>

Previously Added:<div id="facilityinfo"></div>
<br>Last Added: <div id="status"></div>

</body>
</html>