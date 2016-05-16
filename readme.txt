安装方法：
将目录下面的uadmin.sql.gz导入数据库，然后修改include/config.db.php数据库连接。
入口文件中的DEBUG_MODE现设为true，生产环境一定要设为false。
DEBUG_MODE设false后将启用缓存，修改模板、数据库结构，核心文件等需删除缓存才生效。

系统管理员用户名密码：uadmin 123456

项目主页：http://www.uadmin.cn
项目博客：http://www.thinkcart.net