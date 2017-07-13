<?php 

    /**
     * [ To send well formatted api response ]
     * @param  [ String ] $type    [ "success" / "failed" ]
     * @param  [ String ] $message [ Message to be send with response. ]
     * @return [json object]          
     */
    function apiResponse($type, $message = null, $data=null, $customFailedStatus = null){
        if($type == 'success'){
            $status_code = 0;
        }elseif ($type == 'failed') {
            if($customFailedStatus != null){
                $status_code = $customFailedStatus;
            }else{
                $status_code = rand(1,4);
            }
        }
        
        if($data != null && $message != null){
            return response()->json([
                'status_code' => $status_code,
                'message' => $message,
                'data'     => $data
                ]);
        }elseif($data != null ){
            return response()->json([
                'status_code' => $status_code,
                'data'     => $data
                ]);
        }else{
            return response()->json([
                'status_code' => $status_code,
                'message'     => $message
                ]);
        }
    }

    ?>
