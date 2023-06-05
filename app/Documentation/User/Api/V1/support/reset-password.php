<?php

/**
 * @OA\post(
 *  path="/api/v1/forget-password",
 *   tags={"Reset password"},
 *   summary="forget password , send code by mail",
 *   operationId="forget-password",
 *
 *  @OA\Parameter(
 *      name="content-type",
 *      in="header",
 *      example="application/json",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
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
 *      in="header",
 *      @OA\Schema(
 *        type="string",
 *        example = "en"  
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="email",
 *      in="query",
 *      required=true,
 *      example = "example@example.com" ,
 *      description="type : string , (example@example.com)",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=201,
 *      description="Successful operation.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="token is created."),
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
 *                  property="email",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example={"The email field is required."},
 *                  ),
 *              ),
 *        )
 *      )
 *      ),
 *   @OA\Response(
 *      response=500,
 *      description="Internal server error.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="Internal server error."),
 *      ),
 *   ),
 *)
 **/

/**
 * @OA\post(
 *  path="/api/v1/reset-password",
 *   tags={"Reset password"},
 *   summary="reset password , reset password",
 *   operationId="reset-password",
 *
 *  @OA\Parameter(
 *      name="content-type",
 *      in="header",
 *      example="application/json",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
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
 *      in="header",
 *      @OA\Schema(
 *        type="string",
 *        example = "en"  
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="email",
 *      in="query",
 *      required=true,
 *      example = "example@example.com" ,
 *      description="type : string , (example@example.com)",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="code",
 *      in="query",
 *      required=true,
 *      example = "1145" ,
 *      description="type : string , (1145)",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="password",
 *      in="query",
 *      required=true,
 *      example = "password123" ,
 *      description="type : string , at least 8 char contain char and number",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="password_confirmation",
 *      in="query",
 *      required=true,
 *      example = "password123" ,
 *      description="type : string",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=201,
 *      description="Successful operation.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="password is uodated."),
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
 *                  property="email",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example={"The email field is required."},
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="code",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example={"The code field is required."},
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="password",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example={"The password field is required."},
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="password_confirmation",
 *                  type="array",
 *                  @OA\Items(
 *                      type="string",
 *                      example={"The password confirmation field is required."},
 *                  ),
 *              ),
 *        )
 *      )
 *      ),
 *   @OA\Response(
 *      response=400,
 *      description="code not found.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="code is wrong."),
 *      ),
 *   ),
 *   @OA\Response(
 *      response=500,
 *      description="Internal server error.",
 *      @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="Internal server error."),
 *      ),
 *   ),
 *)
 **/ 