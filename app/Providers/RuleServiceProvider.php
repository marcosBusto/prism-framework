<?php

namespace App\Providers;

use Prism\Providers\ServiceProvider;
use Prism\Validation\Rule;

class RuleServiceProvider implements ServiceProvider {
    public function registerServices() {
        Rule::loadDefaultRules();
    }
}