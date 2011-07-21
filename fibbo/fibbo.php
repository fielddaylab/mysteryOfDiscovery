<html>
<head>
<meta name = "viewport" content = "width = device-width">
<script type="text/javascript">
var code= ['button1audio', 'button1audio', 'button2audio', 'button3audio', 'button5audio'];
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
//iOS introduces a nasty delay on dispaching the clickl event. Likely something to do with multitouch.
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
	setTimeout(function(){document.getElementById(button).src="fibbokey.png";},800);
	initAndPlay(button + 'audio'); 
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
		playNoteAndUpdateProgress(note);
	}
}

function onCanPlay(evt){
	var note = this.id;
	console.log("onCanPlay(" + note + ")");
	playNoteAndUpdateProgress(note);
}

function playNoteAndUpdateProgress(note){
	console.log("playNoteAndUpdateProgress(" + note + ")");
	var noteObj = document.getElementById(note);
	noteObj.removeEventListener('canplaythrough', onCanPlay, false);
	noteObj.removeEventListener('load', onCanPlay, false);
	
	//audio is loaded, so we can adjust the currentTime safely.
	noteObj.currentTime = 0.0;
	noteObj.play();
	
	updateProgressIndicator(note);
}

function updateProgressIndicator(note){
	console.log("updateProgressIndicator(" + note + ")");

	if (code[progress] == note){
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
<body>
<img id="final" style="display:none" src="final.png");
<table id="main" style="display:inline"><tr><td>
<table>
<tr><td><img id="button1" src="fibbokey.png"/><br/>1</td><td><img id="button2" src="fibbokey.png"/><br/>2</td></tr>
<tr><td><img id="button3" src="fibbokey.png"/><br/>3</td><td><img id="button4" src="fibbokey.png"/><br/>4</td></tr>
<tr><td><img id="button5" src="fibbokey.png"/><br/>5</td></tr>
</table>
</td><td>
<table>
<tr><td id = "indicator0"></td></tr>
<tr><td id = "indicator1"></td></tr>
<tr><td id = "indicator2"></td></tr>
<tr><td id = "indicator3"></td></tr>
<tr><td id = "indicator4"></td></tr>
<tr><td id = "indicator5"></td></tr>
</table>
</td></tr></table>
<audio id="button1audio" preload="auto" src = "1.m4a"></audio>
<audio id="button2audio" preload="auto" src = "2.m4a"></audio>
<audio id="button3audio" preload="auto" src = "3.m4a"></audio>
<audio id="button4audio" preload="auto" src = "4.m4a"></audio>
<audio id="button5audio" preload="auto" src = "5.m4a"></audio>

</body>
</html>