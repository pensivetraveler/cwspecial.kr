function renderColumnName(data, type, full, meta, column) {
	return `${data} (${full.id})`;
}

function renderColumnClassTimeList(data, type, full, meta, column) {
	let output = '';
	for(const item of data) {
		output += `<p class="mb-0">${item.class_dow} ${item.class_hour}:${item.class_minute} ${item.class_meridian}</p>`
	}
	return output;
}

aaa.render.name = function(index, column) {
	return {
		render: function (data, type, full, meta, column) {
			return `${data} (${full.id})`;
		}
	}
}
