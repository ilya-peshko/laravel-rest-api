<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter implements QueryFilterContract
{
    /**
     * @var array
     */
    private array $queryParams;

    /**
     * @param array $queryParams
     */
    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     * @param Builder $builder
     *
     * @return void
     */
    public function apply(Builder $builder): void
    {
        $this->before($builder);

        $callbackMethods = $this->filterCallbackMethods();
        foreach ($this->queryParams as $name => $value) {
            $method = Str::camel($name);
            if (isset($callbackMethods[$method]) && method_exists($this, $method)) {
                call_user_func($callbackMethods[$method], $builder, $value);
            }
        }
    }

    abstract protected function filterCallbackMethods(): array;

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
    }

    /**
     * @param string     $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, mixed $default = null): mixed
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return QueryFilterContract
     */
    protected function removeQueryParam(string ...$keys): QueryFilterContract
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}
