<?php
/**
 * Created by PhpStorm.
 * User: danielfiebig
 * Date: 05/05/15
 * Time: 12:25
 */

namespace bdart\validator;

use Yii;
use yii\base\Component;

/**
 * Class Validator
 * @package bdart\validator
 */
class Validator extends Component implements ValidatorInterface
{
    /**
     * @var
     */
    public $secret;

    /**
     * @param $signed_request
     * @return mixed|null
     */
    public function parse_signed_request($signed_request) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $this->secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    /**
     * @param $input
     * @return string
     */
    public function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}