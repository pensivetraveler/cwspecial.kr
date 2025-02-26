/**
 * GetLocale
 *
 * Fetches a language variable
 *
 * @param	string	key		The language line
 * @param	array	locale	Fetched language
 * @returns {*[]}
 */
function getLocale(key, locale = []) {
	try {
		if(locale.length === 0 && window.LOCALE === undefined) throw new ReferenceError('getLocale : LOCALE is not defined.');
		if(locale.length === 0) locale = window.LOCALE;
		if(key === undefined) throw new ReferenceError('getLocale : key is not defined.');

		let exist = false;
		let result = locale;

		if(key.indexOf('.') === -1 || key.substring(key.length-1,key.length) === '.'){
			result = locale.hasOwnProperty(key) ? result[key] : undefined;
		}else{
			const keys = key.split('.');

			for(const item of keys) {
				if(result[item] !== undefined) {
					result = result[item];
				}else{
					result = undefined;
					break;
				}
			}

			if(result === undefined) {
				result = locale;
				keys[0] = 'common';
				for(const item of keys) {
					if(result[item] !== undefined) {
						result = result[item];
					}else{
						result = undefined;
						break;
					}
				}
			}
		}

		if(result === undefined) throw new RangeError(`getLocale : Can't find locale. ${key}`);
		return result;
	} catch (error) {
		if (error instanceof RangeError) {
			console.warn(error.message);
			return key;
		}else{
			customErrorHandler(error);
		}
	}
}

/**
 * FoldDaumPostcode
 * @param wrap
 */
function foldDaumPostcode(wrap) {
	// iframe을 넣은 element를 안보이게 한다.
	wrap.classList.remove('on');
	wrap.style.removeProperty('height');
	wrap.querySelector('div').remove();
}

function findAddress(wrap) {
	const group_name = wrap.getAttribute('data-group-name');
	// 현재 scroll 위치를 저장해놓는다.
	new daum.Postcode({
		oncomplete: function(data) {
			const frm = wrap.closest('form');
			console.log(`[data-group-name="${group_name}"][data-group-field="zipcode"]`);
			frm.querySelector(`[data-group-name="${group_name}"][data-group-key="zipcode"]`).value = data.zonecode;
			frm.querySelector(`[data-group-name="${group_name}"][data-group-key="addr1"]`).value = data.address;
			frm.querySelector(`[data-group-name="${group_name}"][data-group-key="addr2"]`).focus()

			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			wrap.classList.remove('on');
		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(wrap);

	// iframe을 넣은 element를 보이게 한다.
	wrap.classList.add('on');
}

function callUserFunc(callback = undefined, params = undefined) {
	try {
		if(callback === undefined || typeof callback === undefined)
			throw new Error(`callUserFunc : callback is not defined !`);

		if(typeof callback === 'string' && callback.trim().length === 0)
			throw new Error(`callUserFunc : callback is not valid !`);

		const isString = typeof callback === 'string';

		if(params !== undefined) {
			if(isObject(params) || isArray(params)) {
				if(isObject(params)) isString?window[callback](params):callback(params);
				if(isArray(params)) isString?window[callback](...params):callback(...params);
			}else{
				isString?window[callback](params):callback(params);
			}
		}else{
			isString?window[callback]():callback();
		}
	} catch (error) {
		customErrorHandler(error);
	}
}

function showAlert(obj = {}) {
	try {
		var title, text;
		if(obj.type === undefined) obj.type = 'success';
		if(!['success', 'warning', 'error'].includes(obj.type)) throw new Error(`showAlert : Type is not allowed. ${obj.type}`);
		if(obj.title !== undefined) title = getLocale(obj.title, common.LOCALE);
		if(obj.text !== undefined || obj.html !== undefined) text = getLocale(obj.text, common.LOCALE);

		switch (obj.type) {
			case 'success' :
				if(title === undefined) title = 'Success!';
				if(text === undefined) text = getLocale('You clicked the button!', common.LOCALE);
				break;
			case 'warning' :
				if(title === undefined) title = 'Warning!';
				if(text === undefined) text = getLocale('Are you sure you want to do this?', common.LOCALE);
				break;
			case 'error' :
				if(title === undefined) title = 'Error!';
				if(text === undefined) text = getLocale('An Error Occurred', common.LOCALE);
				break;
		}

		obj.title = title;
		if(obj.html === undefined) obj.text = text;

		showSwalAlert(obj);
	} catch (error) {
		customErrorHandler(error);
	}
}

function swalKeydownHandler(event) {
	// Prevent bubbling of Enter or Escape key
	if (event.key === 'Enter' || event.key === 'Escape') {
		event.stopPropagation();
		event.preventDefault();
		// Confirm the swal
		if(['Enter', 'Escape'].includes(event.key)) Swal.clickConfirm();
	}
}

function showSwalAlert(obj) {
	Swal.fire({
		title: obj.title,
		text: obj.text??null,
		html: obj.html??null,
		icon: obj.type,
		customClass: {
			confirmButton: 'btn btn-primary waves-effect waves-light'
		},
		buttonsStyling: false,
		willOpen: () => {
			// console.log('1 willOpen')
			document.addEventListener('keydown', swalKeydownHandler);
		},
		preConfirm: () => {
			// console.log('2 preConfirm')
			console.log('Confirm button clicked or Enter key pressed');
		},
		didOpen: () => {
			// console.log('3 didOpen')
		},
		willClose: () => {
			// console.log('4 willClose')
			document.removeEventListener('keydown', swalKeydownHandler);
		},
	}).then(function (result) {
		if(obj.callback !== undefined) {
			if(typeof obj.callback === 'string' && obj.callback.toLowerCase() === 'reload') {
				location.reload();
			}else{
				if(obj.hasOwnProperty('params') && obj.params !== null){
					callUserFunc(obj.callback, obj.params);
				}else{
					obj.callback();
				}
			}
		}else{
			// if(obj.type === 'error') location.reload();
		}
	});
}

function getAjaxOptions(obj = {}) {
	try {
		if(obj.url === undefined) throw new Error(`getAjaxOptions : url is not valid !`);

		let url = obj.url;
		let method = 'get';
		['method', 'type'].forEach(function(key) {
			if(obj[key] !== undefined) {
				if(typeof obj[key] !== 'string') throw new Error(`getAjaxOptions : method is not valid !`);
				if(!isEmpty(obj[key]) && !['get', 'post', 'delete', 'put', 'patch'].includes(obj[key].toLowerCase()))
					throw new Error(`getAjaxOptions : method is not valid !`);
				method = obj[key];
			}
		})

		let dataType = 'json';
		if(obj.dataType !== undefined) {
			if(typeof obj.dataType !== 'string') throw new Error(`getAjaxOptions : dataType is not valid !`);
			dataType = obj.dataType.toLowerCase();
		}

		let data = {};
		if(obj.data !== undefined) {
			if(!isObject(obj.data) && typeof obj.data !== 'function' && typeof obj.data !== 'string')
				throw new Error(`getAjaxOptions : data is not valid type !`);
			data = obj.data;
		}

		const async = obj.async === undefined?false:obj.async;

		const ajaxOption = {
			async: false,
			url: url,
			method: method,
			data: data,
			dataType: dataType,
		};

		for(const key of ['headers', 'complete', 'contentType', 'processData']){
			if(obj.hasOwnProperty(key)) ajaxOption[key] = obj[key];
		}

		return ajaxOption;
	} catch (error) {
		customErrorHandler(error);
	}
}

function executeAjax(obj = {}, test = false) {
	const options = getAjaxOptions(obj);

	if(obj.success !== undefined) {
		options.success = obj.success;
	}else{
		options.success = function(response, textStatus, jqXHR) {
			console.log(response)
			if (Math.floor(response.code/10) === 200) {
				if(obj.after !== undefined && obj.after.callback !== undefined) {
					if(obj.after.callback.name === 'showAlert'){
						obj.after.params.text = response.msg;
						showAlert(obj.after.params);
					}else{
						callUserFunc(obj.after.callback, obj.after.params);
					}
				}else{
					showAlert({
						type: 'success',
						text: response.msg,
					});
				}
			} else {
				console.warn(jqXHR.responseJSON)
				showAlert({
					type: 'warning',
					text: jqXHR.responseJSON.msg,
				});
			}
		}
	}

	if(obj.error !== undefined) {
		options.error = obj.error;
	}else{
		options.error = function(jqXHR, textStatus, errorThrown) {
			console.warn(jqXHR.responseJSON)
			showAlert({
				type: 'error',
				text: jqXHR.responseJSON.msg,
			});
		}
	}

	if(test) {
		const form = document.createElement('form');
		if(obj.data !== undefined) {
			for(const [name, value] of Object.entries(obj.data)) {
				const input = document.createElement('input');
				input.name = name;
				input.value = value;
				form.appendChild(input);
			}
		}
		form.target = '_blank';
		form.action = obj.url;
		form.method = obj.method;
		document.body.appendChild(form);
		form.submit();
		form.remove();
	}else{
		$.ajax(options);
	}
}

function submitAjax(selector, options = {}, test = false) {
	const form = document.querySelector(selector);
	const formData = options.hasOwnProperty('data') ? options.data : getFormData(form);

	let url;
	if(!options.hasOwnProperty('url')) {
		url = common.API_URI;
		if(common.hasOwnProperty('API_URI_ADD')&&common.API_URI_ADD.length>0) url += '/'+common.API_URI_ADD;
		if(form[common.IDENTIFIER]) url += '/' + form[common.IDENTIFIER].value;
		if(common.API_PARAMS.length) url += '?' + new URLSearchParams(common.API_PARAMS).toString();
	}else{
		url = options.url;
	}

	options = Object.assign({
		url : url,
		method: 'post',
		headers: {
			'Authorization' : common.HOOK_PHPTOJS_VAR_TOKEN,
		},
		contentType: false, // jQuery가 contentType을 자동으로 설정하지 않도록 함
		processData: false, // jQuery가 데이터를 처리하지 않도록 함
		data: formData,
		success: function(response) {
			console.log(response)
			showAlert({
				type: 'success',
				title: 'Complete',
				text: form['_mode'].value === 'edit' ? 'Your Data Is Updated' : 'Registered Successfully',
			});
		},
	}, options);

	if(test) {
		form.querySelectorAll('input, textarea, select').forEach(function(node) {
			if(!node.name) return;
			if(!checkInputSubmittable(node, form)) node.setAttribute('disabled', 'disabled');
		});

		form.action = options.url;
		form.method = options.method ?? 'post';
		form.target = '_blank';
		form.submit();

		form.querySelectorAll('[disabled]').forEach(function(node) {
			node.removeAttribute('disabled');
		});
	}else{
		executeAjax(options);
	}
}

function getFormData(form = null) {
	if(!form) form = document.getElementById('formRecord');

	const formData = new FormData();
	form.querySelectorAll('input, textarea, select').forEach(function(node) {
		if(!node.name) return;
		if(checkInputSubmittable(node, form)){
			if(node.type === 'file') {
				let fileCnt = node.files.length;
				if(fileCnt > 0) {
					if(fileCnt === 1) {
						formData.append(node.name, node.files[0]);
					}else{
						if(node.hasAttribute('max') && !isNaN(node.getAttribute('max'))) {
							fileCnt = parseInt(node.hasAttribute('max'));
						}
						for(let i = 0; i < fileCnt; i++) {
							formData.append(node.name+'[]', node.files[i]);
						}
					}
				}
			}else{
				formData.append(node.name, node.value);
			}
		}
	});

	if(window['Dropzone'] !== undefined) {
		for(const inst of Dropzone.instances){
			let field = inst.element.getAttribute('data-field');
			if(inst.files.length > 0) {
				if(inst.files.length === 1) {
					formData.append(`${field}`, inst.files[0]);
				} else {
					inst.files.forEach((file, index) => {
						formData.append(`${field}[${index}]`, file);
					});
				}
			}
		}
	}

	logFormData(formData);

	return formData;
}

function checkInputSubmittable(node, form) {
	if(node.type === 'file') {
		if(node.files.length > 0) return true;
	}else{
		if(node.hasAttribute('data-detect-changed') && !isAttributeValueTrue(node, 'data-detect-changed')) {
			return true;
		}else if(node.type === 'hidden') {
			return true;
		}else if(node.type === 'checkbox') {
			if(node.checked === true) return true;
		}else if(node.getAttribute('required') === 'required') {
			return true;
		}else if(isAttributeValueTrue(node, 'data-input-changed')) {
			return true;
		}else if(node.hasAttribute('required-mod')) {
			const requireMod = node.getAttribute('required-mod').split('|');
			if (requireMod.includes(form['_mode'].value)) return true;
		}
	}
	return false;
}

function reformatFormData(form, data, regexp = {}, side = false) {
	return data.reduce((acc, curr, i) => {
		if(curr.type === 'hidden') return acc;

		let selector;
		if(form.querySelector(`[name="${curr.field}"]`)) {
			selector = `[name="${curr.field}"]`;
		}else if(form.querySelector(`[name="${curr.field}[]"]`)) {
			selector = `[name="${curr.field}[]"]`;
		}else if(curr.group) {
			const groupName = curr.group;
			const inputName = curr.field;
			if(curr.group_attributes.envelope_name) {
				selector = `[name^="${groupName}"][name$="[${inputName}]"]`;
			}else{
				selector = `[name^="${inputName}"]`;
			}
			selector = isValidSelector(selector) ? selector : null;
		}else if(isValidSelector(`#${curr.id}`) && form.querySelector(`#${curr.id}`)) {
			selector = `#${curr.id}`;
		}
		if(!selector) return acc;

		const item = {
			selector : selector,
			validators : {},
		};

		for(const key of Object.keys(curr.errors)){
			switch(key) {
				case 'required':
					item.validators.notEmpty = {
						message: curr.errors[key]
					};
					break;
			}
		}

		if(curr.type === 'date') {
			item.validators.date = {
				format: 'YYYY-MM-DD',
			};
		}

		if(curr.type === 'file') {
			console.log(curr.attributes.accept)
			item.validators.file = {
				extension: curr.attributes.extension??null,
				maxFiles : curr.attributes.max??null,
				type : curr.attributes.accept??null,
				message : '유효한 파일을 업로드해주세요.',
			};
		}

		curr.rules.split(/\|(?![^\[]*\])/).forEach(raw => {
			if(!raw.length) return;
			if(['required', 'trim'].includes(raw)) return;
			const rule = raw.match(/^[a-zA-Z_]+/)?.[0];

			if (!rule || ![...Object.keys(customValidatorsPreset.rules), ...Object.keys(regexp)].includes(rule)) {
				console.warn(`reformatFormData : Rule '${rule || raw}' of '${curr.field}' doesn't have any matched validator.`);
				// item.validators['baseValidator'] = {
				// 	message: `The field id not valid (${camelize(rule)})`,
				// }
				return;
			}else{
				if (validatorName = customValidatorsPreset.inflector(rule)) {
					const { regex, options: getOptions, message: getMessage } = customValidatorsPreset.rules[rule];

					let message;
					if(getMessage === undefined) {
						message = curr.errors?.[rule] && curr.errors[rule];
					}else{
						message = getMessage;
					}

					if (!regex) {
						console.warn(`${rule} regex is not set.`);
						item.validators[validatorName] = {
							...(message && { message: message })
						};
					}else{
						if(matches = customValidatorsPreset.extractor(regex, raw)){
							item.validators[validatorName] = {
								...item.validators[validatorName],
								...getOptions(form, item, matches),
								...(message && { message: message })
							};
						}
					}
				}else{
					if(Object.keys(regexp).includes(rule)) {
						item.validators[camelize(rule)] = {
							regexp: new RegExp(regexp[rule].exp, regexp[rule].flags)
						};
						if(curr.errors.hasOwnProperty(rule)) item.validators[camelize(rule)].message = curr.errors[rule];
					}else{
						console.warn(`reformatFormData : ${rule} validator is not set.`);
					}
				}
			}
		});

		acc[curr.field] = item;
		return acc; // 항상 acc를 반환
	}, {});
}

function setFormListItem(selector, data, field) {
	if(!isValidSelector(selector) || document.querySelector(selector) === null) return;

	let html = '';
	const key = field.form_attributes.list_field ?? field.field;
	if(!isEmpty(data[key])) {
		let list = [];
		isArray(data[key]) ? list = data[key] : list.push(data[key]);
		list.forEach((item) => {
			if(common.IDENTIFIER && data.hasOwnProperty(common.IDENTIFIER)) item[common.IDENTIFIER] = data[common.IDENTIFIER];
			const identifier = common.IDENTIFIER?data[common.IDENTIFIER]:null;
			switch (field.form_attributes.list_type ?? field.subtype) {
				case 'thumbnail' :
					html += setFormListItemThumbnail(field, item, identifier);
					break;
				case 'youtube' :
					html += setFormListItemYoutube(field, item, identifier);
					break;
				case 'reply_list' :
					html += setFormListItemReplyList(field, item, identifier);
					break;
				default :
					html += setFormListItemFile(field, item, identifier);
					break;
			}
		});
		document.querySelector(selector).classList.remove('d-none');
		if(field.subtype === 'readonly') document.querySelector(selector).closest('.form-validation-unit').classList.remove('d-none');
	}else{
		document.querySelector(selector).classList.add('d-none');
		if(field.subtype === 'readonly') document.querySelector(selector).closest('.form-validation-unit').classList.add('d-none');
	}

	document.querySelector(selector).innerHTML = html;
}

function setFormListItemFile(field, item, identifier = '') {
	const url = location.origin+location.pathname;
	const fullItem = JSON.stringify(item).replace(/"/g, "'");
	const articleId = item.article_id ?? '';
	const fileId = item.file_id;
	if(field.form_attributes.hasOwnProperty('list_sorter') && field.form_attributes.list_sorter) {
		let output = `
            <li class="form-list-item list-group-item d-flex justify-content-between align-items-center px-2" data-identifier-val="${identifier}" data-full-item="${fullItem}" data-article-id="${articleId}" data-file-id="${fileId}">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="drag-handle cursor-move ri-menu-line align-text-bottom me-2"></i>
                    <span class="not-draggable">${item.orig_name}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary waves-effect p-1" type="button" onclick="downloadFile(${fileId})">
                        <i class="ri-file-download-line ri-16px align-middle"></i>
                    </button>
        `;
		if(field.form_attributes.list_delete.length > 0){
			output += `
                    <button class="btn btn-danger waves-effect p-1 ms-1" type="button" onclick="deleteFile(this, '${field.form_attributes.list_delete}')">
                        <i class="ri-close-line ri-16px align-middle"></i>
                    </button>
            `;
		}
		output += `
                </div>
            </li>
        `;
		return output;
	}else{
		return `
        <div class="form-list-item d-flex align-items-center" data-identifier-val="${identifier}" data-full-item="${fullItem}">
            <div class="badge text-body text-truncate">
                <a href="${url}/downloader/${fileId}">
                    <i class="ri-file-download-fill ri-16px align-middle"></i>
                    <span class="h6 mb-0 align-middle">${item.orig_name}</span>
                </a>
            </div>
        </div>
    `;
	}
}

function setFormListItemThumbnail(field, item, identifier = '') {
	const url = location.origin+location.pathname;
	const fullItem = JSON.stringify(item).replace(/"/g, "'");
	return `
        <div class="form-list-item d-flex align-items-start flex-column justify-content-center" data-identifier-val="${identifier}" data-full-item="${fullItem}">
            <div class="d-flex align-items-center justify-content-between w-100 mb-2">
                <div class="badge text-body text-truncate">
                    <a href="${url}/downloader/${item.file_id}">
                        <i class="ri-file-download-fill ri-16px align-middle"></i>
                        <span class="h6 mb-0 align-middle">${item.orig_name}</span>
                    </a>
                </div>
                <button class="btn btn-danger waves-effect p-1" type="button" onclick="deleteFile(this, 'thumbnail')">
                    <i class="ri-close-line ri-16px align-middle"></i>
                </button>
            </div>
            <div class="border rounded-3 overflow-hidden">
                <img src="${item.file_link}" alt="${item.orig_name}" class="mw-100 not-draggable" draggable="false">
            </div>
        </div>
    `;
}

function setFormListItemPreview(field, item, identifier = '') {
	const url = location.origin+location.pathname;
	const fullItem = JSON.stringify(item).replace(/"/g, "'");
	return `
        <div class="form-list-item d-flex align-items-center" data-identifier-val="${identifier}" data-full-item="${fullItem}">
            <div class="badge text-body text-truncate">
                <a href="${url}/downloader/${item.file_id}">
                    <i class="ri-file-download-fill ri-16px align-middle"></i>
                    <span class="h6 mb-0 align-middle">${item.orig_name}</span>
                </a>
            </div>
        </div>
    `;
}

function setFormListItemYoutube(field, item, identifier = '') {
	const url = location.origin+location.pathname;
	const fullItem = JSON.stringify(item).replace(/"/g, "'");
	return `
        <div class="d-flex align-items-center" data-identifier-val="${identifier}" data-full-item="${fullItem}">
            <div class="badge text-body text-truncate">
                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#youTubeModal" data-value="${item}">
                    <i class="ri-link mt-0 ri-16px align-middle"></i>
                    <span class="h6 mb-0 align-middle">https://youtu.be/${item}</span>
                </a>
            </div>
        </div>
    `;
}

function setFormListItemReplyList(field, item, identifier = '') {
	const url = location.origin+location.pathname;
	const fullItem = JSON.stringify(item).replace(/"/g, "'");
	return `
        <li class="form-list-item mb-1 ps-0 p-2" data-identifier-val="${identifier}" data-full-item="${fullItem}">
            <p class="h6 mb-1">${item.content}</p>
            <p class="text-end mb-0">${item.created_id} ${item.created_dt}</p>
        </li>
    `;
}

function setFlatpickr(node) {
	const option = {
		// See https://flatpickr.js.org/formatting/
		dateFormat: 'Y-m-d',
		positionElement: document.querySelector(`#${node.id}`),
		onReady: function(selectedDates, dateStr, instance) {
			// Center the popup relative to the input
			instance.calendarContainer.classList.add('flatpickr-side-position');
		},
		// After selecting a date, we need to revalid”ate the field
		onChange: function (data, value, full) {
			$(full.input).trigger('change'); // 'change' 이벤트 강제로 발생
		},
	};

	if(node.classList.contains('flatpickr-date')) {
		Object.assign(option, {
			enableTime: false,
			dateFormat: 'Y-m-d',
		})
	}else if(node.classList.contains('flatpickr-time')) {
		Object.assign(option, {
			enableTime: true,
			noCalendar: true,
			// See https://flatpickr.js.org/formatting/
			dateFormat: 'h:i K',
			// time_24hr: false,
		})
	}

	node.flatpickr(option);
}

function setCleave(node) {
	if(node.classList.contains('cleave-hp')) {
		new Cleave(node, {
			phone: true,
			delimiter: '-',
			phoneRegionCode: 'KR'
		});
	}else if(node.classList.contains('cleave-fulldate')) {
		new Cleave(node, {
			date: true,
			delimiter: '-',
			datePattern: ['Y', 'm', 'd']
		});
	}else if(node.classList.contains('cleave-year')) {
		new Cleave(node, {
			date: true,
			datePattern: ['Y']
		});
	}else if(node.classList.contains('cleave-month')) {
		new Cleave(node, {
			date: true,
			datePattern: ['m']
		});
	}else if(node.classList.contains('cleave-date')) {
		new Cleave(node, {
			date: true,
			datePattern: ['d']
		});
	}else if(node.classList.contains('cleave-time')) {
		new Cleave(node, {
			time: true,
			timePattern: ['h', 'm']
		});
	}else if(node.classList.contains('cleave-hour')) {
		new Cleave(node, {
			time: true,
			timePattern: ['h']
		});
	}else if(node.classList.contains('cleave-minute')) {
		new Cleave(node, {
			time: true,
			timePattern: ['m']
		});
	}else if(node.classList.contains('form-input_text-cleave-version')) {
		new Cleave(node, {
			delimiter: '.',
			blocks: [1, 1, 1],
			uppercase: false,
			numericOnly: true
		});
	}
}
