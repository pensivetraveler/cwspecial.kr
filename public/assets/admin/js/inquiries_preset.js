appPlugins.list.datatable = {
	rowCallback : function(row, data, displayNum, displayIndex, dataIndex) {
		// data[3] -> Age 컬럼 값이 40 이상이면 행 색깔 변경
		if(data.reply_yn) $(row).css('background-color', '#cbcbcb');
	}
}
