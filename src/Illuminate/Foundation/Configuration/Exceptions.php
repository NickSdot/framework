<?php

namespace Illuminate\Foundation\Configuration;

use Closure;
use Illuminate\Foundation\Exceptions\Handler;

class Exceptions
{
    /**
     * Create a new exception handling configuration instance.
     *
     * @param  \Illuminate\Foundation\Exceptions\Handler  $handler
     * @return void
     */
    public function __construct(public Handler $handler)
    {
    }

    /**
     * Register a reportable callback.
     *
     * @param  callable  $reportUsing
     * @return \Illuminate\Foundation\Exceptions\ReportableHandler
     */
    public function reportable(callable $reportUsing)
    {
        return $this->handler->reportable($reportUsing);
    }

    /**
     * Register a renderable callback.
     *
     * @param  callable  $renderUsing
     * @return $this
     */
    public function renderable(callable $renderUsing)
    {
        $this->handler->renderable($renderUsing);

        return $this;
    }

    /**
     * Specify the callback that should be used to throttle reportable exceptions.
     *
     * @param  callable  $throttleUsing
     * @return $this
     */
    public function throttle(callable $throttleUsing)
    {
        $this->handler->throttleUsing($throttleUsing);

        return $this;
    }

    /**
     * Register a new exception mapping.
     *
     * @param  \Closure|string  $from
     * @param  \Closure|string|null  $to
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function map($from, $to = null)
    {
        $this->handler->map($from, $to);

        return $this;
    }

    /**
     * Set the log level for the given exception type.
     *
     * @param  class-string<\Throwable>  $type
     * @param  \Psr\Log\LogLevel::*  $level
     * @return $this
     */
    public function level(string $type, string $level)
    {
        $this->handler->level($type, $level);

        return $this;
    }

    /**
     * Register a closure that should be used to build exception context data.
     *
     * @param  \Closure  $contextCallback
     * @return $this
     */
    public function context(Closure $contextCallback)
    {
        $this->handler->buildContextUsing($contextCallback);

        return $this;
    }

    /**
     * Indicate that the given exception type should not be reported.
     *
     * @param  array|string  $class
     * @return $this
     */
    public function dontReport(array|string $class)
    {
        foreach (Arr::wrap($class) as $exceptionClass) {
            $this->handler->dontReport($exceptionClass);
        }

        return $this;
    }

    /**
     * Do not report duplicate exceptions.
     *
     * @return $this
     */
    public function dontReportDuplicates()
    {
        $this->handler->dontReportDuplicates();

        return $this;
    }

    /**
     * Indicate that the given attributes should never be flashed to the session on validation errors.
     *
     * @param  array|string  $attributes
     * @return $this
     */
    public function dontFlash(array|string $attributes)
    {
        $this->handler->dontFlash($attributes);

        return $this;
    }
}
