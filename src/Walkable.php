<?php


namespace Joem\Saturn;


trait Walkable
{

    /**
     * Walk an array and organise it's potential layouts.
     *
     * A walkable var is an array that can contain an array, which contains either key-value parameters, or a
     * multi-level array which contains further arrays - which THEN contain key-value parameters.
     *
     * Walking these values means we can easily manage parameters in methods, without complicating how developers must
     * provide the parameters.
     *
     * @param array $walk
     * @return array
     */
    public static function walk(array $walk)
    {

        $wpArgs = [];

        foreach ($walk as $key => $step) {

            if (gettype($step) == 'array') {
                foreach ($step as $stepKey => $stepValue) {
                    $wpArgs[] = array(
                        'key' => $stepKey,
                        'value' => $stepValue
                    );
                }
            } else {
                $wpArgs = array(
                    'key' => $key,
                    'value' => $step
                );
            }
        }

        return $wpArgs;
    }
}