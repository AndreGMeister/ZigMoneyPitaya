<?php

namespace System\NativeQuery;
use System\Database\Native;

class DB
{
    protected $db;

    public function __construct()
    {
        $this->db = Native::connect();
    }

    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function rollBack()
    {
        return $this->db->rollBack();
    }
}