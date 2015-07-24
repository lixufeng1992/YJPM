<?php

class ProjectDocumentDao extends CommonDao
{

    public function findAll()
    {
        
        $sql = "select * from tb_project_document order by documentid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($documentid)
    {
       
        $sql = "select * from tb_project_document where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $documentid
        ));
        return $statement->fetch();
    }

    public function findByProjectid($projectid)
    {
       
        $sql = "select * from tb_project_document where projectid=? order by documentid asc";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        return $statement->fetchAll();
    }
    
  
    public function add($projectid, $serial_number, $name, $path, $update_date, $remark, $create_userid)
    {
       
        $sql = "insert into tb_project_document(projectid,serial_number,name,path,update_date,
								remark,create_userid) values(?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $projectid,
            $serial_number,
            $name,
            $path,
            $update_date,
            $remark,
            $create_userid
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($documentid, $projectid, $serial_number, $name, $path, $update_date, $remark, $create_userid)
    {
       
        $sql = "update tb_project_document set projectid=?,serial_number=?,name=?,path=?,update_date=?,
								remark=?,create_userid=? where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $projectid,
            $serial_number,
            $name,
            $path,
            $update_date,
            $remark,
            $create_userid,
            $documentid
        ));
    }

    public function deleteById($documentid)
    {
       
        $sql = "delete from tb_project_document where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $documentid
        ));
    }
}

?>