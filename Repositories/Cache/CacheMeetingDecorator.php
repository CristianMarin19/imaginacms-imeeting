<?php

namespace Modules\Imeeting\Repositories\Cache;

use Modules\Imeeting\Repositories\MeetingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMeetingDecorator extends BaseCacheDecorator implements MeetingRepository
{
    public function __construct(MeetingRepository $meeting)
    {
        parent::__construct();
        $this->entityName = 'imeeting.meetings';
        $this->repository = $meeting;
    }
}
