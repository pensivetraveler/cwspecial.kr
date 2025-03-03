<div class="position-relative">
	<div class="h-px-800 d-flex flex-column justify-content-center">
		<div class="hero-text-box text-center">
			<h2 class="text-primary hero-title fs-2 font-gaeulsopung-b">우리의 작업물을 사용할<br>그 누군가를 상상하며</h2>
			<h5 class="mb-8 font-santteutdotum-m">
				창원대학교 특수교육과 AAC 제작팀
			</h5>
		</div>

		<div class="w-px-600 mt-1 mx-auto">
			<h3 class="mb-5 text-center font-SFssaraknoon">로그인</h3>
			<?php
			echo form_open('', [
					'id' => 'formAuth',
					'class' => "needs-validation form-type-page",
					'onsubmit' => 'return false',
			], []);
			?>
			<div class="col-sm-12 form-validation-unit">
				<div class="input-group input-group-merge bg-white">
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
				<div class="input-group input-group-merge form-password-toggle bg-white">
					<div class="form-floating form-floating-outline">
						<?php
						echo form_password(
								[
										'name' => $formData[1]['field'],
										'id' => $formData[1]['id'],
								],
								set_admin_form_value($formData[1]['field'], $formData[1]['default'], null),
								$formData[1]['attributes']
						);
						echo form_label(lang($formData[1]['label']), $formData[1]['id']);
						?>
					</div>
					<span class="input-group-text cursor-pointer">
					<i class="ri-eye-off-line"></i>
				</span>
				</div>
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<button class="btn btn-outline-primary d-grid w-px-150 bg-white" type="button" onclick="redirect('/auth/findId')">ID/PW 찾기</button>
				<button class="btn btn-primary d-grid w-px-150" type="submit">로그인</button>
				<button class="btn btn-outline-primary d-grid w-px-150 bg-white" type="button" onclick="redirect('/auth/terms')">회원가입</button>
			</div>
			<?php
			echo form_close();
			?>
		</div>
	</div>
</div>
