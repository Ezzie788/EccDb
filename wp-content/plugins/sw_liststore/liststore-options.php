<?php 
function add_field_rights2($field, $options){	
	if ( key_exists( $field['id'], array( 'show-cpanel' => '1', 'widget-advanced' => '1' )) || key_exists( $field['type'], array( 'upload' => '1' )) ) {
		return;
	}
	
	// get value from $options->options[ id ]
		
	$cpanel = array(
		'id' => $field['id'].'_cpanel_allow',
		'type' => 'checkbox',
		'title' => 'x',
		'sub_desc' => '',
			'desc' => '',
		'std' => false,
		'sub_option' => true
		);
	$options->_field_input($cpanel);
		
}
if ( is_admin() ){
	add_filter('sw-opts-rights', 'add_field_rights2', 10, 2);
}

$add_query_vars = array();
function revo_query_vars2( $qvars ){
	global $options, $add_query_vars;
	if( is_array( $options ) ) {
		foreach ($options as $option) {
			if (isset($option['fields'])) {
				
				foreach ($option['fields'] as $field) {
					$add_query_vars[] = $field['id'];
				}
			}
		}
	}
	
	if ( is_array($add_query_vars) ){
		foreach ( $add_query_vars as $field ){
			$qvars[] = $field;
		}
	}
	
	return $qvars;
}

function revo_parse_request2( &$wp ){
	global $add_query_vars, $options_args, $swg_options;
	if( function_exists( 'swg_options' ) ) {
		if ( is_array($add_query_vars) ){
			foreach ( $add_query_vars as $field ){
				if ( array_key_exists($field, $wp->query_vars) ){
					$current_value = swg_options( $field );
					$request_value = $wp->query_vars[$field];
					$field_name = $options_args['opt_name'] . '_' . $field;
					if ($request_value != $current_value){
						setcookie(
							$field_name,
							$request_value,
							time() + 86400,
							'/',
							COOKIE_DOMAIN,
							0
						);
						if (!isset($_COOKIE[$field_name]) || $request_value != $_COOKIE[$field_name]){
							$_COOKIE[$field_name] = $request_value;
						}
					}
				}
			}
		}
	}
}

if (!is_admin()){
	add_filter('query_vars', 'revo_query_vars2');
	add_action('parse_request', 'revo_parse_request2');
}