<?php

namespace api\modules\v1\swagger;
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="localhost:8080",
 *     basePath="http://api.examator.ru/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Examator",
 *         description="Version: __1.0.0__",
 *     ),
 * )
 *
 * @SWG\Tag(
 *   name="Blog",
 *   description="用户相关操作",
 *   @SWG\ExternalDocumentation(
 *     description="Find out more about our store",
 *     url="http://swagger.io"
 *   )
 * ) * @SWG\Tag(
 *   name="Blog",
 *   description="用户相关操作",
 *   @SWG\ExternalDocumentation(
 *     description="Find out more about our store",
 *     url="http://swagger.io"
 *   )
 * )
 *

 */
/**
 * @SWG\Definition(
 *   @SWG\Xml(name="##default")
 * )
 */
class ApiResponse
{
    /**
     * @SWG\Property(format="int32", description = "code of result")
     * @var int
     */
    public $code;
    /**
     * @SWG\Property
     * @var string
     */
    public $type;
    /**
     * @SWG\Property
     * @var string
     */
    public $message;
    /**
     * @SWG\Property(format = "int64", enum = {1, 2})
     * @var integer
     */
    public $status;
}
