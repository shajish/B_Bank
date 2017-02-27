<?php

    namespace App\Http\Controllers\Api;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use App\Http\Controllers\Controller;
    use App\Models\Category as CategoryModel;
    use App\User as UserModel;
    use App\Models\RoleUsers as RoleModel;
    use App\Models\Districts as DistrictModel;
    use App\Models\UserProfiles as UserProfileModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Mockery\CountValidator\Exception;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Dingo\Api\Exception\ValidationHttpException;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    class ApiController extends Controller
    {

        public function registerUser(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'username'    => 'required',
                'password'    => 'required',
                'name'        => 'required',
                'email'       => 'required',
                'location'    => 'required',
                'contacts'    => 'required',
                'category_id' => 'required',
                'district_id' => 'required',
            ]);
            if ($validator->fails()) {
                throw new ValidationHttpException($validator->errors()->all());
            }
            try {
                DB::transaction(function () use ($request) {
                    $date             = date('Y-m-d H:i:s');
                    $user             = new UserModel();
                    $user->username   = $request['username'];
                    $user->password   = $request['password'];
                    $user->created_at = $date;
                    $user->save();
//
                    $user_id = $user->id;

                    $role          = new RoleModel();//DB::table('role_users');
                    $role->user_id = $user_id;
                    $role->role    = 1;//$request['role'];
                    $role->save();

                    $userProfile              = new UserProfileModel();
                    $userProfile->user_id     = $user_id;
                    $userProfile->name        = $request['name'];
                    $userProfile->email       = $request['email'];
                    $userProfile->location    = $request['location'];
                    $userProfile->contacts    = $request['contacts'];
                    $userProfile->category_id = $request['category_id'];
                    $userProfile->district_id = $request['district_id'];
                    $userProfile->status      = 0;
                    $userProfile->save();
                });
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Registration success'
                ]);
            } catch (Exception $ex) {
                return response()->json([
                    "status_code" => 1,
                    "message"     => "Registration failed"
                ]);
            }

        }

        /* api for-> fetching out blood group*/
        public function getBloodGroup()
        {
            try {
                $category = new CategoryModel();
                $data     = $category->all();
                return response()->json([
                    'status_code' => 0,
                    'data'        => $data
                ]);
            } catch (PDOException $e) {
                return response()->json([
                    'status_code' => 1,
                    'message'     => "Failed to get list of blood group."
                ]);
            }

        }

        public function getDistricts()
        {
            try {
                $districts = new DistrictModel();
                $data      = $districts->all();
                return response()->json([
                    'status_code' => 0,
                    'data'        => $data
                ]);
            } catch (Exception $ex) {
                return response()->json([
                    'status_code' => 1,
                    'message'     => "Failed to get list of districts."
                ]);
                return $ex->getMessage();
            }

        }

        public function getUser(Request $request)
        {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token invalid']);
            }

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
            ]);
            if ($validator->fails()) {
                throw new ValidationHttpException($validator->errors()->all());
            }
            try {
                // conditional where clause so queries are required to be stored before get()
                $userprofile = UserProfileModel::query();
                $userprofile = $userprofile->where('category_id', $request->category_id)->where('status',0);
                if (isset($request->district_id)) {
                    $userprofile = $userprofile->where('district_id', $request->district_id);
                }
                $data = $userprofile->get();
                if ($data[0]->id) {
                    return response()->json([
                        'status_code' => 0,
                        'data'        => $data
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 1,
                        'message'     => "failed to get list of users of the group"
                    ]);

                }
            } catch (PDOException $e) {
                return response()->json([
                    'status_code' => 1,
                    'message'     => "failed to get list of users of the group"
                ]);

            }

        }

        public function activateStatus(Request $request)
        {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token invalid']);
            }
            $user        = JWTAuth::parseToken()->toUser();
            $userProfile = new UserProfileModel();

            $status = $userProfile->select('status')->where('user_id', $user->id)->get();
            try {
                if ($status[0]->status == 0) {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => "You are already active in our system for donating blood"
                    ]);

                } elseif ($userProfile->where('user_id', $user->id)->update(['status' => 0])) {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => 'Soon you can donate blood :) '
                    ]);
                }
            } catch (Exception $ex) {
                return response()->json([
                    'status_code' => 1,
                    'message'     => "Sorry ! Couldnot make your status active. Please Try Again."
                ]);
            }
        }

        public function deactivateStatus(Request $request)
        {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token invalid']);
            }
            $user        = JWTAuth::parseToken()->toUser();
            $id          = $user->id;
            $userProfile = new UserProfileModel();

            $status = $userProfile->select('status')->where('user_id', $user->id)->get();
            try {
                if ($status[0]->status == 1) {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => "You are already inactive in our system for donating blood"
                    ]);
//                return response()->json(['message'=>"You are already inactive in our system for donating blood"]);
                } elseif ($userProfile->where('user_id', $user->id)->update(['status' => 1])) {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => 'Take your time. :)'
                    ]);
//                return response()->json(['message'=>'Take your time. :)' ]);
                }
            } catch (Exception $ex) {
                return response()->json([
                    'status_code' => 1,
                    'message'     => "Sorry! Could not made your status deactive. Please Try again"
                ]);
//            return response()->json(['message'=>"Sorry! Could not made your status deactive. Please Try again"]);
            }

        }

        public function logout(Request $request)
        {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token invalid']);
            }

            try {
                if (JWTAuth::parseToken()->invalidate()) {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => "logged out successfully"
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 0,
                        'message'     => "You are already inactive in our system for donating blood"
                    ]);
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }
    }
