<?php if(!isset($includes)) $includes = $this->config->config['admin_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) _view('builder/includes/head'); ?>
<?php if($includes['header']) _view('builder/includes/header'); ?>
<?php if($includes['modalPrepend']) _view('builder/includes/modal_prepend'); ?>
<?php if(isset($subPage)) _view($subPage); ?>
<?php if($includes['modalAppend']) _view('builder/includes/modal_append'); ?>
<?php if($includes['footer']) _view('builder/includes/footer'); ?>
<?php if($includes['tail']) _view('builder/includes/tail'); ?>
