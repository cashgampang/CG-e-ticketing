var fnUdinReset = function() {
	
	$("#udinNumber").val("");
};

var getUdinDtls = function() {
	var loginId = $("#loginId").val();
	$("#udinPopup").addClass("d-none");
	var flag = true;
	 var array=['udinNumber']
	 if (common.isValid(array)) {
			flag = false;
		}
	 
	 if (!fn_captchaValidate()) {
		 
			/* bootbox.alert("Captcha Invalid"); */
			return;
		}
	 
	var udin = "fml"+ $("#udinNumber").val();
	 var json = {
			"udinNumber" : udin
	 	};
	 
	if(flag!=false){
		 //$('#mainSectionWrap').hide();
			var tempJson= {
					"data":JSON.stringify(json),
					"captcha_val":$("#txt_Captcha").val()
			}
			if(loginId != null && loginId != undefined && loginId != ""){
				searchPage = null;
			}else{
				searchPage = "mainSectionWrap";
			}
			ajax.request("webHP?requestType=ApplicationRH&actionVal=setUdinData&screenId=9000012410",
					tempJson, searchPage);
	}
	
}

var getAnotherUdinDtls = function() {
	
	$("#udinPopup").removeClass("d-none");
	
}


var fetchOtherUdinDtls = function() {
	debugger;
	var flag = true;
	 var array=['udinNo']
	 if (common.isValid(array)) {
			flag = false;
		}
	 if(flag!=false){
		 var data = {
					"udinNumber" : $("#udinNo").val(),
					"captcha_val":$("#txt_Captcha").val()
			 	};
			ajax.request(
					"webHP?requestType=ApplicationRH&actionVal=setUdinData&screenId=9000012410",
					data, null);
	 }
}

function fn_captchaValidate() {
	
	document.getElementById("incCaptcha").innerHTML="";
	var f = document.getElementById('txt_Captcha');
	if (document.getElementById('txt_Captcha').value == "" || document.getElementById('txt_Captcha').value.length ==
		0 || document.getElementById('txt_Captcha').value == null || document.getElementById('txt_Captcha').value == "null") {
		document.getElementById('incCaptcha').innerHTML ='Please enter' + ' ' + 'above CAPTCHA Code' + '<br>';
		return false;
	}
	checkCaptcha(f);
	if (($('#incCaptcha:visible').length > 0)
			&& ($('#incCaptcha').text().length > 0)) {
		doImageReload();
		document.getElementById("incCaptcha").innerHTML = "Please enter valid captcha code";
		return false;
	}
	return true;
}







