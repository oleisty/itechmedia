<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use DateTime;

/**
 * View Helper for rendering time elapsed from datetime.
 */
class TimeElapsed extends AbstractHelper 
{
    private $datetime;
    
    /**
     * Builder - sets datetime
     * @param string $dateTimeFormat
     * @return \Application\View\Helper\TimeElapsed
     */
    public function setDatetime(string $dateTimeFormat): TimeElapsed
    {
        $this->datetime = $dateTimeFormat;
        return $this;
    }
    
    /**
     * Returns time elapsed as string
     * @return string
     */
    public function getTimeElapsed(): string
    {
        $now = new DateTime('now');
        $ago = new DateTime($this->datetime);
        $diff = $ago->diff($now);
        if (!empty($diff->y)) {
            $age = $diff->y . 'year';
            $age = $age . ($diff->y > 1 ? 's' : '');
        } elseif ($diff->m > 0) {
            $age = $diff->m . 'month';
            $age = $age . ($diff->m > 1 ? 's' : '');
        } elseif ($diff->d > 0) {
            $age = $diff->d . 'day';
            $age = $age . ($diff->d > 1 ? 's' : '');
        } elseif ($diff->h > 0) {
            $age = $diff->h . 'hour';
            $age = $age . ($diff->h > 1 ? 's' : '');
        } elseif ($diff->i > 0) {
            $age = $diff->i . 'minute';
            $age = $age . ($diff->i > 1 ? 's' : '');
        } else {
            $age = $diff->s . 'second';
            $age = $age . ($diff->s > 1 ? 's' : '');
        }
        $ageWithPostfix = $age . ' ago';
        return $ageWithPostfix;
    }
}