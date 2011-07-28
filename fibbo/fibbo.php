<html>
<head>
<meta name = "viewport" content = "width = device-width">
<script type="text/javascript">
var code= ['button1', 'button1', 'button2', 'button3', 'button5', 'button8'];
var progress = 0;
var x = new XMLHttpRequest();
var y = new XMLHttpRequest();
var z = new XMLHttpRequest();
var w = new XMLHttpRequest();


var theNote = "";


function success(){
	var noteObj = document.getElementById('fibsong');
	noteObj.play();
	setTimeout(function(){noteObj.pause();},10000);
    x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_5.webhooks.setWebHookReq/344/11/0/<?php echo $_GET['playerId']; ?>", true);
	 x.send();
	y.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_5.players.giveItemToPlayer/344/3/<?php echo $_GET['playerId']; ?>/1", true);
	 y.send();
   	z.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_5.players.destroyItem/344/<?php echo $_GET['playerId']; ?>/1/1", true);
	 z.send();
	w.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_5.players.destroyItem/344/<?php echo $_GET['playerId']; ?>/2/1", true);
    w.send();
    x.oncomplete = refreshConvos();   
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
		e.preventDefault();
		this.moved = false;
		
		this.element.addEventListener('touchmove', this, false);
		this.element.addEventListener('touchend', this, false);
	},
	
	onTouchMove: function(e) {
		this.moved = true;
	},
	
	onTouchEnd: function(e) {
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
	console.log("buttonPressed(" + button + ")");
	document.getElementById(button).src=("images/" + button + "h.gif");
	setTimeout(function(){document.getElementById(button).src=("images/" + button + ".gif");},500);
	updateProgressIndicatorAfterPress(button);
	//initAndPlay(button + 'audio'); 
	
}

function initAndPlay(note){
	console.log("initAndPlay(" + note + ")");
	var noteObj = document.getElementById('scale');
	theNote = note;
	noteObj.src = noteObj.src; //fixes glitch with event listeners not getting dispatched the second time
	play(note);
	//document.getElementById('scale').load();
	//noteObj.play(); //start loading
	
	/*if(noteObj.readyState !== 4){ //HAVE_ENOUGH_DATA
		console.log("noteObj.readyState !== 4, we need to load the data before we try changing currentTime");
		noteObj.addEventListener('canplaythrough', onCanPlay, false);
		noteObj.addEventListener('load', onCanPlay, false); //'canplaythrough' sometimes doesn't dispatch.
		setTimeout(function(){
			noteObj.pause(); //block play so it buffers before playing
		}, 1); //it needs to be after a delay otherwise it doesn't work properly.
	}else{
		//audio is ready
		console.log("noteObj.readyState == 4");
		play(note);
	}*/
}

function onCanPlay(evt){
	var note = theNote;
	console.log("onCanPlay(" + note + ")");
	play(note);

}

function play(note){
	console.log("play(" + note + ")");
	var noteObj = document.getElementById('scale');
	//noteObj.removeEventListener('canplaythrough', onCanPlay, false);
	//noteObj.removeEventListener('load', onCanPlay, false);
	
	//audio is loaded, so we can adjust the currentTime safely.
	//var player1 = new player('CMajorScale.mp3', 8, 12, 0.1);
	switch(note){
		case "button1audio":
		player.play(0);
		break;
		case "button2audio":
		player.play(1);
		break;
		case "button3audio":
		noteObj.currentTime = 1.05;
		break;
		case "button4audio":
		noteObj.currentTime = 1.6;
		break;
		case "button5audio":
		noteObj.currentTime = 2.1;
		break;
		case "button6audio":
		noteObj.currentTime = 2.6;
		break;
		case "button7audio":
		noteObj.currentTime = 3.1;
		break;
		case "button8audio":
		noteObj.currentTime = 3.55;
		break;
	}
	
	//noteObj.play();
	//setTimeout(function(){noteObj.pause();},400);
}

function updateProgressIndicatorAfterPress(button){
	console.log("updateProgressIndicator(" + button + ")");

	if (code[progress] == button){
		progress++;
		//document.getElementById("progress").innerHTML = progress;
		
		
		//If progress is the size of the code array, we have won!
		if(progress == code.length){
            success();
        }
	}
	else {
		progress = 0;
		/*if(code[0] == note){
			document.getElementById("indicator" + 0).innerHTML = "<img src=\"progress.png\"/>";
			document.getElementById("indicator" + 1).innerHTML = "";
			document.getElementById("indicator" + 2).innerHTML = "";
			document.getElementById("indicator" + 3).innerHTML = "";
			document.getElementById("indicator" + 4).innerHTML = "";
			progress = 1;
		}
		else{
			progress = 0;
			document.getElementById("indicator" + 0).innerHTML = "";
			document.getElementById("indicator" + 1).innerHTML = "";
			document.getElementById("indicator" + 2).innerHTML = "";
			document.getElementById("indicator" + 3).innerHTML = "";
			document.getElementById("indicator" + 4).innerHTML = "";
		}*/
	}
}


function loaded() {
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
	//Preload the media
	//This only works in a UI Web View that has 
	//allowsInlineMediaPlayback = YES and mediaPlaybackRequiresUserAction = NO
	
	/*I also belive it is only caching the last object
	document.getElementById('button1audio').load();
	document.getElementById('button2audio').load(); 
	document.getElementById('button3audio').load();
	document.getElementById('button4audio').load();
	document.getElementById('button5audio').load();
	*/
	
document.getElementById('scale').load();

}

/*
function Track(src, spriteLength, audioLead) {
  var track = this,
      audio = document.getElementById('scale');
  audio.src = src;
  audio.autobuffer = true;
  audio.load();
  audio.muted = true; // makes no difference on iOS :(
  */
  /* This is the magic. Since we can't preload, and loading requires a user's
input. So we bind a touch event to the body, and fingers crossed, the
user taps. This means we can call play() and immediate pause - which will
start the download process - so it's effectively preloaded.
This logic is pretty insane, but forces iOS devices to successfully
skip an unload audio to a specific point in time.
first we play, when the play event fires we pause, allowing the asset
to be downloaded, once the progress event fires, we should have enough
to skip the currentTime head to a specific point. */
 /*    
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
      nextTime = time + length;
      
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
    if (audio.currentTime >= nextTime) {
      audio.pause();
      audio.muted = true;
      clearInterval(track.timer);
      player.playing = false;
    }
  }, 3.8);
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
})('CMajorScale.mp3',1,.4,0);
*/

window.addEventListener('load', function(){ setTimeout(function(){ loaded(); }, 100) }, true);


</script>
</head>
<body >
<img src="OpenBox.jpg" id="success" style="display:none">
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




<audio id="button1audio" preload="auto" src = "1.m4a"></audio>
<audio id="button2audio" preload="auto" src = "2.m4a"></audio>
<audio id="button3audio" preload="auto" src = "3.m4a"></audio>
<audio id="button4audio" preload="auto" src = "4.m4a"></audio>
<audio id="button5audio" preload="auto" src = "5.m4a"></audio>
<audio id="scale" preload="auto" src = "CMajorScale.mp3"></audio>
<audio id="fibsong" preload="auto" src = "fibsong.mp3"></audio>


</body>
</html>