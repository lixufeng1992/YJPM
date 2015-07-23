<?php
	class ProjecttypeDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_projecttype order by projecttypeid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

	}




?>