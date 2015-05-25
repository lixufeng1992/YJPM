<?php
	class MaterialCategoryDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_category order by categoryid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($categoryid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_category where categoryid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($categoryid));
			return $statement->fetch();
		}

		public function findByClassid($classid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_category where classid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($classid));
			return $statement->fetchAll();
		}

		public function add($classid,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_material_category(classid,name) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($classid,$name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($categoryid,$classid,$name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_material_category set classid=?,name=? where categoryid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($classid,$name,$categoryid));		
		}

		public function deleteById($categoryid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_material_category where categoryid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($categoryid));		
		}

	}




?>