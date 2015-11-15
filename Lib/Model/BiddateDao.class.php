<?php
import("@.Model.CommonDao");
	class BiddateDao extends CommonDao{
	    
		public function findAll(){
			
			$sql="select * from tb_biddate order by biddate_id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_biddate where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($biddate_id){
			
			$sql="select * from tb_biddate where biddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($biddate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$is_finished,$reminder_personid){
			
			$sql="insert into tb_biddate(projectid,date,preremind_days,is_finished,reminder_personid) values(?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$reminder_personid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($biddate_id,$projectid,$date,$preremind_days,$is_finished,$reminder_personid){
			
			$sql="update tb_biddate set projectid=?,date=?,preremind_days=?,is_finished=?,reminder_personid=? where biddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$biddate_id,$reminder_personid));		
		}

		public function deleteById($biddate_id){
			
			$sql="delete from tb_biddate where biddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($biddate_id));		
		}
		public function deleteByProjectid($projectid){
			
			$sql="delete from tb_biddate where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid));
		}

	}




?>