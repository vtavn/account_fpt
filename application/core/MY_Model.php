<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MY_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  var $table = '';
  var $key = 'id';
  var $order = '';
  var $select = '';

  function get_DB()
  {
    $this->db = $this->load->database('default', TRUE);
  }


  function create($data = array())
  {
    if ($this->db->insert($this->table, $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function update($id, $data)
  {
    if (!$id) {
      return FALSE;
    }

    $where = array();
    $where[$this->key] = $id;
    $this->updateRule($where, $data);

    return TRUE;
  }

  function updateRule($where, $data)
  {
    if (!$where) {
      return FALSE;
    }

    $this->db->where($where);
    $this->db->update($this->table, $data);

    return TRUE;
  }

  function delete($id)
  {
    if (!$id) {
      return FALSE;
    }
    //neu la so
    if (is_numeric($id)) {
      $where = array($this->key => $id);
    } else {
      //$id = 1,2,3...
      $where = $this->key . " IN (" . $id . ") ";
    }
    $this->deleteRule($where);

    return TRUE;
  }

  function addMoney($table, $data, $amount, $where)
  {
    $row = $this->db->query("UPDATE `$table` SET `$data` = `$data` + '$amount' WHERE `id` = $where ");
    return $row;
  }

  function deductMoney($table, $data, $amount, $where)
  {
    $row = $this->db->query("UPDATE `$table` SET `$data` = `$data` - '$amount' WHERE `id` = $where");
    return $row;
  }

  function deleteRule($where)
  {
    if (!$where) {
      return FALSE;
    }
    $this->db->where($where);
    $this->db->delete($this->table);
    return TRUE;
  }

  function query($sql)
  {
    $rows = $this->db->query($sql);
    return $rows->result();
  }

  function getData($id, $field = '')
  {
    if (!$id) {
      return FALSE;
    }

    $where = array();
    $where[$this->key] = $id;

    return $this->getDataRule($where, $field);
  }

  function getDataRule($where = array(), $field = '')
  {
    if ($field) {
      $this->db->select($field);
    }
    $this->db->where($where);
    $query = $this->db->get($this->table);
    if ($query->num_rows()) {
      return $query->row();
    }
    return FALSE;
  }

  function getTotal($input = array(), $id = '')
  {
    $this->get_list_set_input($input);
    if ($id) {
      $this->db->select($id);
    } else {
      $this->db->select('id');
    }
    $query = $this->db->get($this->table);

    return $query->num_rows();
  }

  function getSum($field, $where = array())
  {
    $this->db->select_sum($field); //tinh rong
    $this->db->where($where); //dieu kien
    $this->db->from($this->table);

    $row = $this->db->get()->row();
    foreach ($row as $f => $v) {
      $sum = $v;
    }
    return $sum;
  }

  function getRow($input = array())
  {
    $this->get_list_set_input($input);

    $query = $this->db->get($this->table);

    return $query->row();
  }

  function getList($input = array())
  {
    $this->get_list_set_input($input);
    $query = $this->db->get($this->table);

    // echo $this->db->last_query() . '<br>';
    return $query->result();
  }

  protected function get_list_set_input($input = array())
  {
    if ((isset($input['where'])) && $input['where']) {
      $this->db->where($input['where']);
    }

    if ((isset($input['or_where_1'])) && $input['or_where_1']) {
      $this->db->or_where($input['or_where_1']);
    }
    if ((isset($input['or_where_2'])) && $input['or_where_2']) {
      $this->db->or_where($input['or_where_2']);
    }
    if ((isset($input['or_where_3'])) && $input['or_where_3']) {
      $this->db->or_where($input['or_where_3']);
    }
    if ((isset($input['or_where_4'])) && $input['or_where_4']) {
      $this->db->or_where($input['or_where_4']);
    }
    if ((isset($input['or_where_5'])) && $input['or_where_5']) {
      $this->db->or_where($input['or_where_5']);
    }

    // $input['like'] = array('name' => 'abc');
    if ((isset($input['like'])) && $input['like']) {
      $this->db->like($input['like']);
    }
    if ((isset($input['or_like'])) && $input['or_like']) {
      $this->db->or_like()($input['or_like']);
    }
    if ((isset($input['or_like_1'])) && $input['or_like_1']) {
      $this->db->or_like($input['or_like_1']);
    }

    //($input['order'] = array('id','DESC'))
    if (isset($input['order'][0]) && isset($input['order'][1])) {
      $this->db->order_by($input['order'][0], $input['order'][1]);
    } else {
      //mặc định sẽ sắp xếp theo id giảm dần 
      $order = ($this->order == '') ? array($this->table . '.' . $this->key, 'desc') : $this->order;
      $this->db->order_by($order[0], $order[1]);
    }

    //($input['limit'] = array('10' ,'0')) 
    if (isset($input['limit'][0]) && isset($input['limit'][1])) {
      $this->db->limit($input['limit'][0], $input['limit'][1]);
    }

    if (isset($input['query']) && $input['query']) {
      $this->db->$input['query'];
    }
  }

  function check_exists($where = array())
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function get_info_rule($where = array(), $field = '')
  {
    if ($field) {
      $this->db->select($field);
    }
    $this->db->where($where);
    $query = $this->db->get($this->table);
    if ($query->num_rows()) {
      return $query->row();
    }
    return FALSE;
  }

  function update_setting($key, $value)
  {
    $this->db->set('value', $value);
    $this->db->where('name', $key);
    $this->db->update('settings');
  }
}
