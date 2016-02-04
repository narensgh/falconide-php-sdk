<?php

/**
 * Description of Falconide
 *
 * @author narendra
 */
namespace Falconide;

class Falconide
{

    private $callType, $apiKey, $url, $endpoint;

    function __construct($callType = "API", $options = array())
    {
        $this->callType = strtoupper($callType);
        if (!in_array($this->callType, array("SMTP", "API"))) {
            return "Invalid call type";
        }
        $protocol = isset($options['protocol']) ? $options['protocol'] : 'https';
        $host = isset($options['host']) ? $options['host'] : 'api.falconide.com';
        $this->url = isset($options['url']) ? $options['url'] : $protocol . '://' . $host;
        $this->endpoint = isset($options['endpoint']) ? $options['endpoint'] : '/falconapi/web.send.rest';
    }

    public function setApikey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApikey()
    {
        if (empty($this->apiKey)) {
            throw new \Exception('apiKey is blank');
        }
        return $this->apiKey;
    }

    public function sendmail(\Falconide\Email $email)
    {
        $form = $email->toApiMailFormat();
        $form['api_key'] = $this->getApikey();
    }

    function http_post_form($url, $data, $timeout = 20)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RANGE, "1-2000000");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_REFERER, @$_SERVER['REQUEST_URI']);
        $result = curl_exec($ch);
        $result = curl_error($ch) ? curl_error($ch) : $result;
        curl_close($ch);
        return $result;
    }

}
