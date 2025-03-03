<?php
	extract(trans_formdata_dit_type($formData));
?>
<div class="row mt-12">
	<div class="col-md-12 mb-6">
		<div class="hero-text-box text-center">
			<h2 class="text-primary hero-title fs-2">SIGN-UP</h2>
			<h3 class="mb-5 text-center">로그인</h3>
		</div>
	</div>
	<div class="col-md-12">
		<?php
			echo form_open('', [
					'id' => 'formAuth',
					'class' => "needs-validation form-type-page",
					'onsubmit' => 'return false',
			], [
					'_mode' => 'add',
			        '_event' => '',
			]);
			echo form_input(
					[
							'type' => $user_cd['type'],
							'name' => $user_cd['field'],
							'id' => $user_cd['id'],
					],
					set_admin_form_value($user_cd['field'], $user_cd['default'], null),
					$user_cd['attributes'],
			);
		?>
		<div class="card mb-6">
			<h5 class="card-header">1. 기본 인적 사항</h5>
			<div class="card-body">
				<?php builder_view("admin/layout/form_{$formType}_custom_unique", ['item' => $code]); ?>
				<div class="row mb-4 form-validation-unit">
					<?=form_label(lang($grade['label']), $grade['id'], ['class' => 'col-sm-2 col-form-label'])?>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<?php
							echo get_admin_form_ico($grade);
							echo form_dropdown(
									$grade['field'],
									$grade['options'] ?? [],
									set_admin_form_value($grade['field'], $grade['default'], null),
									array_merge([
											'id' => $grade['id'],
											'data-style' => 'btn-default'
									], $grade['attributes'])
							);
							?>
						</div>
						<?=get_admin_form_text($grade)?>
					</div>
				</div>
				<div class="row mb-4 form-validation-unit">
					<?=form_label(lang($name['label']), $name['id'], ['class' => 'col-sm-2 col-form-label'])?>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<?php
							echo get_admin_form_ico($name);
							echo form_input(
									[
											'type' => $name['type'],
											'name' => $name['field'],
											'id' => $name['id'],
									],
									set_admin_form_value($name['field'], $name['default'], null),
									$name['attributes']
							);
							?>
						</div>
						<?=get_admin_form_text($name)?>
					</div>
				</div>
				<div class="row mb-4 form-validation-unit">
					<?=form_label(lang($tel['label']), $tel['id'], ['class' => 'col-sm-2 col-form-label'])?>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<?php
							echo get_admin_form_ico($tel);
							echo form_input(
									[
											'type' => $tel['type'],
											'name' => $tel['field'],
											'id' => $tel['id'],
									],
									set_admin_form_value($tel['field'], $tel['default'], null),
									$tel['attributes']
							);
							?>
						</div>
						<?=get_admin_form_text($tel)?>
					</div>
				</div>
				<div class="row form-validation-unit">
					<?=form_label(lang($disabilities_yn['label']), $disabilities_yn['id'], ['class' => 'col-sm-2 col-form-label'])?>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<?php
							echo get_admin_form_choice($disabilities_yn, $formType);
							?>
						</div>
						<?=get_admin_form_text($disabilities_yn)?>
					</div>
				</div>
				<div class="row form-validation-unit">
					<?=form_label(lang($aac_yn['label']), $aac_yn['id'], ['class' => 'col-sm-2 col-form-label'])?>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<?php
							echo get_admin_form_choice($aac_yn, $formType);
							?>
						</div>
						<?=get_admin_form_text($aac_yn)?>
					</div>
				</div>

			</div>
		</div>
		<div class="card mb-6">
			<h5 class="card-header">2. 사이트 이용 정보</h5>
			<div class="card-body">
				<?php builder_view("$platformName/layout/form_{$formType}_custom_unique", ['item' => $id]); ?>
				<?php builder_view("$platformName/layout/form_{$formType}_custom_unique", ['item' => $email]); ?>
				<?php builder_view("$platformName/layout/form_{$formType}_group_".$user_password['view'], ['item' => $user_password]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-end">
				<button type="submit" class="btn btn-primary waves-effect waves-light">다음으로</button>
			</div>
		</div>
		<?php
		echo form_close();
		?>
	</div>
</div>
