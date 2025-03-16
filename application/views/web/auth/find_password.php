<div class="position-relative">
	<div class="h-px-800 d-flex align-items-center">
		<div class="w-px-400 mx-auto">
			<!-- Login -->
			<div class="card p-md-7 p-1">
				<div class="card-header p-0">
					<div class="nav-align-top">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a href="/auth/findId" class="nav-link waves-effect" role="tab">아이디 찾기</a>
							</li>
							<li class="nav-item" role="presentation">
								<a href="javascript:void(0)" class="nav-link active waves-effect" role="tab">비밀번호 찾기</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="card-body mt-1">
					<!-- Logo -->
					<div class="app-brand justify-content-center my-5">
						<a href="/" class="app-brand-link gap-2">
						<span class="app-brand-logo demo">
							<img src="<?=base_url('/public/assets/web/img/logo.png')?>" alt="" class="w-px-200">
						</span>
						</a>
					</div>
					<!-- /Logo -->

					<p class="mb-5 text-center font-SFssaraknoon">비밀번호 찾기</p>
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
		</div>
	</div>
</div>
