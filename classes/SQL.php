<?php

/******************************************************************************/
/*                                                                            */
/* Picture Host			                                              */
/*         v1.1.1		                                              */
/******************************************************************************/
/*Picture Host is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Affero Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Picture Host is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Affero Public License for more details.

    You should have received a copy of the GNU General Affero Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.     */
/******************************************************************************/


class SQL {

    private $_db;
    private $_result;

    public function __construct() {
        $this->_connect();
    }

    public function __destruct() {
        if ($this->_result) {
            $this->free();
        }
        $this->_disconnect();
    }

    public function execute($query) {
        $this->_result = mysql_query($query);
        return $this->_result;
    }

    public function next() {
        return mysql_fetch_array($this->_result);
    }

    public function count() {
        return mysql_num_rows($this->_result);
    }

    public function free() {
        if ($this->_result) {
            @mysql_free_result($this->_result);
        }
    }

    public function escape($string) {
        return mysql_escape_string($string);
    }

    private function _connect() {
        global $config;

        $this->_db = mysql_connect($config['sql_host'], $config['sql_user'], $config['sql_password']);
        mysql_select_db($config['sql_database']);
    }

    private function _disconnect() {
        mysql_close($this->_db);
    }

    public function begin_transaction() {
        return mysql_query('BEGIN', $this->_db);
    }

    public function commit() {
        return mysql_query('COMMIT', $this->_db);
    }

    public function rollback() {
        return mysql_query('ROLLBACK', $this->_db);
    }

}
