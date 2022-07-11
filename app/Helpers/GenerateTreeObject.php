<?php

namespace App\Helpers;

class GenerateTreeObject
{

    /**
     * Build tree object parent to child
     *
     * @param array $items
     * @param string $parent_key
     * @param string $child_key
     * @param int|string|null $parent
     * @return \stdClass
     */
    static public function generateParentChildTreeObject(array $items, string $parent_key, string $child_key, int|string $parent = null): object
    {
        $tree = (object)[];
        foreach ($items as $item) {
            if ($item[$parent_key] == $parent) {
                $tree->{$item[$child_key]} = self::generateParentChildTreeObject($items, $parent_key, $child_key,$item[$child_key]);
            }
        }
        return $tree;
    }


    /**
     * Build tree object child to parent
     *
     * @param array $items
     * @param int|string $needle
     * @param string|int $child_key
     * @param int|string $parent_key
     * @return \stdClass
     */
    static public function generateChildParentTreeObject(array $items, int|string $needle, string|int $child_key, int| string $parent_key): object
    {
        $obj = (object)[];
        foreach ($items as $item) {
            if ($item[$child_key] == $needle) {
                $obj->{$needle} = new \stdClass();
                if ($item[$parent_key]) {
                    $obj->{$needle} = self::generateChildParentTreeObject($items, $item[$parent_key], $child_key, $parent_key);
                }
            }
        }
        return $obj;
    }
}
