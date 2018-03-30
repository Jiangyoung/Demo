<?php

/**
 * @param $fileInfo $_FILES['name']
 * @param int $maxSize 上传文件大小限制
 * @param array $allowExt 上传文件类型限制  array("*") 为没有限制
 * @param bool $isImage 是否检测为真实图片
 * @param string $uploadPath 上传路径
 * @return array array 上传成功后的信息
 */
function upload($fileInfo,$maxSize=2097152,$allowExt=array('jpg','jepg','gif','bmp','png'),$isImage=true,$uploadPath = "uploads"){

    //判断错误号
    if($fileInfo['error'] != 0){
        $errorMsg = '';
        switch($fileInfo['error']){
            case 1:
                //UPLOAD_ERR_INI_SIZE
                $errorMsg = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
                break;
            case 2:
                //UPLOAD_ERR_FORM_SIZE
                $errorMsg = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
                break;
            case 3:
                //UPLOAD_ERR_PARTIAL
                $errorMsg = '文件只有部分被上传。';
                break;
            case 4:
                $errorMsg = '没有文件被上传。';
                break;
            case 5:
                $errorMsg = '上传文件大小为0';
                break;
            default:
                $errorMsg = '系统错误!';
        }
        exit($errorMsg);
    }

    //判断文件大小
    //$maxSize = 2097152; //2M
    if($fileInfo['size']>$maxSize){
        exit('上传文件过大');
    }

    //判断文件类型
    $ext = pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
    // $allowExt = array('jpg','jepg','gif','bmp','png');
    if(!in_array($ext, $allowExt) && $allowExt[0]!='*'){
        exit('非法文件类型!');
    }

    //判断是否为真实图片
    if($isImage){
        if(!@getimagesize($fileInfo['tmp_name'])){
            exit('不是真实的图片文件!');
        }
    }

    //判断文件是否通过HTTP_POST方式上传
    if(!is_uploaded_file($fileInfo['tmp_name'])){
        exit('文件不是通过HTTP_POST方式上传的!');
    }

    //$uploadPath = "uploads";
    if(!file_exists($uploadPath)){
        mkdir($uploadPath,0777,true);
        chmod($uploadPath,0777);
    }
    $uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
    $destination = $uploadPath.'/'.$uniName;
    if(!@move_uploaded_file($fileInfo['tmp_name'], $destination)){
        exit('文件移动失败!');
    }

    return array(
        'newName'		=>	$uniName,
        'size'			=>	$fileInfo['size'],
        'destination'	=>	$destination
    );

}


?>
