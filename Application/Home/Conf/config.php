<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE' 				=> 'mysql', // 数据库类型
    'DB_HOST' 				=> '127.0.0.1', // 服务器地址
    'DB_NAME' 				=> 'dress', // 数据库名
    'DB_USER' 				=> 'root', // 用户名
    'DB_PWD' 				=> 'root', // 密码
    'DB_PORT' 				=> 3306, // 端口
    'DB_PREFIX' 			=> 'dress_', // 数据库表前缀
    'SESSION_AUTO_START' 	=> true, // 是否开启session
    'URL_CASE_INSENSITIVE' 	=>false,
    'URL_MODEL'          	=> '2', //URL模式
    'SESSION_EXPIRE'		=>18000,//18000秒
    "LOG_RECORD"          	=>false,  //是否记录网站日志，默认不记录日志
    "LOG_RECORD_LEVEL"    	=>array('ERR','WARN','INFO','DEBUG','SQL'),  //允许记录的日志级别
    "LOG_FILE_SIZE"       	=>2097152,  //日志文件大小限制， 针对文件方式的日志记录，超过
    'DB_FIELDS_CACHE'		=> false, //数据库字段缓存
    'SERVER_NAME'			=>	'',//服务器地址
    'PAGESIZE'			=>	10,//分页数量
);