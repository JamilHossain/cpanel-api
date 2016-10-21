<?php

/**
 * Class Cpanel
 */
class Cpanel {
	/**
	 * @var string
	 * WHM Username
	 */
	private $rootUser;

	/**
	 * @var string
	 * The contents of /root/.accesshash
	 */
	private $hash;

	/**
	 * @var string
	 */
	private $ipAddress;

	/**
	 * @var string
	 */
	private $port;

	/**
	 * Cpanel constructor.
	 */
	public function __construct()
	{
		$this->rootUser = "root";
		$this->hash = "yourhash";
		$this->ipAddress = "127.0.0.1";
		$this->port = "2087"; //do not change!
	}

	/**
	 * Calls to cPanel API 2
	 * https://confluence2.cpanel.net/display/SDK/Guide+to+cPanel+API+2
	 *
	 * @param $user
	 * @param $module
	 * @param $function
	 * @param null $parameter
	 * @return mixed
	 */
	public function callCpanelApi($user, $module, $function, $parameter = null)
	{
		$query = "https://" . $this->ipAddress . ":" . $this->port . "/json-api/"
			. "cpanel?cpanel_jsonapi_user=" . $user
		    . "&cpanel_jsonapi_apiversion=2"
			. "&cpanel_jsonapi_module=" . $module
			. "&cpanel_jsonapi_func=" . $function
			. $parameter;

		$result = $this->exec($query);

		return $result;
	}

	/**
	 * Calls to WHM API 1
	 * https://confluence2.cpanel.net/display/SDK/Guide+to+WHM+API+1
	 *
	 * @param $function
	 * @param null $parameter
	 * @return mixed
	 */
	public function callWHMApi($function, $parameter = null)
	{
		$query = "https://" . $this->ipAddress . ":" . $this->port . "/json-api/"
			. $function
			. "?api.version=1&"
			. $parameter;

		$result = $this->exec($query);

		return $result;
	}

	/**
	 * executes a curl request
	 *
	 * @param $query
	 * @return mixed
	 */
	private function exec($query)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$header[0] = "Authorization: WHM " . $this->rootUser . ":" . preg_replace("'(\r|\n)'", "", $this->hash);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_URL, $query);

		$result = curl_exec($curl);

		if ($result == false) {
			error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
		}

		return $result;
	}
}
