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

function applyViewData(data) {
	const container = document.getElementById('view-container');
	if(!container) return;

	for(const key of Object.keys(data)){
		if(appPlugins.view !== null && appPlugins.view.hasOwnProperty(key)) {
			console.log(key)
		}else{
			if(container.querySelector(`#${key}`) === null) continue;
			switch (key) {
				case 'thumbnail' :
					if(data[key] !== null && data[key].length && data[key][0].file_link !== null) {
						container.querySelector(`#${key}`).style.backgroundImage = `url(${data[key][0].file_link})`
					}else{
						container.querySelector('.thumbnail-wrap').style.display = 'none';
					}
					break;
				default :
					container.querySelector(`#${key}`).innerHTML = data[key];
			}
		}
	}

	document.body.setAttribute('data-onload', true);
}

function getViewData() {
	$.ajax({
		url : common.API_URI + '/' + common.KEY + '?' + new URLSearchParams(common.API_PARAMS).toString(),
		headers: {
			'Authorization' : common.HOOK_PHPTOJS_VAR_TOKEN,
		},
		dataType: 'json',
		success: function (response, textStatus, jqXHR) {
			console.log(response)
			applyViewData(response.data[0]);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR)
		}
	});
}

$(function() {
	getViewData();

	$('.btn-view-list').on('click', function(e) {
		location.href = common.PAGE_LIST_URI;
	});

	$('.btn-view-edit').on('click', function(e) {
		const isMine = checkMyData();
		if(isMine) location.href = common.PAGE_EDIT_URI + '/' + common.KEY;
	});
});
