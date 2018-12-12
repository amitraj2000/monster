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
if ( ! function_exists('get_current_user_id'))
{
    function get_current_user_id()
    {
		$CI =&get_instance();
		$logged_in=$CI->session->userdata('logged_in');
		$user_id=$CI->session->userdata('user_id');
        if(!empty($logged_in) && !empty($user_id))
			return $user_id;
		else
			return false;
    }   
}
if ( ! function_exists('is_email_exists'))
{
    function is_email_exists($email)
    {
		$CI =&get_instance();
		$exists=$CI->user_model->is_email_exists($email);
        if(!empty($exists->user_id))
			return $exists->user_id;
		else
			return false;
    }   
}

//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_header_css')){
    function add_header_css($file='')
    {       
		$str = '';
		$ci = &get_instance();
		$header_css = $ci->config->item('header_css');

		/* if(empty($file)){
			return;
		} */

		if(is_array($file)){
			if(!is_array($file) && count($file) <= 0){
				return;
			}
			foreach($file AS $key=>$item){   
				$header_css[$key] = $item;
			}
			$ci->config->set_item('header_css',$header_css);
		}else{
			$str = $file;
			$header_css[] = $str;
			$ci->config->set_item('header_css',$header_css);
		}
		$header_css = $ci->config->item('header_css');
			
    }
}

if(!function_exists('add_header_js')){
    function add_header_js($file='')
    {       
		$str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');

       /*  if(empty($file)){
            return;
        } */

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $key=>$item){
                $header_js[$key] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
			
    }
}

if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');
		ksort($header_css);
		ksort($header_js);
		if(!empty($header_css)){
			foreach($header_css AS $item){
				$str .= '<link rel="stylesheet" href="'.base_url().'assets/css/'.$item.'" type="text/css" />'."\n";
			}
		}
		
		if(!empty($header_js)){
			foreach($header_js AS $item){
				$str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
			}
		}

        return $str;
    }
}
if(!function_exists('add_footer_css')){
    function add_footer_css($file='')
    {       
		$str = '';
		$ci = &get_instance();
		$footer_css = $ci->config->item('footer_css');
		
		/* if(empty($file)){
			return;
		} */

		if(is_array($file)){
			if(!is_array($file) && count($file) <= 0){
				return;
			}
			foreach($file AS $key=>$item){   
				$footer_css[$key] = $item;
			}
			$ci->config->set_item('footer_css',$footer_css);
		}else{
			$str = $file;
			$footer_css[] = $str;
			$ci->config->set_item('footer_css',$footer_css);
		}
		$footer_css = $ci->config->item('footer_css');
			
    }
}

if(!function_exists('add_footer_js')){
    function add_footer_js($file='')
    {       
		$str = '';
        $ci = &get_instance();
        $footer_js  = $ci->config->item('footer_js');
		
       /*  if(empty($file)){
            return;
        } */

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $key=>$item){
                $footer_js[$key] = $item;
            }
            $ci->config->set_item('footer_js',$footer_js);
        }else{
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('footer_js',$footer_js);
        }
			
    }
}

if(!function_exists('put_footers')){
    function put_footers()
    {
        $str = '';
        $ci = &get_instance();
        $footer_css = $ci->config->item('footer_css');
        $footer_js  = $ci->config->item('footer_js');
		ksort($footer_css);
		ksort($footer_js);
		if(!empty($footer_css)){
			foreach($footer_css AS $item){
				$str .= '<link rel="stylesheet" href="'.base_url().'assets/css/'.$item.'" type="text/css" />'."\n";
			}
		}
		
		if(!empty($footer_js)){
			foreach($footer_js AS $item){
				$str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
			}
		}

        return $str;
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