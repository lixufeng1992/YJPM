<?php
	class MaterialcontractDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract order by contractid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetch();
		}

		public function findByResourceid($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_materialcontract where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}
	
		public function add($resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
							$duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
							$pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
							$other_limit_condition,$remark,$finalcost_userid,$check_userid,$create_userid,
							$create_date
			){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_materialcontract(resource_id,contract_number,name,a_part_enterpriseid,supplier_enterpriseid,
							duty_officer,companyid,departmentid,build_pattern,sign_date,
							pay_baseprice_according,margin_amount,pay_limit,check_grossamount_control,main_content,
							other_limit_condition,remark,finalcost_userid,check_userid,create_userid,
							create_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
							$duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
							$pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
							$other_limit_condition,$remark,$finalcost_userid,$check_userid,$create_userid,
							$create_date));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($contractid,$resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
							$duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
							$pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
							$other_limit_condition,$remark,$finalcost_userid,$check_userid,$create_userid,
							$create_date){
		 	$dsn = C('DB_DSN1');
		 	$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		 	$myPDO->query('set names utf8;');
		 	$sql="update tb_materialcontract set resource_id=?,contract_number=?,name=?,a_part_enterpriseid=?,supplier_enterpriseid=?,
							duty_officer=?,companyid=?,departmentid=?,build_pattern=?,sign_date=?,
							pay_baseprice_according=?,margin_amount=?,pay_limit=?,check_grossamount_control=?,main_content=?,
							other_limit_condition=?,remark=?,finalcost_userid=?,check_userid=?,create_userid=?,
							create_date=? where contractid=?";
		 	$statement = $myPDO->prepare($sql);
		 	return $statement->execute(array($resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
							$duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
							$pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
							$other_limit_condition,$remark,$finalcost_userid,$check_userid,$create_userid,
							$create_date,$contractid));	
		 }

		 public function updateCheckstatusById($contractid,$check_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_materialcontract set check_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($check_userid,$contractid));
		}

		public function updateFinalcoststatusById($contractid,$finalcost_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_materialcontract set finalcost_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($finalcost_userid,$contractid));
		}



		public function deleteById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_materialcontract where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid));		
		}

	}

?>