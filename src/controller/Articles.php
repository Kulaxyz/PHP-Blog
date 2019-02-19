<?php
namespace Kulaxyz\Blog\controller;

use Kulaxyz\Blog\core\Request;
use Kulaxyz\Blog\controller\Base;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\model\ArticlesModel;
use Kulaxyz\Blog\core\DB;
use Kulaxyz\Blog\core\Validator;
use Kulaxyz\Blog\core\Exceptions\ValidationException;
use Kulaxyz\Blog\core\Exceptions\NotFoundException;
use Kulaxyz\Blog\core\Exceptions\AuthException;
use Kulaxyz\Blog\core\DBDriver;
use Kulaxyz\Blog\core\Form\FormBuilder;
use Kulaxyz\Blog\forms\Add;

class Articles extends Base
{
	private $request;
	private $container;

	public function __construct(Request $request, HandyBoxContainer $container)
	{
		$this->request = $request;
		$this->container = $container;
	}

	public function indexAction()
	{
		$isAuth = $this->container->get('UserHelp')->isAuth($this->request->session(), $this->request->cookie());
		$model = $this->container->fabricate('model', 'Articles');

		if (!$model) {
			throw new ModelException();	
		}

		$articles = $model->getAll();
		$this->content = $this->build('index', ['articles' => $articles, 'isAuth' => $isAuth]);

	}
	
	public function articleAction()
	{
		$id = $this->request->get('id');
		$model = $this->container->fabricate('model', 'Articles');
		if (!$model) {
			throw new ModelException();	
		}
		$article = $model->getBy(['id' => $id]);
		if (!$article) {
			throw new NotFoundException('Такой статьи не найдено.');
		}

		$this->content = $this->build('article', ['article' => $article]);			
	}

	public function addAction()
	{
		$formBuilder = $this->container->fabricate('form-builder', 'Add', $this->request);

		$isAuth = $this->container->get('UserHelp')->isAuth($this->request->session(), $this->request->cookie());
		if (!$isAuth) {
			throw new AuthException();	
		} else {
			if($this->request->isPost()){
				$model = $this->container->fabricate('model', 'Articles');

				if (!$model) {
					throw new ModelException();		
				}				
				try {
					$id = $model->addOne($formBuilder->handleRequest());
					header("Location:" . ROOT . 'Articles/' . $id);
					exit();
				} catch (ValidationException $e) {
					$errors = $e->getErrors();
				}
			} else {
				$errors = '';
			}

			$this->content =  $this->build('add',  [
													'form' => $formBuilder,
													'errors' => $errors
													]
											);
		}
	}

	public function deleteAction()
	{
		$model = $this->container->fabricate('model', 'Articles');

		if (!$model) {
			throw new ModelException();	
		}		
		$isAuth = $this->container->get('UserHelp')->isAuth($this->request->session(), $this->request->cookie());
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
		$isAuth = $this->container->get('UserHelp')->isAuth($this->request->session(), $this->request->cookie());
		$id = $this->request->get('id');

		if (!$isAuth) {
			throw new AuthException();	
		} else {
			$model = $this->container->fabricate('model', 'Articles');

			if (!$model) {
				throw new ModelException();	
			}

			if ($this->request->isPost()) {	
				$params = $this->request->post();
				$where = ['id' => $id];
				try {
					$model->editOne($params, $where);
					header("Location:" . ROOT . 'Articles');
					exit();	
				} catch (ValidationException $e) {
					$errors = $e->getErrors();
				}		
			} else {
				$article = $model->getBy(['id' => $id]);

				if (!$article) {
					throw new NotFoundException('Такой статьи не найдено.');
				}

				$errors = '';
				$params = $article;
			}
			$this->content = $this->build('edit',  [
													'params' => $params,
													'errors' => $errors
													]
											);
		}
	}
}

?>
