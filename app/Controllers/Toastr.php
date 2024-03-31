<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
class Toastr
{
    public function success_toast($message, $title)
    {
        echo '<script type="text/javascript"> 
        toastr.success("' . $message . '", "' . $title . '")
        </script>';
    }
    public function warning_toast($message, $title)
    {
        echo '<script type="text/javascript"> 
        toastr.warning("' . $message . '", "' . $title . '")
        </script>';
    }
    public function error_toast($message, $title)
    {
        echo '<script type="text/javascript"> 
        toastr.error("' . $message . '", "' . $title . '")
        </script>';
    }
    public function info_toast($message, $title)
    {
        echo '<script type="text/javascript"> 
        toastr.info("' . $message . '", "' . $title . '")
        </script>';
    }
}
