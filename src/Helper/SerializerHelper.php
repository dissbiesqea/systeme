<?php

namespace App\Helper;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerHelper
{
    public static function arraySerializer(): Serializer
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ArrayDenormalizer(), new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }

    public static function objectToXmlSerializer(): Serializer
    {
        $encoders = [new XmlEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}
