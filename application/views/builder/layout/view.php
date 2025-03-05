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
		<?php builder_view("$platformName/layout/view_{$viewType}"); ?>
	</div>
	<?php if($isComments): ?>
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
	<?php endif; ?>
</div>
