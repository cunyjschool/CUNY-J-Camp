jQuery(document).ready(function(){
	
	jQuery('select.term-selector').selectList({
		sort: true
	});
	
	jQuery('input.cunyjcamp-date-picker').datepicker({
		changeMonth: true,
		changeYear: true,
	});
	
	jQuery('input.cunyjcamp-time-picker').timepicker({
		ampm: true,
		hour: 17,
		timeFormat: 'h:mm TT',
		hourGrid: 4,
		minuteGrid: 10,
	});
	
	jQuery('input#cunyjcamp-all-day-event').click(function(){
		if ( jQuery(this).attr('checked') ) {
			jQuery('.pick-time').addClass('display-none');
		} else {
			jQuery('.pick-time').removeClass('display-none');
		}
	});
	
});