// onload javascript

var fMinAndMaxHandler8 = function (){

	// minimise and maximise 8
	var oViewAll = document.querySelector("#viewAll");
    var oMinimise8 = document.querySelector("#minimised8");

    oViewAll.onclick = function (){
        
        if (oMinimise8.className == "minimised8 singleBlock"){
            oMinimise8.className = ""; // removes minimise display none property.
            oViewAll.innerHTML = '<a href="">View Less</a>';
        } else {
            oMinimise8.className = "minimised8 singleBlock";
            oViewAll.innerHTML = '<a href="">View All</a>';
        }
    	
    	return false;
    };
};
window.addEventListener("load",fMinAndMaxHandler8);