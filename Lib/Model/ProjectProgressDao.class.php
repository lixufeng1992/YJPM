<?php

class ProjectProgressDao extends Model
{

    public function findAll()
    {
        $sql = "select * from tb_project_progress order by progressid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findByProjectid($projectid)
    {
        
        $sql = "select * from tb_project_progress where projectid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        return $statement->fetchAll();
    }

    public function findById($progressid)
    {
       
        $sql = "select * from tb_project_progress where progressid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $progressid
        ));
        return $statement->fetch();
    }

    public function add($projectid, $createdate, $content)
    {
       
        $sql = "insert into tb_project_progress(projectid,createdate,content) values(?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $projectid,
            $createdate,
            $content
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($progressid, $projectid, $createdate, $content)
    {
       
        $sql = "update tb_project_progress set projectid = ?,createdate=?,content=? where progressid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $projectid,
            $createdate,
            $content,
            $progressid
        ));
    }

    public function deleteById($progressid)
    {
       
        $sql = "delete from tb_project_progress where progressid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $progressid
        ));
    }
}

?>