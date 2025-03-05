function setViewCount() {
	$.ajax({
		async: false,
		url: '/api/articleRead/',
		method: 'put',
		headers: {
			'Authorization' : common.HOOK_PHPTOJS_VAR_TOKEN,
		},
		data: {
			article_id : common.KEY,
		},
		dataType: 'json',
		success: function (response, textStatus, jqXHR) {
			console.log(response)
		},
		error: function (jqXHR, textStatus, errorThrown) {
			// showAlert({
			// 	type: 'warning',
			// 	text: jqXHR.responseJSON.msg,
			// });
		},
	});
}

function checkMyData(showError = true) {
	let result = false;
	$.ajax({
		async: false,
		url: '/api/articles/isMyData/' + common.KEY,
		headers: {
			'Authorization' : common.HOOK_PHPTOJS_VAR_TOKEN,
		},
		dataType: 'json',
		success: function (response, textStatus, jqXHR) {
			result = true;
		},
		error: function (jqXHR, textStatus, errorThrown) {
			if(showError) {
				showAlert({
					type: 'warning',
					text: jqXHR.responseJSON.msg,
				});
			}
		},
	});
	return result;
}

$(function() {
	if($('body').data('method') === 'view') setViewCount();

	$('.btn-article-list').on('click', function(e) {
		location.href = common.PAGE_LIST_URI;
	});

	$('.btn-article-edit').on('click', function(e) {
		const isMine = checkMyData();
		if(isMine) location.href = common.PAGE_EDIT_URI + '/' + common.KEY;
	});

	$('.btn-article-delete').on('click', function(e) {
		const isMine = checkMyData();
		if(isMine) location.href = common.PAGE_EDIT_URI + '/' + common.KEY;
	});
});
