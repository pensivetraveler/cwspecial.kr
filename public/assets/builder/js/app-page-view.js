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
		if(common.PAGE_EDIT_URI) location.href = common.PAGE_EDIT_URI + '/' + common.KEY;
	});

	$('.btn-view-delete').on('click', function(e) {
		if(!common.KEY) throw new Error(`KEY is not defined`);
		Swal.fire({
			title: getLocale('Do you really want to delete?', common.LOCALE),
			text: getLocale('You can\'t undo this action', common.LOCALE),
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: getLocale('Delete', common.LOCALE),
			cancelButtonText: getLocale('Cancel', common.LOCALE),
			customClass: {
				confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
				cancelButton: 'btn btn-outline-secondary waves-effect'
			},
			buttonsStyling: false
		}).then(function (result) {
			if (result.isConfirmed) {
				executeAjax({
					url: common.API_URI + '/' + common.KEY + (Object.keys(common.API_PARAMS).length > 0 ? '?' + new URLSearchParams(common.API_PARAMS).toString() : ''),
					method: 'delete',
					after : {
						callback: showAlert,
						params: {
							type: 'success',
							title: 'Complete',
							text: 'Delete Completed',
							callback: redirect,
							params: common.PAGE_LIST_URI,
						},
					}
				});
			}
		});
	});
});
