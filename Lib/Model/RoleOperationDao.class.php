<?php

class RoleOperationDao extends CommonDao
{

    public function findByRoleid($roleid)
    {
        
        $sql = "select * from tb_role_operation where roleid= ? order by operationid asc";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $roleid
        ));
        return $statement->fetchAll();
    }

    public function add($roleid, $operationid)
    {
        
        $sql = "insert into tb_role_operation(roleid,operationid) values(?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $roleid,
            $operationid
        ));
        return $this->commonPDO->lastInsertId();
    }

    public function deleteByRoleid($roleid)
    {
       
        $sql = "delete from tb_role_operation where roleid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $roleid
        ));
    }

    public function is_roleidOperationid_exist($roleid, $operationid)
    {
       
        $sql = "select count(*) from tb_role_operation where roleid=? and operationid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $roleid,
            $operationid
        ));
        $row = $statement->fetch();
        if ($row[0] == 0)
            return false;
        else
            return true;
    }

    public function deleteByRoleidOperationid($roleid, $operationid)
    {
       
        $sql = "delete from tb_role_operation where roleid=? and operationid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $roleid,
            $operationid
        ));
    }
}

?>