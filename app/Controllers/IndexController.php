<?php

namespace App\Controllers;

/**
 * Class IndexController
 */
class IndexController extends BaseController
{
    /**
     * Test content response
     */
    public function mainAction(): void
    {
        $this->response->setContent(
            '<!DOCTYPE html>' .
            '<html lang="en">' .
                '<head>' .
                    '<meta charset="utf-8">' .
                    '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
                    '<link rel="stylesheet" href="/css/bootstrap.min.css">' .
                    '<link rel="stylesheet" href="/css/styles.css">' .
                '</head>' .
                '<body>' .
                    '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>' .
                    '<script src="/js/bootstrap.min.js"></script>' .
                    '<script src="/js/main.js"></script>' .
                '</body>' .
            '</html>'
        );
    }
}
