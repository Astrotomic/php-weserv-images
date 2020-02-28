<?php

namespace Astrotomic\PhpWeservImages\Tests;

use Astrotomic\Weserv\Images\Url;
use PHPUnit\Framework\TestCase;

final class UrlTest extends TestCase
{
    /** @test */
    public function it_can_build_without_options(): void
    {
        $url = new Url('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.weserv.nl?url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string)$url);
    }
}
