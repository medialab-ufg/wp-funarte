$(".form-filtro--espaco-cultural").on('submit', function(e) {
	filter();
	e.preventDefault();
});

$('.form-filtro--espaco-cultural .select_area').on('change', function() {
  filter();
});


function filter() {
	var local = $('.select_local').val();
	var area = $('.select_area').val();
	var busca = $('.input_search').val();
	
	var args = {'estado': local, 'busca':busca, 'area':area};
	applyFilters(args);
	return false;
}