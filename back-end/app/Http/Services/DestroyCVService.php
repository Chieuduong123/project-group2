<?php

namespace App\Http\Services;


class DestroyCVService
{
    public function destroyCV($cv)
    {
        $cv->educations()->detach();

        $cv->experiences()->detach();

        $cv->languages()->detach();

        $cv->social->delete();

        $cv->personalDetail->delete();

        $cv->delete();

        return true;
    }
}
