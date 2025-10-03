<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

/**
 * Lưu ý code này để test trong môi trường dev, không có các biện pháp bảo vệ, không nên dùng trong môi trường production
 */

define('NV_SYSTEM', true);
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __FILE__), PATHINFO_DIRNAME));

register_shutdown_function("fatal_handler");
function fatal_handler()
{
    $error = error_get_last();
    if ($error !== NULL) {
        file_put_contents(NV_ROOTDIR . '/error.log', print_r($error, true), FILE_APPEND);
    }
}

require NV_ROOTDIR . '/mainfile.php';

// Xử lý upload từ URL hay fileupload
$urlfile = rawurldecode(trim((string) ($_POST['urlfile'] ?? '')));
if (!empty($urlfile)) {
    // Upload from URL
    $target_file_name = nv_string_to_filename(basename($urlfile));
    $target_file_ext = nv_getextension($target_file_name);
    if (empty($target_file_ext)) {
        jsonError('File upload no ext');
    }
    if (!in_array($target_file_ext, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
        jsonError('Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed');
    }

    $name = substr(basename($target_file_name), 0, -(strlen($target_file_ext) + 1));
    $stt = 0;
    $target_file_path = NV_ROOTDIR . '/uploads/' . $target_file_name;
    while (file_exists($target_file_path)) {
        $stt++;
        $target_file_name = $name . '_' . $stt . '.' . $target_file_ext;
        $target_file_path = NV_ROOTDIR . '/uploads/' . $target_file_name;
    }

    $remoteFileContent = file_get_contents($urlfile);
    if ($remoteFileContent === false or empty($remoteFileContent)) {
        jsonError('Can not download file from URL');
    }
    $check = file_put_contents($target_file_path, $remoteFileContent);
    if ($check === false) {
        jsonError('Sorry, can not save upload file');
    }

    jsonSuccess(NV_BASE_SITEURL . 'uploads/' . $target_file_name);
} else {
    // Upload file
    file_put_contents(NV_ROOTDIR . '/debug.log', print_r($_FILES, true), FILE_APPEND);

    if (empty($_FILES['upload']) or empty($_FILES['upload']['name']) or empty($_FILES['upload']['tmp_name']) or !file_exists($_FILES['upload']['tmp_name'])) {
        jsonError('No upload file');
    }
    $filesize = filesize($_FILES['upload']['tmp_name']);
    if (empty($_FILES['upload']['size']) or empty($filesize)) {
        jsonError('Upload size is 0');
    }
    if (!empty($_FILES['upload']['error'])) {
        jsonError('Error server handller!');
    }

    $target_file_name = nv_string_to_filename(basename($_FILES['upload']['name']));
    $target_file_ext = nv_getextension($target_file_name);
    if (empty($target_file_ext)) {
        jsonError('File upload no ext');
    }
    if (!in_array($target_file_ext, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
        jsonError('Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed');
    }

    $name = substr(basename($target_file_name), 0, -(strlen($target_file_ext) + 1));
    $stt = 0;
    $target_file_path = NV_ROOTDIR . '/uploads/' . $target_file_name;
    while (file_exists($target_file_path)) {
        $stt++;
        $target_file_name = $name . '_' . $stt . '.' . $target_file_ext;
        $target_file_path = NV_ROOTDIR . '/uploads/' . $target_file_name;
    }

    if (!move_uploaded_file($_FILES['upload']['tmp_name'], $target_file_path)) {
        jsonError('Sorry, can not save upload file');
    }

    jsonSuccess(NV_BASE_SITEURL . 'uploads/' . $target_file_name);
}

function jsonError($string)
{
    header('Content-Type: application/json');
    $json = [
        'error' => [
            'message' => $string
        ]
    ];
    exit(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

function jsonSuccess($url)
{
    header('Content-Type: application/json');
    $json = [
        'url' => $url
    ];
    exit(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}
