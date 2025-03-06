function applyViewData(dataId) {
	const data = getData(dataId);
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

$(function() {
	applyViewData(common.KEY);

	$('.btn-view-list').on('click', function(e) {
		location.href = common.PAGE_LIST_URI;
	});

	$('.btn-view-edit').on('click', function(e) {
		if(common.PAGE_EDIT_URI) location.href = common.PAGE_EDIT_URI + '/' + common.KEY;
	});

	$('.btn-view-delete').on('click', function(e) {
		if(!common.KEY) throw new Error(`KEY is not defined`);
		deleteData(common.KEY, {
			callback: dt.ajax.reload,
			params: [null, false]
		});
	});
});
