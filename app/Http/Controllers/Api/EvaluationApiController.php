<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EvaluationServices;
use App\Http\Requests\EvaluationRequest;
use App\Http\Resources\EvaluationResource;

class EvaluationApiController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationServices $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(EvaluationRequest $request)
    {
        $evaluation = $this->evaluationService->newEvaluationOrder($request->identify,$request->only('stars','comment'));
        return new EvaluationResource($evaluation);
    }
}
