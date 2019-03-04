<?php

namespace App\Enums;

/**
 * Provides a base for the flag and simple enum.
 */
abstract class Enum
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected static $constants;

    /**
     * @var array
     */
    protected static $lowerCaseKeyValues = [];

    /**
     * Get the value this enum represents.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get all the keys for the enum.
     *
     * @return array
     */
    public static function keys()
    {
        static::initialize();

        return array_keys(static::$constants);
    }

    /**
     * Get all the values for the enum.
     *
     * @return array
     */
    public static function values()
    {
        static::initialize();

        return array_values(static::$constants);
    }

    /**
     * Get the enum as its key => value pairs.
     *
     * @return array
     */
    public static function toArray()
    {
        static::initialize();

        return static::$constants;
    }

    /**
     * Check if a specific enum exists by name.
     *
     * @param string $key
     *
     * @return bool
     */
    public static function isValidKey($key)
    {
        static::initialize();

        return isset(static::$lowerCaseKeyValues[strtolower($key)]);
    }

    /**
     * Check if a specific enum exists by value.
     *
     * @param $value
     * @param bool $strict
     *
     * @return bool
     */
    public static function isValidValue($value, $strict = false)
    {
        static::initialize();

        return (array_search($value, static::$constants, $strict) !== false);
    }

    /**
     * Get the enum name from its value.
     *
     * @param mixed $value
     * @param bool $strict
     *
     * @return string
     */
    public static function keyFromValue($value, $strict = false)
    {
        if (!static::isValidValue($value)) {
            throw new \InvalidArgumentException('No enum name was found for the value supplied.');
        }

        return array_search($value, static::$constants, $strict);
    }

    /**
     * Get the imploded values
     *
     * @param string $glue
     *
     * @return string
     */
    public static function implode($glue = ',')
    {
        return implode($glue, static::values());
    }

    /**
     * Get the enum value from its name.
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function valueFromKey($key)
    {
        static::initialize();
        if (!static::isValidKey($key)) {
            throw new \InvalidArgumentException(sprintf('The enum name "%s" is not valid. Expected one of: %s', $key, implode(', ', static::keys())));
        }

        return static::$constants[static::$lowerCaseKeyValues[strtolower($key)]];
    }

    /**
     * Cache the enum array statically so we only have to do reflection a single time.
     */
    protected static function initialize()
    {
        $class = static::class;
        if (static::$constants === null) {
            static::$constants = (new \ReflectionClass($class))->getConstants();
            foreach (static::keys() as $key) {
                static::$lowerCaseKeyValues[strtolower($key)] = $key;
            }
        }
    }
}