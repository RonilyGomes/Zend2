<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;

class PessoaForm extends Form{
	
	/**
	 * @author Ronily
	 * cria o formulario
	 */
	public function __construct($name = null){
		
		parent::__construct('pessoa');
		
		$this->setAttribute('enctype', 'multipart/form-data');
		
		
		//Definindo os campos do formulario
		$cod = new Hidden('pessoa_cod');
		
		$nome = new Text('pessoa_nome');
		$nome->setLabel('*Nome: ')
			 ->setAttributes(array(
			 	'class' => 'form-control',
			 	'placeholder' => 'Digite seu nome'
			 ));
		
		$cpf = new Text('pessoa_cpf');
		$cpf->setLabel('*CPF: ')
			->setAttributes(array(
				'class' => 'form-control',
				'placeholder' => '___.___.___-__',
				'id' => 'cpf'
			));
		
		$email = new Text('pessoa_email');
		$email->setLabel('*Email: ')
			  ->setAttributes(array(
			  	'class' => 'form-control',
			  	'placeholder' => 'example@example.com'
			  ));
			  
		$tel = new Text('pessoa_tel');
		$tel->setLabel('*Telefone: ')
		  ->setAttributes(array(
			'class' => 'form-control',
		  	'placeholder' => '(__) _____-____',
		  	'id' => 'tel'
		  ));
			  
		$botao = new Button('submit');
		$botao->setLabel('Cadastrar')
			  ->setAttributes(array(
				'class' => 'btn btn-primary',
				'type' => 'submit'
		));
			   
		$this->add($cod);
		$this->add($nome);
		$this->add($cpf);
		$this->add($email);
		$this->add($tel);
		$this->add($botao);
			 
		
	}
}