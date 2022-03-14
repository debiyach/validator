<?php
/**
 * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
 */

namespace Debiyach\Validation;

use function filter_var;
use function is_array;
use function is_int;
use function is_string;
use function count;
use function mb_strlen;

class Validate
{
    /**
     * @param string $data
     * @return string
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public static function email(string $data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL) ? null : 'Belirtilen format email olmalıdır!';
    }

    /**
     * @param $data
     * @return string
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public static function required($data)
    {
        return (isset($data) && !empty($data)) ? null : 'Belirtilen değerin girilmesi zorunludur!';
    }

    /**
     * @param array|string|int $data
     * @param int $count
     * @return string
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public static function min(array|string|int $data, int $count)
    {
        if (is_array($data) && (count($data) <= $count)) {
            return "Belirtilen dizide ki eleman sayısı en az $count olmalıdır!";
        } elseif (is_string($data) && (mb_strlen($data) <= $count)) {
            return "Belirtilen dizede ki karakter sayısı en az $count olmalıdır!";
        } elseif (is_int($data) && ($data <= $count)) {
            return "Belirtilen sayı, $count sayısından büyük olmalıdır!";
        }
    }

    /**
     * @param array|string|int $data
     * @param int $count
     * @return string
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public static function max(array|string|int $data, int $count)
    {
        if (is_array($data) && !(count($data) >= $count)) {
            return "Belirtilen dizide ki eleman sayısı en fazla $count olmalıdır!";
        } elseif (is_string($data) && (mb_strlen($data) >= $count)) {
            return "Belirtilen dizede ki karakter sayısı en fazla $count olmalıdır!";
        } elseif (is_int($data) && ($data >= $count)) {
            return "Belirtilen sayı, $count sayısından küçük olmalıdır!";
        }
    }
}