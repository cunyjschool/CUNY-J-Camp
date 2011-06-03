jQuery(document).ready(function(){
	
	jQuery('select.term-selector').selectList({
		sort: true
	});
	
	jQuery('input.cunyjcamp-date-time-picker').datetimepicker({
		changeMonth: true,
		changeYear: true,
		ampm: true,
		hour: 17,
		timeFormat: 'h:mm TT',
		hourGrid: 4,
		minuteGrid: 10,
	});
	
});