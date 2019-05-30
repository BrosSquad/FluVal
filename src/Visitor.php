<?php


namespace Dusan\PhpMvc\Validation;


use Dusan\PhpMvc\Collections\Map;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    private $validations = [];
    private $errors = [];
    private $paramName;
    private $value;

    public function __construct($value, Map $validations)
    {
        $this->value = $value;
        $this->validations = $validations;
    }

    /**
     * @param \PhpParser\Node $node
     *
     * @return int|\PhpParser\Node|void|null
     * @throws \Exception
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Return_) {
            $this->paramName = ucwords($node->expr->name->name);
            /** @var \Closure $fn */
            foreach ($this->validations as $key => $callback) {
                $result = $callback($this->value);
                if ($result !== NULL) {
                    $this->errors[] = $result;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public function getParamName()
    {
        return $this->paramName;
    }


}
