<?php

/**
 * Description of GlobalFuncoes
 * Class where the static methods of system control
 *
 * @author Eduardo
 */
class GlobalFunctions {

    /**
     * 
     * @param type $msg alert message wants to be saved
     * @param type $fileName
     */
    public static function logMsg($msg, $fileName = 'general') {
        
        // actual date and dateTime
        $date = date('Y-m-d');
        $dateTime = date('Y-m-d H:i:s');
        
        //path logs
        $path = "./log/";

        // Format the log message
        $msg = sprintf("[%s]: %s%s", $dateTime, $msg, PHP_EOL);
        
        // preparing file name
        $fileName = $path . $date . $fileName . '.txt';
        
        // creating or writing the file
        // It is necessary to use FILE_APPEND so that the message is written at the end of the file, preserving the old contents of the file
        file_put_contents($fileName, $msg, FILE_APPEND);
    }

}
