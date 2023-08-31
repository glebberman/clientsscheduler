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

    'accepted' => 'השדה :attribute חייב להיות מתקבל.',
    'accepted_if' => 'השדה :attribute חייב להיות מתקבל כאשר :other הוא :value.',
    'active_url' => 'השדה :attribute חייב להיות כתובת URL תקינה.',
    'after' => 'השדה :attribute חייב להיות תאריך לאחר :date.',
    'after_or_equal' => 'השדה :attribute חייב להיות תאריך לאחר או שווה ל־:date.',
    'alpha' => 'השדה :attribute יכול להכיל רק אותיות.',
    'alpha_dash' => 'השדה :attribute יכול להכיל רק אותיות, מספרים, מקפים וקווים תחתונים.',
    'alpha_num' => 'השדה :attribute יכול להכיל רק אותיות ומספרים.',
    'array' => 'השדה :attribute חייב להיות מערך.',
    'ascii' => 'השדה :attribute יכול להכיל רק תווים אלפא-נומריים חד־ביטיים וסמלים.',
    'before' => 'השדה :attribute חייב להיות תאריך לפני :date.',
    'before_or_equal' => 'השדה :attribute חייב להיות תאריך לפני או שווה ל־:date.',
    'between' => [
        'array' => 'השדה :attribute חייב להכיל בין :min ל־:max פריטים.',
        'file' => 'השדה :attribute חייב להיות בין :min ל־:max קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות בין :min ל־:max.',
        'string' => 'השדה :attribute חייב להיות בין :min ל־:max תווים.',
    ],
    'boolean' => 'השדה :attribute חייב להיות true או false.',
    'can' => 'השדה :attribute מכיל ערך לא מורשה.',
    'confirmed' => 'השדה :attribute אינו תואם את האימות.',
    'current_password' => 'הסיסמה שגויה.',
    'date' => 'השדה :attribute חייב להיות תאריך חוקי.',
    'date_equals' => 'השדה :attribute חייב להיות תאריך ששווה ל־:date.',
    'date_format' => 'השדה :attribute אינו תואם את הפורמט :format.',
    'decimal' => 'השדה :attribute חייב להכיל :decimal מקומות עשרוניים.',
    'declined' => 'השדה :attribute חייב להיות נדחה.',
    'declined_if' => 'יש לדחות את השדה :attribute כאשר :other הוא :value.',
    'different' => 'השדה :attribute והשדה :other חייבים להיות שונים.',
    'digits' => 'השדה :attribute חייב להכיל :digits ספרות.',
    'digits_between' => 'השדה :attribute חייב להכיל בין :min ל־:max ספרות.',
    'dimensions' => 'השדה :attribute מכיל ממדי תמונה לא תקינים.',
    'distinct' => 'השדה :attribute מכיל ערך כפול.',
    'doesnt_end_with' => 'השדה :attribute אינו יכול להסתיים באחד מהערכים הבאים: :values.',
    'doesnt_start_with' => 'השדה :attribute אינו יכול להתחיל באחד מהערכים הבאים: :values.',
    'email' => 'השדה :attribute חייב להיות כתובת דוא"ל תקינה.',
    'ends_with' => 'השדה :attribute חייב להסתיים באחד מהערכים הבאים: :values.',
    'enum' => 'הערך הנבחר עבור :attribute אינו תקף.',
    'exists' => 'הערך הנבחר עבור :attribute אינו תקף.',
    'file' => 'השדה :attribute חייב להיות קובץ.',
    'filled' => 'השדה :attribute הוא שדה חובה.',
    'gt' => [
        'array' => 'השדה :attribute חייב להכיל יותר מ־:value פריטים.',
        'file' => 'השדה :attribute חייב להיות גדול מ־:value קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות גדול מ־:value.',
        'string' => 'השדה :attribute חייב להכיל יותר מ־:value תווים.',
    ],
    'gte' => [
        'array' => 'השדה :attribute חייב להכיל :value פריטים או יותר.',
        'file' => 'השדה :attribute חייב להיות גדול או שווה ל־:value קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות גדול או שווה ל־:value.',
        'string' => 'השדה :attribute חייב להיות ארוך או שווה ל־:value תווים.',
    ],
    'image' => 'השדה :attribute חייב להיות תמונה.',
    'in' => 'הערך הנבחר עבור :attribute אינו תקף.',
    'in_array' => 'השדה :attribute לא קיים ב־:other.',
    'integer' => 'השדה :attribute חייב להיות מספר שלם.',
    'ip' => 'השדה :attribute חייב להיות כתובת IP תקינה.',
    'ipv4' => 'השדה :attribute חייב להיות כתובת IPv4 תקינה.',
    'ipv6' => 'השדה :attribute חייב להיות כתובת IPv6 תקינה.',
    'json' => 'השדה :attribute חייב להיות מחרוזת JSON תקינה.',
    'lowercase' => 'השדה :attribute חייב להכיל אותיות קטנות בלבד.',
    'lt' => [
        'array' => 'השדה :attribute חייב להכיל פחות מ־:value פריטים.',
        'file' => 'השדה :attribute חייב להיות קטן מ־:value קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות קטן מ־:value.',
        'string' => 'השדה :attribute חייב להכיל פחות מ־:value תווים.',
    ],
    'lte' => [
        'array' => 'השדה :attribute לא יכול להכיל יותר מ־:value פריטים.',
        'file' => 'השדה :attribute חייב להיות קטן או שווה ל־:value קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות קטן או שווה ל־:value.',
        'string' => 'השדה :attribute חייב להיות קטן או שווה ל־:value תווים.',
    ],
    'mac_address' => 'השדה :attribute חייב להיות כתובת MAC תקינה.',
    'max' => [
        'array' => 'השדה :attribute לא יכול להכיל יותר מ־:max פריטים.',
        'file' => 'השדה :attribute לא יכול להיות גדול מ־:max קילובייטים.',
        'numeric' => 'השדה :attribute לא יכול להיות גדול מ־:max.',
        'string' => 'השדה :attribute לא יכול להיות ארוך מ־:max תווים.',
    ],
    'max_digits' => 'השדה :attribute לא יכול להכיל יותר מ־:max ספרות.',
    'mimes' => 'השדה :attribute חייב להיות קובץ מסוג: :values.',
    'mimetypes' => 'השדה :attribute חייב להיות קובץ מסוג: :values.',
    'min' => [
        'array' => 'השדה :attribute חייב להכיל לפחות :min פריטים.',
        'file' => 'השדה :attribute חייב להיות לפחות :min קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות לפחות :min.',
        'string' => 'השדה :attribute חייב להיות לפחות :min תווים.',
    ],
    'min_digits' => 'השדה :attribute חייב להכיל לפחות :min ספרות.',
    'missing' => 'השדה :attribute חסר.',
    'missing_if' => 'השדה :attribute חייב להיות חסר כאשר :other הוא :value.',
    'missing_unless' => 'השדה :attribute חייב להיות חסר אלא אם :other הוא :value.',
    'missing_with' => 'השדה :attribute חייב להיות חסר כאשר :values נמצאים במערך.',
    'missing_with_all' => 'השדה :attribute חייב להיות חסר כאשר כל :values נמצאים במערך.',
    'multiple_of' => 'השדה :attribute חייב להיות מרובה של :value.',
    'not_in' => 'הערך הנבחר עבור :attribute אינו תקף.',
    'not_regex' => 'הפורמט של השדה :attribute אינו תקף.',
    'numeric' => 'השדה :attribute חייב להיות מספר.',
    'password' => [
        'letters' => 'השדה :attribute חייב להכיל לפחות אות אחת.',
        'mixed' => 'השדה :attribute חייב להכיל לפחות אות אחת ברישיון גבוה ולפחות אות אחת ברישיון נמוך.',
        'numbers' => 'השדה :attribute חייב להכיל לפחות מספר אחד.',
        'symbols' => 'השדה :attribute חייב להכיל לפחות סמל אחד.',
        'uncompromised' => 'השדה :attribute נמצא במאגר נתונים פרטיים. אנא בחר :attribute שונה.',
    ],
    'present' => 'השדה :attribute חייב להיות נוכח.',
    'prohibited' => 'השדה :attribute אסור.',
    'prohibited_if' => 'השדה :attribute אסור כאשר :other הוא :value.',
    'prohibited_unless' => 'השדה :attribute אסור אלא אם :other נמצא ב־:values.',
    'prohibits' => 'השדה :attribute אוסר על :other להיות נוכח.',
    'regex' => 'הפורמט של השדה :attribute אינו תקף.',
    'required' => 'השדה :attribute הוא שדה חובה.',
    'required_array_keys' => 'השדה :attribute חייב להכיל ערכים עבור המפתחות: :values.',
    'required_if' => 'השדה :attribute חייב להיות חובה כאשר :other הוא :value.',
    'required_if_accepted' => 'השדה :attribute חייב להיות חובה כאשר :other מתקבל.',
    'required_unless' => 'השדה :attribute חייב להיות חובה אלא אם :other נמצא ב־:values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'השדה :attribute חייב להיות חובה כאשר :values נמצאים.',
    'required_without' => 'השדה :attribute חייב להיות חובה כאשר :values אינם נמצאים.',
    'required_without_all' => 'השדה :attribute חייב להיות חובה כאשר לא נמצאים :values.',
    'same' => 'השדה :attribute חייב להתאים לשדה :other.',
    'size' => [
        'array' => 'השדה :attribute חייב להכיל :size פריטים.',
        'file' => 'השדה :attribute חייב להיות :size קילובייטים.',
        'numeric' => 'השדה :attribute חייב להיות :size.',
        'string' => 'השדה :attribute חייב להיות :size תווים.',
    ],
    'starts_with' => 'השדה :attribute חייב להתחיל עם אחד מהערכים הבאים: :values.',
    'string' => 'השדה :attribute חייב להיות מחרוזת.',
    'timezone' => 'השדה :attribute חייב להיות אזור זמן תקין.',
    'unique' => 'השדה :attribute כבר נמצא בשימוש.',
    'uploaded' => 'הקובץ של השדה :attribute נכשל בהעלאה.',
    'uppercase' => 'השדה :attribute חייב להכיל אותיות גדולות בלבד.',
    'url' => 'השדה :attribute אינו כתובת URL תקינה.',
    'ulid' => 'השדה :attribute חייב להיות ULID תקין.',
    'uuid' => 'השדה :attribute חייב להיות UUID תקין.',

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
            'rule-name' => 'הודעה-מותאמת',
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

    'attributes' => [],

];
