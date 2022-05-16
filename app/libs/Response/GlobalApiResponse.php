<?php

namespace App\libs\Response;

use App\libs\ErrorBook;

/**
 * Class ApiResponse
 *
 * generate Standard Response for Rest api
 *
 * @package App\libs\Response
 */
class GlobalApiResponse implements \JsonSerializable
{
    /**
     * @var string
     */
    private $outcome = 'SUCCESS';
    /**
     * @var int
     */
    private $outcomeCode = 200;
    /**
     * @var string
     */
    private $message = '';
    /**
     * @var int
     */
    private $numOfRecords = 0;
    /**
     * @var \stdClass
     */
    private $records;
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param string $outcome
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    }

    /**
     * @return int
     */
    public function getOutcomeCode()
    {
        return $this->outcomeCode;
    }

    /**
     * @param int $outcomeCode
     */
    public function setOutcomeCode($outcomeCode)
    {
        $this->outcomeCode = $outcomeCode;
    }

    /**
     * @return int
     */
    public function getNumOfRecords()
    {
        return $this->numOfRecords;
    }

    /**
     * @param int $numOfRecords
     */
    public function setNumOfRecords($numOfRecords)
    {
        $this->numOfRecords = $numOfRecords;
    }

    /**
     * @return array|\stdClass
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * @param array|\stdClass $records
     */
    public function setRecords($records)
    {
        $this->records = $records;
    }

    /**
     * @param $outcome
     * @param $outcomeCode
     * @param $message
     * @param int $numOfRecords
     * @param array $records
     * @param array $errors
     * @return $this
     */
    private function setResponse($outcome, $outcomeCode, $message, $numOfRecords = 0, $records = [], $errors = [])
    {

        $this->outcome = $outcome;
        $this->outcomeCode = $outcomeCode;
        $this->message = $message;
        $this->numOfRecords = $numOfRecords;
        $this->records = $records ?: new \stdClass();
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param string $message
     * @param int $numOfRecords
     * @param array $records
     * @return $this
     */
    public function success($message = '', $numOfRecords = 0, $records = [])
    {
        $this->setResponse(
            GlobalApiResponseCodeBook::SUCCESS['outcome'],
            GlobalApiResponseCodeBook::SUCCESS['outcomeCode'],
            $message,
            $numOfRecords,
            $records ?: new \stdClass(),
            []
        );
        return $this;
    }

    public function profileCompleted($message = '', $numOfRecords = 0, $records = [])
    {
        $this->setResponse(
            GlobalApiResponseCodeBook::PROFILE_COMPLETED['outcome'],
            GlobalApiResponseCodeBook::PROFILE_COMPLETED['outcomeCode'],
            $message,
            $numOfRecords,
            $records ?: new \stdClass(),
            []
        );
        return $this;
    }

    /**
     * @param array $outcomeArray example ['outcome'=>'','outcomeCode'=>'']
     * @param $message
     * @param array $errors
     * @return $this
     */
    public function error(array $outcomeArray, $message, $errors = [])
    {
        $this->setResponse(
            $outcomeArray['outcome'],
            $outcomeArray['outcomeCode'],
            $message,
            0,
            new \stdClass(),
            $errors
        );
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            '_metadata' => [
                'outcome' => $this->outcome,
                'outcomeCode' => $this->outcomeCode,
                'numOfRecords' => $this->numOfRecords,
                'message' => $this->message,
            ],
            'records' => $this->records ?: new \stdClass(),
            'errors' => $this->errors,
        ];
    }

    public
    function isSuccess()
    {
        return $this->outcomeCode == ErrorBook::API_SUCCESS;
    }
}
