<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Class FetchTransactionResponse
 * @package Omnipay\PayPal\Message
 */
class FetchTransactionResponse extends Response
{
    public const NONE_STATUS = 'None';
    public const CANCELED_REVERSAL_STATUS = 'Canceled-Reversal';
    public const COMPLETED_STATUS = 'Completed';
    public const DENIED_STATUS = 'Denied';
    public const EXPIRED_STATUS = 'Expired';
    public const FAILED_STATUS = 'Failed';
    public const IN_PROGRESS_STATUS = 'In-Progress';
    public const PARTIALLY_REFUNDED_STATUS = 'Partially-Refunded';
    public const PENDING_STATUS = 'Pending';
    public const REFUNDED_STATUS = 'Refunded';
    public const REVERSED_STATUS = 'Reversed';
    public const PROCESSED_STATUS = 'Processed';
    public const VOIDED_STATUS = 'Voided';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }
}