<?php

namespace Prism\View;

interface View
{
    public function render(string $view): string;
}
