<?php

namespace App\Http\Controllers\CurriculumVitaes;

use App\Http\Controllers\Controller;
use App\Models\CurriculumVitae;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function store(Request $request)
    {
        try {
            $seeker = auth()->user();
            $curriculumVitaes = new CurriculumVitae();
            $curriculumVitaes->fill([
                $curriculumVitaes->seeker_id = $seeker->id,
                $curriculumVitaes->link_website = $request->input('link_website'),
                $curriculumVitaes->introduce = $request->input('introduce'),
                $curriculumVitaes->work_experience = $request->input('work_experience'),
                $curriculumVitaes->education = $request->input('education'),
                $curriculumVitaes->skill = $request->input('skill'),
                $curriculumVitaes->position_apply = $request->input('position_apply'),
                $curriculumVitaes->activities = $request->input('activities'),
                $curriculumVitaes->certificates = $request->input('certificates'),
                $curriculumVitaes->project = $request->input('project'),
            ]);
            $curriculumVitaes->save();
            return response()->json([
                'message' => 'Job post created successfully',
                'curriculumVitae' => $curriculumVitaes
            ], 201);
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
                return response()->json(['message' => 'You are not authorized to update this CV'], 403);
            }

            $curriculumVitae->fill([
                $curriculumVitae->link_website = $request->input('link_website'),
                $curriculumVitae->introduce = $request->input('introduce'),
                $curriculumVitae->work_experience = $request->input('work_experience'),
                $curriculumVitae->education = $request->input('education'),
                $curriculumVitae->skill = $request->input('skill'),
                $curriculumVitae->position_apply = $request->input('position_apply'),
                $curriculumVitae->activities = $request->input('activities'),
                $curriculumVitae->certificates = $request->input('certificates'),
                $curriculumVitae->project = $request->input('project'),
            ]);
            $curriculumVitae->update();

            return response()->json([
                'message' => 'CV updated successfully',
                'curriculumVitae' => $curriculumVitae
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($cvId)
    {
        try {
            $seeker = auth()->user();
            $curriculumVitae = CurriculumVitae::findOrFail($cvId);

            if ($curriculumVitae->seeker_id !== $seeker->id) {
                return response()->json([
                    'message' => 'You are not authorized to delete this CV'
                ], 403);
            }
            $curriculumVitae->delete();

            return response()->json([
                'message' => 'CV deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
