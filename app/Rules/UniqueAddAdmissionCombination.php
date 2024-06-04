<?php

namespace App\Rules;

use App\Models\AdmissionDate;
use Illuminate\Contracts\Validation\Rule;

class UniqueAddAdmissionCombination implements Rule
{

    protected $detailProgramId;
    protected $sessionAdmission;
    protected $year;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($detailProgramId, $sessionAdmission, $year)
    {
        $this->detailProgramId = $detailProgramId;
        $this->sessionAdmission = $sessionAdmission;
        $this->year = $year;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !AdmissionDate::where('detail_program_id', $this->detailProgramId)
            ->where('session_admission', $this->sessionAdmission)
            ->where('year', $this->year)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Le programme, l'admission à la session et de l'année est déjà enregistrée.");
    }
}
