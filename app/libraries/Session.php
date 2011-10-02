<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package     CodeIgniter
* @author      Elise Bosse
* @copyright   Copyright (c) 2008, E.Bosse
* @license     http://www.codeignitor.com/user_guide/license.html
* @link        http://www.codeigniter.com
* @since       Version 1.2
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Session class using native PHP session features and hardened against session fixation.
* Non-database part is based upon Dariusz Debowczyk's Native session library with some updates.
* The DB part makes use of PHP's session_set_save_handler() functionality
* This library is written for PHP 5 but it could be altered a bit to make it work in PHP4
*
* @package     CodeIgniter
* @subpackage  Libraries
* @category    Sessions
* @author      Elise Bosse
* @link        http://www.codeigniter.com/user_guide/libraries/sessions.html
* @class link  http://codeigniter.com/wiki/KNDB_Session/
*/

/**
* If using a database, create the following database table and make sure config file is set properly
*
* CREATE TABLE sessions (
* session_id varchar(32) NOT NULL,
* session_last_access int(10) unsigned,
* session_data text,
* PRIMARY KEY (session_id)
* );
*/

class CI_Session {

  private $_lifetime;
  private $_sess_id_ttl;
  private $_match_ip;
  private $_match_useragent;
  private $_sess_db;
  private $_useDB;
  private $_sess_table;
  private $_flash_key = 'flash'; // prefix for "flash" variables (eg. flash:new:message)

  function __construct()
  {
    $this->object =& get_instance();

    // set config variables
    $this->_lifetime = $this->object->config->item('sess_expiration');
    $this->_sess_id_ttl = $this->object->config->item('sess_time_to_update');
    $this->_match_ip = $this->object->config->item('sess_match_ip');
    $this->_match_useragent = $this->object->config->item('sess_match_useragent');
    $this->_useDB = $this->object->config->item('sess_use_database');
    $this->_sess_table = $this->object->config->item('sess_table_name');

    log_message('debug', "Session Class Initialized");

    $this->_sess_run();
  }

  /**
   * Starts up the session system for current request
   */
  function _sess_run()
  {
    // Set session table and register this object as the session handler, if using databases
    if ($this->_useDB == TRUE) {
      session_set_save_handler(array(&$this, "_open"), array(&$this, "_close"), array(&$this, "_read"),
                   array(&$this, "_write"),array(&$this, "_destroy"),array(&$this, "_gc"));
    }

    session_start();

    // if no lifetime set in config, set to 2 years
    if (!is_numeric($this->_lifetime) || $this->_lifetime <= 0) {
      $this->_lifetime = (60*60*24*365*2);
    }

    // if no session ID regeneration time set in config, set to 30 minutes
    if (!is_numeric($this->_sess_id_ttl) || $this->_sess_id_ttl <= 0) {
      $this->_sess_id_ttl = 1800;
    }

    // check if session has expired
    if ($this->_session_expired()) {
      $this->sess_destroy();
      return FALSE;
    }

    // match IP address if necessary
    if ($this->_match_ip == TRUE) {
      if ($this->_ips_match() == FALSE) {
    $this->sess_destroy();
    return FALSE;
      }
    }

    // match user agent if necessary
    if ($this->_match_useragent == TRUE) {
      if ($this->_useragents_match() == FALSE) {
    $this->sess_destroy();
    return FALSE;
      }
    }

    // regenerate session id if necessary
    // session data stays the same, but old session storage is destroyed
    if ( $this->_sess_id_expired() ) {
      $this->regenerate_id();
    }

    // delete old flashdata (from last request)
    $this->_flashdata_sweep();

    // mark all new flashdata as old (data will be deleted before next request)
    $this->_flashdata_mark();

    // finally, set last access time to now
    $this->set_userdata('sess_last_access', time());
  }

  /**
   * Checks if session has expired
   */
  function _session_expired()
  {
    // if this is the first time coming in, initialize access time
    if (!$this->userdata('sess_last_access')) {
      $this->set_userdata('sess_last_access', time());
      return FALSE;
    }

    $delta = time() - $this->userdata('sess_last_access');

    if ($delta  >=  $this->_lifetime ) {
      return true;
    }

    return false;
  }

  /**
   * Checks if stored IP matches current IP
   */
  function _ips_match() {
    // if this is the first time coming in, initialize IP address
    if (!$this->userdata('sess_ip_address')) {
      $this->set_userdata('sess_ip_address',  $this->object->input->ip_address());
      return TRUE;
    }

    return $this->userdata('sess_ip_address') == $this->object->input->ip_address();
  }

  /**
   * Checks if stored user agent matches current user agent
   */
  function _useragents_match() {
    // if this is the first time coming in, initialize user agent
    if (!$this->userdata('sess_useragent')) {
      $this->set_userdata('sess_useragent', trim(substr($this->object->input->user_agent(), 0, 50)));
      return TRUE;
    }

    return $this->userdata('sess_useragent') == trim(substr($this->object->input->user_agent(), 0, 50));
  }


  /**
   * Checks if session id needs regenerating
   */
  function _sess_id_expired()
  {
    // if this is the first time coming in, initialize regenerated time
    if (!$this->userdata('sess_last_regenerated')) {
      $this->set_userdata('sess_last_regenerated', time());
      return false;
    }

    $delta = time() - $this->userdata('sess_last_regenerated');

    if ( $delta >=  $this->_sess_id_ttl ) {
      return true;
    }

    return false;
  }


  /**
   * Regenerates session id
   */
  function regenerate_id()
  {
    // regenerate session id and store it
    // $delete_old_session parameter works in PHP5 only!
    session_regenerate_id(TRUE);

    // update the session generation time
    $this->set_userdata('sess_last_regenerated', time());
  }


  /**
   * Destroys the session and erases session storage
   */
  function sess_destroy()
  {
    session_unset();
    if ( isset( $_COOKIE[session_name()] ) )
      {
    //@@@ was having trouble just using setcookie() because it wasn't unsetting fast enough
    unset($_COOKIE[session_name()]);
    setcookie(session_name(), '', time()-42000, '/'); //@@@
      }

    session_destroy();
  }


  /**
   * returns the session id of the current session
   */
  function get_sess_id() {
    return session_id();
  }


  /**
   * Reads given session attribute value: single variable, element of single dimensional array, or property of object
   * I was kind of of two minds about whether the object bit should be implemented
   * so you can take out that logic if you wish
   */
  function userdata($item, $subitem=null)
  {
    // this item is in an array
    if ($subitem) {
      if ($subitem == 'session_id'){ //added for backward-compatibility
        return session_id();
      } else {
        // array vs. object: handled differently
        if (isset($_SESSION[$item])) {
          if (is_array($_SESSION[$item])) return (!isset($_SESSION[$item][$subitem])) ? false : $_SESSION[$item][$subitem];
          if (is_object($_SESSION[$item])) return (!isset($_SESSION[$item]->$subitem)) ? false : $_SESSION[$item]->$subitem;
          return false;
        }
      }
    }

    // this item is not in an array
    else {
      if($item == 'session_id'){ //added for backward-compatibility
        return session_id();
      } else {
        return ( ! isset($_SESSION[$item])) ? false : $_SESSION[$item];
      }
    }

  }

  /**
   * Returns all session data
   */
  function all_userdata()
  {
    if (isset($_SESSION['session_id'])) { //added for backward-compatibility
      $_SESSION['session_id'] = session_id();
    }
    return $_SESSION;
  }

  /**
   * Sets session attributes to the given values
   */
  function set_userdata($newdata = array(), $newval = '')
  {
    if (is_string($newdata))
      {
    $newdata = array($newdata => $newval);
      }

    if (count($newdata) > 0)
      {
    foreach ($newdata as $key => $val)
      {
        $_SESSION[$key] = $val;
      }
      }
  }

  /**
   * Erases given session attributes
   */
  function unset_userdata($newdata = array())
  {
    if (is_string($newdata))
      {
    $newdata = array($newdata => '');
      }

    if (count($newdata) > 0)
      {
    foreach ($newdata as $key => $val)
      {
        unset($_SESSION[$key]);
      }
      }
  }


/**
* Sets "flash" data which will be available only in next request (then it will
* be deleted from session). You can use it to implement "Save succeeded" messages
* after redirect.
*/
  function set_flashdata($key, $value)
  {
    $flash_key = $this->_flash_key.':new:'.$key;
    $this->set_userdata($flash_key, $value);
  }

  /**
   * Keeps existing "flash" data available to next request.
   */
  function keep_flashdata($key)
  {
    $old_flash_key = $this->_flash_key.':old:'.$key;
    $value = $this->userdata($old_flash_key);

    $new_flash_key = $this->_flash_key.':new:'.$key;
    $this->set_userdata($new_flash_key, $value);
  }

  /**
   * Returns "flash" data for the given key.
   */
  function flashdata($key)
  {
    $flash_key = $this->_flash_key.':old:'.$key;
    return $this->userdata($flash_key);
  }

  /**
   * PRIVATE: Internal method - marks "flash" session attributes as 'old'
   */
  function _flashdata_mark()
  {
    foreach ($_SESSION as $name => $value)
      {
    $parts = explode(':new:', $name);
    if (is_array($parts) && count($parts) == 2)
      {
        $new_name = $this->_flash_key.':old:'.$parts[1];
        $this->set_userdata($new_name, $value);
        $this->unset_userdata($name);
      }
      }
  }

  /**
   * PRIVATE: Internal method - removes "flash" session marked as 'old'
   */
  function _flashdata_sweep()
  {
    foreach ($_SESSION as $name => $value)
      {
    $parts = explode(':old:', $name);
    if (is_array($parts) && count($parts) == 2 && $parts[0] == $this->_flash_key)
      {
        $this->unset_userdata($name);
      }
      }
  }




  /************* DATABASE METHODS ***************/
  function _open()
  {
    if ($this->_sess_db = mysql_connect($this->object->db->hostname,
                    $this->object->db->username,
                    $this->object->db->password)) {
      return mysql_select_db($this->object->db->database, $this->_sess_db);
    }

    return FALSE;
  }

  function _close()
  {
    if ($this->_sess_db) {
      return mysql_close($this->_sess_db);
    }

    return TRUE;
  }

  function _read($id)
  {
    $id = mysql_real_escape_string($id);

    $sql = "SELECT session_data FROM $this->_sess_table WHERE session_id = '$id'";

    if ($result = mysql_query($sql, $this->_sess_db)) {
      if (mysql_num_rows($result)) {
    $record = mysql_fetch_assoc($result);

    return $record['session_data'];
      }
    }

    return '';
  }

  function _write($id, $data)
  {
    $access = time();

    $id = mysql_real_escape_string($id);
    $access = mysql_real_escape_string($access);
    $data = mysql_real_escape_string($data);

    $sql = "REPLACE INTO $this->_sess_table VALUES ('$id', '$access', '$data')";

    return mysql_query($sql, $this->_sess_db);
  }

  function _destroy($id)
  {
    $id = mysql_real_escape_string($id);

    $sql = "DELETE FROM $this->_sess_table WHERE session_id = '$id'";

    return mysql_query($sql, $this->_sess_db) or die("failed to delete<br>");
  }

  function _gc($max)
  {
    $old = time() - $max;
    $old = mysql_real_escape_string($old);

    $sql = "DELETE FROM $this->_sess_table WHERE session_last_access < '$old'";

    return mysql_query($sql, $this->_sess_db);
  }


}