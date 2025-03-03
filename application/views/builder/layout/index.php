<?php if(!isset($includes)) $includes = $this->config->config['base_includes_config']; ?>
<?=doctype('html5')?>
<?php if($includes['head']) builder_view("$platformName/includes/head"); ?>
<?php if($includes['header']) builder_view("$platformName/includes/header"); ?>
<?php if($includes['modalPrepend']) builder_view("$platformName/includes/modal_prepend"); ?>
<?php if(isset($subPage)) builder_view($subPage); ?>
<?php if($includes['modalAppend']) builder_view("$platformName/includes/modal_append"); ?>
<?php if($includes['footer']) builder_view("$platformName/includes/footer"); ?>
<?php if($includes['tail']) builder_view("$platformName/includes/tail"); ?>
