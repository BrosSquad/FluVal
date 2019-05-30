<?php


namespace Dusan\PhpMvc\Validation\Fluent;


use Closure;
use Dusan\PhpMvc\Validation\ValidationModel;
use Dusan\PhpMvc\Validation\Visitor;
use FunctionParser\FunctionParser;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use ReflectionException;
use ReflectionFunction;

abstract class FluentValidation
{
    /**
     * @var FluentValidator[]
     */
    protected $fluents = [];


    /**
     *
     * @param Closure $callback
     *
     * @return FluentValidator
     */
    public final function forMember(Closure $callback)
    {
        $fluent = new FluentValidator($callback);
        $this->fluents[] = $fluent;
        return $fluent;
    }

    /**
     * Gets the FluentValidation on each iteration
     * for validation value and validations
     *
     * @return \Generator<\Dusan\PhpMvc\Validation\Fluent\FluentValidator>
     * @internal
     */
    public final function fluentValidators()
    {
        for ($i = 0; $i < count($this->fluents); $i++) {
            yield $this->fluents[$i];
        }
    }

    // TODO: Check decision for PhpParser -> find better way to handle the personalized messaged
    /**
     * Validates the DTO object
     * @param ValidationModel $model
     *
     * @return array
     * @throws ReflectionException
     */
    public final function validate(ValidationModel $model) {
        $errors = [];
        $factory = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $traverser = new NodeTraverser();
        /** @var \Dusan\PhpMvc\Collections\Set $set */
        foreach ($this->fluents as $fluent) {
            $parser = new FunctionParser(new ReflectionFunction($fluent->getCallback()));
            $ast = $factory->parse("<?php " . $parser->getCode() . " ?>");
            $visitor = new Visitor($fluent->getValue($model), $fluent->getValidations());
            $traverser->addVisitor($visitor);
            $traverser->traverse($ast);
            $errors[$visitor->getParamName()] = $visitor->getErrors();
        }
        return $errors;
    }
}
