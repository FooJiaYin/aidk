<?php
namespace libraries\base;
/**
 * 视图基类
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        //$this->_action = strtolower($action);
        $this->_action = $action;
    }
 
    // 分配变量
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }
 
    // 渲染显示
    public function render($action = null)
    {
        if($action == null){
            $action = $this->_action;
        }
        extract($this->variables);
        //$defaultHeader = APP_PATH . 'app/views/header.php';
        //$defaultFooter = APP_PATH . 'app/views/footer.php';

        //$controllerHeader = APP_PATH . 'app/views/' . $this->_controller . '/header.php';
        //$controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
        $controllerHeader = APP_PATH . 'app/views/header.php';
        $controllerFooter = APP_PATH . 'app/views/footer.php';
        $controllerMenu = APP_PATH . 'app/views/menu.php';
        $controllerShortcuts = APP_PATH . 'app/views/shortcuts.php';
        
        $controllerStyle = APP_PATH . 'app/views/' . $this->_controller . '/' . $action . 'Style.php';
        $controllerScript = APP_PATH . 'app/views/' . $this->_controller . '/' . $action . 'Script.php';
        $controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $action . '.php';

        // Header
        //include ($defaultHeader);
        /*
        if (is_file($controllerHeader)) {
            include ($controllerHeader);
        } else {
            include ($defaultHeader);
        }
        */

        // Layout
        if (is_file($controllerLayout)) {
            include ('app/views/base.php');
            //include ($controllerLayout);
        } else {
            $errorMessage = 'View moduel "'.$controllerLayout.'" loaded failed!';
            trigger_error($errorMessage, E_USER_ERROR);
        }
        
        // Footer
        //include ($defaultFooter);
        /*
        if (is_file($controllerFooter)) {
            include ($controllerFooter);
        } else {
            include ($defaultFooter);
        }
        */
    }
}
