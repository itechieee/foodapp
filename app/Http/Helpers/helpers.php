<?php


if (!function_exists('createNewToken')) {
    function createNewToken()
    {
        return md5(time().str_random(60)).md5(time().str_random(60));
    }
}

if (!function_exists('str_replace_first')) {
    function str_replace_first($needle, $replacement, $haystack)
    {
        $needle_start = strpos($haystack, $needle);
        $needle_end = $needle_start + strlen($needle);
        if ($needle_start !== false) {
            $to_replace = substr($haystack, 0, $needle_end);

            return str_replace($needle, $replacement, $to_replace).substr($haystack, $needle_end);
        } else {
            return $haystack;
        }
    }
}

if (!function_exists('appmsgError')) {
    function appmsgError($code, $message = null)
    {
        if ($message == null) {
            $response['message'] = trans("appmsg.$code");
        } else {
            $response['message'] = $message;
        }

        $response['code'] = (int) $code;

        return $response;
    }
}

if (!function_exists('urlFormatter')) {
    function urlFormatter($value, $url = '')
    {
        $parsed = parse_url($value);
        if (empty($parsed['scheme'])) {
            $value = $url.$value;
        }

        return $value;
    }
}

if (!function_exists('getRedirectUrl')) {
    function getRedirectUrl($config)
    {
        $config['redirect'] = url().$config['redirect'];

        return $config;
    }
}

if (!function_exists('elixirCDN')) {
    /**
    * Get the path to a versioned Elixir file.
    *
    * @param  string $file
    *
    * @return string
    */
   function elixirCDN($file)
   {
       $cdn = '';

       if (env('S3_CLOUD_FRONT', false)) {
           $cdn = env('S3_CLOUD_FRONT').env('S3_PREFIX');
       }

       return $cdn.elixir($file);
   }
}

if (!function_exists('elixirImageCDN')) {
    /**
    * Get the path to a versioned Elixir file.
    *
    * @param  string $file
    *
    * @return string
    */
   function elixirImageCDN($file)
   {
       $cdn = '';

       if (env('S3_CLOUD_FRONT', false)) {
           $cdn = env('S3_CLOUD_FRONT').env('S3_PREFIX');
       }

       return $cdn.'/'.$file;
   }
}

if (!function_exists('getDeviceInfo')) {
    function getDeviceInfo()
    {
        $agentLog = [];
        $agent = new \Jenssegers\Agent\Agent();

        $agentLog['agent']['model'] = $agent->device();
        $agentLog['agent']['os']['name'] = $agent->platform();
        $agentLog['agent']['os']['version'] = $agent->version($agentLog['agent']['os']['name']);

        $agentLog['agent']['agent']['name'] = $agent->browser();
        $agentLog['agent']['agent']['version'] = $agent->version($agentLog['agent']['agent']['name']);

        if($agent->isRobot()) {
            $agentLog['agent']['robot'] = $agent->robot();
        }

        if($agent->isDesktop()) {
            $agentLog['agent_type'] = 'web';
        } else {
            $agentLog['agent_type'] = 'mobile';
        }

        return $agentLog;
    }
}

if (!function_exists('createNewOtp')) {
    function createNewOtp($otp=null)
    {
        if($otp == null) {
            $otp = mt_rand(1000, 9999);
        }
        return $otp . "##" . createNewToken();
    }
}


if (!function_exists('findBridgeTypeV2')) {
    /**
     * Get Bridge Type.
     *
     * @param $data
     *
     * @return mixed
     */
    function findBridgeTypeV2($data)
    {
        //$email = '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
        //$phoneno = "/^\+?([0-9]{2})\)?[-. ]?([0-9]{5})[-. ]?([0-9]{5})$/";

        if (filter_var($data['bridge'], FILTER_VALIDATE_EMAIL)) {
            $data['bridgeType'] = 'EMAIL';
        } elseif (ctype_digit($data['bridge'])) {
            $data['bridgeType'] = 'PHONE';
        }

        return $data;
    }
}

if (!function_exists('findBridgeTypeV2')) {
    /**
     * Get Bridge Type.
     *
     * @param $data
     *
     * @return mixed
     */
    function findBridgeTypeV2($data)
    {
        //$email = '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
        //$phoneno = "/^\+?([0-9]{2})\)?[-. ]?([0-9]{5})[-. ]?([0-9]{5})$/";

        if (filter_var($data['bridge'], FILTER_VALIDATE_EMAIL)) {
            $data['bridgeType'] = 'EMAIL';
        } elseif (ctype_digit($data['bridge'])) {
            $data['bridgeType'] = 'PHONE';
        }

        return $data;
    }
}

if (!function_exists('getUserId')) {

    function getUserId()
    {
        if(isset(Auth::user()->id)) {
            return Auth::user()->id;
        }
        return null;
    }
}
if (!function_exists('getAppIdFromJwt')) {
    function getAppIdFromJwt()
    {
        $data = JWTAuth::decode(JWTAuth::getToken());
        if($data['type'] == 'app') {
            return $data['sub'];
        }
        return null;
    }
}

  /*use $FormatedDate = formatDate( "2016-06-06 09:59:40", "m/d/y");*/
if (!function_exists('formatDate')) {
    function formatDate($date, $formatType ="Y-m-d H:i:s")
    {

        if(isset($date)) {

          $carbon = new \Carbon\Carbon;
          return $parseDate = $carbon->parse($date)->format($formatType);

          // if(app('userTimezone') == null) {
          //     $location = \GeoIP::getLocation();
          // } else {
          //     $location['timezone'] = app('userTimezone');
          // }

            // $carbon = new \Carbon\Carbon;
            // return $parseDate = $carbon->parse($date)->setTimezone($location['timezone'])->format($formatType);
        }
        return null;
    }
}
