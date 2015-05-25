<?php
	class SubmitbiddocdateReminduserDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_submitbiddocdate_reminduser order by id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findBySubmitbiddocdateid($submitbiddocdate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_submitbiddocdate_reminduser where submitbiddocdate_id=? order by id asc";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($submitbiddocdate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_submitbiddocdate_reminduser where id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($submitbiddocdate_id,$userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_submitbiddocdate_reminduser(submitbiddocdate_id,userid) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($submitbiddocdate_id,$userid));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		// public function updateById($departmentid,$name){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;');
		// 	$sql="update tb_department set name=? where departmentid=?";
		// 	$statement = $myPDO->prepare($sql);
		// 	return $statement->execute(array($name,$departmentid));		
		// }

		public function deleteById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_submitbiddocdate_reminduser where id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}




?>