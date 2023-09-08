<?php

namespace App\Http\Repositories;

use App\Models\CurriculumVitae;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;

class CurriculumVitaeRepository
{
    public function create(array $data)
    {
        return CurriculumVitae::create($data);
    }

    public function update($cv, $data)
    {
        $cv->update([
            'soft' => $data['soft'],
            'tech' => $data['tech'],
        ]);
    }

    public function destroy($cv)
    {
        return $cv->delete();
    }

    public function attachEducation(CurriculumVitae $cv, Education $education)
    {
        $cv->educations()->attach($education->id);
    }

    public function attachExperience(CurriculumVitae $cv, Experience $experience)
    {
        $cv->experiences()->attach($experience->id);
    }

    public function attachLanguage(CurriculumVitae $cv, Language $language)
    {
        $cv->languages()->attach($language->id);
    }

}
