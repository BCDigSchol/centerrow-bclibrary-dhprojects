<?php

namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

class DHAddStylesheets extends AbstractHelper
{
    /**
     * @param string[] $stylesheets a list of files that should be in the /asset/css theme directory
     */
    public function __invoke(array $stylesheets): void
    {
        // Get the current view and abort if it doesn't have a headLink() to
        // add CSS to.
        $view = $this->getView();
        if (! method_exists($view, 'headLink')) {
            return;
        }

        // Scroll through the array and add the CSS files.
        foreach ($stylesheets as $sheet) {
            $view->headLink()->appendStylesheet($view->assetUrl("css/$sheet"));
        }
    }

}