<html>
<head>
<title>This Date In...</title>

<script 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>

<script language="JavaScript" type="text/javascript">

function the_alert()
// function for the ? button that explains the input formatting to the user
{
alert('Use the format MM/DD \n\nExample: "05/17"');
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
		    // unused ---- document.getElementById("theyear").innerHTML = year_occured;

		    // put the year that the first event occured above the pointer
		    document.getElementById("thepointeryear").innerHTML = return_data;
		    document.getElementById("year_holder").value=return_data;

		    // turn the returned data into an integer
		    return_data = parseInt(return_data);

		    // do some math turning the year into the number of pixels the pointer needs to be moved (based on the size of the timeline.png file)
		    var x=((return_data+1250)*.2)+385;
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

$("#1750").mouseenter(function(){
	$("#1750timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1750)*2.856)+655;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1750").mouseleave(function(){
	$("#1750timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});
	
$("#1500").mouseenter(function(){
	$("#1500timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1500)*2.856)+605;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1500").mouseleave(function(){
	$("#1500timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#1250").mouseenter(function(){
	$("#1250timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1250)*2.856)+555;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1250").mouseleave(function(){
	$("#1250timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#1000").mouseenter(function(){
	$("#1000timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-1000)*2.856)+505;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1000").mouseleave(function(){
	$("#1000timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#750").mouseenter(function(){
	$("#750timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-750)*2.856)+455;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#750").mouseleave(function(){
	$("#750timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});


$("#500").mouseenter(function(){
	$("#500timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-500)*2.856)+405;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#500").mouseleave(function(){
	$("#500timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#250").mouseenter(function(){
	$("#250timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year-250)*2.856)+355;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#250").mouseleave(function(){
	$("#250timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#0").mouseenter(function(){
	$("#0timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year)*2.856)+305;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#0").mouseleave(function(){
	$("#0timeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#250BC").mouseenter(function(){
	$("#250BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+250)*2.856)+255;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#250BC").mouseleave(function(){
	$("#250BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});


$("#500BC").mouseenter(function(){
	$("#500BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+500)*2.856)+205;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#500BC").mouseleave(function(){
	$("#500BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#750BC").mouseenter(function(){
	$("#750BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+750)*2.856)+155;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#750BC").mouseleave(function(){
	$("#750BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});


$("#1000BC").mouseenter(function(){
	$("#1000BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1000)*2.856)+105;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1000BC").mouseleave(function(){
	$("#1000BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointeryear").animate({left:x,top:"588px"},"slow");});

$("#1250BC").mouseenter(function(){
	$("#1250BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*2.856)+55;
	x=year.toString();
	x=x+"px";
	$("#theuppointer").animate({left:x},"slow");
	$("#thepointeryear").animate({left:x,top:"535px"},"slow");});
$("#1250BC").mouseleave(function(){
	$("#1250BCtimeline").animate({height:'toggle'});
	$("#theuppointer").toggle();
	year_value=document.getElementById("year_holder").value;
	year=parseInt(year_value);
	year=((year+1250)*.2)+385;
	x=year.toString();
	x=x+"px";
	$("#thepointerpointer").animate({left:x,top:"588px"},"slow");});
});

function timeline_click(timeline_segment, timeline, change)
// unused function. tried to turn the above repetative code into a function that could be called whenever needed
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

<style>

/* Formatting for the heading, i.e. "This Date in History" */
h1
{
position:absolute;
right:750px;
top:0px;
color:OliveDrab;
font-size:46px;
text-align:Center;
}

/* Formatting for the 'Enter a date:' thats below the heading */
p.stat1
{
position:absolute;
right:1100px;
top:100px;
color:olivedrab;
}

/* Background Image */
body
{
background-image:url("bluebackground.png");
}

/* formatting for the table that holds the checkboxes */
table
{
position:absolute;
right:1061px;
top:150px;
color:olivedrab;
}

/* This is the style for for the results from the php file */
div.results
{
position:absolute;
left:498px;
top:250px;
color:olivedrab;
}

div.theyeardiv
{
position:absolute;
right:1200px;
top:400px;
color:olivedrab;
}

</style>

</head>






<body>
<!--the header at the top of the page-->
<h1>This date in History</h1>

<!--the 'Enter a Date:' below the header-->
<p class="stat1">Enter A Date: </p>

<!-- the text box asking for a date -->
<input id="date" name="date" type="text" maxlength="5" style="position:absolute;right:935px;top:112px;"/>

<!-- the backward date button -->
<button onClick="change_date(-1);" style="position:absolute;top:112px;right:900px;"><</button>

<!-- the forward date button -->
<button onClick="change_date(1);" style="position:absolute;top:112px;right:875px;">></button>

<!--if clicked call the two php functions-->
<input name="myBtn" type="Submit" value="Submit Data" onClick="javascript:ajax_post();" style="position:absolute;top:112px;right:780px;">

<!-- if clicked create a pop up window explaining the formating to the user-->
<button onClick="the_alert()" style="position:absolute;top:112px;right:720px;" >Help?</button>

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

<!-- This is where the text results from the php file are put -->
<div id="status" class="results"></div>

<!-- the 'showing the first result' -->
<div id="theyear" class="theyeardiv">Showing the first result:</div>

<!-- This is where the year that hovers over the pointer is placed -->
<p2 id="thepointeryear" style="color:olivedrab;position:absolute;z-index:2;top:588px;right:1263px;"></p2>

<!-- This is the pointer image -->
<div class="pointer" id="thepointer" style="position:absolute;top:605px;right:1263px;"><img src="pointer.png" alt="darn" /></div>

<div class="timeline">

<!-- The upward pointer image -->
<img src="theuppointer.png" id="theuppointer" style="position:absolute;z-index:1;display:none;top:505px;right:400px;" />

<img src="1750timeline.png" id="1750timeline"     style="position:absolute;top:485px;right:280px;display:none;"/>
<img src="1500timeline.png" id="1500timeline"     style="position:absolute;top:485px;right:330px;display:none;"/>
<img src="1250timeline.png" id="1250timeline"     style="position:absolute;top:485px;right:380px;display:none;"/>
<img src="1000timeline.png" id="1000timeline"     style="position:absolute;top:485px;right:430px;display:none;"/>
<img src="750timeline.png" id="750timeline"       style="position:absolute;top:485px;right:480px;display:none;"/>
<img src="500timeline.png" id="500timeline"       style="position:absolute;top:485px;right:530px;display:none;"/>
<img src="250timeline.png" id="250timeline"       style="position:absolute;top:485px;right:580px;display:none;"/>
<img src="0timeline.png" id="0timeline"           style="position:absolute;top:485px;right:630px;display:none;"/>
<img src="250bctimeline.png" id="250BCtimeline"   style="position:absolute;top:485px;right:680px;display:none;"/>
<img src="500bctimeline.png" id="500BCtimeline"   style="position:absolute;top:485px;right:730px;display:none;"/>
<img src="750bctimeline.png" id="750BCtimeline"   style="position:absolute;top:485px;right:780px;display:none;"/>
<img src="1000bctimeline.png" id="1000BCtimeline" style="position:absolute;top:485px;right:830px;display:none;"/>
<img src="1250bctimeline.png" id="1250BCtimeline" style="position:absolute;top:485px;right:880px;display:none;"/>

<img src="timeline 250 year segment.png" id="1250BC"style="position:absolute;padding:0px;border:0px;margin:0px;left:400px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="1000BC"style="position:absolute;padding:0px;border:0px;margin:0px;left:450px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="750BC" style="position:absolute;padding:0px;border:0px;margin:0px;left:500px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="500BC" style="position:absolute;padding:0px;border:0px;margin:0px;left:550px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="250BC" style="position:absolute;padding:0px;border:0px;margin:0px;left:600px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="0"     style="position:absolute;padding:0px;border:0px;margin:0px;left:650px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="250"   style="position:absolute;padding:0px;border:0px;margin:0px;left:700px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="500"   style="position:absolute;padding:0px;border:0px;margin:0px;left:750px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="750"   style="position:absolute;padding:0px;border:0px;margin:0px;left:800px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="1000"  style="position:absolute;padding:0px;border:0px;margin:0px;left:850px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="1250"  style="position:absolute;padding:0px;border:0px;margin:0px;left:900px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="1500"  style="position:absolute;padding:0px;border:0px;margin:0px;left:950px;bottom:300px;"/>
<img src="timeline 250 year segment.png" id="1750"  style="position:absolute;padding:0px;border:0px;margin:0px;left:1000px;bottom:300px;"/>
<img src="12 year segment.png"                      style="position:absolute;padding:0px;border:0px;margin:0px;left:1051px;bottom:300px;"/>

<img src="timeline 1000 year counters.png" style="position:absolute;bottom:231px;right:600px;"/>

</div>





<input id="year_holder" style="display:none;position:absolute;right:0px;top:0px;" />







</body>
<html>




































