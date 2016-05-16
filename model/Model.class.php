<?php
class Model{
    public $db = null;
    public function __construct(){
        $this->db = new db();
    }
    public function get_list($params){
        $where = $this->get_where($params);
        if(isset($params['page'])){
            $count = $this->db->table($params['table'])->where($where)->count('id');
            if($count==0) return array();
            import('Page');
            $Page = new Page($count,$params['page']);
            $params['limit'] = $Page->firstRow.','.$Page->listRows;
            $arr['total'] = $count;
            if($params['pageQuery']){//分页跳转的时候保证查询条件
                foreach($params['pageQuery'] as $key=>$val) {
                    $Page->parameter .= "$key=".urlencode($val)."&";
                }
            }
            $arr['page'] = $Page->show();
        }
        if(!isset($params['order'])) $params['order'] = 'id desc';
        if(!isset($params['limit'])) $params['limit'] = '20';
        if(!isset($params['field'])) $params['field'] = '*';
        $arr['data'] = $this->db->table($params['table'])->field($params['field'])->where($where)->order($params['order'])->limit($params['limit'])->select();
        return $arr;
    }
    public function get_one($params){
        $where = $this->get_where($params);
        if(!isset($params['field'])) $params['field'] = '*';
        return $this->db->table($params['table'])->field($params['field'])->where($where)->find();
    }
    private function get_where($params){
        $where = array();
        if(isset($params['where'])){
            if(is_string($params['where'])) $where['_string'] = $params['where'];
            if(is_array($params['where'])) $where = $params['where'];
        }
        foreach($params as $k=>$v){
            if(substr($k,0,1)=='_'){ //下横线开头的为查询字段
                $k = substr($k,1);
                $where[$k] = $v;
            }
        }
        return $where;
    }
}
?>