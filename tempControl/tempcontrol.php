<html>
<head>
<meta name="viewport" content="width=320, user-scalable=no"/>
<script src="arisjs.js" type="text/javascript"></script>
<script type="text/javascript">

function $(id)
{
	return document.getElementById(id);
}

//<!-- INITIAL VARS -->
//TimeLine
//12a   1a    2a    3a    4a    5a    6a    7a    8a    9a    10a   11a   12p   1p    2p    3p    4p    5p    6p    7p    8p    9p    10p   11p     
var outTempAtTime = 
[65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,87,86,85,84,83,82,81,80,79,78,77,76,75,74,73,72,71,70,69,68,67,66,65,64,63];
var peopleAtTime  = 
[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 3, 5, 8, 13,21,34,37,36,38,32,31,28,31,26,20,15,21,27,30,29,26,21,19,15,10,9, 4, 2, 1, 0, 0, 0];
var dayNightPosAtTime =
[-540,
-561,
-582,
-603,
-624,
-645,
-666,
-687,
-708,
-729,
-750,
-771,
-792,
-813,
-834,
-855,
-876,
-897,
-918,
-939,
-960,
-981,
-1002,
-1023,
-1044,
-1065,
-1086,
-1107,
-1128,
-1149,
-1170,
-1191,
-1212,
-1233,
-1254,
-1275,
-1296,
-1317,
-1338,
-1359,
-1380,
-1401,
-1422,
-1443,
-1464,
-1485,
-1506,
-1527,
-1548,
-1569,
-1590,
-1611,
-1632,
-1653,
-1674,
-1695,
-1716,
-1737,
-1758,
-1779,
-1800,
-1821,
-1842,
-1863,
-1884,
-1905,
-1926,
-1947,
-1968,
-1989,
-2010,
-2031,
-2052,
-2073,
-2094,
-2115,
-2136,
-2157,
-2178,
-2199,
-2220,
-2241,
-2262,
-2283,
-2304,
-2325,
-2346,
-2367,
-2388,
-2409,
-2430,
-2451,
-2472,
-2493,
-2514,
-2535];

var seconds = 0;
var fractionOfSeconds = 0;
var fractionOfSecondsPerSecond = 10; //must be less than 1000
var updateInterval = 1000/fractionOfSecondsPerSecond;
var timerRunning = 0; //boolean indicating the timer has started
var outsideTemp=65;
var minAcceptableTemp = 70;
var maxAcceptableTemp = 74;
var insideTemp=72;
var people=0;
var windowsOpen=0;
var heatingOn=0;
var coolingOn=0;
var anger=0;
var cost=0;
var nextCost=100;
var numberComplaints = 0;
var totalAnger=0;
var nextAnger=3000;
var timer;
var x = new XMLHttpRequest();
var win = false;
document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

function timerToggle()
{
	ARIS.prepareMedia(34503); //34167 in final game
	ARIS.prepareMedia(34504); //34168 in final game
//	ARIS.prepareMedia();

	if(!timerRunning)
	{
		refreshData();

		timerRunning=1;
		$('intro').style.display="none";
		$('outtro').style.display="none";
		$('game').style.display="inline";

		timer=setTimeout("update()", updateInterval);
	}
	else
	{
		timerRunning=0;
		clearTimeout(timer);
	}
}

function update()
{
	fractionOfSeconds++;
	if(fractionOfSeconds == fractionOfSecondsPerSecond){
	fractionOfSeconds = 0;
	seconds++;
	}

        if(seconds > 13 && seconds < 46 || seconds > 60 && seconds < 94)
	$('backgroundImage').src = "art/pieces/bg.png"; 
	else
        $('backgroundImage').src = "art/pieces/bgexpanded.png"; 

        outsideTemp = (fractionOfSeconds/fractionOfSecondsPerSecond) * outTempAtTime[seconds%48] + (1-(fractionOfSeconds/fractionOfSecondsPerSecond)) * outTempAtTime[(seconds%48) +1];
        people = (fractionOfSeconds/fractionOfSecondsPerSecond) * peopleAtTime[seconds%48] + (1-(fractionOfSeconds/fractionOfSecondsPerSecond)) * peopleAtTime[(seconds%48) +1];

	difference=(outsideTemp-insideTemp)/fractionOfSecondsPerSecond;
	//insideTemp+=(difference/(2+(windowsOpen*18))); // ugly if statement turned to one ugly line
	if(windowsOpen)
		insideTemp+=(difference); //originally /2
	else
		insideTemp+=(difference/6);
	if(coolingOn)
	{
		insideTemp-=2/fractionOfSecondsPerSecond;
		cost+=40/fractionOfSecondsPerSecond;
	}
	if(heatingOn)
	{
		insideTemp+=2/fractionOfSecondsPerSecond;
		cost+=40/fractionOfSecondsPerSecond;
	}
 //	insideTemp+=people/(60*fractionOfSecondsPerSecond); 
	if(insideTemp < minAcceptableTemp || insideTemp > maxAcceptableTemp) {
	anger=(people*4*(Math.abs(insideTemp-72)))/fractionOfSecondsPerSecond;
	totalAnger+=anger;
	}

	//Play Sounds
	if(totalAnger > nextAnger)
	{
		nextAnger+=3000;
	        numberComplaints++;
		ARIS.playMedia(34503); //34167 in final game
	}
	if(cost > nextCost)
	{
		nextCost+=200;
		ARIS.playMedia(34504); //34168 in final game

	}

	//Text Update
	$('outside').innerHTML= Math.floor(outsideTemp) + "&deg;"; 
	$('cash').innerHTML="$" + Math.floor(cost);
	$('complaints').innerHTML=numberComplaints;

	//UI Update
	$('daynight').style.left=dayNightPosAtTime[seconds%96];
	$('red').style.width=((numberComplaints/10)*212);
	$('blue').style.width=(Math.floor(cost*211/2000));

	//NEEDLE :O
	var context = $('needle').getContext("2d");
	context.width = $('needle').width;   // Clear canvas
	context.clearRect(0,0,320,436);      // Above wasn't working apparently, so this should do it...

	context.beginPath();
	context.moveTo(160, 436);
	var xPositionNeedleTip;
        if(insideTemp <= 84) xPositionNeedleTip = 39 + (242-(((84-insideTemp)/24) * 242));
	else xPositionNeedleTip = 285;
	context.lineTo(xPositionNeedleTip, 70);
	context.closePath();
	context.closePath();
	context.stroke();

	timer=setTimeout("update()", updateInterval);

	//<!-- END STATES -->
	if(seconds == 75) // WIN
	{
		timerToggle();
		$('outtro').style.display="inline";
		$('intro').style.display="none";
		$('score').innerHTML="<br/><br/>Congratulations! <br/> You kept the building cool without too many complaints or spending too much money!"+
			"<br/><br/><br/><br/><small>Tap Anywhere To Continue";

		//$('victory').play();
//		pingARIS();
		win = true;
	}
	else
	{ 
		if(totalAnger/3000>10) // LOSE
		{
			timerToggle();
			$('outtro').style.display="inline";
			$('score').innerHTML="<br/><br/>Sorry! <br/>Too many people complained...<div onClick='timerToggle()'><br/>Click Here to Play Again! </div><br/><br/><br/>Press Close to Leave";
		}
		if(cost>2000) // LOSE
		{
			timerToggle();
			$('outtro').style.display="inline";
			$('score').innerHTML="<br/><br/>Sorry! <br/>You spent too much cash...<div onClick='timerToggle()'><br/>Click Here to Play Again! <br/><br/><br/>Press Close to Leave</div>";
		}
	}
}

function refreshData()
{
	fractionOfSeconds = 0;
	seconds = 0;
	timerRunning = 0;
	outsideTemp=65;
	insideTemp=72;
	minAcceptableTemp = 70;
        maxAcceptableTemp = 74;
	people=0;
	windowsOpen=0;
	heatingOn=0;
	coolingOn=0;
	anger=0;
	cost=0;
	nextCost=100;
	totalAnger=0;
	nextAnger=3000;
	numberComplaints = 0;

	$('outside').innerHTML="72&deg;";
	$('complaints').innerHTML="0";
	$('cash').innerHTML="$0";

	$('daynight').style.left=0;
	$('red').style.width=0;
	$('blue').style.width=0;
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
//REMOVE FROM FINAL
/*
function pingARIS()
{
	var params = ARIS.parseURLParams(window.location);
	var playerId = params[2];
	x.open("GET", "http://arisgames.org/server/json.php/aris_1_5.webhooks.setWebHookReq/344/30/0/"+playerId, true);
	x.oncomplete=refreshConvos();
	x.send();
}
*/
function succeed(){
	if(win){
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
<img id="backgroundImage" src = "art/pieces/bgexpanded.png" />
</span>
<canvas id="needle" width="320" height="436" style="position:absolute; top:0; left:0;">

</canvas>
<span id="needlecover" style="position:absolute; top:0; left:0;">
<img id = "needlecoverimage" src = "art/pieces/needlecover.png" />
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
<span  id="outsideName" style="position:absolute; top:2; left:242; font-family:Arial; font-size:10; font-style:italic; color:#1977B7;">
Outside:
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
<span id="score" style="position:absolute; top:0; left:0; font-family:Arial; font-size:30; text-align: center; color:#FFFFFF; width:320; height:436;"></span>
</span>

<!-- INTRO -->
<span id="intro" style="position:absolute; top:0; left:0; width:320; height:436; display:inline;" onClick="timerToggle()">
<img src="art/pieces/outcover.png" style="position:absolute; top:0; left:0; width:320; height:436;"/>
<span id="introText" style="position:absolute; font-family:Arial; font-size:30; text-align: center; color:#FFFFFF;"> <p><br/><br/>Try to make it two days without complaints and without spending too much money. <br/><br/><br/><br/>Tap anywhere to begin</p>
</span>
</span>

<!-- AUDIO (INVISIBLE) -->
<audio id="complaintSound" src="bep.wav" preload="preload"></audio>
<audio id="cashSound" src="caching.wav" preload="preload"></audio>
<audio id="victory" src = "../success.wav" preload="preload" ></audio>

</body>
</html>
