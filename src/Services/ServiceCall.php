<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Leonardo\Arbory\Soap\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceCall
 * @package Leonardo\Arbory\Soap\Services
 * @property string $request_body
 * @property string $response_body
 * @property string $request_headers
 * @property string $response_headers
 * @property string $status
 * @property string $environment
 * @property string $method
 * @property string $path
 * @property string $created_at
 */
class ServiceCall extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'request_body',
        'response_body',
        'request_headers',
        'response_headers',
        'status',
        'environment',
        'method',
        'path',
    ];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s : %s/%s', $this->created_at, $this->path, $this->method);
    }
}