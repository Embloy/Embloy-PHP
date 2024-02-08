<?php

namespace Embloy;

class EmbloySession {
    public $mode;
    public $job_slug;
    public $success_url;
    public $cancel_url;

    public function __construct($mode, $job_slug, $options = []) {
        $this->mode = $mode;
        $this->job_slug = $job_slug;
        $this->success_url = $options['success_url'] ?? null;
        $this->cancel_url = $options['cancel_url'] ?? null;
    }
}