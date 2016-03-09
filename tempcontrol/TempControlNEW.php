<html>
<head>
<meta name = "viewport" content = "width = device-width">
<STYLE TYPE="text/css">

#game
{
    background-image:url('thisFileDoesntExist.png');
}

</STYLE>


<script type="text/javascript">
var seconds=0;
var miniseconds=0;
var timerRunning=0;
//TimeLine           12a         1a          2a          3a          4a          5a          6a          7a          8a          9a          10a         11a         12p         1p          2p          3p          4p          5p          6p          7p          8p          9p          10p         11p     
var outTempAtTime = [65,   66,   67,   68,   69,   70,   71,   72,   73,   74,   75,   76,   77,   78,   79,   80,   81,   82,   83,   84,   85,   86,   87,   88,   87,   86,   85,   84,   83,   82,   81,   80,   79,   78,   77,   76,   75,   74,   73,   72,   71,   70,   69,   68,   67,   66,   65,   64];
var peopleAtTime  = [0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    0,    1,    1,    2,    3,    5,    8,    13,   21,   34,   37,   36,   38,   32,   31,   28,   31,   26,   20,   15,   21,   27,   30,   29,   26,   21,   19,   15,   10,   9,    4,    2,    1,    0,    0];
var colorAtTime   = ["#000000",  "#000022",  "#001144",  "#002266",  "#003377",  "#004488",  "#005599",  "#0066AA",  "#0077BB",  "#0088CC",  "#0099DD",  "#00AAEE",  "#00BBFF",  "#00AAEE",  "#0099DD",  "#0088CC",  "#0077BB",  "#0066AA",  "#005599",  "#004488",  "#003377",  "#002266",  "#001144",  "#000022"];

var gameOver=false;
var outsideTemp=65;
var insideTemp=72;
var people = 0;
var windowsOpen=0;
var heatingOn=0;
var coolingOn=0;
var anger=0;
var cost=0;
var nextCost=100;
var totalAnger=0;
var nextAnger=3000;
var difference=0;
var x = new XMLHttpRequest();
var t;

document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

function timer()
{
    if (!timerRunning)
    {
        timerRunning=1;
        //document.getElementById('game').style.backgroundColor=colorAtTime[0];
        document.getElementById("intro").style.display="none";
        document.getElementById("success").style.display="none";
        document.getElementById("failDollas").style.display="none";
        document.getElementById("failAnger").style.display="none";
        document.getElementById("play").style.display="inline";
        
        document.getElementById("daynightimg").style.position = 'absolute';
	   document.getElementById("daynightimg").style.visibility = 'hidden';
	    
	   	 var canvas = document.getElementById('canvas');
   		 var cContext = document.getElementById('canvas').getContext('2d');
   		 cContext.clearRect(0,0,canvas.width,canvas.height);
   		 cContext.translate(canvas.width/2,canvas.height/2);
   		 cContext.rotate(Math.PI*3/2);
   		 cContext.translate(canvas.width*-1/2,canvas.height*-1/2);
   		 cContext.drawImage(document.getElementById('daynightimg'),0,0);
       
        tick();
    }
    else
    {
        
        timerRunning=0;
        seconds = 0;
        miniseconds = 0;
        outsideTemp=65;
        insideTemp=72;
        people=0;
        anger=0;
        cost=0;
        totalAnger=0;
        difference=0;
        gameOver=false;
        
        document.getElementById('timeBox').innerHTML=0;
        document.getElementById('outTempBox').innerHTML="72&deg;";
        document.getElementById('outThermoEmpty').height=120;
        document.getElementById('outThermoFull').height=170;
        document.getElementById('inTempBox').innerHTML="72&deg;";
        document.getElementById('inThermoEmpty').height=120;
        document.getElementById('inThermoFull').height=170;
        document.getElementById('costBox').innerHTML="$"+cost;
        document.getElementById('angerBox').innerHTML=Math.floor(totalAnger/3000);
        //document.getElementById('game').style.backgroundColor=colorAtTime[0];
        
        document.getElementById("intro").style.display="inline";
        document.getElementById("success").style.display="none";
        document.getElementById("failDollas").style.display="none";
        document.getElementById("failAnger").style.display="none";
        document.getElementById("play").style.display="none";
        
        clearTimeout(t);
    }
}

function windows()
{
    windowsOpen=1;
    document.getElementById('window').src="windowdim.png";
}

function windowsClosed()
{
    windowsOpen=0;
    document.getElementById('window').src="window.png";
}

function heating()
{
    heatingOn=1;
    document.getElementById('heater').src="heatdim.png";
}

function heatingOff()
{
    heatingOn=0;
    document.getElementById('heater').src="heat.png";
}

function cooling()
{
    coolingOn=1;
    document.getElementById('ac').src="cooldim.png";
}

function coolingOff()
{
    coolingOn=0;
   document.getElementById('ac').src="cool.png";
}

function tick()
{
	t=setTimeout("tick()",10);
	miniseconds++;
	//Update time box
    document.getElementById('timeBox').innerHTML="Time Remaining:"+ Math.round((100 - miniseconds/50)*100)/100;
	if(miniseconds%25 == 0)
	{
		updateStatus();
	}
}

function updateStatus()
{
    seconds++;
    
    outsideTemp = outTempAtTime[seconds%48];
    people = peopleAtTime[seconds%48];
    //document.getElementById('game').style.backgroundColor = colorAtTime[Math.floor((seconds%48)/2)];
    
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
    
    //Calclulate Values
    insideTemp+=people/15;
    anger=people*(Math.abs(insideTemp-72));
    totalAnger+=anger;
  
  	//Rotate Sun Thing
    var canvas = document.getElementById('canvas');
    var cContext = document.getElementById('canvas').getContext('2d');
    cContext.clearRect(0,0,canvas.width,canvas.height);
    cContext.translate(canvas.width/2,canvas.height/2);
    cContext.rotate(Math.PI/24);
    cContext.translate(canvas.width*-1/2,canvas.height*-1/2);
    cContext.drawImage(document.getElementById('daynightimg'),0,0);
    
    //Update thermometers
    document.getElementById('outTempBox').innerHTML=Math.floor(outsideTemp)+"&deg;";
    document.getElementById('outThermoEmpty').height=192-outsideTemp;//72 = 120
    document.getElementById('outThermoFull').height=outsideTemp+98;//72 = 170
    document.getElementById('inTempBox').innerHTML=Math.floor(insideTemp)+"&deg;";
    document.getElementById('inThermoEmpty').height=192-insideTemp;;
    document.getElementById('inThermoFull').height=insideTemp+98;
    
    //Update cost/Anger
    document.getElementById('costBox').innerHTML="Cash Spent:$"+cost;
    document.getElementById('cashBar').style.height=(cost/2000)*100;
    document.getElementById('cashBar').style.top=155-((cost/2000)*100);
    document.getElementById('angerBox').innerHTML="Complaints:"+Math.floor(totalAnger/3000);
    document.getElementById('complaintsBar').style.height=((totalAnger/3000)/10)*100;
    document.getElementById('complaintsBar').style.top=155-((totalAnger/3000)/10)*100;
    
     if(totalAnger > nextAnger && !gameOver)
    {
    		nextAnger+=3000;
    		var anger = document.getElementById('anger');
    		anger.play();
    }
    if(cost > nextCost && !gameOver)
    {
    		nextCost+=100;
    		document.getElementById('cash').play();
    }
    //document.getElementById('debug').innerHTML="Put Debug Stuff Here!";
    
    if((seconds == 200 || totalAnger/3000>10 || cost>2000) && !gameOver)
    {
        gameOver=true;
        if(((totalAnger/3000)<10) && (cost<2000))
        {
            document.getElementById('play').style.display="none";
            document.getElementById('success').style.display="inline";
            document.getElementById('score').innerHTML="Money Spent: $" + cost + "<br/>Complaints Filed: " + Math.floor(totalAnger/3000) + "<br/>Score ($$ x Complaints): <b>" + Math.floor(totalAnger/3000)*cost +"</b>";
            x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_4.webhooks.setWebHookReq/344/8/0/"+<?php echo $_GET[playerId] ?>, true);
            x.oncomplete=refreshConvos();
            x.send();
        }
        else{
            document.getElementById('play').style.display="none";
            if(cost > 2000){ document.getElementById('failDollas').style.display="inline"; }  
            if(totalAnger/3000 > 10){ document.getElementById('failAnger').style.display="inline"; }  
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
<body>
<div id="intro" style="display:inline;">
<img src="intro.png" onClick="timer()"/>
<input type="button" id="timerButton" value="Start Game!" onClick="timer()">
</div>

<div id="play" style="display:none;">
<!-- Optimal Temp Bar -->
<img src="optimal.png" style="position:absolute; top:168; left:0; width:350; height:1;"/>

<!-- Touch Ups -->
<img src="thermofullleft.png" style="position:absolute; top:310; left:8;"/>
<img src="thermofullright.png" style="position:absolute; top:310; left:168;"/>
<img src="thermoemptyleft.png" style="position:absolute; top:22; left:8;" height="325" width="160"/>
<img src="thermoemptyright.png" style="position:absolute; top:22; left:168;" height="325" width="160"/>

<!-- Game Images -->
<img id="cashBar" src="optimalblue.png" style="position:absolute; top:155; left:90; width:27; height:1;"/>
<img id="complaintsBar" src="optimalblue.png" style="position:absolute; top:155; left:210; width:27; height:1;"/>
<img src="barcover.png" style="position:absolute; top:55; left:90;"/>
<img src="barcover.png" style="position:absolute; top:55; left:210;"/>
<img src="dollar.jpeg" style="position:absolute; top:35; left:94; width:20;"/>
<img src="angryface.png" style="position:absolute; top:35; left:214; width:20;"/>
<div id="daynight" style="position:absolute; top:200; left:60; width:200; height:100;"><img src="daynight.png" id="daynightimg"><canvas id="canvas" width="200" height="200"></canvas></div>
<div id="daynightCover" style="position:absolute; top:290; left:50; width:220; height:120; background-color:#DDDDDD;"></div>
<img id="heater" src="heat.png" style="position:absolute; top:310; left:45; width:70px; height:70px;" ontouchstart="heating()" ontouchend="heatingOff()" onselectstart="return false;" ondragstart="return false;"/>
<img id="ac" src="cool.png" style="position:absolute; top:310; left:137; width:70px; height:70px;" ontouchstart="cooling()" ontouchend="coolingOff()" onselectstart="return false;" ondragstart="return false;"/>
<img id="window" src="window.png" style="position:absolute; top:310; left:225; width:70px; height:70px; background:url(window.png);" ontouchstart="windows()" ontouchend="windowsClosed()" onselectstart="return false;" ondragstart="return false;"/>
<!--
<div id="heater" onselectstart="return false;" ondragstart="return false;" style="position:absolute; top:310; left:45; width:70px; height:70px; background:url(heat.png);" ontouchstart="heating()" ontouchend="heatingOff()"></div>
<div id="ac" onselectstart="return false;" ondragstart="return false;" style="position:absolute; top:310; left:137; width:70px; height:70px; background:url(cool.png);" ontouchstart="cooling()" ontouchend="coolingOff()"></div>
<div id="window" onselectstart="return false;" ondragstart="return false;" style="position:absolute; top:310; left:225; width:70px; height:70px; background:url(window.png);" ontouchstart="windows()" ontouchend="windowsClosed()"></div>
-->
<!-- Game Text -->
<div id="timeBox" style="position:absolute; top:180; left:100;" width="500">Time Remaining:0</div>
<div id="costBox" style="position:absolute; top:10; left:60">Cash Spent:$0</div>
<div id="angerBox" style="position:absolute; top:10; left:180;">Complaints:0</div>
<div id="outTempBox" style="position:absolute; top:385; left:305;">0&deg;</div>
<div id="inTempBox" style="position:absolute; top:385; left:20;">0&deg;</div>


<table id="game" border="0" cellspacing="0" cellpadding="0" width="320" height="420" style="background-color:#DDDDDD;">
<tr>
<td>
</td>
</tr>
<tr height="29">
<td>
<img src="thermotops.png"/>
</td>
</tr>
<tr height="290">
<td>
<!-- INNER THERMOS TABLE-->
<table border="0" cellspacing="0" cellpadding="0" width="320" height="290">
<tr>
<td>

<!--LEFT THERMO TABLE -->
<table border="0" cellspacing="0" cellpadding="0" width="160" height="290">
<tr>
<td>
<img id="inThermoEmpty" src="thermoemptyleft.png" height="120" width="160"/>
</td>
</tr>
<tr>
<td>
<img id="inThermoFull" src="thermofullleft.png" height="170" width="160"/>
</td>
</tr>
</table>

</td>
<td>

<!--RIGHT THERMO TABLE -->
<table border="0" cellspacing="0" cellpadding="0" width="160" height="290">
<tr>
<td>
<img id="outThermoEmpty" src="thermoemptyright.png" height="120" width="160"/>
</td>
</tr>
<tr>
<td>
<img id="outThermoFull" src="thermofullright.png" height="170" width="160"/>
</td>
</tr>
</table>

</td>
</tr>
</table>
<!-- /INNER THERMOS TABLE -->
</td>
</tr>
<tr height="77">
<td>
<img src="thermobottoms.png"/>
</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>
</div>

<div id="success" width="320" style="display:none;">
Congratulations! You've succeeded!<br/><br/><div id="score"></div><br/><br/>Talk to Solaria to find out what to do next!<br/><br/><i>(Or, you can try to beat your score!)<br/><input type="button" value="Reset" onClick="timer()"/></i>
</div>

<!-- FAIL SCREENS -->
<div id="failDollas" width="320" style="display:none;">
<b>You've spent too much money!</b><br/><br/><i>Remember:</i> An open window at night is an effective way to bring in cool air without costing a dime!<br/><br/>Try again? 
<input type="button" value="Reset" onClick="timer()"/>
</div>
<div id="failAnger" style="display:none;">
<b>Too many people complained about the uncomfortable temperature conditions inside the building.</b><br/><br/><i>Remember:</i> At night, you can get the building as cold as you want for cheap, and nobody will be inside to complain.<br/><br/>Try again? 
<input type="button" width="320" value="Reset" onClick="timer()"/>
</div>

<div id="debug"></div>
<audio id="anger" src="bep.wav" preload="preload"></audio>
<audio id="cash" src="caching.wav" preload="preload"></audio>
</body>
</html>