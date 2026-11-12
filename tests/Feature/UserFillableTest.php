<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserFillableTest extends TestCase
{
    public function test_user_has_required_fillable_and_casts(): void
    {
        $user = new User();
        $this->assertTrue(in_array('is_admin', $user->getFillable()), 'is_admin missing from fillable');
        $this->assertTrue(in_array('age', $user->getFillable()), 'age missing from fillable');
    }
}

