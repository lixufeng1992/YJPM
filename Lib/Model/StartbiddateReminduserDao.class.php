<?php
	class StartbiddateReminduserDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_startbiddate_reminduser order by id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByStartbiddateid($startbiddate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_startbiddate_reminduser where startbiddate_id=? order by id asc";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($startbiddate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_startbiddate_reminduser where id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($startbiddate_id,$userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_startbiddate_reminduser(startbiddate_id,userid) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($startbiddate_id,$userid));
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
			$sql="delete from tb_startbiddate_reminduser where id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}




?>