<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_SYSTEM')) {
    echo 'Stop!!!';
    exit(2);
}

$site_path = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
if ($site_path == DIRECTORY_SEPARATOR) {
	$site_path = '';
}
if (!empty($site_path)) {
	$site_path = str_replace(DIRECTORY_SEPARATOR, '/', $site_path);
}
if (!empty($site_path)) {
	$site_path = preg_replace('/[\/]+$/', '', $site_path);
}
if (!empty($site_path)) {
	$site_path = preg_replace('/^[\/]*(.*)$/', '/\\1', $site_path);
}
define('NV_BASE_SITEURL', $site_path . '/');
unset($site_path);

function nv_EncString($string)
{
    $utf8_lookup = [
		'romanize' => [
			// Lower accents
			'à' => 'a', 'ô' => 'o', 'ď' => 'd', 'ḟ' => 'f', 'ë' => 'e', 'š' => 's', 'ơ' => 'o', 'ß' => 'ss', 'ă' => 'a', 'ř' => 'r',
			'ț' => 't', 'ň' => 'n', 'ā' => 'a', 'ķ' => 'k', 'ŝ' => 's', 'ỳ' => 'y', 'ņ' => 'n', 'ĺ' => 'l', 'ħ' => 'h', 'ṗ' => 'p',
			'ó' => 'o', 'ú' => 'u', 'ě' => 'e', 'é' => 'e', 'ç' => 'c', 'ẁ' => 'w', 'ċ' => 'c', 'õ' => 'o', 'ṡ' => 's', 'ø' => 'o',
			'ģ' => 'g', 'ŧ' => 't', 'ș' => 's', 'ė' => 'e', 'ĉ' => 'c', 'ś' => 's', 'î' => 'i', 'ű' => 'u', 'ć' => 'c', 'ę' => 'e',
			'ŵ' => 'w', 'ṫ' => 't', 'ū' => 'u', 'č' => 'c', 'ö' => 'oe', 'è' => 'e', 'ŷ' => 'y', 'ą' => 'a', 'ł' => 'l', 'ų' => 'u',
			'ů' => 'u', 'ş' => 's', 'ğ' => 'g', 'ļ' => 'l', 'ƒ' => 'f', 'ž' => 'z', 'ẃ' => 'w', 'ḃ' => 'b', 'å' => 'a', 'ì' => 'i',
			'ï' => 'i', 'ḋ' => 'd', 'ť' => 't', 'ŗ' => 'r', 'ä' => 'ae', 'í' => 'i', 'ŕ' => 'r', 'ê' => 'e', 'ü' => 'ue', 'ò' => 'o',
			'ē' => 'e', 'ñ' => 'n', 'ń' => 'n', 'ĥ' => 'h', 'ĝ' => 'g', 'đ' => 'd', 'ĵ' => 'j', 'ÿ' => 'y', 'ũ' => 'u', 'ŭ' => 'u',
			'ư' => 'u', 'ţ' => 't', 'ý' => 'y', 'ő' => 'o', 'â' => 'a', 'ľ' => 'l', 'ẅ' => 'w', 'ż' => 'z', 'ī' => 'i', 'ã' => 'a',
			'ġ' => 'g', 'ṁ' => 'm', 'ō' => 'o', 'ĩ' => 'i', 'ù' => 'u', 'į' => 'i', 'ź' => 'z', 'á' => 'a', 'û' => 'u', 'þ' => 'th',
			'ð' => 'dh', 'æ' => 'ae', 'µ' => 'u', 'ĕ' => 'e', 'ạ' => 'a', 'ả' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ậ' => 'a', 'ẩ' => 'a',
			'ẫ' => 'a', 'ằ' => 'a', 'ắ' => 'a', 'ặ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ẻ' => 'e', 'ẹ' => 'e', 'ẽ' => 'e', 'ề' => 'e',
			'ế' => 'e', 'ệ' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ị' => 'i', 'ỉ' => 'i', 'ọ' => 'o', 'ỏ' => 'o', 'ờ' => 'o', 'ớ' => 'o',
			'ợ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ộ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ụ' => 'u', 'ủ' => 'u',
			'ừ' => 'u', 'ứ' => 'u', 'ự' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ỵ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y',
			// Upper accents
			'À' => 'A', 'Ô' => 'O', 'Ď' => 'D', 'Ḟ' => 'F', 'Ë' => 'E', 'Š' => 'S', 'Ơ' => 'O', 'Ă' => 'A', 'Ř' => 'R', 'Ț' => 'T',
			'Ň' => 'N', 'Ā' => 'A', 'Ķ' => 'K', 'Ŝ' => 'S', 'Ỳ' => 'Y', 'Ņ' => 'N', 'Ĺ' => 'L', 'Ħ' => 'H', 'Ṗ' => 'P', 'Ó' => 'O',
			'Ú' => 'U', 'Ě' => 'E', 'É' => 'E', 'Ç' => 'C', 'Ẁ' => 'W', 'Ċ' => 'C', 'Õ' => 'O', 'Ṡ' => 'S', 'Ø' => 'O', 'Ģ' => 'G',
			'Ŧ' => 'T', 'Ș' => 'S', 'Ė' => 'E', 'Ĉ' => 'C', 'Ś' => 'S', 'Î' => 'I', 'Ű' => 'U', 'Ć' => 'C', 'Ę' => 'E', 'Ŵ' => 'W',
			'Ṫ' => 'T', 'Ū' => 'U', 'Č' => 'C', 'Ö' => 'Oe', 'È' => 'E', 'Ŷ' => 'Y', 'Ą' => 'A', 'Ł' => 'L', 'Ų' => 'U', 'Ů' => 'U',
			'Ş' => 'S', 'Ğ' => 'G', 'Ļ' => 'L', 'Ƒ' => 'F', 'Ž' => 'Z', 'Ẃ' => 'W', 'Ḃ' => 'B', 'Å' => 'A', 'Ì' => 'I', 'Ï' => 'I',
			'Ḋ' => 'D', 'Ť' => 'T', 'Ŗ' => 'R', 'Ä' => 'Ae', 'Í' => 'I', 'Ŕ' => 'R', 'Ê' => 'E', 'Ü' => 'Ue', 'Ò' => 'O', 'Ē' => 'E',
			'Ñ' => 'N', 'Ń' => 'N', 'Ĥ' => 'H', 'Ĝ' => 'G', 'Đ' => 'D', 'Ĵ' => 'J', 'Ÿ' => 'Y', 'Ũ' => 'U', 'Ŭ' => 'U', 'Ư' => 'U',
			'Ţ' => 'T', 'Ý' => 'Y', 'Ő' => 'O', 'Â' => 'A', 'Ľ' => 'L', 'Ẅ' => 'W', 'Ż' => 'Z', 'Ī' => 'I', 'Ã' => 'A', 'Ġ' => 'G',
			'Ṁ' => 'M', 'Ō' => 'O', 'Ĩ' => 'I', 'Ù' => 'U', 'Į' => 'I', 'Ź' => 'Z', 'Á' => 'A', 'Û' => 'U', 'Þ' => 'Th', 'Ð' => 'Dh',
			'Æ' => 'Ae', 'Ĕ' => 'E', 'Ạ' => 'A', 'Ả' => 'A', 'Ầ' => 'A', 'Ấ' => 'A', 'Ậ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ằ' => 'A',
			'Ắ' => 'A', 'Ặ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ẻ' => 'E', 'Ẹ' => 'E', 'Ẽ' => 'E', 'Ề' => 'E', 'Ế' => 'E', 'Ệ' => 'E',
			'Ể' => 'E', 'Ễ' => 'E', 'Ị' => 'I', 'Ỉ' => 'I', 'Ọ' => 'O', 'Ỏ' => 'O', 'Ờ' => 'O', 'Ớ' => 'O', 'Ợ' => 'O', 'Ở' => 'O',
			'Ỡ' => 'O', 'Ồ' => 'O', 'Ố' => 'O', 'Ộ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ụ' => 'U', 'Ủ' => 'U', 'Ừ' => 'U', 'Ứ' => 'U',
			'Ự' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ỵ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y',
			// Other
			'ǐ' => 'i', 'ǔ' => 'u', 'ǎ' => 'a', 'ǒ' => 'o', 'ǚ' => 'u', 'ǚ' => 'u', 'ǜ' => 'u', 'ǐ' => 'i', 'ǐ' => 'i', '@' => 'a'
		]
	];

    return strtr($string, $utf8_lookup['romanize']);
}

function nv_string_to_filename($word)
{
    $word = nv_EncString($word);
    $word = preg_replace('/[^a-z0-9\.\-\_ ]/i', '', $word);
    $word = preg_replace('/^\W+|\W+$/', '', $word);
    $word = preg_replace('/[ ]+/', '-', $word);

    return strtolower(preg_replace('/\W-/', '', $word));
}

function nv_getextension($filename)
{
    if (!str_contains($filename, '.')) {
        return '';
    }
    $filename = basename(strtolower($filename));
    $filename = explode('.', $filename);

    return array_pop($filename);
}