<?php
//include('./app/config/database.php');
class Controller
{
    public $connection;
	
	### CONNECTION MANAGER
	public function __construct()
	{
		$this->connection = new PDO('mysql:host='.$GLOBALS['DBHOST'].';dbname='.$GLOBALS['DBNAME'].';charset=utf8', $GLOBALS['DBUSER'], $GLOBALS['DBPASS']);
		//$this->connection = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASS);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

    public function checkImage($fileType, $fileSize, $fileError)
    {
        if ((($fileType == "image/gif")
                || ($fileType == "image/jpeg")
                || ($fileType == "image/jpg")
                || ($fileType == "image/pjpeg")
                || ($fileType == "image/x-png")
                || ($fileType == "image/png"))
            && ($fileSize < 52428800)
            && ($fileError <= 0)
        ) {
            return 1;
        } else
            return 0;
    }
}
