<?php

namespace Aenginus\Page;

trait PageHelper
{
    public function shouldShow($page)
    {
        if (isAdminById(auth()->id())) {
            return true;
        }
        if ($page->configuration && $page->configuration->config['display'] == 'true') {
            return true;
        }
        return false;
    }
}
