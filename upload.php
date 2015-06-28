<?php
    function FileUpload($file_content = ' ', $uploaddir, $login, $i)  
    {  	
        $error = null;  
        $max_size = 1024*5*1024;  
        if ($i==0) {
            $valid_ext = array('jpg', 'jpeg', 'png'); 
        }
        if ($i==1) {
            $valid_ext = array('pdf', 'txt', 'docx'); 
        }
        if ($_FILES['userfile']['error'][$i] === UPLOAD_ERR_OK) {//расширение файла  
            $file_ext = pathinfo($_FILES['userfile']['name'][$i], PATHINFO_EXTENSION);
            if(in_array($file_ext, $valid_ext)) {  //размер файла  
                if($_FILES['userfile']['size'][$i] < $max_size) {   //путь для заагрузки
                    if ($i==0) {
                        $destination = $uploaddir."/img_".$login."/".date(U).$_FILES["userfile"]["name"][$i];  
                    }
                    if ($i==1) {
                        $destination = $uploaddir."/book_".$login."/".date(U).$_FILES["userfile"]["name"][$i];  
                    }
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $destination)) { 
                        return true;  
                    } else {  
                        $error = $file_content.'Не удалось загрузить файл';
                    }
                } else {
                    $error = $file_content.'Размер файла больше допустимого';
                }
            } else {  
                $error = $file_content.'У файла недопустимое расширение';  
            }
        }  else {  
            $upload_err = array(
            UPLOAD_ERR_INI_SIZE   => 'Размер файла больше разрешенного 
                                      директивой upload_max_filesize в php.ini', 
            UPLOAD_ERR_FORM_SIZE  => 'Размер файла превышает указанное 
                                      значение в MAX_FILE_SIZE', 
            UPLOAD_ERR_PARTIAL    => 'Файл был загружен только частично', 
            UPLOAD_ERR_NO_FILE    => 'Не был выбран файл для загрузки', 
            UPLOAD_ERR_NO_TMP_DIR => 'Не найдена папка для временных файлов', 
            UPLOAD_ERR_CANT_WRITE => 'Ошибка записи файла на диск' ,
            UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла'
            ); 
      
            $error_code = $_FILES['userfile']['error'][$i];  
            if(!empty($upload_err[$error_code]))  $error = $file_content.$upload_err[$error_code];   else  $error = $file_content."Нестандартная ошибка";  
        }  
        echo $error;
        return false;  
    }  
?>  