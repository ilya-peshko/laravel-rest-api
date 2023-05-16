<?php

namespace App\Dto;

use BackedEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseDto
{
    public function toArrayForDataBase(BaseDto $dto, array $ignoreNullField = []): array
    {
        $fieldArray = get_object_vars($dto);

        return collect($fieldArray)->mapWithKeys(function ($value, $key) use ($ignoreNullField) {
            if ($value instanceof BackedEnum) {
                $value = $value->value;
            }

            if (in_array($key, $ignoreNullField)) {
                return [Str::snake($key) => $value];
            }

            if (!is_null($value)) {
                return [Str::snake($key) => $value];
            }

            return [];
        })->toArray();
    }

    public function toArray(BaseDto $dto): array
    {
        $fieldArray = get_object_vars($dto);

        return collect($fieldArray)->mapWithKeys(function ($value, $key) {
            if ($value instanceof BackedEnum) {
                $value = $value->value;
            }

            return [$key => $value];
        })->filter()->toArray();
    }

    public static function toCollection(BaseDto $dto): Collection
    {
        return collect(get_object_vars($dto));
    }
}
