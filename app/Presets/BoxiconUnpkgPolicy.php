<?php

namespace App\Presets;;

use Spatie\Csp\Directive;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

class BoxiconUnpkgPolicy implements Preset
{
    /**
     * Configure csp policies for general and other policy
     *
     * @return void
     */
    public function configure(Policy $policy): void
    {
        $policy
            ->add([Directive::FONT], 'cdn.jsdelivr.net/npm/boxicons@2.1.4/')
            ->add([Directive::CONNECT], 'unpkg.com/boxicons@2.1.4/svg/');
    }
}
