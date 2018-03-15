<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
/**
* 公共控制器 可以代码公用
*/
class Common extends Controller
{
	// 标识符 控制是否登录校验
	public $is_check_login = true;
	// 保存Request类的对象
	public $request;
	public $is_check_rule = true;//标识是否进行权限认证
	public $user=[];//保存用户的信息
	// 使用依赖注入将对象保存到属性中
	public function __construct(Request $request)
	{
		parent::__construct();
		$this->request = $request;
		// 判断是否已经登录
		if(!cookie('admin_id') && $this->is_check_login){
			$this->error('没有登录','Login/index');
		}
		// 控制login控制器下的方法都不进行校验权限
		if($this->is_check_login){
			// 执行此段代码绝对可以获取到用户信息
			$admin_id = cookie('admin_id');
			// 读取文件缓存中的内容 确保每一个用户读取的内容为自己的因此设置名称不一样
			$this->user =cache('user_'.$admin_id); 
			if(!$this->user){
				echo 'db'; //走的是数据库
				// 将信息保存到user属性中
				$this->user['admin_id']=$admin_id;
				// 根据用户ID获取对应的角色
				$userInfo = Db::name('admin_role')->where(['admin_id'=>$admin_id])->find();
				if(!$userInfo){
					echo 'no role'; exit;
				}
				// 将角色ID保存到user属性中
				$this->user['role_id']=$userInfo['role_id'];
				// 根据角色ID进行判断
				if($userInfo['role_id']==1){
					// 超级管理
					$this->is_check_rule = false; //标注不进行权限校验
					// 获取所有的权限信息
					$rules = Db::name('rule')->select();
				}else{
					// 根据角色ID获取到对应权限id
					$rule_ids = model('RoleRule')->getRuleById($userInfo['role_id']);
					// 在根据权限ID获取对应的权限信息
					$rules = Db::name('rule')->where(['id'=>['in',$rule_ids]])->select();
				}
				// 为了方便判断将$rules转换为一维数组
				foreach ($rules as $key => $value) {
					// 仅限于进行权限校验
					$this->user['rules'][]=strtolower($value['module_name'].'/'.$value['controller_name'].'/'.$value['action_name']);
					// 用于显示导航菜单
					if($value['is_show']==1){
						// 针对需要显示的组装
						$this->user['menus'][]=$value;
					}				
				}
				// 处理后台首页无权访问
				$this->user['rules'][]='admin/index/index';
				$this->user['rules'][]='admin/index/top';
				$this->user['rules'][]='admin/index/main';
				$this->user['rules'][]='admin/index/menu';
				// 再次写入缓存中
				cache('user_'.$admin_id,$this->user);
			}
			// 通过使用角色ID判断是否需要进行权限校验
			if($this->user['role_id']==1){
				$this->is_check_rule = false;
			}
			// 判断是否有权访问 先根据是否超级管理员判断是否需要校验
			if($this->is_check_rule){
				
				// 获取当前用户访问的地址
				$action = strtolower($request->module().'/'.$request->controller().'/'.$request->action());
				if(!in_array($action, $this->user['rules'])){
					echo 'no rule'; exit;
				}
			}
		}
	}
}