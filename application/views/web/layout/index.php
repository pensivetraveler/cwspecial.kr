<?php if(!isset($includes)) $includes = $this->config->config['web_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) $this->load->view('web/includes/head'); ?>
<?php if($includes['header']) $this->load->view('web/includes/header'); ?>
<?php if($includes['modalPrepend']) $this->load->view('web/includes/modal_prepend'); ?>
<?php $this->load->view($subPage); ?>
<?php if($includes['modalAppend']) $this->load->view('web/includes/modal_append'); ?>
<?php if($includes['footer']) $this->load->view('web/includes/footer'); ?>
<?php if($includes['tail']) $this->load->view('web/includes/tail'); ?>
