<?php 
namespace Kulaxyz\Blog\core\Exceptions;

/**
 * 
 */
class NotFoundException extends \Exception
{
	
	function __construct($message = 'Такой страницы не найдено.', $code = 404)
	{
		parent::__construct($message, $code);
	}
}

?>
