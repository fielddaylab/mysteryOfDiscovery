<html>
<head>
<title>timeline</title>
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
			<img src="images/timeline_01.gif" width="640" height="50" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="images/timeline_02.gif" width="45" height="782" alt=""></td>
		<td width="133" height="105" style="background-image:url(images/timeline_03.jpg)">
		<!-- CENOZOIC ANSWER -->
		</td>
		<td colspan="4" rowspan="2">
			<img src="images/timeline_04.gif" width="462" height="174" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/timeline_05.gif" width="133" height="69" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_06.jpg)">
		<!-- CRETACEOUS ANSWER -->
		</td>
		<td rowspan="10">
			<img src="images/timeline_07.gif" width="300" height="608" alt=""></td>
		<td width="134" height="105" style="background-image:url(images/timeline_08.jpg)">
		<!-- OPTION A -->
		<img id="a" class="drag" src="formattedPlantImages/button-fern-carboniferous.jpg"/>
		</td>
		<td rowspan="10">
			<img src="images/timeline_09.gif" width="27" height="608" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/timeline_10.gif" width="134" height="12" alt=""></td>
		<td>
			<img src="images/timeline_11.gif" width="134" height="12" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_12.jpg)">
		<!-- JURRASIC ANSWER -->
		</td>
		<td width="134" height="105" style="background-image:url(images/timeline_13.jpg)">
		<!-- OPTION B -->
		<img id="b" class="drag" src="formattedPlantImages/norfolk-pine-triassic.jpg"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/timeline_14.gif" width="134" height="12" alt=""></td>
		<td>
			<img src="images/timeline_15.gif" width="134" height="12" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_16.jpg)">
		<!-- TRIASSIC ANSWER -->
		</td>
		<td width="134" height="105" style="background-image:url(images/timeline_17.jpg)">
		<!-- OPTION C -->
		<img id="c" class="drag" src="formattedPlantImages/coontie-jurrasic.jpg"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/timeline_18.gif" width="134" height="12" alt=""></td>
		<td>
			<img src="images/timeline_19.gif" width="134" height="12" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_20.jpg)">
		<!-- PERMIAN ANSWER -->
		</td>
		<td width="134" height="105" style="background-image:url(images/timeline_21.jpg)">
		<!-- OPTION D -->
		<img id="d" class="drag" src="formattedPlantImages/pineapple-cenozoic.jpg"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/timeline_22.gif" width="134" height="15" alt=""></td>
		<td>
			<img src="images/timeline_23.gif" width="134" height="15" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" width="134" height="105" style="background-image:url(images/timeline_24.jpg)">
		<!-- CARBONIFEROUS ANSWER -->
		</td>
		<td width="134" height="105" style="background-image:url(images/timeline_25.gif)">
		<!-- OPTION E -->
		<img id="e" class="drag" src="formattedPlantImages/screw-pine-cretaceous.jpg"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/timeline_26.gif" width="134" height="32" alt=""></td>
		<td>
			<img src="images/timeline_27.gif" width="134" height="32" alt=""></td>
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
<pre id="debug"></pre>
<audio id="sound" src="success.mp3" preload="preload" autobuffer></audio>
<img id="success" src="success.jpg" style="visibility:hidden; position:absolute; top:0; left:0;"/>

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

//ANSWERS:
//1=Carboniferous
//2=Triassic
//3=Jurrasic
//4=Cenozoic
//5=Cretaceous

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
    if(cenoFilled==letter) cenoFilled="no";
}

function OnTouchUp(e)
{
	if (_dragElement != null)
	{
		_dragElement.style.zIndex = _oldZIndex;
        
        var left = _dragElement.style.left.substr(0, _dragElement.style.left.length-2);
        var top = _dragElement.style.top.substr(0, _dragElement.style.top.length-2);
        //$('debug').innerHTML = '(' + (leftDisplacement+(.5*imgSize)) + ', ' + (leftDisplacement-(.5*imgSize)) + ')';	
        if(parseInt(left) < (leftDisplacement+(.5*imgSize)) && parseInt(left) > leftDisplacement-(.5*imgSize)){
            if(parseInt(top) < ((-4*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-4*vertDiff)-(.5*imgSize))){ //5->1
                if(_dragElement.id == "e"){
                    if(oneFilled == "no"){
                        _dragElement.style.top=-4*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("e");
                        oneFilled = "e";
                        oneCorrect = true;
                    }
                    else{
                        clear("e");
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
            else if(parseInt(top) < ((-3*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-3*vertDiff)-(.5*imgSize))){ //5->2 || 4->1
                if(_dragElement.id == "d"){
                    if(oneFilled == "no"){
                        _dragElement.style.top=-3*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("d");
                        oneFilled = "d";
                        oneCorrect = false;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "e"){
                    if(twoFilled == "no"){
                        _dragElement.style.top=-3*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("e");
                        twoFilled = "e";
                        twoCorrect = false;
                    }
                    else{
                        clear("e");
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
            else if(parseInt(top) < ((-2*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-2*vertDiff)-(.5*imgSize))){ //5->3 || 4->2 || 3->1
                if(_dragElement.id == "c"){
                    if(oneFilled == "no"){
                        _dragElement.style.top=-2*vertDiff+'px';
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
                        _dragElement.style.top=-2*vertDiff+'px';
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
                else if(_dragElement.id == "e"){
                    if(threeFilled == "no"){
                        _dragElement.style.top=-2*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("e");
                        threeFilled = "e";
                        threeCorrect = false;
                    }
                    else{
                        clear("e");
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
            else if(parseInt(top) < ((-1*vertDiff)+(.5*imgSize)) && parseInt(top) > ((-1*vertDiff)-(.5*imgSize))){ //5->4 || 4->3 || 3->2 || 2->1
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
                        twoCorrect = true;
                    }
                    else{
                        clear("c");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "d"){
                    if(threeFilled == "no"){
                        _dragElement.style.top=-1*vertDiff+'px';
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
                else if(_dragElement.id == "e"){
                    if(fourFilled == "no"){
                        _dragElement.style.top=-1*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("e");
                        fourFilled = "e";
                        fourCorrect = false;
                    }
                    else{
                        clear("e");
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
                else if(_dragElement.id == "d"){
                    if(fourFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("d");
                        fourFilled = "d";
                        fourCorrect = true;
                    }
                    else{
                        clear("d");
                        _dragElement.style.left = '0px';
                        _dragElement.style.top = '0px'; 
                    }
                }
                else if(_dragElement.id == "e"){
                    if(fiveFilled == "no"){
                        _dragElement.style.top='0px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("e");
                        fiveFilled = "e";
                        fiveCorrect = false;
                    }
                    else{
                        clear("e");
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
            else if(parseInt(top) < ((1*vertDiff)+(.5*imgSize)) && parseInt(top) > ((1*vertDiff)-(.5*imgSize))){ //1->2 || 2->3 || 3->4 || 4->5
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
                else if(_dragElement.id == "d"){
                    if(fiveFilled == "no"){
                        _dragElement.style.top=1*vertDiff+'px';
                        _dragElement.style.left = leftDisplacement;
                    
                        clear("d");
                        fiveFilled = "d";
                        fiveCorrect = false;
                    }
                    else{
                        clear("d");
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
            //CENOZOIC
            else if(parseInt(top) < (-173+(.5*imgSize)) && parseInt(top) > (-173-(.5*imgSize))){ //1->5
                if(_dragElement.id == "a"){
                    if(cenoFilled == "no"){
                        _dragElement.style.top=-173+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("a");
                        cenoFilled = "a";
                        cenoCorrect = false;
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
            else if(parseInt(top) < (-290+(.5*imgSize)) && parseInt(top) > (-290-(.5*imgSize))){ //1->5
                if(_dragElement.id == "b"){
                    if(cenoFilled == "no"){
                        _dragElement.style.top=-290+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("b");
                        cenoFilled = "b";
                        cenoCorrect = false;
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
             else if(parseInt(top) < (-408+(.5*imgSize)) && parseInt(top) > (-408-(.5*imgSize))){ //1->5
                if(_dragElement.id == "c"){
                    if(cenoFilled == "no"){
                        _dragElement.style.top=-408+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("c");
                        cenoFilled = "c";
                        cenoCorrect = false;
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
            else if(parseInt(top) < (-525+(.5*imgSize)) && parseInt(top) > (-525-(.5*imgSize))){ //1->5
                if(_dragElement.id == "d"){
                    if(cenoFilled == "no"){
                        _dragElement.style.top=-525+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("d");
                        cenoFilled = "d";
                        cenoCorrect = true;
                    }
                    else{
                        clear("d");
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
            else if(parseInt(top) < (-645+(.5*imgSize)) && parseInt(top) > (-645-(.5*imgSize))){ //1->5
                if(_dragElement.id == "e"){
                    if(cenoFilled == "no"){
                        _dragElement.style.top=-645+'px';
                        _dragElement.style.left = leftDisplacement;
                        
                        clear("e");
                        cenoFilled = "e";
                        cenoCorrect = false;
                    }
                    else{
                        clear("e");
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
	}
	
	
	checkSuccess();
}

function checkSuccess(){
	//$('debug').innerHTML = '-'+oneCorrect+'-'+twoCorrect+'-'+threeCorrect+'-'+cenoCorrect+'-'+fiveCorrect+'-';
    if(oneCorrect && twoCorrect && threeCorrect && cenoCorrect && fiveCorrect){
    	//$('debug').innerHTML = 'Huzzah!';
    	$('success').style.visibility = "visible";
    	document.getElementById('sound').play();
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

</script>
</body>
</html>