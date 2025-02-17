<div class="position-relative">
	<div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
		<div class="authentication-inner py-6">
			<!-- Login -->
			<div class="card p-md-7 p-1">
				<!-- Logo -->
				<div class="app-brand justify-content-center mt-5">
					<a href="/admin" class="app-brand-link gap-2">
						<span class="app-brand-logo demo">
							<img src="<?=base_url('/public/assets/builder/img/eduprime_logo.png')?>" alt="">
						</span>
					</a>
				</div>
				<!-- /Logo -->

		tr		<div class="card-body mt-1">
					<p class="mb-5 text-center">비밀번호 찾기</p>
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
								<?php
								echo form_input(
									[
										'type' => $formData[0]['type'],
										'name' => $formData[0]['field'],
										'id' => $formData[0]['id'],
									],
									set_admin_form_value($formData[0]['field'], $formData[0]['default'], null),
									$formData[0]['attributes']
								);
								echo form_label(lang($formData[0]['label']), $formData[0]['id']);
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-12 form-validation-unit">
						<div class="input-group input-group-merge form-password-toggle">
							<div class="form-floating form-floating-outline">
								<?php
								echo form_input(
									[
										'type' => $formData[1]['type'],
										'name' => $formData[1]['field'],
										'id' => $formData[1]['id'],
									],
									set_admin_form_value($formData[1]['field'], $formData[1]['default'], null),
									$formData[1]['attributes']
								);
								echo form_label(lang($formData[1]['label']), $formData[1]['id']);
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-12 form-validation-unit">
						<div class="input-group input-group-merge form-password-toggle">
							<div class="form-floating form-floating-outline">
								<?php
								echo form_input(
									[
										'type' => $formData[2]['type'],
										'name' => $formData[2]['field'],
										'id' => $formData[2]['id'],
									],
									set_admin_form_value($formData[2]['field'], $formData[2]['default'], null),
									$formData[2]['attributes']
								);
								echo form_label(lang($formData[2]['label']), $formData[2]['id']);
								?>
							</div>
						</div>
					</div>
					<div>
						<button class="btn btn-primary d-grid w-100" type="submit">확인</button>
					</div>
					<?php
					echo form_close();
					?>
				</div>
			</div>
			<!-- /Login -->
			<img
				alt="mask"
				src="<?=base_url('/public/assets/builder/img/illustrations/auth-basic-login-mask-light.png')?>"
				class="authentication-image d-none d-lg-block"
				data-app-light-img="illustrations/auth-basic-login-mask-light.png"
				data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
		</div>
	</div>
</div>
