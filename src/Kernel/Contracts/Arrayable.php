<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Contracts;

use ArrayAccess;
interface Arrayable extends ArrayAccess
{
    public function toArray();
}