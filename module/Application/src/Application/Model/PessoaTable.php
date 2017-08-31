<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class PessoaTable extends AbstractTableGateway{
	
	protected $table = 's_pessoa';
	
	/**
	 * @author Ronily
	 * Configura o adapter para futuros manipulação de dados
	 */
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->resultSetPrototype = new ResultSet();
		$this->resultSetPrototype->setArrayObjectPrototype(new Pessoa());
		$this->initialize();
	}
	
	/**
	 * @author Ronily
	 * Cria a paginação com todos os registros no banco dados 
	 */
	public function fetchAll($pageNumber = 1,$countPerPage = 2,$buscar = null){
		$select = new Select();
		
		if($buscar == null){
			$select->from($this->table)->order('pessoa_nome');
		}else{
			$select->from($this->table)->order('pessoa_nome')->where(array('pessoa_nome LIKE ?' => "%$buscar%"));
		}
		
		$adapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
		$paginator = new Paginator($adapter);
		$paginator->setCurrentPageNumber($pageNumber);
		$paginator->setItemCountPerPage($countPerPage);
		
		return $paginator;
	}
	
	/**
	 * @author Ronily
	 * Carrega dados partindo do pessoa_cod
	 */
	public function getPessoa($idPessoa){
		$idPessoa = (int) $idPessoa;
		$rowSet = $this->select(array('pessoa_cod' => $idPessoa));
		$row = $rowSet->current();
		
		if(!$row){
			throw new \Exception("Registro $idPessoa não encontrado");
		}
		return $row;
	}
	
	/**
	 * @author Ronily
	 * Metodo de inserção ou atualização no banco de dados
	 */
	public function savePessoa(Pessoa $pessoa){
		$data = array(
			'pessoa_nome' => $pessoa->pessoa_nome,
			'pessoa_cpf' => $pessoa->pessoa_cpf,
			'pessoa_email' => $pessoa->pessoa_email,
			'pessoa_tel' => $pessoa->pessoa_tel
		);
		
		$idPessoa = (int) $pessoa->pessoa_cod;
		
		if($idPessoa == 0){
			try {
				$this->insert($data);
			}catch (Exception $e){
				$pdoException = $e->getPrevious();
				var_dump($pdoException);
				exit();
			}
		}else{
			if($this->getPessoa($idPessoa)){
				$this->update($data,array('pessoa_cod' => $idPessoa	));
			}else {
				throw new \Exception("O produto $idPessoa não existe");
			}
		}
	}
	
	/**
	 * @author Ronily
	 * Metodo de remoção no banco de dados
	 */
	public function removePessoa($idPessoa){
		
		$idPessoa = (int)$idPessoa;
		
		if($this->getPessoa($idPessoa)){
			$this->delete(array('pessoa_cod' => $idPessoa));
		}else{
			throw new \Exception("O produto $id não existe");		
		}
		
	}
	
	
	
	
	
	
	
	
}