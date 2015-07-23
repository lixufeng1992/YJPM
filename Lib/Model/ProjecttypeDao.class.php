<?php
	class ProjecttypeDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_projecttype order by projecttypeid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

	}




?>