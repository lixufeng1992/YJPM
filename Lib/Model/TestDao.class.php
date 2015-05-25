<?php
	class TestDao extends Model{
		public function add($isit){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="insert into tb_test(isit) values(?)";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($isit));
		}

	}




?>