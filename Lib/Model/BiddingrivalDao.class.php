<?php
	class BiddingrivalDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_biddingrival order by biddingrivalid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($biddingrivalid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_biddingrival where biddingrivalid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($biddingrivalid));
			return $statement->fetch();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_biddingrival where projectid=? order by biddingrivalid asc";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetchAll();
		}


		public function add($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_biddingrival(projectid,name,linkman,linkman_phone,
								linkman_ourside,cooperation_type,remark) values(?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($biddingrivalid,$projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_biddingrival set projectid=?,name=?,linkman=?,linkman_phone=?,
								linkman_ourside=?,cooperation_type=?,remark=? where biddingrivalid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark,$biddingrivalid));		
		}

		public function deleteById($biddingrivalid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_biddingrival where biddingrivalid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($biddingrivalid));		
		}

	}




?>