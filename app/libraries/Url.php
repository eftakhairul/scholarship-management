<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Url
{
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 * */
	protected $CI;

	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->config('url');
	}


	public function __call($method, $args)
	{
		$urls = $this->CI->config->item('urls');
		$url = $urls[$method];

		if (!empty($args[0])) {
			$keys = array_keys($args[0]);
			foreach ($keys as &$key) {
				$key = '<' . $key . '>';
			}

			$url = str_replace($keys, array_values($args[0]), $url);
		}

		if (preg_match('/<([^>]+)>/', $url, $matches)) {
			throw new Exception("Missing key {$matches[0]} in supplied argument for Url::{$method}()");
		}

		return base_url() . $url;
	}
}