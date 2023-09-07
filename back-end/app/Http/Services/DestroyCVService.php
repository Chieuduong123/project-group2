<?php

namespace App\Http\Services;

use App\Http\Repositories\CurriculumVitaeRepository;
use App\Http\Repositories\EducationRepository;
use App\Http\Repositories\ExperienceRepository;
use App\Http\Repositories\LanguageRepository;
use App\Http\Repositories\PersonalDetailRepository;
use App\Http\Repositories\SocialRepository;

class DestroyCVService
{
    private $cvRepository;
    private $personalDetailRepository;
    private $socialRepository;
    private $educationRepository;
    private $experienceRepository;
    private $languageRepository;

    public function __construct(
        CurriculumVitaeRepository $cvRepository,
        PersonalDetailRepository $personalDetailRepository,
        SocialRepository $socialRepository,
        EducationRepository $educationRepository,
        ExperienceRepository $experienceRepository,
        LanguageRepository $languageRepository
    ) {
        $this->cvRepository = $cvRepository;
        $this->personalDetailRepository = $personalDetailRepository;
        $this->socialRepository = $socialRepository;
        $this->educationRepository = $educationRepository;
        $this->experienceRepository = $experienceRepository;
        $this->languageRepository = $languageRepository;
    }

    public function destroyCV($cv, $data)
    {
        $this->personalDetailRepository->destroy($cv->personalDetail);

        $this->socialRepository->destroy($cv->social);

        $this->cvRepository->destroy($cv);

        foreach ($data['education'] as $educationData) {
            $this->cvRepository->detachEducation($cv, $educationData);
        }

        foreach ($data['experience'] as $experienceData) {
            $this->cvRepository->detachExperience($cv, $experienceData);
        }

        foreach ($data['languages'] as $languageData) {
            $this->cvRepository->detachLanguage($cv, $languageData);
        }

        return $cv;
    }
}
