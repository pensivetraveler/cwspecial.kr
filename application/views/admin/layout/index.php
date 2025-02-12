<?php if(!isset($includes)) $includes = $this->config->config['admin_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) $this->_view('admin/includes/head'); ?>
<?php if($includes['header']) $this->_view('admin/includes/header'); ?>
<?php if($includes['modalPrepend']) $this->_view('admin/includes/modal_prepend'); ?>
<?php if(isset($subPage)) $this->_view($subPage); ?>
<?php if($includes['modalAppend']) $this->_view('admin/includes/modal_append'); ?>
<?php if($includes['footer']) $this->_view('admin/includes/footer'); ?>
<?php if($includes['tail']) $this->_view('admin/includes/tail'); ?>
