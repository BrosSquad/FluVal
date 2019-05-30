<?php


namespace Dusan\PhpMvc\Validation\Fluent;


use Closure;
use Dusan\PhpMvc\Collections\Map;
use Dusan\PhpMvc\Validation\ValidationModel;


/**
 * Class BaseFluentValidator
 *
 * @package Dusan\PhpMvc\Validation\Fluent
 */
abstract class BaseFluentValidator
{
    /**
     * @var \Dusan\PhpMvc\Collections\Map
     */
    protected $validations;

    /**
     * @var \Closure
     */
    protected $callback;


    /**
     * BaseFluentValidator constructor.
     *
     * @param Closure $callback
     * @param Map     $validations
     */
    public function __construct(Closure $callback, Map $validations)
    {
        $this->validations = $validations;
        $this->callback = $callback;
    }

    /**
     * @param bool $required
     *
     * @return $this
     */
    public function required(bool $required)
    {
        $this->validations->push('required', function ($value) use ($required) {
            if ($required) {
                return $value !== NULL;
            }
            return true;
        });

        return $this;
    }

    /**
     * @param ValidationModel $model
     *
     * @return mixed
     */
    public final function getValue($model)
    {
        $callback = $this->callback;
        return $callback($model);
    }

    /**
     * @return \Dusan\PhpMvc\Collections\Map
     */
    public final function getValidations(): Map
    {
        return $this->validations;
    }

    public function getCallback()
    {
        return $this->callback;
    }
}
