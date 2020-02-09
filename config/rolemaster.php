<?php
/*
Here we go with rolemaster rules and constants!
 */

return [
    'stats_codes' => ['Ag','Co','Me','Ra','Ad','Em','In','Pr','Fu','Rp'],
    'profession_skill_type' => ['everyman','occupational','restricted'],
    'spell_user' => ['pure','semi','hybrid','none'],
    'stats' => [
        'Ag' => 'Agilidad',
        'Co' => 'Constitución',
        'Me'    => 'Memoria',
        'Ra'    => 'Razón',
        'Ad'    => 'Autodisciplina',
        'Em'    => 'Empatía',
        'In'    => 'Intuición',
        'Pr'    => 'Presencia',
        'Fu'    => 'Fuerza',
        'Rp'    => 'Rapidez'
    ],
    'spell_realms' => [
        'Ese' => 'Esencia',
        'Can' => 'Canalización',
        'Men' => 'Mentalismo',
        'Arc' => 'Arcano'
    ],
    'spells' => [
        'codes' => [
            'std' => ['code' => 'std', 'display' => 'Estandar'],
            'ins' => ['code' => 'ins', 'display' => 'Instantaneo'],
            'nopp' => ['code' => 'nopp', 'display' => 'No requiere PP'],
            'comp' => ['code' => 'comp', 'display' => 'Compuesto'],
        ],
        'classes' => [
            'E' => ['code' => 'E', 'display' => 'Elemental'],
            'EB' => ['code' => 'EB', 'display' => 'Elemental de bola'],
            'ED' => ['code' => 'ED', 'display' => 'Elemental dirigido'],
            'F' => ['code' => 'F', 'display' => 'Fuerza'],
            'P' => ['code' => 'P', 'display' => 'Pasivo'],
            'U' => ['code' => 'U', 'display' => 'Utilidad'],
            'I' => ['code' => 'I', 'display' => 'Informacion'],
        ],
        'subclasses' => [
            'none' => ['code' => 'none', 'display' => '-'],
            's' => ['code' => 's', 'display' => 'subconsciente'],
            'm' => ['code' => 'm', 'display' => 'mental'],
        ],
        'effect_areas' => [
            'SELF' => ['code' => 'SELF', 'display' => 'A uno mismo'],
            'AREA' => ['code' => 'AREA', 'display' => 'A un area determinada (1 hierba, 1 extremidad)'],
            'TARGET' => ['code' => 'TARGET', 'display' => 'A objetivo(s)'],
            'TARGET_LVL' => ['code' => 'TARGET_LVL', 'display' => 'A objetivo(s) / nivel'],
            'DIST' => ['code' => 'DIST', 'display' => 'Distancia en metros (radio)'],
            'DIST_LVL' => ['code' => 'DIST_LVL', 'display' => 'Distancia en metros/nivel (radio)'],
            'VARY' => ['code' => 'VARY', 'display' => 'Varia en funcion de las circunstancias'],
            'NONE' => ['code' => 'NONE', 'display' => 'Sin area de efecto'],
        ],
        'duration' => [
            'TIME' => ['code' => 'TIME', 'display' => 'Duration determinada'],
            'C' => ['code' => 'C', 'display' => 'Se requiere concentracion'],
            'DURATION' => ['code' => 'DURATION', 'display' => 'Se requiere concentracion, con limite de tiempo'],
            'P' => ['code' => 'P', 'display' => 'Permanente e inmediato'],
            'VARY' => ['code' => 'VARY', 'display' => 'Varia en funcion del hechizo'],
            'INS' => ['code' => 'INS', 'display' => 'Sin duracion, inmediato'],
            'TIME_LVL' => ['code' => 'TIME_LVL', 'display' => 'Tiempo/asaltos multiplicados por el nivel del lanzador'],
            'TIME_FAIL' => ['code' => 'TIME_FAIL', 'display' => 'unidad de tiempo / puntos. tiempo = ((TR - RMF) / puntos)'],
        ],
        'range' => [
            'SELF' => ['code' => 'SELF', 'display' => 'A uno mismo'],
            'CON' => ['code' => 'CON', 'display' => 'Se requiere contacto'],
            'DIST' => ['code' => 'DIST', 'display' => 'El lanzador no puede estar mas lejos de la distancia del area del efecto deseada'],
            'DIST_LVL' => ['code' => 'DIST_LVL', 'display' => 'La distancia del area de efecto no puede ser mayor de la distancia por el nivel del lanzador'],
            'ILI' => ['code' => 'ILI', 'display' => 'Sin limitacion'],
            'VARY' => ['code' => 'VARY', 'display' => 'La distancia varia en funcion de algun aspecto del feitizo'],
        ],
    ],
    'spell_list_type' => [
        'basic' => ['code' => 'basic', 'display' => 'Básica'],
        'closed' => ['code' => 'closed', 'display' => 'Cerrada'],
        'open' => ['code' => 'open', 'display' => 'Abierta'],
        'training' => ['code' => 'training', 'display' => 'Opción de adiestramiento'],
    ],
    'resistance_rolls' => [
        'Ese' => 'Esencia',
        'Can' => 'Canalización',
        'Men' => 'Mentalismo',
        'Arc' => 'Arcano',
        'Ven' => 'Veneno',
        'Enf' => 'Enfermedad',
        'Fri' => 'Frío',
        'Cal' => 'Calor',
        'Mie' => 'Miedo'
    ]
];
