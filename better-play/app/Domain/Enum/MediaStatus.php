<?php

namespace BetterPlay\Domain\Enum;

enum MediaStatus: int
{
    case PROCESSING = 0;
    case PENDING = 1;
    case COMPLETE = 2;
}
