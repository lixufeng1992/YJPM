<?php
	class MaterialDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material order by materialid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($materialid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material where materialid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($materialid));
			return $statement->fetch();
		}

		public function findByCategoryid($categoryid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material where categoryid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($categoryid));
			return $statement->fetchAll();
		}

		public function add($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_material(name,categoryid,worktype,unit,price_in,parameter,specification,brand) values(?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($materialid,$name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_material set name=?,categoryid=?,worktype=?,unit=?,price_in=?,parameter=?,specification=?,brand=? where materialid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand,$materialid));		
		}

		public function deleteById($materialid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_material where materialid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($materialid));		
		}

	}




?>