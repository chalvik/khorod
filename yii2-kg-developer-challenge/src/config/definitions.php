<?php

use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\OrderRepository;
use KGorod\DeveloperChallenge\Repositories\OrderItemRepository;

return [
    OrderRepositoryInterface::class => OrderRepository::class,
    OrderItemRepositoryInterface::class => OrderItemRepository::class,
];