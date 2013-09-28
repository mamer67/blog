function fileUpload(form, action_url, div_id) {
		// Create the iframe...
		var iframe = document.createElement("iframe");
		iframe.setAttribute("id", "upload_iframe");
		iframe.setAttribute("name", "upload_iframe");
		iframe.setAttribute("width", "0");
		iframe.setAttribute("height", "0");
		iframe.setAttribute("border", "0");
		iframe.setAttribute("style", "width: 0; height: 0; border: none;");
	 
		// Add to document...
		form.parentNode.appendChild(iframe);
		window.frames['upload_iframe'].name = "upload_iframe";
	 
		iframeId = document.getElementById("upload_iframe");
	 
		// Add event...
		var eventHandler = function () {
	 
				if (iframeId.detachEvent) iframeId.detachEvent("onload", eventHandler);
				else iframeId.removeEventListener("load", eventHandler, false);
	 
				// Message from server...
				if (iframeId.contentDocument) {
					content = iframeId.contentDocument.body.innerHTML;
				} else if (iframeId.contentWindow) {
					content = iframeId.contentWindow.document.body.innerHTML;
				} else if (iframeId.document) {
					content = iframeId.document.body.innerHTML;
				}
	 
				document.getElementById(div_id).innerHTML = content;
	 
				// Del the iframe...
				setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
			}
	 
		if (iframeId.addEventListener) iframeId.addEventListener("load", eventHandler, true);
		if (iframeId.attachEvent) iframeId.attachEvent("onload", eventHandler);
	 
		// Set properties of form...
		var prev_targ = form.getAttribute("target");
		form.setAttribute("target", "upload_iframe");
		
		var prev_url = form.getAttribute("action");
		form.setAttribute("action", action_url);
		
		var prev_meth = form.getAttribute("method");
		form.setAttribute("method", "post");
		
		var prev_enc = form.getAttribute("enctype");
		form.setAttribute("enctype", "multipart/form-data");
		
		var prev_encod = form.getAttribute("encoding");
		form.setAttribute("encoding", "multipart/form-data");
	 
		// Submit the form...
		form.submit();
		
		form.setAttribute("target", "_self");
		form.setAttribute("action", prev_url);
		form.setAttribute("method", prev_meth);
		form.setAttribute("enctype", prev_enc);
		form.setAttribute("encoding", prev_encod);
		
		document.getElementById(div_id).innerHTML = "Uploading...";
}

function send(){
	
	//var formData=$('#form');//remove [0]
	//alert(formData);
	$.ajax({
		url: "upload",
		type: "POST",
		fileElementId:'wupload',
		dataType: 'json',
		success:function(response){
			alert(response);
		},
		error:function(){ 
			alert("Error"); 
		}
	}) ;
}