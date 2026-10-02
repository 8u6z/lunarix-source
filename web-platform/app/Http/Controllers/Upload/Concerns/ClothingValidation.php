<?php
namespace App\Http\Controllers\Upload\Concerns;

trait ClothingValidation
{
    private const TEMPLATE_WIDTH = 585;
    private const TEMPLATE_HEIGHT = 559;
    protected function clothingTemplateError(string $path): ?string
    {
        $info = @getimagesize($path);

        if ($info === false) {
            return 'File is not a valid image.';
        }
        [$width, $height] = $info;
        if ($width !== self::TEMPLATE_WIDTH || $height !== self::TEMPLATE_HEIGHT) {
            return sprintf('Template image must be exactly %dx%d pixels.', self::TEMPLATE_WIDTH, self::TEMPLATE_HEIGHT);
        }
        return null;
    }
}