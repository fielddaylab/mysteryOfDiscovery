<html>
<head>
<title>Mesozoic Timeline</title>
<style type="text/css">
.drag {position: relative;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name = "viewport" content = "width = device-width">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (timeline.psd) -->
<table id="Table_01" width="640" height="833" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="6">
<img src="images/timeline_01.png" width="640" height="50" alt=""></td>
</tr>
<tr>
<td rowspan="12">
<img src="images/timeline_02.png" width="45" height="782" alt=""></td>
<td>
<img src="images/timeline_03.png" width="133" height="105" alt=""></td>
<td colspan="4" rowspan="2">
<img src="images/timeline_04.png" width="462" height="174" alt=""></td>
</tr>
<tr>
<td>
<img src="images/timeline_05.png" width="133" height="69" alt=""></td>
</tr>
<tr>
<td colspan="2">
<!--Cretaceous Drop Zone-->
<img src="images/timeline_06.png" width="134" height="105" alt=""></td>
<td rowspan="10">
<img src="images/timeline_07.png" width="300" height="608" alt=""></td>
<td width="134" height="105" style="background-image:url(images/timeline_08.png)">		
<!-- Image a -->
<img id="a" class="drag" src="formattedPlantImages/button-fern-carboniferous.jpg" width="134" height="105" alt=""></td>
<td rowspan="10">
<img src="images/timeline_09.png" width="27" height="608" alt=""></td>
</tr>
<tr>
<td colspan="2">
<img src="images/timeline_10.png" width="134" height="12" alt=""></td>
<td>
<img src="images/timeline_11.png" width="134" height="12" alt=""></td>
</tr>
<tr>
<td colspan="2">
<!--Jurassic Drop Zone-->
<img src="images/timeline_12.png" width="134" height="105" alt=""></td>
<td width="134" height="105" style="background-image:url(images/timeline_13.png)">			
<!--Image b -->			
<img id="b" class="drag" src="formattedPlantImages/norfolk-pine-triassic.jpg" width="134" height="105" alt=""></td>					
</tr>
<tr>
<td colspan="2">
<img src="images/timeline_14.png" width="134" height="12" alt=""></td>
<td>
<img src="images/timeline_15.png" width="134" height="12" alt=""></td>
</tr>
<tr>
<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_16.png)">
<!--Triassic Drop Zone-->			
<td width="134" height="105" style="background-image:url(images/timeline_17.png)">
<!--Image c Start-->
<img id="c" class="drag" src="formattedPlantImages/screw-pine-cretaceous.jpg" width="134" height="105" alt=""></td>
</tr>
<tr>
<td colspan="2">
<img src="images/timeline_18.png" width="134" height="12" alt=""></td>
<td>
<img src="images/timeline_19.png" width="134" height="12" alt=""></td>
</tr>
<tr>
<td colspan="2">
<!--Permian Drop Zone-->					
<img src="images/timeline_20.png" width="134" height="105" alt=""></td>
<td>
<img src="images/timeline_21.png" width="134" height="105" alt=""></td>
</tr>
<tr>
<td colspan="2">
<img src="images/timeline_22.png" width="134" height="15" alt=""></td>
<td>
<img src="images/timeline_23.png" width="134" height="15" alt=""></td>
</tr>
<tr>
<td colspan="2">
<!--Carboniferous Drop Zone-->			
<img src="images/timeline_24.png" width="134" height="105" alt=""></td>
<td>
<img src="images/timeline_25.png" width="134" height="105" alt=""></td>
</tr>
<tr>
<td colspan="2">
<img src="images/timeline_26.png" width="134" height="32" alt=""></td>
<td>
<img src="images/timeline_27.png" width="134" height="32" alt=""></td>
</tr>
<tr>
<td>
<img src="images/spacer.gif" width="45" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="133" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="1" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="300" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="134" height="1" alt=""></td>
<td>
<img src="images/spacer.gif" width="27" height="1" alt=""></td>
</tr>
</table>
<!-- End Save for Web Slices -->
<pre id="debug"></pre>
<audio id="sound" src="success.mp3" preload="preload" autobuffer></audio>
<audio id="victory" src = "../success.wav" preload="preload" ></audio>
<a id="success" href = "aris://closeMe" style="visibility:hidden; position:absolute; top:0; left:0;"><img style="position:absolute; top:0; left:0;" src="success.jpg"/></a>

<script language="JavaScript" type="text/javascript">
document.addEventListener('touchmove', function(e) { e.preventDefault(); }, true);

function $(id)
{
	return document.getElementById(id);
}

var _startX = 0;			// mouse starting positions
var _startY = 0;
var _offsetX = 0;			// current element offset
var _offsetY = 0;
var _dragElement;			// needs to be passed from OnMouseDown to OnMouseMove
var _oldZIndex = 0;		// we temporarily increase the z-index during drag

var leftDisplacement = -434;
var vertDiff = 117;
var imgSize = 105;
var ok=false;
var x = new XMLHttpRequest();

var oneFilled = "no";
var twoFilled = "no";
var threeFilled = "no";
var fourFilled = "no";
var fiveFilled = "no";
var cenoFilled = "no";
var oneCorrect = false;
var twoCorrect = false;
var threeCorrect = false;
var fourCorrect = false;
var fiveCorrect = false;
var cenoCorrect = false;

//NEW Answers:
//a->bottom position (Carboniferous)
//b->middle position (Triassic)
//c->top position (Cretaceous)

InitDragDrop();

function InitDragDrop()
{
	document.ontouchstart = OnTouchDown;
	document.ontouchend = OnTouchUp;
}

function OnTouchDown(e)
{
	var target = e.target;

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

	//$('debug').innerHTML = '(' + _dragElement.style.left + ', ' + _dragElement.style.top + ')';	

}

function clear(letter){
	if(oneFilled==letter) oneFilled="no";
	if(twoFilled==letter) twoFilled="no";
	if(threeFilled==letter) threeFilled="no";
	if(fourFilled==letter) fourFilled="no";
	if(fiveFilled==letter) fiveFilled="no";
}

function OnTouchUp(e)
{
	if (_dragElement != null)
	{
		_dragElement.style.zIndex = _oldZIndex;

		var left = _dragElement.style.left.substr(0, _dragElement.style.left.length-2);
		var top = _dragElement.style.top.substr(0, _dragElement.style.top.length-2);
		//$('debug').innerHTML = '(' + (leftDisplacement+(.5*imgSize)) + ', ' + (leftDisplacement-(.5*imgSize)) + ')';
		if(parseInt(top) < ((-2*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-2*vertDiff)-(.5*imgSize))){ //3->1
			if(_dragElement.id == "c"){
				if(oneFilled == "no"){
					_dragElement.style.top=-2*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("c");
					oneFilled = "c";
					oneCorrect = true;
				}
				else{
					clear("c");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((-1*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-1*vertDiff)-(.5*imgSize))){ //3->2 || 2->1
			if(_dragElement.id == "b"){
				if(oneFilled == "no"){
					_dragElement.style.top=-1*vertDiff+'px';
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
					_dragElement.style.top=-1*vertDiff+'px';
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
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((0*vertDiff)+(.5*imgSize)) && parseInt(top) > ((0*vertDiff)-(.5*imgSize))){ //x->x
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
					twoCorrect = false;
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
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((1*vertDiff)+(.5*imgSize)) && parseInt(top) > ((1*vertDiff)-(.5*imgSize))){ //1->2 || 2->3 || 3->4
			if(_dragElement.id == "a"){
				if(twoFilled == "no"){
					_dragElement.style.top=1*vertDiff+'px';
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
					_dragElement.style.top=1*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("b");
					threeFilled = "b";
					threeCorrect = true;
				}
				else{
					clear("b");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else if(_dragElement.id == "c"){
				if(fourFilled == "no"){
					_dragElement.style.top=1*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("c");
					fourFilled = "c";
					fourCorrect = false;
				}
				else{
					clear("c");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((2*vertDiff)+(.5*imgSize)) && parseInt(top) > ((2*vertDiff)-(.5*imgSize))){ //1->3 || 2->4 || 3->5
			if(_dragElement.id == "a"){
				if(threeFilled == "no"){
					_dragElement.style.top=2*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("a");
					threeFilled = "a";
					threeCorrect = false;
				}
				else{
					clear("a");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else if(_dragElement.id == "b"){
				if(fourFilled == "no"){
					_dragElement.style.top=2*vertDiff+'px';
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
			else if(_dragElement.id == "c"){
				if(fiveFilled == "no"){
					_dragElement.style.top=2*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("c");
					fiveFilled = "c";
					fiveCorrect = false;
				}
				else{
					clear("c");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((3*vertDiff)+(.5*imgSize)) && parseInt(top) > ((3*vertDiff)-(.5*imgSize))){ //1->4 || 2->5
			if(_dragElement.id == "a"){
				if(fourFilled == "no"){
					_dragElement.style.top=3*vertDiff+'px';
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
			else if(_dragElement.id == "b"){
				if(fiveFilled == "no"){
					_dragElement.style.top=3*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("b");
					fiveFilled = "b";
					fiveCorrect = false;
				}
				else{
					clear("b");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
				}
			}
			else{
				clear(_dragElement.id);
				_dragElement.style.left = '0px';
				_dragElement.style.top = '0px'; 
			}
		}
		else if(parseInt(top) < ((4*vertDiff)+(.5*imgSize)) && parseInt(top) > ((4*vertDiff)-(.5*imgSize))){ //1->5
			if(_dragElement.id == "a"){
				if(fiveFilled == "no"){
					_dragElement.style.top=4*vertDiff+'px';
					_dragElement.style.left = leftDisplacement;

					clear("a");
					fiveFilled = "a";
					fiveCorrect = true;
				}
				else{
					clear("a");
					_dragElement.style.left = '0px';
					_dragElement.style.top = '0px'; 
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
	//}
	checkSuccess();
	}

function checkSuccess(){
	//$('debug').innerHTML = '-'+oneCorrect+'-'+twoCorrect+'-'+threeCorrect+'-'+cenoCorrect+'-'+fiveCorrect+'-';
	if(oneCorrect && threeCorrect && fiveCorrect){
		document.getElementById("status").innerHTML = ""; 
		//$('debug').innerHTML = 'Huzzah!';
		$('success').style.visibility = "visible";
		document.getElementById('sound').play();
		document.getElementById('victory').play();
		<?php if(!$_GET['playerId']) $_GET['playerId'] = 0; ?>
			x.open("GET", "http://arisgames.org/server/json.php/aris_1_5.webhooks.setWebHookReq/344/31/0/"+<?php echo($_GET['playerId']) ?>, true);
		x.send();
		x.oncomplete = refreshConvos();
	}
	else if((oneFilled != "no" && twoFilled != "no" && threeFilled != "no") || (oneFilled != "no" && twoFilled != "no" && fourFilled != "no") || (oneFilled != "no" && twoFilled != "no" && fiveFilled != "no") || (oneFilled != "no" && fourFilled != "no" && threeFilled != "no") || (oneFilled != "no" && fiveFilled != "no" && threeFilled != "no") || (oneFilled != "no" && fourFilled != "no" && fiveFilled != "no") || (fourFilled != "no" && twoFilled != "no" && threeFilled != "no") || (fiveFilled != "no" && twoFilled != "no" && threeFilled != "no") || (fiveFilled != "no" && twoFilled != "no" && fourFilled != "no") || (fiveFilled != "no" && fourFilled != "no" && threeFilled != "no")) {
                document.getElementById("status").innerHTML = "Nice try, but that's not quite right. Try Again."; 
        }
	else{
		document.getElementById("fail").style.display="inline";
	}
}

function succeed(){
	refreshConvos();
	closeMe();
}

function refreshConvos(){
	document.location.href = "aris://refreshStuff";
}

function closeMe(){
	document.location.href = "aris://closeMe";
}

</script>

<div style="position:absolute;top:170px;left:45px;color:#ffffff;font-size:18px;font-family: Helvetica, Arial, sans-serif;font-weight:normal;overflow-x:visible;"><div id="status" style="width:500px;">Not all the plants are placed yet.</div></div>
</body>
</html>
