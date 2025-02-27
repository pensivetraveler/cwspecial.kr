<?php extract(trans_formdata_dit_type($formData)); ?>
<div class="position-relative">
	<div class="h-px-800 d-flex flex-column justify-content-center">
		<div class="card w-50 mx-auto py-10">
			<div class="w-px-600 mt-1 mx-auto">
				<h3 class="mb-5 text-center">내 정보에 접근하기 전<br>비밀번호를 입력해주세요.</h3>
				<?php
				echo form_open('', [
					'id' => 'formAuth',
					'class' => "needs-validation form-type-page",
					'onsubmit' => 'return false',
				], []);
				?>
				<div class="col-sm-12 form-validation-unit">
					<div class="input-group input-group-merge">
						<div class="form-floating form-floating-outline">
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-validation-unit">
					<div class="input-group input-group-merge form-password-toggle">
						<div class="form-floating form-floating-outline">
							<?php
							echo form_password(
								[
									'name' => $password['field'],
									'id' => $password['id'],
								],
								set_admin_form_value($password['field'], $password['default'], null),
								$password['attributes']
							);
							echo form_label(lang($password['label']), $password['id']);
							?>
						</div>
						<span class="input-group-text cursor-pointer">
						<i class="ri-eye-off-line"></i>
					</span>
					</div>
				</div>
				<div class="d-flex justify-content-end align-items-center">
					<button class="btn btn-primary d-grid w-px-150" type="submit">확인</button>
				</div>
				<?php
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
