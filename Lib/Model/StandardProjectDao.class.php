<?php
import("@.Model.CommonDao");
class StandardProjectDao extends CommonDao
{

    public function add($resource_id, $prname, $enterprise_1partid, $enterprise_supervisorid, $total_quantites, $construct_layers, $pm_name, $vice_pm_name, $startdate_actually, $finishdate_actually, $receivestuff_address, $receiveperson_phonenumber, $description, $materialbuyingprocess_setting, $materialbuyingplanaudit_setting, $infield_pattern, $infield_site)
    {
        
        $sql = "insert into tb_pr_standardproject(resource_id,prname,enterprise_1partid,enterprise_supervisorid,
												total_quantites,construct_layers,pm_name,vice_pm_name,startdate_actually,finishdate_actually,
												receivestuff_address,receiveperson_phonenumber,description,materialbuyingprocess_setting,
												materialbuyingplanaudit_setting,infield_pattern,infield_site) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id,
            $prname,
            $enterprise_1partid,
            $enterprise_supervisorid,
            $total_quantites,
            $construct_layers,
            $pm_name,
            $vice_pm_name,
            $startdate_actually,
            $finishdate_actually,
            $receivestuff_address,
            $receiveperson_phonenumber,
            $description,
            $materialbuyingprocess_setting,
            $materialbuyingplanaudit_setting,
            $infield_pattern,
            $infield_site
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function findExistId($resource_id)
    {
        
        $sql = "select standardprojectid from tb_pr_standardproject where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetch();
    }

    public function updateById($exist_id, $prname, $enterprise_1partid, $enterprise_supervisorid, $total_quantites, $construct_layers, $pm_name, $vice_pm_name, $startdate_actually, $finishdate_actually, $receivestuff_address, $receiveperson_phonenumber, $description, $materialbuyingprocess_setting, $materialbuyingplanaudit_setting, $infield_pattern, $infield_site)
    {
        
        $sql = "update tb_pr_standardproject set prname=?,enterprise_1partid=?,enterprise_supervisorid=?,
												total_quantites=?,construct_layers=?,pm_name=?,vice_pm_name=?,startdate_actually=?,finishdate_actually=?,
												receivestuff_address=?,receiveperson_phonenumber=?,description=?,materialbuyingprocess_setting=?,
												materialbuyingplanaudit_setting=?,infield_pattern=?,infield_site=? where standardprojectid=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $prname,
            $enterprise_1partid,
            $enterprise_supervisorid,
            $total_quantites,
            $construct_layers,
            $pm_name,
            $vice_pm_name,
            $startdate_actually,
            $finishdate_actually,
            $receivestuff_address,
            $receiveperson_phonenumber,
            $description,
            $materialbuyingprocess_setting,
            $materialbuyingplanaudit_setting,
            $infield_pattern,
            $infield_site,
            $exist_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function findByResourceId($resource_id)
    {
       
        $sql = "select * from tb_pr_standardproject where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        $result = $statement->fetch();
        return $result;
    }

    public function deleteByResourceId($resource_id)
    {
       
        $sql = "delete from tb_pr_standardproject where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id
        ));
    }
}
?>