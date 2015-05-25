<?php
	class PositionDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_position order by positionid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function add($name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_position(name) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($positionid,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_position set name=? where positionid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$positionid));		
		}

		public function deleteById($positionid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_position where positionid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($positionid));		
		}






	}




?>