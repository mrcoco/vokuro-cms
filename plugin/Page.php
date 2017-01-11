<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 10/6/2016
 * Time: 10:39 PM
 */

namespace Modules\Pages\Plugin;


class Page extends \Phalcon\Tag;
{
    public function latestPage($category)
    {
        $html = "LATEST PAGE";
        return $html;
    }

    public function latestLink($category)
    {

    }
}