<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('provincias')->count() > 0) {
            $this->command->info('Las provincias ya existen. Saltando seeder.');
            return;
        }

        $provincias = [
            [
                'nombre_provincia' => 'Azuay',
                'capital_provincia' => 'Cuenca',
                'descripcion_provincia' => 'Es llamada la Atenas del Ecuador por su arquitectura, su diversidad cultural, su aporte a las artes, ciencias y letras ecuatorianas y por ser el lugar de nacimiento de muchos personajes ilustres de la sociedad ecuatoriana',
                'poblacion_provincia' => 569.42,
                'superficie_provincia' => 122.00,
                'latitud_provincia' => '-2.902222',
                'longitud_provincia' => '-79.005261',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Bolívar',
                'capital_provincia' => 'Guaranda',
                'descripcion_provincia' => 'Bolívar es una provincia del centro de Ecuador, en la cordillera occidental de los Andes. Su capital es la ciudad de Guaranda. La Provincia de Bolívar se llama así en honor al Libertador Simón Bolívar.',
                'poblacion_provincia' => 183641.00,
                'superficie_provincia' => 3254.00,
                'latitud_provincia' => '-1.6',
                'longitud_provincia' => '-79',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Cañar',
                'capital_provincia' => 'Azogues',
                'descripcion_provincia' => 'La provincia destaca como uno de los sitios turísticos más importantes del país, destacándose entre otros la Fortaleza de Ingapirca, la Laguna de Culebrillas y la ciudad de Azogues.',
                'poblacion_provincia' => 33848.00,
                'superficie_provincia' => 3908.00,
                'latitud_provincia' => '-2.733333',
                'longitud_provincia' => '-78.833333',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Carchi',
                'capital_provincia' => 'Tulcán',
                'descripcion_provincia' => 'Carchi es una provincia ecuatoriana situada al norte del Ecuador en la frontera con Colombia. Su capital es la ciudad de Tulcán. Forma parte de la región 1',
                'poblacion_provincia' => 82734.00,
                'superficie_provincia' => 3783.00,
                'latitud_provincia' => '0.811667',
                'longitud_provincia' => '-77.718611',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Chimborazo',
                'capital_provincia' => 'Riobamba',
                'descripcion_provincia' => 'En esta provincia se encuentran varias de las cumbres más elevadas del país, como el Carihuairazo, el Altar, Igualata, Sangay, entre otros, que en algunos casos comparte con otras provincias.',
                'poblacion_provincia' => 223586.00,
                'superficie_provincia' => 6487.00,
                'latitud_provincia' => '-1.666667',
                'longitud_provincia' => '-78.65',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Cotopaxi',
                'capital_provincia' => 'Latacunga',
                'descripcion_provincia' => 'La provincia toma el nombre del volcán más grande e importante de su territorio, el volcán Cotopaxi. Cotopaxi se encuentra dividida políticamente en 7 cantones. Según el último ordenamiento territorial, la provincia de Cotopaxi pertenece a la región centro 3',
                'poblacion_provincia' => 409205.00,
                'superficie_provincia' => 6569.00,
                'latitud_provincia' => '-0.933333',
                'longitud_provincia' => '-78.616667',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'El Oro',
                'capital_provincia' => 'Machala',
                'descripcion_provincia' => 'La capital de la provincia de El Oro es la ciudad de Machala, quinta ciudad del país, considerada como la capital bananera del mundo.',
                'poblacion_provincia' => 260528.00,
                'superficie_provincia' => 6188.00,
                'latitud_provincia' => '-3.266669',
                'longitud_provincia' => '-79.9667',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Esmeraldas',
                'capital_provincia' => 'Esmeraldas',
                'descripcion_provincia' => 'Provincia del Ecuador situada en su costa noroccidental, conocida popularmente como la provincia verde. Su capital homónima es uno de los puertos principales del Ecuador y terminal del oleoducto transandino. Posee un aeropuerto para vuelos nacionales e internacionales',
                'poblacion_provincia' => 189504.00,
                'superficie_provincia' => 15954.00,
                'latitud_provincia' => '-0.966667',
                'longitud_provincia' => '-79.65',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Galápagos',
                'capital_provincia' => 'Puerto Baquerizo Moreno',
                'descripcion_provincia' => 'Es el mayor centro turístico del Ecuador, así como también una de las reservas ecológicas más grandes e importantes del planeta. Con sus 26.640 habitantes, Galápagos es la provincia menos poblada del país, debido principalmente al afán de conservar al máximo la flora y fauna de la región.',
                'poblacion_provincia' => 5600.00,
                'superficie_provincia' => 8010.00,
                'latitud_provincia' => '-0.666667',
                'longitud_provincia' => '-90.55',
                'id_region' => 3
            ],
            [
                'nombre_provincia' => 'Guayas',
                'capital_provincia' => 'Guayaquil',
                'descripcion_provincia' => 'Es el mayor centro comercial e industrial del Ecuador. Con sus 3,8 millones de habitantes, Guayas es la provincia más poblada del país, constituyéndose con el 24,5% de la población de la República.',
                'poblacion_provincia' => 2526927.00,
                'superficie_provincia' => 17139.00,
                'latitud_provincia' => '-2.2',
                'longitud_provincia' => '-79.9667',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Imbabura',
                'capital_provincia' => 'Ibarra',
                'descripcion_provincia' => 'La provincia también es conocida por sus contrastes poblacionales es así que la población está marcada por diferentes factores demográficos, además desde siempre ha sido núcleo de artesanías y cultura.',
                'poblacion_provincia' => 181722.00,
                'superficie_provincia' => 4599.00,
                'latitud_provincia' => '0.35',
                'longitud_provincia' => '-78.133333',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Loja',
                'capital_provincia' => 'Loja',
                'descripcion_provincia' => 'Loja es una ciudad del Ecuador, capital de la provincia y cantón Loja, tiene una rica tradición en las artes, y por esta razón es conocida como la capital musical y cultural del Ecuador.',
                'poblacion_provincia' => 206.83,
                'superficie_provincia' => 57.00,
                'latitud_provincia' => '-3.833',
                'longitud_provincia' => '-80.067',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Los Ríos',
                'capital_provincia' => 'Babahoyo',
                'descripcion_provincia' => 'Los Ríos, oficialmente Provincia de Los Ríos, es una de las 24 provincias de la República del Ecuador, localizada en la Región Costa del país. Su capital es la ciudad de Babahoyo y su localidad más poblada es la ciudad de Quevedo.',
                'poblacion_provincia' => 778115.00,
                'superficie_provincia' => 6254.00,
                'latitud_provincia' => '-1.766669',
                'longitud_provincia' => '-79.45',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Manabí',
                'capital_provincia' => 'Portoviejo',
                'descripcion_provincia' => 'Manabí es una provincia ecuatoriana localizada en el emplazamiento centro-noroeste del Ecuador continental, cuya unidad jurídica se ubica en la región geográfica del litoral, que a su vez se encuentra dividida por el cruce de la línea equinoccial.',
                'poblacion_provincia' => 1369780.00,
                'superficie_provincia' => 18400.00,
                'latitud_provincia' => '-1.052219',
                'longitud_provincia' => '-80.4506',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Morona Santiago',
                'capital_provincia' => 'Macas',
                'descripcion_provincia' => 'Morona Santiago (nombre oficial Provincia de Morona Santiago) es una de las 24 provincias que conforman la República del Ecuador. Es una provincia de la Amazonía ecuatoriana.',
                'poblacion_provincia' => 147940.00,
                'superficie_provincia' => 25690.00,
                'latitud_provincia' => '-2.366667',
                'longitud_provincia' => '-78.133333',
                'id_region' => 4
            ],
            [
                'nombre_provincia' => 'Napo',
                'capital_provincia' => 'Tena',
                'descripcion_provincia' => 'La provincia de Napo es una de las provincias de la Región Centro Norte (Ecuador), de la República del Ecuador, situada en la región amazónica ecuatoriana e incluyendo parte de las laderas de los Andes, hasta las llanuras amazónicas.',
                'poblacion_provincia' => 103697.00,
                'superficie_provincia' => 13271.00,
                'latitud_provincia' => '0.989',
                'longitud_provincia' => '-77.8159',
                'id_region' => 4
            ],
            [
                'nombre_provincia' => 'Orellana',
                'capital_provincia' => 'Francisco de Orellana',
                'descripcion_provincia' => 'Orellana, provincia de la Región Centro Norte (Ecuador), Ecuador, La capital de la provincia es El Coca más conocida como «Coca».',
                'poblacion_provincia' => 136396.00,
                'superficie_provincia' => 20773.00,
                'latitud_provincia' => '-0.933333',
                'longitud_provincia' => '-75.666667',
                'id_region' => 4
            ],
            [
                'nombre_provincia' => 'Pastaza',
                'capital_provincia' => 'Puyo',
                'descripcion_provincia' => 'Pastaza, oficialmente Provincia de Pastaza, es una de las 24 provincias que conforman la República del Ecuador, situada en la Región Amazónica del Ecuador.',
                'poblacion_provincia' => 83933.00,
                'superficie_provincia' => 29520.00,
                'latitud_provincia' => '-1.066667',
                'longitud_provincia' => '-78.001111',
                'id_region' => 4
            ],
            [
                'nombre_provincia' => 'Pichincha',
                'capital_provincia' => 'Quito',
                'descripcion_provincia' => 'La Provincia de Pichincha es una de las 24 provincias que conforman la República del Ecuador. Se encuentra ubicada al norte del país, en la zona geográfica conocida como sierra.',
                'poblacion_provincia' => 2576287.00,
                'superficie_provincia' => 9612.00,
                'latitud_provincia' => '-0.25',
                'longitud_provincia' => '-78.583333',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Santa Elena',
                'capital_provincia' => 'Santa Elena',
                'descripcion_provincia' => 'Santa Elena es una provincia de la costa de Ecuador creada el 7 de noviembre de 2007, la más reciente de las 24 actuales, con territorios que anterior a esa fecha formaban parte de la provincia del Guayas.',
                'poblacion_provincia' => 308693.00,
                'superficie_provincia' => 3763.00,
                'latitud_provincia' => '-2.2267',
                'longitud_provincia' => '-80.8583',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Santo Domingo de los Tsáchilas',
                'capital_provincia' => 'Santo Domingo',
                'descripcion_provincia' => 'La Provincia de Santo Domingo de los Tsáchilas es una de las provincias de la República del Ecuador y forma parte de la Región Costa, históricamente conocida como Provincia de Yumbos.',
                'poblacion_provincia' => 410937.00,
                'superficie_provincia' => 4180.00,
                'latitud_provincia' => '-0.333333',
                'longitud_provincia' => '-79.25',
                'id_region' => 2
            ],
            [
                'nombre_provincia' => 'Sucumbíos',
                'capital_provincia' => 'Nueva Loja',
                'descripcion_provincia' => 'Sucumbíos es una provincia del nor-oriente del Ecuador. Su capital es Nueva Loja. Es una de las principales provincias que proveen al Estado ecuatoriano del petróleo que necesita para las exportaciones.',
                'poblacion_provincia' => 176472.00,
                'superficie_provincia' => 18612.00,
                'latitud_provincia' => '-0.083333',
                'longitud_provincia' => '-76.883333',
                'id_region' => 4
            ],
            [
                'nombre_provincia' => 'Tungurahua',
                'capital_provincia' => 'Ambato',
                'descripcion_provincia' => 'Tungurahua, oficialmente Provincia de Tungurahua, es una de las 24 provincias que conforman la República del Ecuador. Se encuentra al centro del país, en la región geográfica conocida como sierra.',
                'poblacion_provincia' => 504583.00,
                'superficie_provincia' => 3334.00,
                'latitud_provincia' => '-1.233333',
                'longitud_provincia' => '-78.616667',
                'id_region' => 1
            ],
            [
                'nombre_provincia' => 'Zamora Chinchipe',
                'capital_provincia' => 'Zamora',
                'descripcion_provincia' => 'Zamora Chinchipe es una provincia de Ecuador ubicada en el sur-oriente de la Amazonía ecuatoriana, que limita con la provincia de Morona Santiago al norte; con la provincia de Loja al oeste; y con Perú al sur y este.',
                'poblacion_provincia' => 91376.00,
                'superficie_provincia' => 10556.00,
                'latitud_provincia' => '-2.883333',
                'longitud_provincia' => '-79',
                'id_region' => 4
            ]
        ];

        DB::table('provincias')->insert($provincias);
    }
}