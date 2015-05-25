<?php
	class MargindateDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_margindate order by margindate_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_margindate where projectid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($margindate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_margindate where margindate_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($margindate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_margindate(projectid,date,preremind_days,amount,is_submit,is_getback) values(?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($margindate_id,$projectid,$date,$preremind_days,$amount,$is_submit,$is_getback){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_margindate set projectid=?,date=?,preremind_days=?,amount=?,is_submit=?,is_getback=? where margindate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback,$margindate_id));		
		}

		public function deleteById($margindate_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_margindate where margindate_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($margindate_id));		
		}

	}




?>