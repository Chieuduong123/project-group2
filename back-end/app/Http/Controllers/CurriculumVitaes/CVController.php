<?php

namespace App\Http\Controllers\CurriculumVitaes;

use App\Http\Controllers\Controller;
use App\Models\CurriculumVitae;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\PersonalDetail;
use App\Models\Social;
use Illuminate\Http\Request;

class CVController extends Controller
{

    public function getCV()
    {
        try {
            $seeker = auth()->user();
            $curriculumVitaes = CurriculumVitae::where('seeker_id', $seeker->id)
                ->with(['personalDetail', 'social', 'educations', 'experiences', 'languages'])
                ->get();
            return response()->json($curriculumVitaes, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching job posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $seeker = auth()->user();

            $personalDetail = new PersonalDetail();
            $personalDetail->fill($request->only([
                'first_name', 'last_name', 'job_title', 'location', 'email', 'phone', 'about_me'
            ]));
            $personalDetail->save();

            $social = new Social();
            $social->fill($request->only([
                'github', 'instagram', 'facebook', 'linkendin', 'telegram', 'twitter', 'web'
            ]));
            $social->save();

            $curriculumVitae = new CurriculumVitae();
            $curriculumVitae->fill([
                'seeker_id' => $seeker->id,
                'personal_detail_id' => $personalDetail->id,
                'social_id' => $social->id,
                'soft' => $request->input('soft'),
                'tech' => $request->input('tech'),
            ]);
            $curriculumVitae->save();

            $educationDataArray = $request->input('education');
            if (!empty($educationDataArray)) {
                $educations = [];
                foreach ($educationDataArray as $educationData) {
                    $educations[] = [
                        'from_date' => $educationData['from_date'],
                        'to_date' => $educationData['to_date'],
                        'location' => $educationData['location'],
                        'title' => $educationData['title'],
                        'summary' => $educationData['summary'],
                    ];
                }

                $curriculumVitae->educations()->createMany($educations);
            }

            $experienceDataArray = $request->input('experience');
            if (!empty($experienceDataArray)) {
                $experiences = [];
                foreach ($experienceDataArray as $experienceData) {
                    $experiences[] = [
                        'from_date' => $experienceData['from_date'],
                        'to_date' => $experienceData['to_date'],
                        'location' => $experienceData['location'],
                        'title' => $experienceData['title'],
                        'summary' => $experienceData['summary'],
                    ];
                }

                $curriculumVitae->experiences()->createMany($experiences);
            }

            $languageDataArray = $request->input('languages');
            if (!empty($languageDataArray)) {
                $languages = [];
                foreach ($languageDataArray as $languageData) {
                    $languages[] = [
                        'name' => $languageData['name'],
                        'level' => $languageData['level'],
                    ];
                }
                $curriculumVitae->languages()->createMany($languages);
            }

            $response = [
                'CV' => [
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
                    'education' => $request->input('education', []),
                    'experience' => $request->input('experience', []),
                ],
            ];
            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $cvId)
    {
        try {

            $seeker = auth()->user();
            $curriculumVitae = CurriculumVitae::findOrFail($cvId);

            if ($curriculumVitae->seeker_id !== $seeker->id) {
                return response()->json([
                    'message' => 'You are not authorized to update this CV'
                ], 403);
            }

            $personalDetail = $curriculumVitae->personalDetail;

            $personalDetail->fill($request->only([
                'first_name', 'last_name', 'job_title', 'location', 'email', 'phone', 'about_me'
            ]));
            $personalDetail->save();

            $social = $curriculumVitae->social;
            $social->fill($request->only([
                'github', 'instagram', 'facebook', 'linkedin', 'telegram', 'twitter', 'web'
            ]));
            $social->save();

            $curriculumVitae->fill([
                'seeker_id' => $seeker->id,
                'soft' => $request->input('soft'),
                'tech' => $request->input('tech'),
            ]);
            $curriculumVitae->save();

            if ($request->has('education') && is_array($request->input('education'))) {
                $educationDataArray = $request->input('education');
                $curriculumVitae->educations()->delete();

                foreach ($educationDataArray as $educationData) {
                    $education = new Education([
                        'from_date' => $educationData['from_date'],
                        'to_date' => $educationData['to_date'],
                        'location' => $educationData['location'],
                        'title' => $educationData['title'],
                        'summary' => $educationData['summary'],
                    ]);
                    $curriculumVitae->educations()->save($education);
                }
            }

            if ($request->has('experience') && is_array($request->input('experience'))) {
                $experienceDataArray = $request->input('experience');
                $curriculumVitae->experiences()->delete();

                foreach ($experienceDataArray as $experienceData) {
                    $experience = new Experience([
                        'from_date' => $experienceData['from_date'],
                        'to_date' => $experienceData['to_date'],
                        'location' => $experienceData['location'],
                        'title' => $experienceData['title'],
                        'summary' => $experienceData['summary'],
                    ]);
                    $curriculumVitae->experiences()->save($experience)->first();
                }
            }

            if ($request->has('languages') && is_array($request->input('languages'))) {
                $languagesDataArray = $request->input('languages');
                $curriculumVitae->languages()->delete();

                foreach ($languagesDataArray as $languageData) {
                    $language = new Language([
                        'name' => $languageData['name'],
                        'level' => $languageData['level'],
                    ]);
                    $curriculumVitae->languages()->save($language);
                }
            }

            $response = [
                'CV' => [
                    'seeker' => $curriculumVitae->seeker->name,
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
                    'education' => $request->input('education', []),
                    'experience' => $request->input('experience', []),
                ],
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($cvId)
    {
    }
}
