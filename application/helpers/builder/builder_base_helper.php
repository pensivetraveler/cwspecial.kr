<?php
function _view($path, $vars = array(), $return = false)
{
	$CI = &get_instance();
	if(!file_exists(VIEWPATH.$path.'.php')) {
		$path = preg_replace('/^[^\/]+/', BUILDER_FLAGNAME, $path);
	}
	$CI->load->view($path, $vars, $return);
}

if ( ! function_exists('get_yn'))
{
	function get_yn($bool): string
	{
		return $bool?'Y':'N';
	}
}
