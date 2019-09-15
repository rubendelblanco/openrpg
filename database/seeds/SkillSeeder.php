<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'ArdL' => ['Cuero Endurecido (TA9; TA10; TA11)', ' Cuero Blando (TA5; TA6; TA7)', ],
            'ArdM' => ['Cota de Mallas (TA13; TA14; TA15; TA16)', ],
            'ArdP' => ['Coraza (TA17; TA18; TA19; TA20)', ],
            'Arm2M' => [],
            'ArmAj' => [],
            'ArmAt' => [],
            'ArmC' => [],
            'ArmAs' => [],
            'ArmF' => [],
            'ArmPr' => [],
            'ArtA' => ['Actuar', ' Bailar', ' Cantar', ' Imitar Sonidos', ' Improvisación Poética', ' Mímica', ' Narrar Historias', ' Tocar Instrumento', ' Ventriloquia', ],
            'ArtP' => ['Escultura', ' Música', ' Pintura', ' Poesía', ],
            'AmB' => ['Barridos de Artes Marciales', ' Blocar', ' Lucha Libre', ' Inmovilizar', ],
            'AmG' => ['Boxeo', ' Placaje', ' Golpes de Artes Marciales', ],
            'AmMC' => ['Esquiva Adrenal', ' Evasión Adrenal', ],
            'AtaEsp' => ['Desarmar Enemigo (Armado)', ' Desarmar Enemigo (Desarmado)', ' Fintar (Armado)', ' Fintar (Desarmado)', ' Justar', ' Pelea', ],
            'AtlG' => ['Juegos Atléticos (Gimnasia)', ' Acrobacias', ' Caer', ' Contorsionismo', ' Malabarismos', ' Trepar', ' Volar/Planear', ' Volteretas', ' Caminar con Zancos', ' Caminar por la Cuerda Floja', ' Esquiar', ' Hacer Surf', ' Patinar', ' Rappelling', ' Salto con Pértiga', ],
            'AtlP' => ['Juegos Atléticos (Potencia)', ' Levantar Pesos', ' Saltar', ' Golpe Poderoso', ' Lanzamiento Poderoso', ],
            'AtlR' => ['Juegos Atléticos (Resistencia)', ' Carrera de Fondo', ' Escalar', ' Esprintar', ' Nadar', ' Remar', ],
            'Autoc' => ['Frenesí', ' Meditación', ' Mnemotecnia', ' Superar Aturdimiento', ' Caída Adrenal', ' Concentración Adrenal', ' Control de la Licantropía (R)', ' Desenvainar Adrenal', ' Equilibrio Adrenal', ' Estabilización Adrenal (R)', ' Fuerza Adrenal', ' Maniobrar Aturdido', ' Salto Adrenal', ' Trance Adormecedor', ' Trance de la Muerte  (R)', ' Trance Purificador  (R)', ' Trance Sanador', ' Velocidad Adrenal', ],
            'CienB' => ['Documentación', ' Matemáticas Básicas', ],
            'CienE' => ['Alquimia', ' Antropología', ' Matemáticas Avanzadas', ' Astronomía', ' Bioquímica', ' Psicología', ' Anatomía', ],
            'Comun' => ['Leer los Labios', ' Señales', ],
            'ConGen' => ['Conocimiento de la Fauna', ' Conocimiento de la Flora', ' Conocimiento Cultural', ' Conocimiento Regional', ' Heráldica', ' Historia', ' Religión', ' Conocimiento de Estilos Marciales', ' Conocimiento de Estilos de Armas', ],
            'ConMag' => ['Conocimiento de los Artefactos', ' Conocimiento de los Hechizos', ' Conocimiento de los No-Muertos', ' Conocimiento de las Protecciones', ' Conocimiento de los Planos', ' Conocimiento de los Símbolos', ],
            'ConOsc' => ['Conocimiento de las Hadas', ' Conocimiento de los Dragones', ' Demonología', ' Xeno-Conocimientos*', ],
            'ConTec' => ['Conocimiento de la Piedra', ' Conocimiento de las Cerraduras', ' Conocimiento de las Hierbas', ' Conocimiento de los Metales', ' Conocimiento de los Venenos', ' Conocimiento del Comercio', ],
            'DefEsp' => ['Aguante Adrenal', ' Defensa Adrenal', ' Resistencia Adrenal', ],
            'DesPP' => ['Desarrollo de Puntos de Poder', ],
            'DesFis' => ['Desarrollo Físico', ],
            'ExtAni' => ['Conducir', ' Domar', ' Maestría de Animales (R)', ' Manejo de los Animales', ' Montar', ' Montar: Lobos', ' Montar: Caballos', ' Montar: Osos', ' Montar: Camellos', ' Montar: Elefantes*', ' Curación de Animales (R)', ' Pastoreo', ],
            'ExtEnt' => ['Cazar', ' Espeleología', ' Forrajear', ' Orientación Celeste', ' Predicción del Clima', ' Supervivencia', ' Supervivencia (Montañas)', ' Supervivencia (Bosques)', ' Supervivencia (Desiertos)', ' Supervivencia (Llanuras)', ' Supervivencia (Subterráneos)', ' Supervivencia (Ártico)', ],
            'HecDir' => ['Relámpago', 'Rayo de agua', 'Rayo de luz', 'Rayo de fuego', 'Rayo de hielo'],
            'ListBas' => [],
            'ListAb' => [],
            'ListCerr' => [],
            'ListBasOt' => [],
            'ListAbOt' => [],
            'ListCerrOt' => [],
            'ListBasOtR' => [],
            'ListAbArc' => [],
            'ListAd' => [],
            'ListAdOtR' => [],
            'ListTri' => [],
            'ListElCom' => [],
            'Infl' => ['Comerciar', ' Diplomacia', ' Embaucar', ' Interrogar', ' Liderazgo', ' Oratoria', ' Seducción', ' Sobornar', ' Rumorear', ],
            'ManCom' => ['Combate con 2 Armas', ' Combate Montado', ' Desenvainar', ' Florituras', ' Ataque de Revés', ' Esquiva Acrobática (R)', ' Estilo de Arma (Básico)', ' Estilo de Arma (Avanzado)', ' Subyugar', ],
            'ManPod' => ['Canalización', ' Maestría de los Hechizos', ' Maestría de los Hechizos: Control del Aire', ' Maestría de los Hechizos: Ley de la Luz', ' Maestría de los Hechizos: Maestría de los Espiritus', ' Ritual Mágico', ' Ocultación de Hechizos', ],
            'Ofi' => ['Cocinar', ' Manejo de Cuerdas', ' Trabajar el Cuero', ' Trabajar el Metal', ' Trabajar la Madera', ' Trabajar la Piedra', ' Coser/Tejer', ' Dibujar', ' Escribir', ' Hacer Flechas', ' Horticultura', ' Peletería', ' Servicio', ' Trampero', ],
            'PerBus' => ['Buscar', ' Detectar Mentiras', ' Detectar Trampas', ' Detectar Venenos', ' Leer Huellas', ' Observación', ' Rastrear', ],
            'PerPers' => ['Alerta', ' Detectar Emboscadas', ],
            'PerSen' => ['Percepción del Entorno: Ciudades', ' Percepción del Entorno: Combate', ' Percepción del Entorno: Durmiendo', ' Percepción del Entorno: Exploración', ' Sentido de la Dirección', ' Sentido del Espacio (R)', ' Sentido del Tiempo', ' Vista', ' Olfato', ' Gusto', ' Oído', ' Tacto', ' Sentido de la Realidad (R)', ' Vigilancia', ],
            'PerPod' => ['Leer Runas', ' Sintonización', ' Adivinación', ' Percepción del Poder (R)', ],
            'SubAta' => ['Ataque Silencioso', ' Emboscar', ],
            'SubMec' => ['Abrir Cerraduras', ' Camuflaje', ' Desactivar Trampas', ' Disfrazarse', ' Construir Trampas', ' Preparar Trampas', ' Usa/Curar Venenos', ' Falsificación', ' Imitación', ' Ocultar Objetos', ],
            'SubSig' => ['Acechar', ' Esconderse', ' Juegos de Manos', ' Robar Bolsillos', ],
            'TecGen' => ['Dibujar Mapas', ' Juego', ' Juegos de Estrategia', ' Maquinaria', ' Mendigar', ' Navegar', ' Orientación', ' Primeros Auxilios', ' Usar Hierbas', ],
            'TecPro' => ['Cuidados Médicos', ' Diagnosis', ' Ingeniería', ' Mecánica', ' Minería', ' Adormecerse', ' Arquitectura', ' Cirugía', ' Organización Militar', ' Propaganda', ' Zahorí', ' Investigación', ],
            'TecVoc' => ['Administración', ' Manejo de Botes', ' Evaluar Arma', ' Evaluar Armadura', ' Evaluar Metal', ' Evaluar Piedra', ' Navegación', ' Táctica', ' Tasar', ' Artimañas', ' Cartografía', ' Ingeniería de Asedio', ' Partería', ' Preparar Hierbas', ' Preparar Venenos', ],
            'Urb' => ['Agenciar', ' Callejeo', ' Disimulo', ' Instinto Urbano', ],
        ];

        foreach ($data as $category => $names) {
            foreach ($names as $name) {
                DB::table('skills')->insert([
                    'skill_category_id' => $category,
                    'name' => trim($name),
                    'code' => Str::slug(trim($name),'_'),
                    'description' => ''
                ]);
            }
        }

    }
}
