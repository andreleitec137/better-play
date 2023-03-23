<?php

namespace Tests\BetterPlay\Unit\Domain\Entity;

use BetterPlay\Domain\Entity\CastMember;
use BetterPlay\Domain\Enum\CastMemberType;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Tests\TestCase;

class CastMemberTest extends TestCase
{

    public function testAttributes()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $date = date('Y-m-d H:i:s');
        $castMember = new CastMember(
            id: $uuid,
            name: 'Name',
            type: CastMemberType::ACTOR,
            createdAt: $date
        );

        $this->assertEquals($uuid, $castMember->id());
        $this->assertEquals('Name', $castMember->name);
        $this->assertEquals(CastMemberType::ACTOR, $castMember->type);
        $this->assertNotEmpty($castMember->createdAt());
    }

    public function testAttributesNewEntity()
    {
        $castMember = new CastMember(
            name: 'Name',
            type: CastMemberType::DIRECTOR,
        );

        $this->assertNotEmpty($castMember->id());
        $this->assertEquals('Name', $castMember->name);
        $this->assertEquals(CastMemberType::DIRECTOR, $castMember->type);
        $this->assertNotEmpty($castMember->createdAt());
    }

    public function testUpdate()
    {
        $castMember = new CastMember(
            name: 'Name',
            type: CastMemberType::DIRECTOR,
        );

        $this->assertEquals('Name', $castMember->name);

        $castMember->update(
            name: 'new name',
            type: CastMemberType::ACTOR,
        );

        $this->assertEquals('new name', $castMember->name);
        $this->assertEquals(CastMemberType::ACTOR, $castMember->type);
    }
}
