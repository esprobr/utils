<?php
namespace Espro\Utils;

/**
 * Classe criada para padronizar os retornos das models
 *
 * @author Wesley Sousa <wesley.sousa@espro.org.br>
 *
 */
class ModelResult {
    /**
     * @var mixed
     */
    protected $status;
    /**
     * @var mixed
     */
    protected $secondaryStatus;
    /**
     * @var mixed
     */
    protected $message;
    /**
     * @var mixed
     */
    protected $result;

    /**
     * @param mixed $_status
     * @param mixed $_message
     * @param mixed $_result
     * @param mixed $_secondaryStatus
     */
    public function __construct($_status = false, $_message = null, $_result = null, $_secondaryStatus = null) {
        self::setStatus($_status);
        self::setMessage($_message);
        self::setResult($_result);
        self::setSecondaryStatus( $_secondaryStatus );
    }

    public function setStatus($_status) {
        $this->status = $_status;
        return $this;
    }

    public function setStatusAndMessage($_status, $_message) {
        $this->status = $_status;
        $this->message= $_message;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setMessage($_message) {
        $this->message = $_message;
        return $this;
    }

    public function getMessage() {
        return $this->message;
    }

    /**
     * @param mixed $_result
     * @return ModelResult
     */
    public function setResult($_result) {
        $this->result = $_result;
        return $this;
    }

    public function getResult() {
        return $this->result;
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'result' => $this->result
        ];
    }

    public function statusIn(array $_statusList = [])
    {
        return in_array($this->status, $_statusList);
    }

    public function isStatus($_status)
    {
        return $this->status == $_status;
    }

    /**
     * @return mixed
     */
    public function getSecondaryStatus()
    {
        return $this->secondaryStatus;
    }

    /**
     * @param mixed $_secondaryStatus
     * @return $this
     */
    public function setSecondaryStatus($_secondaryStatus)
    {
        $this->secondaryStatus = $_secondaryStatus;
        return $this;
    }

    public function isSecondaryStatus($_status)
    {
        return $this->secondaryStatus == $_status;
    }

    public function secondaryStatusIn(array $_statusList = [])
    {
        return in_array($this->secondaryStatus, $_statusList);
    }
}