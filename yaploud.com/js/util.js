
function xmlHttpCreate(){var req=null;try{req=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e){try{req=new ActiveXObject("Microsoft.XMLHTTP");}
catch(sc){req=null;}}
if(!req&&typeof XMLHttpRequest!="undefined"){req=new XMLHttpRequest();}
return req;}


function addEvent(obj, evt, fn){
        if (obj.addEventListener){
            obj.addEventListener(evt, fn, true);
            return true;
	} else if (obj.attachEvent){
	    var r = obj.attachEvent("on" + evt, fn);
	    return r;
        } else {
            return false;
        }
}
