var fPopupModalHandler = function (){
    
    var aStandardControls = document.querySelectorAll(".commentReply");

	var oOverlayComment = document.querySelector("#overlayCommentReply");

	var oHiddenField = document.querySelector('form input[name="commentID"]');
	console.log(oHiddenField);
	

	for(var iCount=0; iCount<aStandardControls.length;iCount++){

		var oControl = aStandardControls[iCount];
		oControl.onclick = function (){

			oOverlayComment.className = ""; // removes class (css properties) so it will appear

			oHiddenField.value = this.getAttribute("data-commentid");

			return false;

		};
	
	}

	    var oCloseButton = document.querySelector("#closePopup");
	    
	    oCloseButton.onclick = function (e){

				console.log(e.target);

				oOverlayComment.className = "hide";

			return false;

		};


};

window.addEventListener("load",fPopupModalHandler);