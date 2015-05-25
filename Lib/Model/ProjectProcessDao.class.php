<?php
	class ProjectProcessDao extends Model{
		public function findByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_project_process where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}

		public function findById($project_process_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_project_process where project_process_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($project_process_id));
			return $statement->fetch();
		}
		
		public function addProjectProcess($resource_id,$process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_project_process(resource_id,process_name,quantity,unit,unit_price,plan_start_time,plan_duration,actual_start_time,plan_cost,material_budget) values(?,?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id,$process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function updateProjectProcess($project_process_id,$process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_pr_project_process set process_name=?,quantity=?,unit=?,unit_price=?,plan_start_time=?,plan_duration=?,actual_start_time=?,plan_cost=?,material_budget=? where project_process_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget,$project_process_id));
		}
		
		public function deleteProjectProcess($project_process_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_project_process where project_process_id=?";			
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($project_process_id));			
		}
		
		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_project_process where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>
