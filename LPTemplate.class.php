<?php
class LPTemplate
{
    protected $_template_dir = 'templates';
    protected $_vars = [];

    public function __construct($template_dir = null) {
        if (!is_null($template_dir) && is_dir($template_dir)) {
            $this->_template_dir = $template_dir;
        }
    }

    public function render($template_file)
    {
        $tmpl_path = $this->_template_dir . '/' . $template_file;
        if (file_exists($tmpl_path)) {
            include $tmpl_path;
        } else {
            throw new Exception("`$tmpl_path` n’a pas été trouvé.");
        }
    }

    public function & __set($name, $value)
    {
        $this->_vars[$name] = &$value;
    }

    public function & __get($name)
    {
        return $this->_vars[$name];
    }
}
?>
