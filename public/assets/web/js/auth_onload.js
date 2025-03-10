$(function() {
	$('.ps').each(function(k,v) {
		new PerfectScrollbar(v, {
			wheelPropagation: false
		});
	})
})
