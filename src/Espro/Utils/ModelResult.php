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
    protected $primaryStatus;
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
     * @param mixed $_primaryStatus
     * @param mixed $_message
     * @param mixed $_result
     * @param mixed $_secondaryStatus
     */
    public function __construct( $_primaryStatus = false, $_message = null, $_result = null, $_secondaryStatus = null ) {
        self::setStatus($_primaryStatus);
        self::setMessage($_message);
        self::setResult($_result);
        self::setSecondaryStatus( $_secondaryStatus );
    }

    public function setStatus($_primaryStatus) {
        $this->primaryStatus = $_primaryStatus;
        return $this;
    }

    public function setStatusAndMessage($_primaryStatus, $_message) {
        $this->primaryStatus = $_primaryStatus;
        $this->message= $_message;
        return $this;
    }

    public function getStatus() {
        return $this->primaryStatus;
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
            'status' => $this->primaryStatus,
            'message' => $this->message,
            'result' => $this->result,
            'secondaryStatus' => $this->secondaryStatus
        ];
    }

    public function statusIn(array $_statusList = [])
    {
        return in_array($this->primaryStatus, $_statusList);
    }

    public function isStatus($_status)
    {
        return $this->primaryStatus == $_status;
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

    public function setStatuses( $_primaryStatus, $_secondaryStatus )
    {
        $this->primaryStatus = $_primaryStatus;
        $this->secondaryStatus = $_secondaryStatus;
        return $this;
    }
}