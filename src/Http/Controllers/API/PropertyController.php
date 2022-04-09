<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Property;
use App\Models\User;
use App\Http\Resources\PropertyResource as PropertyResource;

class PropertyController extends BaseController
{

    public function index()
    {
        $properties = Property::all();       
        return $this->sendResponse(PropertyResource::collection($properties), 'Property fetched.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        //FILL WILL ALL REQUIRED VALIDATORS
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $property = Property::create($input);
        return $this->sendResponse(new PropertyResource($property), 'Property created.');
    }

    public function show($id)
    {
        $property = Property::find($id);
        if (is_null($property)) {
            return $this->sendError('Property does not exist.');
        }
        return $this->sendResponse(new PropertyResource($property), 'Property fetched.');
    }

    public function update(Request $request, Property $property)
    {
        $input = $request->all();

        //FILL WILL ALL REQUIRED VALIDATORS
        $validator = Validator::make($input, [
            'id' => 'required'           
            //......
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $property = Property::find($input['id']);

        if (is_null($property)) {
            return $this->sendError('Property does not exist.');
        }
        
        //Using fill this methos works for PUT/PATCH
        $property->fill($input);
        $property->save();

        return $this->sendResponse(new PropertyResource($property), 'Property updated.');
    }

    public function destroy($id)
    {
        $property = Property::find($id);

        if (is_null($property)) {
            return $this->sendError('Property does not exist.');
        }

        $property->delete();
        
        return $this->sendResponse([], 'Property deleted.');
    }

    public function addUser($propertyId,$userId)
    {
        $property = Property::find($propertyId);
        $user = User::find($userId);
        
        if (is_null($property || is_null($userId))) {
            return $this->sendError('Property or User does not exist.');
        }

        //Check if the user has already added the property to favourites
        if($property->users->contains($userId)){
            return $this->sendError('User already added to favourites.');
        }
        
        //Notice that we are ussing the usetId
        $property->users()->attach($userId);
        return $this->sendResponse([], 'User added to property.');
    }

    public function removeUser($propertyId,$userId) {
        
        $property = Property::find($propertyId);
        $user = User::find($userId);
        
        //Check if property or user does not exist
        if (is_null($property || is_null($userId))) {
            return $this->sendError('Property or User does not exist.');
        }

        //Returning results from deteching the relationship
        // 0 -> Relationship does not exist
        // 1 -> Relationship exists
        $result = $property->users()->detach($userId);

        if (!$result) {
            return $this->sendError('User does not exist in property.');
        }

        return $this->sendResponse([], "User removed from property.");

    }
}
