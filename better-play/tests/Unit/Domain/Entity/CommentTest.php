<?php

namespace Tests\BetterPlay\Unit\Domain\Entity;

use BetterPlay\Domain\Entity\Comment;
use BetterPlay\Domain\Entity\Genre;
use Ramsey\Uuid\Uuid as RamseyUuid;

use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_Attributes()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $description = "Description comment";
        $date = date('Y-m-d H:i:s');

        $comment = new Comment(
            id: $uuid,
            description: $description,
            isActive: false,
            createdAt: $date
        );


        $this->assertEquals($uuid, $comment->id());
        $this->assertEquals($description, $comment->description);
        $this->assertEquals(false, $comment->isActive);
        $this->assertEquals($date, $comment->createdAt());
    }

    public function test_Activated()
    {
        $description = "Description comment";
        $comment = new Comment(
            description: $description,
            isActive: false
        );


        $this->assertFalse($comment->isActive);
        $comment->activate();
        $this->assertTrue($comment->isActive);
    }


    public function test_Disabled()
    {

        $description = "Description comment";
        $comment = new Comment(
            description: $description,
            isActive: true
        );

        $this->assertTrue($comment->isActive);
        $comment->disable();
        $this->assertFalse($comment->isActive);
    }
}
