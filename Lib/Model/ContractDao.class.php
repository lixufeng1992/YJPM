<?php
	class ContractDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract order by contractid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract where contractid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetch();
		}

		public function findByResourceid($resourceid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_contract where resourceid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resourceid));
			return $statement->fetchAll();
		}

		public function add($resourceid,$contract_name,$contract_number,$duty_officer,$companyid,
				$departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
				$buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
				$operation_status,$project_type,$project_category,$address,$total_quantities,
				$main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
				$supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
				$budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
				$finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
				$finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
				$remark,$check_userid,$finalcost_userid,$create_userid,$create_date
			){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_contract(
				resourceid,contract_name,contract_number,duty_officer,companyid,
				departmentid,build_pattern,contract_amount_money,project_manager,operation_mode,
				buying_from,sign_date,contract_start_date,contract_finish_date,scale,
				operation_status,project_type,project_category,address,total_quantities,
				main_content,a_part_enterpriseid,a_part_director,b_part_enterpriseid,b_part_director,
				supervisor_enterpriseid,accept_amount_start,budget_amount,budget_director,budget_create_date,
				budget_create_person,budget_submit_date,budget_confirm_amount,budget_remark,finalcost_amount,
				finalcost_director,finalcost_create_date,finalcost_create_person,finalcost_submit_date,finalcost_confirm_amount,
				finalcost_remark,audit_amount,audit_confirm_amount,audit_qualityassurance_amount,audit_remark,
				remark,check_userid,finalcost_userid,create_userid,create_date
				) values(?,?,?,?,?,?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,?
				)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array(
				$resourceid,$contract_name,$contract_number,$duty_officer,$companyid,
				$departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
				$buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
				$operation_status,$project_type,$project_category,$address,$total_quantities,
				$main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
				$supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
				$budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
				$finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
				$finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
				$remark,$check_userid,$finalcost_userid,$create_userid,$create_date
				));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($contractid,
			$resourceid,$contract_name,$contract_number,$duty_officer,$companyid,
				$departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
				$buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
				$operation_status,$project_type,$project_category,$address,$total_quantities,
				$main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
				$supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
				$budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
				$finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
				$finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
				$remark,$check_userid,$finalcost_userid,$create_userid,$create_date



			){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_contract set 
				resourceid=?,contract_name=?,contract_number=?,duty_officer=?,companyid=?,
				departmentid=?,build_pattern=?,contract_amount_money=?,project_manager=?,operation_mode=?,
				buying_from=?,sign_date=?,contract_start_date=?,contract_finish_date=?,scale=?,
				operation_status=?,project_type=?,project_category=?,address=?,total_quantities=?,
				main_content=?,a_part_enterpriseid=?,a_part_director=?,b_part_enterpriseid=?,b_part_director=?,
				supervisor_enterpriseid=?,accept_amount_start=?,budget_amount=?,budget_director=?,budget_create_date=?,
				budget_create_person=?,budget_submit_date=?,budget_confirm_amount=?,budget_remark=?,finalcost_amount=?,
				finalcost_director=?,finalcost_create_date=?,finalcost_create_person=?,finalcost_submit_date=?,finalcost_confirm_amount=?,
				finalcost_remark=?,audit_amount=?,audit_confirm_amount=?,audit_qualityassurance_amount=?,audit_remark=?,
				remark=?,check_userid=?,finalcost_userid=?,create_userid=?,create_date
				=?
			 	where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array(
				$resourceid,$contract_name,$contract_number,$duty_officer,$companyid,
				$departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
				$buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
				$operation_status,$project_type,$project_category,$address,$total_quantities,
				$main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
				$supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
				$budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
				$finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
				$finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
				$remark,$check_userid,$finalcost_userid,$create_userid,$create_date
				,$contractid
				));		
		}

		public function updateCheckstatusById($contractid,$check_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_contract set check_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($check_userid,$contractid));	
		}

		public function updateFinalcoststatusById($contractid,$finalcost_userid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_contract set finalcost_userid=? where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($finalcost_userid,$contractid));	
		}

		public function deleteById($contractid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_contract where contractid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($contractid));		
		}

	}




?>