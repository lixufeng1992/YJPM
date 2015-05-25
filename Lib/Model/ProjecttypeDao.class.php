<?php
	class ProjecttypeDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_projecttype order by projecttypeid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		// public function findById($departmentid){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;'); 
		// 	$sql="select * from tb_department where departmentid=?";
		// 	$statement = $myPDO->prepare($sql);
		// 	$statement->execute(array($departmentid));
		// 	return $statement->fetch();
		// }

		// public function add($name){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;');
		// 	$sql="insert into tb_department(name) values(?)";
		// 	$statement = $myPDO->prepare($sql);
		// 	$result = $statement->execute(array($name));
		// 	if($result == false)return -1;
		// 	else return $myPDO->lastInsertId();
		// }

		// public function updateById($departmentid,$name){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;');
		// 	$sql="update tb_department set name=? where departmentid=?";
		// 	$statement = $myPDO->prepare($sql);
		// 	return $statement->execute(array($name,$departmentid));		
		// }

		// public function deleteById($departmentid){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;');
		// 	$sql="delete from tb_department where departmentid=?";
		// 	$statement = $myPDO->prepare($sql);
		// 	return $statement->execute(array($departmentid));		
		// }

	}




?>