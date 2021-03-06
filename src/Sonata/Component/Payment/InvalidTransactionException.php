<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\Component\Payment;

/**
 * Class InvalidTransactionException
 *
 * @author Hugo Briand <briand@ekino.com>
 */
class InvalidTransactionException extends \InvalidArgumentException
{
    /**
     * Constructor
     *
     * @param string    $orderReference
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($orderReference = null, $code = 0, Exception $previous = null)
    {
        $message = $orderReference ? sprintf("Invalid check - order ref: %s", $orderReference) : "Unable to find reference";
        parent::__construct($message, $code, $previous);
    }

}
