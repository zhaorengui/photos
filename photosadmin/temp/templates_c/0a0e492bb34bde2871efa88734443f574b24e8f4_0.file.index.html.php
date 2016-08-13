<?php
/* Smarty version 3.1.29, created on 2016-08-08 21:24:01
  from "D:\WWW\photos\photosadmin\templates\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57a887f163b746_08956407',
  'file_dependency' => 
  array (
    '0a0e492bb34bde2871efa88734443f574b24e8f4' => 
    array (
      0 => 'D:\\WWW\\photos\\photosadmin\\templates\\index.html',
      1 => 1470409847,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_header.html' => 1,
    'file:_footer.html' => 1,
  ),
),false)) {
function content_57a887f163b746_08956407 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<title>後台管理|ZRG</title>
</head>
<body>
	<header class="Hui-header cl"> <a class="Hui-logo l" title="图库" href="<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
">图库管理平台</a> <a class="Hui-logo-m l" href="/" title="H-ui.admin">zrg</a> <span class="Hui-subtitle l">V1.0</span>
		<nav class="mainnav cl" id="Hui-nav">
			<ul>
				<li class="dropDown dropDown_click"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu radius box-shadow">
						<li><a href="javascript:;" onclick="article_add('添加文章','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 文章</a></li>
						<li><a href="javascript:;" onclick="picture_add('添加图片','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
						<li><a href="javascript:;" onclick="product_add('添加广告','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 广告</a></li>
						<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<ul class="Hui-userbar">
			<li>超级管理员</li>
			<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
				<ul class="dropDown-menu radius box-shadow">
					<li><a href="#">个人信息</a></li>
					<li><a href="index.php?controller=login&amp;method=logout">注销</a></li>
				</ul>
			</li>
			<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
			<li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
				<ul class="dropDown-menu radius box-shadow">
					<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
					<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
					<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
					<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
					<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
					<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
				</ul>
			</li>
		</ul>
		<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> </header>
		<aside class="Hui-aside">
			<input runat="server" id="divScrollValue" type="hidden" value="" />
			<div class="menu_dropdown bk_2">
				<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> 文章管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="article-list.html" href="javascript:void(0)">文章列表</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-picture">
					<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="picture-list.html" href="javascript:void(0)">图片列表</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-product">
					<dt><i class="Hui-iconfont">&#xe620;</i> 广告管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="product-brand.html" href="javascript:void(0)">品牌管理</a></li>
							<li><a _href="product-category.html" href="javascript:void(0)">分类管理</a></li>
							<li><a _href="product-list.html" href="javascript:void(0)">广告管理</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-page">
					<dt><i class="Hui-iconfont">&#xe626;</i> 页面管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="page-home.html" href="javascript:void(0)">首页管理</a></li>
							<li><a _href="page-flinks.html" href="javascript:void(0)">友情链接</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-comments">
					<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="http://h-ui.duoshuo.com/admin/" href="javascript:;">评论列表</a></li>
							<li><a _href="feedback-list.html" href="javascript:void(0)">意见反馈</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-order">
					<dt><i class="Hui-iconfont">&#xe63a;</i> 财务管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="order-list.html" href="javascript:void(0)">订单列表</a></li>
							<li><a _href="recharge-list.html" href="javascript:void(0)">充值管理</a></li>
							<li><a _href="invoice-list.html" href="javascript:void(0)">发票管理</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-member">
					<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="member-list.html" href="javascript:;">会员列表</a></li>
							<li><a _href="member-del.html" href="javascript:;">冻结会员</a></li>
							<li><a _href="member-level.html" href="javascript:;">等级管理</a></li>
							<li><a _href="member-scoreoperation.html" href="javascript:;">积分管理</a></li>
							<li><a _href="member-record-browse.html" href="javascript:void(0)">浏览记录</a></li>
							<li><a _href="member-record-download.html" href="javascript:void(0)">下载记录</a></li>
							<li><a _href="member-record-share.html" href="javascript:void(0)">分享记录</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-admin">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="index.php?controller=admin&method=admin_list" href="javascript:void(0)">管理员列表</a></li>
							<li><a _href="index.php?controller=admin&method=admin_role" href="javascript:void(0)">角色管理</a></li>
							<li><a _href="index.php?controller=admin&method=admin_permission" href="javascript:void(0)">权限管理</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-tongji">
					<dt><i class="Hui-iconfont">&#xe61a;</i> 信息统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="charts-1.html" href="javascript:void(0)">折线图</a></li>
							<li><a _href="charts-2.html" href="javascript:void(0)">时间轴折线图</a></li>
							<li><a _href="charts-3.html" href="javascript:void(0)">区域图</a></li>
							<li><a _href="charts-4.html" href="javascript:void(0)">柱状图</a></li>
							<li><a _href="charts-5.html" href="javascript:void(0)">饼状图</a></li>
							<li><a _href="charts-6.html" href="javascript:void(0)">3D柱状图</a></li>
							<li><a _href="charts-7.html" href="javascript:void(0)">3D饼状图</a></li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-system">
					<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a _href="system-base.html" href="javascript:void(0)">系统设置</a></li>
							<li><a _href="system-category.html" href="javascript:void(0)">栏目管理</a></li>
							<li><a _href="system-data.html" href="javascript:void(0)">数据字典</a></li>
							<li><a _href="system-shielding.html" href="javascript:void(0)">屏蔽词</a></li>
							<li><a _href="system-log.html" href="javascript:void(0)">系统日志</a></li>
						</ul>
					</dd>
				</dl>
			</div>
		</aside>
		<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
		<section class="Hui-article-box">
			<div id="Hui-tabNav" class="Hui-tabNav">
				<div class="Hui-tabNav-wp">
					<ul id="min_title_list" class="acrossTab cl">
						<li class="active"><span title="我的桌面" data-href="index.php?controller=index&amp;method=welcome">我的桌面</span><em></em></li>
					</ul>
				</div>
				<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
			</div>
			<div id="iframe_box" class="Hui-article">
				<div class="show_iframe">
					<div style="display:none" class="loading"></div>
					<iframe scrolling="yes" frameborder="0" src="index.php?controller=index&amp;method=welcome"></iframe>
				</div>
			</div>
		</section>

		<!-- footer -->
		<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<?php echo '<script'; ?>
 type="text/javascript">
			/*资讯-添加*/
			function article_add(title,url){
				var index = layer.open({
					type: 2,
					title: title,
					content: url
				});
				layer.full(index);
			}
			/*图片-添加*/
			function picture_add(title,url){
				var index = layer.open({
					type: 2,
					title: title,
					content: url
				});
				layer.full(index);
			}
			/*产品-添加*/
			function product_add(title,url){
				var index = layer.open({
					type: 2,
					title: title,
					content: url
				});
				layer.full(index);
			}
			/*用户-添加*/
			function member_add(title,url,w,h){
				layer_show(title,url,w,h);
			}
		<?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript">
			var _hmt = _hmt || [];
			(function() {
				var hm = document.createElement("script");
				hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(hm, s)})();
				var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
				document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
			<?php echo '</script'; ?>
>
		</body>
		</html><?php }
}