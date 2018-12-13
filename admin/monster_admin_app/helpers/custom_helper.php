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
function get_product_status_text($status_code){
	$status='Pending';
	switch($status_code){
		case '1':
		$status='Pending';
		break;
		case '2':
		$status='Order submission completed';
		break;
		case '3':
		$status='Initiated';
		break;
		case '4':
		$status='Shipping kit sent';
		break;
		case '5':
		$status='Reship request';
		break;
		case '6':
		$status='Inbound tracking activated';
		break;
		case '7':
		$status='Inbound tracking delivered';
		break;
		case '8':
		$status='Received';
		break;
		case '9':
		$status='Passed inspection';
		break;
		case '10':
		$status='Requated';
		break;
		case '11':
		$status='Seller action required';
		break;
		case '12':
		$status='Requote accepted';
		break;
		case '13':
		$status='Requote declined';
		break;
		case '14':
		$status='Requote expired';
		break;
		case '15':
		$status='Seller action completed';
		break;
		case '16':
		$status='Seller action failed';
		break;
		case '17':
		$status='Check payment initiated';
		break;
		case '18':
		$status='Paypal payment initiated';
		break;
		case '19':
		$status='Shipping kit sent';
		break;
		case '20':
		$status='Paid';
		break;
		case '21':
		$status='Recycled';
		break;
		case '22':
		$status='Returned';
		break;
		
	}
	return $status;
}
?>