<?php

/**
 * Description of Status
 *
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 */

class Statuses extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('statuses', 'status_id');
    }

    public function getAll()
    {
        return $this->findAll();
    }    
}