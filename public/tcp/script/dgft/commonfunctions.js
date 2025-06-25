window.scrollTo(0,0);




$.fn.serializeObject = function() {
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [ o[this.name] ];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};

$.fn.currency = function (value, fraction) {
    var self = $(this);
    if (value === undefined) {
        return self.val().replace(/,/g , '');
    } else {
        if(fraction == undefined) {
	    		fraction = 2;
	    }
        
        if($.isNumeric(value)) {
        	value = new Intl.NumberFormat('en-IN', { 
				minimumFractionDigits: fraction, 
	        }).format(value);
		}
	    self.val(value);
    }
}

Number.prototype.toFixed = function(decimals) {
	var with2Decimals = null;
	if(this != null && this != undefined && $.isNumeric(this)) {
		with2Decimals = this.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]
	}
	return with2Decimals; 
};

/*
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	   
	"de_datetime-asc": function ( a, b ) {
		var x, y;
		
		if (jQuery.trim(a) !== '') {
		  
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea[1]!= undefined?deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 && deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                        }
		} else {
			x = -Infinity; // = l'an 1000 ...
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length > 1 ?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 && deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                        }
		} else {
			y = -Infinity;
		}
		var z = ((x < y) ? -1 : ((x > y) ? 1 : 0));
		return z;
	},

	"de_datetime-desc": function ( a, b ) {
		var x, y;
		if (jQuery.trim(a) !== '') {
		   
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea != undefined && deDatea.length>1 ? deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 &&  deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                        }
		} else {
			x = Infinity;
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length>1?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 &&  deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                        }
		} else {
			y = -Infinity;
		}
		var z = ((x < y) ? 1 : ((x > y) ? -1 : 0));
		return z;
	}
} );*/

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	   
	"de_datetime-asc": function ( a, b ) {
		var x, y,t1,t2;
		if (jQuery.trim(a) !== '') {
		  
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea[1]!= undefined?deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 && deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                            t1 = deTimea != undefined && deTimea.length>1? (deTimea[0] + deTimea[1]) * 1:undefined;
                        }
		} else {
			x = -Infinity; // = l'an 1000 ...
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length > 1 ?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 && deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                            t2 = deTimeb != undefined && deTimeb.length>1? (deTimeb[0] + deTimeb[1]) * 1:undefined;
                        }
		} else {
			y = -Infinity;
		}
		var z = ( x == y ? ((t1 < t2) ? -1 : ((t1 > t2) ? 1 : 0)) :((x < y) ? -1 : ((x > y) ? 1 : 0)));
		return z;
	},

	"de_datetime-desc": function ( a, b ) {
		var x, y,t1,t2;
		if (jQuery.trim(a) !== '') {
		   
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea != undefined && deDatea.length>1 ? deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 &&  deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                            t1 = deTimea != undefined && deTimea.length>1? (deTimea[0] + deTimea[1]) * 1:undefined;
                        }
		} else {
			x = Infinity;
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length>1?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 &&  deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                            t2 = deTimeb != undefined && deTimeb.length>1? (deTimeb[0] + deTimeb[1]) * 1:undefined;
                        }
		} else {
			y = -Infinity;
		}
		var z = ( x == y ? ((t1 < t2) ? 1 : ((t1 > t2) ? -1 : 0)) :((x < y) ? 1 : ((x > y) ? -1 : 0)));
		return z;
	}
} );


jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	   
	"de_datetime-asc": function ( a, b ) {
		var x, y,t1,t2;
		if (jQuery.trim(a) !== '') {
		  
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea[1]!= undefined?deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 && deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                            t1 = deTimea != undefined && deTimea.length>1? (deTimea[0] + deTimea[1]) * 1:undefined;
                        }
		} else {
			x = -Infinity; // = l'an 1000 ...
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length > 1 ?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 && deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                            t2 = deTimeb != undefined && deTimeb.length>1? (deTimeb[0] + deTimeb[1]) * 1:undefined;
                        }
		} else {
			y = -Infinity;
		}
		var z = ( x == y ? ((t1 < t2) ? -1 : ((t1 > t2) ? 1 : 0)) :((x < y) ? -1 : ((x > y) ? 1 : 0)));
		return z;
	},

	"de_datetime-desc": function ( a, b ) {
		var x, y,t1,t2;
		if (jQuery.trim(a) !== '') {
		   
			var deDatea = jQuery.trim(a).split(' ');
			var deTimea = deDatea != undefined && deDatea.length>1 ? deDatea[1].split(':'):undefined;
			var deDatea2 = deDatea[0].split('/');
                        if(deTimea != undefined && deTimea.length> 1 &&  deTimea[2] != undefined) {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0] + deTimea[0] + deTimea[1] + deTimea[2]) * 1;
                        } else {
                            x = (deDatea2[2] + deDatea2[1] + deDatea2[0]) * 1;
                            t1 = deTimea != undefined && deTimea.length>1? (deTimea[0] + deTimea[1]) * 1:undefined;
                        }
		} else {
			x = Infinity;
		}

		if (jQuery.trim(b) !== '') {
		   
			var deDateb = jQuery.trim(b).split(' ');
			var deTimeb = deDateb != undefined && deDateb.length>1?deDateb[1].split(':'):undefined;
			deDateb = deDateb[0].split('/');
                        if(deTimeb != undefined && deTimeb.length> 1 &&  deTimeb[2] != undefined) {
                            y = (deDateb[2] + deDateb[1] + deDateb[0] + deTimeb[0] + deTimeb[1] + deTimeb[2]) * 1;
                        } else {
                            y = (deDateb[2] + deDateb[1] + deDateb[0]) * 1;
                            t2 = deTimeb != undefined && deTimeb.length>1? (deTimeb[0] + deTimeb[1]) * 1:undefined;
                        }
		} else {
			y = -Infinity;
		}
		var z = ( x == y ? ((t1 < t2) ? 1 : ((t1 > t2) ? -1 : 0)) :((x < y) ? 1 : ((x > y) ? -1 : 0)));
		return z;
	}
} );

var ajax = (function() {

	var get = function(url, callbackSuccess, callbackError) {
		return $.get(url, function(data) {
			callbackSuccess(data);
		}).fail(function(data) {
			if (data.responseText == '') {
				window.location = "";
			}
			if (callbackError != undefined) {
				callbackError(data);
			} else {
				hideProgressbar();
				console.log("-----------Error-------------");
				console.log(data);
				console.log(url);
			}
			hideProgressbar();
		}).error(function(data) {
			hideProgressbar();
		})
	};

	var post = function(url, data, callbackSuccess, callbackError) {
		resetSession();
		showProgressbar();

		var token = $("meta[name='_csrf']").attr("content");
		url += "&_csrf=" + token;
		return $.ajax({
			method : "POST",
			url : url,
			data : data,
			success : function(data) {
				hideProgressbar();
			try{
				callbackSuccess(data);
			}catch(e){
				
			}	
			},
			error : function(data) {
				if (callbackError != undefined) {
					callbackError(data);
				} else {
					hideProgressbar();
					console.log("-----------Error-------------");
					console.log(url);
				}
			}
		})
	};

	var postSyncData = function(url, data, callbackSuccess, callbackError) {
		console.log(url)
		return $.ajax({
			type : "POST",
			async : false,
			timeout : 1200000,
			url : serverURL + url,
			data : JSON.stringify(data),
			contentType : "application/json; charset=utf-8",
			success : function(data) {
				hideProgressbar();
				callbackSuccess(data);
			},
			error : function(data) {
				if (callbackError != undefined) {
					callbackError(data);
				} else {
					hideProgressbar();
					console.log("-----------Error-------------");
					console.log(url);
				}
			}
		})
	};

	var getSyncData = function(url, callbackSuccess, callbackError) {
		console.log(url)
		return $.ajax({
			type : "GET",
			async : false,
			timeout : 10000,
			url : serverURL + url,
			success : function(data) {
				callbackSuccess(data);
			},
			error : function(data) {
				if (callbackError != undefined) {
					callbackError(data);
				} else {
					hideProgressbar();
					console.log("-----------Error-------------");
					console.log(url);
				}
			}
		})
	};

	var request = function(url, data, htmlLoadDivId, callbackSuccess,
			callbackError) {
		resetSession();
		showProgressbar();
		updateContainer(url, data, htmlLoadDivId, false, callbackSuccess);
		//hideProgressbar();
	};

	var resetSession = function () {
		var $sessionDiv = $('#sessionnav');
		if ($sessionDiv.length > 0 && typeof sessionWarning  !== 'undefined' )  {
		   sessionInitialise(sessionWarning,sessionExpiryTimeOut,counter);
		}
	}
	return {
		get : get,
		post : post,
		getSyncData : getSyncData,
		postSyncData : postSyncData,
		request : request,
	}
})();

var common = (function() {

	var getSelectBoxObject = function(serializeObj) {

		var keyValueObject = {};
		if ($('[name=' + serializeObj.name + ']').is('select')) {

			if ($('[name=' + serializeObj.name + ']').prop('multiple')) {
				keyValueObject = getMultiSelectArray(serializeObj.name);
			} else {

				var selectVal = serializeObj.name != '' && serializeObj.value != '' ? $(
						'[name=' + serializeObj.name + ']').find(
						'[value=' + serializeObj.value + ']').text().trim()
						: '';
				keyValueObject = {
					'key' : serializeObj.value,
					'value' : selectVal
				}
			}
		}
		return keyValueObject;
	}

	/* Validation*/

	var showError = function() {
		
		var errorString = $("#errorId").val();
		
		if (errorString == "") {
			$("#errorMsgPannel").addClass("d-none");
			$("#successMsgPannel").addClass("d-none");
			$("#warningMsgPannel").addClass("d-none");
		} else {
			$("#errorMsgPannel").removeClass("d-none");
			$("#successMsgPannel").addClass("d-none");
			$("#warningMsgPannel").addClass("d-none");
			$("#errorOccured").empty();
			$("#errorOccured").append("<span>" + errorString + "</span>");
			
		}
	}
	var showSucessMsg = function() {
		
		var errorString = $("#errorId").val();
		if (errorString == "") {
			$("#errorMsgPannel").addClass("d-none");
			$("#successMsgPannel").removeClass("d-none");
			$("#warningMsgPannel").addClass("d-none");
			$("#passedSuccess").empty();
			$("#passedSuccess").append("<span>Your draft have been saved successfully</span>");
			
		} 
	}

	
	var showWarning = function() {
		
		var warningString = $("#warningId").val();
		var del = $("#hdnDelStatus").val();
		
	
		if(del!="" && del!=undefined ){
			if($("#warningId").val() == ""){
				$("#warningMsgPannel").removeClass("d-none");
				$("#passedWarning").empty();
			}
			$("#passedWarning").append("<span>" + del + "</span>");
			$("#successMsgPannel").addClass("d-none");
			
		}
		if (warningString == "") {
			$("#warningMsgPannel").addClass("d-none");
			$("#successMsgPannel").addClass("d-none");
			$("#warningMsgPannel").addClass("d-none");
		} else {
			$("#warningMsgPannel").removeClass("d-none");
			$("#passedWarning").empty();
			$("#passedWarning").append("<span>" + warningString + "</span>");
			$("#successMsgPannel").addClass("d-none");
		}
	}
	var showDelStatus = function () {
		if ($("#hdnDelStatus").val() != "") {
			showWarning();
		}
	};
	var isValid = function(myArray) {

		var flag = false;
		$(myArray)
				.each(
						function() {

							var thisVal = "#" + this;
							$(thisVal).next('.alertmsg').remove();
							$(thisVal).next(".error-msg").remove();
							if ($(thisVal).attr('type') == "text"
									&& $(thisVal).val() == '') {
								/* Validation for textbox*/
								flag = true;
								$(thisVal)
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);
							}
							else if ($(thisVal).attr('type') == "email"
								&& $(thisVal).val() == '') {
							/* Validation for textbox*/
							flag = true;
							$(thisVal)
									.after(
											'<span class="error-msg">This is a mandatory field</span>');
							openCollapse(thisVal);
							}
							else if ($(thisVal).attr('type') == "radio"
									&& $(thisVal).prop("checked") == false) {
								/* Validation For Radio*/
								flag = true;
								$(thisVal)
										.parent()
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);
							} else if ($(thisVal).is('select')
									&& ($(thisVal).val() == '-1'
											|| $("#" + this).val() == '' || $(
											thisVal).val() == null)) {
								/* Validation For Select*/
								flag = true;
								$(thisVal)
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);

							} else if ($(thisVal).attr('type') == "checkbox"
									&& $(thisVal).prop("checked") == false) {

								/* Validation For Checkbox*/
								flag = true;
								$(thisVal)
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);

							} else if ($(thisVal).is('hidden')
									&& $(thisVal).val() == '') {
								/* Validation  */
								flag = true;
								$(thisVal)
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);

							} else if ($(thisVal).is('textarea')==true && $(thisVal).val().trim() == '')
								 {
								/* Validation for textbox*/
								flag = true;
								$(thisVal)
										.after(
												'<span class="error-msg">This is a mandatory field</span>');
								openCollapse(thisVal);
								}
							else if($(thisVal).attr('type') == "password" && $("#"+this).val() == '') {
						 		/* Validation For Password*/
								 flag = true;
						 			$("#"+this).after('<span class="error-msg">This field Required</span>');
						 			
						 	}
							
						});
		return flag;
	}
	var openCollapse = function(thisvalue) {
		var hasOpen = $(thisvalue).closest('.collapse').hasClass('show');
		if(hasOpen == false){
			$(thisvalue).closest('.collapse').addClass('show');
			$(thisvalue).closest('.collapse').prev().find('.collapsed-icon').removeClass('collapsed')
		}
	}
	var getToken = function() {
		return $("meta[name='_csrf']").attr("content");
	}

	var getActiveTab = function() {
		var currntTab = $(".progress-step").find("li.active");
		return currntTab;
	}

	var getActiveTabName = function() {
		return getActiveTab().attr("data-tab");
	}

	var buildKeyValuePair = function(array, field) {

		$.each(array, function(i, item) {
			$.each(item, function(key, value) {
				if (key.indexOf(field) != -1) {
					var attKey = item[field + '_key'];
					var attVal = item[field + '_Value'];
					item[field] = {
						'key' : attKey,
						'value' : attVal
					};
				}
			});
		});
	}

	var buildKeyValueForJson = function(item, field) {

		$.each(item, function(key, value) {
			if (key.indexOf(field) != -1) {
				var attKey = item[field + '_key'];
				var attVal = item[field + '_Value'];
				item[field] = {
					'key' : attKey,
					'value' : attVal
				};
			}
		});
	}

	var getNextOrPreModule = function() {

		var nextOrPreModule = "";
		try {
			/**
			 * currentTabJson input define in commonInputs.jsp 
			 */
			nextOrPreModule = JSON.parse($("#currentTabJson").val()).moduleName;
		} catch (e) {
			console.log(e);
		}
		return nextOrPreModule;
	}

	var buildAttachmentDTO = function(attachTypeClass) {

		let attachment = {};
		if (attachTypeClass != undefined) {
			attachTypeClass = "." + attachTypeClass;
			attachment.s3Path = $(attachTypeClass + " #aswS3Path").val();
			attachment.fileName = $(attachTypeClass + " #fileName").val();
		}
		return attachment;
	}
	
	var buildMultiAttachmentDTO = function(attachTypeClass) {

		let attachment = {};
		if (attachTypeClass != undefined) {
			attachment.s3Path = $("#AttachmentString_"+attachTypeClass).val();
			attachment.fileName = $("#fileName_"+attachTypeClass).val();
			attachment.fileSize = $("#totalFileSize_"+attachTypeClass).val();
			attachment.fileType = $("#allowedExtensions_"+attachTypeClass).val();
		}
		return attachment;
	}

	var isJSON = function(item) {
		var flag = false;
		if (typeof item === "object" && item !== null) {
			flag = true;
		}
		return flag;

	}
	var getMultiSelectArray = function(selectBoxName) {

		var keyValueArray = [];
		$.each($('[name=' + selectBoxName + ']' + ' option:selected'),
				function() {
					var keyVal = {
						key : $(this).val(),
						value : $(this).text().trim()
					}
					keyValueArray.push(keyVal);
				});
		return keyValueArray;
	}

	var signDigital = function(formData, setDigitalSignId) {
		ajax
				.post(
						"web?requestType=ApplicationRH&actionVal=callDigitalSignature&screenId=90000527",
						formData,
						function(response) {
						
						//	var dataToBeSigned = {"Jyoti":"Jyoti", "test":"test"}
							digitalSignature.btnDigiSign(
									formData, formData);
							if (setDigitalSignId != undefined) {
								setDigitalSignId();
							}
						})
	}
	var showSuccess = function(msg) {
		
		$("#passedSuccess").empty();
		$("#errorMsgPannel").addClass("d-none");
		$("#warningMsgPannel").addClass("d-none");
		$("#successMsgPannel").removeClass("d-none");
		$("#passedSuccess").append("<span>" + msg + "</span>");
	}
	var showFail = function(msg) {
		$("#errorOccured").empty();
		$("#errorMsgPannel").removeClass("d-none");
		$("#successMsgPannel").addClass("d-none");
		$("#errorOccured").append("<span>" + msg + "</span>");
	}
	var closeErrorBox = function() {
		$("#errorMsgPannel").addClass("d-none");
		$("#errorOccured").empty();

	}
	var closeSuccessBox = function() {
		$("#successMsgPannel").addClass("d-none");
		$("#passedSuccess").empty();

	}
	
	var closeWarnigBox = function() {
		$("#warningMsgPannel").addClass("d-none");
		$("#passedWarning").empty();

	}
	var convertRate = function(toCurrency, purpose, callback) {
		var json = {
			"toCurrency" : toCurrency,
			"purpose" : purpose
		};
		ajax
				.post(
						"web?requestType=ApplicationRH&actionVal=convertCurrency&screenId=90000796",
						json, function(res) {
							if (purpose == "freelyConvertibleCurrency") {
								$('#freeCnvrtRateForExport')
										.val(res.exportRate);
								$('#freeCnvrtRateForImport')
										.val(res.importRate);

							}
							if (purpose == "currencyOfImports") {
								$('#CurrencyImprtRateForExport').val(
										res.exportRate);
								$('#CurrencyImprtRateForImport').val(
										res.importRate);

							}
							if (purpose == "usd") {
								$('#usdRateForExport').val(res.exportRate);
								$('#usdRateForImport').val(res.importRate);
								return true;
							}
							if (purpose == "inr") {
								$('#inrRateForExport').val(res.exportRate);
								$('#inrRateForImport').val(res.importRate);
								return true;
							}
							 if(callback !== undefined){
								  callback();
								}
						});
		convertRateInUs(1001, "usd");
		convertRateInInr(1019, "inr");
		 

	}
	var convertRateInUs = function(toCurrency, purpose) {
		var json = {
			"toCurrency" : toCurrency,
			"purpose" : purpose
		};
		ajax
				.post(
						"web?requestType=ApplicationRH&actionVal=convertCurrency&screenId=90000796",
						json, function(res) {

							$('#usdRateForExport').val(res.exportRate);
							$('#usdRateForImport').val(res.importRate);
							return true;
						});

	}
	
	
	var convertRateInInr = function(toCurrency, purpose) {
		
		var json = {
			"toCurrency" : toCurrency,
			"purpose" : purpose
		};
		ajax
				.post(
						"web?requestType=ApplicationRH&actionVal=convertCurrency&screenId=90000796",
						json, function(res) {

							$('#inrRateForExport').val(res.exportRate);
							$('#inrRateForImport').val(res.importRate);
							return true;
						});

	}
	var result;
	var deleteTableRow = function(table, row,callbackSuccess, msg) {
			
		const promtmsg = msg ? msg : "Are you sure you want to delete?";
		bootbox.confirm(promtmsg,function(result){
			
		if(result){
			
			if ($(row).attr('class') == "child") {
				row = $(row).prev();
			}
			table.row(row).remove().draw(false);

			if(callbackSuccess != undefined && callbackSuccess != null){
				callbackSuccess(result);
			}
			}
		
		});
	};
	
	
	var formatCurrency = function(val, fraction) {
		if(fraction == undefined) {
	    		fraction = 2;
	    }
		if($.isNumeric(val)) {
			val = new Intl.NumberFormat('en-IN', { 
				minimumFractionDigits: fraction, 
	        }).format(val);
		}
	    return val;
	}
	
	var applyCurrencyFormat = function() {
		$.each($(".format-currency"),function(i,obj){
			_applyCurrency(obj);
		});
	};
	
	var _applyCurrency = function(obj){
		try {
			let _self = $(obj);
			if(_self.is('input:text')) { 
				_self.currency(_self.val());
			} else if (_self.is('td')) {
				_self.html(formatCurrency(_self.html()));
			} else if (_self.is('p')) {
				_self.html(formatCurrency(_self.html()));
			} else if (_self.is('span')) {
				_self.html(formatCurrency(_self.html()));
			}
		} catch(e){
			console.log("error in _applyCurrency"+e);
		}
	}
	
	
	var disabledDiv = function(tabDivId) {
		
		let tabDiv = "#"+tabDivId;
		if($(tabDiv).length > 0){
			if($("#entityHide").val() == 'disable'){
				//$(tabDiv).addClass("disabledbutton", true); 
			}else{
				$(tabDiv).removeClass("disabledbutton", false); 
			}
		}
	};
	
	var addSerialNumber = function(tblName) {
		try {
			tblName = "#"+tblName;
			$(tblName).find("thead th").eq(0).before('<th class="slNo">SNo.</th>');
			setTimeout(function(){ 
				$.each($(tblName).find("tbody tr"), function(i, obj){
					$(obj).find("td").eq(0).before('<td>'+ (i + 1) +'</td>');
				});
			}, 1);
		} catch (e) {
			console.log(e);
		}
	}
	var addSerialNumberWithRowSpan = function(tblName) { 
		try {
			tblName = "#"+tblName;
			$(tblName).find("thead th").eq(0).before('<th class="slNo" rowspan="2">SNo.</th>');
			setTimeout(function(){ 
				$.each($(tblName).find("tbody tr"), function(i, obj){
					$(obj).find("td").eq(0).before('<td>'+ (i + 1) +'</td>');
				});
			}, 1);
		} catch (e) {
			console.log(e);
		}
	}
	var setKeyVal = function (jsonData, field){
		$.each(jsonData, function(key,value) {
			if (key == field && jsonData[key] != null) {
				jsonData[key + '_key'] = jsonData[key]['key'];
				jsonData[key + '_Value'] = jsonData[key]['value'];
			}		
		});
	}
	
	var buildDeclaration = function() {
		var json = JSON.parse($("#declarationJson").val());
		json.place = $('#declarationPlace').val();
		json.date = $('#declarationDate').val();
		
		if($("#declarationCheckId").prop("checked") == true){
			json.declarationCheckId = 1;
		}else{
			json.declarationCheckId = 0;
		}
		return json;
	}
	var jumpSelectedRowPage = function(dataTbl) {
		//$($.fn.dataTable.tables(true)).css('width', '100%');
		//dataTbl.columns.adjust().draw();
		try {
			$.each(dataTbl.data().toArray(), function(index, obj) { 
			    if(obj['0'] == 'checked') {
			    	console.log(index);
				    var jumpPage = Math.floor((index)/10);
				    console.log(jumpPage);
				    dataTbl.page(jumpPage).draw(false);
			        return false;
			    }
			});
		} catch(e) {
			console.log(e);
		}
	}
	
	var validateMaxlengthWithCharTracker=function(id){
		$('#'+id).next(".error-msg").remove();
		$('#'+id).next(".warning-msg").remove();
		var maxlength =$('#'+id).attr("maxlength");
	    var currentLength = $('#'+id).val().length;
	    if( currentLength > (maxlength-1) ){
	    	$('#'+id).after('<span class="error-msg">You have reached the maximum number of characters.</span>');
	        }
	    else {
	    	$('#'+id).next(".error-msg").remove();
	    	$('#'+id).next(".warning-msg").remove();
	    	$('#'+id).after('<span class="warning-msg">Character remains are  :' +(maxlength-currentLength)+  '</span>');
		}
	}
	
	var buildAttachmentTable = function(attchArr) {
		var attchdata = "";
		if (attchArr.length > 0) {
			for (var attch = 0; attch < attchArr.length; attch++) {
				var hshArray = attchArr[attch].hashDocuments;
				for (var j = 0; j < hshArray.length; j++) {
					var tr = "";
					tr += "<tr>";
					tr += "<td>" + attchArr[attch].attachmentType.value + "</td>";
					tr += "<td>" + (attchArr[attch].remark == '' ? 'NA' : attchArr[attch].remark) + "</td>";
					tr += "<td>" + hshArray[j].name + "</td>";
					tr += "</tr>";
					attchdata += tr;
				}
			}
		}
		return attchdata;
	}
	
	var attachmentWarning= function(callback) {
		var flag = false
		var attType = $("#attachment_div #attachmentType").val();
		var path = $("#AttachmentString_" + attType).val();
		path = path == "0" ? "" : path;
		if(attType != undefined && attType != -1 && path != "") {
			bootbox.confirm("You haven't upload your documents, if you not upload documents then it will be lost. Are you sure want to proceed?",function(result) {
				if(result){
					flag = true;
					$("#attachment_div #attachmentType").val(-1);
					callback();
				}
			});
			throw new Error("Only for stop execution....");
		} else {
			flag = true;
		}
		return flag;
	}
	
	var fn_checkForCSS = function(input)  {
		var regexpforHTMLTag1 = new RegExp("(<|&#60|u003C)\\s*(\\S+)\\s*[^>]*\\s*(>|&#62|u003E)(.*)(<|&#60|u003C)\\/\\s*\\2\\s*(>|&#62|u003E)","gi");
		var regexpforHTMLTag2 = new RegExp("(<|&#60|u003C)\\s*(\\S+)\\s*([^>]*)\\s*(>|&#62|u003E)","gi");
		var regexpforXMLTag = new RegExp("((<|&#60|u003C).[^(><.)]+(>|&#62|u003E))","gi");
		var regexpforEqualVal = new RegExp("(\\s*\\w+\\s*)=\\1","gi");
		var regexforContent = new RegExp("(.*)\\$\\{(.*)","gi");
		if(regexpforHTMLTag1.test(input) || regexpforHTMLTag2.test(input) || regexpforXMLTag.test(input) || regexpforEqualVal.test(input) 
				|| regexforContent.test(input)) {
			return true;
		} else {
			return false;
		}
	}

	var fn_sqlInjection = function(input)  {
		var regexpforMETACHAR1 = new RegExp("(--)|(%23)|(&#35)|(#)","gi");
		var regexpforMETACHAR2 = new RegExp("((%3D)|(&#61)|(u003D)|(=))[^\n]*((--)|(%3B)|(&#59)|(u003B)|(;))","gi");
		var regexpforORclause = new RegExp("\\w*((%27)|(&#32)|(u0027)|('))(\\s*)((%6F)|(&#111)|(u006F)|o|(%4F)|(&#79)|(u004F))((%72)|(&#114)|(u0072)|r|(%52)|(&#82)|(u0052))","gi");
		var regexpforSQLwords = new RegExp("((%27)|(&#32)|(u0027)|('))(\\s*)(union|select|insert|update|delete|drop)","gi");
		var regexpforMsSQL = new RegExp("exec(\\s|\\+)+(s|x)p\\w+","gi");

		if(regexpforMETACHAR1.test(input) || regexpforMETACHAR2.test(input) || (regexpforORclause.test(input) && input != "STUDIO D'OR") 
				                || regexpforSQLwords.test(input) || regexpforMsSQL.test(input)) {
			            return true;
		} else {
				return false;
			}
	}
	
	var fn_isCrossSiteScript = function(input) {
		if (fn_checkForCSS(input) || fn_sqlInjection(input)) {
	        return true;
	    }
	    return false;
	}
	
	var checkStream = (fieldId) => {
		
		// Added with reference to Feature #1512 by - Mayank (2156013)
		const id = "#" + fieldId
		
		if ($.trim($(id).val()) === '') {			
			$(id).val($(id).val().trim());
		}
	}
	
	var filterSpecialChar = (fieldId) => {
		
		// Added with reference to Bug #1560 by - Mayank (2156013)
		const id = "#" + fieldId
		let desc = $(id).val();
		
		if (desc.includes('\"')) {
			$(id).val($(id).val().replaceAll('"', "``"));
			desc = $(id).val();
		}
		
		if (desc.includes('\\')) {
			$(id).val($(id).val().replaceAll(/\\/g, ""));
		}
	}
	
	var streamDate = (id) => {
		
		// Added with reference to Bug #1303 - By Mayank (2156013)
		let date = $(id).val();
		
		$(id).val(date.replace(/[-.]/g, "/"));
		
		const regexForDate = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/;
		
		if (!regexForDate.test(date)) {
			return false;
		}
		
		let splitDate = date.split('/');
		
		let dd = parseInt(splitDate[0], 10); // Used 10 because of decimal (base-10) number system only
		let mm = parseInt(splitDate[1], 10);
		let yyyy = parseInt(splitDate[2], 10);
		
		let correctDate = new Date(yyyy, mm - 1, dd); // Used -1 because JS consider it from 0 index
		
		if (dd !== correctDate.getDate() || mm !== correctDate.getMonth() + 1 || yyyy !== correctDate.getFullYear()) {
			return false;
		}
		
		return `${String(dd).padStart(2, 0)}/${String(mm).padStart(2, 0)}/${yyyy}`;
	}

	return {
		getToken : getToken,
		getActiveTab : getActiveTab,
		getActiveTabName : getActiveTabName,
		getNextOrPreModule : getNextOrPreModule,
		buildKeyValuePair : buildKeyValuePair,
		buildKeyValueForJson : buildKeyValueForJson,
		isValid : isValid,
		getSelectBoxObject : getSelectBoxObject,
		buildAttachmentDTO : buildAttachmentDTO,
		isJSON : isJSON,
		getMultiSelectArray : getMultiSelectArray,
		signDigital : signDigital,
		showError : showError,
		showSuccess : showSuccess,
		showFail : showFail,
		closeErrorBox : closeErrorBox,
		closeSuccessBox : closeSuccessBox,
		convertRate : convertRate,
		showSucessMsg:showSucessMsg,
		deleteTableRow : deleteTableRow,
		disabledDiv : disabledDiv,
		openCollapse:openCollapse,
		buildMultiAttachmentDTO : buildMultiAttachmentDTO,
		showWarning:showWarning,
		closeWarnigBox:closeWarnigBox,
		formatCurrency : formatCurrency,
		applyCurrencyFormat : applyCurrencyFormat,
		jumpSelectedRowPage : jumpSelectedRowPage,
		showDelStatus : showDelStatus,
		addSerialNumber : addSerialNumber,
		addSerialNumberWithRowSpan : addSerialNumberWithRowSpan,
		setKeyVal : setKeyVal,
		buildDeclaration:buildDeclaration,
		validateMaxlengthWithCharTracker:validateMaxlengthWithCharTracker,
		buildAttachmentTable : buildAttachmentTable,
		attachmentWarning : attachmentWarning,
		fn_isCrossSiteScript : fn_isCrossSiteScript,
		checkStream : checkStream,
		filterSpecialChar : filterSpecialChar,
		streamDate : streamDate
	}
})();

var URLBuilder = function() {

	var baseURL = "web?requestType=ApplicationRH";
	var and = "&";
	var actionVal = "actionVal=handleRequest", screenId = "screenId=", direction = "direction=", currentTab = "currentTab=", fromTab = "fromTab=",fromIndex = "fromIndex=",toIndex = "toIndex=", queryParam;

	var self = {
		actionVal : function(val) {
			actionVal += val
			return this
		},
		screenId : function(val) {
			screenId += val
			return this
		},
		direction : function(val) {
			direction += val
			return this
		},
		currentTab : function(val) {
			currentTab += val
			return this
		},
		fromTab : function(val) {
			fromTab += val
			return this
		},
		fromIndex : function(val) {
			fromIndex += val
			return this
		},
		toIndex : function(val) {
			toIndex += val
			return this
		},
		queryParam : function(val) {
			queryParam = val
			return this
		}
	}

	Object.defineProperty(self, "tabUrl", {
		get : function() {
		
			var urls = [ baseURL, actionVal, screenId, direction, currentTab,
					fromTab,fromIndex,toIndex ];
			return urls.join(and);
			// baseURL.concat(and, actionVal, and,screenId, );
		}
	});

	Object.defineProperty(self, "requestUrl", {
		get : function() {
			var urls = [ baseURL, actionVal, screenId, queryParam ];
			return urls.join(and);
		}
	});

	return self;
}

/* progress bar Jquery */

var progressBar = (function() {
	var container = $(".progress-container"), steps = $(".progress-step li",
			container), bar = $(".progress-bar div", container);

	var build = function() {
		var progress_length = $("#progress_line li").length;
		var basic_content_value = 100 / progress_length;
		var content_value = basic_content_value;
		var progrees_length_val = $('#progress_line').width() / progress_length;
		$('#progress_line li  p').css("width", progrees_length_val);
		$('#progress_line li:last-child  p').css("width",
				progrees_length_val / 2);
		for (var i = 1; i <= progress_length; i++) {
			$('.list' + i).append(
					'<style>.progress-container .progress-step .li' + i
							+ '::before{counter-increment: "' + content_value
							+ '%";}</style>');

			content_value = content_value + basic_content_value;
			var progress_step_title = $('.li' + i + ' p').attr("data-tabname");

			//var progress_step_title = $('.li' + i + ' p').text();
			//			if (window.innerWidth < 767) {
			//
			//				if (progress_step_title.length > 4) {
			//					var shortname = progress_step_title.substring(0, 4) + "...";
			//
			//					$('.li' + i + ' p').html(shortname);
			//
			//				}
			//			} else {
			//				if (progress_step_title.length > 10) {
			//					var shortname = progress_step_title.substring(0, 10)
			//							+ "...";
			//
			//					$('.li' + i + ' p').html(shortname);
			//
			//				}
			//			}
			//if (progress_step_title.length > 25) {
			// var shortname = progress_step_title.substring(0, 25) + "...";

			//$('.li' + i + ' p').html(shortname);

			//}
		}
		//$('[data-toggle="tooltip"]').tooltip();
	}

	var setActive = function(current, divider) {
		var percent = calcPercent(current, divider);

		$("ul.progress-step li:nth-child(" + current + ")").prevAll()
				.removeClass("active");
		$("ul.progress-step li:nth-child(" + current + ")").nextAll()
				.removeClass("active");
		$("ul.progress-step li:nth-child(" + current + ")").addClass("active");
		$(".progress-bar .progress-width").css({
			width : percent + "%"
		});
	}

	var markActive = function(direction) {
		var elm = common.getActiveTab();
		if (direction == "next") {
			elm = (elm.length) ? elm.next() : elm;
		} else {
			elm = (elm.length) ? elm.prev() : elm;
		}
		redirectTab(elm);
	}

	var calcPercent = function(current, divider) {
		var fill = current - 1;
		var percent = (fill * 100) / divider;
		return percent;
	}

	var navigate = function(elem) {
		var index = $(elem).index();
		var stepsLength = $('ul.progress-step li').length - 1;

		$(elem).prevAll().addClass("complated");
		$(elem).nextAll().removeClass("complated");
		$(elem).removeClass("complated");
		setActive(index + 1, stepsLength);
	}
	var redirectTab = function(elm) {
		var index = $(elm).index();
		var stepsLength = $('ul.progress-step li').length - 1;
		$(elm).prevAll().addClass("complated");
		$(elm).nextAll().removeClass("complated");
		$(elm).removeClass("complated");
		progressBar.setActive(index + 1, stepsLength);
	}

	return {
		build : build,
		markActive : markActive,
		navigate : navigate,
		setActive : setActive,
		redirectTab : redirectTab
	}

})();

var commonPopupConfig = (function() {

	var selectedRow = null;
	var tableId = null;
	var getSelectedRow = function(row) {
		return selectedRow;
	}
	var setTableData = function(tblId, row) {
		tableId = tblId;
		selectedRow = (row == undefined) ? null : row;
	};
	var getTableData = function(tblId) {
		return tableId;
	};

	return {
		setTableData : setTableData,
		getSelectedRow : getSelectedRow,
		getTableData : getTableData,
	}
})();

$(document).on('focusin', ".custom-datepicker", function() {
	$(".custom-datepicker").datepicker({
		//dateFormat: "dd/MM/yyyy"
		format : "dd/mm/yyyy",
		autoclose : true
	});
});

$(document).on('focusin', ".dob", function() {
	$(".dob").datepicker({
		format : "dd/mm/yyyy",
		endDate: '-18y',
		autoclose : true
	});
});

$(document).on('focusin', ".custom-datepicker-future", function() {
	
	$(".custom-datepicker-future").datepicker({
		format : "dd/mm/yyyy",
		endDate : '+0d',
		autoclose : true
	});
});
$(document).on('focusin', ".custom-datepicker-past-three", function() {
	$(".custom-datepicker-past-three").datepicker({
		format : "dd/mm/yyyy",
		startDate : '-3y',
		endDate : '+0d',
		autoclose : true
	});
});
$(document).on('focusin', ".custom-datepicker-past", function() {
	$(".custom-datepicker-past").datepicker({
		format : "dd/mm/yyyy",
		startDate : '-0d',
		autoclose : true,
		endDate : '31/12/9999'
	});
});


$(document).on('focusin', ".custom-datepicker-future-one", function() {
	$(".custom-datepicker-future-one").datepicker({
		format : "dd/mm/yyyy",
		startDate : '+0d',
		endDate : '+1y',
		autoclose : true
	});
});

$(document).on('blur', "input[type='text'], textarea", function() {
	$(this).next(".error-msg").remove();
	var inputVal = $(this).val();
	
	if($(this).attr("id") == "remarkSme"){
		// pass for SME Remarks and check with class .alphanumhyphen
	}else{
		if (common.fn_isCrossSiteScript(inputVal)) {
			$(this).val("");
			$(this).after('<span class="error-msg">Invalid input.</span>');
		}
	}
});

$(document).on('blur', ".email-validate", function() {
	$(this).next(".error-msg").remove();
	var inputVal = $(this).val();
	
	var emailReg = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}/g;
	if (!emailReg.test(inputVal)) {
		$(this).val("");
		$(this).after('<span class="error-msg">Invalid Email Format.</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
});


/**for gstin va**/
$(document).on('blur', ".gstin-validate", function() {
	
	$(this).next(".error-msg").remove();
	var inputVal = $(this).val();
	var Reg = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9A-Z]{1}[0-9A-Z]{1}[0-9A-Z]$/;
	// var emailReg = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}/g;
	if (!Reg.test(inputVal)) {
		
		if(!($(this).val()=="")){
		    $(this).val('');
			$(this).after('<span class="error-msg">Invalid GSTIN Format.</span>');
		}
		
	} else {
		$(this).next(".error-msg").remove();
	}
});

//For Alpha Numeric
//Without space
$(document)
		.on(
				'blur keypress',
				".alpha-number",
				function(e) {
					var valStr = $(this).val();
					$(this).next(".error-msg").remove();
					var regex = /^[a-zA-Z0-9]*$/;
					var str = String.fromCharCode(!e.charCode ? e.which
							: e.charCode);
					if (regex.test(str) || (event.type=="blur" && regex.test(valStr))) {
						return true;
						$(this).next(".error-msg").remove();
					} else {
						e.preventDefault();
						$(this)
								.after(
										'<span class="error-msg">Only Type Alpha Numeric</span>');
						return false;
					}

				});
//With Space
$(document)
		.on(
				'blur keypress',
				".alpha-number-space",
				function(e) {
					var valStr = $(this).val();
					$(this).next(".error-msg").remove();
					var regex = /^[a-zA-Z0-9\s]*$/;
					var str = String.fromCharCode(!e.charCode ? e.which
							: e.charCode);
					if (regex.test(str) || (event.type=="blur" && regex.test(valStr))) {
						return true;
						$(this).next(".error-msg").remove();
					} else {
						e.preventDefault();
						$(this)
								.after(
										'<span class="error-msg">Only Type Alpha Numeric</span>');
						return false;
					}

				});
//For Alphabets
//Without Space
$(document).on('blur keypress', ".alpha-only", function(e) {
	var valStr = $(this).val();
	$(this).next(".error-msg").remove();
	var regex = /^[A-Za-z]*$/;
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str) || (event.type=="blur" && regex.test(valStr))) {
		$(this).next(".error-msg").remove();
	} else {
		e.preventDefault();
		$(this).after('<span class="error-msg">Only Type Alphabets</span>');
	}

});

//With Space

$(document).on('blur keypress', ".alpha-only-space", function(e) {

	$(this).next(".error-msg").remove();
	var regex = /^[a-zA-Z\s]*$/;
	var valStr = $(this).val();
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str) || (event.type=="blur" && regex.test(valStr))) {
		$(this).next(".error-msg").remove();
	} else {
		e.preventDefault();
		$(this).after('<span class="error-msg">Only Type Alphabets</span>');
	}

});

//For Only Number
$(document).on('blur keyup paste keypress', ".only-numeric", function(e) {
	$(this).next(".error-msg").remove();
	if($(this).val()!="")
		{
	if ((e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 96 || e.which > 105)) || event.type == 'paste') {
		$(this).after('<span class="error-msg">Only Numeric value allowed</span>');
		 $(this).val('');
		return false;
	} else {
		$(this).next(".error-msg").remove();
	}
		}
	});


//For Amount
$(document).on('keydown blur paste', ".amount-validate", function (e) {
	$(this).next(".error-msg").remove();
	let maxDigit = $(this).attr("data-maxDigit");
	maxDigit = maxDigit ? maxDigit : 16;
	let maxDecimal = $(this).attr("data-maxDecimal");
	maxDecimal = maxDecimal ? maxDecimal : 2;
	var errorMsg = "Maximum " + maxDigit + " digits and "
			+ maxDecimal + " decimal point are allowed";

	var text = $(this).val();
	var ctrlKey = 17, cmdKey = 91;
	var key = !e.charCode ? e.which : e.charCode;
	var isPaste = (key == ctrlKey || key == cmdKey) ? true
			: false;
	if ((isPaste == false && key != 86)
			&& (key != 46 || text.indexOf('.') != -1)
			&& ((key < 48 || key > 57)
					&& (key < 96 || key > 105) && (key != 0
					&& key != 8 && key != 9 && key != 13
					&& key != 190 && key != 110 && key !== 37 && key !== 39))) {
		$(this).after('<span class="error-msg">Only numeric values are allowed.</span>');
		event.preventDefault();
		return;
	}

	if ((text.indexOf('.') != -1)
			&& (text.substring(text.indexOf('.')).length > maxDecimal)
			&& (key != 0 && key != 8 && key != 9 && key != 13
					&& key != 37 && key != 39)
			&& ($(this)[0].selectionStart >= text.length - maxDecimal)) {
		$(this).after('<span class="error-msg">' + errorMsg + '</span>');
		event.preventDefault();
	}
	if ((text.indexOf('.') == -1) && text.length > maxDigit) {
		$(this).after('<span class="error-msg">' + errorMsg + '</span>');
		$(this).val(text.slice(0, -1));
		event.preventDefault();
	}

	if ((text.indexOf('.') > -1)) {
		var beforePoint = text.split(".")[0];
		if (beforePoint.length > maxDigit) {
			$(this).val(beforePoint.slice(0, -1) + "." + text.split(".")[1]);
			text = $(this).val();
			$(this).after('<span class="error-msg">' + errorMsg + '</span>');
			event.preventDefault();
		}
	}

	if ((text.indexOf('.') > -1)
			&& text.length > (maxDigit + maxDecimal + 1)) {
		$(this).after('<span class="error-msg">' + errorMsg + '</span>');
		$(this).val(text.slice(0, -1));
		event.preventDefault();
	}

	if (isNaN(text)) {
		$(this).val("");
		$(this).next(".error-msg").remove();
		$(this).after('<span class="error-msg">only numeric values are allowed.</span>');
	}
});




//For Amount
/* $(document).on('blur keyup',".only-amount", function (e) { 
 var validAmount = /^\d+(\.\d{1,2})?$/.test(this.value),
 val = this.value;
 $(this).next(".error-msg").remove(); 
 if(!validAmount){
 $(this).after('<span class="error-msg">Invalid input!</span>');
 this.value = val.substring(0, val.length - 1);
 }else{
 $(this).next(".error-msg").remove(); 
 }
 });*/
//For Require
/**
 * 
 * 
 */
$(document).on('blur keyup', ".only-decimal", function() {
	$(this).next(".error-msg").remove();
	var numberRegex = /^\s*[+-]?(\d+|\.\d+|\d+\.\d+|\d+\.)(e[+-]?\d+)?\s*$/;
	if (numberRegex.test($(this).val()) == false) {

		$(this).after('<span class="error-msg">Invalid input!</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
});

$(document)
		.on(
				'blur keyup',
				".phoneNumber",
				function() {

					$(this).next(".error-msg").remove();
					var num = /^([0-9]{10,})$/;
					if (num.test($(this).val()) == false) {
						$(this)
								.after(
										' <span class="error-msg">Invalid Contact Number</span>');

					} else {
						$(this).next(".error-msg").remove();
						//this.value = val.substring(0, val.length - 1);
					}

				});

$(document).on('blur', ".banknumber", function() {

	$(this).next(".error-msg").remove();
	var banknumber1 = /^([0-9]{9,18})$/;
	if (banknumber1.test($(this).val()) == false) {
		$(this).next(".error-msg").remove();
		$(this).after(' <span class="error-msg">Invalid Bank Number</span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});
$(document).on('blur', ".pannumber", function() {

	var pannumber = /^([0-9A-Z]{10,})$/;
	if (pannumber.test($(this).val()) == false) {
		$(this).next(".error-msg").remove();
		$(this).after(' <span class="error-msg">Invalid PAN Number</span>');
	} else {
		$(this).val().toUpperCase();
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur', ".cinnumber", function() {

	$(this).next(".error-msg").remove();
	var cinnumber = /^([A-Z0-9]{21,})$/;
	if (cinnumber.test($(this).val()) == false) {
		$(this).after('<span class="error-msg"></span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur keyup', ".gstinnumber", function() {

	$(this).next(".error-msg").remove();
	var gstinnumber = /^([A-Z0-9]{15,})$/;
	if (gstinnumber.test($('.gstinnumber').val()) == false) {

		$(this).after(' <span class="error-msg"></span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur keyup', ".minLength100", function() {
	$(this).next(".error-msg").remove();
	var minLength = 100;
	$(this).next(".error-msg").remove();
	var remainCharLen = 100 - $(this).val().length;
	if ($(this).val().length < minLength) {
		$(this).after(' <span class="error-msg">' +remainCharLen+' Characters Required </span>');
		//$(this).after(' <span class="error-msg">'+remainCharLen+'</span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur', ".dinnumber", function() {

	$(this).next(".error-msg").remove();
	var cpnumber = /^([0-9]{8,})$/;
	if (cpnumber.test($('.dinnumber').val()) == false) {

		$(this).after(' <span class="error-msg"></span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('change blur', ".require-input", function() {
    
	var name = $(this).val();
	$(this).next(".error-msg").remove();
	if (name.length == 0) {
		$(this).after('<span class="error-msg">This is a mandatory field</span>');
	} else if ($(this).is('select') && name == '-1') {

		$(this).after('<span class="error-msg">This is a mandatory field</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
});

$(document)
		.on(
				'blur',
				".warning-text-cin",
				function() {
					var name = $(this).val();
					$(this).next(".warning-msg").remove();
					if (name.length == 0) {
						$(this)
								.after(
										'<span class="warning-msg"></span>');

					} else {
						$(this).next(".warning-msg").remove();
					}
				});

$(document).on('blur', ".warning-text-gstin", function() {
	var name = $(this).val();
	$(this).next(".warning-msg").remove();
	if (name.length == 0) {
		$(this).after('<span class="warning-msg"></span>');

	} else {
		$(this).next(".warning-msg").remove();
	}
});

$(document).on('blur', ".warning-text-din", function() {
	var name = $(this).val();
	$(this).next(".warning-msg").remove();
	if (name.length == 0) {
		$(this).after('<span class="warning-msg"></span>');

	} else {
		$(this).next(".warning-msg").remove();
	}
});

$(document)
		.on(
				'blur',
				".warning-text",
				function() {
					var name = $(this).val();
					$(this).next(".warning-msg").remove();
					if (name.length == 0) {
						$(this)
								.after(
										'<span class="warning-msg">Details Not Entered.</span>');

					} else {
						$(this).next(".warning-msg").remove();
					}
				});

/* progress bar jquery */
$(document).ready(
		function() {
			progressBar.build();

			$('.dropdown-menu a.dropdown-toggle').on(
					'click',
					function(e) {
						if (!$(this).next().hasClass('show')) {
							$(this).parents('.dropdown-menu').first().find(
									'.show').removeClass('show');
						}
						var $subMenu = $(this).next('.dropdown-menu');
						$subMenu.toggleClass('show');

						$(this).parents('li.nav-item.dropdown.show').on(
								'hidden.bs.dropdown',
								function(e) {
									$('.dropdown-submenu .show').removeClass(
											'show');
								});

						return false;
					});
		});

$(document).on('blur keyup', ".gstinnumber", function() {

	$(this).next(".error-msg").remove();
	var gstinnumber = /^([A-Z0-9]{15,})$/;
	if (gstinnumber.test($('.gstinnumber').val()) == false) {

		$(this).after(' <span class="error-msg"></span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur', ".dinnumber", function() {

	$(this).next(".error-msg").remove();
	var cpnumber = /^([0-9]{8,})$/;
	if (cpnumber.test($('.dinnumber').val()) == false) {

		$(this).after(' <span class="error-msg"></span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});

$(document).on('blur', ".require-input", function() {
	var name = $(this).val();
	$(this).next(".error-msg").remove();
	if (name.length == 0) {
		$(this).after('<span class="error-msg">This is a mandatory field</span>');
	} else if ($(this).is('select') && name == '-1') {

		$(this).after('<span class="error-msg">This is a mandatory field</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
});

$(document)
		.on(
				'blur',
				".warning-text",
				function() {
					var name = $(this).val();
					$(this).next(".warning-msg").remove();
					if (name.length == 0) {
						$(this)
								.after(
										'<span class="warning-msg"></span>');

					} else {
						$(this).next(".warning-msg").remove();
					}
				});

$(window).resize(function() {
	progressBar.build();
});

/* dropdown Code */

/* dropdown code */

/*For bootbox*/

//Without Template
$("#withoutTemplate")
		.on(
				"click",
				function(event) {
					modalDialog(
							"My Header",
							"The selected template or Subject Profile. Would you like the system to  automatically adjust the location data for this filing?",
							function() {
								alert(11);
							}, function() {
								alert(2);
							})
				});

var modalDialog = (function(header, msg, callback1, callback2) {

	var dialog = bootbox.dialog({
		title : header,
		centerVertical : true,
		size : 'large',
		message : msg,
		buttons : {
			confirm : {
				label : 'Yes',
				className : 'btn-blue-custom',
				callback : function() {
					callback1();
				}
			},
			cancel : {
				label : 'No',
				className : 'btn-orange-custom',
				callback : function() {
					callback2();
				}
			}
		},
	});

});

// With Template

$("#withTemplate")
		.on(
				"click",
				function(event) {

					modalHTMlDialog
							.setMessage('The selected template or Subject Profile. Would you like the system to  '
									+ ' automatically adjust the location data for this filing?');
					modalHTMlDialog.setFooter("");
					modalHTMlDialog.setTitle("Test");

					var dialog = bootbox.dialog({
						centerVertical : true,
						size : 'large',
						title : modalHTMlDialog.getTitle(),
						message : modalHTMlDialog.getMessage(),
						buttons : {
							confirm : {
								label : 'Yes',
								className : 'btn-blue-custom',
								callback : function() {
									alert(1);
								}
							},
							cancel : {
								label : 'No',
								className : 'btn-blue-custom',
								callback : function() {
									alert(2);
								}
							}
						},
					});
				});

$(document).on('blur', ".iecNo", function() {
	
	$(this).next(".error-msg").remove();
	var iecNo = $(this).val();

	var iecNoReg = /^[A-Z]{5}\d{4}[A-Z]{1}$/;

	if (!(iecNoReg).test(iecNo)) {
	    $(this).val('');
		$(this).after(' <span class="error-msg">Invalid IEC Number</span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});
$(document).on('blur', ".PANValidator", function() {
	
	$(this).next(".error-msg").remove();
	var iecNo = $(this).val();

	var iecNoReg = /^[A-Z]{5}\d{4}[A-Z]{1}$/;

	if (!(iecNoReg).test(iecNo)) {
	    $(this).val('');
		$(this).after(' <span class="error-msg">Invalid PAN Number</span>');
	} else {
		$(this).next(".error-msg").remove();
	}

});
var modalHTMlDialog = (function() {
	var message = "";
	var footer = "";
	var title = "";
	var setMessage = function(msg) {
		message = '<table >  '
				+ '	<tr>  '
				+ '		<td style="padding:5px">   '
				+ msg
				+ '		</td>  '
				+ ' 		<td>'
				+ '		</td>  '
				+ '	</tr>  '
				+ '<tr><td colspan="2"><input type="text" class="form-control"></td></tr>'

		'</table>  ';
	};
	var setFooter = function(msg) {
		footer = '<div class="fl" style="display: inline-block;text-align: left;width: 80%;">'
				+ msg + '</div>';
	}
	var setTitle = function(msg) {
		title = msg;
	}

	var getTitle = function() {
		return title;
	}
	var getMessage = function() {
		return message;
	}
	var getFooter = function() {
		return footer;
	}
	return {
		setTitle : setTitle,
		setMessage : setMessage,
		setFooter : setFooter,
		getTitle : getTitle,
		getMessage : getMessage,
		getFooter : getFooter
	}
})();

$(document).on('blur keyup', ".pinCode", function() {
    
    
    if($('.pinCode').val()!=''){
	if ($('.pinCode').val().length != 6) {
	    $(this).next(".error-msg").remove();
		$(this).after(' <span class="error-msg">Invalid pin code</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
    }
	

});

$(document).on('blur keyup', ".pincode", function() {
    
	
	var inputVal = $(this).val();
	if(inputVal!=''){
	    var pinReg = /^(\d{6})$/;

	if (!(pinReg).test(inputVal)) {
	    $(this).next(".error-msg").remove();
		$(this).after(' <span class="error-msg">Invalid pin code</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
}
	

});

/*IEC  tooltip*/
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
  $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
      console.log(message)
      };
});
/*IEC  tooltip*/


/***for address line not allowing # and % **/
$(document).on('blur','.specialChar', function(){
	return false; /** Client want to allowing all charachter */
    if($(this).val()!=''){
	$(this).next(".error-msg").remove();
	if(($(this).val().includes('#')==true) || ($(this).val().includes('%')==true) || ($(this).val().includes('--')==true) ){
		$(this).val('');
		$(this).next(".error-msg").remove();
		$(this).after('<span class="error-msg">(#),(--) and (%) are not allowed.</span>');
		return true;
	}else{
		
		return false;
	}
	
    }
    

});


$(document).on('blur','.iecLength', function(){
	
	var charLength = $(this).val().length;
	$(this).next(".error-msg").remove();
	if((charLength!=10) ){
		$(this).next(".error-msg").remove();
		$(this).after('<span class="error-msg">Invalid Length Of IEC Number.</span>');
		return true;
	}else{
		$(this).next(".error-msg").remove();
		return false;
	}
	

});


$(document).on('blur','.mobileNumber', function(){
	
	var charLength = $(this).val().length;
if(charLength!=0){
    if((charLength!=10) ){
	$(this).next(".error-msg").remove();
	$(this).after('<span class="error-msg">Invalid Contact Number.</span>');
	return true;
}else{
	$(this).next(".error-msg").remove();
	return false;
}
  
}
	

});


/***for address line not allowing # and % **/
$(document).on('blur', ".ifscCode", function() {
	
	validateIfcCode($(this).attr("Id"), true);

});

var validateIfcCode = function (elm, isResetText){
	elm = "#"+elm;
	
	var ifscCode = $(elm).val();
	var flag = true;
	var ifscCodeReg = /[A-Z]{4}0[A-Z0-9]{6}$/;

	if(ifscCode!=''){
		
	    if (!(ifscCodeReg).test(ifscCode)) {
		if(isResetText){
			$(elm).val('');
		}
		$(elm).after(' <span class="error-msg">Please enter a valid IFS Code e.g. SBIN0999999</span>');
		flag = false;
	} else {
		$(elm).next(".error-msg").remove();
	}
	}
	
	return flag;
}


/*******End Date And  Start Date Validation Added By 1642161*************/
$(document).on('blur', ".enddate", function() {
	
	$('#startDate').datepicker({

	       autoclose: true,
	  }).on("changeDate", function (e) {
	       $('#endDate').datepicker('setStartDate', e.date);
	  });
});
/*******End Date And  Start Date Validation*************/


/******** Print Summary************/
function dgftPrintSummary(obj){
    
    
	try {
		let app = $(obj).attr("data-app") ? $(obj).attr("data-app") : "listner";
		let subapp = $(obj).attr("data-subapp") != undefined ? $(obj).attr("data-subapp") : "listner";
		let json = $(obj).attr("data-json");
		let templateId = $(obj).attr("data-mpgId");
		let applicationNumber = $(obj).attr("data-arn");
//		let json = $("#moduleJson").val();
		let dataSubmission = $(obj).attr("data-submission")!= undefined ? $(obj).attr("data-submission") : "";
		var token = $("meta[name='_csrf']").attr("content");
		let url = "webHP?requestType=ApplicationRH&actionVal="+app+"&print=true&moduleName="+subapp+"&screenId=9000012349&dataSubmission="+dataSubmission+"&mpgId="+templateId+"&arn="+applicationNumber;
		//updateContainer(url,{"cke_ckContent":temp});
		var callback = function(data) {
			}
		const check = document.getElementById("dgftPrintSummary");
		if(!check){
//			const div = document.createElement("div");
//			div.style.display = "none";
//			div.setAttribute("id","dgftPrintSummary");
//			document.body.append(div);
			$('body').append("<div style='display:none' id='dgftPrintSummary'></div>")
		}
//		ajax.request(url,{"summaryjson":'${hashValueList.summaryJson}'},"div_displayReceipt",callback)
		ajax.request(url,{"summaryjson":json},"dgftPrintSummary",callback);
//		ajax.post(url,{"summaryjson":json},callback);
	}
	catch(error) {
	  console.error(error);
	}
}

$(document).on('blur', ".textLong", function() {
	$(this).next(".error-msg").remove();
	var inputVal = $(this).val();
    
    var maxlength = $(this).attr("maxlength");
    var currentLength = $(this).val().length;

    if( currentLength > maxlength ){
	$(this).after('<span class="error-msg">You have reached the maximum number of characters.</span>');
	$(this).val('');
    }
});


$(document).on("click",'a.page-link',function(){
	$(this).attr('href',"javascript:;");
});

/******Start of Alphanumeric validation*********/


$(document).on('blur', ".alphaNumeric", function() {
	$(this).next(".error-msg").remove();
	var inputVal = $(this).val();
	
	var alphaNumericReg = /^[a-zA-Z0-9\s]*$/ ;
	if (!alphaNumericReg.test(inputVal)) {
		$(this).val("");
		$(this).after('<span class="error-msg">Only Alphanumeric values are allowed.</span>');
	} else {
		$(this).next(".error-msg").remove();
	}
});
/******End of Alphanumeric validation*********/

jQuery.fn.dataTable.Api.register( 'page.jumpToData()', function ( data, column ) {
    var pos = this.column(column, {order:'current'}).data().indexOf( data );
 
    if ( pos >= 0 ) {
        var page = Math.floor( pos / this.page.info().length );
        this.page( page ).draw( false );
    }
 
    return this;
} );

/**********************Review Application Start*************************************/
$(document).off("click",".reviewApplication").on("click",".reviewApplication",function(){
	let reviewFileNo = $(this).attr("data-reviewFileNo");
	let reviewAppNo =  $(this).attr("data-reviewAppNo");
	let reviewAppId =  $(this).attr("data-reviewAppId");
	let reviewRemarks = $("#reviewRemarks").val();
	var s3Path=$("#AttachmentString_form_reviewAttachment").val();
	var token = $("meta[name='_csrf']").attr("content");
	if(reviewFileNo != "" && reviewAppNo != "" && reviewAppId != "" && reviewRemarks != ""){
		let url="web?requestType=ApplicationRH&actionVal=reviewApplication&screenId=90000600&_csrf="+token;
		let json={"reviewFileNo":reviewFileNo,"reviewAppNo":reviewAppNo,"reviewAppId":reviewAppId,"reviewRemarks":reviewRemarks,"s3Path":s3Path};
		
		var callback=function(res){
			res = JSON.parse(res);
			
			if(res!=null && res.status != 'undefined' && res.status == true){
				bootbox.alert(res.successMessage);
				menuAct('web?requestType=ApplicationRH&actionVal=Temp&screenId=114&menuCode=200925&auditUSFlag=true');
			} else if (res!=null && res.failureMessage !=null) {
				bootbox.alert(res.failureMessage);
			}else {
				bootbox.alert("Application Submission Failed..");
			}
		}
		ajax.post(url,json,callback);
	} else {
		bootbox.alert("Please fill all the details..");
		//alert("Please fill all the details");
	}
});

function callShortUrl(res) {
     var loginId=$('#loginId').val();
     var url=$(res).attr("data-url");
     if (loginId!=undefined && loginId !='') {
    	 if(url == 'pincode-state-mapping'){
             updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=loadPinSearch&screenId=9000012354');
         }
         else if(url == 'norms-search'){
             updateContainer('web?requestType=ApplicationRH&actionVal=loadpage&screenId=90000534&isNormSearch=isNormSearch');
         }
         else if(url == 'port-details'){
             updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=loadPortSearch&screenId=9000012354');
         }
         else if(url == 'itchs-master-data'){
             updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=itchs&screenId=9000012354');
         }
		 else if(url == 'uom-details'){
			 updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=loadUnitofMeasurmentDetails&screenId=9000012354');
		 }
		 else if(url == 'country-matser'){
			 updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=loadlistofCountiresDetails&screenId=9000012354');
		 }
		 else if(url == 'international-port-details'){
			 updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=loadInternationalDetails&screenId=9000012354');
		 }
		 else if(url == 'currency-list-exchange-rates'){
			 updateContainer('web?requestType=ApplicationRH&actionVal=service&screen=viewRatesMain&screenId=9000012354');
		 }
		 else{
        	 var tmpltId = $(res).attr('data-tmplt-id');
             var cattId =$(res).attr('data-cat-id');
             if($(res).attr('data-tmp-isdatatable') == 'yes') {
            	 updateContainer('webHP?requestType=ApplicationRH&actionVal=serachMetadata&screenId=90000734&catId='+cattId,'' ,'pageContent');
             }else{
            	 updateContainer('webHP?requestType=ApplicationRH&actionVal=preview&screenId=90000552&Flag=true&tmpltId='+tmpltId+'&cat='+cattId,'' ,'pageContent');
             }
         }
     } else {
         window.location= url;
     }
}
$(document).on('click','.postcms',function(){
	
	var tmpltId = $(this).data('tmplt-id');
	var cattId =$(this).data('cat-id');
	
 	if($(this).data('tmp-isdatatable') == 'yes') {
 		updateContainer('webHP?requestType=ApplicationRH&actionVal=serachMetadata&screenId=90000734&catId='+cattId,'' ,'ContContent');
		
	}else {
		updateContainer('webHP?requestType=ApplicationRH&actionVal=preview&screenId=90000552&Flag=true&tmpltId='+tmpltId+'&cat='+cattId,'' ,'ContContent');
	}
});
/**********************Review Application End*************************************/

$(window).on('beforeunload', function(){
    $(window).scrollTop(0);
});

$(document).on('focusin', ".custom-datepicker-manual", function() {
	$(".custom-datepicker-manual").datepicker({
		format : "dd/mm/yyyy",
		endDate : '31/03/2022',
		autoclose : true
	});
});
$(document).on('focusin', ".custom-datepicker-format-yyyy", function() {
	$(".custom-datepicker-format-yyyy").datepicker({
		format : "dd/mm/yyyy",
		endDate : '31/12/9999',
		autoclose : true
	});
});

$(document).on('focusout', ".custom-datepicker-format-yyyy", function() {
	
	let isDateValid = common.streamDate("#" + $(this).attr('id'));
	// Added with reference to Bug #1303 By - Mayank (2156013)
	
	if (!isDateValid) {
		$(this).val('');
	}
});

$(document).on('focusin', ".custom-datepicker-future-yyyy", function() {
	$(".custom-datepicker-future-yyyy").datepicker({
		format : "dd/mm/yyyy",
		endDate : '+0d',
		autoclose : true
	});
});

$(document).on('focusout', ".custom-datepicker-future-yyyy", function(){
	
	let isDateValid = common.streamDate("#" + $(this).attr('id'));
	// Added with reference to Bug #1303 By - Mayank (2156013)
	
	if (!isDateValid) {
		$(this).val('');
	}
});


 function itchsdetailsoption(name,type){
	 var key= name;
	 var type= type;
		var callBack=function(data){
			console.log(data);
			if(type == 1){
				itchsPrintSummary(data,46);
			}
			else{
				itchsPrintSummary(data,47);
			}
		}
		var json={
                "itchsPolicy":key,
                "itcType":type
        };
		
		
		ajax.post("webHP?requestType=ApplicationRH&screenId=90000802&actionVal=getItcDtlsByImportPolicy",json,callBack);
		
		
 }

 function itchsPrintSummary(jsonData,templateId){
 	try {
 		let app = "listner";
 		let subapp ="90000802";
 		let json = JSON.stringify(jsonData);
 		let dataSubmission =  "";
 		var token = $("meta[name='_csrf']").attr("content");
 		let url = "webHP?requestType=ApplicationRH&actionVal="+app+"&print=true&moduleName="+subapp+"&screenId=9000012349&dataSubmission="+dataSubmission+"&mpgId="+templateId;
 		var callback = function(data) {
 			}
 		const check = document.getElementById("dgftPrintSummary");
 		if(!check){
 			const div = document.createElement("div");
 			div.style.display = "none";
 			div.setAttribute("id","dgftPrintSummary");
 			document.body.append(div);
 		}
 		ajax.request(url,{"summaryjson":json},"dgftPrintSummary",callback);
 	}
 	catch(error) {
 	  console.error(error);
 	}
 }
 
$(document).on('click','.product-guide-btn',function(){
	window.location.href = getContextPath() + '/apps/product-guide';
});
$(document).on('click','.free-trade-agree-btn',function(){
	window.location.href = getContextPath() + '/apps/free-trade-agreements';
});
$(document).on('click','.country-guide-btn',function(){
	window.location.href = getContextPath() + '/apps/country-guide';
});
$(document).on('click','.exim-pathshala-btn',function(){
	window.location.href = getContextPath() + '/apps/exim-paathshaala';
});
	
	
$(document).on('focusin', ".custom-datepicker-past-four-month", function() {
		
		$(".custom-datepicker-past-four-month").datepicker({
			format : "dd/mm/yyyy",
	        startDate : '-4m',
			endDate : '+0d',
			autoclose : true
		});
	});
	

	$(document).on('blur', ".alphanumhyphen", function() {
		$(this).next(".error-msg").remove();
		var inputVal = $(this).val();
		
		var alphaNumericReg = /^[A-Za-z0-9&\-\s]*$/;
		if (!alphaNumericReg.test(inputVal)) {
			$(this).val("");
			$(this).after('<span class="error-msg">Only Alphanumeric values, & and - are allowed.</span>');
		} else {
			$(this).next(".error-msg").remove();
		}
	});
 
	

	function getTimeAgo(date){
			let now = new Date();
		    let past = new Date(date);
		    let diffInSeconds = Math.floor((now - past) / 1000);
		 
		    if (diffInSeconds < 0) return "Invalid date"; // Future date handling
		 
		    let minutes = Math.floor(diffInSeconds / 60);
		    let hours = Math.floor(diffInSeconds / 3600);
		    let days = Math.floor(diffInSeconds / 86400);
		    let weeks = Math.floor(days / 7);
		    let months = Math.floor(days / 30);
		    let years = Math.floor(days / 365);
		 
		    if (diffInSeconds < 60) return "Just now";
		    if (minutes < 60) return minutes + (minutes === 1 ? " minute ago" : " minutes ago");
		    if (hours < 24) return hours + (hours === 1 ? " hour ago" : " hours ago");
		    if (days < 7) return days + (days === 1 ? " day ago" : " days ago");
		    if (weeks < 4) return weeks + (weeks === 1 ? " week ago" : " weeks ago");
		    if (months < 12) return months + (months === 1 ? " month ago" : " months ago");
		    return years + (years === 1 ? " year ago" : " years ago");
		
	}
	