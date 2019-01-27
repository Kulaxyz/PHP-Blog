<?php
namespace controller;
class Base
{
	protected $content;

	public function error($message, $code)
	{
		$this->content = $this->build('err404', ['message' => $message]);
		if ($code == 404) {
			header("HTTP/1.0 404 Not Found");
		}
	}

	public function render()
	{
		return $this->build('main', ['content' => $this->content]);
	}

	public function build($fname, array $vars = [])
	{
		extract($vars);
		ob_start();
		include_once __DIR__ . "/../view/$fname.php";
		return ob_get_clean();
	}

}

?>