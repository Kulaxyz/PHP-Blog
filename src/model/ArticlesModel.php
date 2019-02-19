<?php
namespace Kulaxyz\Blog\model;

use Kulaxyz\Blog\core\DBDriver;
use Kulaxyz\Blog\model\BaseModel;
use Kulaxyz\Blog\core\Validator;

class ArticlesModel extends BaseModel
{
	private $scheme =
	[
		'id' => [
					'type' => 'integer',
					'primary' => true
				],
		'title' => [
						'type' => 'string',
						'length' => [2,150],
				 		'require' => true
				   ],
		'content' => [
						'type' => 'string',
						'length' => [10, 4000],
						'require' => true
				     ],
		'author' => [
						'type' => 'string',
						'length' => [3, 150],
						'require' => true
				    ]

	];


	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, 'Articles', $validator);
		$this->validator->setRules($this->scheme);
	}
}


?>