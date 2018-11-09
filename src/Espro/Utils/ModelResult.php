<?php
namespace Espro\Utils;

/**
 * Classe criada para padronizar os retornos das models
 *
 * @author Wesley Sousa <wesley.sousa@espro.org.br>
 *
 */
class ModelResult {
    protected $status;
    protected $message;
    protected $result;

    /**
     * @param mixed $_status
     * @param mixed $_message
     * @param mixed $_result
     */
    public function __construct($_status = false, $_message = null, $_result = null) {
        self::setStatus($_status);
        self::setMessage($_message);
        self::setResult($_result);
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
}