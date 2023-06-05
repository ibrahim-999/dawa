<?php
namespace App\Documentation\User\Api\V1;

class Auth
{
    /**
     * @OA\Post(
     * path="/api/v1/logout",
     *   tags={"auth"},
     *   summary="logout user",
     *   operationId="logout",
     *   security={
     *      {
     *          "bearer": {}
     *      },
     *  },
     *  @OA\Parameter(
     *      name="content-type",
     *      in="header",
     *      example="application/json",
     *      required=true,
     *  ),
     *  @OA\Parameter(
     *      name="X-Requested-With",
     *      in="header",
     *      example="XMLHttpRequest",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="X-Locale",
     *      example = "en",
     *      in="header",
     *      @OA\Schema(
     *        type="en",
     *        enum={"en", "ar"}
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="logout successfully.",
     *      @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="logout successfully."),
     *      ),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="unauthorized.",
     *      @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="unauthorized"),
     *      ))
     *)
     **/
    function logout()
    {

    }
    /**
     * @OA\Post(
     * path="/api/v1/register",
     *   tags={"register"},
     *   summary="continue sign up",
     *   operationId="auth-continue-as-has-experience",
     *   security={
     *      {
     *          "bearer": {}
     *      },
     *  },
     *  @OA\Parameter(
     *      name="content-type",
     *      in="header",
     *      example="application/json",
     *      required=true,
     *  ),
     *  @OA\Parameter(
     *      name="X-Requested-With",
     *      in="header",
     *      example="XMLHttpRequest",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="X-Locale",
     *      example = "en",
     *      in="header",
     *      @OA\Schema(
     *        type="en",
     *        enum={"en", "ar"}
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="address",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="latitude",
     *      example="25.123456",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="longitude",
     *      example="30.123456",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="experience",
     *      example="has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          enum = {"has_experience","student"}
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="job_title",
     *      example="developer",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="company_name",
     *      example="jobzella",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="employment_type",
     *      example="full_time",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          enum = {"full-time","part-time","contract","temporary","volunteer","internship"}
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="start_year",
     *      example="2020",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="end_year",
     *      example="2020",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="still_in_role",
     *      description="required if experience value is has_experience",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          enum = {1,0}
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="completed successfully.",
     *      @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="created successfully."),
     *      ),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="unautourized.",
     *      @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="unautourized"),
     *      ),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="you already registered.",
     *      @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="you already registered"),
     *      ),
     *   ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error.",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The given data was invalid."
     *          ),
     *          @OA\Property(property="errors", type="object",
     *              @OA\Property(
     *                  property="address",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The address field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="latitude",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The latitude field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="longitude",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The longitude field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="experience",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The experience field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="job_title",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The job title field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="company_name",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The company name field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="employment_type",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The employment type field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="start_year",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The start year field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="end_year",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The end year field is required.",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="still_in_role",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The still in role field is required.",
     *                  ),
     *              ),
     *        )
     *      )
     *      )
     *)
     **/
    function register()
    {

    }

}
