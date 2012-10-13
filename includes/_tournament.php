<?php
/**
* Tournament Class
*
* @package  phpTournament
* @author   Matthew Hurst 
*           - HurstFreelance.com
*           - piznac
* @param  name            string
* @param  id              INT
* @param  description     string
* @param  numberOfPlayers INT - 16|8|4
* @param  query           string - private mysql 
* @param  options         Array
* --------------------
* In progress - possibles
* 				elimination
* 				seeds
*
* @return object
*/
abstract class _Tournament
{
	protected $_id = 0;
    protected $_name;
	protected $_description;
	protected $_numberOfPlayers;
	protected $_options = array();
	private   $_query;

	/**
    * _create - Creates a record in the tournament table
    *
    * @return 
    * $mysqli->insert_id INT
    */
    protected function _create()
    {
        include('connect.php');
        $this->_query = "INSERT INTO `tournament`
        	(`name`,`description`,`numberOfPlayers`,`options`)
            VALUES (
	                '{$this->name}',
	            	'{$this->description}',
	            	'{$this->numberOfPlayers}',
	            	'{$this->options}'
	            	)";

        if ($mysqli->query($this->_query)) {
            return $mysqli->insert_id;
        }
    }

    /**
    * _retrive - retrives record(s) from the tournament table
    *
    * @return assoc array
    * 
    */
    protected function _retrive()
    {
        include('connect.php');
        if ($this->id == 0) {
            $this->_query = "SELECT * FROM `tournament`";
        } else {
            $this->_query = "SELECT * FROM `tournament` WHERE `id` = '{$this->id}' ";
        }

        $result = $mysqli->query($this->_query);

        return $result->fetch_assoc();
    }

    /**
    * _update - Updates a record in the tournament table
    *
    * @return bool
    */
    protected function _update()
    {
        if ($this->id != 0) {
            $this->_query = "UPDATE `tournament`
            SET 
                `name`            = '{$this->name}',
                `description`     = '{$this->description}',
                `numberOfPlayers` = '{$this->numberOfPlayers}',
                `options`         = '{$this->convertOptions($this->options)}'
            WHERE `id` = '{$this->id}' ";

            if ($mysqli->query($this->_query)) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
    * _delete - Deletes record in the tournament table
    *
    * @return bool
    */
    protected function _delete()
    {
        if ($this->id != 0) {
            $this->_query = "DELETE FROM `tournament` WHERE `id` = '{$this->id}' LIMIT 1";

            if ($mysqli->query($this->_query)) {
                return true;
            }
        } else {
            return false;
        }
    }
}