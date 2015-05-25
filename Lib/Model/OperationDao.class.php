<?php
	class OperationDao extends Model{

		public function findById($operationid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_operation where operationid= ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($operationid));
			return $statement->fetch();
		}
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_operation order by operationid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();	
		}

	}

?>