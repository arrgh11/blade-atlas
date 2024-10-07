<?php

namespace Arrgh11\Atlas;

use ArrayAccess;
use ArrayIterator;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\View\AppendableAttributeValue;
use IteratorAggregate;
use JsonSerializable;
use Stringable;
use Traversable;

class ControlBag implements ArrayAccess, Htmlable, IteratorAggregate, JsonSerializable, Stringable
{
    use Conditionable, Macroable;

    /**
     * The raw array of controls.
     *
     * @var array
     */
    protected $controls = [];

    /**
     * Create a new component control bag instance.
     *
     * @return void
     */
    public function __construct(array $controls = [])
    {
        $this->controls = $controls;
    }

    /**
     * Get all of the control values.
     *
     * @return array
     */
    public function all()
    {
        return $this->controls;
    }

    /**
     * Get a given control from the control array.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {

        //check if the key is dotted
        if (Str::contains($key, '.')) {
            $keys = explode('.', $key);
            $value = $this->controls;

            foreach ($keys as $innerKey) {
                if (! is_array($value) || ! array_key_exists($innerKey, $value)) {
                    return value($default);
                }

                $value = $value[$innerKey];
            }

            return $value;
        }

        return $this->controls[$key] ?? value($default);
    }

    /**
     * Determine if a given control exists in the control array.
     *
     * @param  array|string  $key
     * @return bool
     */
    public function has($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if (! array_key_exists($value, $this->controls)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if any of the keys exist in the control array.
     *
     * @param  array|string  $key
     * @return bool
     */
    public function hasAny($key)
    {
        if (! count($this->controls)) {
            return false;
        }

        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if ($this->has($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given control is missing from the control array.
     *
     * @param  string  $key
     * @return bool
     */
    public function missing($key)
    {
        return ! $this->has($key);
    }

    /**
     * Only include the given control from the control array.
     *
     * @param  mixed  $keys
     * @return static
     */
    public function only($keys)
    {
        if (is_null($keys)) {
            $values = $this->controls;
        } else {
            $keys = Arr::wrap($keys);

            $values = Arr::only($this->controls, $keys);
        }

        return new static($values);
    }

    /**
     * Exclude the given control from the control array.
     *
     * @param  mixed|array  $keys
     * @return static
     */
    public function except($keys)
    {
        if (is_null($keys)) {
            $values = $this->controls;
        } else {
            $keys = Arr::wrap($keys);

            $values = Arr::except($this->controls, $keys);
        }

        return new static($values);
    }

    /**
     * Filter the controls, returning a bag of controls that pass the filter.
     *
     * @param  callable  $callback
     * @return static
     */
    public function filter($callback)
    {
        return new static(collect($this->controls)->filter($callback)->all());
    }

    /**
     * Return a bag of controls that have keys starting with the given value / pattern.
     *
     * @param  string|string[]  $needles
     * @return static
     */
    public function whereStartsWith($needles)
    {
        return $this->filter(function ($value, $key) use ($needles) {
            return Str::startsWith($key, $needles);
        });
    }

    /**
     * Return a bag of controls with keys that do not start with the given value / pattern.
     *
     * @param  string|string[]  $needles
     * @return static
     */
    public function whereDoesntStartWith($needles)
    {
        return $this->filter(function ($value, $key) use ($needles) {
            return ! Str::startsWith($key, $needles);
        });
    }

    /**
     * Return a bag of controls that have keys starting with the given value / pattern.
     *
     * @param  string|string[]  $needles
     * @return static
     */
    public function thatStartWith($needles)
    {
        return $this->whereStartsWith($needles);
    }

    /**
     * Only include the given control from the control array.
     *
     * @param  mixed|array  $keys
     * @return static
     */
    public function onlyProps($keys)
    {
        return $this->only(static::extractPropNames($keys));
    }

    /**
     * Exclude the given control from the control array.
     *
     * @param  mixed|array  $keys
     * @return static
     */
    public function exceptProps($keys)
    {
        return $this->except(static::extractPropNames($keys));
    }

    /**
     * Conditionally merge classes into the control bag.
     *
     * @param  mixed|array  $classList
     * @return static
     */
    public function class($classList)
    {
        $classList = Arr::wrap($classList);

        return $this->merge(['class' => Arr::toCssClasses($classList)]);
    }

    /**
     * Conditionally merge styles into the control bag.
     *
     * @param  mixed|array  $styleList
     * @return static
     */
    public function style($styleList)
    {
        $styleList = Arr::wrap($styleList);

        return $this->merge(['style' => Arr::toCssStyles($styleList)]);
    }

    /**
     * Merge additional controls / values into the control bag.
     *
     * @param  bool  $escape
     * @return static
     */
    public function merge(array $controlDefaults = [], $escape = true)
    {
        $controlDefaults = array_map(function ($value) use ($escape) {
            return $this->shouldEscapeControlValue($escape, $value)
                ? e($value)
                : $value;
        }, $controlDefaults);

        [$appendableAttributes, $nonAppendableAttributes] = collect($this->controls)
            ->partition(function ($value, $key) use ($controlDefaults) {
                return $key === 'class' || $key === 'style' || (
                    isset($controlDefaults[$key]) &&
                    $controlDefaults[$key] instanceof AppendableAttributeValue
                );
            });

        $controls = $appendableAttributes->mapWithKeys(function ($value, $key) use ($controlDefaults, $escape) {
            $defaultsValue = isset($controlDefaults[$key]) && $controlDefaults[$key] instanceof AppendableAttributeValue
                ? $this->resolveAppendableControlDefault($controlDefaults, $key, $escape)
                : ($controlDefaults[$key] ?? '');

            if ($key === 'style') {
                $value = Str::finish($value, ';');
            }

            return [$key => implode(' ', array_unique(array_filter([$defaultsValue, $value])))];
        })->merge($nonAppendableAttributes)->all();

        return new static(array_merge($controlDefaults, $controls));
    }

    /**
     * Determine if the specific control value should be escaped.
     *
     * @param  bool  $escape
     * @param  mixed  $value
     * @return bool
     */
    protected function shouldEscapeControlValue($escape, $value)
    {
        if (! $escape) {
            return false;
        }

        return ! is_object($value) &&
            ! is_null($value) &&
            ! is_bool($value);
    }

    /**
     * Create a new appendable control value.
     *
     * @param  mixed  $value
     * @return \Illuminate\View\AppendableAttributeValue
     */
    public function prepends($value)
    {
        return new AppendableAttributeValue($value);
    }

    /**
     * Resolve an appendable control value default value.
     *
     * @param  array  $controlDefaults
     * @param  string  $key
     * @param  bool  $escape
     * @return mixed
     */
    protected function resolveAppendableControlDefault($attributeDefaults, $key, $escape)
    {
        if ($this->shouldEscapeControlValue($escape, $value = $attributeDefaults[$key]->value)) {
            $value = e($value);
        }

        return $value;
    }

    /**
     * Determine if the attribute bag is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return trim((string) $this) === '';
    }

    /**
     * Determine if the attribute bag is not empty.
     *
     * @return bool
     */
    public function isNotEmpty()
    {
        return ! $this->isEmpty();
    }

    /**
     * Get all of the raw attributes.
     *
     * @return array
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * Set the underlying controls.
     *
     * @return void
     */
    public function setControls(array $controls)
    {
        if (isset($controls['controls']) &&
            $controls['controls'] instanceof self) {
            $parentBag = $controls['controls'];

            unset($controls['controls']);

            $controls = $parentBag->merge($controls, $escape = false)->getControls();
        }

        $this->controls = $controls;
    }

    /**
     * Extract "prop" names from given keys.
     *
     * @return array
     */
    public static function extractPropNames(array $keys)
    {
        $props = [];

        foreach ($keys as $key => $default) {
            $key = is_numeric($key) ? $default : $key;

            $props[] = $key;
            $props[] = Str::kebab($key);
        }

        return $props;
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return (string) $this;
    }

    /**
     * Merge additional controls / values into the control bag.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function __invoke(array $controlDefaults = [])
    {
        return new HtmlString((string) $this->merge($controlDefaults));
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string  $offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->controls[$offset]);
    }

    /**
     * Get the value at the given offset.
     *
     * @param  string  $offset
     */
    public function offsetGet($offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * Set the value at a given offset.
     *
     * @param  string  $offset
     * @param  mixed  $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->controls[$offset] = $value;
    }

    /**
     * Remove the value at the given offset.
     *
     * @param  string  $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->controls[$offset]);
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->controls);
    }

    /**
     * Convert the object into a JSON serializable form.
     */
    public function jsonSerialize(): mixed
    {
        return $this->controls;
    }

    /**
     * Implode the controls into a single HTML ready string.
     *
     * @return string
     */
    public function __toString()
    {
        $string = '';

        foreach ($this->controls as $key => $value) {
            if ($value === false || is_null($value)) {
                continue;
            }

            if ($value === true) {
                $value = $key === 'x-data' || str_starts_with($key, 'wire:') ? '' : $key;
            }

            $string .= ' '.$key.'="'.str_replace('"', '\\"', trim($value)).'"';
        }

        return trim($string);
    }
}
