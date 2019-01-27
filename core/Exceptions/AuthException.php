<?php 
namespace core\Exceptions;

/**
 * 
 */
class AuthException extends \Exception
{
	
	function __construct($message = 'Вы не авторизованы.', $code = 401)
	{
		parent::__construct($message, $code);
	}
}
?>