$(function() {
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

		let reader = new FileReader();
		reader.readAsArrayBuffer(file);

		reader.onload = function(e) {
			let data = new Uint8Array(e.target.result);
			let workbook = XLSX.read(data, { type: 'array' });

			let sheetName = workbook.SheetNames[0]; // 첫 번째 시트만 사용
			let worksheet = workbook.Sheets[sheetName];

			let json = XLSX.utils.sheet_to_json(worksheet, { header: 1 }); // JSON 변환

			if(json.length > 0) {
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
						row.appendChild(td);
					}
					const last = document.createElement('td');
					const btn = document.createElement('button');
					btn.innerText = 'remove';
					btn.value = 'remove';
					last.appendChild(btn);
					row.appendChild(last);
					tbody.appendChild(row);
				}
			}
			console.log(json); // 콘솔 출력

			$("#inline-editable").Tabledit({
				inputClass: 'form-control form-control-sm',
				editButton: false,
				deleteButton: false,
				columns: {
					identifier: [0, "id"],
					editable: getEditableColumns('#inline-editable')
				}
			});
		};

		reader.onerror = function(error) {
			console.error("파일 읽기 오류:", error);
		};
	});
})
