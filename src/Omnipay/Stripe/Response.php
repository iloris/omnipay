<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\Stripe;

use Omnipay\Common\AbstractResponse;
use Omnipay\Exception;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Stripe Response
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return !isset($this->data['error']);
    }

    public function getGatewayReference()
    {
        if ($this->isSuccessful()) {
            return $this->data['id'];
        }

        return $this->data['error']['charge'];
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['error']['message'];
        }
    }
}
