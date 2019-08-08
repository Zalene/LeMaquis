jQuery(document).ready(function($) {
    /**
     * Set footer always on the bottom of the page
     */
    function footerAlwayInBottom(footerSelector) {
        var docHeight = $(window).height();
        var footerTop = footerSelector.position().top + footerSelector.height();
        if (footerTop < docHeight) {
            footerSelector.css("margin-top", (docHeight - footerTop) + "px");
        }
    }
    // Apply when page is loading 
    footerAlwayInBottom($("#footer"));
    // Apply when page is resizing
    $(window).resize(function() {
        footerAlwayInBottom($("#footer"));
    });
});

var header = document.querySelector("#menu-scroll header");

function scrolled(){
	var windowHeight = document.body.clientHeight,
		currentScroll = document.body.scrollTop || document.documentElement.scrollTop;
	
	header.className = (currentScroll >= windowHeight - header.offsetHeight) ? "fixed" : "";
}

addEventListener("scroll", scrolled, false);