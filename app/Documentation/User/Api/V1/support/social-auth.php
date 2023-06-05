<?php
/**
 * @OA\Post(
 * path="/api/v1/social/register",
 *   tags={"auth"},
 *   summary="register by social network",
 *   operationId="social-register",
 *
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
 *      name="provider_name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *          enum={"facebook", "google", "twitter", "linkedin", "apple"}
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="provider_id",
 *      example="123456789511",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="first_name",
 *      example = "First Name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="last_name",
 *      example = "Last Name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="email",
 *      example = "example@example.com",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="data",
 *      example={"first_name":"first name","last_name":"last name","username":"user name","image":"image url","phone_ext":"+20","phone":"109465218765"},
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=201,
 *      description="created successfully.",
 *      @OA\JsonContent(
 *        @OA\Property(property="access_token", type="string", example="It contains the access token."),
 *        @OA\Property(property="token_type", type="string", example="bearer"),
 *        @OA\Property(property="user", type="object",
 *                      @OA\Property(
 *                         property="id",
 *                         type="integer",
 *                         example="User id."
 *                      ),
 *                      @OA\Property(
 *                         property="first_name",
 *                         type="string",
 *                         example="User name."
 *                      ),
 *                      @OA\Property(
 *                         property="last_name",
 *                         type="string",
 *                         example="User name."
 *                      ),
 *                      @OA\Property(
 *                         property="email",
 *                         type="string",
 *                         example="User email."
 *                      ),
 *                      @OA\Property(
 *                         property="is_completed",
 *                         type="boolean",
 *                         example="true"
 *                      ),
 *                      @OA\Property(
 *                         property="is_verified",
 *                         type="boolean",
 *                         example="false"
 *                      ),
 *        ),
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
 *                  property="provider_name",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The provider name field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="provider_id",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The provider id field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="first_name",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The first name field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="last_name",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The first name field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="email",
 *                  type="array",
 *                  description="email, unique",
 *                  @OA\Items(
 *                         type="string",
 *                         example="The email is required."
 *               ),
 *              ),
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  description="string, Min: 8 characters.",
 *                  @OA\Items(
 *                         type="string",
 *                         example="The data is required."
 *               ),
 *              ),
 *
 *        )
 *      )
 *      )
 *)
 **/

/**
 * @OA\Post(
 * path="/api/v1/social/login",
 *   tags={"auth"},
 *   summary="Login by social network",
 *   operationId="social-login",
 *
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
 *      name="provider_name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *          enum={"facebook", "google", "twitter", "linkedin", "apple"}
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="provider_id",
 *      example="123456789511",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="data",
 *      example={"first_name":"first name","last_name":"last name","username":"user name","image":"image url","phone_ext":"+20","phone":"109465218765"},
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *      description="login successfully.",
 *      @OA\JsonContent(
 *        @OA\Property(property="access_token", type="string", example="It contains the access token."),
 *        @OA\Property(property="token_type", type="string", example="bearer"),
 *        @OA\Property(property="user", type="object",
 *                      @OA\Property(
 *                         property="id",
 *                         type="integer",
 *                         example="User id."
 *                      ),
 *                      @OA\Property(
 *                         property="first_name",
 *                         type="string",
 *                         example="User name."
 *                      ),
 *                      @OA\Property(
 *                         property="last_name",
 *                         type="string",
 *                         example="User name."
 *                      ),
 *                      @OA\Property(
 *                         property="email",
 *                         type="string",
 *                         example="User email."
 *                      ),
 *                      @OA\Property(
 *                         property="is_completed",
 *                         type="boolean",
 *                         example="true"
 *                      ),
 *                      @OA\Property(
 *                         property="is_verified",
 *                         type="boolean",
 *                         example="false"
 *                      ),
 *        ),
 *      ),
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="complete your sign up form data.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="complete your sign up form data"),
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
 *                  property="provider_name",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The provider name field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="provider_id",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example="The provider id field is required.",
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  description="string",
 *                  @OA\Items(
 *                         type="string",
 *                         example="The data is required."
 *               ),
 *              ),
 *
 *        )
 *      )
 *      )
 *)
 **/