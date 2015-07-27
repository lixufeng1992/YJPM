<?php
import("@.Model.CommonDao");
	class SubmitbiddocdateReminduserDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_submitbiddocdate_reminduser order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findBySubmitbiddocdateid($submitbiddocdate_id){
			
			$sql="select * from tb_submitbiddocdate_reminduser where submitbiddocdate_id=? order by id asc";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($submitbiddocdate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_submitbiddocdate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($submitbiddocdate_id,$userid){
			
			$sql="insert into tb_submitbiddocdate_reminduser(submitbiddocdate_id,userid) values(?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($submitbiddocdate_id,$userid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function deleteById($id){
			
			$sql="delete from tb_submitbiddocdate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}




?>