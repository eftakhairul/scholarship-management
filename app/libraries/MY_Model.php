<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends Model
{
    protected $table;
    protected $primaryKey = 'id';

    private $fields = array();
    private $numRows = null;
    private $insertId = null;
    private $affectedRows = null;
    private $returnArray = true;
    
    public function loadTable($table, $primaryKey = 'id')
    {
        $this->table = $table;
        $this->fields = $this->db->list_fields($table);
        $this->primaryKey = $primaryKey;
    }

    public function findAll($conditions = null, $fields = '*', $order = null, $start = 0, $limit = null)
    {
        if ($conditions != null) {
            $conditions = $this->_removeNonAttributeFields($conditions);
            
            if(is_array($conditions)) {
                $this->db->where($conditions);
            } else {
                $this->db->where($conditions, null, false);
            }
        }

        if ($fields != null)  {
            $this->db->select($fields);
        }

        if ($order != null) {
            $this->db->orderby($order);
        }

        if ($limit != null)  {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get($this->table);
        $this->numRows = $query->num_rows();

        return ($this->returnArray) ? $query->result_array() : $query->result();
    }

    public function find($conditions = null, $fields = '*', $order = null)
    {
        $data = $this->findAll($conditions, $fields, $order, 0, 1);

        if ($data) {
            return $data[0];
        } else  {
            return false;
        }
    }

    public function field($conditions = null, $name, $fields = '*', $order = null)
    {
        $data = $this->findAll($conditions, $fields, $order, 0, 1);

        if ($data) {
            $row = $data[0];
            if (isset($row[$name])) {
                return $row[$name];
            }
        }
        return false;
    }

    public function findCount($conditions = null)
    {
        $data = $this->findAll($conditions, 'COUNT(*) AS count', null, 0, 1);

        if ($data) {
            return $data[0]['count'];
        } else {
            return false;
        }
    }

    public function insert($data = null)
    {
        if ($data == null) {
            return false;
        }

        $data = $this->_removeNonAttributeFields($data);

        $this->db->insert($this->table, $data);
        $this->insertId = $this->db->insert_id();
        
        return $this->insertId;
    }

    public function update($data = null, $id = null)
    {
        if ($data == null) {
            return false;
        }

        $data = $this->_removeNonAttributeFields($data);

        if ($id !== null) {
            $this->db->where($this->primaryKey, $id);
            $this->db->update($this->table, $data);
            $this->affectedRows = $this->db->affected_rows();
            return $id;
        } else {
            $this->db->insert($this->table, $data);
            $this->insertId = $this->db->insert_id();
            return $this->insertId;
        }
    }

    public function remove($id = null)
    {
        if ($id == null) {
            return false;
        }

        return $this->db->delete($this->table, array($this->primaryKey => $id));
    }

    public function __call ($method, $args)
    {
        $watch = array('findBy','findAllBy');

        foreach ($watch as $found) {
            if (stristr($method, $found)) {
                $field = strtolower(str_replace($found, '', $method));
                return $this->$found($field, $args);
            }
        }
    }

    public function findBy($field, $value)
    {
        $where = array($field => $value);
        return $this->find($where);
    }

    public function findAllBy($field, $value)
    {
        $where = array($field => $value);
        return $this->findAll($where);
    }

    public function executeQuery($sql)
    {
        return $this->db->query($sql);
    }

    public function getLastQuery()
    {
        return $this->db->last_query();
    }

    public function getInsertString($data)
    {
        return $this->db->insert_string($this->table, $data);
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getNumRows()
    {
        return $this->numRows;
    }

    public function getInsertId()
    {
        return $this->insertId;
    }

    public function getAffectedRows()
    {
        return $this->affectedRows;
    }
    
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    public function setReturnArray($returnArray)
    {
        $this->returnArray = $returnArray;
    }

    protected function _removeNonAttributeFields($data = array())
    {
        foreach ($data as $key => $value) {
            if (array_search($key, $this->fields) === false) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}