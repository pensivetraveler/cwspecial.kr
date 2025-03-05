<?php
extract(trans_formdata_dit_type($viewData));
?>
<!-- Basic Layout -->
<div class="row g-6 mb-6">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb"><?=get_admin_breadcrumbs($titleList)?></ol>
	</nav>
</div>
<div class="row g-6 mb-6" id="view-container">
	<div class="card mb-2">
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
			<div class="row">
				<div class="col-sm-6 p-2">
					<div class="border rounded-2 p-4">
						<div class="thumbnail-wrap">
							<div id="thumbnail" class="w-100 h-px-600 rounded-2 overflow-hidden"></div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 p-2">
					<div class="h-100 border rounded-2 p-4 view-data" id="content">
					</div>
				</div>
			</div>
			<div class="row mt-4 btn-wrap">
				<div class="col-sm-6 text-start btn-wrap-left">
					<button type="button" class="btn btn-sm btn-dribbble w-px-150 me-4 btn-pref btn-pref-001" data-pref-cd="001">좋아요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref001Cnt">0</span></button>
					<button type="button" class="btn btn-sm btn-linkedin w-px-150 me-4 btn-pref btn-pref-002" data-pref-cd="002">그저 그래요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref002Cnt">0</span></button>
					<button type="button" class="btn btn-sm btn-dark w-px-150 btn-pref btn-pref-003" data-pref-cd="003">별로에요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref003Cnt">0</span></button>
				</div>
				<div class="col-sm-6 text-end btn-wrap-right">
					<button type="button" class="btn btn-outline-primary w-px-150 btn-view-list"><?=lang('List')?></button>
				</div>
			</div>
		</div>
		<?php
			echo form_close();
		?>
	</div>
	<div class="card" id="comment-container">
		<div class="card-header">
			<?php
			echo form_open('', [
				'id' => 'formComment',
				'class' => "needs-validation",
				'onsubmit' => 'return false',
			], [
				'_mode' => 'add',
				'_event' => '',
			]);
			echo form_hidden('comment_id');
			echo form_hidden('depth');
			echo form_hidden('parent_id', 0);
			echo form_hidden('article_id', set_admin_form_value($identifier['field'], $identifier['default'], null));
			?>
			<div class="mb-4">
				<h6 class="mb-0"><?=lang('Comments')?></h6>
			</div>
			<div class="row form-validation-unit">
				<div class="target-comment-wrap" data-loaded="false">
					<div class="d-flex justify-content-between rounded-2">
						<p class="m-0">'<span id="target-comment-content"></span>'에 대한 <span id="target-comment-action"></span></p>
						<button type="button" class="btn btn-dark rounded-circle p-0 w-px-20 h-px-20 btn-write-cancel">x</button>
					</div>
				</div>
				<div class="d-flex justify-content-between">
					<input type="text" class="form-control me-4" placeholder="댓글 입력" name="content" required="required">
					<button class="btn btn-primary w-px-100"><?=lang('Submit')?></button>
				</div>
			</div>
			<?php
			echo form_close();
			?>
		</div>
		<div class="card-body">
			<ul class="border rounded-4 py-2 px-6 list-unstyled mb-0" id="comment-list"></ul>
		</div>
	</div>
</div>
