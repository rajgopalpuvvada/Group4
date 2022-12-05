<?php

namespace SelfPhp;
namespace App\http\utils;  

use SelfPhp\database\Database; 
use SelfPhp\SP;
use SelfPhp\Serve;
use SelfPhp\Auth;

class TicketUtil extends Serve
{

    public function __construct($table)
    {
        $this->table = $table;
        $this->db_connection = new Database();
        $this->db_connection = $this->db_connection->connect(); 
    }

    public function fetchAllTickets()
    { 
        try {
            $query = "SELECT * FROM (($this->table
                INNER JOIN clients ON $this->table.client_id = clients.id)
                INNER JOIN events ON $this->table.event_id = events.id)";
            $result = mysqli_query($this->db_connection, $query);

            $row_array = array();
            
            if ($result == true or is_object($result)) {
                while($rows = mysqli_fetch_assoc($result)){
                    array_push($row_array, $rows);
                } 
            }

            return $row_array;
        } catch (\Throwable $error) {
            SP::debug_backtrace_show($error); 
        }

    }
}