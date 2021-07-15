<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteTrait
{
    public function deleteModelTrait($model, $id)
    {
        try {
            $model->find($id)->delete();
            return response([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return response([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

}
