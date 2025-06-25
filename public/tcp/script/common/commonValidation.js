	/*function echeck(control, elementId) 
{
	var str = control.value;
	if (str.length > 0) 
	{
		var at = "@";
		var dot = ".";
		var lat = str.indexOf(at);
		var lstr = str.length;
		var len = str.length;
		if (str.lastIndexOf(dot) == len - 1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{    
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at) == -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at) == -1 || str.indexOf(at) === 0	|| str.indexOf(at) == lstr) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(dot) == -1 || str.indexOf(dot) === 0 || str.indexOf(dot) == lstr) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at, (lat + 1)) != -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.substring(lat - 1, lat) == dot	|| str.substring(lat + 1, lat + 2) == dot) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(dot, (lat + 2)) == -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(" ") != -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}

		var temp = str.substr(lat + 1, lstr);
		var dotoccu = temp.split(".").length - 1;
		var tmp2 = temp.split(".");
		if (dotoccu > 4) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		} 
		else 
		{
			var t = tmp2[0];
			var len = t.length;
			if (len > 15 || len <= 0) 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
				}
				control.focus();
				return false;
			} 
			else 
			{
				var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq";
				var value = "";
				var valid = true;
				for ( var j = 0; j < len; j++) 
				{
					if (iChars.indexOf(t.charAt(j)) != -1) 
					{
						value = value + t.charAt(j);
					} 
					else 
					{
						valid = false;
					}
				}
				if (!valid) 
				{
					if (elementId == undefined || elementId == 'undefined') {} 
					else 
					{
						document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
					}
					control.focus();
					return false;
				}
			}

			for ( var i = 1; i <= dotoccu; i++) 
			{

				var t = tmp2[i];
				var len = t.length;
				if (len > 15 || len <= 0) 
				{
					if (elementId == undefined || elementId == 'undefined') {} 
					else 
					{
						document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
					}
					control.focus();
					return false;
				} 
				else 
				{
					var iChars = "QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq";
					var value = "";
					var valid = true;
					for ( var j = 0; j < len; j++) 
					{
						if (iChars.indexOf(t.charAt(j)) != -1) 
						{
							value = value + t.charAt(j);
						} 
						else 
						{
							valid = false;
						}
					}
					if (!valid) 
					{
						if (elementId == undefined || elementId == 'undefined') {} 
						else 
						{
							document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
						}
						control.focus();
						return false;
					}
				}
			
			}
		}
		var arr = new Array();
		arr = str.split("@");
		for ( var i = 0; i < 2; i++) 
		{
			var temp1 = arr[i];
			iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq.-_+";
			var value = "";
			var valid = true;

			for ( var o = 0; o < temp1.length; o++) 
			{
				if (iChars.indexOf(temp1.charAt(o)) != -1) 
				{
					value = value + temp1.charAt(o);
				} 
				else 
				{
					valid = false;
				}
			}
			if (!valid) 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
				}
				control.focus();
				return false;
			}
		}
		if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}*/

function echeck(control, elementId)
{
	if(control.value == '')
	{
		return true;
	}
	var email_pattern = /^(?!.*--)(?!.*\+\+)[_A-Za-z0-9\-+]+((\.(?![_\-+])(?!.*\.\.)(?!.*--)(?!.*\+\+)[_A-Za-z0-9\-+]+)+)*@((?!-)(?!.*--)[A-Za-z0-9-]+(?!-))+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/;
    var result = email_pattern.test(control.value);
    if(result)
    {
    	if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
    }
    else
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
		}
    	/*control.focus();*/
    }
	return result;
}

function onlyAlphabatesForNames(control, elementId) 
{
	var iChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var value = "";
	var valid = true;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Only Alphabets are allowed without spaces';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}
// By Pratik
function MarathiAlphabatenumariconly(control, event) 
{
	var unicode = event.charCode ? event.charCode : event.keyCode;
	// jAlert("unicode:-"+unicode);
	if ((unicode >= 96 && unicode <= 105) || (unicode >= 65 && unicode <= 90) || unicode >= 192) 
	{
		var len = control.value.length;

		// jAlert("Text Area Length....***" +len);
		// jAlert("enter only numaric value....***");
		return true;
	} 
	else 
	{
		if (unicode == 13 || unicode == 222 	|| 
			(unicode >= 48 && unicode <= 57)	|| 
			(unicode >= 32 && unicode <= 47)	|| 
			(unicode >= 186 && unicode <= 191) 	|| 
			(unicode >= 219 && unicode <= 222)	|| 
			(unicode >= 106 && unicode <= 111)) 
		{
			// jAlert("In Else for Length...");
			len2 = control.value.length;
			// jAlert("Text in value Length....***" +len2);
			// jAlert("unicode in Else part -->>>"+unicode);
			// jAlert("Special Character are not allowed");
			var Txtval = control.value;

			Txtval = Txtval.substr(0, len2 - 1);
			// jAlert("====>>>>>> "+Txtval);
			control.value = Txtval;
			// jjAlert(control.value,"Alert");
			return false;
		} 
		else 
		{
			// jAlert("IN else...");
			// control.value="";
			return false;
		}
	}
	return true;
}

function MarathiAlphabateonly(control, event) 
{
	var unicode = event.charCode ? event.charCode : event.keyCode;
	if ((unicode >= 65 && unicode <= 90) || unicode >= 192) 
	{
		var len = control.value.length;
		return true;
	} 
	else 
	{
		if (unicode == 13 || unicode == 222
				|| (unicode >= 96 && unicode <= 105)
				|| (unicode >= 48 && unicode <= 57)
				|| (unicode >= 32 && unicode <= 47)
				|| (unicode >= 186 && unicode <= 191)
				|| (unicode >= 219 && unicode <= 222)
				|| (unicode >= 106 && unicode <= 111)) 
		{
			len2 = control.value.length;
			var Txtval = control.value;
			Txtval = Txtval.substr(0, len2 - 1);
			control.value = Txtval;
			return false;
		} 
		else 
		{
			return false;
		}
	}
	return true;
}

function disableCountryState(Counter)
{
	document.getElementById("cmb_" + Counter + "_Country").disabled = true;
	document.getElementById("cmb_" + Counter + "_State").disabled = true;
}

function Marathiforonlynumber(control, event) 
{

	var unicode = event.charCode ? event.charCode : event.keyCode
	// jAlert("Unicode --- >"+unicode);
	if ((unicode >= 48 && unicode <= 57) || (unicode >= 96 && unicode <= 105)) 
	{
		// var lenno=control.value.length;
		return true;
	} 
	else 
	{
		if ((unicode >= 65 && unicode <= 90)
				|| (unicode >= 32 && unicode <= 47) || unicode == 16
				|| unicode == 13 || (unicode >= 186 && unicode <= 192)
				|| (unicode >= 219 && unicode <= 222)
				|| (unicode >= 106 && unicode <= 111)) 
		{
			jAlert("Enter only Numaric value", "Alert", function(r) {	if (r == true) {	control.value = "";		/*control.focus();*/	}});
			return true;
		} 
		else 
		{
			return false;
		}
	}
	return true;
}
//

function OnlyAplha(control, elementId) 
{
	var iChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
	var value = "";
	var valid = true;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else
			valid = false;
	}

	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined')	{} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Only alphabets are allowed';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function onlyRupeesCheck(control, elementId) 
{
	// jAlert("Inside onlyRsNumbers' );
	var iChars = "1234567890.";
	var value = "";
	var decimalCnt = 0;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			if (control.value.charAt(i) == ".") 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Decimal Numbers are not allowed'	+ '<br>';
				}
				/*control.focus();*/
				return false;
			} 
			else 
			{
				value = value + control.value.charAt(i);
			}
		} 
		else 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Alphabets and special characters are not allowed';
			}
			/*control.focus();*/
			return false;
		}
	}
	return true;
}

function onlyNumbers(control, elementId) 
{
	var iChars = "1234567890";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Only numbers are allowed';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function onlyAlphaNumeric(control, elementId) 
{
	// Added by Deepika for UID application
	/*
	 * if(window.parent.checkLangForUIDApp) {
	 * if(control!=document.getElementById("eleCodeNo") &&
	 * document.forms[0].rdoLang[1].checked==true) { return false; } }
	 */
	// Ended by Deepika for UID application
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/,.-_ ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == ' ' 
			|| control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == '_'
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '&'
			|| control.value.charAt(0) == '=') 
		{
			valid = false;
			break;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Special characters are not allowed';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function NospecialChar(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Special characters are not allowed';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function remove(control) 
{
	var who = document.getElementsByName(control)[0];
	var who2 = who.cloneNode(false);
	who2.onchange = who.onchange;
	who.parentNode.replaceChild(who2, who);
}

function setMaxLength(control, maxlen, elementId) 
{
	if (control.value.length > maxlen) 
	{
		control.value = control.value.substring(0, maxlen);
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "You can enter maximum " + maxlen + " character in this field";
		}
		/*control.focus();*/
		return false;
	}
	return true;
}

// Added by satwik for validate password
function passwordCheck(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/\,.-_@!#$%^*()";// These
	// Characters
	// are
	// allowed
	// for
	// textbox.

	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Special characters like ` = \' " + % and Space are not allowed.'	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}
// Added by satwik for validate password Ended

// Added by satwik for minimum and maximum character checks
function setMinNMaxLength(control, minlen, maxlen, fieldname, elementId) 
{
	if (control.value != "") 
	{
		if (control.value.length > maxlen || control.value.length < minlen) 
		{
			control.value = control.value.substring(0, maxlen);
			if (elementId == undefined || elementId == 'undefined')	{} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Please enter ' + fieldname + ' between '	+ minlen + ' to ' + maxlen + ' Characters';
			}
			/*control.focus();*/
			return false;
		}
		else if(control.value.length)
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = '';
			}
			return true;
		}
	}
}
// Added by satwik for minimum and maximum character checks Ended
function disableCtrlKeyCombination(e, elementId) 
{
	// list all CTRL + key combinations you want to disable
	var forbiddenKeys = new Array('a', 'n', 'c', 'x', 'v', 'j');
	var key;
	var isCtrl;

	if (window.event) 
	{
		key = window.event.keyCode; // IE
		if (window.event.ctrlKey)
			isCtrl = true;
		else
			isCtrl = false;
	} 
	else 
	{
		key = e.which; // firefox
		if (e.ctrlKey)
			isCtrl = true;
		else
			isCtrl = false;
	}

	// if ctrl is pressed check if other key is in forbidenKeys array
	if (isCtrl) 
	{
		var len = forbiddenKeys.length;
		for (i = 0; i < len; i++) 
		{
			// case-insensitive comparation
			if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Ctrl + '+ String.fromCharCode(key) + ' has been disabled.';
				}
				/*control.focus();*/
				return false;
			}
		}
	}
	return true;
}

function checkLengthofPincode(control, elementId) 
{
	lStrlength = control.value;
	if (control.value != "") 
	{
		if (onlyNumbers(control)) 
		{
			if (lStrlength.length < 6) 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Invalid pincode'	+ '<br>';
				}
				/*control.focus();*/
				return false;
			} 
			else if (lStrlength.charAt(0) != '4') 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Pincode number should start with digit 4';
				}
				/*control.focus();*/
				return false;
			}
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function onlyFloat(control, roundFlg, elementId) 
{
	var iChars = "1234567890.";
	var value = "";
	var valid = true;

	if (roundFlg && ((control.value).split(".").length - 1) > 1) 
	{
		if (elementId == undefined || elementId == 'undefined')	{} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Please enter correct amount'	+ '<br>';
		}
		control.value = "0";
		/*control.focus();*/
		return false;
	}

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
			break;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Alphabets and special characters are not allowed';
		}
		control.value = "0";
		/*control.focus();*/
		return false;
	}
	else if(control.value.length)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}

	var fnlAmount = roundNumber(control.value, 2);
	control.value = fnlAmount;
	// jAlert(fnlAmount)
}

function roundNumber(num, dec) 
{
	var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
	return result;
}

function initialCap(control) 
{
	// jAlert(control.value);
	control.value = control.value.substr(0, 1).toUpperCase() + control.value.substr(1);
}

function Capital(value) 
{
	if (value != "") 
	{
		var firstLetter = value.substring(0, 1).toUpperCase();
		var resetOfWord = value.substring(1, value.length).toLowerCase();
		value = firstLetter + resetOfWord;
	}
	return value;
}

function checkSpecialChar(e) 
{
	var key;
	var keychar;

	if (e)
		key = e.keyCode;
	else if (e)
		key = e.which;
	else
		return true;

	keychar = String.fromCharCode(key);
	// jAlert("keychar: '+keychar);

	// var iChars = "`[]&_-=$#:;,@!*?%~(){}<>/^\\\'|\"+";
	var iChars = "`&_$;@*%~{}<>^'|%+";

	if (iChars.indexOf(keychar) != -1) 
	{
		return false;
	}

	return true;
}

function compareWithExistingLicenseNo(control, licNoListObj, elementId) 
{
	for (i = 0; i < licNoListObj.length; i++) 
	{
		if (licNoListObj.options[i].text == control.value) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Please Enter License No which does not Exist in the System'	+ '<br>';
			}
			/*control.focus();*/
			return false;
		}
	}
	return true;
}

function alphaNumericSpecialCharacter(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/\,._@$%^*(){}[];:  ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		control.value = control.value.substring(0, control.value.length - 1);
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Special characters  like <,>,#,-,! are not allowed.'	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function setTabIndexForCompleteForm(bodyElement, tabindex, form) 
{
	var allChildren = form.elements;
	var i = 0;
	var strNames = '';

	for (i = 0; i < allChildren.length; i++) 
	{
		var node = allChildren[i];
		if (node.tagName
			&& node.tagName != ''
			&& (node.tagName == 'INPUT' || node.tagName == 'SELECT'
			|| node.tagName == 'TEXTAREA' || node.tagName == 'A' || node.tagName == 'IMG')) 
		{
			node.tabIndex = parseInt(tabindex);
			tabindex = parseInt(tabindex) + 1;

		}

	}
	return tabindex;
}

function setTabIndexForForm(bodyElement, tabindex) 
{
	var allChildren = bodyElement.children;
	var i = 0;
	var strNames = ''
	for (i = 0; i < allChildren.length; i++) 
	{
		var node = allChildren[i];
		if (node.tagName
			&& node.tagName != ''
			&& (node.tagName == 'INPUT' || node.tagName == 'SELECT'
			|| node.tagName == 'TEXTAREA' || node.tagName == 'A' || node.tagName == 'IMG')) 
		{
			node.tabIndex = parseInt(tabindex);
			tabindex = parseInt(tabindex) + 1;
		}
		tabindex = setTabIndexForForm(node, tabindex);
	}
	return tabindex;
}

function OnlyAlphawithSpace(control, elementId) 
{
	var iChars = "1234567890";
	var value = "";
	var valid = true;
	if (control.value.length > 0 && control.value != "") 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;

			} 
			else 
			{
				valid = false;

			}
		}

		if (valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = document.getElementById("OnlyAlphawithSpace").value;
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function OnlySpacenotallowed(control, elementId) 
{
	var iChars = " ";
	var value = "";
	var valid = true;
	if (control.value.length > 0 && control.value != " ") 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;
			} 
			else 
			{
				valid = false;
			}
		}
		if (!valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Space is not allowed.";
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else {
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function deleteFormField(control) 
{
	if (control)
	{
		control.parentNode.removeChild(control);
	}
}

function calculateAge(control,compareToDate) 
{
	var age = -1;
	if (control) 
	{
	    if(compareToDate == undefined || compareToDate == 'undefined'){
	        compareToDate=document.getElementById("serverDate");
        }
	    
		if (control.value != '') 
		{
		   if (compareToDate) 
			{
				var enteredDate = control.value;
				var sp = "/";
				var sp1;
				var sp2;

				sp1 = enteredDate.indexOf("/", 0);
				sp2 = enteredDate.indexOf("/", parseInt(sp1) + 1);
				var enteredDay = enteredDate.substring(0, parseInt(sp1));
				var enteredMonth = enteredDate.substring(parseInt(sp1) + 1,	parseInt(sp2));
				var enteredYear = enteredDate.substring(parseInt(sp2) + 1, enteredDate.length);
				var bday = parseInt(enteredDay);
				// var bmo=(parseInt(enteredMonth));
				var bmo = enteredMonth - 1;
				var byr = parseInt(enteredYear);

				var serverDate = compareToDate.value;
				sp1 = serverDate.indexOf("/", 0);
				sp2 = serverDate.indexOf("/", parseInt(sp1) + 1);
				var serverDay = serverDate.substring(0, parseInt(sp1));
				var serverMonth = serverDate.substring(parseInt(sp1) + 1, parseInt(sp2));
				var serverYear = serverDate.substring(parseInt(sp2) + 1, serverDate.length);
				var tday = parseInt(serverDay);
				// var tmo=(parseInt(serverMonth));
				var tmo = serverMonth - 1;
				var tyr = parseInt(serverYear);

				// jAlert("serverDay::"+serverDay+"serverMonth::"+serverMonth+"serverYear::"+serverYear);

				// jAlert("tmo::"+tmo+"tyr::"+tyr);
				// jAlert("bmo::"+bmo+"byr::"+byr);

				if ((tmo > bmo) || (tmo == bmo & tday >= bday)) 
				{
					age = tyr - byr;
				} 
				else 
				{
					age = tyr - byr - 1;
				}
			}
		}
	}
	return age;
}

function calculateAge1(dob) 
{
	var age = -1;

	if (document.getElementById("serverDate")) 
	{
		var enteredDate = dob;
		var sp = "/";
		var sp1;
		var sp2;

		sp1 = enteredDate.indexOf("/", 0);
		sp2 = enteredDate.indexOf("/", parseInt(sp1) + 1);
		var enteredDay = enteredDate.substring(0, parseInt(sp1));
		var enteredMonth = enteredDate.substring(parseInt(sp1) + 1,parseInt(sp2));
		var enteredYear = enteredDate.substring(parseInt(sp2) + 1,enteredDate.length);
		var bday = parseInt(enteredDay);
		var bmo = (parseInt(enteredMonth) - 1);
		var byr = parseInt(enteredYear);

		var serverDate = document.getElementById("serverDate").value;
		sp1 = serverDate.indexOf("/", 0);
		sp2 = serverDate.indexOf("/", parseInt(sp1) + 1);
		var serverDay = serverDate.substring(0, parseInt(sp1));
		var serverMonth = serverDate.substring(parseInt(sp1) + 1, parseInt(sp2));
		var serverYear = serverDate.substring(parseInt(sp2) + 1, serverDate.length);
		var tday = parseInt(serverDay);
		var tmo = (parseInt(serverMonth) - 1);
		var tyr = parseInt(serverYear);

		if ((tmo > bmo) || (tmo == bmo & tday >= bday)) 
		{
			age = tyr - byr;
		} 
		else 
		{
			age = tyr - byr - 1;
		}
	}
	return age;
}

function onlyAlphaNumericWithSpaces(control, elementId) 
{
	var iChars = "!#^*()-:,./?[]`&_$;@\*%~{}<>^'|%+";
	var value = "";
	var valid = true;
	if (control.value.length > 0) 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (control.value.charAt(0) == ' ') 
			{
				valid = true;
				break;
			}
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;
			} 
			else 
			{
				valid = false;
			}
		}
		if (valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters are not allowed"	+ '<br>';
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
	if (elementId == undefined || elementId == 'undefined') {} 
	else 
	{
		document.getElementById(elementId.id).innerHTML = '';
	}
	return true;
}
// Added by Deepika for pincode validation of all states
function chkLenOfPincodeForAllStates(control, state, elementId) 
{
	var stateValue = document.getElementById(state).value;
	// jAlert(stateValue);
	lStrlength = control.value;
	if (control.value != "") 
	{
		if (onlyNumbers(control)) 
		{
			if (lStrlength.charAt(0) == '0') 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = "Pincode number must not start with 0";
				}
				/*control.focus();*/
				return false;
			}
			if (lStrlength.length < 6) 
			{
				if (elementId == undefined || elementId == 'undefined')	{} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = document.getElementById("InvalidPin").value;
				}
				/*control.focus();*/
				return false;
			} 
			else if (stateValue == 35 && lStrlength.charAt(0) != '4') 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = document.getElementById("PincodeWithFrAlert").value;
				}
				/*control.focus();*/
				return false;
			}
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}
// Added by satwik for valid Mobile
function isNumber(val) 
{
	var len, str, str1, i;
	len = val.length;
	str = val;
	str1 = "0123456789";
	for (i = 0; i < len; i++) 
	{
		if ((str1.indexOf(str.charAt(i))) == -1) 
		{
			return false;
		}
	}
	return true;
}

function isMobvalid(control, elementId) 
{
	var mob = control.value;
	if (!isNumber(mob)) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Please enter numeric values only";
		}
		/*control.focus();*/
		return false;
	}
	if (mob.length < 10 && mob.length != '') 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Mobile number must be 10 digits long";
		}
		/*control.focus();*/
		return false;
	}
	if (mob.charAt(0) == '0') 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Mobile number must not start with 0"	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	if(mob.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// Added by Deepika for validation on username
/*function onlyForUserName(control, elementId) 
{
	
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq.-_@+";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		// jAlert(control.value.charAt(i));
		if (i == 0 && 
			(control.value.charAt(i) == '.'	|| control.value.charAt(i) == '-' || control.value.charAt(i) == '_')) 
		{
			valid = false;
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "1st charater cannot be special charater";
			}
			control.focus();
			return false;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Allowed special characters are . - _ + and @";
		}
		control.focus();
		return false;
	} 
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}*/

function onlyForUserName(control, elementId)
{
	if(control.value == '')
	{
		return true;
	}
	
	var username_pattern = /^(?!.*--)(?!.*\+\+)(?!.*\.\.)(?!.*@@)[A-Za-z0-9_@.\-+]*$/;
    var result = username_pattern.test(control.value);
    if(result)
    {
    	if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
    }
    else
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Allowed special characters are . - _ + and @. Repeated special characters are not allowed eg., @@';
		}
    	/*control.focus();*/
    }
	return result;
}

function disableFormButtons(control) 
{
	if (control) 
	{
		var allInputElements = control.getElementsByTagName("input");
		for ( var j = 0; j < allInputElements.length; j++) 
		{
			if (allInputElements[j].type == "button" || allInputElements[j].type == "reset") 
			{
				allInputElements[j].disabled = true;
			}
		}
	}
}

function enableFormButtons(control) 
{
	if (control) 
	{
		var allInputElements = control.getElementsByTagName("input");
		for ( var j = 0; j < allInputElements.length; j++) 
		{
			if (allInputElements[j].type == "button" || allInputElements[j].type == "reset") 
			{
				allInputElements[j].disabled = false;
			}
		}
	}
}

function populateOnBlurDetails(control) 
{
	if (control != null) 
	{
		if (navigator.appName == 'Microsoft Internet Explorer') 
		{
			control.fireEvent("onblur");
		} 
		else 
		{
			var evObj = document.createEvent('HTMLEvents');
			evObj.initEvent("blur", true, true);
			control.dispatchEvent(evObj);
		}
	}
}

function populateOnChangeDetails(control) 
{
	if (control != null) 
	{
		if (navigator.appName == 'Microsoft Internet Explorer') 
		{
			control.fireEvent("onchange");
		} 
		else 
		{
			var evObj = document.createEvent('HTMLEvents');
			evObj.initEvent("change", true, true);
			control.dispatchEvent(evObj);
		}
	}
}

function onlyAlphaNumericWithOutSpaces(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = document.getElementById("SpecialCharAndSpaceAlert").value	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// Added by Deepika for Marathi typing
function onlyAlphaNumericMarathiWithOutSpace(control, elementId) 
{
	var iChars = "!#^*()-:,./?[]`&_$;@\*%~{}<>^'|%+ \"";
	var value = "";
	var valid = true;
	if (control.value.length > 0) 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;
			} 
			else 
			{
				valid = false;
			}
		}
		if (valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters are not allowed"	+ '<br>';
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function onlyAlphaNumericMarathi(control, elementId) 
{
	var iChars = "!#^*()-:,./?[]`&_$;@\*%~{}<>^'|%+\"";
	var value = "";
	var valid = true;
	if (control.value.length > 0) 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;
			} 
			else 
			{
				valid = false;
			}
		}
		if (valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters are not allowed";
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}
// Ended by Deepika for Marathi typing

// Added by Sangeeta for Special characters in marathi
function onlyAlphaNumericMarathiForAddress(control, elementId) 
{
	var iChars = "!#^*():?[]`$;@\*%~{}<>^'|%+\"";
	var value = "";
	var valid = true;
	if (control.value.length > 0) 
	{
		for ( var i = 0; i < control.value.length; i++) 
		{
			if (control.value.charAt(0) == ' '
				|| control.value.charAt(0) == ','
				|| control.value.charAt(0) == '.'
				|| control.value.charAt(0) == '/'
				|| control.value.charAt(0) == '_'
				|| control.value.charAt(0) == '-'
				|| control.value.charAt(0) == '&'
				|| control.value.charAt(0) == '=') 
			{
				valid = true;
				break;
			}
			if (iChars.indexOf(control.value.charAt(i)) != -1) 
			{
				value = value + control.value.charAt(i);
				valid = true;
				break;
			} 
			else 
			{
				valid = false;
			}
		}
		if (valid) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters are not allowed";
			}
			/*control.focus();*/
			return false;
		}
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// Ended by Sangeeta for Special characters in marathi
function addLoadEvent(func) 
{
	var oldonload = window.onload;
	if (typeof window.onload != 'function') 
	{
		window.onload = func;
	} 
	else 
	{
		window.onload = function() 
		{
			if (oldonload) 
			{
				oldonload();
			}
			func();
		}
	}
}

function addEvent(obj, evType, fn, useCapture) 
{
	if (obj.addEventListener) 
	{
		obj.addEventListener(evType, fn, useCapture);
	} 
	else if (obj.attachEvent) 
	{
		var r = obj.attachEvent("on" + evType, fn);
	} 
	else 
	{
		var origEventHandler = obj['on' + evType];
		obj['on' + evType] = function() 
		{
			if (typeof origEventHandler == 'function') 
			{
				origEventHandler();
			}
			fn();
		}
	}
}
// Added by Rasika to check ,Numbers field can not be set with all 0

function chkNotAllZero(control, elementId) 
{
	var iCharsOnlyZero = "0";
	var onlyZero = "true";

	for ( var j = 0; j < control.value.length; j++) 
	{
		if (iCharsOnlyZero.indexOf(control.value.charAt(j)) == -1) 
		{
			onlyZero = false;
			break;
		} 
		else 
		{
			onlyZero = true;
		}
	}

	if (onlyZero) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = document.getElementById("allZeroNotAllowed").value;
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// added by rucha for trim operations
function ltrim(str) 
{
	for ( var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
	return str.substring(k, str.length);
}

function rtrim(str) 
{
	for ( var j = str.length - 1; j >= 0 && isWhitespace(str.charAt(j)); j--);
	return str.substring(0, j + 1);
}

function trimText(control) 
{
	var str = control.value;
	control.value = ltrim(rtrim(str));
}

function isWhitespace(charToCheck) 
{
	var whitespaceChars = " \t\n\r\f";
	return (whitespaceChars.indexOf(charToCheck) != -1);
}

function onlyAlphaWithSpecialCharEducation(control, elementId) 
{
	var iChars = "QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/,.-_() ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == ' ' || control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == '_'
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '&'
			|| control.value.charAt(0) == '=') {
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special character or space  are not allowed as first character"	+ '<br>';
			}
			/*control.focus();*/
			return false;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Special characters are not allowed."	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function onlyAlphaNumericWithSpecCharComName(control, elementId) 
{
	var iChars = "0123456789QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/.-_ ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == ' ' 
			|| control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == '_'
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '&'
			|| control.value.charAt(0) == '='
			|| control.value.charAt(0) == '0'
			|| control.value.charAt(0) == '1'
			|| control.value.charAt(0) == '2'
			|| control.value.charAt(0) == '3'
			|| control.value.charAt(0) == '4'
			|| control.value.charAt(0) == '5'
			|| control.value.charAt(0) == '6'
			|| control.value.charAt(0) == '7'
			|| control.value.charAt(0) == '8'
			|| control.value.charAt(0) == '9') 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters or numbers are not allowed as first character";
			}
			/*control.focus();*/
			return false;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Special characters are not allowed."	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// For Address
function OnlyAplhaWithSpaceForCommonAddress(control, elementId) 
{
	var iChars = " ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	var value = "";
	var valid = true;

	if (control.value.charAt(0) == ' ') 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Space is not allowed as first character"	+ '<br>';
		}
		/*control.focus();*/
		return false;
	}

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}

	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {}
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Numbers and special characters are not allowed";
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}
// Added By Ketan For Phone Number and Fax Number Validation
function checkPhoneFaxCode(phonecode, areacode, countrycode, elementId) 
{
	var phoneno = document.getElementById(phonecode).value.length;
	var areacodelen = document.getElementById(areacode).value.length;
	var coucodelen = document.getElementById(countrycode).value.length;

	var total = phoneno + areacodelen;

	if (total != 10) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Invalid number"	+ '<br>';
		}
		/*phonecode.focus();*/
		return false;
	}

	if (!checkPhoneFaxCouCode(countrycode))
		return false;
	return true;
}

function checkPhoneFaxCouCode(countrycode, elementId) 
{
	var coucodelen = document.getElementById(countrycode).value.length;
	if (document.getElementById(countrycode).value == null	|| document.getElementById(countrycode).value == "") 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Please enter country code";
		}
		/*countrycode.focus();*/
		return false;
	}

	if (coucodelen < 1) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Invalid country code";
		}
		/*countrycode.focus();*/
		return false;
	}
	return true;
}

function checkPhoneFaxAreaCode(countrycode, areacode, phonecode, onSubmit,elementId) 
{
	var areacodelen = document.getElementById(areacode).value.length;
	if (areacodelen < 2) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Invalid area code";
		}
		/*countrycode.focus();*/
		return false;
	}

	if (onSubmit) 
	{
		if (!checkPhoneFaxCode(phonecode, areacode, countrycode))
			return false;
	} 
	else 
	{
		if (document.getElementById(phonecode).value != null && document.getElementById(phonecode).value != "") 
		{
			if (!checkPhoneFaxCode(phonecode, areacode, countrycode))
				return false;
		}
	}
	return true;
}
// Ended By Ketan For Phone Number and Fax Number Validation
function onlyAlphaWithDotSapce(control, elementId) 
{
	var iChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ";
	var value = "";
	var valid = true;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Only Alphabets are allowed with spaces and Dot";
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

function checkdate(input, elementId) 
{
	var validformat = /^\d{2}\/\d{2}\/\d{4}$/;// Basic check for format
	// validity
	var returnval = false;
	if (!validformat.test(input.value) && input.value != "") 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = document.getElementById("hdnCmnDateAlert").value;
		}
		/*input.focus();*/
		return false;
	} 
	else 
	{ // Detailed check for valid date ranges
		var monthfield = input.value.split("/")[1];
		var dayfield = input.value.split("/")[0];
		var yearfield = input.value.split("/")[2];
		var minyear = 1900;
		var dayobj = new Date(yearfield, monthfield - 1, dayfield);
		if (((dayobj.getMonth() + 1 != monthfield)
			|| (dayobj.getDate() != dayfield) || (dayobj.getFullYear() != yearfield)) && input.value != "") 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = document.getElementById("hdnCmnDDMMYYlert").value	+ '<br>';
			}
			/*input.focus();*/
			return false;
		} 
		else if (yearfield < minyear) 
		{// added by sunitha 20-12-2011
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = document.getElementById("hdn_year").value	+ '<br>';
			}
			return false;
		}// ended by sunitha
		else 
		{
			returnval = true;
		}
	}
	if (returnval == false)
		input.value = "";
	return returnval;
}

function onlyAlphaNumericWithHyphen(control,elementId) 
{     
    var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq- ";
    var value="";
    var valid=true;
             
    for (var i=0; i<control.value.length;i++) 
    {
    	if(control.value.charAt(0)==' ' || control.value.charAt(0)==',' || control.value.charAt(0)=='.' || control.value.charAt(0)=='/' || control.value.charAt(0)=='_' || control.value.charAt(0)=='-' || control.value.charAt(0)=='&' || control.value.charAt(0)=='=' )
    	{
    		valid=false;
    		break;
    	}
    	if (iChars.indexOf(control.value.charAt(i))!=-1) 
        {
    		value=value+control.value.charAt(i);
        }               
        else
        {                 
        	valid=false;
        }
    }                   
    if(!valid)
    {
    	if (elementId == undefined || elementId == 'undefined') {
    		
    		document.getElementById(elementId.id).innerHTML='Only alphanumeric allowed with Hyphen';
    	} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='Only alphanumeric allowed with Hyphen';
		}
    	/*control.focus();*/
        return false;
    }
    else if(control.value.length>0)
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='';
		}
	    return true;
    }
}


function NospecialCharWithoutSpace(control,elementId) 
{         
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq";
	var value="";
	var valid=true;
              
	for (var i=0; i<control.value.length;i++) 
	{              
		if (iChars.indexOf(control.value.charAt(i))!=-1) 
		{
			value=value+control.value.charAt(i);
		}               
		else
		{                 
			valid=false;
		}
	}                   
	if(!valid)
	{              
		document.getElementById(elementId.id).innerHTML='Special characters are not allowed';
		/*control.focus();*/
		return false;
	}
	else if(control.value.length>0)
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='';
		}
	    return true;
    }             
}

function checkMobileNo(control,elementId)
{
	var iChars = "1234567890+-/ ";
	var value="";
	var valid=true;
	for (var i=0; i<control.value.length;i++) 
    {
		if (iChars.indexOf(control.value.charAt(i))!=-1) 
		{
			value=value+control.value.charAt(i);
		}               
		else
		{                 
			valid=false;
		}
    }
	if(!valid)
	{         
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='Invalid Mobile No.';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length>0)
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='';
		}
	    return true;
    }  
}

function checkLandlineNo(control,elementId)
{
	var iChars = "1234567890+-/ ";
	var value="";
	var valid=true;
	for (var i=0; i<control.value.length;i++) 
    {
		if (iChars.indexOf(control.value.charAt(i))!=-1) 
		{
			value=value+control.value.charAt(i);
		}               
		else
		{                 
			valid=false;
		}
    }
	if(!valid)
	{         
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='Invalid Landline No.';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length>0)
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML='';
		}
	    return true;
    }  
}
//Added by Himansh for preventing cross site script and sql injection
function fn_isCrossSiteScript(input)
{
	if (fn_checkForCSS(input.value) || fn_sqlInjection(input.value))
    {
        return false;
    }
    return true;
}

/*
	$(document).on('blur','input',function(){
		$(this).next(".error-msg").remove();
		var dataInput = $(this).val();
		if (fn_checkForCSS(dataInput) || fn_sqlInjection(dataInput))
	    {
			$(this).after('<span class="error-msg">#,% and -- are not allowed</span>');
			$(this).val("");
			return false;    
	    }
	    return true;
	});
*/
function fn_checkForCSS(input)
{
	var regexpforHTMLTag1 = new RegExp("(<|&#60|u003C)\\s*(\\S+)\\s*[^>]*\\s*(>|&#62|u003E)(.*)(<|&#60|u003C)\\/\\s*\\2\\s*(>|&#62|u003E)","gi");
	var regexpforHTMLTag2 = new RegExp("([%])|(<|&#60|u003C)\\s*(\\S+)\\s*([^>]*)\\s*(>|&#62|u003E)","gi");
	var regexpforXMLTag = new RegExp("((<|&#60|u003C).[^(><.)]+(>|&#62|u003E))","gi");
	var regexpforEqualVal = new RegExp("(\\s*\\w+\\s*)=\\1","gi");
	var regexforContent = new RegExp("(.*)\\$\\{(.*)","gi");
	if(regexpforHTMLTag1.test(input) || regexpforHTMLTag2.test(input) || regexpforXMLTag.test(input) || regexpforEqualVal.test(input) || regexforContent.test(input))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function fn_sqlInjection(input)
{
	var regexpforMETACHAR1 = new RegExp("(--)|(%23)|(&#35)|(u0023)|(#)","gi");
	var regexpforMETACHAR2 = new RegExp("((%3D)|(&#61)|(u003D)|(=))[^\n]*((--)|(%3B)|(&#59)|(u003B)|(;))","gi");
	var regexpforORclause = new RegExp("\\w*((%27)|(&#32)|(u0027)|('))(\\s*)((%6F)|(&#111)|(u006F)|o|(%4F)|(&#79)|(u004F))((%72)|(&#114)|(u0072)|r|(%52)|(&#82)|(u0052))","gi");
	var regexpforSQLwords = new RegExp("((%27)|(&#32)|(u0027)|('))(\\s*)(union|select|insert|update|delete|drop)","gi");
	var regexpforMsSQL = new RegExp("exec(\\s|\\+)+(s|x)p\\w+","gi");

	if(regexpforMETACHAR1.test(input) || regexpforMETACHAR2.test(input) || regexpforORclause.test(input) || regexpforSQLwords.test(input) || regexpforMsSQL.test(input))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function onlyAlphabetWithSpace(control, elementId)
{
	var iChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
	var value = "";
	var valid = true;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Only Alphabets are allowed with spaces';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
	return valid;
	}

function onlyForCitizenName(control, elementId)
{
	var iChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-' ";
	var value = "";
	var valid = true;
	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Only alphabets and some special characters are allowed";
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
	return valid;
}
/*function multipleEmailcheck(control, elementId) 
{
	var str = control;
	if (str.length > 0) 
	{
		var at = "@";
		var dot = ".";
		var lat = str.indexOf(at);
		var lstr = str.length;
		var len = str.length;
		if (str.lastIndexOf(dot) == len - 1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at) == -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at) == -1 || str.indexOf(at) === 0	|| str.indexOf(at) == lstr) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(dot) == -1 || str.indexOf(dot) === 0 || str.indexOf(dot) == lstr) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(at, (lat + 1)) != -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.substring(lat - 1, lat) == dot	|| str.substring(lat + 1, lat + 2) == dot) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(dot, (lat + 2)) == -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}
		if (str.indexOf(" ") != -1) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		}

		var temp = str.substr(lat + 1, lstr);
		var dotoccu = temp.split(".").length - 1;
		var tmp2 = temp.split(".");
		if (dotoccu > 4) 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
			}
			control.focus();
			return false;
		} 
		else 
		{
			for ( var i = 1; i <= dotoccu; i++) 
			{
				var t = tmp2[i];
				var len = t.length;
				if (len > 6 || len <= 0) 
				{
					if (elementId == undefined || elementId == 'undefined') {} 
					else 
					{
						document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
					}
					control.focus();
					return false;
				} 
				else 
				{
					var iChars = "QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq";
					var value = "";
					var valid = true;
					for ( var j = 0; j < len; j++) 
					{
						if (iChars.indexOf(t.charAt(j)) != -1) 
						{
							value = value + t.charAt(j);
						} 
						else 
						{
							valid = false;
						}
					}
					if (!valid) 
					{
						if (elementId == undefined || elementId == 'undefined') {} 
						else 
						{
							document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
						}
						control.focus();
						return false;
					}
				}
			}
		}
		var arr = new Array();
		arr = str.split("@");
		for ( var i = 0; i < 2; i++) 
		{
			var temp1 = arr[i];
			iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq.-_";
			var value = "";
			var valid = true;

			for ( var o = 0; o < temp1.length; o++) 
			{
				if (iChars.indexOf(temp1.charAt(o)) != -1) 
				{
					value = value + temp1.charAt(o);
				} 
				else 
				{
					valid = false;
				}
			}
			if (!valid) 
			{
				if (elementId == undefined || elementId == 'undefined') {} 
				else 
				{
					document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
				}
				control.focus();
				return false;
			}
		}
		if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}*/

function multipleEmailcheck(control, elementId) 
{
	if(control == '')
	{
		return true;
	}
	var email_pattern = /^[_A-Za-z0-9-\\+]+(\.[_A-Za-z0-9-+]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/;
	var result = email_pattern.test(control);
	if(result)
	{
		if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
	}
	else
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid Email ID';
		}
	}
	return result;
}

function regexCheckForAddress(control, elementId) 
{
	var iChars = "0123456789QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/.-_ ,()'";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == ' ' 
			|| control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == '_'
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '&'
			|| control.value.charAt(0) == '='
			|| control.value.charAt(0) == '('
			|| control.value.charAt(0) == ')'
			|| control.value.charAt(0) == "'") 
		{
			if (elementId == undefined || elementId == 'undefined') {} 
			else 
			{
				document.getElementById(elementId.id).innerHTML = "Special characters or numbers are not allowed as first character";
			}
			//control.value = "";
			/*control.focus();*/
			return false;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = "Special characters are not allowed.";
		}
		//control.value = "";
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

// Added by Sukhpreet.....Generalized method
function validate_isCrossSiteScript(input,elementId)
{
	if (fn_checkForCSS(input.value) || fn_sqlInjection(input.value))
    {
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid input';
		}
        return false;
    }
	if (elementId == undefined || elementId == 'undefined') {} 
	else 
	{
		document.getElementById(elementId.id).innerHTML = '';
	}
    return true;
}

//Added by Abhilesh....Generalized method
function validateDate(control, elementId, datefunc)
{
	if(control.value == '')
	{
		return true;
	}
	var date_pattern = /^(((((0[1-9])|([1-9])|(1\d)|(2[0-8]))\/((0[1-9])|([1-9])|(1[0-2])))|((31\/((0[13578])|([13578])|(1[02])))|((29|30)\/((0[1,3-9])|([1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/((02)|(2))\/(19|20)(([02468][48])|([13579][26]))))|((29\/((02)|(2))\/(19|20)(([2468][048])|([13579][26]))))|(29\/((02)|(2))\/2000)$/;
    var result = date_pattern.test(control.value);
    if(result)
    {
    	if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
    	if (datefunc == undefined || datefunc == 'undefined') {} 
		else 
		{
			datefunc();
		}
    }
    else
    {
    	if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid date';
		}
    	/*control.focus();*/
    }
	return result;
}

//Added by Abhilesh....Generalized method
function alphaNumericWithSpecialChar(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/,.-()*?\"'$:\ ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == '&' 
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'			
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '('
			|| control.value.charAt(0) == ')'
			|| control.value.charAt(0) == '*'
			|| control.value.charAt(0) == '?'
			|| control.value.charAt(0) == '"'
			|| control.value.charAt(0) == '\''
			|| control.value.charAt(0) == '$'
			|| control.value.charAt(0) == ':'
			|| control.value.charAt(0) == '\\'
			|| control.value.charAt(0) == ' ') 
		{
			valid = false;
			break;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid input';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

//Added by Abhilesh....For NEC card number
function checkNecNumber(control, elementId) 
{
	var iChars = "1234567890";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Only numbers are allowed';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

//Added by Abhilesh....For Currency check
function currencyCheck(control, elementId)
{
	var regex = /^[0-9]+(\.[0-9]{0,2})*$/;
    var result = regex.test(control.value);
	if (result)
	{
		if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
	}
	else
	{
		if (elementId == undefined || elementId == 'undefined') {} else 
		{
			document.getElementById(elementId.id).innerHTML='Please enter valid Currency value';
		}
		
	}
}

//added  by Abhilesh for Maxlength check in ie9 for text area

function maxLengthCheck(control, elementId, len) {
	var lengthVal = $('#' + control.id).val().replace(/\r(?!\n)|\n(?!\r)/g,"\r\n").length;

	if (lengthVal > len) 
	{
		document.getElementById(elementId.id).innerHTML = 'Only '+ len + ' characters are allowed.';
 		/*control.focus();*/
		return false;
	}
	document.getElementById(elementId.id).innerHTML = '';
	return true;
}

   //Added by Riteeka....For Reference site
function alphaNumericWithSpecificChar(control, elementId) 
{
	var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/,.-=()*?\"'$:\ ";
	var value = "";
	var valid = true;

	for ( var i = 0; i < control.value.length; i++) 
	{
		if (control.value.charAt(0) == '&' 
			|| control.value.charAt(0) == '/'
			|| control.value.charAt(0) == ','
			|| control.value.charAt(0) == '.'			
			|| control.value.charAt(0) == '-'
			|| control.value.charAt(0) == '('
			|| control.value.charAt(0) == ')'
			|| control.value.charAt(0) == '*'
			|| control.value.charAt(0) == '?'
			|| control.value.charAt(0) == '"'
			|| control.value.charAt(0) == '\''
			|| control.value.charAt(0) == '$'
			|| control.value.charAt(0) == ':'
			|| control.value.charAt(0) == '\\'
			|| control.value.charAt(0) == '='
			|| control.value.charAt(0) == ' ') 
		{
			valid = false;
			break;
		}
		if (iChars.indexOf(control.value.charAt(i)) != -1) 
		{
			value = value + control.value.charAt(i);
		} 
		else 
		{
			valid = false;
		}
	}
	if (!valid) 
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = 'Invalid input';
		}
		/*control.focus();*/
		return false;
	}
	else if(control.value.length > 0)
	{
		if (elementId == undefined || elementId == 'undefined') {} 
		else 
		{
			document.getElementById(elementId.id).innerHTML = '';
		}
		return true;
	}
}

//Added by Abhilesh....For clearing values in given id
function clearForm(elementId) 
{
    var elements;
    if(elementId == undefined || elementId == 'undefined')
    {
        return;
    }
    else
    {
        elements = elementId.getElementsByTagName("*");
    }
     

    for(var i=0; i<elements.length; i++) 
    {
        field_type = elements[i].type;
    
        switch(field_type) 
        {
            case "text": 
            case "password": 
            case "textarea":
            case "hidden":   
            
                elements[i].value = ""; 
            break;
          
            case "radio":
            case "checkbox":
            if (elements[i].checked) 
            {
                elements[i].checked = false; 
            }
            break;

            case "select-one":
            case "select-multi":
                  elements[i].selectedIndex = -1;
            break;

            default: 
            break;
        }
    }   
}
function orgDescCheck(control,elementId)
{
    var iChars = " 0123456789QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&.,()'";
    var value = "";
    var valid = true;
    for ( var i = 0; i < control.value.length; i++) 
    {
        if (iChars.indexOf(control.value.charAt(i)) != -1) 
        {
            value = value + control.value.charAt(i);
        } 
        else
            valid = false;
    }

    if (!valid) 
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = 'Please enter valid Organisation';
        }
        /*control.focus();*/
        return false;
    }
    else if(control.value.length > 0)
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = '';
        }
        return true;
    }
}

//Added by Rizwan Malvat for only Alphabets With slash
function onlyAlphaWithSlash(control, elementId) 
{
    var iChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/";
    var value = "";
    var valid = true;
    for ( var i = 0; i < control.value.length; i++) 
    {
        if (iChars.indexOf(control.value.charAt(i)) != -1) 
        {
            value = value + control.value.charAt(i);
        } 
        else 
        {
            valid = false;
        }
    }
    if (!valid) 
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = "Only Alphabets are allowed with /";
        }
    
        return false;
    }
    else if(control.value.length > 0)
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = '';
        }
        return true;
    }
}       

//Added by Rizwan Malvat for validating IP Address
function ipAddressValidation(control,elementId) 
{
    var ary = control.value.split(".");
    var ip = true;
    var flag=true;
    for (var i=0 ; i<ary.length ; i++)
    { 
        ip = (!ary[i].match(/^\d{1,3}$/) || (Number(ary[i]) > 255)) ? false : ip; 
    }
    ip = (ary.length != 4) ? false : ip;
    if (!ip) 
    {
        document.getElementById(elementId.id).innerHTML='Please enter valid IP Address';
        flag=false;
    } 
    else 
    {
        document.getElementById(elementId.id).innerHTML="";
        flag=true;
    }
    return flag;
}

//Added by Archana
function alphaNumericAndSpecialChar(control,elementId)
{
    var iChars = " '&/,.-_\\:?=1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq()";
    var value = "";
    var valid = true;

    for ( var i = 0; i < control.value.length; i++) 
    {
        if (control.value.charAt(0) == '&' 
            || control.value.charAt(0) == '/'
            || control.value.charAt(0) == ','
            || control.value.charAt(0) == '.'           
            || control.value.charAt(0) == '-'
            || control.value.charAt(0) == '_'
            || control.value.charAt(0) == '\\'
            || control.value.charAt(0) == ':'
            || control.value.charAt(0) == '?'
            || control.value.charAt(0) == '='
            || control.value.charAt(0) == '('
            || control.value.charAt(0) == ')'
            || control.value.charAt(0) == ' ') 
        {
            valid = false;
            break;
        }
        if (iChars.indexOf(control.value.charAt(i)) != -1) 
        {
            value = value + control.value.charAt(i);
        } 
        else 
        {
            valid = false;
        }
    }
    if (!valid) 
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = 'Invalid input';
        }
        return false;
    }
    else if(control.value.length > 0)
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = '';
        }
        return true;
    }
}

//Added by Abhilesh
function alphaNumericWithSpecialCharacters(control, elementId) 
{
    var iChars = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNMmnbvcxzasdfghjklpoiuytrewq&/,.-_()*?\"'$:\ ";
    var value = "";
    var valid = true;

    for ( var i = 0; i < control.value.length; i++) 
    {
        if (control.value.charAt(0) == '&' 
            || control.value.charAt(0) == '/'
            || control.value.charAt(0) == ','
            || control.value.charAt(0) == '.'           
            || control.value.charAt(0) == '-'
            || control.value.charAt(0) == '_'
            || control.value.charAt(0) == '('
            || control.value.charAt(0) == ')'
            || control.value.charAt(0) == '*'
            || control.value.charAt(0) == '?'
            || control.value.charAt(0) == '"'
            || control.value.charAt(0) == '\''
            || control.value.charAt(0) == '$'
            || control.value.charAt(0) == ':'
            || control.value.charAt(0) == '\\'
            || control.value.charAt(0) == ' ') 
        {
            valid = false;
            break;
        }
        if (iChars.indexOf(control.value.charAt(i)) != -1) 
        {
            value = value + control.value.charAt(i);
        } 
        else 
        {
            valid = false;
        }
    }
    if (!valid) 
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = 'Invalid input';
        }
        /*control.focus();*/
        return false;
    }
    else if(control.value.length > 0)
    {
        if (elementId == undefined || elementId == 'undefined') {} 
        else 
        {
            document.getElementById(elementId.id).innerHTML = '';
        }
        return true;
    }
}

//Added by rinki for manage audit
function manageApplicationAudit(eventId,menuId)
{
var url ="webHP?requestType=ApplicationRH&actionVal=manageApplicationAudit&queryType=Select&screenId=200001&menuCode="+menuId+"&eventId="+eventId; 
callCommonAjax(url,fn_ResponseCommonAjax);
}

function fn_ResponseCommonAjax(response)
{
    
}
