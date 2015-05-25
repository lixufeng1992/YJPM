<?php
	class ProcessClassifyDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_process_classify order by process_classify_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($process_classify_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_process_classify where process_classify_id = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($process_classify_id));
			$employerrow = $statement->fetch();
			return $employerrow;
		}

		public function add($process_classify_name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_process_classify(process_classify_name) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($process_classify_name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
        
		public function updateById($process_classify_id,$process_classify_name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_process_classify set process_classify_name=? where process_classify_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($process_classify_name,$process_classify_id));
		}

		public function deleteById($process_classify_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_process_classify where process_classify_id=?";			
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($process_classify_id));			
		}


	}




?>