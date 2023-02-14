<?php

    namespace App;

    use Illuminate\Http\Request;

    use App\Models\Country;
    use App\Models\State;
    use App\Models\City;

    class Helper{
        public function fetch_states(Request $request) {
            $data['states'] = State::where('country_id',$request->country_id)->get();
            return response()->json($data);
        }

        public function fetch_cities(Request $request) {
            $data['cities'] = City::where('state_id',$request->state_id)->get();
            return response()->json($data);
        }
    }