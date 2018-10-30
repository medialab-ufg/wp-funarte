$(document).ready(function() {
	//base.link.bloquear();
});

var base = {
	link: {
		bloquear: function() {
			$('a[href="#"]').on('click',function() {
				return false;
			});
		}
	}
};