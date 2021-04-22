<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('username');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->username->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('usernameConfig'))
{
    function usernameConfig()
    {
        $CI->load->library('username');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordUsername'))
{
    function resetPasswordUsername($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->username->from(USERNAME_FROM, FROM_NAME);
        $CI->username->subject("Reset Password");
        $CI->username->message($CI->load->view('username/resetPassword', $data, TRUE));
        $CI->username->to($detail["username"]);
        $status = $CI->username->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if ( ! function_exists('generatehtml'))
{
    function rp($x)
       {
            if(is_int($x)==FALSE)
            {
                return '';
            }
            else
            {
           return number_format((int)$x,0,",",".");
            }
       }
       
       function waktu()
       {
           date_default_timezone_set('Asia/Jakarta');
           return date("Y-m-d H:i:s");
       }
              
       function tgl_indo($tgl)
       {
            return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4);
       }

       function tgl_bln($tgl)
       {
            return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2));
       }
    
    function tgl_indojam($tgl,$pemisah)
    {
        return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4).' '.$pemisah.' '.  substr($tgl, 11,8);
    }

    function format_indo ($date)
    {
        $bulanindo = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
        $result = $tgl." - ".$bulanindo[(int)$bulan-1]." - ".$tahun;
        return($result);
    }
    
    
    function getbln($bln)
    {
        switch ($bln) 
        {
            
            case 1:
                return "Januari";
            break;
        
            case 2:
                return "Februari";
            break;
        
            case 3:
                return "Maret";
            break;
        
            case 4:
                return "April";
            break;
        
            case 5:
                return "Mei";
            break;
        
            case 6:
                return "Juni";
            break;
        
            case 7:
                return "Juli";
            break;
        
            case 8:
                return "Agustus";
            break;
        
            case 9:
                return "September";
            break;
        
             case 10:
                return "Oktober";
            break;
        
            case 11:
                return "November";
            break;
        
            case 12:
                return "Desember";
            break;
        }
        
    }

}

?>