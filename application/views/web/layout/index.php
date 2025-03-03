<?php if(!isset($includes)) $includes = $this->config->config['web_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) builder_view('web/includes/head'); ?>
<?php if($includes['header']) builder_view('web/includes/header'); ?>
<?php if($includes['modalPrepend']) builder_view('web/includes/modal_prepend'); ?>
<?php if(isset($subPage)) builder_view($subPage); ?>
<?php if($includes['modalAppend']) builder_view('web/includes/modal_append'); ?>
<?php if($includes['footer']) builder_view('web/includes/footer'); ?>
<?php if($includes['tail']) builder_view('web/includes/tail'); ?>
