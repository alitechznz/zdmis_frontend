<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function show($id)
    {
        $country = Country::find($id);
        if ($country) {
            return response()->json($country);
        } else {
            return response()->json(['message' => 'Country not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'status' => 'required|string',
            'currency' => 'required|string|max:50',
            'currency_symbol' => 'required|string|max:10',
        ]);

        if ($id) {
            $country = Country::find($id);
            if ($country) {
                $country->update($data);
                return response()->json($country);
            } else {
                return response()->json(['message' => 'Country not found'], 404);
            }
        } else {
            $country = Country::create($data);
            return response()->json($country, 201);
        }
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        if ($country) {
            $country->delete();
            return response()->json(['message' => 'Country deleted successfully']);
        } else {
            return response()->json(['message' => 'Country not found'], 404);
        }
    }
}
