<?php
	class ProjectDocumentDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_document order by documentid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_document where documentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($documentid));
			return $statement->fetch();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_document where projectid=? order by documentid asc";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetchAll();
		}

		// public function findBy_projectid_xserialNumber($projectid,$serialNumberStr){
		// 	$dsn = C('DB_DSN1');
		// 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		// 	$myPDO->query('set names utf8;'); 
		// 	$sql="select * from tb_project_document where projectid=? and serial_number like=? order by documentid asc";
		// 	$statement = $myPDO->prepare($sql);
		// 	$serialNumberStr .="*";
		// 	$statement->execute(array($projectid,$serialNumberStr));
		// 	return $statement->fetchAll();
		// }





		public function add($projectid,$serial_number,$name,$path,$update_date,
								$remark,$create_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_project_document(projectid,serial_number,name,path,update_date,
								remark,create_userid) values(?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$serial_number,$name,$path,$update_date,
								$remark,$create_userid));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($documentid,$projectid,$serial_number,$name,$path,$update_date,
								$remark,$create_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_project_document set projectid=?,serial_number=?,name=?,path=?,update_date=?,
								remark=?,create_userid=? where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$serial_number,$name,$path,$update_date,
								$remark,$create_userid,$documentid));		
		}

		public function deleteById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_project_document where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($documentid));		
		}

	}




?>