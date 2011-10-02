<?php

/**
 * Description of Schedule
 *
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @author      Syed Abidur Rahman <aabid048@gmail.com>
 */

class Schedules extends MY_Model
{
    protected $statuses;
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('schedules', 'schedule_id');

        $this->statuses = array(
            'due'       => '1',
            'completed' => '2',
            'cancelled' => '3',
            'postponed' => '4',
        );
    }

    public function save(array $data)
    {
        $data['date'] = DateHelper::humanToMysql($data['date']);

        if(!empty($data['time'])) {
            $data['time']  = date("H:i", strtotime($data['time']));
        }

        $data['is_date_not_confirmed'] = empty ($data['is_date_not_confirmed']) ? 0 : 1;
        $data['is_time_not_confirmed'] = empty ($data['is_time_not_confirmed']) ? 0 : 1;
        $data['created_date'] = date('Y-m-d');
        $data['status_id'] = $this->statuses['due'];
        
        return $this->insert($data);
    }

    public function update($data, $id)
    {
        if (empty($data) OR empty($id) ) {
            return false;
        }

        if(!empty($data['time'])) {
            $data['time']  = date("H:i", strtotime($data['time']));
        }

        $data['date'] = DateHelper::humanToMysql($data['date']);
        $data['is_date_not_confirmed'] = empty ($data['is_date_not_confirmed']) ? 0 : 1;
        $data['is_time_not_confirmed'] = empty ($data['is_time_not_confirmed']) ? 0 : 1;
        $data['status_id'] = $this->statuses['due'];
        
        return parent::update($data, $id);
    }

    public function getAllForPrint(array $options, $postData = null)
    {
        $fields = "{$this->table}.schedule_id,
                   {$this->table}.title,
                   {$this->table}.description,
                   {$this->table}.date,
                   {$this->table}.time,
                   {$this->table}.venue,
                   {$this->table}.is_date_not_confirmed,
                   {$this->table}.is_time_not_confirmed,
                   GS.title AS grace";

        $this->db->select($fields);
        $this->db->from($this->table);
        $this->db->join('grace_statuses AS GS', "GS.grace_status_id = {$this->table}.grace_status_id" );
        $this->db->where("{$this->table}.date >=", date('Y-m-d'));

        if(!empty($options['group_id'])) {
            $this->db->where("{$this->table}.group_id", $options['group_id']);
        }

        if(!empty($postData['starting_date'])) {
            $this->db->where("{$this->table}.date >", DateHelper::humanToMysql($postData['starting_date']));
        }

        if(!empty($postData['ending_date'])) {
            $this->db->where("{$this->table}.date <", DateHelper::humanToMysql($postData['ending_date']));
        }

        $this->db->orderby("{$this->table}.date ASC");
        $this->db->orderby("{$this->table}.time ASC");

        return $this->db->get()->result_array();
    }

    public function getAll($options = array())
    {
        $fields = "{$this->table}.{$this->primaryKey},
                   {$this->table}.title,
                   {$this->table}.description,
                   {$this->table}.date,
                   {$this->table}.time,
                   {$this->table}.venue,
                   {$this->table}.is_date_not_confirmed,
                   {$this->table}.is_time_not_confirmed,
                   ST.title AS status";

        $this->db->select($fields);
        $this->_setQueryParts($options);

        $this->db->orderby("{$this->table}.date ASC");
        $this->db->orderby("{$this->table}.time ASC");

        $this->db->limit($this->config->item('rowsPerPage'), $options['page']);

        return $this->db->get()->result_array();
    }

    public function countAllSchedules($options = array())
    {
        $this->db->select("COUNT({$this->table}.{$this->primaryKey}) AS `total`");
        $this->_setQueryParts($options);

        $result = $this->db->get()->row_array();
        
        return (empty ($result)) ? 0 : $result['total'];
    }

    protected function _setQueryParts($options = array())
    {
        $this->db->from($this->table);
        $this->db->join('statuses AS ST', "ST.status_id = {$this->table}.status_id" );

        if (empty ($options['isPast'])) {
            $this->db->where("{$this->table}.date >=", date('Y-m-d'));
        } else {
            $this->db->where("{$this->table}.date <", date('Y-m-d'));
        }

        if(!empty($options['group_id'])) {
            $this->db->where("{$this->table}.group_id", $options['group_id']);
        }

        if (!empty ($options['status'])) {
            $this->db->where("{$this->table}.status_id", $this->statuses[$options['status']]);
        }
    }

    public function getAllById($id)
    {
        if (empty ($id)) {
            return false;
        }

        return $this->findBy('schedule_id',$id);
    }

    public function getDetailById($id)
    {
        if (empty ($id)) {
            return false;
        }

        $this->db->select('S.schedule_id, S.title, S.description, S.date, S.time, S.venue, S.is_date_not_confirmed, S.is_time_not_confirmed, ST.title AS status, GS.title AS grace');
        $this->db->from("{$this->table} AS S");
        $this->db->join('statuses AS ST', "ST.status_id = S.status_id" );
        $this->db->join('grace_statuses AS GS', "GS.grace_status_id = S.grace_status_id" );
        $this->db->where('S.schedule_id', $id);

        return $this->db->get()->row_array();
    }

     public function pastschedule(array $options, $postData = null)
    {
        $fields = "{$this->table}.schedule_id,
                   {$this->table}.title,
                   {$this->table}.description,
                   {$this->table}.date,
                   {$this->table}.time,
                   {$this->table}.venue,
                   {$this->table}.is_date_not_confirmed,
                   {$this->table}.is_time_not_confirmed,
                   GS.title AS grace";

        $this->db->select($fields);
        $this->db->from($this->table);
        $this->db->join('grace_statuses AS GS', "GS.grace_status_id = {$this->table}.grace_status_id" );

        if(!empty($options['group_id'])) {
            $this->db->where("{$this->table}.group_id", $options['group_id']);
        }

        if(!empty($postData['starting_date'])) {
            $this->db->where("{$this->table}.date >=", DateHelper::humanToMysql($postData['starting_date']));
        }

        if(!empty($postData['ending_date'])) {
            $this->db->where("{$this->table}.date <=", DateHelper::humanToMysql($postData['ending_date']));
        }
        
        if(empty($postData)) {
            $this->db->where("{$this->table}.date <=", date('Y-m-d'));
            $this->db->limit('20');
        }


        $this->db->orderby("{$this->table}.date ASC");
        $this->db->orderby("{$this->table}.time ASC");

        return $this->db->get()->result_array();
    }

    public function delete($id)
    {
        if (empty($id)) {
            return false;
        }
        
        return $this->remove($id);
    }
}