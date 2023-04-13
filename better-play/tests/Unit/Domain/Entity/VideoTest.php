<?php

namespace Tests\BetterPlay\Unit\Domain\Entity;

use BetterPlay\Domain\Entity\Video;
use BetterPlay\Domain\Enum\Censure;
use BetterPlay\Domain\Enum\MediaStatus;
use BetterPlay\Domain\ValueObject\Image;
use BetterPlay\Domain\ValueObject\Media;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;
use Tests\TestCase;

class VideoTest extends TestCase
{

    public function test_Attributes()
    {
        $uuid = (string) Uuid::random();
        $title = "New Video";
        $description = "Description video";
        $date = date('Y-m-d H:i:s');

        $video = new Video(
            id: $uuid,
            title: $title,
            description: $description,
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            published: true,
            createdAt: $date
        );


        $this->assertEquals($uuid, $video->id());
        $this->assertEquals($title, $video->title);
        $this->assertEquals($description, $video->description);
        $this->assertEquals(2029, $video->yearLaunched);
        $this->assertEquals(12, $video->duration);
        $this->assertEquals(true, $video->opened);
        $this->assertEquals(true, $video->published);
        $this->assertEquals($date, $video->createdAt());
    }

    public function test_AttributesCreateIdAndCreateAt()
    {
        $title = "New Video";
        $description = "Description video";

        $video = new Video(
            title: $title,
            description: $description,

        );

        $this->assertNotEmpty($video->id());
        $this->assertEquals('New Video', $video->title);
        $this->assertNotEmpty($video->createdAt());
    }


    public function test_UpdateVideo()
    {
        $uuid = (string) Uuid::random();
        $title = "New Video";
        $description = "Description video";
        $date = date('Y-m-d H:i:s');

        $video = new Video(
            id: $uuid,
            title: $title,
            description: $description,
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            published: true,
            createdAt: $date
        );

        $video->update(
            title: 'Change title',
            description: 'Change description',
            yearLaunched: 2030,
            duration: 12,
            opened: false,
            rating: 4,
            censure: Censure::CENSURE18,
            published: false
        );

        $this->assertEquals('Change title', $video->title);
        $this->assertEquals('Change description', $video->description);
    }

    public function testAddCategoryId()
    {
        $categoryId = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );

        $this->assertCount(0, $entity->categoriesId);
        $entity->addCategoryId(
            categoryId: $categoryId,
        );
        $entity->addCategoryId(
            categoryId: $categoryId,
        );
        $this->assertCount(2, $entity->categoriesId);
    }

    public function testRemoveCategoryId()
    {
        $categoryId = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
            censure: Censure::L,
        );
        $entity->addCategoryId(
            categoryId: $categoryId,
        );
        $entity->addCategoryId(
            categoryId: 'uuid',
        );
        $this->assertCount(2, $entity->categoriesId);

        $entity->removeCategoryId(
            categoryId: $categoryId,
        );
        $this->assertCount(1, $entity->categoriesId);
    }


    public function testAddGenre()
    {
        $genreId = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );

        $this->assertCount(0, $entity->genresId);
        $entity->addGenreId(
            genreId: $genreId,
        );
        $entity->addGenreId(
            genreId: $genreId,
        );
        $this->assertCount(2, $entity->genresId);
    }

    public function testRemoveGenre()
    {
        $genreId = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );
        $entity->addGenreId(
            genreId: $genreId,
        );
        $entity->addGenreId(
            genreId: 'uuid',
        );
        $this->assertCount(2, $entity->genresId);

        $entity->removeGenreId(
            genreId: $genreId,
        );
        $this->assertCount(1, $entity->genresId);
    }

    public function testAddCastMember()
    {
        $castMemberId = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );

        $this->assertCount(0, $entity->castMemberIds);
        $entity->addCastMemberId(
            castMemberId: $castMemberId,
        );
        $entity->addCastMemberId(
            castMemberId: $castMemberId,
        );
        $this->assertCount(2, $entity->castMemberIds);
    }

    public function testRemoveCastMember()
    {
        $castMemberId = (string) Uuid::random();
        $castMemberId2 = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );
        $entity->addCastMemberId(
            castMemberId: $castMemberId,
        );
        $entity->addCastMemberId(
            castMemberId: $castMemberId2,
        );
        $this->assertCount(2, $entity->castMemberIds);

        $entity->removeCastMemberId(
            castMemberId: $castMemberId,
        );
        $this->assertCount(1, $entity->castMemberIds);
    }

    public function test_AddComments()
    {
        $commentId = (string) Uuid::random();
        $commentId2 = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );

        $this->assertCount(0, $entity->categoriesId);
        $entity->addCommentId(
            commentId: $commentId,
        );
        $entity->addCommentId(
            commentId: $commentId2,
        );
        $this->assertCount(2, $entity->commentsId);
    }

    public function test_RemoveComments()
    {
        $commentId = (string) Uuid::random();
        $commentId2 = (string) Uuid::random();

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 4,
        );
        $entity->addCommentId(
            commentId: $commentId,
        );
        $entity->addCommentId(
            commentId: $commentId2,
        );
        $this->assertCount(2, $entity->commentsId);

        $entity->removeCommentId(
            commentId: $commentId,
        );
        $this->assertCount(1, $entity->commentsId);
    }

    public function testValueObjectImage()
    {
        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            censure: Censure::L,
            thumbFile: new Image('teste-path/image.png'),
        );

        $this->assertNotNull($entity->thumbFile());
        $this->assertInstanceOf(Image::class, $entity->thumbFile());
        $this->assertEquals('teste-path/image.png', $entity->thumbFile()->filePath);
    }

    public function testValueObjectImageToThumbHalf()
    {
        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            censure: Censure::L,
            thumbHalf: new Image('teste-path/image.png'),
        );

        $this->assertNotNull($entity->thumbHalf());
        $this->assertInstanceOf(Image::class, $entity->thumbHalf());
        $this->assertEquals('teste-path/image.png', $entity->thumbHalf()->filePath);
    }

    public function testValueObjectImageToBannerFile()
    {
        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            censure: Censure::L,
            bannerFile: new Image('teste-path/banner.png'),
        );

        $this->assertNotNull($entity->bannerFile());
        $this->assertInstanceOf(Image::class, $entity->bannerFile());
        $this->assertEquals('teste-path/banner.png', $entity->bannerFile()->filePath);
    }

    public function testValueObjectMediaTrailer()
    {
        $trailerFile = new Media(
            filePath: 'path/trailer.mp4',
            mediaStatus: MediaStatus::PENDING,
            encodedPath: 'path/encoded.extension',
        );

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            censure: Censure::L,
            trailerFile: $trailerFile,
        );

        $this->assertNotNull($entity->trailerFile());
        $this->assertInstanceOf(Media::class, $entity->trailerFile());
        $this->assertEquals('path/trailer.mp4', $entity->trailerFile()->filePath);
    }

    public function testValueObjectMediaVideo()
    {
        $videoFile = new Media(
            filePath: 'path/video.mp4',
            mediaStatus: MediaStatus::COMPLETE,
        );

        $entity = new Video(
            title: 'new title',
            description: 'description',
            yearLaunched: 2029,
            duration: 12,
            opened: true,
            rating: 5,
            censure: Censure::L,
            videoFile: $videoFile,
        );

        $this->assertNotNull($entity->videoFile());
        $this->assertInstanceOf(Media::class, $entity->videoFile());
        $this->assertEquals('path/video.mp4', $entity->videoFile()->filePath);
    }
}
