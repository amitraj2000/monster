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
function get_product_status(){
	$status=array(
		1=>'Pending',
		2=>'Order submission completed',
		3=>'Initiated',
		4=>'Shipping kit sent',
		5=>'Reship request',
		6=>'Inbound tracking activated',
		7=>'Inbound tracking delivered',
		8=>'Received',
		9=>'Passed inspection',
		10=>'Requoted',
		11=>'Seller action required',
		12=>'Requote accepted',
		13=>'Requote declined',
		14=>'Requote expired',
		15=>'Seller action completed',
		16=>'Seller action failed',
		17=>'Check payment initiated',
		18=>'Paypal payment initiated',
		19=>'Paid',
		20=>'Recycled',
		21=>'Returned',
	);
	
	
	return $status;
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
		$status='Paid';
		break;
		case '20':
		$status='Recycled';
		break;
		case '21':
		$status='Returned';
		break;
		
	}
	return $status;
}
?>