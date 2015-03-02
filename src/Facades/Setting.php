<?php

namespace Namest\Settings\Facades;

use Illuminate\Contracts\Config\Repository as SettingContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class Setting
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Settings\Facades
 *
 */
class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SettingContract::class;
    }

}
