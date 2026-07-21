<?php

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;

it('allows deleting a category without posts', function () {
    $user = User::factory()->create();
    $postCategory = PostCategory::factory()->create();

    expect($user->can('delete', $postCategory))->toBeTrue();
});

it('denies deleting a category that has posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    expect($user->can('delete', $post->category))->toBeFalse();
});
