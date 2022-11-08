<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\ExecutionFinished;
use App\Http\Resources\ProgramResource;
use App\Models\Execution;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ExecutionService
{
    public function createExecution(FormRequest $request): Execution
    {
        $data = $request->validated();

        return Execution::create($data);
    }

    public function updateExecution(
        FormRequest $request,
        Execution $execution
    ): Execution {
        $data = $request->validated();
        $execution->update($data);

        return $execution;
    }

    public function finishExecution(Execution $execution): Execution
    {
        $execution->finished = Carbon::now();
        $execution->save();

        ExecutionFinished::dispatch($execution);

        return $execution;
    }

    public function takeProgramSnapshot(Execution $execution): Execution
    {
        $execution->program_execution_content = (new ProgramResource(
            $execution->program()->with('modules.topics')->first()
        ))
            ->resolve();
        $execution->save();
        return $execution;
    }
}
