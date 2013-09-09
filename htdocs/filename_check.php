<html>
<head>
<title>This Date In...</title>
<style>

/* Formating for the part that shows "Showing the first result" */
div.theyeardiv
{
color:Olivedrab;
position:relative;
top:100px;
right:-345px;
}

/* Formatting for the heading, i.e. "This Date in History" */
h1
{
color:OliveDrab;
font-size:46px;
text-align:Center;
}

/* Formatting for year that goes above the pointer */
p2
{
color:olivedrab;
position:relative;
top:150px;
}

/* Formatting for the pointer */
div.pointer
{
position:relative;
top:150px;
}

/* Formatting for the Time Line */
div.timeline
{
position:relative;
top:150px;
}

/* Background Image */
body
{
background-image:url("bluebackground.png");
}

/* Formatting for the words that appear next to the checkboxes */
div1
{
color:oliveDrab;
}

/* Formatting for the "Enter a Date:"  */
p1
{
color:olivedrab;
}

/* Formatting for the results that the php file "Date_history_timeline_testing_backend.php" sends back */
div.results
{
color:oliveDrab;
font-size:18px;
text-align:Center;
}

/* Formatting for the whole static top section */
div.resultsdiv
{
position:relative;
right:-500px;
}
</style>

<script 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>

<script language="JavaScript" type="text/javascript">

function the_alert()
// function for the ? button that explains the input formatting to the user
{
alert('Use the format MM/DD');
}


function get_info()
// Retrieves info from the data base corrosponding to the year entered and the boxes checked
{
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();

    // Create some variables we need to send to our PHP file
    var url = "Date_history_timeline_testing_backend.php";
    var date = document.getElementById("date").value;
    var bday_check = document.getElementById('birthday').value;
    var polhis_check= document.getElementById('political history').value; 
    var milhis_check= document.getElementById('military history').value;

    // put the above variables into a string that can be read by the php file
    var vars = "date="+date+"&bday="+bday_check+"&polhis="+polhis_check+"&milhis="+milhis_check;
    
    // open the php file, the name of which is in the variable 'url'
    hr.open("POST", url, true); 

    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object  
    hr.onreadystatechange = function() 
    {
	    if(hr.readyState == 4 && hr.status == 200) 
            {
 		    // get the data the php file is echoing back via 'responseText'
		    var return_data = hr.responseText;
		    // insert the echoed information to the status div
		    document.getElementById("status").innerHTML = return_data;
	    }
    }

    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request

    // display 'processing...' until the php file actually finishes echoing the data
    document.getElementById("status").innerHTML = "processing...";
}

function get_year()
// retrieves info from a php file about the year of the first entry that is come across in the database
{
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();

    // Create some variables we need to send to our PHP file
    var url = "Date_history_timeline_testing_backend_year.php";
    var date = document.getElementById("date").value;
    var bday_check = document.getElementById('birthday').value;
    var polhis_check= document.getElementById('political history').value; 
    var milhis_check= document.getElementById('military history').value;

    // put the above variables into a string that can be read by the php file
    var vars = "date="+date+"&bday="+bday_check+"&polhis="+polhis_check+"&milhis="+milhis_check;
    
    // actually open the php file, the name of which is in the variable 'url'
    hr.open("POST", url, true); 

    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object  
    hr.onreadystatechange = function() 
    {
	    if(hr.readyState == 4 && hr.status == 200) 
            {
		    // get info that the php file echoed
		    var return_data = hr.responseText;

		    // year_occured = "The first result occured in the year: " + return_data;  // ommited because I like it this way better
		    // document.getElementById("theyear").innerHTML = year_occured;

		    // put the year that the first event occured above the pointer
		    document.getElementById("thepointeryear").innerHTML = return_data;
		    document.getElementById("year_holder").value=return_data;

		    // turn the returned data into an integer
		    return_data = parseInt(return_data);

		    // do some math turning the year into the number of pixels the pointer needs to be moved (based on the size of the timeline.png file)
		    var x=((return_data+1250)*.2)+330;
		    // the pixel starts 15 pixels to the right of the '0' positions.
		    // the image is 650 pixels.
		    

  		    // turn that value into a string
		    x.toString();

		    // format the string into something that CSS recognizes
		    x=x+"px";

		    // move the pointer and the year above the pointer to the correct position
		    $("#thepointer").animate({left:x},"slow");	
	    	    $("#thepointeryear").animate({left:x},"slow");

		
	    }
    }

    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request   
    
}

function ajax_post()
// this function is called when the submit button is clicked
{
	// this calls the functions which were seperated for clarity
	get_info();
	get_year();
}

function checker(state,spec)
// this function assigns the correct values of 1 or 0 to the checkboxes, depending on whether they are clicked or not
// if clicked it is set to 1, this value is sent to the php files so that those files know which data to retrieve from database
{
// if unclicked set to 1
if (state=="0")
   {
   document.getElementById(spec).value="1";
   }
// if its already been clicked set to 0
if (state=="1")
   {
   document.getElementById(spec).value="0";
   }
}

function change_date(mod)
{
	
	date = document.getElementById("date").value;
	month=date[0]+date[1];
	day=date[3]+date[4];
	switch(month)
	{
		case "01":
		if(day=="31" && mod==1){
			day="01";
			month="02";}
		else if(day=="01" && mod==-1){
			day="31";
			month="12";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			day=day_number.toString();
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "02":
		if(day=="28" && mod==1){
			day="01";
			month="03";}
		else if(day=="01" && mod==-1){
			day="31";
			month="01";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "03":
		if(day=="31" && mod==1){
			day="01";
			month="04";}
		else if(day=="01" && mod==-1){
			day="28";
			month="02";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "04":
		if(day=="30" && mod==1){
			day="01";
			month="05";}
		else if(day=="01" && mod==-1){
			day="31";
			month="03";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "05":
		if(day=="31" && mod==1){
			day="01";
			month="06";}
		else if(day=="01" && mod==-1){
			day="30";
			month="04";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "06":
		if(day=="30" && mod==1){
			day="01";
			month="07";}
		else if(day=="01" && mod==-1){
			day="31";
			month="05";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "07":
		if(day=="31" && mod==1){
			day="01";
			month="08";}
		else if(day=="01" && mod==-1){
			day="30";
			month="06";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "08":
		if(day=="31" && mod==1){
			day="01";
			month="09";}
		else if(day=="01" && mod==-1){
			day="31";
			month="07";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "09":
		if(day=="30" && mod==1){
			day="01";
			month="10";}
		else if(day=="01" && mod==-1){
			day="31";
			month="08";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "10":
		if(day=="31" && mod==1){
			day="01";
			month="11";}
		else if(day=="01" && mod==-1){
			day="30";
			month="09";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "11":
		if(day=="30" && mod==1){
			day="01";
			month="12";}
		else if(day=="01" && mod==-1){
			day="31";
			month="10";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;

		case "12":
		if(day=="31" && mod==1){
			day="01";
			month="01";}
		else if(day=="01" && mod==-1){
			day="30";
			month="11";}
		else{
			day_number=parseInt(day);
			day_number+=mod;
			if(day_number>9){day = day_number.toString();}
			if(day_number<10){day = "0" + day_number.toString();}}break;
	}
	x = month + "/" + day; 
	document.getElementById("date").value = x;
	ajax_post();
}

// Jquery:

$(document).ready(function(){

$("#1750").click(function(){
	//$("#theyear").toggle();
	$("#1750timeline").animate({height:'toggle'});
	//$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1750)*2.856)+598;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});
	
$("#1500").click(function(){
	$("#theyear").toggle();
	$("#1500timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1500)*2.856)+548;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#1250").click(function(){
	$("#theyear").toggle();
	$("#1250timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1250)*2.856)+498;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#1000").click(function(){
	$("#theyear").toggle();
	$("#1000timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1000)*2.856)+448;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#750").click(function(){
	$("#theyear").toggle();
	$("#750timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-750)*2.856)+398;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#500").click(function(){
	$("#theyear").toggle();
	$("#500timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-500)*2.856)+348;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#250").click(function(){
	$("#theyear").toggle();
	$("#250timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-250)*2.856)+298;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#0").click(function(){
	$("#theyear").toggle();
	$("#0timeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year)*2.856)+248;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#250BC").click(function(){
	$("#theyear").toggle();
	$("#250BCtimeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+250)*2.856)+198;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#500BC").click(function(){
	$("#theyear").toggle();
	$("#500BCtimeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+500)*2.856)+148;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#750BC").click(function(){
	$("#theyear").toggle();
	$("#750BCtimeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+750)*2.856)+98;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#1000BC").click(function(){
	$("#theyear").toggle();
	$("#1000BCtimeline").animate({height:'toggle'});
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1000)*2.856)+48;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});

$("#1250BC").click(function(){
	$("#1250BCtimeline").animate({height:'toggle'});
	$("#theyear").toggle();
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*2.856)-2;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});
});

function timeline_click(timeline_segment, timeline, change)
{
$(timeline_segment).click(function(){
	$(timeline).animate({height:'toggle'});
	$("#theyear").toggle();
	$("#thepointer").toggle();
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*2.856)-change;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");});
}

</script>
</head>

<body>
<!--the header at the top of the page-->
<h1>This date in History</h1>
<!--the div for the button, checkboxes and static part of the page-->
<div class="resultsdiv">
<p1>Enter A Date: <p1><input id="date" name="date" type="text" /> 

<button onClick="change_date(-1);"><</button>
<button onClick="change_date(1);">></button>

<!--if clicked call the two php functions-->
<input name="myBtn" type="Submit" value="Submit Data" onClick="javascript:ajax_post();">

<!-- if clicked create a pop up window explaining the formating to the user-->
<button onClick="the_alert()">?</button>

<!--sets the checkboxes in a clean (invisible) grid. if any are clicked there values switch between 1 and 0-->
<form>
<table>
<tr>
<td><div1>Birthdays</div></td><td><input type="checkbox" value="0" id="birthday" onclick="checker(this.value,this.id)"></td>
</tr>
</tr>
<td><div1>Political History</div> </td><td><input type="checkbox" value="0" id="political history" onclick="checker(this.value,this.id)"></td>
</tr>
<tr>
<td><div1>Military History</div> </td><td><input type="checkbox" value="0" id="military history" onclick="checker(this.value,this.id)"></td>
</tr>
</table>
</form>
</div>

<!-- This is where the text results from the php file are put -->
<div id="status" class="results"></div>
<!-- This is static -->
<div id="theyear" class="theyeardiv">Showing the first result</div>

<!-- This is where the year that hovers over the pointer is placed -->
<p2 id="thepointeryear"></p2>
<!-- This is the pointer image -->
<div class="pointer" id="thepointer" style="position:relative;right:-345px;"><img src="pointer.png" alt="darn" /></div>

<!-- This is the timeline image -->
<div class="timeline">

<img src="theuppointer.png" id="theuppointer" style="position:absolute;z-index:1;display:none;top:-129;right:361px" />

<img src="1750timeline.png" id="1750timeline" style="position:absolute;top:-149px;right:-80px;display:none;"/>
<img src="1500timeline.png" id="1500timeline" style="position:absolute;top:-149px;right:-30px;display:none;"/>
<img src="1250timeline.png" id="1250timeline" style="position:absolute;top:-149px;right:20px;display:none;"/>
<img src="1000timeline.png" id="1000timeline" style="position:absolute;top:-149px;right:70px;display:none;"/>
<img src="750timeline.png" id="750timeline" style="position:absolute;top:-149px;right:120px;display:none;"/>
<img src="500timeline.png" id="500timeline" style="position:absolute;top:-149px;right:170px;display:none;"/>
<img src="250timeline.png" id="250timeline" style="position:absolute;top:-149px;right:220px;display:none;"/>
<img src="0timeline.png" id="0timeline" style="position:absolute;top:-149px;right:270px;display:none;"/>
<img src="250bctimeline.png" id="250BCtimeline" style="position:absolute;top:-149px;right:320px;display:none;"/>
<img src="500bctimeline.png" id="500BCtimeline" style="position:absolute;top:-149px;right:370px;display:none;"/>
<img src="750bctimeline.png" id="750BCtimeline" style="position:absolute;top:-149px;right:420px;display:none;"/>
<img src="1000bctimeline.png" id="1000BCtimeline" style="position:absolute;top:-149px;right:470px;display:none;"/>
<img src="1250bctimeline.png" id="1250BCtimeline" style="position:absolute;top:-149px;right:520px;display:none;"/>

<img src="timeline 250 year segment.png" id="1250BC"style="position:relative;padding:0px;border:0px;margin:0px;right:-345px;"/>
<img src="timeline 250 year segment.png" id="1000BC"style="position:relative;padding:0px;border:0px;margin:0px;right:-340px;"/>
<img src="timeline 250 year segment.png" id="750BC"style="position:relative;padding:0px;border:0px;margin:0px;right:-335px;"/>
<img src="timeline 250 year segment.png" id="500BC"style="position:relative;padding:0px;border:0px;margin:0px;right:-330px;"/>
<img src="timeline 250 year segment.png" id="250BC"style="position:relative;padding:0px;border:0px;margin:0px;right:-325px;"/>
<img src="timeline 250 year segment.png" id="0"    style="position:relative;padding:0px;border:0px;margin:0px;right:-320px;"/>
<img src="timeline 250 year segment.png" id="250"  style="position:relative;padding:0px;border:0px;margin:0px;right:-315px;"/>
<img src="timeline 250 year segment.png" id="500"  style="position:relative;padding:0px;border:0px;margin:0px;right:-310px;"/>
<img src="timeline 250 year segment.png" id="750"  style="position:relative;padding:0px;border:0px;margin:0px;right:-305px;"/>
<img src="timeline 250 year segment.png" id="1000" style="position:relative;padding:0px;border:0px;margin:0px;right:-300px;"/>
<img src="timeline 250 year segment.png" id="1250" style="position:relative;padding:0px;border:0px;margin:0px;right:-295px;"/>
<img src="timeline 250 year segment.png" id="1500" style="position:relative;padding:0px;border:0px;margin:0px;right:-290px;"/>
<img src="timeline 250 year segment.png" id="1750" style="position:relative;padding:0px;border:0px;margin:0px;right:-285px;"/>
<img src="12 year segment.png" style="position:relative;padding:0px;border:0px;margin:0px;right:-281px;"/>


<img src="timeline 1000 year counters.png" style="position:relative;top:-5px;right:-345px;"/>

</div>

<input id="year_holder" style="display:none" />

</body>
</html>

