'use strict';

let fv, offCanvasEl;

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;

    if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
    } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
    }

    // Variable declaration for table
    var dt_table = $('.datatables-records'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    // Datatable
    if(!dt_table.length) throw new Error(`dt_table is not defined!`);
    if(!common.LIST_COLUMNS.length) throw new Error(`check common LIST_COLUMNS.`);
    if(dt_table.find('thead th').length !== common.LIST_COLUMNS.length+2)
        throw new Error(`th and LIST_COLUMNS length are not matched.`);

    var dt = dt_table.DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax: getAjaxOptions({
            url: common.API_URI,
            headers: {
                'Authorization' : common.HOOK_PHPTOJS_VAR_TOKEN,
            },
            data: function(data) {
                const req = {
                    ...common.API_PARAMS,
                    ...{
                        format: 'datatable',
                        draw: data.draw,
                        pageNo: Math.floor(data.start / data.length) ,
                        limit: data.length,
                        searchWord: data.search.value || '',
                        searchCategory: data.search.category || '',
                    }
                };
                return req;
            },
            complete: function(data) {
                // console.log(data.responseJSON)
                // console.table(data.responseJSON.data)
            },
        }),
        columns: [
            // columns according to JSON
            { data: null },
            { data: null },
            ...common.LIST_COLUMNS.map(function (column) {
                return {
                    data : column.field,
                    title : getLocale(column.label, common.LOCALE),
                }
            }),
        ],
        columnDefs: [
            {
                // For Responsive
                className: 'control',
                searchable: false,
                orderable: false,
                responsivePriority: 2,
                targets: 0,
                render: function (data, type, full, meta) {
                    return '';
                }
            },
            {
                // For Checkboxes
                targets: 1,
                orderable: false,
                render: function () {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                },
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                }
            },
            ...common.LIST_COLUMNS.map(function (column, index) {
                switch (column.format) {
                    case 'row_num' : // Row Num
                        return {
                            targets: 2,
                            searchable: false,
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        };
                    case 'actions' : // Actions
                        return {
                            targets: 2+common.LIST_COLUMNS.length-1,
                            searchable: false,
                            orderable: false,
                            render: function (data, type, full, meta) {
                                const dataId = common.IDENTIFIER?full[common.IDENTIFIER]:'';
                                return (
                                    '<div class="d-flex align-items-center gap-50">' +
                                    `<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-bs-toggle="tooltip" title="Delete Record" data-id="${dataId}"><i class="ri-delete-bin-7-line ri-20px"></i></a>`+
                                    `<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect edit-record" title="Edit Record" data-id="${dataId}"><i class="ri-edit-box-line me-2"></i></a>` +
                                    '</div>'
                                );
                            }
                        }
                    case 'select' :
                        return {
                            targets: 2+index,
                            searchable: false,
                            orderable: false,
                            render: renderSelectColumn,
                        }
                    default :
                        return {
                            targets: 2+index,
                            render: function (data, type, full, meta) {
                                if(column.render && column.render.callback && typeof window[`${column.render.callback}`] !== 'function'){
                                    console.warn(`DataTable : '${column.render.callback}' render function is not defined.`);
                                }

                                if(column.render && column.render.callback && typeof window[`${column.render.callback}`] === 'function') {
                                    // callback 이 정의되어있을 경우
                                    return window[column.render.callback](data, type, full, meta, column, column.render.params??null);
                                }else if(typeof window[`renderColumn${pascalize(column.field)}`] === 'function') {
                                    // page 별 custom js 파일에 render func 가 정의된 경우
                                    return window[`renderColumn${pascalize(column.field)}`](data, type, full, meta, column);
                                }else {
                                    // if(column.format === 'button') {
                                    //     return renderButtonColumn(data, type, full, meta, column);
                                    // }else if{
                                    // if(full[column.field]) {
                                        return renderColumn(data, type, full, meta, column);
                                    // }else{
                                    //     console.warn(`dtTable : ${column.field} data is missing !!`);return '-';
                                    // }
                                }
                            }
                        };
                }
            }),
        ],
        order: [[2, 'desc']],
        dom:
            '<"row"' +
            '<"col-md-2 d-flex align-items-center justify-content-md-start justify-content-center"<"dt-action-buttons mt-5 mt-md-0"B>>' +
            '<"col-md-10"<"d-flex align-items-center justify-content-md-end justify-content-center"<"me-4"f><"add-record">>>' +
            '>t' +
            '<"row"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: 'Show _MENU_',
            search: '',
            searchPlaceholder: getLocale('Search', common.LOCALE),
        },
        // Buttons with Dropdown
        buttons: [
            {
                extend: 'collection',
                className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                text: `<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">${getLocale('Export', common.LOCALE)}</span>`,
                buttons: [
                    {
                        extend: 'print',
                        text: `<i class="ri-printer-line me-1" ></i>${getLocale('Print', common.LOCALE)}`,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7],
                            // prevent avatar to be display
                            format: {
                                body: function (inner, coldex, rowdex) {
                                    if (inner.length <= 0) return inner;
                                    var el = $.parseHTML(inner);
                                    var result = '';
                                    $.each(el, function (index, item) {
                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                            result = result + item.lastChild.firstChild.textContent;
                                        } else if (item.innerText === undefined) {
                                            result = result + item.textContent;
                                        } else result = result + item.innerText;
                                    });
                                    return result;
                                }
                            }
                        },
                        customize: function (win) {
                            //customize print view for dark
                            $(win.document.body)
                                .css('color', config.colors.headingColor)
                                .css('border-color', config.colors.borderColor)
                                .css('background-color', config.colors.bodyBg);
                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('color', 'inherit')
                                .css('border-color', 'inherit')
                                .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'excel',
                        text: `<i class="ri-file-excel-line me-1"></i>${getLocale('Excel', common.LOCALE)}`,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7],
                            // prevent avatar to be display
                            format: {
                                body: function (inner, coldex, rowdex) {
                                    if (inner.length <= 0) return inner;
                                    var el = $.parseHTML(inner);
                                    var result = '';
                                    $.each(el, function (index, item) {
                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                            result = result + item.lastChild.firstChild.textContent;
                                        } else if (item.innerText === undefined) {
                                            result = result + item.textContent;
                                        } else result = result + item.innerText;
                                    });
                                    return result;
                                }
                            }
                        }
                    },
                ]
            },
        ],
        // For responsive popup
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        return 'Details of ' + common.TITLE;
                    }
                }),
                type: 'column',
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                        return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                            ? '<tr data-dt-row="' +
                            col.rowIndex +
                            '" data-dt-column="' +
                            col.columnIndex +
                            '">' +
                            '<td>' +
                            col.title +
                            ':' +
                            '</td> ' +
                            '<td>' +
                            col.data +
                            '</td>' +
                            '</tr>'
                            : '';
                    }).join('');

                    return data ? $('<table class="table"/><tbody />').append(data) : false;
                }
            }
        },
        preDrawCallback: function(settings) {
            // console.log('preDrawCallback', settings)
            // $('<div class="loading">Loading</div>').appendTo('body');
        },
        initComplete: function (settings, json) {
            // ajax 옵션을 사용해서 테이블이 완전히 초기화되고 데이터가 로드되고 그려지는 시점
            // console.log('initComplete', settings);
            // $('div.loading').remove();
        },
        drawCallback: function(settings) {
            // console.log('drawCallback', settings)
            // 테이블의 draw 이벤트가 발생할 때마다 취해야 하는 action 을 실행
        }
    });

    $('.add-record').html(
        `<button class='btn btn-primary waves-effect waves-light'>
            <i class='ri-add-line me-0 me-sm-1 d-inline-block d-sm-none'></i>
            <span className='d-none d-sm-inline-block'>${getLocale('Add New Record', common.LOCALE)}</span>
        </button>`
    );

    // To open offCanvas, to add new record
    $('.dataTables_wrapper').on('click', '.add-record', function() {
        if(!common.SIDE_FORM && common.ADD_VIEW_URI.length) {
            location.href = common.ADD_VIEW_URI;
        }else{
            readyFrmInputs(formRecord, 'add', common.FORM_DATA);
        }
    });

    $('.dataTables_wrapper').on('click', '.detail-record', function() {
        if(!common.IDENTIFIER) throw new Error(`Identifier is not defined`);
        location.href = common.DETAIL_VIEW_URI + '/' + $(this).data('id');
    });

    $('.dataTables_wrapper').on('click', '.edit-record', function() {
        if(!common.IDENTIFIER) throw new Error(`Identifier is not defined`);
        if(!common.SIDE_FORM && common.EDIT_VIEW_URI.length) {
            location.href = common.EDIT_VIEW_URI + '/' + $(this).data('id');
        }else{
            readyFrmInputs(formRecord, 'edit', common.FORM_DATA);
            fetchFrmValues(document.getElementById('formRecord'), $(this).data('id'));
        }
    });

    $('.dataTables_wrapper tbody').on('click', '.delete-record', function () {
        if(!common.IDENTIFIER) throw new Error(`Identifier is not defined`);

        const id = $(this).data('id');
        Swal.fire({
            title: getLocale('Do you really want to delete?', common.LOCALE),
            text: getLocale('You can\'t undo this action', common.LOCALE),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: getLocale('delete', common.LOCALE),
            cancelButtonText: getLocale('cancel', common.LOCALE),
            customClass: {
                confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                cancelButton: 'btn btn-outline-secondary waves-effect'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                executeAjax({
                    url: common.API_URI + '/' + id,
                    method: 'delete',
                    after : {
                        callback: showAlert,
                        params: {
                            type: 'success',
                            title: 'Complete',
                            text: 'Delete Completed',
                            callback: dt.ajax.reload,
                            params: [null, false]
                        },
                    }
                });
            }
        });
    });

    if(common.SIDE_FORM) {
        const offCanvasElement = document.querySelector('#offcanvasRecord'),
            formRecord = document.getElementById('formRecord');

        if(offCanvasElement === null) throw new Error(`offCanvasElement is not exist`);
        if(formRecord === null) throw new Error(`formRecord is not exist`);

        offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);

        // Define Events of offCanvas
        offCanvasElement.addEventListener('show.bs.offcanvas', function(e) {
            console.log('offcanvas show');
            refreshPlugins();
        });

        offCanvasElement.addEventListener('shown.bs.offcanvas', function(e) {
            console.log('offcanvas shown');
        });

        offCanvasElement.addEventListener('hide.bs.offcanvas', function(e) {
            // console.log('offcanvas hide');
        });

        offCanvasElement.addEventListener('hidden.bs.offcanvas', function(e) {
            initializeForm();
            fv.resetForm(true);

            if ($('[data-repeater-item]').length) {
                $('[data-repeater-item]').each(function (i, v) {
                    if(i > 0) $(v).remove();
                });
            }
        });

        formRecord.addEventListener('readyFrmInputs', (e) => {
            offCanvasEl.show();
        });

        formRecord.addEventListener("fetchFrmValues", (e) => {
            readyFrmInputs(formRecord, 'edit', common.FORM_DATA);
            applyFrmValues(formRecord, record, common.FORM_DATA);
            refreshPlugins();
            offCanvasEl.show();
        });

        for(const rule of Object.keys(customValidatorsPreset.validators))
            FormValidation.validators[rule] = customValidatorsPreset.validators[rule];

        // Form validation for Add new record
        fv = FormValidation.formValidation(
            formRecord,
            {
                fields: reformatFormData(formRecord, common.FORM_DATA, common.FORM_REGEXP, true),
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: '',
                        rowSelector: function(field, ele) {
                            switch (field) {
                                default:
                                    return '.form-validation-row';
                            }
                        },
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // submit button의 type을 submit으로 원할 경우
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        //* Move the error message out of the `input-group` element
                        if (e.element.parentElement.classList.contains('input-group')) {
                            // `e.field`: The field name
                            // `e.messageElement`: The message element
                            // `e.element`: The field element
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }
        ).on('plugins.message.displayed', function (event) {
            // e.messageElement presents the error message element
        }).on('core.field.init', function(event) {
            // When a field is initialized, bind the input event to it
            var field = event.field;
            var element = event.elements[0];  // The field element
            element.addEventListener('change', function() {
                // Revalidate field when flatpickr
                if(element.classList.contains('.form-input_date-flatpickr')) fv.revalidateField(field);
                // Revalidate field whenever input changes
                // e.fv.revalidateField(field);
            });
        }).on('core.form.validating', function(event) {
            // 유효성 검사 시작 전
            console.log('%c The form validation has started.', 'color: green')
        }).on('core.validator.validating', function(event) {
            // 특정 요소에 대한 유효성 검사 시작 전
            console.log('%c Validator for the field ' + event.field + ' is validating.', 'color: skyblue');
            if(event.element.hasAttribute('data-textarea-id')) {
                if(textareaId = event.element.getAttribute('data-textarea-id'))
                    event.element.value = editors[`${textareaId}`].root.innerHTML;
            }
        }).on('core.validator.validated', function(event) {
            // 특정 요소에 대한 유효성 검사 시작 후
            console.log('%c Validator for the field ' + event.field + ' is validated.', 'color: skyblue');
            if(!event.result.valid) {
                console.log('------------------------------------------------------------');
                console.log('%c Validator for the field ' + event.field + ' is invalid.', 'color: red');
                console.log('Invalid validator:', event.validator);
                console.log('Invalid field:', event.field);
                console.log('Error message:', event.result.message);
                console.log('------------------------------------------------------------');
            }
        }).on('core.form.valid', function(event) {
            // 유효성 검사 완료 후
            updateFormLifeCycle('checkFrmValues', formRecord);

            // Send the form data to back-end
            // You need to grab the form data and create an Ajax request to send them
            submitAjax('#formRecord', {
                success: function(response) {
                    console.log(response)
                    showAlert({
                        type: 'success',
                        title: 'Complete',
                        text: formRecord.mode.value === 'edit' ? 'Your Data Is Updated' : 'Registered Successfully',
                        callback: dt.ajax.reload,
                        params: [null, false]
                    });
                    updateFormLifeCycle('transFrmValues', formRecord);
                    offCanvasEl.hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.warn(jqXHR.responseJSON)
                    if(jqXHR.status === 422) {
                        jqXHR.responseJSON.errors.forEach(error => {
                            if(fv.fields.hasOwnProperty(error.param)) {
                                fv.updateFieldStatus(error.param, 'Invalid', 'notEmpty');
                                fv.updateMessage(error.name, 'notEmpty', error.message);
                            }
                        });
                    }else{
                        showAlert({
                            type: 'warning',
                            text: jqXHR.responseJSON.msg,
                        });
                    }
                }
            });
        }).on('core.form.invalid', function () {
            // if fields are invalid
            console.log('core.form.invalid')
        });
    }
});

function renderColumn(data, type, full, meta, column) {
    let wrap;
    switch (column.format) {
        case 'button':
            wrap = document.createElement('button');
            wrap.classList.add('btn', 'btn-info', 'waves-effect', 'waves-light', 'pe-3', 'ps-3');
            break;
        case 'text':
        case 'icon':
        case 'img':
        default :
            wrap = document.createElement('span');
            wrap.classList.add('d-inline-block')
            break;
    }

    // class
    if(column.classes.length)
        for(const className of classed) wrap.classList.add(className);

    // inner
    let inner;
    if(['recent_dt', 'created_dt', 'updated_dt'].includes(column.field)) {
        const dateObj = new Date(data);
        inner = dateObj.getFullYear().toString() + '-' + (dateObj.getMonth()+1).toString().padStart(2, '0') + '-' + dateObj.getDate().toString().padStart(2, '0');
    }else{
        if(column.onclick.hasOwnProperty('kind')
            && column.onclick.kind === 'download'
            && !column.text
        ) {
            column.text = 'Download';
        }

        switch (column.format) {
            case 'text':
                inner = column.text?getLocale(column.text, common.LOCALE):data;
                break;
            case 'button':
                if(['popup', 'redirect', 'download'].includes(column.onclick.kind) && (data === null || data.length === 0))
                    return '-';
                inner = column.text?getLocale(column.text, common.LOCALE):getLocale(column.field, common.LOCALE);
                break;
            case 'icon':
                inner = `<i class="${column.icon}"></i>`;
                break;
            case 'img':
                if(data === null || !data.length || !data[0].hasOwnProperty('file_link')) return '-';
                inner = `<img class="img-thumbnail d-inline rounded-2 overflow-hidden" src="${data[0].file_link}">`;
                wrap.setAttribute('data-bs-content', inner);
                break;
            case 'select':
                break;
            default :
                inner = '-';
        }
    }

    // return
    if(isArray(full[column.field])) {
        const html = full[column.field].reduce((acc, curr) => {
            return acc += renderColumnHTML(curr, full, column, wrap, inner);
        }, '');
        return `<div>${html}</div>`;
    }else{
        return renderColumnHTML(data, full, column, wrap, inner);
    }
}

function renderColumnHTML(data, full, column, wrap, inner) {
    // attrs
    let value;
    if(data === undefined) {
        value = '';
    }else{
        value = typeof data === 'object'?JSON.stringify(data):data;
    }

    const attrs = {
        ...Object.fromEntries(
            Object.entries({
                identifier : full[common.IDENTIFIER],
                value : value,
            }).map(([key, value]) => [`data-${key}`, value])
        )
    };

    if(Object.keys(column.onclick).length) {
        wrap.classList.add('cursor-pointer');
        attrs.onclick = getColumnOnclick(data, full, column);
        if(column.onclick.kind === 'bs') {
            if(Object.keys(column.onclick.attrs).length) {
                Object.entries(column.onclick.attrs).map(([key, value]) => attrs[`data-bs-${key}`] = value )
            }
        }
    }

    Object.entries(attrs).map(([key, value]) => wrap.setAttribute(key, value));

    // return
    wrap.innerHTML = inner;
    return wrap.outerHTML;
}

function renderSelectColumn(data, type, full, meta, column) {
    wrap = document.createElement('div');
    wrap.classList.add('bootstrap-select');
}

function renderButtonColumn(data, type, full, meta, column) {
    const wrap = document.createElement('button');
    wrap.classList.add('btn', 'btn-info', 'waves-effect', 'waves-light', 'pe-3', 'ps-3');

    // class
    if(column.classes.length)
        for(const className of classed) wrap.classList.add(className);

    if(column.onclick.hasOwnProperty('kind')
        && column.onclick.kind === 'download'
        && !column.text
    ) {
        column.text = 'Download';
    }

    const inner = column.text?getLocale(column.text, common.LOCALE):getLocale(column.field, common.LOCALE);

    // return
    if(isArray(full[column.field])) {
        const html = full[column.field].reduce((acc, curr) => {
            return acc += renderColumnHTML(curr, full, column, wrap, inner);
        }, '');
        return `<div>${html}</div>`;
    }else{
        return renderColumnHTML(data, full, column, wrap, inner);
    }
}

function getColumnOnclick(data, full, column) {
    let onClick = '';
    if(column.hasOwnProperty('onClick') || column.hasOwnProperty('onclick')) {
        const key = column.hasOwnProperty('onClick')?'onClick':'onclick';
        if(!column[key].kind) throw new Error(`getColumnOnclick : onclick kind is not defined. (${column.field})`);

        switch (column[key].kind) {
            case 'popup' :
                break;
            case 'redirect' :
                if(column[key].hasOwnProperty('params') && column[key].attrs.hasOwnProperty('target'))
                    if(column[key].attrs.target === '_blank') return `window.open('${data}', "_blank")`;
                return `location.href="${data}"`;
            case 'download' :
                if(data === null || !data.file_id) return '';
                return `location.href="${common.CURRENT_URI}/downloader/${data.file_id}"`;
            case 'bs' :
                break;
            default :
                if(window[column[key].kind] === undefined) return '';

                let params = 'null';
                if(column[key].params) {
                    if(typeof column[key].params === 'object') {
                        if(
                            (Array.isArray(column[key].params) && column[key].params.length)
                            ||
                            (!Array.isArray(column[key].params) && Object.keys(column[key].params).length)
                        ){
                            params = JSON.stringify(column[key].params);
                        }
                    }else{
                        params = typeof column[key].params != "string"?column[key].params:`'${column[key].params}'`;
                    }
                }
                return `${column[key].kind}(this, ${params})`;
        }
    }
    return onClick;
}