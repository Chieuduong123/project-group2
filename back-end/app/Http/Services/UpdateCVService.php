<?php

namespace App\Http\Services;

use App\Http\Repositories\CurriculumVitaeRepository;
use App\Http\Repositories\EducationRepository;
use App\Http\Repositories\ExperienceRepository;
use App\Http\Repositories\LanguageRepository;
use App\Http\Repositories\PersonalDetailRepository;
use App\Http\Repositories\SocialRepository;

class UpdateCVService
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

    public function updateCV($cv, $data)
    {

        $cv->experiences()->delete();
        $cv->educations()->delete();
        $cv->languages()->delete();

        $this->personalDetailRepository->update($cv->personalDetail, $data);

        $this->socialRepository->update($cv->social, $data);

        $this->cvRepository->update($cv, $data);

        foreach ($data['education'] as $educationData) {
            $education = $this->educationRepository->create($educationData);
            $cv->educations()->sync([$education->id], false);
        }

        foreach ($data['experience'] as $experienceData) {
            $experience = $this->experienceRepository->create($experienceData);
            $cv->experiences()->sync([$experience->id], false);
        }

        foreach ($data['languages'] as $languageData) {
            $language = $this->languageRepository->create($languageData);
            $cv->languages()->sync([$language->id], false);
        }

        return $cv;
    }
}
