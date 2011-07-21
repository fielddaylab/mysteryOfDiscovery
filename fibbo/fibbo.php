<html>
<head>
<meta name = "viewport" content = "width = device-width">
<script type="text/javascript">
var code= ['button1', 'button1', 'button2', 'button3', 'button5'];
var progress = 0;
var x = new XMLHttpRequest();

function success(){
    x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_4.webhooks.setWebHookReq/344/11/0/"+<?php echo $_GET[playerId] ?>, true);
    x.send();
    x.oncomplete = refreshConvos();   
    document.getElementById("main").style.display="none";
    document.getElementById("final").style.display="inline";
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
	document.getElementById(button).src="fibbokeypressed.png";
	setTimeout(function(){document.getElementById(button).src="fibbokey.png";},500);
	updateProgressIndicatorAfterPress(button);
	//initAndPlay(button + 'audio'); 
	
}

function initAndPlay(note){
	console.log("initAndPlay(" + note + ")");
	var noteObj = document.getElementById(note);
	
	//noteObj.src = noteObj.src; //fixes glitch with event listeners not getting dispatched the second time
	
	noteObj.play(); //start loading

	if(noteObj.readyState !== 4){ //HAVE_ENOUGH_DATA
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
	}
}

function onCanPlay(evt){
	var note = this.id;
	console.log("onCanPlay(" + note + ")");
	play(note);
}

function play(note){
	console.log("play(" + note + ")");
	var noteObj = document.getElementById(note);
	noteObj.removeEventListener('canplaythrough', onCanPlay, false);
	noteObj.removeEventListener('load', onCanPlay, false);
	
	//audio is loaded, so we can adjust the currentTime safely.
	noteObj.currentTime = 0.0;
	noteObj.play();
	
}

function updateProgressIndicatorAfterPress(button){
	console.log("updateProgressIndicator(" + button + ")");

	if (code[progress] == button){
		document.getElementById("indicator" + progress).innerHTML = "<img src=\"progress.png\"/>";
		progress++;
		
		//If progress is the size of the code array, we have won!
		if(progress == code.length){
            success();
        }
	}
	else {
		if(code[0] == note){
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
		}
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


}




window.addEventListener('load', function(){ setTimeout(function(){ loaded(); }, 100) }, true);

</script>
</head>
<body margin='-20'>

<!-- Save for Web Slices (instrument.psd) -->
<table id="Table_01" width="100%" height="100%" border="0" margin = "-20" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="16">
			<img src="images/instrument_01.jpg" width="320" height="157" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="157" alt=""></td>
	</tr>
	<tr>
		<td rowspan="16">
			<img src="images/instrument_02.jpg" width="37" height="259" alt=""></td>
		<td rowspan="7">
			<img id = 'button1' src="images/instrument_03.jpg" width="26" height="42" alt=""></td>
		<td colspan="14">
			<img src="images/instrument_04.jpg" width="257" height="14" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="12">
			<img src="images/instrument_05.jpg" width="182" height="3" alt=""></td>
		<td rowspan="8">
			<img id = 'button8' src="images/instrument_06.jpg" width="25" height="36" alt=""></td>
		<td rowspan="15">
			<img src="images/instrument_07.jpg" width="50" height="245" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="3" alt=""></td>
	</tr>
	<tr>
		<td rowspan="14">
			<img src="images/instrument_08.jpg" width="3" height="242" alt=""></td>
		<td rowspan="8">
			<img id = 'button2' src="images/instrument_09.jpg" width="27" height="38" alt=""></td>
		<td colspan="10">
			<img src="images/instrument_10.jpg" width="152" height="3" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="3" alt=""></td>
	</tr>
	<tr>
		<td colspan="8">
			<img id = 'button7' src="images/instrument_11.jpg" width="123" height="3" alt=""></td>
		<td rowspan="8">
			<img src="images/instrument_12.jpg" width="25" height="42" alt=""></td>
		<td rowspan="13">
			<img src="images/instrument_13.jpg" width="4" height="239" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="3" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="images/instrument_14.jpg" width="4" height="236" alt=""></td>
		<td rowspan="8">
			<img id = 'button3' src="images/instrument_15.jpg" width="27" height="40" alt=""></td>
		<td colspan="6">
			<img src="images/instrument_16.jpg" width="92" height="13" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="13" alt=""></td>
	</tr>
	<tr>
		<td rowspan="11">
			<img src="images/instrument_17.jpg" width="5" height="223" alt=""></td>
		<td rowspan="9">
			<img id = 'button4' src="images/instrument_18.jpg" width="25" height="39" alt=""></td>
		<td colspan="4">
			<img src="images/instrument_19.jpg" width="62" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images/instrument_20.jpg" width="36" height="11" alt=""></td>
		<td rowspan="7">
			<img id = 'button6' src="images/instrument_21.jpg" width="23" height="32" alt=""></td>
		<td rowspan="10">
			<img src="images/instrument_22.jpg" width="3" height="222" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td rowspan="9">
			<img src="images/instrument_23.jpg" width="26" height="217" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td rowspan="8">
			<img src="images/instrument_24.jpg" width="6" height="211" alt=""></td>
		<td rowspan="7">
			<img id = 'button5' src="images/instrument_25.jpg" width="30" height="35" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td rowspan="7">
			<img src="images/instrument_26.jpg" width="25" height="209" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td rowspan="6">
			<img src="images/instrument_27.jpg" width="27" height="204" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="images/instrument_28.jpg" width="25" height="197" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="images/instrument_29.jpg" width="27" height="196" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="images/instrument_30.jpg" width="23" height="190" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/instrument_31.jpg" width="25" height="184" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="8" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/instrument_32.jpg" width="30" height="176" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="176" alt=""></td>
	</tr>
</table>






<audio id="button1audio" preload="auto" src = "1.m4a"></audio>
<audio id="button2audio" preload="auto" src = "2.m4a"></audio>
<audio id="button3audio" preload="auto" src = "3.m4a"></audio>
<audio id="button4audio" preload="auto" src = "4.m4a"></audio>
<audio id="button5audio" preload="auto" src = "5.m4a"></audio>

</body>
</html>