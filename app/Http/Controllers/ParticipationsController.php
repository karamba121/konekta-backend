<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipationStoreRequest;
use App\Http\Requests\ParticipationUpdateRequest;
use App\Models\Participation;
use App\Services\ParticipationServiceContract;
use Throwable;

class ParticipationsController extends Controller
{
    protected ParticipationServiceContract $service;

    public function __construct(ParticipationServiceContract $participationServiceContract)
    {
        $this->service = $participationServiceContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(
                $this->service->getAll(),
                200
            );
        } catch (Throwable $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                400,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ParticipationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipationStoreRequest $request)
    {
        try {
            $participation = $this->service->store($request->validated());

            return response()->json(
                [
                    'message' => 'Participação adicionada com sucesso.',
                    'resource' => $participation
                ],
                201
            );
        } catch (Throwable $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                400,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function show(Participation $participation)
    {
        try {
            return response()->json(
                [
                    'message' => 'success.',
                    'resource' => $participation
                ],
                200
            );
        } catch (Throwable $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                400,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ParticipationUpdateRequest  $request
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipationUpdateRequest $request, Participation $participation)
    {
        try {
            $participation = $this->service->update($request->validated(), $participation);

            return response()->json(
                [
                    'message' => 'Participação atualizada com sucesso.',
                    'resource' => $participation
                ],
                200
            );
        } catch (Throwable $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                400,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participation $participation)
    {
        try {
            $this->service->delete($participation);

            return response()->json(
                [
                    'message' => 'Participação deletada com sucesso.',
                ],
                200
            );
        } catch (Throwable $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                400,
            );
        }
    }
}
