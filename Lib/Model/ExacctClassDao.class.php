<?php
	class ExacctClassDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_exacctclass order by exacctclassid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_exacctclass where exacctclassid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_exacctclass(name) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($id,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_exacctclass set name=? where exacctclassid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$id));		
		}

		public function deleteById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_exacctclass where exacctclassid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}



?>
