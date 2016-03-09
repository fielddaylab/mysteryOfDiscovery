<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<script src="arisjs.js" type="text/javascript"></script>
<script type="text/javascript">
var code= ['button1', 'button1', 'button2', 'button3', 'button5', 'button8'];
var progress = 0;
var x = new XMLHttpRequest();
var y = new XMLHttpRequest();
var z = new XMLHttpRequest();
var w = new XMLHttpRequest();


var theNote = "";

window.onload = function() {
	ARIS.prepareMedia(34960);
	ARIS.prepareMedia(34961);
	ARIS.prepareMedia(34962);
	ARIS.prepareMedia(34963);
	ARIS.prepareMedia(34964);
	ARIS.prepareMedia(34965);
	ARIS.prepareMedia(34966);
        ARIS.prepareMedia(34967);
	ARIS.prepareMedia(34968);
};

function success(){
	window.scrollTo(0, 0);
//	var noteObj = document.getElementById('fibsong');
//	noteObj.play();
//	setTimeout(function(){noteObj.pause();},10000);
	ARIS.playMedia(34960);
//	x.open("GET", "http://arisgames.org/server/json.php/aris_1_5.webhooks.setWebHookReq/344/32/0/<?php echo $_GET['playerId']; ?>", true);
//	x.send();
//	y.open("GET", "http://arisgames.org/server/json.php/aris_1_5.players.giveItemToPlayer/344/3/<?php echo $_GET['playerId']; ?>/1", true);
//	y.send();
//	x.oncomplete = refreshConvos();   
	document.getElementById("main").style.display="none";
	document.getElementById("success").style.display="inline";
}

function refreshConvos(){
	document.location.href = "aris://refreshStuff";
}

function closeMe(){
	document.location.href = "aris://closeMe";
}
/*
 //iOS introduces a nasty delay on dispaching the click event. Likely something to do with multitouch.
 //As a solution, we can create a scpecial prototype that removes the delay and uses the standard
 //click event name for compatibility with normal browsers
 
 Thank you to http://cubiq.org/remove-onclick-delay-on-webkit-for-iphone for the idea!
 */

function NoClickDelay(el) {
	window.scrollTo(0, 0);
	this.element = el;
	if( window.Touch ) this.element.addEventListener('touchstart', this, false);
}

NoClickDelay.prototype = {
handleEvent: function(e) {
    switch(e.type) {
        case 'touchstart': this.onTouchStart(e); break;
        case 'touchmove': this.onTouchMove(e); break;
        case 'touchend': this.onTouchEnd(e); break;
    }
},
    
onTouchStart: function(e) {
    window.scrollTo(0, 0);
    e.preventDefault();
    this.moved = false;
    
    this.element.addEventListener('touchmove', this, false);
    this.element.addEventListener('touchend', this, false);
},
    
onTouchMove: function(e) {
    window.scrollTo(0, 0);
    this.moved = true;
},
    
onTouchEnd: function(e) {
    window.scrollTo(0, 0);
    this.element.removeEventListener('touchmove', this, false);
    this.element.removeEventListener('touchend', this, false);
    
    if( !this.moved ) {
        var theTarget = document.elementFromPoint(e.changedTouches[0].clientX, e.changedTouches[0].clientY);
        if(theTarget.nodeType == 3) theTarget = theTarget.parentNode;
        
        var theEvent = document.createEvent('MouseEvents');
        theEvent.initEvent('click', true, true);
        theTarget.dispatchEvent(theEvent);
    }
}
};



function buttonPressed(button){
	window.scrollTo(0, 0);
	console.log("buttonPressed(" + button + ")");
	document.getElementById(button).src=("images/" + button + "h.gif");
	setTimeout(function(){document.getElementById(button).src=("images/" + button + ".gif");},500);
	updateProgressIndicatorAfterPress(button);
	initAndPlay(button + 'audio'); 
    
}

function initAndPlay(note){
	
	window.scrollTo(0, 0);
	console.log("initAndPlay(" + note + ")");
	var noteObj = document.getElementById('scale');
	theNote = note;
	noteObj.src = noteObj.src; //fixes glitch with event listeners not getting dispatched the second time
    play(note);
}

function onCanPlay(evt){
	window.scrollTo(0, 0);
	var note = theNote;
	console.log("onCanPlay(" + note + ")");
	play(note);
    
}

function play(note){
	window.scrollTo(0, 0);
	console.log("play(" + note + ")");
    switch(note){
		case "button1audio":
                	ARIS.playMedia(34961);
			break;
		case "button2audio":
                	ARIS.playMedia(34962);
			break;
		case "button3audio":
			ARIS.playMedia(34963);
			break;
		case "button4audio":
			ARIS.playMedia(34964);
			break;
		case "button5audio":
      			ARIS.playMedia(34965); 
			break;
		case "button6audio":
			ARIS.playMedia(34966);
			break;
		case "button7audio":
			ARIS.playMedia(34967);
			break;
		case "button8audio":
			ARIS.playMedia(34968);
			break;
	}
}

function updateProgressIndicatorAfterPress(button){
	window.scrollTo(0, 0);
	console.log("updateProgressIndicator(" + button + ")");
    
	if (code[progress] == button){
		progress++;
		//document.getElementById("progress").innerHTML = progress;
        
        
		//If progress is the size of the code array, we have won!
		if(progress == code.length){
			setTimeout(function() { success(); },800);
		}
	}
	else {
		progress = 0;
	}
}


function loaded() {
	window.scrollTo(0, 0);
	console.log("Loaded!");
	document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);
    
	//Set up the buttons
	var button1 = document.getElementById('button1');
	new NoClickDelay(button1);
	button1.addEventListener('click', function(e){
                             buttonPressed('button1');
                             }, false);	
    
	var button2 = document.getElementById('button2');
	new NoClickDelay(button2);
	button2.addEventListener('click', function(e){
                             buttonPressed('button2');
                             }, false);	
    
	var button3 = document.getElementById('button3');
	new NoClickDelay(button3);
	button3.addEventListener('click', function(e){
                             buttonPressed('button3');
                             }, false);	
    
	var button4 = document.getElementById('button4');
	new NoClickDelay(button4);
	button4.addEventListener('click', function(e){
                             buttonPressed('button4');
                             }, false);	
    
	var button5 = document.getElementById('button5');
	new NoClickDelay(button5);
	button5.addEventListener('click', function(e){
                             buttonPressed('button5');
                             }, false);	
    
	var button6 = document.getElementById('button6');
	new NoClickDelay(button6);
	button6.addEventListener('click', function(e){
                             buttonPressed('button6');
                             }, false);	
    
	var button7 = document.getElementById('button7');
	new NoClickDelay(button7);
	button7.addEventListener('click', function(e){
                             buttonPressed('button7');
                             }, false);	
    
	var button8 = document.getElementById('button8');
	new NoClickDelay(button8);
	button8.addEventListener('click', function(e){
                             buttonPressed('button8');
                             }, false);	
    
	document.getElementById("main").style.display="inline";
	document.getElementById("success").style.display="none";
}
function Track(src, spriteLength, audioLead) {
	window.scrollTo(0, 0);
	var track = this,
    audio = document.createElement('audio');
	audio.src = src;
	audio.autobuffer = true;
	audio.load();
	audio.muted = true; // makes no difference on iOS :(
	/* This is the magic. Since we can't preload, and loading requires a user's
     input. So we bind a touch event to the body, and fingers crossed, the
     user taps. This means we can call play() and immediate pause - which will
     start the download process - so it's effectively preloaded.
     This logic is pretty insane, but forces iOS devices to successfully
     skip an unload audio to a specific point in time.
     first we play, when the play event fires we pause, allowing the asset
     to be downloaded, once the progress event fires, we should have enough
     to skip the currentTime head to a specific point. */
    
	var force = function () {
		audio.pause();
		audio.removeEventListener('play', force, false);
	};
    
	var progress = function () {
		audio.removeEventListener('progress', progress, false);
		if (track.updateCallback !== null) track.updateCallback();
	};
    
	audio.addEventListener('play', force, false);
	audio.addEventListener('progress', progress, false);
    
	var kickoff = function () {
		audio.play();
		document.documentElement.removeEventListener(click, kickoff, true);
	};
	var click = document.ontouchstart === undefined ? 'click' : 'touchstart';
    
	document.documentElement.addEventListener(click, kickoff, true);
    
	this.updateCallback = null;
	this.audio = audio;
	this.playing = false;
	this.lastUsed = 0;
	this.spriteLength = spriteLength;
	this.audioLead = audioLead;
}

Track.prototype.play = function (position) {
	var track = this,
    audio = this.audio,
    lead = this.audioLead,
    length = this.spriteLength,
    time = lead + position * length,
    nextTime = time + length - .1;
    //console.log('Play start:'+time+' end:'+nextTime);
    
	clearInterval(track.timer);
	track.playing = true;
	track.lastUsed = +new Date;
    
	audio.muted = false;
	audio.pause();
	try {
		if (time == 0) time = 0.01; // yay hacks. Sometimes setting time to 0 doesn't play back
		audio.currentTime = time;
		audio.play();
	} catch (e) {
		this.updateCallback = function () {
			track.updateCallback = null;
			audio.currentTime = time;
			audio.play();
		};
		audio.play();
	}
    
    track.timer = setInterval(function () {
                              //console.log('Current Time:'+audio.currentTime+' end time:'+nextTime);
                              if (audio.currentTime >= nextTime) {
                              audio.pause();
                              audio.muted = true;
                              clearInterval(track.timer);
                              player.playing = false;
                              }
                              }, 0.05);//test time every 0.05 seconds to see if we should end
    
   };

var player = (function (src, n, spriteLength, audioLead) {
              var tracks = [],
              total = n,
              i;
              
              while (n--) {
              tracks.push(new Track(src, spriteLength, audioLead));
              }
              
              return {
              tracks: tracks,
              play: function (position) {
              var i = total,
              track = null;
              
              while (i--) {
              if (tracks[i].playing === false) {
              track = tracks[i];
              break;
              } else if (track === null || tracks[i].lastUsed < track.lastUsed) {
              track = tracks[i];
              }
              }
              
              if (track) {
              track.play(position);
              } else {
              // console.log('could not find a track to play :(');
              }
              }
              };
              })('scale6.aifc', 1, 0.5, 0.01);

// myaudiosprite.mp3 is the complete audio sprite
// 1 = the number of tracks, increase this for the desktop
// 1 = the length of the individual audio clip
// 0.25 = the lead on the audio - hopefully zero, but in case any junk is added


// Usage: player.play(position)


window.addEventListener('load', function(){ setTimeout(function(){ loaded(); }, 50) }, true);


</script>
</head>
<body leftmargin="0" topmargin="0">

<!-- Save for Web Slices (instrument.psd) -->
<table id="main" width="320" height="417" border="0" cellpadding="0" cellspacing="0">
<tr>
<td id = 'progress' colspan="17">
<img src="images/instrument_01.gif" width="320" height="52" alt="">
</td>
</tr>

<tr>
<td colspan="8" rowspan="2">
<img src="images/instrument_02.gif" width="116" height="35" alt=""></td>
<td colspan="7">
<img id='button1' src="images/button1.gif" width="45" height="29" alt=""></td>
<td colspan="2" rowspan="14">
<img src="images/instrument_04.gif" width="159" height="256" alt=""></td>
</tr>
<tr>

<td colspan="7">
<img src="images/instrument_05.gif" width="45" height="6" alt=""></td>
</tr>
<tr>
<td colspan="6" rowspan="2">
<img src="images/instrument_06.gif" width="107" height="37" alt=""></td>
<td colspan="8">
<img id='button2' src="images/button2.gif" width="43" height="33" alt=""></td>
<td rowspan="12">

<img src="images/instrument_08.gif" width="11" height="221" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="images/instrument_09.gif" width="43" height="4" alt=""></td>
</tr>
<tr>
<td colspan="3" rowspan="2">
<img src="images/instrument_10.gif" width="91" height="40" alt=""></td>

<td colspan="9">
<img id='button3' src="images/button3.gif" width="48" height="35" alt=""></td>
<td colspan="2" rowspan="8">
<img src="images/instrument_12.gif" width="11" height="151" alt=""></td>
</tr>
<tr>
<td colspan="9">
<img src="images/instrument_13.gif" width="48" height="5" alt=""></td>
</tr>

<tr>
<td colspan="2" rowspan="2">
<img src="images/instrument_14.gif" width="88" height="42" alt=""></td>
<td colspan="8">
<img id='button4' src="images/button4.gif" width="48" height="37" alt=""></td>
<td colspan="2" rowspan="4">
<img src="images/instrument_16.gif" width="3" height="79" alt=""></td>
</tr>
<tr>

<td colspan="8">
<img src="images/instrument_17.gif" width="48" height="5" alt=""></td>
</tr>
<tr>
<td rowspan="8">
<img src="images/instrument_18.gif" width="82" height="210" alt=""></td>
<td colspan="8">
<img id='button5' src="images/button5.gif" width="43" height="34" alt=""></td>
<td rowspan="2">

<img src="images/instrument_20.gif" width="11" height="37" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="images/instrument_21.gif" width="43" height="3" alt=""></td>
</tr>
<tr>
<td colspan="3" rowspan="6">
<img src="images/instrument_22.gif" width="14" height="173" alt=""></td>

<td colspan="7">
<img id='button6' src="images/button6.gif" width="42" height="30" alt=""></td>
<td rowspan="2">
<img src="images/instrument_24.gif" width="1" height="32" alt=""></td>
</tr>
<tr>
<td colspan="7">
<img src="images/instrument_25.gif" width="42" height="2" alt=""></td>
</tr>

<tr>
<td rowspan="4">
<img src="images/instrument_26.gif" width="7" height="141" alt=""></td>
<td colspan="8">
<img id='button7' src="images/button7.gif" width="39" height="30" alt=""></td>
<td rowspan="2">
<img src="images/instrument_28.gif" width="8" height="33" alt=""></td>
</tr>
<tr>

<td colspan="8">
<img src="images/instrument_29.gif" width="39" height="3" alt=""></td>
</tr>
<tr>
<td colspan="2" rowspan="2">
<img src="images/instrument_30.gif" width="7" height="108" alt=""></td>
<td colspan="9">
<img id='button8' src="images/button8.gif" width="54" height="36" alt=""></td>
<td rowspan="2">

<img src="images/instrument_32.gif" width="156" height="108" alt=""></td>
</tr>
<tr>
<td colspan="9">
<img src="images/instrument_33.gif" width="54" height="72" alt=""></td>
</tr>
<tr>
<td>
<img src="images/spacer.gif" width="82" height="1" alt=""></td>

<td>
<img src="images/spacer.gif" width="6" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="3" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="5" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="7" height="1" alt=""></td>
<td>

<img src="images/spacer.gif" width="4" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="3" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="6" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="9" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="11" height="1" alt=""></td>

<td>
<img src="images/spacer.gif" width="2" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="1" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="3" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="8" height="1" alt=""></td>
<td>

<img src="images/spacer.gif" width="11" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="3" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="156" height="1" alt=""></td>
</tr>
</table>
<!-- End Save for Web Slices -->

<table id='success' width = "320" height = "417" border = "0" cellpadding="0" cellspacing="0" style="display:none;">
<tr><td><img src="success.png" onClick="closeMe()"></td></tr>
</table>

<audio id="scale" preload="auto" src = "scale.aifc"></audio>
<audio id="fibsong" preload="auto" src = "fibsong.mp3"></audio>


</body>
</html>
