<?php

class PublicAction extends Action
{
    //Ajax上传图片
    function ajax_upload()
    {
        $data = 'file'; //文件域
        $path = './Public/upload/'; //上传文件保存位置
        $allow_ext = explode(",", "jpg,jpeg,png,bmp,gif,ico");
        $file = $_FILES[$data];
        $name = '';
        $rst = array();

        if (!empty($file['name'])) {
            $ext = end(explode('.', $file['name'])); //pathinfo($file['name'],PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            if (!in_array($ext, $allow_ext)) {
                $rst['state'] = 0;
                $rst['error'] = '只能上传jpg,jpg,png,bmp,gif类型图片';
            } else {
                $name = 'syd_' . date('YmdHis') . '_' . rand(100, 710) . '.' . $ext;
                $save_rst = move_uploaded_file($file['tmp_name'], $path . $name);
                if ($save_rst !== false) {
                    $rst['state'] = 1;
                    $rst['success'] = '文件上传成功';
                    $rst['file'] = $name;
                } else {
                    $rst['state'] = 0;
                    $rst['error'] = '文件上传失败';
                }
            }
        } else {
            $rst['state'] = 0;
            $rst['error'] = '未选择文件';
        }

        echo json_encode($rst);
    }

    /**
     * curl上传图文
     */
    function curl_upload()
    {
        ob_start();
        self::ajax_upload();
        $rst = ob_get_contents();
        ob_end_clean();
        $info = json_decode($rst, true);
        if ($info['state'] == 0) {
            exit(json_encode($info));
        } else {
            $file = realpath('./Public/upload/' . $info['file']);
            $re = $this->wx->upload_media($file);
            header("Content-Type:text/plain;charset=utf-8");
            dump($re);
        }
    }

    function albumupload()
    {
        if (!empty($_FILES)) {
            $albums_id = $_POST['albums_id']; //相册ID
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $oldfile = $_FILES['Filedata']['name'];
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $filename = time() . rand(1, 100) . '.' . $fileParts['extension'];
            $targetFile = "./Public/upload/" . $filename; //.$_FILES['Filedata']['name'];
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                $rst = move_uploaded_file($tempFile, $targetFile);
                if ($rst) {
                    $pic_id = D("Pic")->add(array(
                        'albums_id' => $albums_id,
                        'img' => $filename,
                        'title' => $oldfile,
                        'time' => time(),
                    ));
                    D("Albums")->where("id=" . $albums_id)->setInc('count', 1);
                    $this->ajaxReturn(array(
                        'file' => $targetFile,
                        'filename' => $filename,
                        'oldname' => $oldfile,
                        'pic_id' => $pic_id,
                    ), $oldfile . '文件上传成功', 1);
                } else {
                    $this->ajaxReturn('', $oldfile . '文件上传失败', 0);
                }
            } else {
                $this->ajaxReturn('', $oldfile . '文件上传失败,文件类型只能为,jpg,jpeg,gif,png,bmp', 0);
            }
        } else {
            $this->ajaxReturn('', '未选择上传文件', 0);
        }
    }


    /**
     * +----------------------------
     * @desc xheditor 上传文件
     * +----------------------------
     */
    function xheupload()
    {
        header('Content-Type: text/html; charset=UTF-8');
        $inputName = 'filedata'; //表单文件域name
        $attachDir = 'Public/upload/ximg'; //上传文件保存路径，结尾不要带/
        $maxAttachSize = 2097152; //最大上传大小，默认是2M
        $upExt = 'txt,rar,zip,jpg,jpeg,gif,png,swf,wmv,avi,wma,mp3,mid'; //上传扩展名
        $msgType = 2; //返回上传参数的格式：1，只返回url，2，返回参数数组
        $immediate = isset($_GET['immediate']) ? $_GET['immediate'] : 0; //立即上传模式，仅为演示用
        $immediate = 1;
        ini_set('date.timezone', 'Asia/Shanghai'); //时区
        $err = "";
        $msg = "''";
        $tempPath = $attachDir . '/' . date("YmdHis") . mt_rand(10000, 99999) . '.tmp';
        $localName = '';
        if (isset($_SERVER['HTTP_CONTENT_DISPOSITION']) && preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i', $_SERVER['HTTP_CONTENT_DISPOSITION'], $info)) { //HTML5上传
            file_put_contents($tempPath, file_get_contents("php://input"));
            $localName = urldecode($info[2]);
        } else { //标准表单式上传
            $upfile = @$_FILES[$inputName];
            if (!isset($upfile)) {
                $err = '文件域的name错误';
            } elseif (!empty($upfile['error'])) {
                switch ($upfile['error']) {
                    case '1':
                        $err = '文件大小超过了php.ini定义的upload_max_filesize值';
                        break;
                    case '2':
                        $err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
                        break;
                    case '3':
                        $err = '文件上传不完全';
                        break;
                    case '4':
                        $err = '无文件上传';
                        break;
                    case '6':
                        $err = '缺少临时文件夹';
                        break;
                    case '7':
                        $err = '写文件失败';
                        break;
                    case '8':
                        $err = '上传被其它扩展中断';
                        break;
                    case '999':
                    default:
                        $err = '无有效错误代码';
                }
            } elseif (empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none') {
                $err = '无文件上传';
            } else {
                $mufrst = move_uploaded_file($upfile['tmp_name'], $tempPath);
                $localName = $upfile['name'];
            }
        }
        if ($err == '') {
            $fileInfo = pathinfo($localName);
            $extension = $fileInfo['extension'];
            if (preg_match('/^(' . str_replace(',', '|', $upExt) . ')$/i', $extension)) {
                $bytes = filesize($tempPath);
                if ($bytes > $maxAttachSize) {
                    $err = '请不要上传大小超过' . self::formatBytes($maxAttachSize) . '的文件';
                } else {
                    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
                    $newFilename = 'Sydney_' . date('YmdHis') . rand(710, 7100) . '.' . $extension;
                    $targetPath = $attachDir . '/' . $newFilename;
                    $rerst = rename($tempPath, $targetPath);
                    @chmod($targetPath, 0755);
                    $targetPath = self::jsonString($targetPath);
                    $msg = "{'url':'" . __ROOT__ . '/' . $targetPath . "','localname':'" . self::jsonString($localName) . "','id':'1'}"; //id参数固定不变，仅供演示，实际项目中可以是数据库ID

                }
            } else {
                $err = '上传文件扩展名必需为：' . $upExt;
            }
            @unlink($tempPath);
        }
        echo "{'err':'" . self::jsonString($err) . "','msg':" . $msg . "}";
    }

    function jsonString($str)
    {
        return preg_replace("/([\\\\\/'])/", '\\\$1', $str);
    }

    function formatBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
        } elseif ($bytes >= 1048576) {
            $bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
        } elseif ($bytes >= 1024) {
            $bytes = round($bytes / 1024 * 100) / 100 . 'KB';
        } else {
            $bytes = $bytes . 'Bytes';
        }
        return $bytes;
    }

    function flashupload()
    {
        $data = 'Filedata'; //文件域
        $path = './Public/upload/'; //上传文件保存位置
        $allow_ext = explode(",", "jpg,jpeg,png,bmp,gif,ico");
        $file = $_FILES[$data];
        $name = '';
        $rst = array();

        if (!empty($file['name'])) {
            $ext = end(explode('.', $file['name'])); //pathinfo($file['name'],PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            if (!in_array($ext, $allow_ext)) {
                $rst['state'] = 0;
                $rst['error'] = '只能上传jpg,jpg,png,bmp,gif类型图片';
            } else {
                $name = 'syd_' . date('YmdHis') . '_' . rand(100, 710) . '.' . $ext;
                $save_rst = move_uploaded_file($file['tmp_name'], $path . $name);
                if ($save_rst !== false) {
                    $rst['state'] = 1;
                    $rst['success'] = '文件上传成功';
                    $rst['file'] = $name;
                } else {
                    $rst['state'] = 0;
                    $rst['error'] = '文件上传失败';
                }
            }
        } else {
            $rst['state'] = 0;
            $rst['error'] = '未选择文件';
        }

        echo json_encode($rst);
    }

}

?>