// onload javascript

var fLikeButtonHandler = function (){
    
    var oStandardControl = document.querySelector("#commentReply");

	var oOverlayComment = document.querySelector("#overlayCommentReply");
	
	oStandardControl.onclick = function (){

		oOverlayComment.className = ""; // removes class (css properties) so it will appear

		return false;

	};
    
    var oCloseButton = document.querySelector("#closePopup");
    
    oCloseButton.onclick = function (e){

			console.log(e.target);

			oOverlayComment.className = "hide";

		return false;

	};

};

window.addEventListener("load",fPopupModalHandler);