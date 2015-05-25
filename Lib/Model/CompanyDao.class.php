<?php
	class companyDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_company order by companyid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($companyid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_company where companyid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($companyid));
			return $statement->fetch();
		}

		public function add($name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_company(name) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($companyid,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_company set name=? where companyid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$companyid));		
		}

		public function deleteById($companyid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_company where companyid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($companyid));		
		}

	}



?>
