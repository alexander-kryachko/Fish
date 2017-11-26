// Begin Default (Show tooltip on bottom)
$(document).ready(function(){	
	$('[title]').qtip({
		style: {
				classes: 'ui-tooltip-bootstrap'
				//classes: 'ui-tooltip-tipsy ui-tooltip-rounded'
		},
		position: {
				my: 'top center',  // Position my top left...
				at: 'bottom center', // at the bottom right of...
				target: 'mouse',
				adjust: { 
						mouse: true,  // Can be omitted (e.g. default behaviour)
						y: 25
						}
		} 		
	});					
});

// Begin Social Icons (Show tooltip on top)
$(document).ready(function(){	
	$('#footer .social-icons li a[title]').qtip({
		style: {
				classes: 'ui-tooltip-tipsy ui-tooltip-rounded'
		},
		position: {
				my: 'bottom center',  // Position my top left...
				at: 'top center', // at the bottom right of...
				target: 'mouse',
				adjust: { 
						mouse: true,  // Can be omitted (e.g. default behaviour)
						y: -10
						}
		} 		
	});					
});
