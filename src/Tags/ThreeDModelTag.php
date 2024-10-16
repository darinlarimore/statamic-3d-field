<?php

namespace Darinlarimore\Statamic3dField\Tags;

use Statamic\Tags\Tags;

class ThreeDModelTag extends Tags
{

    protected static $handle = '3d_model';

    public static function render(...$arguments): string
    {
        return '';
    }

    public function index()
    {
        try {
            $field = $this->params->get('field') ?? null;
            $class = $this->params->get('class') ?? null;

            if (!$field) {
                return '';
            }

            $data = $this->context->get($field)->value();

            if (!$data) {
                return '';
            }

            return view('three-d-model::tags.index', [
                'data' => $data,
                'class' => $class,
            ])->render();
        } catch (\Exception $e) {
            return '';
        }
    }
}
