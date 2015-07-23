<?php
	class ProcessPeriodworkDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_process_periodwork order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_process_periodwork where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function findByProcessid($project_process_id){
			
			$sql="select * from tb_process_periodwork where project_process_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($project_process_id));
			return $statement->fetchAll();
		}

		public function deleteById($id){
			
			$sql="delete from tb_process_periodwork where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));
		}

		public function add($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark){
			
			$sql="insert into tb_process_periodwork(project_process_id,create_date,create_userid,confirm_date,period_count,remark) values(?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($id,$project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark){
			
			$sql="update tb_process_periodwork set project_process_id=?,create_date=?,create_userid=?,confirm_date=?,period_count=?,remark=? where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark,$id));		
		}


	}

		
		



?>