<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute debe ser aceptado.',
    'accepted_if' => ':attribute debe ser aceptado si :other es :value.',
    'active_url' => ':attribute no es una URL válida.',
    'after' => ':attribute debe ser una fecha después de :date.',
    'after_or_equal' => ':attribute debe ser una fecha después de o igual a :date.',
    'alpha' => ':attribute solo puede contener letras.',
    'alpha_dash' => ':attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => ':attribute solo puede contener letras y números.',
    'array' => ':attribute debe ser un array.',
    'before' => ':attribute debe ser una fecha antes de :date.',
    'before_or_equal' => ':attribute debe ser una fecha antes de o igual :date.',
    'between' => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file' => 'El tamaño de :attribute debe estar entre :min y :max kilobytes.',
        'string' => ':attribute debe tener una longitud de entre :min y :max caracteres.',
        'array' => ':attribute debe tener entre :min y :max elementos.',
    ],
    'boolean' => ':attribute debe ser verdadero o falso.',
    'confirmed' => ':attribute y su confirmación no coinciden.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => ':attribute no es una fecha válida.',
    'date_equals' => ':attribute debe ser una fecha igual a :date.',
    'date_format' => ':attribute debe tener el formato :format.',
    'declined' => ':attribute debe ser rechazado.',
    'declined_if' => ':attribute debe ser rechazado si :other es :value.',
    'different' => ':attribute y :other deben ser diferentes.',
    'digits' => ':attribute deben tener :digits dígitos de longitud.',
    'digits_between' => ':attribute debe tener entre :min y :max dígitos de longitud.',
    'dimensions' => ':attribute tiene dimensiones inválidas.',
    'distinct' => ':attribute tiene un valor duplicado.',
    'email' => ':attribute no es un correo válido.',
    'ends_with' => ':attribute debe terminar con uno de los siguientes: :values.',
    'enum' => ':attribute seleccionado es inválido.',
    'exists' => ':attribute seleccionado es inválido.',
    'file' => ':attribute debe ser un archivo.',
    'filled' => ':attribute debe tener un valor.',
    'gt' => [
        'numeric' => ':attribute debe ser mayor a :value.',
        'file' => 'El tamaño de :attribute debe ser mayor a :value kilobytes.',
        'string' => ':attribute debe tener más de :value caracteres.',
        'array' => ':attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => ':attribute debe ser mayor o igual a :value.',
        'file' => 'El tamaño de :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => ':attribute debe tener :value caracteres o más.',
        'array' => ':attribute debe tener :value elementos o más.',
    ],
    'image' => ':attribute debe ser una imagen.',
    'in' => ':attribute seleccionado es inválido.',
    'in_array' => ':attribute no existe en :other.',
    'integer' => ':attribute debe ser un número entero.',
    'ip' => ':attribute debe ser una dirección IP válida.',
    'ipv4' => ':attribute debe ser una dirección IPv4 válida.',
    'ipv6' => ':attribute debe ser una dirección IPv6 válida.',
    'json' => ':attribute debe ser una cadena de JSON válida.',
    'lt' => [
        'numeric' => ':attribute debe ser menor a :value.',
        'file' => 'El tamaño de :attribute debe ser menor a :value kilobytes.',
        'string' => ':attribute debe tener menos de :value caracteres.',
        'array' => ':attribute debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => ':attribute debe ser menor o igual a :value.',
        'file' => 'El tamaño de :attribute debe ser menor o igual a :value kilobytes.',
        'string' => ':attribute debe tener :value caracteres o menos.',
        'array' => ':attribute debe tener :value elementos o menos.',
    ],
    'mac_address' => ':attribute debe ser una dirección MAC válida.',
    'max' => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file' => 'El tamaño de :attribute no debe ser mayor a :max kilobytes.',
        'string' => ':attribute tiene un máximo de :max caracteres.',
        'array' => ':attribute tiene un máximo de :max elementos.',
    ],
    'mimes' => ':attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => ':attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => ':attribute no debe ser menor a :min.',
        'file' => 'El tamaño de :attribute no debe ser menor a :min kilobytes.',
        'string' => ':attribute tiene un mínimo de :min caracteres.',
        'array' => ':attribute tiene un mínimo de :min elementos.',
    ],
    'multiple_of' => ':attribute debe ser un múltiplo de :value.',
    'not_in' => ':attribute seleccionado es inválido.',
    'not_regex' => 'El formato de :attribute es inválido.',
    'numeric' => ':attribute debe ser un número.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido si :other es :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other sea in :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => ':attribute es requerido.',
    'required_array_keys' => ':attribute debe contener entradas de: :values.',
    'required_if' => ':attribute es requerido si :other es :value.',
    'required_unless' => ':attribute es requerido a menos que :other sea :values.',
    'required_with' => ':attribute es requerido si los alguno de los campos :values está presente.',
    'required_with_all' => ':attribute es requerido si todos los campos :values están presentes.',
    'required_without' => ':attribute es requerido si algunos de los campos :values no está presente.',
    'required_without_all' => ':attribute es requerido si ninguno de los campos :values están presentes.',
    'same' => ':attribute y :other deben coincidir.',
    'size' => [
        'numeric' => ':attribute debe ser :size.',
        'file' => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string' => ':attribute debe tener una longitud de :size caracteres.',
        'array' => ':attribute debe contener :size elementos.',
    ],
    'starts_with' => 'The :attribute debe terminar con uno de los siguientes: :values.',
    'string' => ':attribute debe ser una cadena de texto.',
    'timezone' => ':attribute debe ser una zona horaria válida.',
    'unique' => ':attribute ya ha sido usado.',
    'uploaded' => ':attribute no pudo ser subida con éxito.',
    'url' => ':attribute debe ser una URL válida.',
    'uuid' => ':attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        // TODO -> a veces hay conflictos entre algunos nombres de atributos que se repiten en distintas tablas, pero me imagino que se pueden sustituir en los sitios según sea necesario.

        // Student and Instructor attributes
        'first_name' => 'El primer nombre',
        'second_name' => 'El segundo nombre',
        'first_lastname' => 'El primer apellido',
        'second_lastname' => 'El segundo apellido',
        'ci' => 'La cédula',
        'ci_type' => 'El tipo de cédula',
        'email' => 'El correo electrónico',
        'birth' => 'La fecha de nacimiento',
        'password' => 'La contraseña',
        'password_confirmation' => 'La confirmación de contraseña',
        'grade' => 'El grado de instrucción',
        'gender' => 'El sexo',
        'image' => 'La imagen',
        'phone' => 'El teléfono',
        'address' => 'La dirección',
        'name' => 'El nombre',
        'lastname' => 'El apellido',
        'degree' => 'La titulación',
        
        // Course and Club attributes

        'description' => 'La descripción',
        'total_price' => 'El monto total',
        'reserv_price' => 'El monto de reserva',
        'start_ins' => 'inicio de inscripciones',
        'end_ins' => 'fin de inscripciones',
        'start_course' => 'inicio del curso',
        'end_course' => 'fin del curso',
        'duration' => 'La duración',
        'student_limit' => 'El límite de estudiantes',
        'days' => 'Los días',
        'start_hour' => 'La hora de inicio',
        'end_hour' => 'La hora de cierre',
        'day' => 'El día',

        // Item attributes
        'code' => 'El código',

        // Inventories attributes
        'amount' => 'El monto',
        'operation' => 'La operación',

        // Inscription attributes
        'confirmed_at' => 'La fecha de confirmación',
        'approved_at' => 'La fecha de aprobación',
        'unique' => 'El campo único',

        // Payment attributes
        'status' => 'El estado',
        'ref' => 'La referencia',
        'type' => 'El tipo de pago',

        // Credentials attributes
        'bank' => 'El banco',
        'account' => 'El número de cuenta',

        // Foreign key attributes
        'instructor_id' => 'El instructor',
        'area_id' => 'El área',
        'pnf_id' => 'El PNF',
        'item_id' => 'El artículo',
        'club_id' => 'El club',
        'student_id' => 'El estudiante',
        'inscription_id' => 'La inscripción',
        'payment_id' => 'El pago',
    ],

];
