<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\PessoaForm;
use Application\Model\Pessoa;
use Zend\View\Model\ViewModel;
use Application\Form\SearchForm;

class PessoasController extends AbstractActionController{
	
	protected $pessoaTable;
	
	/**
	 * @author Ronily
	 * Finaliza o objeto 
	 */
	public function getPessoaTable(){
		if(!$this->pessoaTable){
			$sm = $this->getServiceLocator();
			$this->pessoaTable = $sm->get('pessoa_table');
		}
		return $this->pessoaTable;
	}
	
	/**
	 * @author Ronily
	 * Executa msgs de sucesso, paginação de pessoas no banco e uma possivel buscar
	 */
	public function indexAction(){
		
		$messages = $this->flashMessenger()->getMessages();
		$pageNumber = (int) $this->params()->fromQuery('pagina');
	
		if($pageNumber == 0){
			$pageNumber = 1;
		}
		
		$buscar = $this->params()->fromQuery('buscar');
	
		$pessoas = $this->getPessoaTable()->fetchAll($pageNumber,8,$buscar);
		return new ViewModel(array(
				'messages' => $messages,
				'pessoas' => $pessoas
		));
	}
	
	/**
	 * @author Ronily
	 * Carrega Formulario do PessoaForm, Cria o objeto Pessoa com as devidas validações e retorna para o index 
	 * se obter sucesso 
	 */
	public function CadastroAction(){
		
		$form = new PessoaForm();
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			//isntanciando o Model Pessoa
			$pessoa = new Pessoa();
			
			//pegando os dados postados
			$data=$request->getPost();
			
			$form->setInputFilter($pessoa->getInputFilter());
			$form->setData($data);
			
			if($form->isValid()){
				$pessoa->ExchangeArray($data);
				$this->getPessoaTable()->savePessoa($pessoa);
				
				$this->flashMessenger ()->addMessage ( array ('success' => 'Cadastro efetuado com sucesso') );
				$this->redirect ()->toUrl ( '/pessoas' );		
			}
		}
		$view = new ViewModel(array(
			'titulo' => 'Cadastro de Pessoas',
			'form' => $form
		));	
		return $view;
	}
	
	/**
	 * @author Ronily
	 * Carrega dados partindo do pessoa_cod, Mescla o objeto Pessoa com as devidas validações e retorna para o index
	 * se obter sucesso
	 */
	public function EditarAction(){
		
		$cod = $this->params('id');
		
		$pessoa = $this->getPessoaTable()->getPessoa($cod);
		
		$form = new PessoaForm();
		$form->setBindOnValidate(false);
		$form->bind($pessoa);
		$form->get('submit')->setLabel('Editar');
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$nomFile = $request->getPost()->toArray();
			$data = array_merge($nomFile);
			$form->setData($data);
			
			if ($form->isValid()){
				
				$form->bindValues();
				
				$this->getPessoaTable()->savePessoa($pessoa);
				$this->flashMessenger()->addMessage(array('success' => 'Pessoa atualizada com sucesso'));
				$this->redirect()->toUrl('/pessoas');
			}
		}
		
		$view = new ViewModel(array(
			'titulo' => 'Atualização de Pessoas',
			'form' => $form
		));
		$view->setTemplate('application/pessoas/cadastro.phtml');
		return $view;
		
	}
	
	/**
	 * @author Ronily
	 * Remove um registro do banco de dados partindo do cod_pessoa
	 */
	public function RemoveAction(){
		
		$cod = $this->params('id');
		
		$pessoa = $this->getPessoaTable()->removePessoa($cod);
		
		$this->flashMessenger()->addMessage(array('success' => 'Pessoa excluida com sucesso'));
		$this->redirect()->toUrl('/pessoas');
		
		$view = new ViewModel();
		$view->setTemplate('/pessoas');
		
		return $view;
	}
}
	


