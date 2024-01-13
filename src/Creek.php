<?php

/**
 *  Creek - a fluent way of dealing with arrays
 *
 *  @author blue3957 <bluedel@omg.lol>
 *  @version 0.1.0
 *  @license GNU General Public License, version 3
 */

namespace Bluedel;

class Creek
{
    private array $array;

    /**
     * Instantiates a new Creek from the specified array.
     * @param array $array
     * @return static
     */
    public static function from(array $array): static
    {
        $self = new self;
        $self->array = $array;
        return $self;
    }

    /**
     * Outputs the internal array.
     * @return array
     */
    public function toArray(): array
    {
        return $this->array;
    }

    /**
     * Applies a map function to the array.
     * @param callable $callback taking the array key as an optional second argument
     * @return $this
     */
    public function map(Callable $callback): static
    {
        $this->array = array_map($callback, array_values($this->array), array_keys($this->array));
        return $this;
    }

    /**
     * Applies a filter function to the array.
     * @param callable|null $callback taking the array key as an optional second argument
     * @return $this
     */
    public function filter(?Callable $callback = null): static
    {
        $this->array = array_filter($this->array, $callback, ARRAY_FILTER_USE_BOTH);
        return $this;
    }
    /**
     * Applies a sort fonction to the array.
     * @param callable $callback takes the current and next values as arguments
     * @return $this
     */
    public function usort(Callable $callback): static
    {
        usort($this->array, $callback);
        return $this;
    }

    /**
     * Applies a sort function to the array.
     * @param callable $callback takes the current and next keys as arguments
     * @return $this
     */
    public function uksort(Callable $callback): static
    {
        uksort($this->array, $callback);
        return $this;
    }

    /**
     * Flattens the array
     * @return $this
     */
    public function flatten(int $depth = 1): static
    {
        for($i = 0; $i < $depth; $i++){
            $this->array = array_merge(...$this->array);
        }
        return $this;
    }

    /**
     * Applies a reduce function to the array.
     * @param callable $callback
     * @param mixed|null $initial
     * @return mixed returns the Creek if the reduce function results in an array, or the output of the reduce function.
     */
    public function reduce(Callable $callback, mixed $initial = null): mixed
    {
        $value = array_reduce($this->array, $callback, $initial);
        if(!is_array($value)) return $value;
        $this->array = $value;
        return $this;
    }

    /**
     * Joins the element of the array.
     * @param string|null $separator
     * @return string
     */
    public function join(?string $separator = null): string
    {
        return join($separator, $this->array);
    }

}
