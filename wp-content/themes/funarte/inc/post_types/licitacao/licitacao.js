function filter() {
	var ano = $('.select_ano').val();
	var modalidade = $('.select_modalidade').val();
	var args = {'ano': ano, 'modalidade' : modalidade};
	applyFilters(args);
}