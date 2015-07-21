<?php
	class (tbname)Dao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_(tbname) order by (tbname)id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_(tbname) where (tbname)id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add(...){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_(tbname)(...) values(...)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array(...));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($id,...){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_(tbname) set ...=?,...=? where (tbname)id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array(...,$id));		
		}

		public function deleteById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_(tbname) where (tbname)id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}



?>
