<?php
if ( ! function_exists('builder_view'))
{
	function builder_view($path, $vars = array(), $return = false)
	{
		$CI = &get_instance();
		if(!file_exists(VIEWPATH.$path.'.php')) {
			$path = preg_replace('/^[^\/]+/', BUILDER_FLAGNAME, $path);
		}
		$CI->load->view($path, $vars, $return);
	}
}

if ( ! function_exists('get_yn'))
{
	function get_yn($bool): string
	{
		return $bool?'Y':'N';
	}
}

if ( ! function_exists('unravel_list'))
{
	function unravel_list($list) : array
	{
		$result = [];
		foreach ($list as $item) {
			if(is_array($item)) {
				foreach ($item as $subitem) {
					$result[] = $subitem;
				}
			}else{
				$result[] = $item;
			}
		}
		return array_values(array_unique($result));
	}
}

if ( ! function_exists('reformat_bool_type_list'))
{
	function reformat_bool_type_list($list) : array
	{
		return array_keys(array_filter($list, function ($value) {
			return $value === true || $value === 1;
		}));
	}
}
