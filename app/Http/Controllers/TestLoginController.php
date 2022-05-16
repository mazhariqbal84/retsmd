<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestLoginController extends Controller
{
    //
    public function testLogin() {
        date_default_timezone_set('America/New_York');
        $rets_login_url = "https://r_idx.gsmls.com/rets_idx/login.do";
        $rets_username = "EZRealEstateCE";
        $rets_password = "XPNMA1X4U5JC";
        $rets_user_agent_password = "TJU035BG";

        $config = new \PHRETS\Configuration;
        $config->setLoginUrl($rets_login_url);
        $config->setUsername($rets_username);
        $config->setPassword($rets_password);

        $config->setRetsVersion('1.8'); // see constants from \PHRETS\Versions\RETSVersion
        $config->setUserAgent('EZRealEstateCE/1.0');
        $config->setUserAgentPassword($rets_user_agent_password); // string password, if given
        $config->setHttpAuthenticationMethod('digest'); // or 'basic' if required
        $config->setOption('use_post_method', false); // boolean
        $config->setOption('disable_follow_location', false); // boolean

        $rets = new \PHRETS\Session($config);
        $connect = $rets->Login();

        $resource = 'Property';
        $class = 'RES';
        $query = '(MLSTATUS=A,CS,UC,US)';


        $results = $rets->Search(
            $resource,
            $class,
            $query,
            [
                'QueryType' => 'DMQL2',
                'Count' => 1, // count and records
                'Format' => 'COMPACT-DECODED',
                'Limit' => 5000,
                'StandardNames' => 0, // give system names
            ]
        );

        echo '<pre/>';
        print_r($results);

    }
}
