<?php 
namespace core\Exceptions;

/**
 * 
 */
class QueryException extends \Exception
{
	
	function __construct($message = 'Проблема при работе с БД.', $code = 500)
	{
		parent::__construct($message, $code);
	}
}

?>
