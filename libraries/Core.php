<?php

namespace libraries;

// 框架根目錄
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

/**
 * 框架核心
 */
class Core
{
    // 讀取設定
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    // 執行框架
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->unregisterGlobals();
        $this->setSnsLoginConfig();
        $this->setDbConfig();
        $this->setCourseCategory();
        $this->route();
    }

    // 路由設定
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
        // 清除?之後的内容
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        // 刪除前後的“/”
        $url = trim($url, '/');

        if ($url) {
            // 使用“/”分割字串，並保存在陣列中
            $urlArray = explode('/', $url);
            // 刪除空元素
            $urlArray = array_filter($urlArray);

            // 取得控制器名稱
            $controllerName = ucfirst($urlArray[0]);

            // 取得動作名稱
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            // 取得URL参參數
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // 判斷控制器與操作是否有效
        $controller = 'app\\controllers\\' . $controllerName . 'Controller';
        if (!class_exists($controller)) {
            exit($controller . ' Controller Not Exist!');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . ' Action Not Exist!');
        }

        // 如果控制器和操作名存在，则实例化控制器，因为控制器对象里面
        // 还会用到控制器名和操作名，所以实例化的时候把他们俩的名称也
        // 传进去。结合Controller基类一起看
        $dispatch = new $controller($controllerName, $actionName);

        // $dispatch保存控制器实例化后的对象，我们就可以调用它的方法，
        // 也可以像方法中传入参数，以下等同于：$dispatch->$actionName($param)
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // 偵測Debug mode
    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }

    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // 检测自定义全局变量并移除。因为 register_globals 已经弃用，如果
    // 已经弃用的 register_globals 指令被设置为 on，那么局部变量也将
    // 在脚本的全局作用域中可用。 例如， $_POST['foo'] 也将以 $foo 的
    // 形式存在，这样写是不好的实现，会影响代码中的其他变量。 相关信息，
    // 参考: http://php.net/manual/zh/faq.using.php#faq.register-globals
    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    //
    public function setSnsLoginConfig()
    {
        define('SNS_FB_APP_ID', $this->config['SNS_FB_AppId']);
        define('SNS_FB_API_VERSION', $this->config['SNS_FB_Api_Version']);
        define('SNS_GOOGLE_CLIENT_ID', $this->config['SNS_Google_Client_Id']);
    }

    // 資料庫設定
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }

    public function setCourseCategory()
    {
        if ($this->config['courseCategory']) {
            define('COURSE_CATEGORY', $this->config['courseCategory']);
        }
    }

    // 自動載入Class
    public function loadClass($className)
    {
        //echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
        if (strpos($className, '\\') !== false) {
            // 包含应用（application目录）文件
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }

        include $file;
    }
}
