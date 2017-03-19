<?php
namespace Kerox\Messenger\Helper;

trait UtilityTrait
{

    /**
     * Returns the input lower_case_delimited_string as a CamelCasedString.
     *
     * @param string $string String to be camelize
     * @param string $delimiter The delimiter in the input string
     * @return string
     */
    public function camelize(string $string, string $delimiter = '_'): string
    {
        return implode('', array_map('ucfirst', array_map('strtolower', explode($delimiter, $string))));
    }

    /**
     * Enhanced version of array_filter which allow to filter recursively
     *
     * @param array $array
     * @param callable|array $callback
     * @return array
     */
    public function arrayFilter(array $array, $callback = ['self', 'filter']): array
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $array[$k] = $this->arrayFilter($v, $callback);
            }
        }

        return array_filter($array, $callback);
    }

    /**
     * Callback function for filtering.
     *
     * @param mixed $var Array to filter.
     * @return bool
     */
    protected static function filter($var)
    {
        return $var === 0 || $var === 0.0 || $var === '0' || !empty($var);
    }
}