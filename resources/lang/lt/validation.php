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

    'accepted' => 'Turite sutikti su :attribute.',
    'active_url' => 'Netinkamas :attribute laukelio nuorodos adresas.',
    'after' => ':attribute laukelis turi būti data po :date.',
    'after_or_equal' => ':attribute laukelis turi būti data po arba lygi :date.',
    'alpha' => ':attribute laukelis turi būti sudarytas tik iš raidžių.',
    'alpha_dash' => ':attribute laukelis gali būti sudarytas tik iš raidžių, skaičių, / ir _ .',
    'alpha_num' => ':attribute laukelis gali būti sudarytas tik iš raidžių ir skaičių.',
    'array' => ':attribute laukelis turi būti masyvas.',
    'before' => ':attribute laukelis turi būti data iki :date.',
    'before_or_equal' => ':attribute laukelis turi būti data iki arba lygi :date.',
    'between' => [
        'numeric' => ':attribute laukelis turi būti tarp :min ir :max.',
        'file' => ':attribute laukelis turi būti tarp :min ir :max kilobaitų.',
        'string' => ':attribute laukelis turi būti tarp :min ir :max simbolių.',
        'array' => ':attribute laukelis turi turėti tarp :min ir :max elementų.',
    ],
    'boolean' => 'Laukelis :attribute turi būti true abra false.',
    'confirmed' => 'Nesutampa :attribute laukeliai.',
    'date' => 'Negalima :attribute laukelis data.',
    'date_equals' => ':attribute laukelis turi būti data lygi :date.',
    'date_format' => 'Netinkamas :attribute laukelis formatas. Turi būti :format formatas.',
    'different' => ':attribute laukelis ir :other laukelis turi skirtis.',
    'digits' => ':attribute laukelis turi būti :digits skaitmenų.',
    'digits_between' => ':attribute laukelis turi būti tarp :min ir :max skaitmenų.',
    'dimensions' => ':attribute laukelis yra netinkamų paveikslėlio matmenų.',
    'distinct' => ':attribute vertė kartojasi.',
    'email' => ':attribute laukelis turi būti parašytas tinkamu el. pašto formatu.',
    'ends_with' => ':attribute laukelis turi baigtis viena iš šių verčių: :values.',
    'exists' => 'Pasirinkta :attribute vertė negalima.',
    'file' => ':attribute laukelyje turi būti failas.',
    'filled' => 'Laukelis :attribute turi turėti reikšmę.',
    'gt' => [
        'numeric' => ':attribute laukelis turi būti didesnis nei :value.',
        'file' => ':attribute laukelis turi būti didesnis nei :value kilobaitų.',
        'string' => ':attribute laukelis turi būti ilgesnis nei :value simbolių.',
        'array' => ':attribute laukelis turi turėti daugiau nei :value elementų.',
    ],
    'gte' => [
        'numeric' => ':attribute laukelis turi būti didesnis arba lygus :value.',
        'file' => ':attribute laukelis turi būti didesnis arba lygus :value kb.',
        'string' => ':attribute laukelis turi būti didesnis arba lygus :value simbolių.',
        'array' => ':attribute laukelis turi turėti :value elementų arba daugiau.',
    ],
    'image' => ':attribute laukelyje turi būti paveikslėlis.',
    'in' => 'Pasirinkta :attribute vertė negalima.',
    'in_array' => ':attribute laukelis neegsiztuoja tarp :other.',
    'integer' => ':attribute laukelis turi būti sveikasis skaičius.',
    'ip' => ':attribute laukelis turi būti teisingas IP adresas.',
    'ipv4' => ':attribute laukelyje turi būti teisingas IPv4 adresas.',
    'ipv6' => ':attribute laukelyje turi būti teisingas IPv6 adresas.',
    'json' => ':attribute laukelyje turi būti teisinga JSON eilutė.',
    'lt' => [
        'numeric' => ':attribute reikmė turi būti mažesnė nei :value.',
        'file' => ':attribute vertė turi būti mažesnė nei :value kb.',
        'string' => ':attribute ilgis turi būti trumpesnis nei :value simbolių.',
        'array' => ':attribute laukelis turėti mažiau nei :value elementų.',
    ],
    'lte' => [
        'numeric' => ':attribute vertė turi būti mažesnė arba lygi :value.',
        'file' => ':attribute vertė turi būti mažesnė arba lygi :value kb.',
        'string' => ':attribute ilgis turi būti trumpesnis arba lygus :value simbolių.',
        'array' => ':attribute laukelis turi turėti daugiau nei :value elementų.',
    ],
    'max' => [
        'numeric' => ':attribute vertė negali būti didesnė nei :max.',
        'file' => ':attribute dydis negali būti didesnis nei :max kilobaitų.',
        'string' => ':attribute reikšmė negali būti ilgesnė nei :max simbolių.',
        'array' => ':attribute laukelis negali turėti daugiau nei :max elementų.',
    ],
    'mimes' => ':attribute failo tipas turi būti: :values.',
    'mimetypes' => ':attribute failo tipas turi būti: :values.',
    'min' => [
        'numeric' => ':attribute vertė turi būti mažiausiai :min.',
        'file' => ':attribute dydis turi būti mažiausiai :min kilobaitų.',
        'string' => ':attribute ilgis turi būti mažiausiai :min simbolių.',
        'array' => ':attribute laukelis turi turėti mažiausiai :min elementų.',
    ],
    'not_in' => 'Pasirinkta :attribute vertė yra negalima.',
    'not_regex' => 'Netinkamas :attribute formatas.',
    'numeric' => ':attribute reikšmė turi būti skaičius.',
    'password' => 'Neteisingas slaptažodis.',
    'present' => ':attribute laukelis turi egzistuoti.',
    'regex' => 'Netinkamas :attribute vertės formatas.',
    'required' => ':attribute laukelis yra privalomas.',
    'required_if' => ':attribute laukelis privalomas kai :other yra :value.',
    'required_unless' => ':attribute laukelis yra privalomas nebent :other yra įrašytas į :values.',
    'required_with' => ':attribute laukelis yra privalomas, kai yra :values.',
    'required_with_all' => ':attribute laukelis yra privalomas, kai yra :values.',
    'required_without' => ':attribute laukelis yra privalomas, kai nėra :values.',
    'required_without_all' => ':attribute laukelis yra privalomas, kai nėra :values.',
    'same' => ':attribute laukelis ir :other laukelis turi sutapti.',
    'size' => [
        'numeric' => ':attribute vertė turi būti :size.',
        'file' => ':attribute dydis turi būti :size kilobaitų.',
        'string' => ':attribute laukelis turi turėti :size simbolių.',
        'array' => ':attribute laukelis turi turėti :size elementų.',
    ],
    'starts_with' => ':attribute laukelis turi prasidėti viena iš šių reikšmių: :values.',
    'string' => ':attribute laukelis turi būti tekstinio formato.',
    'timezone' => 'Negalima :attribute laiko juosta.',
    'unique' => 'Tokia :attribute vertė jau egzistuoja.',
    'uploaded' => 'Nepavyko įkelti :attribute.',
    'url' => 'Negalimas :attribute formatas.',
    'uuid' => ':attribute vertė turi būti tinkamas UUID.',

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
        'email' => 'el. pašto adreso',
        'surname' => 'pavardės',
        'name' => 'vardo',
        'password' => 'slaptažodžio',
        'car' => 'automobilio',
        'date' => 'datos',
        'distance' => 'atstumo',
        'brand' => 'modelio',
        'number' => 'numerio',
        'fuel_type' => 'kuro tipo',
        'driver' => 'vairuotojo',
        'fuel_rate_summer' => 'vasaros kuro normos',
        'fuel_rate_winter' => 'žiemos kuro normos',
        'title' => 'pavadinimo',
        'address' => 'adreso',
        'route' => 'maršruto'
    ],

];