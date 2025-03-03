<?php
extract(trans_formdata_dit_type($formData));
?>
<!-- Basic Layout -->
<div class="row g-6 mb-6">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb"><?=get_admin_breadcrumbs($titleList)?></ol>
	</nav>
</div>
<div class="row g-6 mb-6">
	<div class="card mb-6">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h5 class="mb-0"><?=lang('nav.'.$titleList[1])?> <?=lang('Registration')?></h5>
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
                echo form_input(
                    [
                        'type' => $article_id['type'],
                        'name' => $article_id['field'],
                        'id' => $article_id['id'],
                    ],
                    set_admin_form_value($article_id['field'], $article_id['default'], null),
                    $article_id['attributes'],
                );
                echo form_input(
                    [
                        'type' => $board_id['type'],
                        'name' => $board_id['field'],
                        'id' => $board_id['id'],
                    ],
                    set_admin_form_value($board_id['field'], $board_id['default'], null),
                    $board_id['attributes'],
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
			<div class="row mb-4">
				<div class="col-lg-6">
                    <?php
                    builder_view("$platformName/layout/form_{$formType}_custom_".$thumbnail['view'], ['item' => $thumbnail]);
                    ?>
				</div>
				<div class="col-lg-6">
					<div class="row mb-4 form-validation-unit">
						<div class="col-sm-12">
							<div class="input-group input-group-merge">
								<?php
									echo get_admin_form_ico($subject);
									echo form_input(
											[
													'type' => $subject['type'],
													'name' => $subject['field'],
													'id' => $subject['id'],
											],
											set_admin_form_value($subject['field'], $subject['default'], null),
											$subject['attributes']
									);
								?>
							</div>
							<?=get_admin_form_text($subject)?>
						</div>
					</div>
					<div class="row form-validation-unit">
						<div class="col-sm-12">
							<div class="input-group input-group-merge">
								<?php
									echo get_admin_form_ico($content);
									echo form_textarea(
											[
													'name' => $content['field'],
													'id' => $content['id'],
													'rows' => $content['attributes']['rows']
											],
											set_admin_form_value($content['field'], $content['default'], null),
											$content['attributes']
									);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-end">
					<button type="button" class="btn btn-outline-dark waves-effect" onclick="<?=WEB_HISTORY_BACK?>"><?=lang('List')?></button>
					<button type="button" class="btn btn-primary waves-effect waves-light btn-work-temporary"><?=lang('Temporary')?></button>
					<button type="button" class="btn btn-primary waves-effect waves-light btn-work-share"><?=lang('Share')?></button>
					<button type="button" class="btn btn-outline-danger btn-delete-event btn-delete d-none"><?=lang('Delete')?></button>
				</div>
			</div>
			<?php
				echo form_close();
			?>
		</div>
	</div>
</div>
<script>
</script>
