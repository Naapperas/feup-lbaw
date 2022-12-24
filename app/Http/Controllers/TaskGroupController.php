<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TaskGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskGroupController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project) {
        $requestData = $request->all();

        $this->taskGroupCreationValidator($requestData)->validate();
        
        $this->authorize('create', [TaskGroup::class, $project]);

        $taskGroup = $this->createTaskGroup($requestData);

        return $request->wantsJson()
            ? new JsonResponse([$taskGroup], 201)
            : redirect()->route('project', ['project' => $project]);
    }

    public function createTaskGroup(array $data) {

        $taskGroup = new TaskGroup();

        $taskGroup->name = $data['name'];
        $taskGroup->description = $data['description'] ?? '';
        $taskGroup->project_id = $data['project_id'];
        $taskGroup->position = (TaskGroup::where('project_id', $taskGroup->project_id)->max('position') ?? 0) + 1;
        $taskGroup->save();

        return $taskGroup;
    }

    /**
     * Get a validator for an incoming project creation request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function taskGroupCreationValidator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|min:4|max:255',
            'description' => 'string|min:6|max:512',
            'project_id' => 'required|integer'
        ]);
    }

    public function update(Request $request, TaskGroup $taskGroup) {

        $requestData = $request->all();

        $this->taskGroupUpdateValidator($requestData)->validate();

        $this->authorize('edit', $taskGroup->project);
        $this->authorize('update', $taskGroup);

        $taskGroup = $this->updateTaskGroup($taskGroup, $requestData);

        return new JsonResponse($taskGroup, 200);
    }

    protected function taskGroupUpdateValidator(array $data) {
        return Validator::make($data, [
            'position' => 'integer|min:0',
        ]);
    }

    public function updateTaskGroup(TaskGroup $taskGroup, array $data) {

        if (($data['position'] ??= null) !== null)
            $taskGroup->position = $data['position'];

        $taskGroup->save();
        return $taskGroup;
    }

    public function delete(Request $request, TaskGroup $taskGroup) {

        //$this->authorize('delete', $task);
        $taskGroup->delete();

        return $taskGroup;
    }
}