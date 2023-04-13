<?php

namespace Tests\BetterPlay\Unit\Domain\Entity;

use BetterPlay\Domain\Entity\Category;
use BetterPlay\Domain\ValueObject\Uuid;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function test_Attributes()
    {
        $uuid = (string) Uuid::random();
        $name = "Category";
        $description = "Description category";
        $createAt = "2023-03-16 12:12:12";
        $category = new Category(
            id: $uuid,
            name: $name,
            description: $description,
            isActive: true,
            createdAt: $createAt,
        );


        $this->assertEquals($uuid, $category->id());
        $this->assertEquals($name, $category->name);
        $this->assertEquals($description, $category->description);
        $this->assertEquals(true, $category->isActive);

        $category->validate();
    }

    public function test_CreateCategoryWithoutId()
    {
        $name = "Category";
        $description = "Description category";
        $category = new Category(
            name: $name,
            description: $description,
            isActive: true
        );

        $this->assertNotEmpty($category->id());
        $this->assertEquals($name, $category->name);
        $this->assertEquals($description, $category->description);
        $this->assertEquals(true, $category->isActive);

        $category->validate();
    }

    public function test_Activated()
    {
        $name = "Category";
        $category = new Category(
            name: $name,
            isActive: false,
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function test_Disabled()
    {

        $name = "Category";
        $category = new Category(
            name: $name,
            isActive: true,
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }


    public function test_update_name_and_description()
    {
        $uuid = (string) Uuid::random();
        $name = "Category";
        $description = "Description category";
        $createAt = "2023-03-16 12:12:12";
        $category = new Category(
            id: $uuid,
            name: $name,
            description: $description,
            isActive: true,
            createdAt: $createAt,
        );

        $category->update(name: 'New category', description: 'new description');

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals("New category", $category->name);
        $this->assertEquals("new description", $category->description);
    }

    public function test_update_only_name()
    {
        $uuid = (string) Uuid::random();
        $name = "Category";
        $description = "Description category";
        $createAt = "2023-03-16 12:12:12";
        $category = new Category(
            id: $uuid,
            name: $name,
            description: $description,
            isActive: true,
            createdAt: $createAt,
        );

        $category->update(name: 'New category');

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals("New category", $category->name);
    }

    public function test_update_only_description()
    {
        $uuid = (string) Uuid::random();
        $name = "Category";
        $description = "Description category";
        $createAt = "2023-03-16 12:12:12";
        $category = new Category(
            id: $uuid,
            name: $name,
            description: $description,
            isActive: true,
            createdAt: $createAt,
        );

        $category->update(description: 'new description');

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals("new description", $category->description);
    }
}
