<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 1:40 PM
 */

namespace App\Http\Validation;


use Illuminate\Validation\Factory;

/**
 * Class ValidationTeam
 * @package App\Http\Validation
 */
class ValidationTeam
{

    /**
     * @var Factory
     */
    private $validator;

    /**
     * ValidationTeam constructor.
     * @param $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $entityTeam
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeTeam(array $arrayTeam) : void
    {
        $this->validator->validate($arrayTeam,[
            'name'  => 'required|max:100',
            'strength'  => 'integer'
        ]);

    }

}