<html>
<head>
<meta name = "viewport" content = "width = device-width">
<STYLE TYPE="text/css">

#game
{
    background-image:url('tempcontrolbg.png');
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
        document.getElementById('game').style.backgroundColor=colorAtTime[0];
        document.getElementById("intro").style.display="none";
        document.getElementById("success").style.display="none";
        document.getElementById("fail").style.display="none";
        document.getElementById("play").style.display="inline";
        updateStatus();
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
        
        document.getElementById('timeBox').innerHTML=0;
        document.getElementById('outTempBox').innerHTML="72&deg;";
        document.getElementById('outThermoEmpty').height=120;
        document.getElementById('outThermoFull').height=170;
        document.getElementById('inTempBox').innerHTML="72&deg;";
        document.getElementById('inThermoEmpty').height=120;
        document.getElementById('inThermoFull').height=170;
        document.getElementById('costBox').innerHTML="$"+cost;
        document.getElementById('peopleBox').innerHTML=people;
        document.getElementById('angerBox').innerHTML=Math.round(totalAnger/1500);
        document.getElementById('game').style.backgroundColor=colorAtTime[0];
        
        document.getElementById("intro").style.display="inline";
        document.getElementById("success").style.display="none";
        document.getElementById("fail").style.display="none";
        document.getElementById("play").style.display="none";
        
        clearTimeout(t);
    }
}

function windows()
{
    windowsOpen=1;
    document.getElementById('window').style.display="none";
}

function windowsClosed()
{
    windowsOpen=0;
    document.getElementById('window').style.display="inline";
}

function heating()
{
    heatingOn=1;
    document.getElementById('heater').src="flame.png";
}

function heatingOff()
{
    heatingOn=0;
    document.getElementById('heater').src="flamedim.png";
}

function cooling()
{
    coolingOn=1;
    document.getElementById('ac').src="snow.png";
}

function coolingOff()
{
    coolingOn=0;
    document.getElementById('ac').src="snowdim.png";
}

function updateStatus()
{
    seconds++;
    t=setTimeout("updateStatus()",250);
    
    outsideTemp = outTempAtTime[seconds%48];
    people = peopleAtTime[seconds%48];
    document.getElementById('game').style.backgroundColor = colorAtTime[Math.round((seconds%48)/2)];
    
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
    
    document.getElementById('timeBox').innerHTML=Math.round(seconds/2);
    
    document.getElementById('outTempBox').innerHTML=Math.round(outsideTemp)+"&deg;";
    document.getElementById('outThermoEmpty').height=192-outsideTemp;//72 = 120
    document.getElementById('outThermoFull').height=outsideTemp+98;//72 = 170
    document.getElementById('inTempBox').innerHTML=Math.round(insideTemp)+"&deg;";
    document.getElementById('inThermoEmpty').height=192-insideTemp;;
    document.getElementById('inThermoFull').height=insideTemp+98;
    
    document.getElementById('costBox').innerHTML="$"+cost;
    document.getElementById('peopleBox').innerHTML=people;
    document.getElementById('angerBox').innerHTML=Math.round(totalAnger/1500);
    
    if(seconds == 200)
    {
        if(((totalAnger/1500)<10) && (cost<2000))
        {
            document.getElementById('play').style.display="none";
            document.getElementById('success').style.display="inline";
            x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_4.webhooks.setWebHookReq/344/8/0/"+<?php echo $_GET[playerId] ?>, true);
            x.oncomplete=refreshConvos();
            x.send();
        }
        else{
            document.getElementById('play').style.display="none";
            document.getElementById('fail').style.display="inline";    
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

<div id="intro" style="display:inline;">
<table border="0" cellspacing="0" cellpadding="0" width="320" height="420">
<tr>
<td>
<b>
Welcome to the Temperature Control System (TCS) for WidMir!
</b>
<p>
Your goal is to maintain an indoor temperature of as close to 72&deg; as possible while there are people in the building. You must do this for 100 hours, and you musn't spend more than $2000 on heating/AC, or get more than 10 complaints. 
<br/>
<br/>
<b>
Things to Know:
</b>
<br/>
-People come in during the day, and leave at night<br/>
-The more people, the more body heat<br/>
-The more people, the more opportunity for complaints<br/>
-An open window is an effective way to alter the temperature without costing any money<br/>
<br/>
<b>Good Luck!</b>
</td>
</tr>
<tr>
<td>
<input type="button" id="timerButton" value="Start Game!" onclick="timer()">

</td>
</tr>
</table>
</div>

<div id="play" style="display:none;">
<!-- Touch Ups -->
<img id="heater" src="thermofullleft.png" style="position:absolute; top:310; left:8;"/>
<img id="heater" src="thermofullright.png" style="position:absolute; top:310; left:168;"/>
<img id="heater" src="thermoemptyleft.png" style="position:absolute; top:22; left:8;" height="325" width="160"/>
<img id="heater" src="thermoemptyright.png" style="position:absolute; top:22; left:168;" height="325" width="160"/>
<!-- Game Images -->
<img id="heater" src="flamedim.png" style="position:absolute; top:310; left:85;" ontouchstart="heating()" ontouchend="heatingOff()"/>
<img id="ac" src="snowdim.png" style="position:absolute; top:310; left:190;" ontouchstart="cooling()" ontouchend="coolingOff()"/>
<img id="window" src="closedWindow.png" style="position:absolute; top:223; left:96; display:inline;" ontouchstart="windows()" ontouchend="windowsClosed()"/>



<!-- Game Text -->
<div id="timeBox" style="position:absolute; top:43; left:125;">0</div>
<div id="costBox" style="position:absolute; top:77; left:132">$0</div>
<div id="peopleBox" style="position:absolute; top:43; left:225;">0</div>
<div id="angerBox" style="position:absolute; top:77; left:252;">0</div>
<div id="outTempBox" style="position:absolute; top:385; left:305;">0&deg;</div>
<div id="inTempBox" style="position:absolute; top:385; left:20;">0&deg;</div>


<table id="game" border="0" cellspacing="0" cellpadding="0" width="320" height="420" style="backgroundColor:black;">
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

<div id="success" style="display:none;">
Congratulations! You've succeeded!
</div>

<div id="fail" style="display:none;">
Sorry, try again? 
<input type="button" value="Reset" onclick="timer()">

</div>

</body>
</html>