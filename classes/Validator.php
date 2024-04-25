<?php

class Validator
{
    private $data;
    private $errors = [];
    private $emptyData =[];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate($rules) 
    {
        foreach ($this->data as $fieldname => $value){
            if (isset($rules[$fieldname])) {
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname]
                ]);
            }
        }
    }

    private function check($fieldData) 
    {
        if ($fieldData['rules']['required'] && !$this->required($fieldData['value'])) {
            $this->errors[$fieldData['fieldname']][] = "Поле обязательно для заполнения!";
            return;
        } elseif (!$fieldData['rules']['required'] && !$this->required($fieldData['value'])){
            return;
        }
        foreach ($fieldData['rules'] as $rule=>$ruleValue) {
            switch($rule) {
                case 'min':
                    if (!$this->min($fieldData['value'], $ruleValue)){
                        $this->errors[$fieldData['fieldname']][] = "Введите не меньше $ruleValue символов";
                    };
                    break;
                case 'unique':
                    if (!$this->unique($fieldData['fieldname'], $fieldData['value'])){
                        $this->errors[$fieldData['fieldname']][] = "Уже существует. Введите другое значение.";
                    }
                    break;
                case 'email':
                    if (!$this->email($fieldData['value'], $ruleValue)){
                        $this->errors[$fieldData['fieldname']][] = "Вы ввели не email!";
                    };
                    break;
                case 'match':
                    if (!$this->match($fieldData['value'], $this->data[$ruleValue[0]])){
                        $this->errors[$fieldData['fieldname']][] = $ruleValue[1];
                    };
                    break;
                case 'onlyLetters':
                    if (!$this->onlyLetters($fieldData['value'])){
                        $this->errors[$fieldData['fieldname']][] = "Поле должно состоять только из букв!";
                    };
                    break;
                case 'letterAndNumber':
                    if (!$this->letterAndNumber($fieldData['value'])){
                        $this->errors[$fieldData['fieldname']][] = "Поле должно состоять из букв и цифр!";
                    };
                    break;
                case 'spaceInMid':
                    if ($this->spaceInMid($fieldData['value'])){
                        $this->errors[$fieldData['fieldname']][] = "Пробелы запрещены!";
                    };
                    break;             
            }
        }
    }

    public function min($value, $ruleValue)
    {
        return mb_strlen($value, 'UTF-8') >= $ruleValue;
    }

    protected function unique($fieldname, $value) {
        $json = file_get_contents('../config/users.json');
        $users = json_decode($json, true);
        foreach($users as $user) {
            if ($user[$fieldname] == $value) {
                return false;
            }
        }
        return true;
    }

    protected function required($value)
    {
        return !empty($value);
    }

    protected function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function match($value, $matchValue)
    {
        return $value == $matchValue;
    }

    protected function onlyLetters($value)
    {
        return preg_match('/^[a-zа-я]+$/iu', $value);
    }

    protected function letterAndNumber($value)
    {
        return preg_match('/(^[a-zа-я0-9]+$)/iu', $value) && preg_match('/[0-9]/', $value) && preg_match('/[a-zа-я]/iu', $value);
    }

    protected function spaceInMid($value)
    {
        return strpos($value, ' ');
    }

    public function getErrors()
    {
        return $this->errors;
    }

}