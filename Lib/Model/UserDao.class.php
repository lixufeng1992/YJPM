<?php
import("@.Model.CommonDao");
class UserDao extends CommonDao
{

    public function __construct()
    {
        parent::__construct();
    }
    // find-----------------------------------------------------------------
    public function findAll()
    {
        $sql = "select * from tb_user where userid <>1 order by userid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
    
    // 按用户名查找用户
    // 返回-1表示查找失败
    public function findByUsername($username)
    {
        $sql = "select count(*) from tb_user where username=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $username
        ));
        $row = $statement->fetch();
        if ($row[0] == 0)
            return - 1;
        
        $sql = "select * from tb_user where username = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $username
        ));
        $userrow = $statement->fetch();
        return $userrow;
    }
    
    // 按id号查找用户
    // 返回-1表示查找失败
    public function findById($userid)
    {
        $sql = "select * from tb_user where userid = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $userid
        ));
        $userrow = $statement->fetch();
        return $userrow;
    }
    
    // 按roleid号查找用户
    public function findByRoleid($roleid)
    {
        $sql = "select * from tb_user where roleid = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $roleid
        ));
        return $statement->fetchAll();
    }
    
    // update-----------------------------------------------------------------------------------
    public function updateById($userid, $username, $password, $verify_password, $companyid, $departmentid, $phone_number, $is_admin, $is_leader, $is_salary_forbidden, $is_materialprice_forbidden, $remark, $project_authority_mode, $roleid, $employerid)
    {
        $sql = "update tb_user set username=?,password=?,verify_password=?,companyid=?,departmentid=?,phone_number=?,is_admin=?,is_leader=?,
				is_salary_forbidden=?,is_materialprice_forbidden=?,remark=?,project_authority_mode=?,roleid=?,employerid=? where userid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $username,
            $password,
            $verify_password,
            $companyid,
            $departmentid,
            $phone_number,
            $is_admin,
            $is_leader,
            $is_salary_forbidden,
            $is_materialprice_forbidden,
            $remark,
            $project_authority_mode,
            $roleid,
            $employerid,
            $userid
        ));
    }

    public function updateRoleidById($userid, $roleid)
    {
        $sql = "update tb_user set roleid=? where userid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $roleid,
            $userid
        ));
    }

    public function updatePasswordById($userid, $password)
    {
        $sql = "update tb_user set password=? where userid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $password,
            $userid
        ));
    }

    public function updateVerifyPasswordById($userid, $password)
    {
        $sql = "update tb_user set verify_password=? where userid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $password,
            $userid
        ));
    }
    
    // add------------------------------------------------------------------------------------------
    // 插入用户数据
    // 返回-1表示插入失败 返回-2表示存在多个相同用户名 成功则返回表中的id号
    public function add($username, $password, $verify_password, $companyid, $departmentid, $phone_number, $is_admin, $is_leader, $is_salary_forbidden, $is_materialprice_forbidden, $remark, $project_authority_mode, $roleid, $employerid)
    {
        $sql = "select count(*) from tb_user where username=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $username
        ));
        $row = $statement->fetch();
        if ($row[0] > 0)
            return - 2;
        
        $sql = "insert into tb_user (username,password,verify_password,companyid,departmentid,phone_number,is_admin,is_leader,is_salary_forbidden,
				is_materialprice_forbidden,remark,project_authority_mode,roleid,employerid) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $username,
            $password,
            $verify_password,
            $companyid,
            $departmentid,
            $phone_number,
            $is_admin,
            $is_leader,
            $is_salary_forbidden,
            $is_materialprice_forbidden,
            $remark,
            $project_authority_mode,
            $roleid,
            $employerid
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }
    
    // delete---------------------------------------------------------------------------------
    public function deleteById($userid)
    {
        $sql = "delete from tb_user where userid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $userid
        ));
    }
    
    // other-------------------------------------------------------------------------------------
    // 测试用户名是否已存在
    public function is_username_exist($username)
    {
        $sql = "select count(*) from tb_user where username=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $username
        ));
        $row = $statement->fetch();
        if ($row[0] > 0)
            return true;
        else
            return false;
    }
    
    // --------------------------------------------------------------------------------------------
    // 查找独立授权的用户
    public function findUserAuthority()
    {
        $sql = "select * from tb_user where project_authority_mode=2";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
}

?>
