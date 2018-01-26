<?php
namespace App\Transformers;

use App\DoctorPrescription;
use League\Fractal\TransformerAbstract;


class ProjectTransformer extends TransformerAbstract
{
	public function transform(DoctorPrescription $doctorPrescription){
		return [
			'id' => (int) $doctorPrescription->id,
			'doctor_name' => $doctorPrescription['doctor']->first_name
		];
	}
}