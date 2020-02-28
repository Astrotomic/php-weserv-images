<?php

namespace Astrotomic\Weserv\Images;

use Astrotomic\Weserv\Images\Enums\Filter;
use Closure;

/**
 * @link https://images.weserv.nl/docs/quick-reference.html
 */
class Url
{
    protected const BASE_URL = 'https://images.weserv.nl';

    protected string $imageUrl;
    protected ?string $baseUrl;
    protected array $options = [];

    public function __construct(string $imageUrl, ?string $baseUrl = null)
    {
        $this->imageUrl = $imageUrl;
        $this->baseUrl = $baseUrl ?? self::BASE_URL;
    }

    public function __toString(): string
    {
        $query = http_build_query(array_merge($this->options, [
            'url' => $this->imageUrl,
        ]));

        return $this->baseUrl.'?'.$query;
    }

    /**
     * Width
     * Sets the width of the image, in pixels.
     * @link https://images.weserv.nl/docs/size.html#width
     * @param int $width
     * @return $this
     */
    public function w(int $width)
    {
        return $this->set('w', $width);
    }

    /**
     * Height
     * Sets the height of the image, in pixels.
     * @link https://images.weserv.nl/docs/size.html#height
     * @param int $height
     * @return $this
     */
    public function h(int $height)
    {
        return $this->set('h', $height);
    }

    /**
     * Device pixel ratio
     * Sets the output density of the image.
     * @link https://images.weserv.nl/docs/size.html#device-pixel-ratio
     * @param int $density
     * @return $this
     */
    public function dpr(int $density)
    {
        return $this->set('dpr', $density);
    }

    /**
     * Fit
     * Sets how the image is fitted to its target dimensions.
     * @link https://images.weserv.nl/docs/fit.html
     * @param string $fit
     * @return $this
     */
    public function fit(string $fit): self
    {
        return $this->set('fit', $fit);
    }

    /**
     * Contain background
     * Sets the background color when using &fit=contain.
     * @link https://images.weserv.nl/docs/fit.html#contain
     * @param string $color
     * @return $this
     */
    public function cbg(string $color): self
    {
        return $this->set('cbg', $color);
    }

    /**
     * Without enlargement
     * Do not enlarge the image.
     * @link https://images.weserv.nl/docs/fit.html#without-enlargement
     * @return $this
     */
    public function we(): self
    {
        return $this->set('we', true);
    }

    /**
     * Alignment position
     * Sets how the image is aligned.
     * @link https://images.weserv.nl/docs/crop.html#alignment-position
     * @param string $alignment
     * @return $this
     */
    public function align(string $alignment): self
    {
        return $this->set('a', $alignment);
    }

    /**
     * Rectangle crop
     * Crops the image to specific dimensions.
     * @link https://images.weserv.nl/docs/crop.html#rectangle-crop
     * @param int $x
     * @param int $y
     * @param int $w
     * @param int $h
     * @return Url
     */
    public function crop(int $x, int $y, int $w, int $h)
    {
        return $this
            ->set('cx', $x)
            ->set('cy', $y)
            ->set('cw', $w)
            ->set('ch', $h);
    }

    /**
     * Pre-resize crop
     * A pre-resize crop behaviour.
     * @link https://images.weserv.nl/docs/crop.html#rectangle-crop
     */
    public function precrop(): self
    {
        return $this->set('precrop', true);
    }

    /**
     * Trim
     * Trim "boring" pixels from all edges.
     * @link https://images.weserv.nl/docs/crop.html#trim
     * @param int $tolerance
     * @return $this
     */
    public function trim(int $tolerance = 10): self
    {
        return $this->set('trim', $tolerance);
    }

    /**
     * Masking
     * Sets the mask type from a predefined list.
     * @link https://images.weserv.nl/docs/mask.html#mask-type
     * @param string $mask
     * @return $this
     */
    public function mask(string $mask): self
    {
        return $this->set('mask', $mask);
    }

    /**
     * Mask trim
     * Removes the remaining whitespace from the mask.
     * @link https://images.weserv.nl/docs/mask.html#mask-trim
     * @return $this
     */
    public function mtrim(): self
    {
        return $this->set('mtrim', true);
    }

    /**
     * Mask background
     * Sets the background color of the mask.
     * @link https://images.weserv.nl/docs/mask.html#mask-background
     * @param string $color
     * @return $this
     */
    public function mbg(string $color): self
    {
        return $this->set('mbg', $color);
    }

    /**
     * Flip
     * Flip the image about the vertical Y axis.
     * @link https://images.weserv.nl/docs/orientation.html#flip
     * @return $this
     */
    public function flip(): self
    {
        return $this->set('flip', true);
    }

    /**
     * Flop
     * Flop the image about the horizontal X axis.
     * @link https://images.weserv.nl/docs/orientation.html#flop
     * @return $this
     */
    public function flop(): self
    {
        return $this->set('flop', true);
    }

    /**
     * Rotation
     * Rotates the image.
     * @link https://images.weserv.nl/docs/orientation.html#rotation
     * @param int $rotation
     * @return $this
     */
    public function ro(int $rotation): self
    {
        return $this->set('ro', $rotation);
    }

    /**
     * Rotation background
     * Sets the background color when rotating by arbitrary angles.
     * @link https://images.weserv.nl/docs/orientation.html#rotation
     * @param string $color
     * @return $this
     */
    public function rbg(string $color): self
    {
        return $this->set('rbg', $color);
    }

    /**
     * Background
     * Sets the background color of the image.
     * @link https://images.weserv.nl/docs/adjustment.html#background
     * @param string $color
     * @return $this
     */
    public function bg(string $color): self
    {
        return $this->set('bg', $color);
    }

    /**
     * Blur
     * Adds a blur effect to the image.
     * @link https://images.weserv.nl/docs/adjustment.html#blur
     * @param int $blur
     * @return $this
     */
    public function blur(int $blur): self
    {
        return $this->set('blur', $blur);
    }

    /**
     * Brightness
     * Adjusts the image brightness.
     * @link https://images.weserv.nl/docs/adjustment.html#brightness
     * @param int $brightness
     * @return $this
     */
    public function bri(int $brightness): self
    {
        return $this->set('bri', $brightness);
    }

    /**
     * Contrast
     * Adjusts the image contrast.
     * @link https://images.weserv.nl/docs/adjustment.html#contrast
     * @param int $contrast
     * @return $this
     */
    public function con(int $contrast): self
    {
        return $this->set('con', $contrast);
    }

    /**
     * Filter
     * Applies a filter effect to the image.
     * @link https://images.weserv.nl/docs/adjustment.html#filter
     * @param string $filter
     * @param string|null $startColor
     * @param string|null $stopColor
     * @return $this
     */
    public function filt(
        string $filter,
        ?string $startColor = null,
        ?string $stopColor = null
    ): self
    {
        return $this
            ->set('filt', $filter)
            ->when(
                $filter === Filter::DUOTONE,
                function (Url $url) use ($startColor, $stopColor): void {
                    $url
                        ->set('start', $startColor)
                        ->set('stop', $stopColor);
                });
    }

    /**
     * Gamma
     * Adjusts the image gamma.
     * @link https://images.weserv.nl/docs/adjustment.html#gamma
     * @param int $gamma
     * @return $this
     */
    public function gam(int $gamma): self
    {
        return $this->set('gam', $gamma);
    }

    /**
     * Sharpen
     * Sharpen the image.
     * @link https://images.weserv.nl/docs/adjustment.html#sharpen
     * @param int $sharpen
     * @return $this
     */
    public function sharp(int $sharpen): self
    {
        return $this->set('sharp', $sharpen);
    }

    /**
     * Sharpen flat areas
     * Sharpen the image.
     * @link https://images.weserv.nl/docs/adjustment.html#sharpen
     * @param int $sharpen
     * @return $this
     */
    public function sharpf(int $sharpen): self
    {
        return $this->set('sharpf', $sharpen);
    }

    /**
     * Sharpen jagged areas
     * Sharpen the image.
     * @link https://images.weserv.nl/docs/adjustment.html#sharpen
     * @param int $sharpen
     * @return $this
     */
    public function sharpj(int $sharpen): self
    {
        return $this->set('sharpj', $sharpen);
    }

    /**
     * Tint
     * Tint the image.
     * @link https://images.weserv.nl/docs/adjustment.html#tint
     * @param string $color
     * @return $this
     */
    public function tint(string $color): self
    {
        return $this->set('tint', $color);
    }

    /**
     * Adaptive filter
     * A filter algorithm that can be applied before compression.
     * @link https://images.weserv.nl/docs/format.html#adaptive-filter
     * @return $this
     */
    public function af(): self
    {
        return $this->set('af', true);
    }

    /**
     * Base64 (data URL)
     * Encodes the image to be used directly in the src= of the <img>-tag.
     * @link https://images.weserv.nl/docs/format.html#base64-data-url
     * @return $this
     */
    public function base64(): self
    {
        return $this->set('encoding', 'base64');
    }

    /**
     * Cache-Control
     * How long an image should be cached by the browser.
     * @link https://images.weserv.nl/docs/format.html#cache-control
     * @param string $maxAge
     * @return $this
     */
    public function maxage(string $maxAge): self
    {
        return $this->set('maxage', $maxAge);
    }

    /**
     * Compression level
     * The zlib compression level.
     * @link https://images.weserv.nl/docs/format.html#compression-level
     * @param int $compression
     * @return $this
     */
    public function l(int $compression): self
    {
        return $this->set('l', $compression);
    }

    /**
     * Default image
     * Redirects to a default image when there is a problem loading an image.
     * @link https://images.weserv.nl/docs/format.html#default-image
     * @param string $defaultImageUrl
     * @return $this
     */
    public function default(string $defaultImageUrl): self
    {
        return $this->set('default', $defaultImageUrl);
    }

    /**
     * Filename
     * To specify the filename.
     * @link https://images.weserv.nl/docs/format.html#filename
     * @param string $filename
     * @return $this
     */
    public function filename(string $filename): self
    {
        return $this->set('filename', $filename);
    }

    /**
     * Interlace / progressive
     * Adds interlacing to GIF and PNG. JPEG's become progressive.
     * @link https://images.weserv.nl/docs/format.html#interlace-progressive
     * @return $this
     */
    public function il(): self
    {
        return $this->set('il', true);
    }

    /**
     * Number of pages
     * To select the the number of pages to render.
     * @link https://images.weserv.nl/docs/format.html#number-of-pages
     * @param int $pages
     * @return $this
     */
    public function n(int $pages): self
    {
        return $this->set('n', $pages);
    }

    /**
     * Output
     * Encodes the image to a specific format.
     * @link https://images.weserv.nl/docs/format.html#output
     * @param string $format
     * @return $this
     */
    public function output(string $format): self
    {
        return $this->set('output', $format);
    }

    /**
     * Page
     * To load a given page.
     * @link https://images.weserv.nl/docs/format.html#page
     * @param int $page
     * @return $this
     */
    public function page(int $page): self
    {
        return $this->set('page', $page);
    }

    /**
     * Quality
     * Defines the quality of the image.
     * @link https://images.weserv.nl/docs/format.html#quality
     * @param int $quality
     * @return $this
     */
    public function q(int $quality): self
    {
        return $this->set('q', $quality);
    }

    public function when(bool $condition, Closure $callback): self
    {
        if ($condition) {
            $callback($this);
        }

        return $this;
    }

    protected function set(string $key, $value): self
    {
        $this->options[$key] = $value;

        return $this;
    }
}
