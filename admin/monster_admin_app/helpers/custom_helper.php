<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
    function is_logged_in()
    {
		$CI =&get_instance();
		$logged_in=$CI->session->userdata('logged_in');
		$user_id=$CI->session->userdata('user_id');
        if(!empty($logged_in) && !empty($user_id))
			return true;
		else
			return false;
    }   
}
?>