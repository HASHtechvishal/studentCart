<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [ //all csrf route for admin we not use for user or front
        //it help to solve csrf token error as ajax
        "/admin/check-current-pwd" ,
         "/admin/update-section-status", 
         "/admin/update-category-status" ,
         "/admin/category_level",
         "/admin/update-product-status",
         "/admin/update_attribute",
         "/admin/update_image",
         "/admin/update_brand",
         "/admin/update_banner"

    ];
}
