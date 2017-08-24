<?php
header('content-type:text/html;charset=utf-8');
//无限级排序
$arr=array
(
		array('id'=>2,'name'=>'分类2','parent_id'=>1),
		array('id'=>9,'name'=>'分类9','parent_id'=>8),
		array('id'=>1,'name'=>'分类1','parent_id'=>0),
		array('id'=>7,'name'=>'分类7','parent_id'=>0),
		array('id'=>3,'name'=>'分类3','parent_id'=>2),
		array('id'=>4,'name'=>'分类4','parent_id'=>0),
		array('id'=>6,'name'=>'分类6','parent_id'=>5),
		array('id'=>8,'name'=>'分类8','parent_id'=>7),
		array('id'=>5,'name'=>'分类5','parent_id'=>4)
);

// 递归排序成树形
function _getTree($data, $parent_id=0, $level=0)
{
	static $_ret = array();
	foreach ($data as $k => $v)
	{
		if($v['parent_id'] == $parent_id)
		{
			$v['level'] = $level;
			$_ret[] = $v;
			_getTree($data, $v['id'], $level+1);
		}
	}
	return $_ret;
}
// 	echo '<pre>';
// 	var_dump(_getTree($arr));

// 取一个分类所有子分类的ID
function _getChildren($data, $parent_id, $isClear = FALSE)
{
	static $_ret = array();
	if($isClear)
		$_ret = array();
	foreach ($data as $k => $v)
	{
		if($v['parent_id'] == $parent_id)
		{
			$_ret[] = $v['id'];
			_getChildren($data, $v['id']);
		}
	}
	return $_ret;
}
echo '<pre>';
_getChildren($arr,1);
_getChildren($arr,1);
var_dump(_getChildren($arr,1));

// $str='abcdefg';
// echo $str[1];	


function getFarther($data,$id,$is_Clear=FALSE)
{
	static $ret = array();
	if($is_Clear == TRUE)
		$ret = array();
	foreach($data as $k=>$v)
	{
		if($v['id'] == $id)
		{
			$ret[] = $v;
			getFarther($data,$v['parent_id']);
		}
	}
	unset($ret[0]);
	return $ret;
}