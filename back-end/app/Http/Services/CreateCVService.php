<?php

namespace App\Http\Services;

use App\Http\Repositories\CurriculumVitaeRepository;
use App\Http\Repositories\EducationRepository;
use App\Http\Repositories\ExperienceRepository;
use App\Http\Repositories\LanguageRepository;
use App\Http\Repositories\PersonalDetailRepository;
use App\Http\Repositories\SocialRepository;

class CreateCVService
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

    public function createCV(array $data)
    {
        $seeker = auth()->user();
        $personalDetail = $this->personalDetailRepository->create($data);

        $social = $this->socialRepository->create($data);

        $cvData = [
            'seeker_id' => $seeker->id,
            'personal_detail_id' => $personalDetail->id,
            'social_id' => $social->id,
            'soft' => $data['soft'],
            'tech' => $data['tech'],
        ];
        $cv = $this->cvRepository->create($cvData);

        if (!empty($data['education'])) {
            foreach ($data['education'] as $educationData) {
                $education = $this->educationRepository->create($educationData);
                $this->cvRepository->attachEducation($cv, $education);
            }
        }

        if (!empty($data['experience'])) {
            foreach ($data['experience'] as $experienceData) {
                $experience = $this->experienceRepository->create($experienceData);
                $this->cvRepository->attachExperience($cv, $experience);
            }
        }

        foreach ($data['languages'] as $languageData) {
            $language = $this->languageRepository->create($languageData);
            $this->cvRepository->attachLanguage($cv, $language);
        }
        return $cv;
    }
}
