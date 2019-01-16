<?php

add_action('wp_login', 'update_login_LT');

/* Update your last time when login */
function update_login_LT($login) {
	$user = get_userdatabylogin($login);
	$set_time_CT = get_user_meta(	$user->ID , 'persent_time_LT', true);
	/* Once user will get login then update values */
	if(!empty($set_time_CT)){
		update_usermeta( $user->ID, 'final_time_LT', $set_time_CT );
		update_usermeta( $user->ID, 'persent_time_LT', current_time('mysql') );
	}else {
		update_usermeta( $user->ID, 'persent_time_LT', current_time('mysql') );
		update_usermeta( $user->ID, 'final_time_LT', current_time('mysql') );
	}
}

function login_time_LG($user_id) {
   $final_time_LT = get_user_meta($user_id, 'final_time_LT', true);

   $date_format = get_option('date_format') . ' ' . get_option('time_format');

   
	if(wp_is_mobile()) {
		$get_time_FT = date("M j, y, g:i a", strtotime($last_login));  
	}else {
		$get_time_FT = mysql2date($date_format, $last_login, false);
	}
   return $get_time_FT;
}

?>
