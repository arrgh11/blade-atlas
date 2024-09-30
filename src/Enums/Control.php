<?php

namespace Arrgh11\Atlas\Enums;

enum Control: string
{
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case SELECT = 'select';
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case FILE = 'file';
    case TOGGLE = 'toggle';

    public function getView(): string
    {
        return match ($this) {
            self::TEXT => 'atlas::support.controls.input',
            self::TEXTAREA => 'atlas::support.controls.textarea',
            self::SELECT => 'atlas::support.controls.select',
            self::CHECKBOX => 'atlas::support.controls.checkbox',
            self::RADIO => 'atlas::support.controls.radio',
            self::FILE => 'atlas::support.controls.file',
            self::TOGGLE => 'atlas::support.controls.toggle',
        };
    }
}
