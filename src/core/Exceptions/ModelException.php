<?php 
namespace Kulaxyz\Blog\core\Exceptions;

/**
 * 
 */
class AuthException extends \Exception
{
	
	function __construct($message = 'Проблема при работе с моделью.', $code = 500)
	{
		parent::__construct($message, $code);
	}
}
?>