<?php
echo form_open('', [
	'id' => 'formRecord',
	'class' => "view-record",
	'onsubmit' => 'return false',
], [
	'_mode' => 'view',
	'_event' => '',
]);
echo form_input(
	[
		'type' => $identifier['type'],
		'name' => $identifier['field'],
		'id' => $identifier['id'],
	],
	set_admin_form_value($identifier['field'], $identifier['default'], null),
	$identifier['attributes'],
);
?>
<div class="card-header">
	<div class="mb-4">
		<h5 id="subject" class="mb-0 w-100 view-data"><span></span></h5>
	</div>
	<div class="d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center text-muted">
			<i class="ri-account-circle-line me-1"></i>
			<span id="created_id" class="fw-medium text-heading view-data"></span>
		</div>
		<div class="d-flex align-items-center text-muted">
			<i class="ri-time-line me-1"></i>
			<span id="created_dt" class="fw-medium me-2 view-data"><?=date('Y-m-d')?></span>
			<i class="ri-eye-line me-1"></i>
			<span id="view_count" class="fw-medium view-data">00</span>
		</div>
	</div>
</div>
<div class="card-body">
	<div class="card shadow-none border">
		<?php if(!empty($thumbnail)): ?>
			<div class="p-4 thumbnail-wrap">
				<div id="thumbnail" class="w-100 h-px-800 rounded-2 overflow-hidden"></div>
			</div>
		<?php endif; ?>
		<div class="card-body pt-3">
			<div id="content" class="view-data"></div>
		</div>
	</div>
	<div class="row mt-4 btn-view-wrap">
		<div class="col-sm-6 text-start btn-view-wrap-left"></div>
		<div class="col-sm-6 text-end btn-view-wrap-right">
			<?php foreach ($actions as $action): ?>
			<button type="button" class="btn btn-outline-primary w-px-150 btn-view-<?=$action?>"><?=lang(ucfirst($action))?></button>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
echo form_close();
?>
