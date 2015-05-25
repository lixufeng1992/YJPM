<?php
	class SubmitbiddocdateDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_submitbiddocdate order by submitbiddocdate_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_submitbiddocdate where projectid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($submitbiddocdate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_submitbiddocdate where submitbiddocdate_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($submitbiddocdate_id));
			return $statement->fetch();
		}

	public function add($projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_submitbiddocdate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($submitbiddocdate_id,$projectid,$date,$preremind_days,$is_finished){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_submitbiddocdate set projectid=?,date=?,preremind_days=?,is_finished=? where submitbiddocdate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$submitbiddocdate_id));		
		}

		public function deleteById($submitbiddocdate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_submitbiddocdate where submitbiddocdate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($submitbiddocdate_id));		
		}

	}




?>