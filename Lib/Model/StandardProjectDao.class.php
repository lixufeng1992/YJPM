<?php
	class StandardProjectDao extends Model{
		public function add($resource_id,$prname,$enterprise_1partid,$enterprise_supervisorid,
												$total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
												$receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
												$materialbuyingplanaudit_setting,$infield_pattern,$infield_site){
						
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_standardproject(resource_id,prname,enterprise_1partid,enterprise_supervisorid,
												total_quantites,construct_layers,pm_name,vice_pm_name,startdate_actually,finishdate_actually,
												receivestuff_address,receiveperson_phonenumber,description,materialbuyingprocess_setting,
												materialbuyingplanaudit_setting,infield_pattern,infield_site) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$statement=$myPDO->prepare($sql);
			$result=$statement->execute(array($resource_id,$prname,$enterprise_1partid,$enterprise_supervisorid,
												$total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
												$receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
												$materialbuyingplanaudit_setting,$infield_pattern,$infield_site));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function findExistId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select standardprojectid from tb_pr_standardproject where resource_id=?";
			$statement=$myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();		
		}
		
		public function updateById($exist_id,$prname,$enterprise_1partid,$enterprise_supervisorid,
															$total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
															$receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
															$materialbuyingplanaudit_setting,$infield_pattern,$infield_site){
		
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_pr_standardproject set prname=?,enterprise_1partid=?,enterprise_supervisorid=?,
												total_quantites=?,construct_layers=?,pm_name=?,vice_pm_name=?,startdate_actually=?,finishdate_actually=?,
												receivestuff_address=?,receiveperson_phonenumber=?,description=?,materialbuyingprocess_setting=?,
												materialbuyingplanaudit_setting=?,infield_pattern=?,infield_site=? where standardprojectid=?";
			$statement=$myPDO->prepare($sql);
			$result=$statement->execute(array($prname,$enterprise_1partid,$enterprise_supervisorid,
												$total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
												$receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
												$materialbuyingplanaudit_setting,$infield_pattern,$infield_site,$exist_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function findByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_standardproject where resource_id=?";
			$statement=$myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			$result=$statement->fetch();
			return $result;
		}
		
		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_standardproject where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>