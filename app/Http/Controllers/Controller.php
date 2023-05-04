<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0", *
 *      title="ORCHID REST API",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *           name="Pires Lufungula",
 *          email="pireslfgl@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 *  * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Orchid campus Server"
     * )
     *
   * @OA\Tag(
     *     name="ORCHID CAMPUS PROJECT",
     *     description="API Endpoints of Projects"
     * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


}
