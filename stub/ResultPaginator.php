<?php

declare(strict_types=1);

namespace League\Flysystem\AwsS3v3\Stub;

use Aws\Result;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\PromiseInterface;

class ResultPaginator implements \Iterator
{
    /**
     * @var Result|null
     */
    private $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    /**
     * @param callable $callback
     *
     * @return PromiseInterface
     */
    public function each(callable $callback)
    {
        return $this->promiseFor($callback($this->result));
    }

    /**
     * @param mixed $value
     *
     * @return PromiseInterface
     */
    private function promiseFor($value)
    {
        if (class_exists(Promise\Create::class) && method_exists(Promise\Create::class, 'promiseFor')) {
            return Promise\Create::promiseFor($value);
        }

        if (function_exists('GuzzleHttp\\Promise\\promise_for')) {
            return Promise\promise_for($value);
        }

        return new Promise\FulfilledPromise($value);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->result ? true : false;
    }

    /**
     * @return Result|false
     */
    public function current()
    {
        return $this->valid() ? $this->result : false;
    }

    public function next()
    {
        $this->result = null;
    }

    public function key()
    {
    }

    public function rewind()
    {
    }
}
