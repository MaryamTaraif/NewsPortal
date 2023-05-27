<?php

class Upload {

    private $upload_dir;
    private $max_file_size;
    private $denied_mime_types;
    private $filepath;
    private $fileType;

    function __construct() {
    $this->upload_dir = '';
    $this->max_file_size = 1048576; //Max File Size in Bytes, 1MB
    $this->denied_mime_types = array('application/x-php', 'application/x-javascript', 'application/zip');
    $this->filepath = '';
    $this->fileType = ''; 
    }
    
    function setFilepath($file) {
        $this->filepath = $file;
    }

    function getFilepath() {
        return $this->filepath;
    }

    function setUploadDir($upload_dir) {
        $this->upload_dir = $upload_dir;
    }

    function getUploadDir() {
        return $this->upload_dir;
    }
    
    function setFileType($fileType) {
        $this->fileType = $fileType;
    }

    function getFileType() {
        return $this->fileType;
    }

    public function check_dir($dir) {
        if (!is_dir($dir))// || !is_writable($dir))
            return false;
        return true;
    }

    public function uploadDir($dir) {
        if (is_dir($dir)) {
            if (chmod($dir, 0777)) {
                $status = true;
            } else {
                $status = false;
            }
        } else {
            mkdir($dir, 777);
            $status = true;
        }

        if ($status) {
            $this->setUploadDir($dir);
            return true;
        } else {
            $error[] = 'DIR is not valid';
            return false;
        }
    }

    public function check_file_exists($fileName) {
        $fileName = rand(1, 9999999) . '_' . $fileName;
        $flag = true;
        while ($flag) {
            if (!file_exists($this->getUploadDir() . '/' . $fileName)) {
                $flag = false;
            } else {
                $fileName = rand(1, 9999999) . '(' . rand(1, 9999) . ')' . $fileName;
            }
        }
        return $fileName;
    }

    public function upload($object) {
            if ($this->check_dir($this->upload_dir)) {
                $files = $_FILES[$object];
                switch ($files['error']) {
                    case 0 : break;
                    case 1 : $error[] = $files['name'] . ' exceeds the upload_max_filesize directive in php.ini';
                        break;
                    case 2 : $error[] = $files['name'] . ' exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                        break;
                    case 3 : $error[] = $files['name'] . ' was only partially uploaded';
                        break;
                    case 4 : $error[] = $files['name'] . ' uploading failed 1';
                        break;
                    case 6 : $error[] = 'Missing a temporary folder';
                        break;
                    case 7 : $error[] = 'Failed to write ' . $files['name'] . ' to disk';
                        break;
                    case 8 : $error[] = $files['name'] . ' stopped by extension';
                        break;
                    default : $error[] = 'Unidentified Error, caused by ' . $files['name'];
                        break;
                }
            }
            else {
                $error[] = 'No Directory Permissions';
            }

        if (empty($error)) {
            
            $files['name'] = $this->make_safe($files['name']);
            $files['name'] = $this->check_file_exists($files['name']);

            if ($files['size'] <= 0)
                $error[] = $files['name'] . ' uploading failed (Size is 0)';

            elseif ($files['size'] >= $this->max_file_size)
                $error[] = $files['name'] . ' exceeds the MAX_FILE_SIZE';

            elseif (in_array($files['type'], $this->denied_mime_types))
                $error[] = $files['name'] . ' is a denied type';

            elseif (!move_uploaded_file($files['tmp_name'], $this->upload_dir . $files['name']))
                $error[] = $files['name'] . ' could not be uploaded';
            else
                $this->setFilepath($files['name']);
        }

        return $error;
    }

    function make_safe($file){
        $file = str_replace('-', '_', $file);
        $file = str_replace('/', '_', $file);
        $file = str_replace('\\', '_', $file);
        $file = str_replace('\'', '_', $file);
        $file = str_replace("\'", '_', $file);
        return $file;
    }

}
