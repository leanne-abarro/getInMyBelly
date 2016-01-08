// onload javascript

var fMinAndMaxHandler6 = function (){

	// minimise and maximise 6
	var oViewAll2 = document.querySelector("#viewAll2");
    var oMinimise6 = document.querySelector("#minimised6");

    oViewAll2.onclick = function (){
        
        if (oMinimise6.className == "marginTop10 minimised6"){
            oMinimise6.className = ""; // removes minimise display none property.
            oViewAll2.innerHTML = '<a href="">View Less</a>';
        } else {
            oMinimise6.className = "marginTop10 minimised6";
            oViewAll2.innerHTML = '<a href="">View All</a>';
        }
    	
    	return false;
    };
};
window.addEventListener("load",fMinAndMaxHandler6);