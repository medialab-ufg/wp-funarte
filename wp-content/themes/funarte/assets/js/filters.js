function applyFilters( args ) {
	var pattern_pagination = /\/page\/[0-9]*/;
	var pathname = window.location.pathname;
	pathname = pathname.replace(pattern_pagination, "");
  var url = window.location.protocol + '//' + window.location.host + pathname;
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

