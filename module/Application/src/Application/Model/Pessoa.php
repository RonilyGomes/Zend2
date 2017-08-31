<?php

namespace Application\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Application\Util\ConvUtil;

class Pessoa extends ConvUtil implements InputFilterAwareInterface{
	
	public $pessoa_cod;
	public $pessoa_nome;
	public $pessoa_cpf;
	public $pessoa_email;
	public $pessoa_tel;
	public $buscar;
	
	protected $inputFilter;
	
	/**
	 * @author Ronily
	 * Verifica se foi configurado cada parte do objeto vindo do formulario por post
	 */
	public function ExchangeArray($data){
		
		$this->pessoa_cod = isset($data['pessoa_cod']) ? $data['pessoa_cod'] : null;
		$this->pessoa_nome = isset($data['pessoa_nome']) ? $data['pessoa_nome'] : null;
		$this->pessoa_email = isset($data['pessoa_email']) ? $data['pessoa_email'] : null;
		$this->pessoa_cpf = isset($data['pessoa_cpf']) ? ConvUtil::limpaCpf($data['pessoa_cpf']) : null;
		$this->pessoa_tel = isset($data['pessoa_tel']) ? $data['pessoa_tel'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	/**
	 * @author Ronily
	 * Exceção 
	 */
	public function setInputFilter(InputFilterInterface $inputFilter){
		throw new \Exception('Not Used');
	}
	
	/**
	 * @author Ronily
	 * Carrega toda validação partindo dos dados vindo do formulario por post
	 */
	public function getInputFilter(){
		
		if(!$this->inputFilter){
			
			$inputFilter = new InputFilter();
			
			$factory = new InputFactory ();
			
			//setando pessoa_cod
			$inputFilter->add($factory->createInput(array(
				'name' => 'pessoa_cod',
				'required' => 'false',
				'filters' => array(
					array('name' => 'Int')
				)
			)));
			
			//setando pessoa_nome
			$inputFilter->add($factory->createInput(array(
				'name' => 'pessoa_nome',
				'required' => 'true',
				'filters' => array(
					array('name' => 'stripTags'),
					array('name' => 'stringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array(
								'isEmpty' => 'Preencha o campo'
							)
						)
					)
				)
			)));
			
			//setando pessoa_cpf
			$inputFilter->add($factory->createInput(array(
				'name' => 'pessoa_cpf',
				'required' => 'true',
				'filters' => array(
					array('name' => 'stripTags'),
					array('name' => 'stringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array(
								'isEmpty' => 'Prencha o campo'
							)
						)
					)
				)
			)));
			
			//setando pessoa_email
			$inputFilter->add($factory->createInput(array(
				'name' => 'pessoa_email',
				'required' => 'true',
				'filters' => array(
					array('name' => 'stripTags'),
					array('name' => 'stringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array(
								'isEmpty' => 'Preencha o campo'
							)
						) 
					)
				)
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name' => 'pessoa_tel',
					'required' => 'true',
					'filters' => array(
							array('name' => 'stripTags'),
							array('name' => 'stringTrim')
					),
					'validators' => array(
							array(
									'name' => 'NotEmpty',
									'options' => array(
											'messages' => array(
													'isEmpty' => 'Preencha o campo'
											)
									)
							)
					)
			)));
			
			$this->inputFilter = $inputFilter;	
		}
		return $this->inputFilter;
	}
}