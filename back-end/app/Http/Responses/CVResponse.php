<?php

namespace App\Http\Responses;

class CVResponse
{
    public function CVResponse($curriculumVitae)
    {
        return [
            'id' => $curriculumVitae->id,
            'seeker' => $curriculumVitae->seeker_id,
            'personal_detail' => $curriculumVitae->personalDetail->toArray(),
            'social' => $curriculumVitae->social->toArray(),
            'skill' => [
                'soft' => $curriculumVitae->soft,
                'tech' => $curriculumVitae->tech,
                'languages' => $curriculumVitae->languages->map(function ($language) {
                    return [
                        'name' => $language->name,
                        'level' => $language->level,
                    ];
                }),
            ],
            'education' => $curriculumVitae->educations->toArray(),
            'experience' => $curriculumVitae->experiences->toArray(),
        ];
    }
}
