$(".form-filtro--espaco-cultural").on('submit', function(e) {
	filter();
	e.preventDefault();
});

function filter() {
	var local = $('.select_local').val();
	var busca = $('.input_search').val();
	var args = {'estado': local, 'busca':busca};
	applyFilters(args);
	return false;
}