$(".select_area").on('change', function(e) {
	var form = $(this).parents('form:first');
	form.submit()
});