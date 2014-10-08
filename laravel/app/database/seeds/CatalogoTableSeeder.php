<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class CatalogoTableSeeder extends Seeder
{

      public function run()
      {

            $categoria = Categoria::create(array('Categoria' => 'Noche'));

            Subcategoria::create(array('subcategoria' => 'Antro', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Bares', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cantinas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Clubes para caballeros', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Clubes para damas', 'categoria_id' => $categoria->id));


            $categoria = Categoria::create(array('Categoria' => 'Cultura'));

            Subcategoria::create(array('subcategoria' => 'Museos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Galerías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Casas de Cultura', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'CineClubes', 'categoria_id' => $categoria->id));



            $categoria = Categoria::create(array('Categoria' => 'Belleza'));

            Subcategoria::create(array('subcategoria' => 'Perfumería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Spas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cosméticos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Estéticas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'BodyShopping', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Maquillaje', 'categoria_id' => $categoria->id));


            $categoria = Categoria::create(array('Categoria' => 'Centros Comerciales'));

            Subcategoria::create(array('subcategoria' => 'Plazas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Outlets', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Hospedaje'));

            Subcategoria::create(array('subcategoria' => 'Hoteles', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Moteles', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Hostal', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Suites', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Departamento', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Casa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Loft', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cabaña', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Villa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Chalet', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Dormitorio', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cueva', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Barco', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Tienda de campaña', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Autocaravana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Choza', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Librerías'));

            Subcategoria::create(array('subcategoria' => 'Generales', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Especializadas', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Mascotas'));

            Subcategoria::create(array('subcategoria' => 'Veterinarias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Clínicas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Guarderías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Accesorios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Ropa', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Comida'));

            Subcategoria::create(array('subcategoria' => 'Tacos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Japonesa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mexicana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Internacional', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Italiana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Americana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'PuestosCallejeros', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Árabe', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'China', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Libanesa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Vegetariano', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mariscos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pizza', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Tailandesa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Alemana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Argentina', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cubana', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Española', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Francesa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Griego', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mediterránea', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cafeterías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Helados', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Panadería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pastelería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Dulcería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Cupcakes', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Nieves', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Crepas', 'categoria_id' => $categoria->id));


            $categoria = Categoria::create(array('Categoria' => 'Salud'));

            Subcategoria::create(array('subcategoria' => 'Doctores', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Dentistas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Farmacias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Laboratorios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Podólogos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Ópticas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'ControldePeso', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Hospitales', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Suplementos Alimenticios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Terapia', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Servicios'));

            Subcategoria::create(array('subcategoria' => 'Locales', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Públicos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Financieros', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Profesionales', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Eventos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Taxis', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Inmobiliarias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Bienes Raices', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Préstamos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mensajería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mudanza', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Seguridad', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Teatros'));


            $categoria = Categoria::create(array('Categoria' => 'Tiendas'));

            Subcategoria::create(array('subcategoria' => 'Sexshop', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Música', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Jugueterías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Equipaje', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Automotriz', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Oficina', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Escolares', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Electrónicos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Tintorería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Lavandería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Bebés', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Florerías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Regalos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Supermercados', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Mercados', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Licorerías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Gourmet', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Viajes'));

            Subcategoria::create(array('subcategoria' => 'Aerolíneas', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Agencias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Autobuses', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Trenes', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'CasayJardín'));

            Subcategoria::create(array('subcategoria' => 'Ferreterías', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Viveros', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Muebles', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Decoración', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pisos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Persianas', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Cines'));


            $categoria = Categoria::create(array('Categoria' => 'Deportes'));

            Subcategoria::create(array('subcategoria' => 'Gimnasios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Crossfit', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Yoga', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pilates', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Zumba', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pole Dance', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Ciclismo', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Bici de Montaña', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Yoga', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Educación'));

            Subcategoria::create(array('subcategoria' => 'Universidades', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Idiomas', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Moda'));

            Subcategoria::create(array('subcategoria' => 'Accesorios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Zapatos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Joyería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Ropa', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Lencería', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Boutiques', 'categoria_id' => $categoria->id));

            $categoria = Categoria::create(array('Categoria' => 'Recreación'));

            Subcategoria::create(array('subcategoria' => 'Zoológicos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Ferias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Acuarios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Parques', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Pistas de Hielo', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Parques Acuáticos', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Foros', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Conferencias', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Negocios', 'categoria_id' => $categoria->id));
            Subcategoria::create(array('subcategoria' => 'Casinos', 'categoria_id' => $categoria->id));



            $estado = Estado::create(array('Estado' => 'Aguascalientes'));



            $estado = Estado::create(array('Estado' => 'Baja California'));



            $estado = Estado::create(array('Estado' => 'Baja California Sur'));



            $estado = Estado::create(array('Estado' => 'Campeche'));



            $estado = Estado::create(array('Estado' => 'Coahuila'));



            $estado = Estado::create(array('Estado' => 'Colima'));



            $estado = Estado::create(array('Estado' => 'Chiapas'));



            $estado = Estado::create(array('Estado' => 'Chihuahua'));



            $estado = Estado::create(array('Estado' => 'Distrito Federal'));

            Zona::create(array('Zona' => 'Condesa', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Roma', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Polanco', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Escandón', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Juárez', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Del Valle', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Narvarte', 'estado_id' => $estado->id));

            $estado = Estado::create(array('Estado' => 'Durango'));



            $estado = Estado::create(array('Estado' => 'Guanajuato'));



            $estado = Estado::create(array('Estado' => 'Guerrero'));



            $estado = Estado::create(array('Estado' => 'Hidalgo'));



            $estado = Estado::create(array('Estado' => 'Jalisco'));



            $estado = Estado::create(array('Estado' => 'Estado de México'));



            $estado = Estado::create(array('Estado' => 'Michoacán'));



            $estado = Estado::create(array('Estado' => 'Morelos'));



            $estado = Estado::create(array('Estado' => 'Nayarit'));



            $estado = Estado::create(array('Estado' => 'Nuevo León'));



            $estado = Estado::create(array('Estado' => 'Oaxaca'));



            $estado = Estado::create(array('Estado' => 'Puebla'));



            $estado = Estado::create(array('Estado' => 'Querétaro'));



            $estado = Estado::create(array('Estado' => 'Quintana Roo'));

            Zona::create(array('Zona' => 'Cancún - Zona Hotelera', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Cancún - Centro', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Riviera Maya', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Playa del Carmen', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Tulúm', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Holbox', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Isla Mujeres', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Cozumel', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Bacalar', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Mahahual', 'estado_id' => $estado->id));

            $estado = Estado::create(array('Estado' => 'San Luis Potosí'));



            $estado = Estado::create(array('Estado' => 'Sinaloa'));



            $estado = Estado::create(array('Estado' => 'Sonora'));



            $estado = Estado::create(array('Estado' => 'Tabasco'));

            Zona::create(array('Zona' => 'Villahermosa', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Huimanguillo', 'estado_id' => $estado->id));
            Zona::create(array('Zona' => 'Cárdenas', 'estado_id' => $estado->id));

            $estado = Estado::create(array('Estado' => 'Tamaulipas'));



            $estado = Estado::create(array('Estado' => 'Tlaxcala'));



            $estado = Estado::create(array('Estado' => 'Veracruz'));



            $estado = Estado::create(array('Estado' => 'Yucatán'));



            $estado = Estado::create(array('Estado' => 'Zacatecas'));
      }

}
