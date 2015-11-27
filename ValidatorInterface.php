<?php
/**
 * Created by PhpStorm.
 * User: danielfiebig
 * Date: 05/05/15
 * Time: 12:25
 */

namespace bdart\validator;

/**
 * Interface ValidatorInterface
 * @package bdart\validator
 */
interface ValidatorInterface
{
    /**
     * Resolve the signed request key
     *
     * @param $signed_request
     * @return mixed
     */
    public function parse_signed_request($signed_request);

    /**
     * Decoder
     *
     * @param $input
     * @return mixed
     */
    public function base64_url_decode($input);
}