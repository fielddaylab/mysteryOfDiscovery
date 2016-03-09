<html>
<head>
<meta name = "viewport" content = "width = device-width">
<STYLE TYPE="text/css">

.screen
{
background-image:url('WidMirTempControlPortraitBG.png');
}

.inner
{
background-image:none;
}

</STYLE>


<script type="text/javascript">
var seconds=0;
var timerRunning=0;
//TimeLine           12a         1a          2a          3a          4a          5a          6a          7a          8a          9a          10a         11a         12p         1p          2p          3p          4p          5p          6p          7p          8p          9p          10p         11p     
var outTempAtTime = [65,   66,   67,   68,   69,   70,   71,   72,   73,   74,   75,   76,   77,   78,   79,   80,   81,   82,   83,   84,   85,   86,   87,   88,   87,   86,   85,   84,   83,   82,   81,   80,   79,   78,   77,   76,   75,   74,   73,   72,   71,   70,   69,   68,   67,   66,   65,   64];
var peopleAtTime  = [0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    1,    1,    2,    3,    5,    8,    13,   21,   34,   37,   36,   38,   32,   31,   28,   31,   26,   20,   15,   21,   27,   30,   29,   26,   21,   19,   15,   10,   9,    4,    2,    1,    0,    0];
var colorAtTime   = ["#000000",  "#000022",  "#001144",  "#002266",  "#003377",  "#004488",  "#005599",  "#0066AA",  "#0077BB",  "#0088CC",  "#0099DD",  "#00AAEE",  "#00BBFF",  "#00AAEE",  "#0099DD",  "#0088CC",  "#0077BB",  "#0066AA",  "#005599",  "#004488",  "#003377",  "#002266",  "#001144",  "#000022"];

var outsideTemp=65;
var insideTemp=72;
var people = 0;
var windowsOpen=0;
var heatingOn=0;
var coolingOn=0;
var anger=0;
var cost=0;
var totalAnger=0;
var difference=0;
var x = new XMLHttpRequest();
var t;

document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

function timer()
{
if (!timerRunning)
  {
  timerRunning=1;
  updateStatus();
  document.getElementById('timerButton').value="Reset";
  document.getElementById('prompt').innerHTML="";

  }
else
  {
  
  timerRunning=0;
  seconds = 0;
  outsideTemp=65;
  insideTemp=72;
  people=0;
  anger=0;
  cost=0;
  totalAnger=0;
  difference=0;
  
  document.getElementById('timeBox').innerHTML="HRS Passed: "+Math.round(seconds/2);
  document.getElementById('outTempBox').innerHTML=Math.round(outsideTemp)+"&deg;";
  document.getElementById('outThermoEmpty').height=60-((outsideTemp-42)/2);
  document.getElementById('outThermoFull').height=((outsideTemp-42)/2);
  document.getElementById('inTempBox').innerHTML=Math.round(insideTemp)+"&deg;";
  document.getElementById('inThermoEmpty').height=60-((insideTemp-42)/2);
  document.getElementById('inThermoFull').height=((insideTemp-42)/2);
  document.getElementById('costBox').innerHTML="Money Spent: $"+cost;
  document.getElementById('peopleBox').innerHTML="People: "+people;
  document.getElementById('angerBox').innerHTML="Complaints: "+Math.round(totalAnger/1500);
  document.getElementById('main').style.backgroundColor="skyblue";
  
  document.getElementById('prompt').innerHTML="Welcome to WidMirSim! Your objective is to keep the internal temperature as close to 72&deg; for 100 hours. Don't get more than 100 complaints, and DON'T spend more than $1000!";
  
  clearTimeout(t);
  document.getElementById('timerButton').value="Start Timer";
  }
}

function windows()
{
  windowsOpen=1;
  document.getElementById('windowIMG').src="WidMirTempControlWindowOPEN.png";
}

function windowsClosed()
{
  windowsOpen=0;
  document.getElementById('windowIMG').src="WidMirTempControlWindowCLOSED.png";
}

function heating()
{
  heatingOn=1;
  document.getElementById('heaterIMG').src="WidMirTempControlHeaterON.png";
}

function heatingOff()
{
  heatingOn=0;
  document.getElementById('heaterIMG').src="WidMirTempControlHeaterOFF.png";
}

function cooling()
{
  coolingOn=1;
  document.getElementById('coolerIMG').src="WidMirTempControlACON.png";
}

function coolingOff()
{
  coolingOn=0;
  document.getElementById('coolerIMG').src="WidMirTempControlACOFF.png";
}

function updateStatus()
{
seconds++;
t=setTimeout("updateStatus()",250);

outsideTemp = outTempAtTime[seconds%48];
people = peopleAtTime[seconds%48];
document.getElementById('main').style.backgroundColor = colorAtTime[Math.round((seconds%48)/2)];

difference=outsideTemp-insideTemp;
if(windowsOpen)
  {
  insideTemp+=(difference/2);
  }
else
  {
  insideTemp+=(difference/20);
  }

if(coolingOn)
  {
  insideTemp-=2;
  cost+=20;
  }
if(heatingOn)
  {
  insideTemp+=2;
  cost+=20;
  }

insideTemp+=people/15;
anger=people*(Math.abs(insideTemp-72));
totalAnger+=anger;
  
document.getElementById('timeBox').innerHTML="HRS Passed: "+Math.round(seconds/2);

document.getElementById('outTempBox').innerHTML=Math.round(outsideTemp)+"&deg;";
document.getElementById('outThermoEmpty').height=60-((outsideTemp-42)/2);
document.getElementById('outThermoFull').height=((outsideTemp-42)/2);
document.getElementById('inTempBox').innerHTML=Math.round(insideTemp)+"&deg;";
document.getElementById('inThermoEmpty').height=60-((insideTemp-42)/2);
document.getElementById('inThermoFull').height=((insideTemp-42)/2);

document.getElementById('costBox').innerHTML="Money Spent: $"+cost;
document.getElementById('peopleBox').innerHTML="People: "+people;
document.getElementById('angerBox').innerHTML="Complaints: "+Math.round(totalAnger/1500);

if(seconds == 200)
  {
  document.getElementById('prompt').innerHTML="TimesUp! TotalAnger="+(totalAnger/1500)+" cost="+cost+" expression="+(((totalAnger/1500)<1000000) && (cost<100000000000));
  if(((totalAnger/1500)<1000000) && (cost<100000000000))
    {
    	  document.getElementById('prompt').innerHTML="Good Work! You've completed the mission! Feel free to continue playing, or just exit out!";
    	  x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_4.webhooks.setWebHookReq/344/8/0/"+<?php echo $_GET[playerId] ?>, true);
    	  x.send();
        x.oncomplete=refreshConvos();
		//Success!
    }
    else{
      document.getElementById('prompt').inngerHTML="Sorry! You FAILED!";
    }
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
<body padding="0">
<div style="
      top:10;
      left: 130;
      position: absolute;
      z-index: 1;
      visibility: show;">
<table width="190" height="100" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<b>
<div id="prompt">
HERE-> <?php echo $_REQUEST['playerId'] ?> <-HERE
	Welcome to WidMirSim! Your objective is to keep the internal temperature as close to 72&deg; for 100 hours. Don't get more than 100 complaints, and DON'T spend more than $1000!
</div>
</b>
</td>
</tr>
</table>
</div>

<form>
<div style="
	top:0;
	left:0;
	position: absolute;
	z-index:0;
	visibility:show;">
<table id="main" border="0" cellspacing="0" cellpadding="0" width="320" height="356" class="screen" bgcolor="skyblue">
	<!--Stats-->
	<tr height="72">
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="320" height="72">
				<tr>
					<td>
						<div id="timeBox">HRS Passed: 0</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="costBox">Money Spent: $0</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="peopleBox">People: 0</div> 
					</td>
				</tr>
				<tr>
					<td>
						<div id="angerBox">Complaints: 0</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<!--Feedback-->
	<tr height="23">
		<td>
			<input type="button" id="timerButton" value="Start Timer" onclick="timer()">
		</td>
	</tr>
	
	<!--Thermos-->
	<tr height="160">
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="320">
				<tr height="150">
					<td width="30">
					</td>
					<td width="30">
						<table border="0" cellspacing="0" cellpadding="0" width="30" >
							<tr>
								<td>	
									<img  src="WidMirTempControlThermo_01.png">
								</td>
							</tr>
							<tr>
								<td>
									<img id="inThermoEmpty" width="30" height="30" src="WidMirTempControlThermo_02.png">
								</td>
							</tr>
							<tr>
								<td>
									<img id="inThermoFull" width="30" height="30" src="WidMirTempControlThermoFill.png">
								</td>
							</tr>
							<tr>
								<td>
									<img src="WidMirTempControlThermo_03.png">
								</td>
							</tr>
						</table>
					</td>
					<td width="100">
						<div id="inTempBox">72&deg;</div>
					</td>
					<td width="30">
					</td>
					<td width="30">
						<table border="0" cellspacing="0" cellpadding="0" width="30">
							<tr>
								<td>	
									<img  src="WidMirTempControlThermo_01.png">
								</td>
							</tr>
							<tr>
								<td>
									<img id="outThermoEmpty" width="30" height="30" src="WidMirTempControlThermo_02.png">
								</td>
							</tr>
							<tr>
								<td>
									<img id="outThermoFull" width="30" height="30" src="WidMirTempControlThermoFill.png">
								</td>
							</tr>
							<tr>
								<td>
									<img src="WidMirTempControlThermo_03.png">
								</td>
							</tr>
						</table>
					</td>
					<td width="130">
						<div id="outTempBox">72&deg;</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<!--Buttons-->
	<tr height="100">
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="320" height="100">
				<tr>
					<td align="center" width="100">
						<img id="heaterIMG" onMouseDown="return heating()" onMouseUp="return heatingOff()" src="WidMirTempControlHeaterOFF.png">
					</td>
					<td align="center" width="100">
						<img id="coolerIMG" onMouseDown="return cooling()" onMouseUp="return coolingOff()" src="WidMirTempControlACOFF.png">
					</td>
					<td align="center" width="100">
						<img id="windowIMG" onMouseDown="return windows()" onMouseUp="return windowsClosed()" src="WidMirTempControlWindowCLOSED.png">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr height="10">
	</tr>
</table>
</div>
</form>

<br />

</body>
</html>