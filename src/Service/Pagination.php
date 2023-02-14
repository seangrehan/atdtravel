<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Pagination extends AbstractController
{
    public function paginate(int $current, int $max): array
    {
        $prev = $current === 1    ? 0 : $current - 1;
        $next = $current === $max ? 0 : $current + 1;
        $items = [1 => 1];
    
        if ($current === 1 && $max === 1) {
            return [
                'current' => $current,
                'prev'    => $prev,
                'next'    => $next,
                'items'   => $items,
            ];
        }

        if ($current > 4) {
            $items[$current - 3] = '…';
        }
    
        $padding = 2;
        $paddingLeft = $current - $padding;
        $paddingRight = $current + $padding;
    
        for ($i = $paddingLeft > 2 ? $paddingLeft : 2; $i <= min($max, $paddingRight); $i++) {
            $items[] = $i;
        }
    
        if ($paddingRight + 1 < $max) {
            $items[] = '…';
        }

        if ($paddingRight < $max) {
            $items[$max] = $max;
        }
    
        return [
            'current' => $current,
            'prev'    => $prev,
            'next'    => $next,
            'items'   => $items,
        ];
    }
}
