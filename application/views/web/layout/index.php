<?php if(!isset($includes)) $includes = $this->config->config['web_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) _view('web/includes/head'); ?>
<?php if($includes['header']) _view('web/includes/header'); ?>
<?php if($includes['modalPrepend']) _view('web/includes/modal_prepend'); ?>
<?php if(isset($subPage)) _view($subPage); ?>
<?php if($includes['modalAppend']) _view('web/includes/modal_append'); ?>
<?php if($includes['footer']) _view('web/includes/footer'); ?>
<?php if($includes['tail']) _view('web/includes/tail'); ?>
