<?php
/**
* Admin Model
*/
class adminModel
{
	public $_table_admin = 'system_admin';
	public $_table_roles = 'system_roles';
	function __construct()
	{
		# code...
	}

	/**
	 * 获取管理员列表
	 * @return [type] [description]
	 */
	function get_admin_info(){
		$sql = "SELECT * FROM view_admin_list"; //操作视图
		$result = db::findAll($sql);
		return $result;
	}

	/**
	 * 通过id获取管理员信息
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function find_admin_by_id($id){
		$sql = "SELECT * FROM ".'ph_'.$this->_table_admin." WHERE 1 AND id='$id' ORDER BY id";
		$result = db::findOne($sql);
		return $result;
	}

	/**
	 * 获取管理员角色列表
	 * @return [type] [description]
	 */
	function get_admin_role_list(){
		$sql = "SELECT id,role_name FROM ".'ph_'.$this->_table_roles;
		$result = db::findAll($sql);
		return $result;
	}

	/**
	 * 检查用户名是否已存在
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	function check_username($username){
		$sql = "SELECT count(*) as count FROM ".'ph_'.$this->_table_admin." WHERE admin_name='$username'";
		$result = db::findOne($sql);
		if ($result['count']>0) {
			return false;
		}else{
			return true;
		}
	}

	/**
	 * 添加管理员信息
	 * @param [type] $admin_data [description]
	 */
	function add_admin_info($admin_datas){
		return db::insert($this->_table_admin,$admin_datas);
	}

	/**
	 * 更新管理员信息
	 * @param  [type] $admin_data [description]
	 * @return [type]             [description]
	 */
	function update_admin_info($id,$admin_data){
		$where = "id = $id";
		return db::update($this->_table_admin,$admin_data,$where);
	}

	function check_is_superadmin($id){
		$query = "SELECT admin_name FROM ".'ph_'.$this->_table_admin." WHERE 1 AND id='$id'";
		return db::findOne($query);
	}

	/**
	 * 冻结管理员账户
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function block_admin_user($id){
		$arr = array('is_enable' => 0);
		$where = "id = $id";
		return db::update($this->_table_admin,$arr,$where);
	}

	/**
	 * 启用管理员账户
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function start_admin_user($id){
		$arr = array('is_enable' => 1);
		$where = "id = $id";
		return db::update($this->_table_admin,$arr,$where);
	}

	/**
	 * 删除管理员
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function delete_admin_user($id){
		$where = "id = $id";
		return db::del($this->_table_admin,$where);
	}
}
?>