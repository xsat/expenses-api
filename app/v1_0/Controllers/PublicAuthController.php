<?php

namespace App\v1_0\Controllers;

use App\Controllers\BaseController;
use Common\Validation\LoginValidation;
use Nen\Validation\Values;

/**
 * Class PublicAuthController
 */
class PublicAuthController extends BaseController
{
    public function loginAction(): void
    {
        $values = new Values($this->request->getPost());
        $validation = new LoginValidation();

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());

            exit;
        }

        var_dump($values);exit;
    }

}
