<?php if(!isset($includes)) $includes = $this->config->config['web_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) $this->_view('web/includes/head'); ?>
<?php if($includes['header']) $this->_view('web/includes/header'); ?>
<?php if($includes['modalPrepend']) $this->_view('web/includes/modal_prepend'); ?>
<?php $this->_view($subPage); ?>
<?php if($includes['modalAppend']) $this->_view('web/includes/modal_append'); ?>
<?php if($includes['footer']) $this->_view('web/includes/footer'); ?>
<?php if($includes['tail']) $this->_view('web/includes/tail'); ?>
