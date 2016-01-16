<?php
namespace Taichi\CarbonBundle\Annotation;

use Doctrine\Common\Annotations\Reader;

class CarbonReader
{
    protected $reader;

    protected $annotationClass = \Taichi\CarbonBundle\Annotation\Carbon::class;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function reader($originalObject)
    {
        $convertedObject = new \stdClass;

        $reflectionObject = new \ReflectionObject($originalObject);

        foreach ($reflectionObject->getProperties() as $reflectionProperty) {
            // fetch the @StandardObject annotation from the annotation reader
            $annotation = $this->reader->getPropertyAnnotations($reflectionProperty);
            if (null !== $annotation) {
                $propertyName = $annotation->getPropertyName();

                // retrieve the value for the property, by making a call to the method
                $value = $reflectionMethod->invoke($originalObject);

                // try to convert the value to the requested type
                $type = $annotation->getDataType();
                if (false === settype($value, $type)) {
                    throw new \RuntimeException(sprintf('Could not convert value to type "%s"', $value));
                }

                $convertedObject->$propertyName = $value;
            }
        }

        return $convertedObject;
    }
}