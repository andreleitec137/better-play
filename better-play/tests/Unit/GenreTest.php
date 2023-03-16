<?php

namespace Tests\BetterPlay\Unit;

use BetterPlay\Domain\Entity\Genre;
use Ramsey\Uuid\Uuid as RamseyUuid;

use Tests\TestCase;

class GenreTest extends TestCase
{
    public function test_Attributes()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $name = "New Genre";
        $description = "Description genre";
        $date = date('Y-m-d H:i:s');

        $genre = new Genre(
            id: $uuid,
            name: $name,
            description: $description,
            isActive: false,
            createdAt: $date
        );


        $this->assertEquals($uuid, $genre->id());
        $this->assertEquals($name, $genre->name);
        $this->assertEquals($description, $genre->description);
        $this->assertEquals(false, $genre->isActive);
        $this->assertEquals($date, $genre->createdAt());

        $genre->validate();
    }

    public function test_AttributesCreate()
    {
        $genre = new Genre(
            name: 'New Genre',
        );

        $this->assertNotEmpty($genre->id());
        $this->assertEquals('New Genre', $genre->name);
        $this->assertEquals(true, $genre->isActive);
        $this->assertNotEmpty($genre->createdAt());
    }

    public function test_Activated()
    {
        $name = "Genre";
        $genre = new Genre(
            name: $name,
            isActive: false,
        );

        $this->assertFalse($genre->isActive);
        $genre->activate();
        $this->assertTrue($genre->isActive);
    }

    public function test_Disabled()
    {

        $name = "Genre";
        $genre = new Genre(
            name: $name,
            isActive: true,
        );

        $this->assertTrue($genre->isActive);
        $genre->disable();
        $this->assertFalse($genre->isActive);
    }

    public function test_update_name_and_description()
    {
        $name = "test name";
        $description = "test description";
        $genre = new Genre(
            name: $name,
            description: $description
        );

        $this->assertEquals($name, $genre->name);
        $this->assertEquals($description, $genre->description);

        $newName = "name updated";
        $newDescription = "description updated";

        $genre->update(
            name: $newName,
            description: $newDescription
        );

        $this->assertEquals($newName, $genre->name);
        $this->assertEquals($newDescription, $genre->description);
    }

    public function test_update_only_name()
    {
        $name = "test name";
        $description = "test description";
        $genre = new Genre(
            name: $name,
            description: $description
        );

        $this->assertEquals($name, $genre->name);
        $this->assertEquals($description, $genre->description);

        $newName = "name updated";

        $genre->update(
            name: $newName,

        );

        $this->assertEquals($newName, $genre->name);
    }

    public function test_update_only_description()
    {
        $name = "test name";
        $description = "test description";
        $genre = new Genre(
            name: $name,
            description: $description
        );

        $this->assertEquals($name, $genre->name);
        $this->assertEquals($description, $genre->description);

        $newDescription = "description updated";

        $genre->update(
            description: $newDescription
        );

        $this->assertEquals($newDescription, $genre->description);
    }


    public function test_AddCategoryToGenre()
    {
        $categoryId = (string) RamseyUuid::uuid4();

        $genre = new Genre(
            name: 'new genre'
        );

        $this->assertIsArray($genre->categoriesId);
        $this->assertCount(0, $genre->categoriesId);

        $genre->addCategory(
            categoryId: $categoryId
        );
        $genre->addCategory(
            categoryId: $categoryId
        );
        $this->assertCount(2, $genre->categoriesId);
    }

    public function test_RemoveCategoryToGenre()
    {
        $categoryId = (string) RamseyUuid::uuid4();
        $categoryId2 = (string) RamseyUuid::uuid4();

        $genre = new Genre(
            name: 'new genre',
            categoriesId: [
                $categoryId,
                $categoryId2,
            ]
        );
        $this->assertCount(2, $genre->categoriesId);

        $genre->removeCategory(
            categoryId: $categoryId,
        );

        $this->assertCount(1, $genre->categoriesId);
        $this->assertEquals($categoryId2, $genre->categoriesId[1]);
    }
}
