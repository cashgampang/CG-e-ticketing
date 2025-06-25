var resetFlag=0,timeOutId,logOutTimeId;
var jsessionRemain,jsessionWarning,jsessionExpiry, jCounter;
    // this method will reset vairables to zero
    function sessionInitialise(sessionWarning,sessionExpiry,counter) // 476,595,121
    {
        jsessionWarning = sessionWarning ; 
        jsessionExpiry = sessionExpiry ;
        jCounter = counter;
        destroy();
    }

    function destroy() {
    	
        clearTimeout(timeOutId);
        timeOutId = 0;
        clearTimeout(logOutTimeId);
        logOutTimeId = 0;
        sessionHandlerReSetter();
     
     /* updated for DUAL UI  Start*/
        if ($("#sessionnav").hasClass('modal')) {
        	$("#sessionnav").modal("hide");
        }else{
        	   document.getElementById("sessionnav").style.display = 'none';
        	   document.getElementById("skiptomain").style.display = '';
        }
        /* updated for DUAL UI  End*/
    }
    function sessionHandlerReSetter() {
            if (timeOutId > 0) {
                    clearTimeout(timeOutId);
                    timeOutId = 0;
                }
            if (logOutTimeId > 0) {
                    clearTimeout(logOutTimeId);
                    logOutTimeId = 0;
               }
        resetFlag = 0;
        sessionHandlerStart();
    }
    // this method will show alert on header for session expire
    var count;
    var myVar;
    function sessionHandlerWarning(){
    	
        document.getElementById("lblSessionExpire").innerHTML = '';
        
        /* updated for DUAL UI  Start*/
           if ($("#sessionnav").hasClass('modal')) {
        	   /* $("#sessionnav").modal("show");*/
        	    $('#sessionnav').modal({
                    keyboard: true, 
                    show: true
                }); 
           }else{
        	   document.getElementById("sessionnav").style.display = '';
               document.getElementById("skiptomain").style.display = 'none';
           }
           /* updated for DUAL UI  End*/
        clearInterval(myVar); 
        count =counter ;
        myVar = setInterval(countDownMsg, 1000);
    }
    // this method will countdown timer in alert
    function countDownMsg(){
            count=count-1;
            if (count <= 0)
            {
                clearInterval(myVar);
                return;
            }
            var minutes = Math.floor(count / 60);
            var seconds = count - minutes * 60;
            var minVal = '';
            var secVal = '';
            var alertMsg = '';
            if(minutes > 0)
                minVal = minutes+' minute(s)';
            if(minutes > 0 && seconds > 0)
                secVal = ' and '+seconds+' seconds';
            else if(seconds > 0)
                secVal = seconds+' seconds';
            if ($("#sessionnav").hasClass('modal')) {
            	alertMsg = 'Total Session time is 45 minutes. System has been idle for last 36 minutes. System will log out if there is no activity in the next 9 minutes. To stay logged in Click Ok';
            	document.getElementById("lblSessionExpire").innerHTML = alertMsg;
            	//document.getElementById("lblSessionExpire").innerHTML = "You will automatically logged out in "+ minVal + secVal  + " due to inactivity. To stay logged in Click Ok";
            }
            else{
            	alertMsg = 'Total Session time is 45 minutes. System has been idle for last 36 minutes. System will log out if there is no activity in the next 9 minutes. To stay logged in ';
            	document.getElementById("lblSessionExpire").innerHTML = alertMsg+"<a style=\""+"text-decoration:underline;color:white !important;font-weight:bold"+"\""+"href=\""+"javascript:fn_ResetSession()"+"\""+">CLICK HERE</a>"+".";
            	//document.getElementById("lblSessionExpire").innerHTML = "You will automatically logged out in "+ minVal + secVal  + " due to inactivity. To stay logged in "+"<a style=\""+"text-decoration:underline;color:white !important;font-weight:bold"+"\""+"href=\""+"javascript:fn_ResetSession()"+"\""+">CLICK HERE</a>"+".";
            }
 } 

    function fn_ResetSession(){
		var token = $("meta[name='_csrf']").attr("content");
        var xmlHttpRequest = getHttpXMLRequest(); 
      /*  xmlHttpRequest.onreadystatechange = getReadyStateHandlerColName(xmlHttpRequest);  */
        xmlHttpRequest.onreadystatechange = getReadyStateHandlerForSession(xmlHttpRequest); 
        xmlHttpRequest.open("POST", "webHP?requestType=ApplicationRH&actionVal=resetSession&queryType=Select&screenId=114&_csrf="+token, false);
        xmlHttpRequest.send();
    }

    function getReadyStateHandlerForSession(xmlHttpRequest) 
    { 
        return function() 
        {  
            if (xmlHttpRequest.readyState == 4) 
            { 
                if (xmlHttpRequest.status == 200) 
                {
                    sessionInitialise(jsessionWarning,jsessionExpiry,jCounter);  
                }
            }  
        };  
    }
function getReadyStateHandlerColName(xmlHttpRequest) 
{  
    return function() 
    {  
        if (xmlHttpRequest.readyState == 4) 
        {  
            if (xmlHttpRequest.status == 200) 
            {
                sessionInitialise(jsessionWarning,jsessionExpiry,jCounter);  
            }
        }  
    };  
}
    
    // this method will call logout function if no activity performed for specific period of time
function sessionHandlerStart()
{   
    if(resetFlag==0)
    {
		var tempSessionWarning=jsessionWarning*1000;
        timeOutId=setTimeout('sessionHandlerWarning()',tempSessionWarning);
        var sessionExpiryTimeOut = jsessionExpiry;
        logOutTimeId = setTimeout(function(){ fnLogout(); },sessionExpiryTimeOut*1000);
    }
    else
    {
         sessionHandlerReSetter();
    }
}

function getHttpXMLRequest() 
{  
    var xmlHttpReq;  
    // to create XMLHttpRequest object in non-Microsoft browsers  
    if (window.XMLHttpRequest)
    {  
        xmlHttpReq = new XMLHttpRequest();  
    }
    else if (window.ActiveXObject) 
    {  
        try
        {  
            //to create XMLHttpRequest object in later versions of Internet Explorer  
            xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");  
        }
        catch (exp1)
        {  
            try
            {  
                //to create XMLHttpRequest object in later versions of Internet Explorer  
                xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");  
            }
            catch (exp2) 
            {  
                //xmlHttpReq = false;  
                document.getElementById("incUserName").innerHTML = ("Exception in getXMLHttpRequest()!");  
            }  
        }  
    }  
    return xmlHttpReq;  
}