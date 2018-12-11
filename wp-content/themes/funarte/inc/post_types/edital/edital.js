$(".form-filtro--editais").on('submit', function(e) {
	var status = $('li.active>a.link-tabs').data('status');
	filter(status);
	e.preventDefault();
});

$(".select_area").on('change', function(e) {
	var status = $('li.active>a.link-tabs').data('status');
	filter(status);
	e.preventDefault();
});

$(".link-tabs").on("click", function(e) {
	filter(this.dataset.status);
	e.preventDefault();
});

function filter(status) {
	var area = $('.select_area').val();
	var busca = $('.input_search').val();
	var args = {'busca':busca, 'area':area, 'status':status};
	applyFilters(args);
	return false;
}