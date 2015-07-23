<?php
	class ProjectTracecostDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_project_tracecost order by costid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($costid){
			
			$sql="select * from tb_project_tracecost where costid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($costid));
			return $statement->fetch();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_project_tracecost where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetchAll();
		}

		

	}




?>