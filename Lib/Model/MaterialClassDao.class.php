<?php
	class MaterialClassDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_class order by classid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($classid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_class where classid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($classid));
			return $statement->fetch();
		}

		public function add($name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_material_class(name) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($classid,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_material_class set name=? where classid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$classid));		
		}

		public function deleteById($classid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_material_class where classid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($classid));		
		}

	}




?>