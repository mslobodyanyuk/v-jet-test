<?php
namespace config;

/*
 * class Conf containing config variables, array variables
 */
class Conf
{
    public function getConfigParameters()
    {
        /*config variables array 'databaseParameters'*/
        $databaseParameters = [
            'host' => "localhost",
            'name' => "root",
            'password' => "",
            'database' => "test_blog"
        ];
        $result = $databaseParameters;
        return $result;
    }

    public function getUploadFileParameters($key = 'uplPath')
    {
        if ('uplPath' == $key){
            /*my config variable path for folder upl*/
            $uplPath = $_SERVER['DOCUMENT_ROOT'].'/upl/images/';
            $result = $uplPath;
        }
        else {
            /*my config variables array 'fileUploadParameters' for uploading file*/
            $fileUploadParameters = [
                'uplTempNamePath' => $_FILES['uploadfile']['tmp_name'],
                'uplNamePath' => $_FILES['uploadfile']['name'],
            ];
            $result = $fileUploadParameters;
        }
        return $result;
    }
}