<?php

namespace OmekaTheme\Helper;

class DHAddScripts extends \Laminas\View\Helper\AbstractHelper
{
    /**
     * @param array $scripts a list of script files in the theme /asset/js directory
     */
    public function __invoke(array $scripts)
    {
        // Get the current view and abort if it doesn't have a headScript() to
        // add CSS to.
        $view = $this->getView();
        if (! method_exists($view, 'headScript')) {
            return;
        }

        // Scroll through the array and add the CSS files.
        foreach ($scripts as $script) {
            $view->headScript()->appendFile($view->assetUrl("css/$sheet"));
        }
    }
}