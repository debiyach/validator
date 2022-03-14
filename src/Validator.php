<?php
/**
 * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
 */

namespace Debiyach\Validation;

use function explode;
use function str_contains;
use function is_array;
use function in_array;
use function call_user_func;
use function json_encode;

class Validator
{

    protected string $delimiter;

    protected array $entries;

    public array $workers;

    protected array $errors = [];

    protected array $messages;

    protected const ALLOWED_TYPE = ['min', 'max'];

    /**
     * @param array $data
     * @param array $filters
     * @param array $config
     */
    public function __construct(array $data, array $filters, array $config = [])
    {
        $this->setConfig($config);

        $this->entries = $data;
        $this->workers = $this->destruct($filters);

        $this->run();
    }

    /**
     * @param array $config
     * @return void
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    protected function setConfig(array $config){
        $this->delimiter = $config['delimiter'] ?? '|';
    }

    /**
     * Rule destruct
     * @param array $filters
     * @return array
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    protected function destruct(array $filters): array
    {
        $data = [];

        foreach ($filters as $fKey => $fVal) {

            $rules = explode($this->delimiter, $fVal);

            foreach ($rules as $rule) switch ($rule) {
                case str_contains($rule, ':'):
                    $parse = explode(':', $rule);
                    $data[$fKey][] = $parse;
                    break;
                default:
                    $data[$fKey][] = $rule;
                    break;
            }

        }

        return $data;
    }

    /**
     * Run the validating
     *
     * @return void
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    protected function run()
    {
        foreach ($this->workers as $key => $worker) {
            foreach ($worker as $key2 => $work) {

                if (is_array($work) && in_array($work[0],self::ALLOWED_TYPE)) {
                    $error = call_user_func([Validate::class, $work[0]], $this->entries[$key], $work[1]);
                } else {
                    $error = call_user_func([Validate::class, $work], $this->entries[$key]);

                }
                if ($error !== null) {
                    $this->errors[$key][] = $error;
                }
            }
        }
    }

    /**
     * Validate data
     * @return bool
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public function validate(): bool
    {
        if (count($this->errors) > 0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Error json_encode
     * @return string
     * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
     */
    public function __toString()
    {
        return json_encode($this->errors);
    }

}