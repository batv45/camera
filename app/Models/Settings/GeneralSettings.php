<?php

namespace App\Models\Settings;

class GeneralSettings extends \Spatie\LaravelSettings\Settings
{

    public ?string $camera_dir;

    public static function group(): string
    {
        return 'general';
    }
}
