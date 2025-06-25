let viewAttachment = (function(){
						let showAttachment = function(url){
							url =  'Upload?flag=iframeAttachView&filepath='+url;
							var tabOrWindow = window.open(url, '_blank');
							tabOrWindow.focus();
						}
						let displayAttachment = function(url){
							var tabOrWindow = window.open(url, '_blank');
							tabOrWindow.focus();
						}

						return {
							showAttachment : showAttachment,
							displayAttachment : displayAttachment
						};
					 })(); 


$(document).on("click","#viewAttach",function(e){
	e.preventDefault();
	
	var url = $(this).children().text();
	
	var tabOrWindow = window.open(url, '_blank');
								tabOrWindow.focus();


});

$(document).on("click",".viewAttach",function(e){
	e.preventDefault();
	
	var url = $(this).find("span").text();
	if(url != ""){
		var tabOrWindow = window.open(url, '_blank');
			tabOrWindow.focus();
	}
	


});

