<?php

namespace Namest\Settings\Facades;

use Namest\Settings\Contracts\Repository as SettingContract;
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
