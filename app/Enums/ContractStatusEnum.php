<?php

namespace App\Enums;

enum ContractStatusEnum: string
{
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
    case EXPIRED = 'expired';
}
