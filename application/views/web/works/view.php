<?php
extract(trans_formdata_dit_type($viewData));
?>
<!-- Basic Layout -->
<div class="row g-6 mb-6">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb"><?=get_admin_breadcrumbs($titleList)?></ol>
	</nav>
</div>
<div class="row g-6 position-relative" id="view-container">
	<div class="col-12 mb-lg-0 mb-6">
		<div class="card">
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
			echo form_input(
					[
							'type' => $open_yn['type'],
							'name' => $open_yn['field'],
							'id' => $open_yn['id'],
					],
					set_admin_form_value($open_yn['field'], $open_yn['default'], null),
					$open_yn['attributes'],
			);
			?>
			<div class="card-header">
				<div class="mb-4 d-flex align-items-center justify-content-between">
					<h5 id="subject" class="mb-0 w-100 view-data"><span></span></h5>
					<div class="dropdown">
						<button
								class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
								type="button"
								id="actionBtns"
								data-bs-toggle="dropdown"
								aria-haspopup="true"
								aria-expanded="false">
							<i class="ri-more-2-line ri-20px"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-end" aria-labelledby="actionBtns">
							<?php foreach ($actions as $action): ?>
								<a class="dropdown-item text-center btn-view-<?=$action?>" href="javascript:void(0);"><?=lang(ucfirst($action))?></a>
							<?php endforeach; ?>
						</div>
					</div>
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
					<div class="col-lg-4 col-sm-12">
						<div class="position-relative border rounded-2 h-px-400">
							<div id="thumbnail" class="w-100 h-100 overflow-hidden"></div>
							<p class="no-thumbnail-text">
								<span><?=lang('No Registered Thumbnail')?></span>
							</p>
						</div>
					</div>
					<div class="col-lg-8 col-sm-12">
						<div class="mt-4 mt-lg-0 border rounded-4 p-4">
							<div id="content" class="view-data"></div>
							<?php if(!empty($uploads)): ?>
								<hr>
								<ul id="uploads" class="view-data mb-0 rounded-3 mw-100 list-group list-group-flush bg-lighter p-2 mt-4 d-none"></ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row mt-4 btn-wrap">
					<div class="col-sm-12 text-end btn-wrap-left">
						<button type="button" class="btn btn-sm btn-dribbble w-px-150 me-4 btn-pref btn-pref-001" data-pref-cd="001">좋아요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref001Cnt">0</span></button>
						<button type="button" class="btn btn-sm btn-linkedin w-px-150 me-4 btn-pref btn-pref-002" data-pref-cd="002">그저 그래요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref002Cnt">0</span></button>
						<button type="button" class="btn btn-sm btn-dark w-px-150 btn-pref btn-pref-003" data-pref-cd="003">별로에요 <span class="ms-4 d-inline-block bg-white rounded-circle w-px-18 h-px-18 text-black" id="pref003Cnt">0</span></button>
					</div>
				</div>
			</div>
			<?php
			echo form_close();
			?>
		</div>
		<?php builder_view("$platformName/layout/view_comments"); ?>
	</div>
	<div id="loader" class="loading w-100 h-100 position-absolute top-0">
		<div class="opacity-50 h-100 position-relative bg-lighter"></div>
		<div class="position-absolute translate-middle" style="top:50%;left:50%">
			<div class="sk-chase sk-primary">
				<div class="sk-chase-dot"></div>
				<div class="sk-chase-dot"></div>
				<div class="sk-chase-dot"></div>
				<div class="sk-chase-dot"></div>
				<div class="sk-chase-dot"></div>
				<div class="sk-chase-dot"></div>
			</div>
		</div>
	</div>
</div>
