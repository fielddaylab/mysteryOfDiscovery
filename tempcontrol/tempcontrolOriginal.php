<html>
<head>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<script type="text/javascript">

function $(id)
{
	return document.getElementById(id);
}

//<!-- INITIAL VARS -->
//TimeLine
//12a   1a    2a    3a    4a    5a    6a    7a    8a    9a    10a   11a   12p   1p    2p    3p    4p    5p    6p    7p    8p    9p    10p   11p     
var outTempAtTime = 
[65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,87,86,85,84,83,82,81,80,79,78,77,76,75,74,73,72,71,70,69,68,67,66,65,64];
var peopleAtTime  = 
[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 3, 5, 8, 13,21,34,37,36,38,32,31,28,31,26,20,15,21,27,30,29,26,21,19,15,10,9, 4, 2, 1, 0, 0];
var dayNightPosAtTime =
[-540,-577, -615, -652, -690, -727, -765, -802, -840, -877, -915, -952, -90,  -127, -165, -202, -240, -277, -315, -352, -390, -427, -465, -502];

var seconds = 0;
var timerRunning = 0;
var outsideTemp=65;
var insideTemp=72;
var people=0;
var windowsOpen=0;
var heatingOn=0;
var coolingOn=0;
var anger=0;
var cost=0;
var nextCost=100;
var totalAnger=0;
var nextAnger=3000;
var timer;
var x = new XMLHttpRequest();
var win = false;
document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

function timerToggle()
{
	if(!timerRunning)
	{
		refreshData();

		timerRunning=1;
		$('intro').style.display="none";
		$('outtro').style.display="none";
		$('game').style.display="inline";

		timer=setTimeout("update()",1000);
	}
	else
	{
		timerRunning=0;
		clearTimeout(timer);
	}
}

function update()
{
	seconds++;
	outsideTemp = outTempAtTime[seconds%48];
	people = peopleAtTime[seconds%48];

	difference=outsideTemp-insideTemp;
	//insideTemp+=(difference/(2+(windowsOpen*18))); // ugly if statement turned to one ugly line
	if(windowsOpen)
	{
		insideTemp+=(difference/2);
	}
	else
	{
		insideTemp+=(difference/6);
	}
	if(coolingOn)
	{
		insideTemp-=2;
		cost+=40;
	}
	if(heatingOn)
	{
		insideTemp+=2;
		cost+=40;
	}

	insideTemp+=people/60;
	anger=people*4*(Math.abs(insideTemp-72));
	totalAnger+=anger;

	//Play Sounds
	if(totalAnger > nextAnger)
	{
		nextAnger+=12000;
		$('complaintSound').play();
	}
	if(cost > nextCost)
	{
		nextCost+=200;
		$('cashSound').play();
	}

	//Text Update
	$('outside').innerHTML=outsideTemp + "&deg;";
	$('cash').innerHTML="$" + cost;
	$('complaints').innerHTML=Math.floor(totalAnger/3000);

	//UI Update
	$('daynight').style.left=dayNightPosAtTime[Math.floor(seconds/2)%24];
	$('red').style.width=(totalAnger*211/30000);
	$('blue').style.width=(cost*211/2000);

	//NEEDLE :O
	var context = $('needle').getContext("2d");
	context.width = $('needle').width;   // Clear canvas
	context.clearRect(0,0,320,436);      // Above wasn't working apparently, so this should do it...

	context.beginPath();
	context.moveTo(160, 436);
	context.lineTo((insideTemp*4-128), 60);
	context.closePath();
	context.closePath();
	context.stroke();

	timer=setTimeout("update()",1000);

	//<!-- END STATES -->
	if(seconds == 75) // WIN
	{
		timerToggle();
		$('outtro').style.display="inline";
		$('intro').style.display="hidden";
		$('score').innerHTML="Congratulations! "+
			"<br/><br/>Tap Anywhere To Return"+
			"<br/><br/>Money Spent: $" + cost + 
			"<br/>Complaints Filed: " + Math.floor(totalAnger/3000) + 
			"<br/>Score ($$ x Complaints): <b>" + Math.floor(totalAnger/3000)*cost + "</b>";

		$('victory').play();
		pingARIS();
		win = true;
	}
	else
	{ 
		if(totalAnger/3000>10) // LOSE
		{
			timerToggle();
			$('outtro').style.display="inline";
			$('score').innerHTML="Sorry! Too many people complained...<div onClick='timerToggle()'><br/>Play Again?</div>";
		}
		if(cost>2000) // LOSE
		{
			timerToggle();
			$('outtro').style.display="inline";
			$('score').innerHTML="Sorry! You spent too much cash...<div onClick='timerToggle()'><br/>Play Again?</div>";
		}
	}
}

function refreshData()
{
	seconds = 0;
	timerRunning = 0;
	outsideTemp=65;
	insideTemp=72;
	people=0;
	windowsOpen=0;
	heatingOn=0;
	coolingOn=0;
	anger=0;
	cost=0;
	nextCost=100;
	totalAnger=0;
	nextAnger=3000;

	$('outside').innerHTML="72&deg;";
	$('complaints').innerHTML="0";
	$('cash').innerHTML="$0";

	$('daynight').style.left=0;
	$('red').style.width=20;
	$('blue').style.width=20;
}

//<!-- INPUT FUNCTIONS -->
function toggleHeat()
{
	if(heatingOn == 0) heatOn();
	else heatOff();
}
function toggleCool()
{
	if(coolingOn == 0) coolOn();
	else coolOff();
}
function toggleWindow()
{
	if(windowsOpen == 0) windowOpen();
	else windowClosed();
}
function heatOn()
{
	heatingOn=1;
	$('heat').style.display="inline";
}
function heatOff()
{
	heatingOn=0;
	$('heat').style.display="none";
}
function windowOpen()
{
	windowsOpen=1;
	$('windows').style.display="inline";
}
function windowClosed()
{
	windowsOpen=0;
	$('windows').style.display="none";
}
function coolOn()
{
	coolingOn=1;
	$('cool').style.display="inline";
}
function coolOff()
{
	coolingOn=0;
	$('cool').style.display="none";
}

//<!-- ARIS FUNCTIONS -->
function pingARIS()
{
	<?php if (!$_GET[playerId]) $_GET[playerId] = 0; ?>
		x.open("GET", "http://arisgames.org/server/json.php/aris_1_5.webhooks.setWebHookReq/344/30/0/"+<?php echo $_GET[playerId] ?>, true);
	x.oncomplete=refreshConvos();
	x.send();
}
function succeed(){
	if(!win){
		timerToggle();
	}
	else{
		refreshConvos();
		closeMe();
	}
}

function refreshConvos(){
	document.location.href = "aris://refreshStuff";
}

function closeMe(){
	document.location.href = "aris://closeMe";
}

</script>
</head>
<body>

<!-- GAME --> 
<span id="game" style="position:absolute; top:0; left:0; display:inline;">
<span id="daynight" style="position:absolute; top:0; left:0;">
<img src = "art/pieces/daynight.png" />
</span>
<span id="background" style="position:absolute; top:0; left:0;">
<img src = "art/pieces/bg.png" />
</span>
<canvas id="needle" width="320" height="436" style="position:absolute; top:0; left:0;">

</canvas>
<span id="needlecover" style="position:absolute; top:0; left:0;">
<img src = "art/pieces/needlecover.png" />
</span>
<span style="position:absolute; top:208; left:55;">
<img id="red" src = "art/pieces/red.png" style="height:43; width:0;" />
</span>
<span style="position:absolute; top:269; left:55;">
<img id="blue" src = "art/pieces/blue.png" style="height:43; width:0;" />
</span>
<span id="cover" style="position:absolute; top:0; left:0;">
<img src = "art/pieces/outerpanel.png" />
</span>
<span id="outside" style="position:absolute; top:12; left:242; font-family:Arial; font-size:30; font-style:italic; color:#1977B7;">
72&deg;
</span>
<span id="complaints" style="position:absolute; top:222; left:280; font-family:Arial; font-size:13; color:#585858;">
0
</span>
<span id="cash" style="position:absolute; top:286; left:275; font-family:Arial; font-size:12; color:#585858;">
$0
</span>
<span id="heat" style="position:absolute; top:0; left:0; display:none;">
<img src = "art/pieces/heatbutton.png" />
</span>
<span id="windows" style="position:absolute; top:0; left:0; display:none;">
<img src = "art/pieces/windowsbutton.png" />
</span>
<span id="cool" style="position:absolute; top:0; left:0; display:none;">
<img src = "art/pieces/coolbutton.png" />
</span>

<!-- TOUCH BOXES -->
<span id="heatBox" style="position:absolute; top:338; left:20;">
<img src = "art/pieces/clear.png" style="width:80; height:80;" ontouchend="toggleHeat()" /> <!-- ontouchstart="heatOn()" ontouchend="heatOff()" /> -->
</span>
<span id="windowBox" style="position:absolute; top:329; left:112;">
<img src = "art/pieces/clear.png" style=" width:95; height:95" ontouchend="toggleWindow()" /> <!-- ontouchstart="windowOpen()" ontouchend="windowClosed()" /> -->
</span>
<span id="coolBox" style="position:absolute; top:338; left:220; width:80; height:80">
<img src = "art/pieces/clear.png" style="width:80; height:80;" ontouchend="toggleCool()" /> <!-- ontouchstart="coolOn()" ontouchend="coolOff()" /> -->
</span>
</span>

<!-- OUTTRO -->
<span id="outtro" style="position:absolute; top:0; left:0; display:none;" onClick="succeed()">
<img src="art/pieces/outcover.png" style="position:absolute; top:0; left:0; width:320; height:436;"/>
<span id="score" style="position:absolute; top:10; left:10; font-family:Arial; font-size:30; color:#FFFFFF; width:320; height:436;"></span>
</span>

<!-- INTRO -->
<span id="intro" style="position:absolute; top:164; left:113; font-family:Arial; font-size:40; color:#1977B7; display:inline;" onClick="timerToggle()">
PLAY
</span>

<!-- AUDIO (INVISIBLE) -->
<audio id="complaintSound" src="bep.wav" preload="preload"></audio>
<audio id="cashSound" src="caching.wav" preload="preload"></audio>
<audio id="victory" src = "../success.wav" preload="preload" ></audio>

</body>
</html>
