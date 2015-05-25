<?php
	class SubcontractDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_subcontract order by contractid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_subcontract where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetch();
		}

		public function findByResourceid($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_subcontract where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}

		public function add($resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
							$b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
							$sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
							$check_grossamount_control,$main_content,$other_limit_condition,$create_userid,$create_date,
							$finalcost_userid,$check_userid,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_subcontract(
				resource_id,contract_number,name,contract_type,a_part_enterpriseid,
				b_part_enterpriseid,build_pattern,contract_status,construction_start_date,construction_finish_date,
				sign_date,report_price,pay_baseprice_according,margin_amount,pay_limit,
				check_grossamount_control,main_content,other_limit_condition,create_userid,create_date,
				finalcost_userid,check_userid,remark
				) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array(
				$resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
				$b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
				$sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
				$check_grossamount_control,$main_content,$other_limit_condition,$create_userid,$create_date,
				$finalcost_userid,$check_userid,$remark
				));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($contractid,
			$resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
			$b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
			$sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
			$check_grossamount_control,$main_content,$other_limit_condition,$create_userid,$create_date,
			$finalcost_userid,$check_userid,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_subcontract set resource_id=?,contract_number=?,name=?,contract_type=?,a_part_enterpriseid=?,
			b_part_enterpriseid=?,build_pattern=?,contract_status=?,construction_start_date=?,construction_finish_date=?,
			sign_date=?,report_price=?,pay_baseprice_according=?,margin_amount=?,pay_limit=?,
			check_grossamount_control=?,main_content=?,other_limit_condition=?,create_userid=?,create_date=?,
			finalcost_userid=?,check_userid=?,remark=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
							$b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
							$sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
							$check_grossamount_control,$main_content,$other_limit_condition,$create_userid,$create_date,
							$finalcost_userid,$check_userid,$remark,$contractid));		
		}

		public function updateCheckstatusById($contractid,$check_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_subcontract set check_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($check_userid,$contractid));
		}

		public function updateFinalcoststatusById($contractid,$finalcost_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_subcontract set finalcost_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($finalcost_userid,$contractid));
		}

		public function deleteById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_subcontract where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid));
		}

	}




?>