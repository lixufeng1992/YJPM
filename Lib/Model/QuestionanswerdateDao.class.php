<?php
	class QuestionanswerdateDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_questionanswerdate order by questionanswerdate_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_questionanswerdate where projectid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($questionanswerdate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_questionanswerdate where questionanswerdate_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($questionanswerdate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_questionanswerdate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($questionanswerdate_id,$projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_questionanswerdate set projectid=?,date=?,preremind_days=?,is_finished=? where questionanswerdate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$questionanswerdate_id));		
		}

		public function deleteById($questionanswerdate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_questionanswerdate where questionanswerdate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($questionanswerdate_id));		
		}

	}




?>