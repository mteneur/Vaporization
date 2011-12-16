<?php
/**
 * @Author  Maxime Teneur maxime.teneur@lanetscouade.com
 * Date: 16/12/11
 * Time: 12:22
 */

namespace Vaporization;
use Buzz\Browser;

class Driver
{

    const URL =  'https://www.google.com/fusiontables/api/query';

    /**
     * @param String $token
     * @param \Buzz\Browser $browser
     */
    public function __construct(String $token, Browser $browser)
    {
        $this->token = $token;
        $this->browser = $browser;
    }

    /**
     * @param $query
     * @return \Buzz\Message\Response
     */
    function query($query)
    {

        $query = "sql=" . urlencode($query);

        //$url = $this->URL;
        $headers = array();

        if (preg_match("/^select|^show tables|^describe/i", $query)) {
            $url .= "?" . $query;
          $headers[] = "Authorization: GoogleLogin auth=" . $this->token);
          return $this->browser->get($url, $headers);
        }

        else {
            $headers[] = array(
                "Content-length: " . strlen($query),
                "Content-type: application/x-www-form-urlencoded",
                "Authorization: GoogleLogin auth=" . $this->token);
            $this-> browser->post($url, $headers, $query);

        }

    }
}
