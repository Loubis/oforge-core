<?php

namespace Oforge\Engine\Modules\Core\Abstracts;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class AbstractModel
{

    /*
     * @param array $array
     * @param array $fillable optional property whitelist for mass-assignment
     *
     * @return ModelEntity
     */
    public function fromArray(array $array = [], array $fillable = [])
    {
        foreach ($array as $key => $value) {
            if (count($fillable) && !in_array($key, $fillable)) {
                continue;
            }
            $keys = explode("_", $key);
            $method = "set";
            foreach ($keys as $keyPart) {
                $method .= ucfirst($keyPart);
            }

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /*
     * @param array $array
     * @param array $fillable optional property whitelist for mass-assignment
     *
     * @return ModelEntity
     */
    public static function create(string $className, array $array = [], array $fillable = [])
    {
        $object = new $className;
        $object->fromArray($array, $fillable);
        return $object;
    }
}