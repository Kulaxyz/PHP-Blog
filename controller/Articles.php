<?php
namespace controller;
use core\Request;
use model\ArticlesModel;
use core\DB;
use core\Validator;
use core\Exceptions\ValidationException;
use core\Exceptions\NotFoundException;
use core\Exceptions\AuthException;
use core\DBDriver;


class Articles extends Base
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function indexAction()
	{
		$isAuth = $this->request->session('isAuth');
		$model = new ArticlesModel(
									new DBDriver(DB::connect()),
									new Validator()
								   );
		if (!$model) {
			throw new ModelException();	
		}
		$articles = $model->getAll();
		$this->content = $this->build('index', ['articles' => $articles, 'isAuth' => $isAuth]);
		}
	
	public function articleAction()
	{
		$id = $this->request->get('id');
		$model = new ArticlesModel(
									new DBDriver(DB::connect()),
									new Validator()
								   );
		if (!$model) {
			throw new ModelException();	
		}
		$article = $model->getById($id);
		if (!$article) {
			throw new NotFoundException('Такой статьи не найдено.');
		}

		$this->content = $this->build('article', ['article' => $article]);			
	}

	public function addAction()
	{
		$isAuth = $this->request->session('isAuth');
		if (!$isAuth) {
			throw new AuthException();	
		} else {
			if($this->request->isPost()){
				$title = trim(sprintf('%s', $this->request->post('title')));
				$content = trim(sprintf("%s", $this->request->post('content')));
				$author = trim(sprintf('%s', $this->request->post('author')));
				$params = [
							'title' => $title,
					 	 	'content' => $content,
					 		'author' => $author,
					 	  ];
				$model = new ArticlesModel(
											new DBDriver(DB::connect()),
											new Validator()
				  						  );
				if (!$model) {
					throw new ModelException();
					
				}				
				try {
					$id = $model->addOne($params);
					header("Location:" . ROOT . 'Articles/' . $id);
					exit();
				} catch (ValidationException $e) {
					$errors = $e->getErrors();
				}
			}
			else {
				$title = '';
				$content = '';
				$author = '';
				$errors = '';

			}

			$this->content =  $this->build('add',  [
													'title' => $title,
													'content' => $content,
													'author' => $author,
													'errors' => $errors
													]
											);
		}
	}

	public function deleteAction()
	{
		$model = new ArticlesModel(
									new DBDriver(DB::connect()),
									new Validator()
								   );
		if (!$model) {
			throw new ModelException();	
		}		
		$isAuth = $this->request->session('isAuth');
		$id = $this->request->get('id');

		if(!$isAuth) {
			throw new AuthException();	
		}
		else {
			$model->deleteOne($id);
			header("Location:" . ROOT . 'Articles');
		}
	}

	public function editAction()
	{
		$isAuth = $this->request->session('isAuth');
		$id = $this->request->get('id');

		if (!$isAuth) {
			throw new AuthException();	
		} else {
			$model = new ArticlesModel(
										new DBDriver(DB::connect()),
										new Validator()
									   );
			if (!$model) {
				throw new ModelException();
				
			}
			if ($this->request->isPost()) {
				$title = sprintf('%s', $this->request->post('title'));
				$content = sprintf("%s", $this->request->post('content'));
				$author = sprintf('%s', $this->request->post('author'));
				$params = ['title' => $title,
				 			'content' => $content,
				 			'author' => $author
				 		   ];
				$where = ['id' => $id];
				try {
					$model->editOne($params, $where);
					header("Location:" . ROOT . 'Articles');
					exit();	
				} catch (ValidationException $e) {
					$errors = $e->getErrors();
				}		
			}
			else {
				$article = $model->getById($id);

				if (!$article) {
					throw new NotFoundException('Такой статьи не найдено.');
				}

				$title = $article['title'];
				$content = $article['content'];
				$author = $article['author'];
				$errors = '';
			}
			$this->content = $this->build('edit',  [
													'title' => $title,
													'content' => $content,
													'author' => $author,
													'errors' => $errors
													]
											);
		}
	}
}

?>
