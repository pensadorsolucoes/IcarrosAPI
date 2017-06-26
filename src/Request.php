<?php
namespace IcarrosAPI;

class Request
{
    /**
     * The Icarros class instance we belong to.
     *
     * @var \IcarrosAPI\Icarros
     */
    protected $_parent;

    /**
     * Which API version to use for this request.
     *
     * @var int
     */
    private $_url;
    private $_userAgent;
    private $_params = [];
    private $_posts = [];
    private $_puts = [];
    private $_delete = false;
    private $_headers = [];

    public function __construct(
        Icarros $parent,
        $url)
    {
        $this->_userAgent =  'Veloccer/SDK';
        $this->_parent = $parent;
        $this->_url = $url;
        return $this;
    }

    public function addParam(
        $key,
        $value)
    {
        if ($value === true) {
            $value = 'true';
        }
        $this->_params[$key] = $value;
        return $this;
    }

    public function addPost(
        $key,
        $value)
    {
        $this->_posts[$key] = $value;
        return $this;
    }

    public function addPut(
        $key,
        $value)
    {
        $this->_puts[$key] = $value;
        return $this;
    }

    public function addDelete($boolean)
    {
        $this->_delete = $boolean;
        return $this;
    }

    /**
     * Add custom header to request, overwriting any previous or default value.
     *
     *
     * @param string $key
     * @param string $value
     *
     * @return self
     */
    public function addHeader(
        $key,
        $value)
    {
        $this->_headers[$key] = $value;
        return $this;
    }

    public function getResponse()
    {

        $ch = curl_init();

        if($this->_params){
            $this->_url = $this->_url . '?' . http_build_query($this->_params);
        }

        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->_userAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_ENCODING,  '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Utils::convertHeaderCurl($this->_headers));

        if($this->_posts){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->_posts));
        }

        if($this->_puts){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->_puts));
        }

        if($this->_delete){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $resp           = curl_exec($ch);
        $header_len     = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $curl_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        $header         = substr($resp, 0, $header_len);
        $body           = substr($resp, $header_len);

        curl_close($ch);

        if($curl_http_code == 200) {

            return [
                'status' => 'ok',
                'body' => json_decode($body, true)
            ];

        } else {

            return [
                'status' => 'fail',
                'http_code' => $curl_http_code,
                'header' => $header,
                'body' => json_decode($body, true)
            ];

        }

    }

}