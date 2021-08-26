<?php

namespace Modules\Imeeting\Repositories\Cache;

use Modules\Imeeting\Repositories\ProviderRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProviderDecorator extends BaseCacheDecorator implements ProviderRepository
{
    public function __construct(ProviderRepository $provider)
    {
        parent::__construct();
        $this->entityName = 'imeeting.providers';
        $this->repository = $provider;
    }
}
