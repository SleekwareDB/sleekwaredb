<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (!function_exists('get_client_ip')) {

    /**
     * @return mixed
     */
    function get_client_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}

if (!function_exists('encrypt_decrypt')) {

    /**
     * @param $action
     * @param $string
     * @return mixed
     */
    function encrypt_decrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key     = 'tfHErQKtE0y4hiX5!59p0HiPwDR6#gjXTkqOFqJN$C^fCF$p1PcGwFt1RHV%oC1TLiSRMDs@m@mQw1ZbWl6A4U5sxjw#RqGP8V*';
        $secret_iv      = '4#quuOQ$mR20hkBE';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}

if (!function_exists('debug')) {

    /**
     * @param $data
     * @param $die
     */
    function debug($data, $die = false)
    {
        if (is_object($data)) {
            echo "<pre>", var_dump($data), "</pre>";
        } else {
            echo "<pre>", print_r($data, true), "</pre>";
        }

        if ($die) die();
    }
}

if (!function_exists('dump')) {

    /**
     * @param $data
     * @param $die
     */
    function dump($data, $die = false)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if ($die) die();
    }
}

if (!function_exists('guidv4')) {

    function guidv4()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        $data    = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}

if (!function_exists('str_replace_first')) {

    /**
     * @param $from
     * @param $to
     * @param $content
     */
    function str_replace_first($from, $to, $content)
    {
        $from = '/' . preg_quote($from, '/') . '/';

        return preg_replace($from, $to, $content, 1);
    }
}

if (!function_exists('idr_format')) {

    /**
     * @param $number
     * @param $prefix
     * @param false $decimal_number
     * @param $decimal_point
     * @param $thousand_point
     */
    function idr_format($number, $prefix = false, $decimal_number = 0, $decimal_point = ',', $thousand_point = '.')
    {
        return ($prefix == false) ? number_format($number, $decimal_number, $decimal_point, $thousand_point) : 'Rp. ' . number_format($number, $decimal_number, $decimal_point, $thousand_point);
    }
}

if (!function_exists('hyphenate')) {
    function hyphenate($str, $number)
    {
        return implode("-", str_split($str, $number));
    }
}

if (!function_exists('format_phone_number')) {

    /**
     * @param $phone_number
     */
    function format_phone_number($phone_number)
    {
        $find_first  = substr($phone_number, 0, 2);
        $find_second = substr($phone_number, 0, 3);

        if (strpos($find_first, '62') !== false) {
            $replace = str_replace_first('62', '', $phone_number);

            return '+62 ' . hyphenate($replace, 4);
        } elseif (strpos($find_second, '+62') !== false) {
            $replace = str_replace_first('+62', '', $phone_number);

            return '+62 ' . hyphenate($replace, 4);
        } else {
            $replace = str_replace_first('0', '', $phone_number);

            return '+62 ' . hyphenate($replace, 4);
        }
    }
}

if (!function_exists('get_version')) {
    function get_version()
    {
        $composer_file = file_get_contents(FCPATH . 'composer.json');
        $composer_json = json_decode($composer_file, true);
        $version       = $composer_json['version'];
        return $version;
    }
}

if (!function_exists('sleekdb_version')) {
    function sleekdb_version()
    {
        $composer_file  = file_get_contents(FCPATH . 'composer.json');
        $composer_json  = json_decode($composer_file, true);
        $version        = str_replace('^', '', $composer_json['require']['rakibtg/sleekdb']);
        return $version;
    }
}

if (!function_exists('generate_phonenumber')) {

    /**
     * @param $requiredLength
     * @param $highestDigit
     * @return mixed
     */
    function generate_phonenumber($requiredLength = 8, $highestDigit = 8)
    {
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }

        return $sequence;
    }
}

if (!function_exists('rand_phonenumber')) {

    /**
     * @param $counter
     * @param $prefix
     * @return mixed
     */
    function rand_phonenumber($counter = 1, $prefix = null)
    {
        $numberPrefixes = (!is_null($prefix)) ? $prefix : ['0812', '0813', '0814', '0815', '0816', '0817', '0818', '0819', '0882', '0825', '0878'];
        $phone_array    = [];
        for ($i = 0; $i < $counter; ++$i) {
            array_push($phone_array, $numberPrefixes[array_rand($numberPrefixes)] . generate_phonenumber());
        }

        return $phone_array;
    }
}

if (!function_exists('human_timing')) {

    function human_timing($time)
    {
        // to get the time since that moment
        $time = time() - $time;

        // time unit constants
        $timeUnits = array(
            31536000 => 'year',
            2592000  => 'month',
            604800   => 'week',
            86400    => 'day',
            3600     => 'hour',
            60       => 'minute',
            1        => 'second',
        );

        // iterate over time contants to build a human
        $humanTiming = '';
        foreach ($timeUnits as $unit => $text) {
            if ($time < $unit) {
                continue;
            }

            $numberOfUnits = floor($time / $unit);

            // human readable token for current time unit
            $humanTiming = $humanTiming . ' ' . $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');

            // compute remaining time for next loop iteration
            $time -= $unit * $numberOfUnits;
        }

        return $humanTiming;
    }
}

if (!function_exists('time_to_second')) {

    function time_to_second($time, $unit)
    {
        $timeUnits = array(
            'year'   => 31536000,
            'month'  => 2592000,
            'week'   => 604800,
            'day'    => 86400,
            'hour'   => 3600,
            'minute' => 60,
            'second' => 1,
        );

        $calculated = $time * $timeUnits[$unit];

        return $calculated;
    }
}

if (!function_exists('obj_to_array')) {

    /**
     * Converts objects to array
     *
     * @param object $obj object(s)
     *
     * @return array
     */
    function obj_to_array($obj)
    {
        // Not an array or object? Return back what was given
        if (!is_array($obj) && !is_object($obj)) {
            return $obj;
        }

        $arr = (array) $obj;

        foreach ($arr as $key => $value) {
            $arr[$key] = obj_to_array($value);
        }

        return $arr;
    }
}

if (!function_exists('is_valid_base64')) {

    function is_valid_base64($string)
    {
        $decoded = base64_decode($string, true);

        // Check if there is no invalid character in string
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

        // Decode the string in strict mode and send the response
        if (!$decoded) return false;

        // Encode and compare it to original one
        if (base64_encode($decoded) != $string) return false;

        return true;
    }
}

if (!function_exists('shorten_number')) {
    function shorten_number($n)
    {
        if ($n >= 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'rb+';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'jt+';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'm+';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 't+';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }
}

if (!function_exists('bulan_indo')) {
    function bulan_indo()
    {
        $bulan = [
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $bulan_int = date('m', time());
        return $bulan[(int) $bulan_int];
    }
}

// Creeate short encrypt
if (!function_exists('short_encrypt')) {
    function short_encrypt($string)
    {
        $key = '@#$%^&*()_+';
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }
}

// Creeate short decrypt
if (!function_exists('short_decrypt')) {
    function short_decrypt($string)
    {
        $key = '@#$%^&*()_+';
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }
}

if (!function_exists('isInstalled')) {
    function isInstalled()
    {
        $CI = &get_instance();
        $CI->load->model('App_model', 'app');
        if ($CI->app->checkIfInstalled() == false && $CI->uri->segment(1) != 'install') {
            redirect('install');
        }
        if ($CI->app->checkIfInstalled() == true && $CI->uri->segment(1) == 'install') {
            redirect(base_url());
        }
    }
}

if (!function_exists('app_config')) {
    function app_config(array $key)
    {
        $alias = current(array_keys($key));
        $CI =& get_instance();
        $CI->load->model('app_model', 'app');
        $data = $CI->app->getAppValue($key);
        return (empty($data)) ? [] : $data[$alias];
    }
}

if (!function_exists('checkIsAlreadyBoot')) {
    function checkIsAlreadyBoot($email)
    {
        return file_exists(APPPATH . 'database' . DIRECTORY_SEPARATOR . 'sleekstores' . DIRECTORY_SEPARATOR . md5($email));
    }
}

if (!function_exists('sleektime')) {
    function sleektime($format = null)
    {
        $epoch = round(microtime(true) * 1000);
        if ($format == null) {
            return $epoch;
        } else {
            return date($format, $epoch / 1000);
        }
    }
}

if (!function_exists('encode_auth_token')) {
    function encode_auth_token(array $payload)
    {
        $jwt = JWT::encode($payload, PASSCODE, 'HS256');
        return $jwt;
    }
}

if (!function_exists('decode_auth_token')) {
    function decode_auth_token($jwt)
    {
        JWT::$leeway = 604800;
        $decoded = JWT::decode($jwt, new Key(PASSCODE, 'HS256'));
        return (array) $decoded;
    }
}

if (!function_exists('token_middleware')) {
    function token_middleware()
    {
        $CI =& get_instance();
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches);
            if (empty($matches[0])) {
                $CI->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output([
                    'status' => false,
                    'type' => 'error',
                    'code' => 400,
                    'msg' => 'Token not found in request'
                ]);
                exit;
            }

            $jwt = $matches[1];
            if (empty($jwt)) {
                // No token was able to be extracted from the authorization header
                $CI->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                    ->set_output([
                        'status' => false,
                        'type' => 'error',
                        'code' => 400,
                        'msg' => 'Bad Request'
                    ]);
                exit;
            }

            $token = decode_auth_token($jwt);
            $now = new DateTimeImmutable();
            $serverName = $CI->input->server('SERVER_NAME');

            if (
                $token['iss'] !== $serverName ||
                $token['nbf'] > $now->getTimestamp() ||
                $token['exp'] < $now->getTimestamp()
            ) {
                $CI->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                    ->set_output([
                        'status' => false,
                        'type' => 'warning',
                        'code' => 401,
                        'msg' => 'Unauthorized'
                    ]);
                exit;
            }
        } else {
            $CI->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output([
                    'status' => false,
                    'type' => 'warning',
                    'code' => 401,
                    'msg' => 'Request not authorized'
                ]);
            exit;
        }
    }
}

if (!function_exists('add_metadata')) {
    function add_metadata(array $store)
    {
        $data = array_merge($store, [
            'uuid' => guidv4(),
            'createdAt' => sleektime(),
            'updatedAt' => sleektime(),
            'deletedAt' => null
        ]);
        return $data;
    }
}

if (!function_exists('update_metadata')) {
    function update_metadata(array $store)
    {
        $data = array_merge($store, [
            'updatedAt' => sleektime()
        ]);
        return $data;
    }
}

if (!function_exists('delete_metadata')) {
    function delete_metadata(array $store)
    {
        $data = array_merge($store, [
            'deletedAt' => sleektime()
        ]);
        return $data;
    }
}

if (!function_exists('json_validate')) {
    function json_validate($string)
    {
        // decode the JSON data
        $result = json_decode($string, true);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
                // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            exit($error);
        }

        // everything is OK
        return $result;
    }
}

if (!function_exists('app_config')) {
    function app_config($key)
    {
        $CI =& get_instance();
        $CI->load->model('core/app_model', 'app');
        $value = $CI->app->getAppValue($key);
        return (!empty($value)) ? $value : null;
    }
}

if (!function_exists('sleekwaredb_mailer')) {
    function sleekwaredb_mailer($to, $subject, $message, $html = false)
    {
        $CI = &get_instance();

        $smtp_host = app_config(['host' => 'configurations.email.smtp.host']);
        $smtp_port = app_config(['port' => 'configurations.email.smtp.port']);
        $from = app_config(['from' => 'configurations.email.from']);
        $fromName = app_config(['fromName' => 'configurations.email.fromName']);

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = $smtp_host;
            $mail->Port       = $smtp_port;
            $mail->setFrom($from, $fromName);
            $mail->addAddress($to);
            $mail->isHTML($html);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            log_message('info', 'Email has been sent!');
            return true;
        } catch (Exception $e) {
            log_message('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}

if (!function_exists('array_keys_multi')) {
    function array_keys_multi(array $array)
    {
        $keys = array();
        foreach ($array as $key => $value) {
            $keys[] = $key;
            if (is_array($value)) {
                $keys = array_merge($keys, array_keys_multi($value));
            }
        }
        return $keys;
    }
}
