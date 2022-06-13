<?php

namespace App\Exceptions\Product;

use Exception;

class OutOfStockException extends Exception
{
    public function construct(string $message = "Out of stock product", int $code = 0, \Throwable|null $previous = null)
    {
        parent::__construct($message,  $code, $previous);
    }
}
