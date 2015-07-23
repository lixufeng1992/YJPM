<?php

class ProjectResourceDao extends Model
{

    public function findAll()
    {
        $sql = "select * from tb_projectresource order by resource_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($resource_id)
    {
        $sql = "select * from tb_projectresource where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetch();
    }

    public function findByProjectid($projectid)
    {
        $sql = "select * from tb_projectresource where project_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        return $statement->fetch();
    }

    public function add($project_id, $resource_name, $resource_type, $resource_belonged_subsidiary, $resource_user_authority, $resource_father_id, $resource_level, $resource_haschildren)
    {
        $sql = "insert into tb_projectresource(project_id,resource_name,resource_type,resource_belonged_subsidiary,resource_user_authority,resource_father_id,resource_level,resource_haschildren) values(?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $project_id,
            $resource_name,
            $resource_type,
            $resource_belonged_subsidiary,
            $resource_user_authority,
            $resource_father_id,
            $resource_level,
            $resource_haschildren
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateFather($resource_haschildren, $resource_father_id)
    {
        $sql = "update tb_projectresource set resource_haschildren=? where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_haschildren,
            $resource_father_id
        ));
    }

    public function updateById($resource_id, $resource_name, $resource_type, $resource_father_id, $resource_level, $resource_haschildren, $resource_belonged_subsidiary, $resource_user_authority, $project_id)
    {
        $sql = "update tb_projectresource set resource_name=?,resource_type=?,resource_father_id=?,resource_level=?,resource_haschildren=?,resource_belonged_subsidiary=?,resource_user_authority=?,project_id=? where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_name,
            $resource_type,
            $resource_father_id,
            $resource_level,
            $resource_haschildren,
            $resource_belonged_subsidiary,
            $resource_user_authority,
            $project_id,
            $resource_id
        ));
    }

    public function deleteById($resource_id)
    {
        $sql = "delete from tb_projectresource where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id
        ));
    }

    public function findCompanyByResourceId($resource_id)
    {
        $sql = "select resource_belonged_subsidiary from tb_projectresource where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetch();
    }

    public function findAuthorityByResourceId($resource_id)
    {
        $sql = "select resource_user_authority from tb_projectresource where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetch();
    }
}
?>