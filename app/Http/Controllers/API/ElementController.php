<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Http\Resources\SeatResource;
use App\Interfaces\SeatRepositoryInterface;
use App\Http\Requests\StoreElementRequest;
use App\Http\Requests\UpdateElementRequest;
use App\Http\Resources\ElementResource;
use App\Interfaces\ElementConfigRepositoryInterface;
use App\Interfaces\ElementRepositoryInterface;
use App\Models\Element;
use Illuminate\Support\Facades\DB;

class ElementController extends Controller
{
    private ElementRepositoryInterface $elementRepositoryInterface;
    private ElementConfigRepositoryInterface $elementConfigRepositoryInterface;

    private SeatRepositoryInterface $seatRepositoryInterface;

    public function __construct(ElementRepositoryInterface $elementRepositoryInterface, ElementConfigRepositoryInterface $elementConfigRepositoryInterface, GuestRepositoryInterface $guestRepositoryInterface, ElementTypeRepository $elementTypeRepository, SeatRepositoryInterface $seatRepositoryInterface)
    {
        $this->elementRepositoryInterface = $elementRepositoryInterface;
        $this->elementConfigRepositoryInterface = $elementConfigRepositoryInterface;
        $this->seatRepositoryInterface = $seatRepositoryInterface;
    }

    public function index()
    {
        $data = $this->elementRepositoryInterface->index();

        return ApiResponseClass::sendResponse(ElementResource::collection($data),'',200);
    }

    /**
     * @OA\Get(
     *     path="/api/element/ballroom/{ballroom_id}",
     *     summary="Show all elements in particular stage/ballroom",
     *     tags={"Elements"},
     *     @OA\Parameter(
     *          name="ballroomId",
     *          in="path",
     *          description="ID of ballroom",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          example=1
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="List of all elements in the stage/ballroom",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Main Hall"),
     *                 @OA\Property(property="index", type="string", example="A1"),
     *                 @OA\Property(property="focus", type="string", example="center"),
     *                 @OA\Property(property="icon", type="string", example="stage-icon.png"),
     *                 @OA\Property(property="ballroom_id", type="string", example="ballroom-456"),
     *                 @OA\Property(property="x", type="number", example=150.5),
     *                 @OA\Property(property="y", type="number", example=200.75),
     *                 @OA\Property(property="color", type="string", example="#FF5733"),
     *                 @OA\Property(property="kind", type="string", example="chair"),
     *                 @OA\Property(property="spacing", type="number", example=10),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(
     *                     property="config",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="type", type="string", example="table"),
     *                         @OA\Property(property="seats", type="integer", example=8),
     *                         @OA\Property(property="radius", type="number", example=50.5),
     *                         @OA\Property(property="width", type="number", example=120),
     *                         @OA\Property(property="height", type="number", example=80),
     *                         @OA\Property(property="size", type="number", example=100),
     *                         @OA\Property(property="angle", type="number", example=45),
     *                         @OA\Property(property="angle_origin_x", type="number", example=0),
     *                         @OA\Property(property="angle_origin_y", type="number", example=0),
     *                         @OA\Property(property="arms_width", type="number", example=45),
     *                         @OA\Property(property="bottom_height", type="number", example=45),
     *                         @OA\Property(property="top_height", type="number", example=45),
     *                         @OA\Property(property="bottom_width", type="number", example=45),
     *                     )
     *                 ),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-30T10:30:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-30T15:45:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     )
     * )
     */
    public function getBallroomElements($ballroomId): \Illuminate\Http\JsonResponse
    {

        $elements = $this->elementRepositoryInterface->getByBallroomId($ballroomId);
        return ApiResponseClass::sendResponse(ElementResource::collection($elements),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/element",
     *     summary="Create element",
     *     tags={"Elements"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass element and it's config values",
     *         @OA\JsonContent(
     *             required={"name", "ballroom_id", "x", "y", "kind"},
     *             @OA\Property(property="name", type="string", example="Main Hall"),
     *             @OA\Property(property="index", type="string", example="A1"),
     *             @OA\Property(property="focus", type="string", example="center"),
     *             @OA\Property(property="icon", type="string", example="stage-icon.png"),
     *             @OA\Property(property="ballroom_id", type="string", example="ballroom-456"),
     *             @OA\Property(property="x", type="number", example=150.5),
     *             @OA\Property(property="y", type="number", example=200.75),
     *             @OA\Property(property="color", type="string", example="#FF5733"),
     *             @OA\Property(property="kind", type="string", example="chair"),
     *             @OA\Property(property="spacing", type="number", example=10),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(
     *                 property="config",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="type", type="string", example="table"),
     *                     @OA\Property(property="seats", type="integer", example=8),
     *                     @OA\Property(property="radius", type="number", example=50.5),
     *                     @OA\Property(property="width", type="number", example=120),
     *                     @OA\Property(property="height", type="number", example=80),
     *                     @OA\Property(property="size", type="number", example=100),
     *                     @OA\Property(property="angle", type="number", example=45),
     *                     @OA\Property(property="angle_origin_x", type="number", example=0),
     *                     @OA\Property(property="angle_origin_y", type="number", example=0),
     *                     @OA\Property(property="arms_width", type="number", example=45),
     *                     @OA\Property(property="bottom_height", type="number", example=45),
     *                     @OA\Property(property="top_height", type="number", example=45),
     *                     @OA\Property(property="bottom_width", type="number", example=45),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Element created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Main Hall"),
     *             @OA\Property(property="ballroom_id", type="string", example="ballroom-456"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-30T10:30:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-30T10:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreElementRequest $request)
    {
        $details =[
            'name' => $request->name,
            'type' => $request->type,
            'ballroom_id' => $request->ballroom_id,
            'x' => $request->x,
            'y' => $request->y,
            'color' => $request->color,
            'kind' => $request->kind,
            'spacing' => $request->spacing,
            'status' => 'active',
            'index' => $request->index,
            'focus' => $request->focus,
            'icon'  => $request->icon,
        ];

        $config = $request->config;

        DB::beginTransaction();
        try{

            $element = $this->elementRepositoryInterface->store($details);
            $config['element_id'] = $element->id;

            $elementConfig = $this->elementConfigRepositoryInterface->store($config);

            $element->config = $elementConfig;

            DB::commit();
            return ApiResponseClass::sendResponse(new ElementResource($element),'Element Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }


    public function show($id)
    {
        $element = $this->elementRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse($element->toArray(),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Element $element)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/element/{elementId}",
     *     summary="Update specific element",
     *     tags={"Elements"},
     *     @OA\Parameter(
     *         name="elementId",
     *         in="path",
     *         description="ID of the element to update",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         example=1
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass element and it's config values",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Main Hall"),
     *             @OA\Property(property="type", type="string", example="table"),
     *             @OA\Property(property="index", type="string", example="A1"),
     *             @OA\Property(property="focus", type="string", example="center"),
     *             @OA\Property(property="icon", type="string", example="stage-icon.png"),
     *             @OA\Property(property="ballroom_id", type="string", example="ballroom-456"),
     *             @OA\Property(property="x", type="number", example=150.5),
     *             @OA\Property(property="y", type="number", example=200.75),
     *             @OA\Property(property="color", type="string", example="#FF5733"),
     *             @OA\Property(property="kind", type="string", example="chair"),
     *             @OA\Property(property="spacing", type="number", example=10),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(
     *                 property="config",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="seats", type="integer", example=8),
     *                     @OA\Property(property="radius", type="number", example=50.5),
     *                     @OA\Property(property="width", type="number", example=120),
     *                     @OA\Property(property="height", type="number", example=80),
     *                     @OA\Property(property="size", type="number", example=100),
     *                     @OA\Property(property="angle", type="number", example=45),
     *                     @OA\Property(property="angle_origin_x", type="number", example=0),
     *                     @OA\Property(property="angle_origin_y", type="number", example=0),
     *                     @OA\Property(property="arms_width", type="number", example=45),
     *                     @OA\Property(property="bottom_height", type="number", example=45),
     *                     @OA\Property(property="top_height", type="number", example=45),
     *                     @OA\Property(property="bottom_width", type="number", example=45),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Element updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Main Hall"),
     *             @OA\Property(property="ballroom_id", type="string", example="ballroom-456"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-30T10:30:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-30T15:45:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Element not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(UpdateElementRequest $request, $id)
    {
        $details =[
            'name' => $request->name,
            'ballroom_id' => $request->ballroom_id,
            'x' => $request->x,
            'y' => $request->y,
            'color' => $request->color,
            'kind' => $request->kind,
            'spacing' => $request->spacing,
            'status' => $request->status,
            'index' => $request->index,
            'focus' => $request->focus,
            'icon'  => $request->icon
        ];


        DB::beginTransaction();
        try{
            $element = $this->elementRepositoryInterface->update($details,$id);
            $elementConfig = $this->elementConfigRepositoryInterface->update($request->config,$id);

            DB::commit();
            return ApiResponseClass::sendResponse('Element Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/seat/{elementId}",
     *     summary="Assign seat to specific element and guest",
     *     tags={"Seats"},
     *     @OA\Parameter(
     *         name="elementId",
     *         in="path",
     *         description="ID of the element",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="1"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"guest_id", "index", "ballroom_id"},
     *              @OA\Property(
     *                  property="guest_id",
     *                  type="string",
     *                  description="Guest who seat on this chair",
     *                  example="1"
     *              ),
     *              @OA\Property(property="index", type="integer", example="1"),
     *              @OA\Property(property="ballroom_id", type="integer", example="1"),
     *              @OA\Property(property="label", type="string", example="1"),
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Guest note added",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Guest not found"
     *     )
     * )
     */
    public function assignElementAndGuestToSeat(UpdateSeatRequest  $request, $seatId): ?\Illuminate\Http\JsonResponse
    {

        $details =[
            'element_id' => $request->element_id,
            'guest_id' => $request->guest_id,
            'index'  => $request->index,
            'label' => $request->label,
            'ballroom_id' => $request->ballroom_id,
        ];

        DB::beginTransaction();
        try{
            $seat = $this->seatRepositoryInterface->assignGuestToSeat($details, $seatId);

            DB::commit();
            return ApiResponseClass::sendResponse('Guest assign to seat successful','',201);

        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

    }

    public function createSeat(StoreSeatRequest  $request): ?\Illuminate\Http\JsonResponse
    {

        $details =[
            'element_id' => $request->element_id,
            'guest_id' => $request->guest_id,
            'index'  => $request->index,
            'label' => $request->label,
            'ballroom_id' => $request->ballroom_id,
        ];

        DB::beginTransaction();
        try{
            $seat = $this->seatRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new SeatResource($seat),'Seat Create Successful',201);

        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

    }

    /**
     * @OA\Delete (
     *     path="/api/seat/{elementId}/{index}",
     *     summary="Release seat",
     *     tags={"Seats"},
     *     @OA\Parameter(
     *         name="elementId",
     *         in="path",
     *         description="ID of the element",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         example="1"
     *     ),
     *     @OA\Parameter(
     *          name="index",
     *          in="path",
     *          description="Index of seat",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          example="1"
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Guest note added",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Guest not found"
     *     )
     * )
     */
    public function releaseSeat($seatId): ?\Illuminate\Http\JsonResponse
    {
        try{
            $this->seatRepositoryInterface->releaseSeat($seatId);

            DB::commit();
        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

        return ApiResponseClass::sendResponse('Seat has been deleted Successful','',204);
    }

    public function releaseSeatsByElement($elementId): ?\Illuminate\Http\JsonResponse
    {
        try{
            $this->seatRepositoryInterface->releaseSeatsByElement($elementId);

            DB::commit();
        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

        return ApiResponseClass::sendResponse('Seat has been deleted Successful','',204);
    }

    public function releaseSeatsByBallroom($ballroomId): ?\Illuminate\Http\JsonResponse
    {
        try{
            $this->seatRepositoryInterface->releaseSeatsByBallroom($ballroomId);

            DB::commit();
        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

        return ApiResponseClass::sendResponse('Seat has been deleted Successful','',204);
    }

    /**
     * @OA\Get(
     *     path="element/{elementId}/getSeats/",
     *     summary="Show all seats for particular table",
     *     tags={"Seats"},
     *     @OA\Parameter(
     *          name="elementId",
     *          in="path",
     *          description="ID of ballroom",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          example=1
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="List of all seats for particular table in the stage/ballroom",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="index", type="integer", example="1"),
     *                 @OA\Property(property="label", type="string", example="A1"),
     *                 @OA\Property(property="element_id", type="integer", example=12),
     *                 @OA\Property(property="ballroom_id", type="integer", example=1),
     *                 @OA\Property(property="guest_id", type="integer", example=12),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-30T10:30:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-30T15:45:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     )
     * )
     */
    public function getElementSeats($elementId)
    {
        $data = $this->seatRepositoryInterface->getByElementId($elementId);

        return ApiResponseClass::sendResponse(SeatResource::collection($data),'',200);
    }

    /**
     * @OA\Get(
     *     path="ballroom/{ballroomId}/getSeats/",
     *     summary="Show all seats for particular ballroom",
     *     tags={"Seats"},
     *     @OA\Parameter(
     *          name="ballroomId",
     *          in="path",
     *          description="ID of ballroom",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          example=1
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="List of all seats for particular table in the stage/ballroom",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="index", type="integer", example="1"),
     *                 @OA\Property(property="label", type="string", example="A1"),
     *                 @OA\Property(property="element_id", type="integer", example=12),
     *                 @OA\Property(property="ballroom_id", type="integer", example=1),
     *                 @OA\Property(property="guest_id", type="integer", example=12),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-30T10:30:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-30T15:45:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     )
     * )
     */
    public function getBallroomSeats($ballroomId)
    {
        $data = $this->seatRepositoryInterface->getByBallroomId($ballroomId);

        return ApiResponseClass::sendResponse(SeatResource::collection($data),'',200);
    }

    /**
     * @OA\Delete(
     *     path="/api/element/{elementId}",
     *     summary="Delete specific element with it's config",
     *     tags={"Elements"},
     *     @OA\Parameter(
     *         name="elementId",
     *         in="path",
     *         description="ID of the element to delete",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Element deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Element deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Element not found"
     *     )
     * )
     */
    public function destroy($id)
    {

        //remove element from each guest
        try{
            $this->elementConfigRepositoryInterface->deleteByElementId($id);
            $this->elementRepositoryInterface->delete($id);

            DB::commit();
        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

        return ApiResponseClass::sendResponse('Element Delete Successful','',204);
    }


}

