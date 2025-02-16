$(function() {
	const fieldList = excelHeaders.map(item => item.label);
	const requiredList = excelHeaders.filter(item => item.required).map(item => item.label);

	function getEditableColumns(tableSelector, excludeIndices = [0]) {
		let editableColumns = [];
		let columnCount = $(tableSelector + " thead th").length; // 전체 컬럼 개수
		excludeIndices.push(columnCount - 1);
		$(tableSelector + " thead th").each(function (index) {
			if (!excludeIndices.includes(index)) { // 제외할 컬럼(기본 ID 컬럼) 제외
				editableColumns.push([index, "col" + index]);
			}
		});
		return editableColumns;
	}

	$("#inline-editable").on('click', 'button[value="remove"]', function () {
		this.closest('tr').remove();
	});

	document.getElementById('excelFile').addEventListener('change', function(event) {
		let file = event.target.files[0];
		if (!file) return;

		let allowedExtensions = /(\.xls|\.xlsx)$/i;
		if (!allowedExtensions.exec(file.name)) {
			showAlert({
				type : 'warning',
				text: "엑셀 파일(.xls, .xlsx)만 업로드 가능합니다.",
			});
			event.target.value = ""; // 파일 선택 초기화
			return;
		}

		let reader = new FileReader();
		reader.readAsArrayBuffer(file);

		reader.onload = function(e) {
			let data = new Uint8Array(e.target.result);
			let workbook = XLSX.read(data, { type: 'array' });

			let sheetName = workbook.SheetNames[0]; // 첫 번째 시트만 사용
			let worksheet = workbook.Sheets[sheetName];

			let json = XLSX.utils.sheet_to_json(worksheet, { header: 1 }); // JSON 변환
			if(!json.length) {
				showAlert({
					type: 'error',
					text: '업로드 파일을 확인해주세요.',
				})
				return;
			}

			// header 검사
			const notFields = [];
			for(const item of json[0]) if(!fieldList.includes(item)) notFields.push(item);
			console.log(requiredList)

			if(notFields.length) {
				showAlert({
					type: 'error',
					html: "허용되지 않는 컬럼이 포함되어있습니다.<br><span class='small mt-2'>"+notFields.join(', ')+"</span>",
				})
				return;
			}

			// table 초기화
			const table = document.getElementById('inline-editable');
			$(table).find('thead tr').empty();
			$(table).find('tbody').empty();

			// thead
			const thead = table.querySelector('thead tr');
			const init = document.createElement('th');
			init.innerText = '#';
			thead.appendChild(init);
			let colCount = 0;
			for(const [idx, col] of json[0].entries()) {
				const th = document.createElement('th');
				th.innerText = col;
				thead.appendChild(th)
				colCount++;
			}
			const last = document.createElement('th');
			last.innerText = '삭제';
			thead.appendChild(last);

			// tbody
			let totalRowCount = 0;
			let totalErrorCount = 0;
			const tbody = table.querySelector('tbody');
			for(let i = 1; i < json.length; i++) {
				if(json[i].length === 0) continue;
				const row = document.createElement('tr');
				const init = document.createElement('td');
				init.innerText = i;
				row.appendChild(init);
				for(let j = 0; j < colCount; j++) {
					const obj = json[i];
					const td = document.createElement('td');
					td.innerText = obj[j]??'';

					// required 확인
					if(!td.innerText.length) {
						if(requiredList.includes(fieldList[j])) {
							td.classList.add('input-required');
							totalErrorCount++;
						}
					}

					row.appendChild(td);
				}
				const last = document.createElement('td');
				const btn = document.createElement('button');
				btn.classList.add(...['btn', 'btn-danger', 'p-1']);
				btn.innerText = '삭제';
				btn.value = 'remove';
				last.appendChild(btn);
				row.appendChild(last);
				tbody.appendChild(row);
				totalRowCount++;
			}

			document.getElementById('totalRowCount').innerText = totalRowCount.toString();
			document.getElementById('totalErrorCount').innerText = totalErrorCount.toString();

			if(totalErrorCount > 0) {
				document.getElementById('excelFormSubmit').setAttribute('disabled', 'disabled');
				document.getElementById('btnErrorFind').removeAttribute('disabled');
			}else{
				document.getElementById('excelFormSubmit').removeAttribute('disabled');
			}

			$("#inline-editable").Tabledit({
				url: false,
				inputClass: 'form-control form-control-sm',
				editButton: false,
				deleteButton: false,
				columns: {
					identifier: [0, "id"],
					editable: getEditableColumns('#inline-editable')
				},
				onSuccess: function (data, textStatus, jqXHR) {
					console.log(data)
					console.log(textStatus)
					console.log(jqXHR)
				},
				onSubmit: function(action, serializedData, jqXHR) {
					console.log("AJAX 요청 차단됨:", action, serializedData);
					if (jqXHR) jqXHR.abort(); // 안전하게 AJAX 요청 중단
					return false;
				},
			});

			$('#inline-editable').on('change', 'input.tabledit-input', function() {
				const index = getNodeIndexInParent(this);
				const required = requiredList.includes(fieldList[index-1]);
				const wrap = this.closest('td');
				this.value = this.value.trim();
				if(required) {
					if(!this.value.length) {
						if(!wrap.classList.contains('input-required')) wrap.classList.add('input-required');
					}else{
						if(wrap.classList.contains('input-required')) wrap.classList.remove('input-required');
					}
				}

				if(!document.querySelectorAll('td.input-required').length) {
					document.getElementById('excelFormSubmit').removeAttribute('disabled');
					document.getElementById('btnErrorFind').setAttribute('disabled', 'disabled');
				}
			});
		};

		reader.onerror = function(error) {
			console.error("파일 읽기 오류:", error);
		};
	});

	document.getElementById('btnErrorFind').addEventListener('click', function() {
		const errors = document.querySelectorAll('td.input-required');
		if(!errors.length) return;

		const container = $('#inline-editable').parents('.table-responsive')[0];
		const containerPos = container.getBoundingClientRect();
		const columnPos = errors[0].getBoundingClientRect();
		window.scrollTo(0, columnPos.y - 100);
		console.log(columnPos)

		setTimeout(function() {
			const scrollX = Math.max(columnPos.x-containerPos.width, 0);
			$(container).animate({ scrollLeft: scrollX }, 500);
		}, 500);
	});

	$('#excelFormSubmit').on('click', function() {
		let editedData = [];

		$('#inline-editable tbody tr').each(function() {
			let row = $(this);
			let rowData = {};
			$(row).find('td').each(function (k, v) {
				if(k === 0 || k === $(row).find('td').length-1) return;
				const columnName = excelHeaders[k-1].field;
				rowData[columnName] = $(v).text();
			});
			editedData.push(rowData);
		});

		// AJAX를 통해 서버로 데이터 전송
		$.ajax({
			url: common.API_URI+'/excelUpload',  // 서버의 저장 API URL
			type: 'POST',
			dataType: 'json',
			data: { data: editedData },
			success: function(response) {
				showAlert({
					type : 'success',
					text: 'Registered Successfully',
					callback: 'reload',
				});
			},
			error: function(jqXHR) {
				if(jqXHR.status === 409) {
					const key = Object.keys(jqXHR.responseJSON.data)[0];
					showAlert({
						type : 'error',
						text: `${jqXHR.responseJSON.msg} (${key} : ${jqXHR.responseJSON.data[key]})`,
					});
				}else{
					showAlert({
						type : 'error',
						text: jqXHR.responseJSON.msg,
					});
				}
			}
		});
	});
})
