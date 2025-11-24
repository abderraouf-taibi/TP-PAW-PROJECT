<?php
require 'db_connect.php';
try { getDbConnection(); echo "Connection successful."; }
catch(Exception $e){ echo "Failed: ".$e->getMessage(); }