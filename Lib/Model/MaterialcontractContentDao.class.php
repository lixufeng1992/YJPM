<?php
	class MaterialcontractContentDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_content order by contentid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_content where contentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract_content where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_materialcontract_content (contractid,material_id,enquiry_id,amount,remark,plan_id) values(?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($contentid,$contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_materialcontract_content set contractid=?,material_id=?,enquiry_id=?,amount=?,remark=?,plan_id=? where contentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id,$contentid));		
		}

		public function deleteById($contentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_materialcontract_content where contentid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contentid));		
		}

	}




?>