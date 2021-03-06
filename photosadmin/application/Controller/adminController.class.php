<?php
/**
 * Admin Controller
 */
class adminController extends Controller
{
	private $admin_mod;

	function __construct()
	{
		$this->admin_mod = M('admin');
	}

	//admin list
	public function index(){
		$this->admin_list();
	}

	/**
	 * admin list
	 * @return [type] [description]
	 */
	public function admin_list(){
		$returninfo=new ReturnInfo();

		$startDate   = isset($_POST['datemin']) ? $_POST['datemin'] : "";
		$endDate     = isset($_POST['datemax']) ? $_POST['datemax'] : "";
		$adminName   = isset($_POST['adminname']) ? $_POST['adminname'] : "";
		$curr_page = empty($_REQUEST['curr_page']) ? 1 : $_REQUEST['curr_page'];

		// if (!empty($_GET['curr_page']) && $total != 0 && $curpage > ceil($total / $showrow))
    		// $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页
		$page_size   = empty($_REQUEST['curr_size']) ? 10 : $_REQUEST['curr_size'];
		
		$searchObj=(object)array(
			'start_date'   =>$startDate,
			'end_date'     =>$endDate,
			'admin_name'   =>$adminName,
			'page_number' =>$curr_page,
			'page_size'   =>$page_size
			);

		$admin_infos = $this->admin_mod->get_admin_info($searchObj,$returninfo);
		// 数据条数
		$admin_info_counts=$returninfo->count['count'];
		$total_page=ceil($admin_info_counts/$page_size); // 如果有余，向上取整

		// if ($admin_info_counts > $page_number) {
		// $page=new page($admin_info_counts,$page_number,$page_size,$url,2);
		// $show_page_div=$page->page_write();

		view::assign(array('curr_page'=>$curr_page));
		view::assign(array('admin_info_counts' => $admin_info_counts));
		view::assign(array('total_page'=>$total_page));
		view::assign(array('admin_infos' => $admin_infos));
		// view::assign(array('show_number' => $show_number ));
		// view::assign(array('page_show' => $show_page_div));
		
		view::display('admin-list.html');
	}

	/**
	 * admin add
	 * @return [type] [description]
	 */
	public function admin_add(){
		if (!IS_POST) {
			$roles = $this->admin_mod->get_admin_role_list();
			view::assign(array('roles'=>$roles));
			view::display('admin-add.html');
		}else{
			$admin_data = array(
				'admin_name' => trim($_POST['username']),
				'admin_pwd'  => md5(trim($_POST['password'])),
				'sex'        => $_POST['sex'],
				'tel'        => trim($_POST['tel']),
				'email'      => trim($_POST['email']),
				'role_id'    => $_POST['role'],
				'add_time'   => time(),
				'remark'     => $_POST['remark'],
				);
			$res = $this->admin_mod->check_username(trim($_POST['username']));
			if ($res) {
				$id=$this->admin_mod->add_admin_info($admin_data);
				if ($id) {
					exit(json_encode(array('info'=>'添加管理员成功。','status'=>'y')));
				}else{
					exit(json_encode(array('info'=>'添加管理员失败。','status'=>'n')));
				}
			}else{
				$this->show_message('管理员账户已存在！','index.php?controller=admin');
			}
		}
	}

	/**
	 * admin block
	 * @return [type] [description]
	 */
	public function admin_block(){
		$id = $_GET['id'];
		$check_res = $this->admin_mod->check_is_superadmin($id);
		if ($check_res['admin_name'] == 'admin') {
			return false;
		}else{
			$res = $this->admin_mod->block_admin_user($id);
			return true;
		}
	}

	/**
	 * admin unblock
	 * @return [type] [description]
	 */
	public function admin_start(){
		$id = $_GET['id'];
		$res = $this->admin_mod->start_admin_user($id);
		return $res;
	}

    /**
     * admin edit
     * @return [type] [description]
     */
    public function admin_edit(){
    	if (!IS_POST) {
    		$id = $_GET['id'];
    		$admin_info = $this->admin_mod->find_admin_by_id($id);
    		$roles = $this->admin_mod->get_admin_role_list();
    		$role_list=array();
    		foreach ($roles as $role) {
    			$role_list[$role['role_id']]=$role['role_name'];
    		}
    		view::assign(array('roles'=>$role_list));
    		view::assign(array('admin_info'=>$admin_info));
    		view::display('admin-edit.html');
    	}else{
    		$id = $_POST['id'];
    		$admin_data = array(
    			'admin_name'       => trim($_POST['username']),
    			'admin_pwd'        => md5(trim($_POST['password'])),
    			'sex'              => $_POST['sex'],
    			'tel'              => trim($_POST['tel']),
    			'email'            => trim($_POST['email']),
    			'role_id'          => $_POST['role'],
    			'last_update_time' => time(),
    			'remark'           => $_POST['remark'],
    			);
    		$res=$this->admin_mod->update_admin_info($id,$admin_data);
    		if ($res) {
    			exit(json_encode(array('info'=>'更新管理员信息成功。','status'=>'y')));
    		}else{
    			exit(json_encode(array('info'=>'更新管理员信息失败。','status'=>'n')));
    		}
    	}
    }

	/**
	 * Admin delete.
	 * @return [type] [description]
	 */
	public function admin_del(){
		$id = $_GET['id'];
		$check_res = $this->admin_mod->check_is_superadmin($id);
		if ($check_res['admin_name'] == 'admin') {
			exit(json_encode(array('info' =>'超级管理员不能被删除！','status'=>'0')));
		}else{
			$res = $this->admin_mod->delete_admin_user($id);
			if ($res) {
				exit(json_encode(array('info' =>'删除成功！','status'=>'y')));
			}else{
				exit(json_encode(array('info' =>'删除失败！','status'=>'n')));
			}
		}
	}

	/**
	 * Admin trash list.
	 * @return [type] [description]
	 */
	public function admin_trash(){
		$returninfo=new ReturnInfo();

		$startDate = isset($_POST['datemin']) ? $_POST['datemin'] : "";
		$endDate   = isset($_POST['datemax']) ? $_POST['datemax'] : "";
		$adminName = isset($_POST['adminname']) ? $_POST['adminname'] : "";
		$curr_page = empty($_REQUEST['curr_page']) ? 1 : $_REQUEST['curr_page'];
		$page_size = empty($_REQUEST['curr_size']) ? 10 : $_REQUEST['curr_size'];
		
		$searchObj=(object)array(
			'start_date'   =>$startDate,
			'end_date'     =>$endDate,
			'admin_name'   =>$adminName,
			'page_number' =>$curr_page,
			'page_size'   =>$page_size
			);

		$deleted_admin_list = $this->admin_mod->get_deleted_admin_list($searchObj,$returninfo);
		// 数据条数
		$admin_info_counts=$returninfo->count['count'];
		$total_page=ceil($admin_info_counts/$page_size); // 如果有余，向上取整

		view::assign(array('curr_page'=>$curr_page));
		view::assign(array('admin_info_counts' => $admin_info_counts));
		view::assign(array('total_page'=>$total_page));
		view::assign(array('deleted_admin_list' => $deleted_admin_list));
		view::display('admin-trash.html');
	}

	/**
	 * Forever delete.
	 * @return [type] [description]
	 */
	public function forever_delete_admin(){
		$id = $_GET['id'];
		$check_res = $this->admin_mod->check_is_superadmin($id);
		if ($check_res['admin_name'] == 'admin') {
			exit(json_encode(array('info' =>'超级管理员不能被删除！','status'=>'0')));
		}else{
			$res = $this->admin_mod->forever_delete_admin_user($id);
			if ($res) {
				exit(json_encode(array('info' =>'删除成功！','status'=>'y')));
			}else{
				exit(json_encode(array('info' =>'删除失败！','status'=>'n')));
			}
		}
	}

	/**
	 * Admin delete.
	 * @return [type] [description]
	 */
	public function revoke_delete_admin(){
		$id = $_GET['id'];
		$check_res = $this->admin_mod->check_is_superadmin($id);
		$res = $this->admin_mod->revoke_delete_admin_user($id);
		if ($res) {
			exit(json_encode(array('info' =>'操作成功！','status'=>'y')));
		}else{
			exit(json_encode(array('info' =>'未能成功撤销，请稍后再试！','status'=>'n')));
		}
	}

	/**
	 * Admin role list.
	 * @return [type] [description]
	 */
	public function admin_role(){
		$roles = $this->admin_mod->get_role_info();
		$role_counts=0;
		if ($roles) {
			foreach ($roles as $roles_value) {
				$role_counts += $roles_value['counts'];
			}
		}
		view::assign(array('role_counts'=>$role_counts));
		view::assign(array('roles'=>$roles));	
		view::display('admin-role.html');
	}

	/**
	 * Admin role add
	 * @return [type] [description]
	 */
	public function admin_role_add(){
		if (!IS_POST) {
			// get role_id
			$roleId=$this->admin_mod->get_admin_role_id();
			view::assign(array('role_id'=>$roleId['role_id']+1));
			view::display('admin-role-add.html');
		}else{
			$role_data = array(
				'role_id'     => trim($_POST['roleid']),
				'role_name'   => trim($_POST['rolename']),
				'role_alias'  => trim($_POST['rolealias']),
				'description' => $_POST['description']
				);
			$res = $this->admin_mod->check_role_exist($_POST['rolename']);
			if ($res) {
				$id=$this->admin_mod->add_role_info($role_data);
				if ($id) {
					exit(json_encode(array('info'=>'添加角色成功。','status'=>'y')));
				}else{
					exit(json_encode(array('info'=>'添加角色失败。','status'=>'n')));
				}
			}else{
				// $this->show_message('角色已存在！','index.php?controller=admin');
				exit(json_encode(array('info'=>'角色已存在！','status'=>'*')));
			}
		}
	}

	/**
	 * Admin role delete
	 * @return [type] [description]
	 */
	public function admin_role_del(){
		$id = $_GET['id'];
		$check_res = $this->admin_mod->check_is_exist_children_user($id);
		if ($check_res) {
			$res = $this->admin_mod->delete_role($id);
			if ($res) {
				exit(json_encode(array('info' =>'已成功删除该角色！','status'=>'y')));
			}else{
				exit(json_encode(array('info' =>'未能成功删除该角色，请稍后再试！','status'=>'n')));
			}
		}else{
			exit(json_encode(array('info' =>'该角色下存在用户，请先删除该角色下的用户！','status'=>'0')));
		}
	}

	//admin role edit
	public function admin_role_edit(){
		if (!IS_POST) {
			$id = $_GET['id'];
			$role_info = $this->admin_mod->find_role_by_id($id);
			view::assign(array('role_info'=>$role_info));
			view::display('admin-role-edit.html');
		}else{
			$id = $_POST['id'];
			$role_data = array(
				'role_id'     => trim($_POST['roleid']),
				'role_name'   => trim($_POST['rolename']),
				'role_alias'  => $_POST['rolealias'],
				'description' => trim($_POST['description'])
				);
			$res=$this->admin_mod->update_role_info($id,$role_data);
			if ($res) {
				exit(json_encode(array('info'=>'更新角色信息成功。','status'=>'y')));
			}else{
				exit(json_encode(array('info'=>'更新角色信息失败。','status'=>'n')));
			}
		}
	}
	public function set_role_permission(){
		if (!IS_POST) {
			view::display('admin-role-permission.html');
		}else{

		}
	}

	//admin permission list
	public function admin_permission(){
		$returninfo=new ReturnInfo();

		$nodeName=isset($_POST['nodename'])?$_POST['nodename']:"";
		$curr_page = empty($_REQUEST['curr_page']) ? 1 : $_REQUEST['curr_page'];
		$page_size   = empty($_REQUEST['curr_size']) ? 10 : $_REQUEST['curr_size'];

		$searchObj=(object)array(
			'node_name'   =>$nodeName,
			'page_number' =>$curr_page,
			'page_size'   =>$page_size
			);

		$node_list=$this->admin_mod->get_node_list($searchObj,$returninfo);
		$node_counts=$returninfo->count['count'];
		$total_page=ceil($node_counts/$page_size); // 如果有余，向上取整

		view::assign(array('curr_page'=>$curr_page));
		view::assign(array('total_page'=>$total_page));
		View::assign(array('node_counts'=>$node_counts));
		view::assign(array('node_list'=>$node_list));
		view::display('admin-permission.html');
	}

	//admin permission add
	public function admin_permission_add(){
		if (!IS_POST) {
			//get node data.
			$nodeData=$this->admin_mod->get_node_data();
			//get node tree.
			$nodeTree=$this->_init_node_tree(@$treeList,0,0,$nodeData);

			view::assign(array('nodeTree'=>$nodeTree));
			view::display('admin-permission-add.html');
		}else{
			//判断父节点编号
			if ($_POST['parentnodecode']!='0') {
				$parentNodeCode=substr(trim($_POST['parentnodecode']),0,-3)."001";
			}else{
				$parentNodeCode=trim($_POST['parentnodecode']);
			}
			$node_data = array(
				'parent_node_code' => $parentNodeCode,
				'node_code'        => trim($_POST['nodecode']),
				'node_name'        => trim($_POST['nodename']),
				'remarks'          => $_POST['remark'],
				'create_time'      => time(),
				'create_who'       => $_SESSION['auth']['admin_name']
				);
			try {
				$id=$this->admin_mod->add_node_info($node_data);
				if ($id) {
					exit(json_encode(array('info'=>'添加节点成功。','status'=>'y')));
				}else{
					exit(json_encode(array('info'=>'添加节点失败。','status'=>'n')));
				}
			} catch (Exception $e) {
				exit(json_encode(array('info'=>'系统繁忙，请稍后再试！','status'=>'')));
			}
		}
	}
	//Get max node value
	public function get_max_node_value(){
		$moduleName=$_REQUEST['module_name'];
		if (empty($moduleName)) {
			exit(json_encode(array('info'=>'请手动填写节点编号。','value'=>'')));
		}
		$maxNodeValue=$this->admin_mod->get_max_node_code_value($moduleName);
		if ($maxNodeValue) {
			$maxNodeValue['max_value']++;
			$resValue="";
			if ($maxNodeValue['max_value']<10) {
				$resValue="00".$maxNodeValue['max_value'];
			}else if($maxNodeValue['max_value']<100){
				$resValue="0".$maxNodeValue['max_value'];
			}else if($maxNodeValue['max_value']<1000){
				$resValue=$maxNodeValue['max_value'];
			}
			exit(json_encode(array('info'=>'','value'=>$resValue)));
		}else{
			exit(json_encode(array('info'=>'获取编号异常，请手动填写节点编号。','value'=>'')));
		}
		
	}

	//admin permission delete
	public function admin_permission_del(){
		
	}

	/**
	 * init node tree.
	 * @param  [type] $treeList   [description]
	 * @param  [type] $parentCode [description]
	 * @param  [type] $rootCode   [description]
	 * @param  [type] $nodeData   [description]
	 * @return [type]             [description]
	 */
	private function _init_node_tree($treeList,$parentCode,$rootCode,$nodeData){
		if (isset($rootCode)) {
			//通过rootId查询到对应栏目信息
			$rootData=$this->admin_mod->get_node_root_data($rootCode);
			//将获取到的数据赋值到$treeList中
			$treeList=$rootData;
			//调用递归方法获取子节点(子栏目)信息
			@$treeList['children']=$this->_get_sub_node_tree($treeList['children'],$parentCode,$nodeData);
			return $treeList;
		}
	}
	/**
	 * Get sub node tree.
	 * @param  [type] $treeList   [description]
	 * @param  [type] $parentCode [description]
	 * @param  [type] $nodeData   [description]
	 * @return [type]             [description]
	 */
	private function _get_sub_node_tree($treeList,$parentCode,$nodeData){
		$tempArr=array();
		//通过parentId获取子节点（子栏目）信息
		$subNodeData=$this->admin_mod->get_node_children_data($parentCode);
		if (!empty($subNodeData) && is_array($subNodeData)) {
			foreach ($subNodeData as $key => $value) {
				$tempArr=array(
					'id'               =>$value['id'],
					'node_code'        =>$value['node_code'],
					'parent_node_code' =>$value['parent_node_code'],
					'node_name'        =>$value['node_name'],
					'children'         =>''
					);
				//递归调用
				$tempArr['children']=$this->_get_sub_node_tree($tempArr['children'],$value['node_code'],$nodeData);
				//将每一条信息赋值到$treeList中，注意该语句放于最后。
				$treeList[]=$tempArr;
			}
		}
		return $treeList;
	}
}
?>