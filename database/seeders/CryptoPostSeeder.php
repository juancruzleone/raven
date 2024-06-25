<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CryptoPost;

class CryptoPostSeeder extends Seeder
{
    public function run()
    {
        DB::table('crypto_posts')->insert([
            [
                'title' => 'Bitcoin: La revolución digital',
                'content' => 'Bitcoin es la criptomoneda más conocida y ha cambiado la forma en que entendemos el dinero. Desde su creación en 2009 por un enigmático individuo conocido como Satoshi Nakamoto, Bitcoin ha revolucionado la industria financiera y desafiado las nociones tradicionales de moneda y valor. Su tecnología subyacente, la cadena de bloques, ha inspirado una oleada de innovación y ha dado lugar a miles de otras criptomonedas. Bitcoin ha superado numerosos desafíos y ha emergido como una forma de inversión y un medio de intercambio en todo el mundo.',
                'published_at' => now(),
                'category_id' => 1,
                'cover' => 'bitcoin.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ethereum y los contratos inteligentes',
                'content' => 'Ethereum, lanzado en 2015 por Vitalik Buterin, es mucho más que una criptomoneda. Es una plataforma de contrato inteligente que permite a los desarrolladores crear aplicaciones descentralizadas (DApps) y contratos inteligentes. Los contratos inteligentes son programas autoejecutables que automatizan acuerdos y transacciones. Este avance ha tenido un gran impacto en muchas industrias, incluidas las finanzas, la atención médica y la logística. Ethereum es conocido por su capacidad de programación y su flexibilidad, lo que ha impulsado la creación de una amplia gama de aplicaciones en su plataforma.',
                'published_at' => now(),
                'category_id' => 2,
                'cover' => 'ethereum.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Riesgos y beneficios de invertir en criptomonedas',
                'content' => 'Invertir en criptomonedas puede ser lucrativo, pero también conlleva riesgos significativos. La volatilidad del mercado cripto puede resultar en ganancias sustanciales o pérdidas considerables en poco tiempo. Antes de invertir, es importante comprender los riesgos, diversificar la cartera y realizar una investigación exhaustiva. Los inversores también deben considerar factores como la seguridad de las billeteras y las regulaciones gubernamentales. A pesar de los riesgos, las criptomonedas han atraído a inversores de todo el mundo debido a su potencial de alto rendimiento y su capacidad de diversificar una cartera de inversión tradicional.',
                'published_at' => now(),
                'category_id' => 2,
                'cover' => 'trading.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'El auge de las NFT',
                'content' => 'Las NFT (Tokens No Fungibles) están transformando las industrias del arte y el entretenimiento en la cadena de bloques. Las NFT representan activos digitales únicos e indivisibles, lo que las hace ideales para autenticar y vender arte digital, música, videos y otros contenidos creativos. Algunas NFT se han vendido por millones de dólares, y esta tendencia ha generado un entusiasmo creciente en la comunidad artística y coleccionista. Los artistas y creadores están explorando nuevas formas de monetizar su trabajo a través de NFT, y las NFT también están siendo utilizadas para la autenticación y propiedad de bienes virtuales en juegos y mundos virtuales.',
                'published_at' => now(),
                'category_id' => 2,
                'cover' => 'nft.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
