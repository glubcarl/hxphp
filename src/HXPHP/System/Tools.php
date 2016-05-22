<?php

namespace HXPHP\System;

class Tools
{
	/**
	 * Exibe os dados
	 * @param  mist $data Variável que será "debugada"
	 */
	static function dd($data, $dump = false)
	{
		echo '<pre>';

		($dump) ? var_dump($data) : print_r($data);

		echo '</pre>';
	}

	/**
	 * Criptografa a senha do usuário no padrão HXPHP
	 * @param  string $password Senha do usuário
	 * @param  string $salt     Código alfanumérico
	 * @return array            Array com o SALT e a SENHA
	 */
	static function hashHX($password, $salt = null)
	{

		if (!$salt)
			$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		$password = hash('sha512', $password.$salt);

		return [
			'salt' => $salt,
			'password' => $password
		];
	}

	/**
	 * Processo de tratamento para o mecanismo MVC
	 * @param string $input     String que será convertida
	 * @return string           String convertida
	 */
	static function filteredName($input)
	{
		$input = explode('?', $input);
		$input = $input[0];

		$find    = [
			'-',
			'_'
		];
		$replace = [
			' ',
			' '
		];
		return str_replace(' ', '', ucwords(str_replace($find, $replace, $input)));
	}

        static function filteredFileName($input)
        {
            //$new = preg_replace('/[^\w]/', '', $input);
            $input = trim($input);

            //Remove " caso exista
            $new = str_replace('&#34;', '', $input);

            $find = [
                '  ',
                '"',
                'á',
                'ã',
                'à',
                'â',
                'ª',
                'é',
                'è',
                'ê',
                'ë',
                'í',
                'ì',
                'î',
                'ï',
                'ó',
                'ò',
                'õ',
                'ô',
                '°',
                'º',
                'ö',
                'ú',
                'ù',
                'û',
                'ü',
                'ç',
                'ñ',
                'Á',
                'Ã',
                'À',
                'Â',
                'É',
                'È',
                'Ê',
                'Ë',
                'Í',
                'Ì',
                'Î',
                'Ï',
                'Ó',
                'Ò',
                'Õ',
                'Ô',
                'Ö',
                'Ú',
                'Ù',
                'Û',
                'Ü',
                'Ç',
                'Ñ',
            ];

            $replace = [
                '',
                '',
                'a',
                'a',
                'a',
                'a',
                'a',
                'e',
                'e',
                'e',
                'e',
                'i',
                'i',
                'i',
                'i',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'u',
                'u',
                'u',
                'u',
                'c',
                'n',
                'A',
                'A',
                'A',
                'A',
                'E',
                'E',
                'E',
                'E',
                'I',
                'I',
                'I',
                'I',
                'O',
                'O',
                'O',
                'O',
                'O',
                'U',
                'U',
                'U',
                'U',
                'C',
                'N',
            ];

            return strtolower(str_replace(' ', '_', str_replace($find, $replace, $new)));
        }

	static function decamelize($cameled, $sep = '-') {
	    return implode(
			$sep,
			array_map(
				'strtolower',
				preg_split('/([A-Z]{1}[^A-Z]*)/', $cameled, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY)
			)
	    );
	}
}