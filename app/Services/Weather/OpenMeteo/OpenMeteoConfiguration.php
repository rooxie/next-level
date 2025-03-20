<?php

namespace App\Services\Weather\OpenMeteo;

class OpenMeteoConfiguration
{
    /**
     * @param string $key
     * @param string $url
     * @param int $timeout
     */
    public function __construct(
        protected(set) string $key,
        protected(set) string $url,
        protected(set) int $timeout,
    ) {
        $this->key = trim($this->key);
        $this->url = trim(rtrim($this->url, '/'));
        $this->timeout = $this->timeout > 0 ? $this->timeout : 5;
    }
}
