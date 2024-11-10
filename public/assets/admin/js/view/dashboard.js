/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 *
 **/

'use strict';

let direction = 'ltr';

if (isRtl) {
	direction = 'rtl';
}

document.addEventListener('DOMContentLoaded', function () {
	(function () {
		const calendarEl = document.getElementById('calendar'),
			addEventSidebar = document.getElementById('addEventSidebar'),
			appOverlay = document.querySelector('.app-overlay'),
			offcanvasTitle = document.querySelector('.offcanvas-title'),
			btnSubmit = document.querySelector('button[type="submit"]'),
			btnDelete = document.querySelector('.btn-delete'),
			btnCancel = document.querySelector('.btn-cancel'),
			inlineCalendar = document.querySelector('.inline-calendar');

		let eventToUpdate,
			currentEvents, // Assign app-calendar-events.js file events (assume events from API) to currentEvents (browser store/object) to manage and update calender events
			isFormValid = false,
			inlineCalInstance;

		// Init event Offcanvas
		const bsAddEventSidebar = new bootstrap.Offcanvas(addEventSidebar);

		// Inline sidebar calendar (flatpickr)
		if (inlineCalendar) {
			inlineCalInstance = inlineCalendar.flatpickr({
				monthSelectorType: 'static',
				inline: true
			});
		}

		// Event click function
		function eventClick(info) {
			eventToUpdate = info.event;
			if (eventToUpdate.url) {
				info.jsEvent.preventDefault();
				window.open(eventToUpdate.url, '_blank');
			}
			readyFrmInputs(document.getElementById('formRecord'), 'edit', common.FORM_DATA);
			fetchFrmValues(document.getElementById('formRecord'), eventToUpdate.id);
		}

		// Modify sidebar toggler
		function modifyToggler() {
			const fcSidebarToggleButton = document.querySelector('.fc-toggleSidebar-button');
			const fcPrevButton = document.querySelector('.fc-prev-button');
			const fcNextButton = document.querySelector('.fc-next-button');
			const fcHeaderToolbar = document.querySelector('.fc-header-toolbar');
			fcPrevButton.classList.add('btn', 'btn-sm', 'btn-icon', 'btn-outline-secondary', 'me-2');
			fcNextButton.classList.add('btn', 'btn-sm', 'btn-icon', 'btn-outline-secondary', 'me-4');
			fcHeaderToolbar.classList.add('row-gap-4', 'gap-2');
			fcSidebarToggleButton.classList.remove('fc-button', 'fc-button-primary')
			fcSidebarToggleButton.classList.add('btn', 'btn-primary', 'btn-toggle-sidebar')
			fcSidebarToggleButton.setAttribute('data-bs-toggle', 'offcanvas');
			fcSidebarToggleButton.setAttribute('data-bs-target', '#addEventSidebar');
			fcSidebarToggleButton.setAttribute('aria-controls', 'addEventSidebar');
		}

		// --------------------------------------------------------------------------------------------------
		// AXIOS: fetchEvents
		// * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
		// --------------------------------------------------------------------------------------------------
		function fetchEvents(info, successCallback) {
			// Fetch Events from API endpoint reference
			$.ajax(
				{
					url: '/adm/adminCalendar',
					type: 'GET',
					success: function (result) {
						// Get requested calendars as Array
						console.log(result)
						console.log(result.data.map((item) => {
							return {
								id: parseInt(item.calendar_id),
								url: '',
								title: item.subject,
								start: new Date(item.start_date+' '+item.start_time),
								end: new Date(item.end_date+' '+item.end_time),
								allDay: false,
							};
						}))

						successCallback(result.data.map((item) => {
							return {
								id: parseInt(item.calendar_id),
								url: '',
								title: item.subject,
								start: new Date(item.start_date+' '+item.start_time),
								end: new Date(item.end_date+' '+item.end_time),
								allDay: false,
							};
						}));
					},
					error: function (error) {
						console.log(error);
					}
				}
			);
		}

		// Init FullCalendar
		// ------------------------------------------------
		let calendar = new Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			events: fetchEvents,
			height: 'auto',
			plugins: [dayGridPlugin, interactionPlugin],
			editable: true,
			dragScroll: true,
			dayMaxEvents: 2,
			eventResizableFromStart: true,
			customButtons: {
				toggleSidebar: {
					text: 'Add Event'
				}
			},
			headerToolbar: {
				start: 'prev, next, title',
				end: 'toggleSidebar'
			},
			direction: direction,
			initialDate: new Date(),
			navLinks: true, // can click day/week names to navigate views
			eventTimeFormat: {
				hour: '2-digit',
				minute: '2-digit',
				meridiem: true
			},
			eventClassNames: function ({ event: calendarEvent }) {
				return ['fc-event-primary'];
			},
			dateClick: function (info) {
				fetchWeeklyCalendar(info.date);
			},
			eventClick: function (info) {
				eventClick(info);
			},
			datesSet: function () {
				modifyToggler();
			},
			viewDidMount: function () {
				modifyToggler();
			}
		});

		// Render calendar
		calendar.render();
		// Modify sidebar toggler
		modifyToggler();

		const formRecord = document.getElementById('formRecord');
		const fv = FormValidation.formValidation(
			formRecord,
			{
				fields: reformatFormData(formRecord, common.FORM_DATA, common.FORM_REGEXP, true),
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						eleValidClass: '',
						rowSelector: function(field, ele) {
							switch (field) {
								default:
									return '.form-validation-unit';
							}
						},
					}),
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					// defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					autoFocus: new FormValidation.plugins.AutoFocus()
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
			})
			.on('core.form.valid', function () {
				// Jump to the next step when all fields in the current step are valid
				isFormValid = true;
			})
			.on('core.form.invalid', function () {
				// if fields are invalid
				isFormValid = false;
			});

		// Add Event
		// ------------------------------------------------
		function addEvent(eventData) {
			// ? Add new event data to current events object and refetch it to display on calender
			// ? You can write below code to AJAX call success response

			currentEvents.push(eventData);
			calendar.refetchEvents();

			// ? To add event directly to calender (won't update currentEvents object)
			// calendar.addEvent(eventData);
		}

		// Update Event
		// ------------------------------------------------
		function updateEvent(eventData) {
			// ? Update existing event data to current events object and refetch it to display on calender
			// ? You can write below code to AJAX call success response
			eventData.id = parseInt(eventData.id);
			currentEvents[currentEvents.findIndex(el => el.id === eventData.id)] = eventData; // Update event by id
			calendar.refetchEvents();
		}

		// Remove Event
		// ------------------------------------------------

		function removeEvent(eventId) {
			console.log(eventId)
			// ? Delete existing event data to current events object and refetch it to display on calender
			// ? You can write below code to AJAX call success response
			currentEvents = currentEvents.filter(function (event) {
				return event.id != eventId;
			});
			calendar.refetchEvents();

			// ? To delete event directly to calender (won't update currentEvents object)
			removeEventInCalendar(eventId);
		}

		// Remove Event In Calendar (UI Only)
		// ------------------------------------------------
		function removeEventInCalendar(eventId) {
			calendar.getEventById(eventId).remove();
		}

		// Add new event
		// ------------------------------------------------
		btnSubmit.addEventListener('click', e => {
			if (isFormValid) {
				const form = document.getElementById('formRecord');
				const url = '/adm/adminCalendar' + (form['calendar_id'].value ? '/' + form['calendar_id'].value : '');
				const data = getFormData(document.getElementById('formRecord'));

				submitAjax('#formRecord', {
					url : url,
					data : data,
					success: function(response) {
						showAlert({
							type: 'success',
							title: 'Complete',
							text: formRecord['_mode'].value === 'edit' ? 'Your Data Is Updated' : 'Registered Successfully',
						});
						updateFormLifeCycle('transFrmValues', form);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.warn(jqXHR.responseJSON)
						if(jqXHR.status === 422) {
							jqXHR.responseJSON.errors.forEach(error => {
								if(fv.fields.hasOwnProperty(error.param)) {
									fv.updateFieldStatus(error.param, 'Invalid', customValidatorsPreset.inflector(error.type));
								}
							});
						}else{
							showAlert({
								type: 'warning',
								text: jqXHR.responseJSON.msg,
							});
						}
					}
				}, true);
			}
		});

		// Call removeEvent function
		btnDelete.addEventListener('click', e => {
			console.log(e)
			// Prevent the event from bubbling up (propagation)
			e.stopPropagation();
			// Prevent the default button behavior
			e.preventDefault();

			if(!common.IDENTIFIER) throw new Error(`Identifier is not defined`);

			const id = document.getElementById('formRecord').querySelector(`[name="${common.IDENTIFIER}"]`).value;
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
						success: function(response) {
							showAlert({
								type: 'success',
								title: 'Complete',
								text: 'Delete Completed',
							});
							updateFormLifeCycle('transFrmValues', form);
						},
					});
				}
			});

			bsAddEventSidebar.hide();
		});

		// Reset event form inputs values
		// ------------------------------------------------
		function resetValues() {
			resetFrmInputs(document.getElementById('formRecord'));
		}

		function readyValues(mode, date = '') {
			readyFrmInputs(document.getElementById('formRecord'), mode, common.FORM_DATA);

			if(mode === 'add') {
				if (offcanvasTitle) offcanvasTitle.innerHTML = 'Add Event';
				btnSubmit.innerHTML = 'Add';
				btnSubmit.classList.remove('btn-update-event');
				btnSubmit.classList.add('btn-add-event');
				btnDelete.classList.add('d-none');
				btnCancel.classList.remove('d-none');
			}

			if(date) {
				document.getElementById('form_side-start_date').value = date;
				document.getElementById('form_side-end_date').value = date;
			}

			document.querySelector('.fc-toggleSidebar-button').setAttribute('inert', '');
		}

		function fetchWeeklyCalendar(dateObj) {
			const dow = dateObj.getDay();
			const startDate = moment(dateObj).subtract(dow, "days").format('YYYY-MM-DD');
			const endDate = moment(dateObj).add(6-1*dow, "days").format('YYYY-MM-DD');

			$.ajax(
				{
					url: '/adm/adminCalendar',
					type: 'GET',
					data: {
						start_date : startDate,
						end_date : endDate,
					},
					success: function (result) {
						// Get requested calendars as Array
						console.log(result)
						makeWeeklyCalnedar(result.data, startDate, endDate);
					},
					error: function (error) {
						console.log(error);
					}
				}
			);
		}

		function makeWeeklyCalnedar(eventData, startDate, endDate) {
			let idx = 1;
			let date = startDate;
			const wrapper = document.querySelector('.weekly-calendar-wrapper');
			while(date <= endDate) {
				const list = eventData.filter((item) => {
					return item.start_date === date || item.end_date === date;
				});

				const dateWrapper = wrapper.querySelector(`div.d-flex:nth-of-type(${idx})`);
				const dateTitle = dateWrapper.querySelector('.text-start>.mb-0');
				const eventList = dateWrapper.querySelector('.text-end');
				dateTitle.innerText = date.substring(8, 10);
				list.length ? dateTitle.classList.add('text-info') : dateTitle.classList.remove('text-info');

				eventList.innerHTML = '';
				for(const item of list) {
					const wrap = document.createElement('div');
					const subjectWrap = document.createElement('p');
					const timeWrap = document.createElement('small');

					subjectWrap.classList.add('mb-0', 'text-truncate', 'd-i', 'fw-bold');
					timeWrap.classList.add('text-truncate');

					subjectWrap.innerHTML = item.subject;
					let time = '';
					if(item.start_date === date) {
						time += item.start_time;
					}
					if(item.end_date === date) {
						time += ' ~ '+item.end_time;
					}else{
						time += ' ~ ';
					}
					timeWrap.innerHTML = time;

					wrap.appendChild(subjectWrap);
					wrap.appendChild(timeWrap);
					eventList.innerHTML += wrap.outerHTML;
				}

				date = moment(new Date(date)).add(1, "days").format('YYYY-MM-DD');
				idx++;
			}
		}

		// Hide left sidebar if the right sidebar is open
		$('body').on('click', '.btn-toggle-sidebar', e => {
			readyValues('add');
		});

		// When modal hides reset input values
		addEventSidebar.addEventListener('hidden.bs.offcanvas', function () {
			resetValues();
			document.querySelector('.fc-toggleSidebar-button').removeAttribute('inert');
		});

		document.getElementById('formRecord').addEventListener('transFrmValues', (e) => {
			calendar.refetchEvents();
			bsAddEventSidebar.hide();
		});

		document.getElementById('formRecord').addEventListener("fetchFrmValues", (e) => {
			const form = e.target;
			readyFrmInputs(form, 'edit', common.FORM_DATA);
			applyFrmValues(form, e.detail.record, common.FORM_DATA);
			refreshPlugins();

			bsAddEventSidebar.show();
			// For update event set offcanvas title text: Update Event
			if (offcanvasTitle) offcanvasTitle.innerHTML = 'Update Event';
			btnSubmit.innerHTML = 'Update';
			btnSubmit.classList.add('btn-update-event');
			btnSubmit.classList.remove('btn-add-event');
			btnDelete.classList.remove('d-none');
		});

		fetchWeeklyCalendar(new Date());
	})();
});

function sampling() {
	document.getElementById('form_side-subject').value = 'sample';
	document.getElementById('form_side-start_date').value = '2024-10-15';
	document.getElementById('form_side-start_time').value = '1:00 PM';
	document.getElementById('form_side-end_date').value = '2024-10-15';
	document.getElementById('form_side-end_time').value = '3:00 PM';
}
