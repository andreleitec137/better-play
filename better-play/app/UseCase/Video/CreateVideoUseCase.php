<?php

namespace BetterPlay\UseCase\Video;

use BetterPlay\Domain\Entity\Video;
use BetterPlay\Domain\Repository\VideoRepositoryInterface;
use BetterPlay\UseCase\DTO\Video\CreateVideo\VideoCreateInputDTO;
use BetterPlay\UseCase\DTO\Video\CreateVideo\VideoCreateOutputDTO;

class CreateVideoUseCase
{

    protected $repository;


    public function __construct(VideoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(VideoCreateInputDTO $input): VideoCreateOutputDTO
    {

        $Video = new Video(
            title: $input->title,
            description: $input->description,
            yearLaunched: $input->yearLaunched,
            duration: $input->duration,
            rating: $input->rating,
            censure: $input->censure,
            thumbFile: $input->thumbFile,
            thumbHalf: $input->thumbHalf,
            bannerFile: $input->bannerFile,
            trailerFile: $input->trailerFile,
            videoFile: $input->videoFile
        );

        $newVideo = $this->repository->insert($Video);

        return new VideoCreateOutputDTO(
            id: $newVideo->id(),
            title: $newVideo->title,
            description: $newVideo->description,
            yearLaunched: $newVideo->yearLaunched,
            duration: $newVideo->duration,
            rating: $newVideo->rating,
            censure: $newVideo->censure,
            thumbFile: $newVideo->thumbFile,
            thumbHalf: $newVideo->thumbHalf,
            bannerFile: $newVideo->bannerFile,
            trailerFile: $newVideo->trailerFile,
            videoFile: $newVideo->videoFile,
            createdAt: $newVideo->createdAt(),
            published: $newVideo->published,
            opened: $newVideo->opened
        );
    }
}
