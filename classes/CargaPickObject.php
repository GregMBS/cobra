<?php

namespace cobra_salsa;

class CargaPickObject
{
    /**
     * @var string
     */
    public $cliente;

    /**
     * @var array
     */
    public array $post;

    /**
     * @var string
     */
    public $fecha_de_actualizacion;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var array
     */
    public array $header;

    /**
     * @var array
     */
    public array $data;

    /**
     * @var int
     */
    public int $num;

    /**
     * @param string $cliente
     */
    public function setCliente(string $cliente): void
    {
        $this->cliente = $cliente;
    }

    /**
     * @param array $post
     */
    public function setPost(array $post): void
    {
        $this->post = $post;
    }

    /**
     * @param string $fecha_de_actualizacion
     */
    public function setFechaDeActualizacion(string $fecha_de_actualizacion): void
    {
        $this->fecha_de_actualizacion = $fecha_de_actualizacion;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param int $num
     */
    public function setNum(int $num): void
    {
        $this->num = $num;
    }

    /**
     * @return string
     */
    public function getCliente(): string
    {
        return $this->cliente;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @return string
     */
    public function getFechaDeActualizacion(): string
    {
        return $this->fecha_de_actualizacion;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

}