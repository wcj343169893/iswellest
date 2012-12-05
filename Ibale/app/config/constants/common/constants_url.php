<?php
if (isset($_SERVER['HTTP_HOST'])) {
    /**
     * ホームページのURLアドレース(HTTP)
     */
    define ('HTTP_HOME_PAGE_URL', 'http://'.$_SERVER['HTTP_HOST']);
    /**
     * ホームページのURLアドレース(HTTPS)
     */
    define ('HTTPS_HOME_PAGE_URL', 'https://'.$_SERVER['HTTP_HOST']);
} else {
    /**
     * ホームページのURLアドレース(HTTP)
     */
    define ('HTTP_HOME_PAGE_URL', '/');
    /**
     * ホームページのURLアドレース(HTTPS)
     */
    define ('HTTPS_HOME_PAGE_URL', '/');
}

/**
 * APIのルート
 */
define ('OMS_API_ROOT_URL', OMS_HOST.'/oms/api/');
?>