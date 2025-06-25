var AesUtil = function(keySize, iterationCount) {
	this.keySize = keySize / 32;
	this.iterationCount = iterationCount;
};

AesUtil.prototype.generateKey = function(salt, passPhrase) {
	var key = CryptoJS.PBKDF2(passPhrase, CryptoJS.enc.Hex.parse(salt), {
		keySize : this.keySize,
		iterations : this.iterationCount
	});
	return key;
}

AesUtil.prototype.encrypt = function(salt, iv, passPhrase, plainText) {
	var key = this.generateKey(salt, passPhrase);
	var encrypted = CryptoJS.AES.encrypt(plainText, key, {
		iv : CryptoJS.enc.Hex.parse(iv)
	});
	return encrypted.ciphertext.toString(CryptoJS.enc.Base64);
}

AesUtil.prototype.decrypt = function(salt, iv, passPhrase, cipherText) {
	var key = this.generateKey(salt, passPhrase);
	var cipherParams = CryptoJS.lib.CipherParams.create({
		ciphertext : CryptoJS.enc.Base64.parse(cipherText)
	});
	var decrypted = CryptoJS.AES.decrypt(cipherParams, key, {
		iv : CryptoJS.enc.Hex.parse(iv)
	});
	return decrypted.toString(CryptoJS.enc.Utf8);
}

function encryptedPasword(control,saltValue)
{
	var iterationCount = 1000;
	var keySize = 128;
	var iv = "4d67fd8ee80132c6115e39880b08165d";
	var salt = "2df6bf74cb133595";
	if (saltValue!=null && saltValue!='') {
		console.log(saltValue);
		salt=saltValue;
	}
	var passphrase = "tcs@1234";
	  /*var iterationCount = '<%=ResourceBundleUtil.getConstant("AES_ITERATION")%>';
	  console.log("Check count"+iterationCount);
	  var keySize = '<%=ResourceBundleUtil.getConstant("AES_KEYSIZE")%>';
	  //alert(keySize);
	  var iv = '<%=ResourceBundleUtil.getConstant("AES_IV")%>';
	  var salt = '<%=ResourceBundleUtil.getConstant("AES_SALT")%>';
      var passphrase = '<%=ResourceBundleUtil.getConstant("AES_PASSPHASE")%>';
        */
	  var password = control.value;
	  if(password!=null && password != '')
	  {
		  var aesUtil = new AesUtil(keySize, iterationCount);
		  var ciphertext = aesUtil.encrypt(salt, iv, passphrase, password);
		  if(ciphertext!=null && ciphertext!="")
		  {
			  control.value = ciphertext;  
			  return ciphertext;
		  }
	  }	  
}

function decryptPasword(control)
{
	var iterationCount = 1000;
	var keySize = 128;
	var iv = "4d67fd8ee80132c6115e39880b08165d";
	var salt = "2df6bf74cb133595";
	var passphrase = "tcs@1234";
	 
	  var ciphertext = control.value;
	  if(ciphertext!=null && ciphertext != '')
	  {
		  var aesUtil = new AesUtil(keySize, iterationCount);
		  var password = aesUtil.decrypt(salt, iv, passphrase, ciphertext);
		  if(password!=null && password!="")
		  {
			  control.value = password;  
			  return password;
		  }
	  }	  
}