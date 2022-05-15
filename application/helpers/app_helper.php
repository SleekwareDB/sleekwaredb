<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

if (!function_exists('scanAdminLteAssetFiles')) {
    function scanAdminLteAssetFiles($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != ".." && $value != "index.html") {
                scanAdminLteAssetFiles($path, $results);
                $results[] = $path;
            }
        }

        $results = array_filter($results, function ($v) {
            return !is_dir($v) === true && strpos($v, 'index.html') === false && strpos($v, '.map') === false;
        });

        $arrayKey = [];
        foreach ( $results as $alias ) {
            array_push($arrayKey, basename($alias));
        }

        $arrayValue = array_map(function ($v) {
            return str_replace(FCPATH, '', $v);
        }, $results);

        $results = array_combine($arrayKey, $arrayValue);

        return $results;
    }
}

if (!function_exists('adminlte_loader')) {
    function adminlte_loader()
    {
        $CI = get_instance();
        $CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        $modelDir = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'adminlte' . DIRECTORY_SEPARATOR;

        $cacheResults = $CI->cache->get('adminlte_loader');
        if (!$cacheResults) {
            $listOfFiles = scanAdminLteAssetFiles($modelDir);
            $CI->cache->save('adminlte_loader', $listOfFiles, 86400);
        } else {
            $listOfFiles = $cacheResults;
        }
        return $listOfFiles;
    }
}

if (!function_exists('adminlte')) {

    /**
     * Admin LTE Helper Asset
     * @param string $uri  memuat posisi file yang disimpan dalam folder asset Admin LTE
     * @param $asset
     */
    function adminlte(string $filename, $asset = false)
    {
        $filepath = adminlte_loader()[$filename];
        if ($asset == false) {
            return link_tag($filepath);
        } else {
            return base_url($filepath);
        }
    }
}

if (!function_exists('get_header')) {

    /**
     * @param array $data
     */
    function get_header(array $data = [])
    {
        $CI = &get_instance();
        $CI->load->view('partials/header', $data);
    }
}

if (!function_exists('get_footer')) {

    /**
     * @param array $data
     */
    function get_footer(array $data = [])
    {
        $CI = &get_instance();
        $CI->load->view('partials/footer', $data);
    }
}

if (!function_exists('load_js')) {

    /**
     * @param array $file_uri
     * @return mixed
     */
    function load_js(array $file_uri)
    {
        $script = '';
        foreach ($file_uri as $file) {
            $script .= '<script src="' . base_url($file) . '" type="text/javascript"></script>' . PHP_EOL;
        }

        return $script;
    }
}

if (!function_exists('script_tag')) {
    /**
     * @param $src
     * @param $language
     * @param $type
     * @param $index_page
     * @return mixed
     */
    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
    {
        $CI     = &get_instance();
        $script = '<scr' . 'ipt';
        if (is_array($src)) {
            foreach ($src as $k => $v) {
                if ($k == 'src' and strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $script .= ' src="' . $CI->config->site_url($v) . '"';
                    } else {
                        $script .= ' src="' . $CI->config->slash_item('base_url') . $v . '"';
                    }
                } else {
                    $script .= "$k=\"$v\"";
                }
            }

            $script .= "></scr" . "ipt>\n";
        } else {
            if (strpos($src, '://') !== FALSE) {
                $script .= ' src="' . $src . '" ';
            } elseif ($index_page === TRUE) {
                $script .= ' src="' . $CI->config->site_url($src) . '" ';
            } else {
                $script .= ' src="' . $CI->config->slash_item('base_url') . $src . '" ';
            }

            $script .= 'language="' . $language . '" type="' . $type . '"';
            $script .= ' /></scr' . 'ipt>' . "\n";
        }

        return $script;
    }
}

if (!function_exists('load_css')) {

    /**
     * @param array $file_uri
     * @return mixed
     */
    function load_css(array $file_uri)
    {
        $link = '';
        if (!empty($file_uri['adminlte'])) {
            foreach ($file_uri['adminlte'] as $file) {
                $link .= adminlte($file) . PHP_EOL;
            }
        }

        if (!empty($file_uri['app'])) {
            foreach ($file_uri['app'] as $file) {
                $link .= link_tag(ltrim($file, '/')) . PHP_EOL;
            }
        }

        return $link;
    }
}

if (!function_exists('breadcrumb')) {

    /**
     * @param array $links
     * @return mixed
     */
    function breadcrumb(array $links = [])
    {
        $output = '<ol class="breadcrumb float-sm-right">';
        foreach ($links as $key => $crumb) {
            $links = array_keys($links);
            if (end($links) == $key) {
                $output .= '<li class="breadcrumb-item active">' . $crumb['title'] . '</li>';
            } else {
                $output .= '<li class="breadcrumb-item"><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></li>';
            }
        }
        $output .= '</ol>';

        return $output;
    }
}

if (!function_exists('need_login')) {

    function need_login()
    {
        $CI = &get_instance();
        if (!$CI->session->userdata('databaseName')) {
            redirect(base_url('/auth_signin'));
        }
    }
}
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

if (!function_exists('dev_password')) {

    /**
     * @param $password
     */
    function dev_password($password)
    {
        $hash = password_hash('idbetta01', PASSWORD_DEFAULT);
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
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

if (!function_exists('get_app_config')) {

    /**
     * @param string $config_name
     * @param $optional
     * @return mixed
     */
    function get_app_config(string $config_name, $optional = null)
    {
        $CI = &get_instance();
        $CI->load->model('appconfig_model');
        $config_value = $CI->appconfig_model->get_config_by_name($config_name);
        if (!empty($config_value)) {
            if ($config_name == 'app-icon' && $config_value != default_config('app-icon')) {
                $config = default_config('app-icon');
            } else {
                $config = $config_value;
            }
        } else {
            if ($optional == null) {
                $config = 'AdminLTE Codeigniter Bolierplate';
            } else {
                $config = $optional;
            }
        }

        return $config;
    }
}

if (!function_exists('get_role')) {

    /**
     * @param int $id
     * @return mixed
     */
    function get_role(int $id, $key = null)
    {
        if ($id == 201) {
            return 'Developer';
        } else {
            $CI = &get_instance();
            $CI->load->model('role_model');

            return $CI->role_model->get_role_by_id($id, $key);
        }
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

if (!function_exists('get_session')) {

    /**
     * @param $sess_key
     * @return mixed
     */
    function get_session($sess_key)
    {
        $CI = &get_instance();
        $session = ($CI->session->userdata($sess_key) == '') ? 'unknown' : $CI->session->userdata($sess_key);
        return $session;
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

if (!function_exists('default_config')) {

    /**
     * @param $name
     * @return mixed
     */
    function default_config($name)
    {
        $CI = &get_instance();
        $CI->load->helper('url');
        $app_config = [
            'app-name'                   => 'AdminLTE Codeigniter Bolierplate',
            'app-icon'                   => base_url('aseets/img/favicon.png'),
            'app-sidebar'                => 'sidebar-mini',
            'app-navbar-border'          => 'default',
            'app-body-small-text'        => 'default',
            'app-navbar-small-text'      => 'default',
            'app-sidebar-small-text'     => 'default',
            'app-footer-small-text'      => 'default',
            'app-sidebar-style'          => 'default',
            'app-brand-size'             => 'default',
            'app-cache'                  => 'off',
            'email-protocol'             => 'smtp',
            'email-host'                 => 'smtp.mailtrap.io',
            'email-port'                 => '2525',
            'email-user'                 => '8977c81cc7e443',
            'email-password'             => '886dba3e3164d8',
            'google-recaptcha-sitekey'   => '',
            'google-recaptcha-secretkey' => '',
        ];

        return $app_config[$name];
    }
}

if (!function_exists('get_version')) {

    /**
     * @return mixed
     */
    function get_version()
    {
        try {
            $file_src = APPPATH . '/helpers/version.txt';
            $version  = current(file($file_src));
            $limit    = time() - 3600 * 24 * 7;
            if (!empty($version) && filemtime($file_src) < $limit) {
                $client = new Client([
                    'timeout' => 200000,
                    'headers' => [
                        'PRIVATE-TOKEN' => 'iMc5W9Sx64UfGyBkdyF_',
                    ],
                ]);
                $request  = $client->request('GET', 'https://gitlab.com/api/v4/projects/20645136/releases');
                $response = json_decode($request->getBody(), true);
                $version  = current($response);
                file_put_contents(APPPATH . '/helpers/version.txt', (empty($version)) ? 'v.1.0-beta' : $version['tag_name']);

                return (empty($version)) ? 'v.1.0-beta' : $version['tag_name'];
            } else {
                return $version;
            }
        } catch (Exception $e) {
            $version = current(file(APPPATH . '/helpers/version.txt'));

            return $version;
        }
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

if (!function_exists('is_connected')) {

    function is_connected()
    {
        $connected = @fsockopen("www.example.com", 80); //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }

        return $is_conn;
    }
}

if (!function_exists('clear_all_cache')) {

    /**
     * Clears all cache from the cache directory
     */
    function clear_all_cache()
    {
        $CI   = &get_instance();
        $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
        $status     = false;
        try {

            $handle = opendir($cache_path);
            while (($file = readdir($handle)) !== FALSE) {
                //Leave the directory protection alone
                if ($file != '.htaccess' && $file != 'index.html') {
                    @unlink($cache_path . '/' . $file);
                }
            }
            closedir($handle);
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status;
    }
}

if (!function_exists('count_cache')) {

    function count_cache()
    {
        $totalSize = 0;
        foreach (new DirectoryIterator(APPPATH . 'cache/') as $file) {
            if ($file->isFile()) {
                $totalSize += $file->getSize();
            }
        }

        return round(($totalSize / 1048576), 2) . ' MB';
    }
}

if (!function_exists('check_system_configurations')) {

    function check_system_configurations()
    {
        $dwa_system = [
            'file_and_directories' => [
                'assets' => FCPATH . 'assets/',
                'cache'  => APPPATH . 'cache/'
            ],
            'extensions_load'      => get_loaded_extensions(),
        ];

        return $dwa_system;
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

if (!function_exists('bs_validation_message')) {
    function bs_validation_message($valid_msg = null, $invalid_msg = null)
    {
        $success_msg = ($valid_msg == null) ? 'Data terisi dengan baik!' : $valid_msg;
        $error_msg = ($invalid_msg == null) ? 'Silahkan isi kolom ini.' : $invalid_msg;
        $template = '
        <div class="valid-feedback">' . $success_msg . '</div>
        <div class="invalid-feedback">' . $error_msg . '</div>
        ';
        return $template;
    }
}

if (!function_exists('redirect_by_role')) {
    function redirect_by_role()
    {
        $nama_jabatan = get_session('nama_jabatan');
        switch ($nama_jabatan) {
            case 'super-admin':
                redirect('super/dashboard');
                break;
            case 'administrator':
                redirect('administrator/dashboard');
                break;
            case 'karyawan':
                redirect('karyawan/dashboard');
                break;
        }
    }
}

if (!function_exists('sidebar_active')) {
    function sidebar_active($uri, $class = 'active')
    {
        if (is_array($uri)) {
            $link_active = (in_array(current_url(), $uri)) ? 'menu-open' : '';
        } else {
            $link_active = (current_url() == base_url($uri)) ? $class : '';
        }

        return $link_active;
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
