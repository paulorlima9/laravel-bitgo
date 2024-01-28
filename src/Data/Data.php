<?php

namespace PauloRLima9\LaravelBitgo\Data;

abstract class Data
{
    /**
     * Converte dados de array para objeto
     */
    public static function fromArray(array $payload): static
    {
        $dataClass = static::class;
        $dto = new $dataClass();
        foreach ($payload as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }

    /**
     * Converte objeto de dados para array
     */
    public function toArray(): array
    {
        $arr = (array) $this;
        array_walk_recursive($arr, function (&$item) {
            if (is_object($item)) {
                $item->toArray();
                $item = (array) $item;
            }
        });

        return $arr;
    }
}
