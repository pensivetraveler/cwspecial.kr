<!-- Basic Layout -->
<div class="row g-6 mb-6">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb"><?=get_admin_breadcrumbs($titleList)?></ol>
	</nav>
</div>
<div class="row g-6 mb-6">
	<div class="card mb-6">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h5 class="mb-0"><?=lang('nav.'.$titleList[1])?> 등록</h5>
		</div>
		<div class="card-body">
			<?php
				echo form_open_multipart('', [
						'id' => 'formRecord',
						'class' => "add-new-record needs-validation form-type-page",
						'onsubmit' => 'return false',
				], [
						'_mode' => $this->router->method,
						'_event' => '',
				]);
			?>
			<div class="row">
				<div class="col-lg-6">
					<div class="h-100 border rounded-2">
						<div class="dz-message needsclick">
							Drop files here or click to upload
							<span class="note needsclick"
							>(This is just a demo dropzone. Selected files are
                            <span class="fw-medium">not</span> actually uploaded.)</span
							>
						</div>
						<div class="fallback">
							<input name="file" type="file" />
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row mb-4 form-validation-unit">
						<div class="col-sm-2">
							<label for="">제목</label>
						</div>
						<div class="col-sm-10">

						</div>
					</div>
					<div class="row form-validation-unit">
						<div class="col-sm-2">
							<label for="">설명</label>
						</div>
						<div class="col-sm-10">

						</div>
					</div>
				</div>
			</div>
			<?php
				echo form_close();
			?>
		</div>
	</div>
</div>
