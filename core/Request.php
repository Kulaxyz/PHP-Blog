<?php

namespace core;

class Request
{
	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';

	private $get;
	private $post;
	private $server;
	private $cookie;
	private $file;
	private $session;

	public function __construct($get, $post, $server, $cookie, $file, $session)
	{
		$this->get = $get;
		$this->post = $post;
		$this->server = $server;
		$this->cookie = $cookie;
		$this->file = $file;
		$this->session = $session;
	}

	public function isPost()
	{
		return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
	}
	
	public function get($key = null)
	{
		return $this->get_array($this->get, $key);
	}

	public function post($key = null)
	{
		return $this->get_array($this->post, $key);
	}

	public function server($key = null)
	{
		return $this->get_array($this->server, $key);
	}

	public function cookie($key = null)
	{
		return $this->get_array($this->cookie, $key);
	}

	public function file($key = null)
	{
		return $this->get_array($this->file, $key);
	}

	public function session($key = null)
	{
		return $this->get_array($this->session, $key);
	}


	private function get_array($array, $key = null)
	{
		if (!$key) {
			return $array;
		}

		if (isset($array[$key])) {
			return $array[$key];
		}

		return null;
	}

}