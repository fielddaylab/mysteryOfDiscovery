<html>
<head>
<style type="text/css">
.drag {position: relative; cursor: move;}
</style>
<meta name = "viewport" content = "width = device-width"/>

<script type="text/javascript">

var aLoaded=false;
var bLoaded=false;
var cLoaded=false;
var dLoaded=false;
var aaLoaded=false;
var baLoaded=false;
var caLoaded=false;
var daLoaded=false;

function runGame(){
    document.getElementById("loadCover").style.display="none";
    document.getElementById("main").style.display="inline";
}

var imgA = new Image();
imgA.onload = function() {aLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgA.src = "left1.png";
var imgB = new Image();
imgB.onload = function() {bLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgB.src = "left2.png";
var imgC = new Image();
imgC.onload = function() {cLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgC.src = "left3.png";
var imgD = new Image();
imgD.onload = function() {dLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgD.src = "left4.png";
var imgAa = new Image();
imgAa.onload = function() {aaLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgAa.src = "right1.png";
var imgBa = new Image();
imgBa.onload = function() {baLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgBa.src = "right2.png";
var imgCa = new Image();
imgCa.onload = function() {caLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgCa.src = "right3.png";
var imgDa = new Image();
imgDa.onload = function() {daLoaded=true; if(aLoaded && bLoaded && cLoaded && dLoaded && aaLoaded && baLoaded && caLoaded && daLoaded) runGame();};
imgDa.src = "right4.png";

</script>

</head>

<body>
<span id="loadCover" style="display:inline, position:absolute, top:0, left:0"><img src="blackBox.png" width="1000"/></span>
<pre id="debug"></pre>
<input type="button" id="submitButton" value="Submit" onClick="submit()" style="visibility:visible">
<input type="button" id="closeButton" value="Close" onClick="closeMe()" style="visibility:visible">
<img src="success.jpg" id="success" style="display:none">
<img src="fail.jpg" id="fail" style="display:none">

<table id="main" border="1" style="display:none">
<tr>
<td>

<table id="miniA" border="1">
<tr>
<td>
<img id="aa" class="drop" src="left1.png"/>
</td>
</tr>
<tr>
<td>
<img id="ba" class="drop" src="left2.png"/>
</td>
</tr>
<tr>
<td>
<img id="ca" class="drop" src="left3.png"/>
</td>
</tr>
<tr>
<td>
<img id="da" class="drop" src="left4.png"/>
</td>
</tr>
</table>

</td>
<td>

<table id="miniB" border="1">
<tr>
<td>
<img id="a" class="drag" src="right3.png"/>
</td>
</tr>
<tr>
<td>
<img id="b" class="drag" src="right2.png"/>
</td>
</tr>
<tr>
<td>
<img id="c" class="drag" src="right4.png"/>
</td>
</tr>
<tr>
<td>
<img id="d" class="drag" src="right1.png"/>
</td>
</tr>
</table>

</td>
</tr>
</table>


<script language="JavaScript" type="text/javascript">
<!--
document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

// this is simply a shortcut for the eyes and fingers
function $(id)
{
	return document.getElementById(id);
}

var _startX = 0;			// mouse starting positions
var _startY = 0;
var _offsetX = 0;			// current element offset
var _offsetY = 0;
var _dragElement;			// needs to be passed from OnMouseDown to OnMouseMove
var _oldZIndex = 0;			// we temporarily increase the z-index during drag
var _debug = $('debug');	// makes life easier

var leftDisplacement = "-94px";
var ok=false;
var x = new XMLHttpRequest();

var oneFilled = "no";
var twoFilled = "no";
var threeFilled = "no";
var fourFilled = "no";
var oneCorrect = false;
var twoCorrect = false;
var threeCorrect = false;
var fourCorrect = false;

//ANSWERS:
//1=4
//2=2
//3=1
//4=3

InitDragDrop();

function InitDragDrop()
{
    document.ontouchstart = OnTouchDown;
    document.ontouchend = OnTouchUp;
}

function OnTouchDown(e)
{
	var target = e.target;
	
	//_debug.innerHTML = target.className == 'drag' 
    //? 'draggable element clicked' 
    //: 'NON-draggable element clicked';

	if (e.touches[0].target.className == 'drag')
	{
		// grab the mouse position
		_startX = e.touches[0].clientX;
		_startY = e.touches[0].clientY;
		
		// grab the clicked element's position
		_offsetX = ExtractNumber(e.touches[0].target.style.left);
		_offsetY = ExtractNumber(e.touches[0].target.style.top);
		
		// bring the clicked element to the front while it is being dragged
		_oldZIndex = e.touches[0].target.style.zIndex;
		e.touches[0].target.style.zIndex = 10000;
		
		// we need to access the element in OnTouchMove
		_dragElement = e.touches[0].target;
        
		// tell our code to start moving the element with the mouse
		//document.onmousemove = OnMouseMove;
		document.ontouchmove = OnTouchMove;
        
		// cancel out any text selections
		document.body.focus();
		
		// prevent text selection in IE
		document.onselectstart = function () { return false; };
		// prevent IE from trying to drag an image
		target.ondragstart = function() { return false; };
		
		// prevent text selection (except IE)
		return false;
	}
}

function ExtractNumber(value)
{
	var n = parseInt(value);
	
	return n == null || isNaN(n) ? 0 : n;
}

function OnTouchMove(e)
{
	if (e == null) 
		var e = window.event; 
    
	// this is the actual "drag code"
	_dragElement.style.left = (_offsetX + e.touches[0].clientX - _startX) + 'px';
	_dragElement.style.top = (_offsetY + e.touches[0].clientY - _startY) + 'px';
    
	//_debug.innerHTML = '(' + _dragElement.style.left + ', ' + _dragElement.style.top + ')';	
}

function clear(letter){
    if(oneFilled==letter) oneFilled="no";
    if(twoFilled==letter) twoFilled="no";
    if(threeFilled==letter) threeFilled="no";
    if(fourFilled==letter) fourFilled="no";
}

function OnTouchUp(e)
{
	if (_dragElement != null)
	{
		_dragElement.style.zIndex = _oldZIndex;
        
        var left = _dragElement.style.left.substr(0, _dragElement.style.left.length-2);
        var top = _dragElement.style.top.substr(0, _dragElement.style.top.length-2);
        
        if(parseInt(left) < -55 && parseInt(left) > -135){
            if(parseInt(top) < -225 && parseInt(top) > -285){ //4->1
                if(_dragElement.id == "d"){
                    if(oneFilled == "no"){
                        _dragElement.style.top='-255px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("d");
                        oneFilled = "d";
                        oneCorrect = true;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < -140 && parseInt(top) > -200){ //4->2 || 3->1
                if(_dragElement.id == "c"){
                    if(oneFilled == "no"){
                        _dragElement.style.top='-170px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("c");
                        oneFilled = "c";
                        oneCorrect = false;
                    }
                    else{
                        clear("c");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "d"){
                    if(twoFilled == "no"){
                        _dragElement.style.top='-170px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("d");
                        twoFilled = "d";
                        twoCorrect = false;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < -55 && parseInt(top) > -115){ //4->3 || 3->2 || 2->1
                if(_dragElement.id == "b"){
                    if(oneFilled == "no"){
                        _dragElement.style.top='-85px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("b");
                        oneFilled = "b";
                        oneCorrect = false;
                    }
                    else{
                        clear("b");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "c"){
                    if(twoFilled == "no"){
                        _dragElement.style.top='-85px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("c");
                        twoFilled = "c";
                        twoCorrect = false;
                    }
                    else{
                        clear("c");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "d"){
                    if(threeFilled == "no"){
                        _dragElement.style.top='-85px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("d");
                        threeFilled = "d";
                        threeCorrect = false;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < 30 && parseInt(top) > -30){ //x->x
                if(_dragElement.id == "a"){
                    if(oneFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("a");
                        oneFilled = "a";
                        oneCorrect = false;
                    }
                    else{
                        clear("a");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "b"){
                    if(twoFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("b");
                        twoFilled = "b";
                        twoCorrect = true;
                    }
                    else{
                        clear("b");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "c"){
                    if(threeFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("c");
                        threeFilled = "c";
                        threeCorrect = false;
                    }
                    else{
                        clear("c");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "d"){
                    if(fourFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("d");
                        fourFilled = "d";
                        fourCorrect = false;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < 115 && parseInt(top) > 55){ //1->2 || 2->3 || 3->4
                if(_dragElement.id == "a"){
                    if(twoFilled == "no"){
                        _dragElement.style.top='85px';
                        _dragElement.style.left = leftDisplacement;
                
                        clear("a");
                        twoFilled = "a";
                        twoCorrect = false;
                    }
                    else{
                        clear("a");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "b"){
                    if(threeFilled == "no"){
                        _dragElement.style.top='85px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("b");
                        threeFilled = "b";
                        threeCorrect = false;
                    }
                    else{
                        clear("b");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "c"){
                    if(fourFilled == "no"){
                        _dragElement.style.top='85px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("c");
                        fourFilled = "c";
                        fourCorrect = true;
                    }
                    else{
                        clear("c");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < 200 && parseInt(top) > 140){ //1->3 || 2->4
                if(_dragElement.id == "a"){
                    if(threeFilled == "no"){
                        _dragElement.style.top='170px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("a");
                        threeFilled = "a";
                        threeCorrect = true;
                    }
                    else{
                        clear("a");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "b"){
                    if(fourFilled == "no"){
                        _dragElement.style.top='170px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("b");
                        fourFilled = "b";
                        fourCorrect = false;
                    }
                    else{
                        clear("b");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else if(parseInt(top) < 285 && parseInt(top) > 225){ //1->4
                if(_dragElement.id == "a"){
                    if(fourFilled == "no"){
                        _dragElement.style.top='255px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("a");
                        fourFilled = "a";
                        fourCorrect = false;
                    }
                    else{
                        clear("a");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
            }
            else{
                clear(_dragElement.id);
                _dragElement.style.left = '0px';
                _dragElement.style.top = '0px'; 
            }
        }
        else{
            clear(_dragElement.id);
            _dragElement.style.left = '0px';
            _dragElement.style.top = '0px'; 
        }
        
        // we're done with these events until the next OnMouseDown
		document.onmousemove = null;
		document.onselectstart = null;
		_dragElement.ondragstart = null;
        
		// this is how we know we're not dragging
		_dragElement = null;
        
		//_debug.innerHTML = 'mouse up';
	}
}

function submit(){
    document.getElementById("submitButton").hidden="true";
    document.getElementById("a").style.visibility="hidden";
    document.getElementById("b").style.visibility="hidden";
    document.getElementById("c").style.visibility="hidden";
    document.getElementById("d").style.visibility="hidden";
    document.getElementById("aa").style.visibility="hidden";
    document.getElementById("ba").style.visibility="hidden";
    document.getElementById("ca").style.visibility="hidden";
    document.getElementById("da").style.visibility="hidden";
    document.getElementById("miniA").style.visibility="hidden";
    document.getElementById("miniB").style.visibility="hidden";
    document.getElementById("main").style.visibility="hidden";

    if(oneCorrect && twoCorrect && threeCorrect && fourCorrect){
        document.getElementById("success").style.display="inline";
        x.open("GET", "http://arisgames.org/qaserver/json.php/aris_1_4.webhooks.setWebHookReq/344/10/0/"+<?php echo $_GET[playerId] ?>, true);
        x.send();
        x.oncomplete = refreshConvos();
    }
    else{
        document.getElementById("fail").style.display="inline";
    }

}

function refreshConvos(){
    document.location.href = "aris://refreshStuff";
}

function closeMe(){
    document.location.href = "aris://closeMe";
}

//-->
</script>
</body>

</html>