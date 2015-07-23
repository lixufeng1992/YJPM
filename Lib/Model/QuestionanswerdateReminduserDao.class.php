<?php
	class QuestionanswerdateReminduserDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_questionanswerdate_reminduser order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByQuestionanswerdateid($questionanswerdate_id){
			
			$sql="select * from tb_questionanswerdate_reminduser where questionanswerdate_id=? order by id asc";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($questionanswerdate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_questionanswerdate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($questionanswerdate_id,$userid){
			
			$sql="insert into tb_questionanswerdate_reminduser(questionanswerdate_id,userid) values(?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($questionanswerdate_id,$userid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		

		public function deleteById($id){
			
			$sql="delete from tb_questionanswerdate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}


?>