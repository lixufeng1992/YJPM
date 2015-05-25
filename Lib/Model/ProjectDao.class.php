<?php
class ProjectDao extends Model{

//find-----------------------------------------------------------------
	public function findAll(){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="select * from tb_project order by projectid asc";
		$statement = $myPDO->query($sql);
		return $statement->fetchAll();
	}

	//按id号查找工程
	//返回-1表示查找失败
	public function findById($projectid){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="select count(*) from tb_project where projectid = ?";
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($projectid));
		$result = $statement->fetch();
		if($result[0] == 0)return -1;

		$sql="select * from tb_project where projectid = ?";
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($projectid));
		$projectrow = $statement->fetch();
		return $projectrow;
	}
//find===========================================================================

//add------------------------------------------------------------------------------------------
	//返回-1表示插入失败 成功则返回表中的id号
	public function add($projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
						$construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
						$constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
						$constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
						$covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
						$isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
						$drawback
						){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');

		$sql="insert into tb_project (projectname,currentstatusid,clerkname,build_enterpriseid,design_enterpriseid,
						construct_enterpriseid,mediator_enterpriseid,mediator_constract,project_address,project_type,
						constract_counterparty,a_project_director_name,a_project_director_phone,a_technology_director_name,a_technology_director_phone,
						constructunit_director_name,constructunit_director_phone,biddoc_type,getbid_price,use_purpose,
						covered_area,info_source,scale,project_basic_info,isknown_bid_date,
						isknown_questionanswer_date,isknown_submitbiddoc_date,isknown_startbid_date,isknown_margin_date,advantage,
						drawback) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$statement = $myPDO->prepare($sql);
		$result = $statement->execute(array($projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
						$construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
						$constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
						$constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
						$covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
						$isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
						$drawback));
		if($result == false)return -1;
		else return $myPDO->lastInsertId();

	}
//add====================================================================================




//delete---------------------------------------------------------------------------------
	public function deleteById($projectid){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="delete from tb_project where projectid=?";
		$statement = $myPDO->prepare($sql);
		return $statement->execute(array($projectid));
	}
	
//delete===============================================================================

// 	//按roleid号查找用户
// 	public function findByRoleid($roleid){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;'); 
// 		$sql="select * from tb_user where roleid = ?";
// 		$statement = $myPDO->prepare($sql);
// 		$statement->execute(array($roleid));
// 		return $statement->fetchAll();
// 	}

//update-----------------------------------------------------------------------------------
// 	public function updateById($userid,$username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,
// 								$is_salary_forbidden,$is_materialprice_forbidden,$remark,$roleid,$employerid){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');
// 		$sql="update tb_user set username=?,password=?,verify_password=?,companyid=?,departmentid=?,phone_number=?,is_admin=?,is_leader=?,
// 				is_salary_forbidden=?,is_materialprice_forbidden=?,remark=?,roleid=?,employerid=? where userid=?";
// 		$statement = $myPDO->prepare($sql);
// 		return $statement->execute(array($username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,
// 					$is_salary_forbidden,$is_materialprice_forbidden,$remark,$roleid,$employerid,$userid));

// 	}
public function updateById($projectid,$projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
						$construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
						$constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
						$constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
						$covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
						$isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
						$drawback
						){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');

		$sql="update tb_project set projectname=?,currentstatusid=?,clerkname=?,build_enterpriseid=?,design_enterpriseid=?,
						construct_enterpriseid=?,mediator_enterpriseid=?,mediator_constract=?,project_address=?,project_type=?,
						constract_counterparty=?,a_project_director_name=?,a_project_director_phone=?,a_technology_director_name=?,a_technology_director_phone=?,
						constructunit_director_name=?,constructunit_director_phone=?,biddoc_type=?,getbid_price=?,use_purpose=?,
						covered_area=?,info_source=?,scale=?,project_basic_info=?,isknown_bid_date=?,
						isknown_questionanswer_date=?,isknown_submitbiddoc_date=?,isknown_startbid_date=?,isknown_margin_date=?,advantage=?,
						drawback=? where projectid=?";
		$statement = $myPDO->prepare($sql);
		return $statement->execute(array($projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
						$construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
						$constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
						$constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
						$covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
						$isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
						$drawback,$projectid));

	}






// 	public function updateRoleidById($userid,$roleid){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');
// 		$sql="update tb_user set roleid=? where userid=?";
// 		$statement = $myPDO->prepare($sql);
// 		return $statement->execute(array($roleid,$userid));
// 	}

// 	public function updatePasswordById($userid,$password){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');
// 		$sql="update tb_user set password=? where userid=?";
// 		$statement = $myPDO->prepare($sql);
// 		return $statement->execute(array($password,$userid));
// 	}

// 	public function updateVerifyPasswordById($userid,$password){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');
// 		$sql="update tb_user set verify_password=? where userid=?";
// 		$statement = $myPDO->prepare($sql);
// 		return $statement->execute(array($password,$userid));
// 	}

// //add------------------------------------------------------------------------------------------
// 	//插入用户数据
// 	//返回-1表示插入失败 返回-2表示存在多个相同用户名 成功则返回表中的id号
// 	public function add($username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,
// 							$is_salary_forbidden,$is_materialprice_forbidden,$remark,$roleid,$employerid){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');

// 		$sql="select count(*) from tb_user where username=?";
// 		$statement = $myPDO->prepare($sql);
// 		$statement->execute(array($username));
// 		$row = $statement->fetch();
// 		if($row[0]>0)return -2;

// 		$sql="insert into tb_user (username,password,verify_password,companyid,departmentid,phone_number,is_admin,is_leader,is_salary_forbidden,
// 				ismaterialprice_forbidden,remark,roleid,employerid) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
// 		$statement = $myPDO->prepare($sql);
// 		$result = $statement->execute(array($username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,$is_salary_forbidden,$is_materialprice_forbidden,$remark,$roleid,$employerid));
// 		if($result == false)return -1;
// 		else return $myPDO->lastInsertId();

// 	}





// //other-------------------------------------------------------------------------------------
// 	//测试用户名是否已存在
// 	public function is_username_exist($username){
// 		$dsn = C('DB_DSN1');
// 		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
// 		$myPDO->query('set names utf8;');
// 		$sql="select count(*) from tb_user where username=?";
// 		$statement = $myPDO->prepare($sql);
// 		$result = $statement->execute(array($username));
// 		$row = $statement->fetch();
// 		if($row[0]>0)return true;
// 		else return false;
// 	}

//项目资源导入
		public function findALL_0_1_2_3_4_5(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select projectid,projectname,currentstatusid,clerkname,build_enterpriseid,design_enterpriseid from tb_project order by projectid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		} 

}

?>
