<?php


namespace App\core;


class View
{
    public $layout;

    public function renderFile($file, $params = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        try {
            require $file;
            return ob_get_clean();
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }

    public function render($file, $params = [])
    {
        $html = $this->renderFile($file, $params);
        if ($this->layout) {
            return $this->renderFile($this->layout, ['content' => $html]);
        }

        return $html;
    }
}
