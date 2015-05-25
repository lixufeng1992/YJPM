<?php
	class StartbiddateDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_startbiddate order by startbiddate_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_startbiddate where projectid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($startbiddate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_startbiddate where startbiddate_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($startbiddate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_startbiddate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($startbiddate_id,$projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_startbiddate set projectid=?,date=?,preremind_days=?,is_finished=? where startbiddate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$startbiddate_id));		
		}

		public function deleteById($startbiddate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_startbiddate where startbiddate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($startbiddate_id));		
		}

	}




?>