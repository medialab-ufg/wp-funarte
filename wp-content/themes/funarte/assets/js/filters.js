function applyFilters( args ) {
  var url = window.location.protocol + '//' + window.location.host + window.location.pathname;
	for (var k in args){
		if ( (k !== null && k !== '') && (args[k] !== null && args[k] !== '')) {
			if (url.indexOf('?') > -1)
				url += '&'+k+'='+args[k];
			else
				url += '?' + k + '=' + args[k];
		}
		window.location.href = url;
	}
}

