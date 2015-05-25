<?php
	class MaterialcontractDocumentDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_document order by documentid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_document where documentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($documentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_document where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_materialcontract_document(contractid,name,path,remark,create_userid,lastupdate_userid,checked_userid) values(?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($documentid,$contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_materialcontract_document set contractid=?,name=?,path=?,remark=?,create_userid=?,lastupdate_userid=?,checked_userid=? where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid,$documentid));		
		}

		public function deleteById($documentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_materialcontract_document where documentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($documentid));		
		}

	}




?>