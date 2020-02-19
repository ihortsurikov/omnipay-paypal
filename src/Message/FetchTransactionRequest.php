<?php

namespace Omnipay\PayPal\Message;

/**
 * PayPal Fetch Transaction Request
 */
class FetchTransactionRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        $data = $this->getBaseData();
        $data['METHOD'] = 'GetTransactionDetails';
        $data['TRANSACTIONID'] = $this->getTransactionReference();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), [], http_build_query($data, '', '&'));
        $responseArray = $this->parseResponse($httpResponse->getBody()->getContents());

        if (count($responseArray) > 0) {
            $responseArray['refundable'] = $responseArray['PAYMENTSTATUS'] === FetchTransactionResponse::COMPLETED_STATUS;
            $responseArray['voidable'] = $responseArray['PAYMENTSTATUS'] === FetchTransactionResponse::PROCESSED_STATUS;
        }

        return $this->createResponse($responseArray);
    }

    protected function createResponse($data)
    {
        return $this->response = new FetchTransactionResponse($this, $data);
    }

    public function parseResponse(string $response) : array
    {
        $result = array();
        $data = explode('&', urldecode($response));

        foreach ($data as $item) {
            $item = explode('=', urldecode($item));
            $result[$item[0]] = $item[1];
        }

        return $result;
    }
}
