// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

//Scroll reveal 

var scrollReveal = function(holder,efecto){
	'use strict'; 
	var rev = $(holder); 
	rev.each(function(){
		$(this).css('opacity',0); 
	}); 
	$(window).on('scroll', checkScroll); 
	function checkScroll (){
		var p_h = $(window).height() * 1.1, 
			scrd = $(window).scrollTop(); 
		rev.each(function(){
			var e = $(this), 
				offTop = e.offset().top;
			if (scrd+p_h > offTop){
				e.addClass('animated ' + efecto); 
			} else {
				e.removeClass(efecto); 
			}
			
		});
		
	}
	
};


//scroll bodymovin

var bodyScrollPlay = function(holder,BMHolder){
	'use strict'; 
	var rev = $(holder); 
	if(window.innerWidth < 575 ){
		$(window).on('scroll', checkScrollBM); 
	}
	function checkScrollBM (){
		var p_h = $(window).height() * 1.1, 
			scrd = $(window).scrollTop(); 
		rev.each(function(){
			var t = $(this), 
				offTop = t.offset().top;
			if (scrd+p_h > offTop){
				BMHolder.play(); 
			}
			
		});
		
	}
	
	
	
};



