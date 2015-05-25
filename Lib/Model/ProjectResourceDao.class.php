<?php
	class ProjectResourceDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_projectresource order by resource_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_projectresource where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_projectresource where project_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}
		
		public function add($project_id,$resource_name,$resource_type,$resource_belonged_subsidiary,$resource_user_authority,$resource_father_id,$resource_level,$resource_haschildren){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_projectresource(project_id,resource_name,resource_type,resource_belonged_subsidiary,resource_user_authority,resource_father_id,resource_level,resource_haschildren) values(?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($project_id,$resource_name,$resource_type,$resource_belonged_subsidiary,$resource_user_authority,$resource_father_id,$resource_level,$resource_haschildren));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function updateFather($resource_haschildren,$resource_father_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_projectresource set resource_haschildren=? where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_haschildren,$resource_father_id));
		}
		
		public function updateById($resource_id,$resource_name,$resource_type,$resource_father_id,$resource_level,$resource_haschildren,$resource_belonged_subsidiary,$resource_user_authority,$project_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_projectresource set resource_name=?,resource_type=?,resource_father_id=?,resource_level=?,resource_haschildren=?,resource_belonged_subsidiary=?,resource_user_authority=?,project_id=? where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_name,$resource_type,$resource_father_id,$resource_level,$resource_haschildren,$resource_belonged_subsidiary,$resource_user_authority,$project_id,$resource_id));
		}		
		
		public function deleteById($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_projectresource where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}	
		
		public function findCompanyByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select resource_belonged_subsidiary from tb_projectresource where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();
		}
		
		public function findAuthorityByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select resource_user_authority from tb_projectresource where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();
		}
	}
?>