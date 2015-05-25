<?php
	class ContractContentDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_content order by contentid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_content where contentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract_content where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$category,$name,$unit,$price_perunit,$amount,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_contract_content (contractid,category,name,unit,price_perunit,amount,remark) values(?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$category,$name,$unit,$price_perunit,$amount,$remark));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($contentid,$contractid,$category,$name,$unit,$price_perunit,$amount,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_contract_content set contractid=?,category=?,name=?,unit=?,price_perunit=?,amount=?,remark=? where contentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid,$category,$name,$unit,$price_perunit,$amount,$remark,$contentid));		
		}

		public function deleteById($contentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_contract_content where contentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contentid));		
		}

	}




?>