<?php if(!isset($includes)) $includes = $this->config->config['admin_base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) $this->load->view('admin/includes/head'); ?>
<?php if($includes['header']) $this->load->view('admin/includes/header'); ?>
<?php if($includes['modalPrepend']) $this->load->view('admin/includes/modal_prepend'); ?>
<?php if(isset($subPage)) $this->load->view($subPage); ?>
<?php if($includes['modalAppend']) $this->load->view('admin/includes/modal_append'); ?>
<?php if($includes['footer']) $this->load->view('admin/includes/footer'); ?>
<?php if($includes['tail']) $this->load->view('admin/includes/tail'); ?>
