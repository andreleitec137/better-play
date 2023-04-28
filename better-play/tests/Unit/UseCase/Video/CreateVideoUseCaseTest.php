<?php

namespace Tests\BetterPlay\Unit\UseCase\Video;


use BetterPlay\Domain\Entity\Video as EntityVideo;
use BetterPlay\Domain\Enum\Censure;
use BetterPlay\Domain\Enum\MediaStatus;
use BetterPlay\Domain\Enum\VideoType;
use BetterPlay\Domain\Repository\VideoRepositoryInterface;
use BetterPlay\Domain\ValueObject\Image;
use BetterPlay\Domain\ValueObject\Media;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\Video\CreateVideoUseCase;
use BetterPlay\UseCase\DTO\Video\CreateVideo\{VideoCreateInputDTO, VideoCreateOutputDTO};
use Mockery;
use Mockery\MockInterface;
use stdClass;
use Tests\TestCase;

class CreateVideoUseCaseTest extends TestCase
{

    public function test_CreateNewVideo()
    {
        $uuid = (string) Uuid::random();
        $VideoOpenned = false;
        $VideoPublished = false;
        $VideoCreatedAt = date('Y-m-d H:i:s');

        $VideoTitle = 'Vídeo de uma porta';
        $VideoDescription = 'Isso é um video de uma porta';
        $VideoYearLaunched = 2023;
        $VideoDuration = 100;
        $VideoRating = 5;
        $VideoCensure = Censure::L;
        $VideoThumbFile = new Image('/caminho-para-a-thum');
        $VideoThumbHalf = new Image('/caminho-para-a-thumb-half');
        $VideoBannerFile = new Image('/caminho-para-a-banner');
        $VideoTrailerFile = new Media('/caminho-para-o-trailer', MediaStatus::COMPLETE, 'encodado');
        $VideoFile = new Media('/caminho-para-o-video', MediaStatus::PROCESSING, 'encodado');

        /** @var MockInterface $mockEntity */
        $mockEntity = Mockery::mock(EntityVideo::class, [$uuid,
        $VideoTitle ,$VideoDescription, $VideoYearLaunched, $VideoDuration ,  $VideoOpenned, $VideoRating ,  $VideoCensure, $VideoPublished,
        $VideoCreatedAt, $VideoThumbFile, $VideoThumbHalf,  $VideoBannerFile , $VideoTrailerFile, $VideoFile ]);

        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));
        $mockEntity->shouldReceive('openned')->andReturn(false);
        $mockEntity->shouldReceive('published')->andReturn(false);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        /** @var MockInterface $mockRepository */
        $mockRepository = Mockery::mock(stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')->andReturn($mockEntity);


        /** @var MockInterface $mockInputDTO */
        $mockInputDto = Mockery::mock(VideoCreateInputDTO::class, [$VideoTitle ,$VideoDescription, $VideoYearLaunched, $VideoDuration ,
        $VideoRating , $VideoCensure, $VideoThumbFile, $VideoThumbHalf,
        $VideoBannerFile , $VideoTrailerFile, $VideoFile]);

        /** @var VideoRepositoryInterface $mockRepository  */
        $useCase = new CreateVideoUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(VideoCreateOutputDTO::class, $responseUseCase);
        $this->assertNotEmpty($responseUseCase->id);
        $this->assertEquals($VideoTitle, $responseUseCase->title);
        $this->assertEquals($VideoDescription, $responseUseCase->description);
        $this->assertEquals($VideoYearLaunched, $responseUseCase->yearLaunched);
        $this->assertEquals($VideoDuration, $responseUseCase->duration);
        $this->assertEquals($VideoRating, $responseUseCase->rating);
        $this->assertEquals($VideoCensure, $responseUseCase->censure);
        $this->assertEquals($VideoThumbFile, $responseUseCase->thumbFile);
        $this->assertEquals($VideoThumbHalf, $responseUseCase->thumbHalf);
        $this->assertEquals($VideoBannerFile, $responseUseCase->bannerFile);
        $this->assertEquals($VideoTrailerFile, $responseUseCase->trailerFile);
        $this->assertEquals($VideoFile, $responseUseCase->videoFile);


        /** @var MockInterface $spy */
        $spy = Mockery::spy(stdClass::class, VideoRepositoryInterface::class);
        $spy->shouldReceive('insert')->andReturn($mockEntity);

        /** @var VideoRepositoryInterface $spy  */
        $useCase = new CreateVideoUseCase($spy);
        $responseUseCase = $useCase->execute($mockInputDto);

        /** @var MockInterface $spy  */
        $spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
