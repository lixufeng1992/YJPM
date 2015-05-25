<?php
	class ContractDocumentOriginDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_document_origin order by documentid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_document_origin where documentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($documentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_document_origin where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$name,$path,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_contract_document_origin(contractid,name,path,remark) values(?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$name,$path,$remark));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($documentid,$contractid,$name,$path,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_contract_document_origin set contractid=?,name=?,path=?,remark=? where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid,$name,$path,$remark,$documentid));		
		}

		public function deleteById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_contract_document_origin where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($documentid));		
		}

	}




?>