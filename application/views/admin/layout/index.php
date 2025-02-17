<?php if(!isset($includes)) $includes = $this->config->config['admin_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) _view('admin/includes/head'); ?>
<?php if($includes['header']) _view('admin/includes/header'); ?>
<?php if($includes['modalPrepend']) _view('admin/includes/modal_prepend'); ?>
<?php if(isset($subPage)) _view($subPage); ?>
<?php if($includes['modalAppend']) _view('admin/includes/modal_append'); ?>
<?php if($includes['footer']) _view('admin/includes/footer'); ?>
<?php if($includes['tail']) _view('admin/includes/tail'); ?>
