<?php

namespace Tests\Unit\Helpers;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

class TestHelpers extends TestCase
{
    /**
     * @covers ::me()
     */
    public function testMe()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $me = me();

        $this->assertInstanceOf(Authenticatable::class, $me);
        $this->assertInstanceOf(User::class, $me);
        $this->assertSame($user, $me);
    }
}